/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.scss');
require('../css/stylev2.css');


// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// const $ = require('jquery');
var $ = require('jquery');
global.$ = global.jQuery = $;

var $select2glob = require('select2');
global.$select2glob = global.select2glob = $select2glob;
$('select').select2()

require('bootstrap');

window.jQuery = $;

window.JSZip = require('jszip')

var $sparkline = require('jquery-sparkline/jquery.sparkline.min.js');
global.$sparkline = global.sparkline = $sparkline;
$('.sparklines').sparkline('html', { enableTagOptions: true })

import'pdfmake';
import'jquery-ui';
import'jquery-confirm';

import'datatables.net-bs4';
import'datatables.net-buttons-bs4';
import'datatables.net-buttons/js/buttons.colVis.js';
import'datatables.net-buttons/js/buttons.flash.js';
import'datatables.net-buttons/js/buttons.html5.js';
import'datatables.net-buttons/js/buttons.print.js';
import'datatables.net-select-bs4';
import'datatables.net-responsive';
import'datatables.net-colreorder-bs4';
import'datatables.net-fixedheader-bs4';
import'chart.js';
import'ion-rangeslider';
import'responsive-bootstrap-tabs';

require('./switch');
// require('./bpm');
// require('./datatableaction');
// require('./datatableminiaction');
// require('./datatabletache');
// require('./datatableprojet');
// require('./datatableobjectif');
// require('./datatableprogramme');
// require('./datatableaudit');
// require('./datatableprocessus');
// require('./datatableactivite');
// require('./datatableflux');
// require('./datatableom');
// require('./datatablesysteme');
// require('./datatableapplication');
// require('./datatabledysfonctionnement');
// require('./datatableaspectenv');
// require('./datatablevisite');
// require('./datatablereclamation');
// require('./datatableswitcher');

require('./workflowbutton');
require('./jquery-confirm-trigger');
require('./activetabstate');
require('./leafletmap');
require('./ajaxloader');
require('./aes');



console.log('Webpack encore is on');



