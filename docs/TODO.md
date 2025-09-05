## SCSS pipeline: plan, tasks, and test plan

### Goal
Introduce `assets/scss/` with partials in `assets/scss/parts/`, compile entry files (e.g., `assets/scss/main.scss`) to minified CSS, generate RTL counterparts, and output into `assets/css/`. Ensure live watch on `npm start`.

### Open questions (please confirm choices before implementation)
- Output target and enqueue:
  - A) Keep WordPress main stylesheet at theme root (`style.css` and `style-rtl.css`) to match `get_stylesheet_uri()`; or
  - B) Output to `assets/css/main.css` and `assets/css/main-rtl.css` and update `functions.php` to enqueue these (recommended if you want all assets in `assets/css`).
- File naming: Use `.min.css` suffix (e.g., `main.min.css`, `main-rtl.min.css`) or just `main.css` and `main-rtl.css`?
- Entry points: Only `main.scss`, or also `admin.scss`/others to be compiled too?
- Sourcemaps: Enable in dev (`npm start`) and disable in build?
- Migration strategy: migrate existing `assets/css/parts/*.css` into SCSS partials now (touches >10 files) or phase it later and keep the old CSS pipeline temporarily?

### Tasks
1) Create SCSS structure (no functional changes)
   - Create folders: `assets/scss/` and `assets/scss/parts/`
   - Seed partials: `assets/scss/parts/_variables.scss`, `_mixins.scss`, `_base.scss`
   - Add entry: `assets/scss/main.scss` importing partials

2) Tooling dependencies
   - Add: `sass` (Dart Sass), `gulp-sass`, `gulp-sourcemaps`, and `gulp-rtlcss`
   - Keep: `autoprefixer`, `gulp-postcss`, `gulp-clean-css`

3) Gulp updates
   - Add SCSS compile task: compile all `assets/scss/*.scss` that do not start with `_`
   - Post-process: autoprefix, minify, write to `assets/css/`
   - Generate RTL file per compiled CSS (`main.css` -> `main-rtl.css`) using `gulp-rtlcss`
   - Update `watch` to watch `assets/scss/**/*.scss`
   - Decide whether to remove or keep the legacy `minify-css` + `compile-rtl` (CSS parts) tasks during migration

4) NPM scripts
   - Ensure `npm start` runs the watch task for SCSS
   - Ensure `npm run build` produces all CSS + RTL assets

5) WordPress enqueue (depending on your choice above)
   - Option A: keep generating `style.css` and `style-rtl.css` at theme root, no enqueue change
   - Option B: enqueue `assets/css/main.css` and set RTL replacement to `assets/css/main-rtl.css`

6) (Optional) Phase-in migration of existing CSS parts
   - Convert files in `assets/css/parts/` to `assets/scss/parts/_*.scss` gradually
   - Replace `@import` in `main.scss` accordingly

### Files to be changed/added
- New: `assets/scss/parts/_variables.scss`
- New: `assets/scss/parts/_mixins.scss`
- New: `assets/scss/parts/_base.scss`
- New: `assets/scss/main.scss`
- Update: `package.json` (devDependencies + scripts)
- Update: `gulpfile.js` (SCSS compile + RTL + watch)
- Update: `functions.php` (only if Option B)

### Test plan
1) Install tooling
   - Run: `npm i`

2) Dev watch
   - Run: `npm start`
   - Edit `assets/scss/parts/_base.scss` (e.g., change body background)
   - Expect: compiled `assets/css/main.css` (and `main-rtl.css`) updated within ~1s

3) Build
   - Run: `npm run build`
   - Expect: all CSS compiled and minified; RTL files present; no errors in console

4) WordPress check
   - If Option A: confirm `style.css` and `style-rtl.css` exist at theme root and styles render
   - If Option B: confirm `functions.php` enqueues `assets/css/main.css` and that RTL loads `assets/css/main-rtl.css`

5) Regression
   - JS build (`assets/js/scripts/*.js`) and icon tasks still work

### Notes
- We will keep functions split under 30 lines and avoid touching >10 style files in one go. Full migration of `assets/css/parts` to SCSS partials can be scheduled after this pipeline is in place.

### Status (completed)
- Implemented SCSS pipeline with entries in `assets/scss/` and partials in `assets/scss/parts/`.
- Gulp compiles LTR + RTL with autoprefix, minify, and sourcemaps written to `assets/css/maps/`.
- Watch is wired via `npm start`.
- Kept `style.css` at theme root; no enqueue change needed.
- Removed legacy CSS concat/RTL tasks and SVG sprite tasks from gulp as requested.
- Deprecation notice from Sass legacy JS API is benign; builds succeed.

## Fonts generation revamp (proposal)

### Goal
Replace CSS-based font generation with an SCSS partial consumed by the new pipeline. Generate proper @font-face rules for files in `assets/fonts/`, support weights/styles from filenames, correct relative URLs, and keep existing `:root` font CSS variables.

### Open questions (please confirm)
- Use a single family per typeface (e.g., `font-family: "Assistant"` with `font-weight` 300/400/700) instead of per-file families like `Assistant-Bold`? (recommended)
- Keep `:root` variables (e.g., `--font-AssistantRegular`) or simplify to one variable per family (e.g., `--font-Assistant`)?
- Add `local()` fallbacks in `src`? (optional)
- Include only available formats (we currently have `.ttf`), or do you want to add/convert to `woff2/woff` later?

### Implementation tasks
1) Generate `assets/scss/parts/_fonts.scss` from files in `assets/fonts/`
   - Parse weights/styles from filename (Thin/ExtraLight/Light/Regular/Medium/SemiBold/Bold/ExtraBold/Black; Italic)
   - Build `@font-face` with prioritized sources (woff2 > woff > ttf > otf when present)
   - Use correct formats: `woff2`, `woff`, `truetype`, `opentype`
   - Use URLs relative to final CSS: `url('../fonts/<file>')`
   - Keep `font-display: swap`
   - Emit `:root` font variables

2) Update gulp `fonts` task to write `_fonts.scss` instead of CSS

3) Import fonts in `assets/scss/main.scss` via `@use 'parts/fonts'`

4) Deprecate `assets/css/parts/__02-fonts.css` (no longer used by pipeline)

### Files to change/add
- Update: `gulpfile.js` (generate `_fonts.scss`)
- Update: `assets/scss/main.scss` (add `@use 'parts/fonts'`)
- Remove/ignore: `assets/css/parts/__02-fonts.css`

### Test plan
1) Run `npm run fonts` (or `npm run build`) → `_fonts.scss` created
2) Run `npm run styles` → `@font-face` rules appear in `assets/css/main.min.css`
3) Check URLs resolve (expect `../fonts/...`) and no 404s in browser
4) Confirm weights/styles render as expected (e.g., 300/400/600/700)
