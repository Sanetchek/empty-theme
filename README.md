Installation
---------------

### Quick Start

Search and replace `emptytheme` to your theme name `mega-theme`


### Setup

To start using all the tools that come with `emptytheme`  you need to install the necessary Node.js and Composer dependencies :

```sh
$ composer dev
$ npm start
```

### Available CLI commands

`emptytheme` comes packed with CLI commands tailored for WordPress theme development :

### Composer Scripts
- `composer make-pot`           Alias for generating a translation `.pot` file (via WP-CLI).
- `composer make-content`       Generates the file structure of the project and combines file contents into `project_content.txt`.
- `composer create-gulp`        Generates `gulpfile.js` (based on a base64-decoded script).
- `composer create-package`     Generates `package.json` (based on a base64-decoded script).
- `composer create-script`      Generates `generateContent.js` (based on a base64-decoded script).
- `composer dev`                Installs Composer and NPM dependencies, and creates `generateContent.js`.
- `composer prod`               Builds the project, generates the `.pot` file for translations, and removes unnecessary files and folders.

### NPM Scripts
- `npm run gulp`	    Runs Gulp with the provided gulpfile.js.
- `npm run compile:rtl`	Generates an RTL stylesheet using rtlcss.
- `npm run js`	        Executes the Gulp js task.
- `npm run css`	        Executes the Gulp css task.
- `npm run fonts`	    Executes the Gulp fonts task.
- `npm run icons`	    Executes the Gulp icons task.
- `npm run start`	    Runs the default Gulp task (gulp).
- `npm run build`	    Executes the gulp build task.

Now you're ready to go! The next step is easy to say, but harder to do: make an awesome WordPress theme. :)

Good luck!
