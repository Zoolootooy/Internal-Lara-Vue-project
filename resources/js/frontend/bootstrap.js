window._ = require('lodash');

window.Popper = require('popper.js').default;

window.$ = window.jQuery = require('jquery');

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

require('bootstrap');
require('jquery.easing');
require('owl.carousel');
require('bootstrap4-datetimepicker');
require('../libraries/datetimepicker');

window.Vue = require('vue');