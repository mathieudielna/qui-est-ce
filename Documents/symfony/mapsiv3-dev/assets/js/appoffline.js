/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.scss');
require('../css/style.css');
require('../css/mystyle.css');


// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// const $ = require('jquery');
var $ = require('jquery');
global.$ = global.jQuery = $;


require('bootstrap');

require('select2');
$('select').select2()

window.jQuery = $;

window.JSZip = require('jszip')

import'pdfmake';
import'jquery-ui';
import'jquery-confirm';


console.log('Webpack offline is on');

