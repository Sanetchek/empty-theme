import gulp from 'gulp';
import {
  exec
} from 'child_process';
import plumber from 'gulp-plumber';
import cleanCSS from 'gulp-clean-css';
import concat from 'gulp-concat';
import uglify from 'gulp-uglify';
import postcss from 'gulp-postcss';
import autoprefixer from 'autoprefixer';
import rename from 'gulp-rename';
import fs from 'fs';
import path from 'path';
import * as dartSass from 'sass';
import gulpSass from 'gulp-sass';
import sourcemaps from 'gulp-sourcemaps';
import rtlcss from 'gulp-rtlcss';

const sass = gulpSass(dartSass);

// Helpers for fonts generation
function detectWeightAndStyle(baseName) {
  const name = baseName.toLowerCase();
  const weightMap = [
    { key: 'thin', value: 100 },
    { key: 'extralight', value: 200 },
    { key: 'ultralight', value: 200 },
    { key: 'light', value: 300 },
    { key: 'regular', value: 400 },
    { key: 'book', value: 400 },
    { key: 'text', value: 400 },
    { key: 'medium', value: 500 },
    { key: 'semibold', value: 600 },
    { key: 'demibold', value: 600 },
    { key: 'bold', value: 700 },
    { key: 'extrabold', value: 800 },
    { key: 'ultrabold', value: 800 },
    { key: 'black', value: 900 },
    { key: 'heavy', value: 900 },
  ];

  const isItalic = name.includes('italic');
  let weight = 400;
  let weightName = 'Regular';
  for (const entry of weightMap) {
    if (name.includes(entry.key)) {
      weight = entry.value;
      // Capitalize words for human-readable local() names
      weightName = entry.key.replace(/(^|\b)([a-z])/g, (_, p1, c) => (p1 ? ' ' : '') + c.toUpperCase()).replace(/\s+/g, '').replace(/^([A-Z])/, (m) => m);
      break;
    }
  }

  return {
    weight,
    weightName,
    style: isItalic ? 'italic' : 'normal',
  };
}

function buildLocalNames(family, weightName, style) {
  const names = new Set();
  const prettyWeight = weightName.replace(/([A-Z])/g, ' $1').trim();
  const italicSuffix = style === 'italic' ? ' Italic' : '';
  names.add(`${family}`);
  names.add(`${family} ${prettyWeight}${italicSuffix}`.trim());
  names.add(`${family}-${weightName}${style === 'italic' ? 'Italic' : ''}`);
  return Array.from(names).filter(Boolean);
}

function extToFormat(ext) {
  const map = { woff2: 'woff2', woff: 'woff', ttf: 'truetype', otf: 'opentype' };
  return map[ext] || ext;
}

// Minify JavaScript
gulp.task('minify-js', function (done) {
  console.log('Starting minify-js task');
  return gulp.src('assets/js/scripts/*.js')
    .pipe(plumber())
    .pipe(concat('scripts.min.js'))
    .pipe(uglify().on('error', function (err) {
      console.error('Uglify error:', err.toString());
      this.emit('end');
    }))
    .pipe(gulp.dest('assets/js'))
    .on('end', function () {
      console.log('minify-js task completed');
      done();
    });
});

// Compile SCSS to CSS (LTR) with sourcemaps, autoprefix, and minify
gulp.task('scss:ltr', function () {
  console.log('Starting scss:ltr task');
  return gulp.src(['assets/scss/*.scss', '!assets/scss/_*.scss'])
    .pipe(plumber())
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(postcss([autoprefixer()]))
    .pipe(cleanCSS())
    .pipe(rename({ suffix: '.min' }))
    .pipe(sourcemaps.write('maps'))
    .pipe(gulp.dest('assets/css'));
});

// Compile SCSS to CSS (RTL) with sourcemaps, autoprefix, RTL transform, and minify
gulp.task('scss:rtl', function () {
  console.log('Starting scss:rtl task');
  return gulp.src(['assets/scss/*.scss', '!assets/scss/_*.scss'])
    .pipe(plumber())
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(postcss([autoprefixer()]))
    .pipe(rtlcss())
    .pipe(cleanCSS())
    .pipe(rename({ suffix: '-rtl.min' }))
    .pipe(sourcemaps.write('maps'))
    .pipe(gulp.dest('assets/css'));
});

