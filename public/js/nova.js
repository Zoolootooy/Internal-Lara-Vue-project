/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/nova.js":
/*!******************************!*\
  !*** ./resources/js/nova.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

/*$.fn.triggerInput = function (eventName) {
    return this.each(function () {
        let el = $(this).get(0);
        if (el.fireEvent) {
            (el.fireEvent('on' + eventName));
        } else {
            let evt = document.createEvent('Events');
            evt.initEvent(eventName, true, false);
            el.dispatchEvent(evt);
        }
    });
};

$(document).ready(function() {
    $('body').delegate('#name, #link_name', 'change', function() {
        let slug = $('#slug');

        if (slug.val() != '') {
            return true;
        }

        slug.val($(this).val()
            .toLowerCase()
            .replace(/ /g, '-')
            .replace(/ˆ-+|-+$/g, ''))
            .triggerInput('input');
    });
});

Nova.$on('resources-loaded', function () {
    $('.flex-wrap .border-b').css('display', 'block');
    $('.card').before($('.flex-wrap'));
});*/
window.onload = function () {
  document.body.onchange = function (event) {
    var element = event.target,
        slug = document.getElementById('slug'),
        inputEvent = new Event("input");

    if ((element.id === 'name' || element.id === 'link_name') && slug.value === '') {
      slug.value = element.value.toLowerCase().replace(/ /g, '-').replace(/ˆ-+|-+$/g, '');
      slug.dispatchEvent(inputEvent);
    }
  };
};

Nova.$on('resources-loaded', function () {
  var filter = document.getElementsByClassName('flex-wrap')[0],
      card = document.getElementsByClassName('card')[0],
      border = document.getElementsByClassName('border-b')[0],
      parentCard = card.parentNode;
  filter.style = 'display: block';
  border.style = 'display: block';
  parentCard.insertBefore(filter, card);
});

/***/ }),

/***/ "./resources/scss/app-dark.scss":
/*!**************************************!*\
  !*** ./resources/scss/app-dark.scss ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/scss/app-rtl.scss":
/*!*************************************!*\
  !*** ./resources/scss/app-rtl.scss ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/scss/app.scss":
/*!*********************************!*\
  !*** ./resources/scss/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/scss/frontend.scss":
/*!**************************************!*\
  !*** ./resources/scss/frontend.scss ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/scss/icons.scss":
/*!***********************************!*\
  !*** ./resources/scss/icons.scss ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/scss/nova.scss":
/*!**********************************!*\
  !*** ./resources/scss/nova.scss ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*****************************************************************************************************************************************************************************************************************!*\
  !*** multi ./resources/js/nova.js ./resources/scss/icons.scss ./resources/scss/app-rtl.scss ./resources/scss/app.scss ./resources/scss/app-dark.scss ./resources/scss/nova.scss ./resources/scss/frontend.scss ***!
  \*****************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /var/www/lara7-cms/resources/js/nova.js */"./resources/js/nova.js");
__webpack_require__(/*! /var/www/lara7-cms/resources/scss/icons.scss */"./resources/scss/icons.scss");
__webpack_require__(/*! /var/www/lara7-cms/resources/scss/app-rtl.scss */"./resources/scss/app-rtl.scss");
__webpack_require__(/*! /var/www/lara7-cms/resources/scss/app.scss */"./resources/scss/app.scss");
__webpack_require__(/*! /var/www/lara7-cms/resources/scss/app-dark.scss */"./resources/scss/app-dark.scss");
__webpack_require__(/*! /var/www/lara7-cms/resources/scss/nova.scss */"./resources/scss/nova.scss");
module.exports = __webpack_require__(/*! /var/www/lara7-cms/resources/scss/frontend.scss */"./resources/scss/frontend.scss");


/***/ })

/******/ });