// Entry to compile both LTR and RTL from SCSS
gulp.task('scss', gulp.series('scss:ltr', 'scss:rtl'));

// Generate fonts CSS with preload
gulp.task('generate-fonts-css', (done) => {
  try {
    const fontDir = 'assets/fonts/';
    const outFontsScss = 'assets/scss/parts/_fonts.scss';
    const variablesFile = 'assets/scss/parts/_variables.scss';

    const families = {};
    fs.readdirSync(fontDir).forEach((file) => {
      if (!file.match(/\.(ttf|otf|woff|woff2)$/i)) return;
      const ext = path.extname(file).slice(1).toLowerCase();
      const base = path.basename(file, path.extname(file));
      const parts = base.split('-');
      const family = parts[0];
      const descriptor = parts.slice(1).join('-') || 'Regular';
      const meta = detectWeightAndStyle(descriptor);
      const key = `${meta.weight}-${meta.style}`;
      if (!families[family]) families[family] = {};
      if (!families[family][key]) families[family][key] = { meta, sources: {} };
      families[family][key].sources[ext] = file;
    });

    let scssFonts = '';
    Object.keys(families).forEach((family) => {
      const combos = families[family];
      Object.keys(combos).sort().forEach((comboKey) => {
        const { meta, sources } = combos[comboKey];
        const sourceList = [];
        // local() fallbacks
        buildLocalNames(family, meta.weightName, meta.style).forEach((ln) => {
          sourceList.push(`local('${ln}')`);
        });
        // prioritized formats
        ['woff2', 'woff', 'ttf', 'otf'].forEach((p) => {
          if (sources[p]) {
            sourceList.push(`url('../fonts/${sources[p]}') format('${extToFormat(p)}')`);
          }
        });
        scssFonts += `\n@font-face {\n  font-family: '${family}';\n  src: ${sourceList.join(',\n       ')};\n  font-weight: ${meta.weight};\n  font-style: ${meta.style};\n  font-display: swap;\n}\n`;
      });
    });

    let scssVars = ':root {\n';
    Object.keys(families).forEach((family) => {
      scssVars += `  --font-${family.replace(/[-_](.)/g, (_, c) => c.toUpperCase())}: '${family}', sans-serif;\n`;
    });
    scssVars += '}\n';

    fs.writeFileSync(outFontsScss, scssFonts.trimStart() + '\n');

    // Inject font variables into _variables.scss between markers
    const startMarker = '/* fonts:generated:start */';
    const endMarker = '/* fonts:generated:end */';
    let variablesContent = '';
    try {
      variablesContent = fs.readFileSync(variablesFile, 'utf8');
    } catch (e) {
      variablesContent = '';
    }

    if (variablesContent.includes(startMarker) && variablesContent.includes(endMarker)) {
      const startIdx = variablesContent.indexOf(startMarker);
      const endIdx = variablesContent.indexOf(endMarker) + endMarker.length;
      const before = variablesContent.slice(0, startIdx);
      const after = variablesContent.slice(endIdx);
      variablesContent = before + startMarker + '\n' + scssVars + endMarker + after;
    } else {
      if (variablesContent.length && !variablesContent.endsWith('\n')) {
        variablesContent += '\n';
      }
      variablesContent += '\n' + startMarker + '\n' + scssVars + endMarker + '\n';
    }

    fs.writeFileSync(variablesFile, variablesContent);
    done();
  } catch (error) {
    console.error('Error generating fonts SCSS:', error);
    done(error);
  }
});

// Task to generate fonts CSS
gulp.task('fonts', gulp.series('generate-fonts-css'));

// Task to compile styles (SCSS only)
gulp.task('styles', gulp.series('scss'));

// Task to minify JavaScript
gulp.task('js', gulp.series('minify-js'));

// Watch task to run tasks on file changes
gulp.task('watch', function () {
  console.log('Watching files...');
  gulp.watch('assets/fonts/*', gulp.series('fonts', 'scss'));
  gulp.watch('assets/scss/**/*.scss', gulp.series('scss'));
  gulp.watch('assets/js/scripts/*.js', gulp.series('js'));
});

// Default task to run watch
gulp.task('default', gulp.series('watch'));

// Build task to run all tasks in sequence
gulp.task('build', gulp.series('fonts', 'scss', 'js'));