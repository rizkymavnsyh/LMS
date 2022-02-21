this["LP"] = this["LP"] || {}; this["LP"]["courses"] =
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
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./assets/src/apps/js/frontend/courses.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./assets/src/apps/js/frontend/courses.js":
/*!************************************************!*\
  !*** ./assets/src/apps/js/frontend/courses.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

//const { debounce } = lodash;
var lpArchiveAddQueryArgs = function lpArchiveAddQueryArgs(endpoint, args) {
  var url = new URL(endpoint);
  Object.keys(args).forEach(function (arg) {
    url.searchParams.append(arg, args[arg]);
  });
  return url;
};

var lpArchiveCourse = function lpArchiveCourse() {
  var elements = document.querySelectorAll('.lp-archive-course-skeleton');

  if (!elements.length) {
    return;
  }

  if ('IntersectionObserver' in window) {
    var eleObserver = new IntersectionObserver(function (entries, observer) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          var ele = entry.target;

          if (!lpArchiveSkeleton) {
            return;
          } //setTimeout( function() {


          lpArchiveRequestCourse(lpArchiveSkeleton); //}, 600 );

          eleObserver.unobserve(ele);
        }
      });
    });

    _toConsumableArray(elements).map(function (ele) {
      return eleObserver.observe(ele);
    });
  }
};

var skeleton;
var skeletonClone;
var isLoading = false;
var firstLoad = 1;

var lpArchiveRequestCourse = function lpArchiveRequestCourse(args) {
  var wpRestUrl = lpGlobalSettings.lp_rest_url;

  if (!wpRestUrl) {
    return;
  }

  var archive = document.querySelector('.lp-archive-courses');
  var archiveCourse = archive && archive.querySelector('div.lp-archive-courses .lp-content-area');
  var listCourse = archiveCourse && archiveCourse.querySelector('ul.learn-press-courses');

  if (!listCourse) {
    return;
  }

  if (isLoading) {
    return;
  }

  isLoading = true;

  if (!skeletonClone) {
    skeleton = document.querySelector('.lp-archive-course-skeleton');
    skeletonClone = skeleton.outerHTML;
  } else {
    listCourse.innerHTML = skeletonClone;
  }

  var urlCourseArchive = lpArchiveAddQueryArgs(wpRestUrl + 'lp/v1/courses/archive-course', _objectSpread({}, args));
  wp.apiFetch({
    path: 'lp/v1/courses/archive-course' + urlCourseArchive.search,
    method: 'GET'
  }).then(function (response) {
    if (typeof response.data.content !== 'undefined' && listCourse) {
      listCourse.innerHTML = response.data.content || '';
    }

    var pagination = response.data.pagination;
    lpArchiveSearchCourse();
    var paginationEle = document.querySelector('.learn-press-pagination');

    if (paginationEle) {
      paginationEle.remove();
    }

    if (typeof pagination !== 'undefined') {
      var paginationHTML = new DOMParser().parseFromString(pagination, 'text/html');
      var paginationNewNode = paginationHTML.querySelector('.learn-press-pagination'); //const paginationInnerHTML = paginationSelector && paginationSelector.innerHTML;

      if (paginationNewNode) {
        listCourse.after(paginationNewNode);
        lpArchivePaginationCourse();
      }
    }
  })["catch"](function (error) {
    listCourse.innerHTML += "<div class=\"lp-ajax-message error\" style=\"display:block\">".concat(error.message || 'Error: Query lp/v1/courses/archive-course', "</div>");
  })["finally"](function () {
    isLoading = false;
    skeleton && skeleton.remove();
    jQuery('form.search-courses button').removeClass('loading'); //LPArchiveCourseInit();
    // Scroll to archive element

    if (!firstLoad) {
      archive.scrollIntoView();
    } else {
      firstLoad = 0;
    }
  });
};

var lpArchiveSearchCourse = function lpArchiveSearchCourse() {
  var searchForm = document.querySelectorAll('form.search-courses');
  searchForm.forEach(function (s) {
    var search = s.querySelector('input[name="s"]');
    var action = s.getAttribute('action');
    var postType = s.querySelector('[name="post_type"]').value || '';
    var taxonomy = s.querySelector('[name="taxonomy"]').value || '';
    var termID = s.querySelector('[name="term_id"]').value || '';
    var btn = s.querySelector('[type="submit"]');
    var timeOutSearch;
    search.addEventListener('keyup', function (event) {
      event.preventDefault();
      var s = event.target.value;

      if (!s || s && s.length > 2) {
        if (undefined !== timeOutSearch) {
          clearTimeout(timeOutSearch);
        }

        timeOutSearch = setTimeout(function () {
          btn.classList.add('loading');
          delete lpArchiveSkeleton.paged;
          lpArchiveRequestCourse(_objectSpread(_objectSpread({}, lpArchiveSkeleton), {}, {
            s: s
          }));
          var url = lpArchiveAddQueryArgs(action, {
            post_type: postType,
            taxonomy: taxonomy,
            term_id: termID,
            s: s
          });
          window.history.pushState('', '', url);
        }, 800);
      }
    });
    s.addEventListener('submit', function (e) {
      e.preventDefault();
      var eleSearch = s.querySelector('input[name="s"]');
      eleSearch && eleSearch.dispatchEvent(new Event('keyup'));
    });
  });
};

var lpArchivePaginationCourse = function lpArchivePaginationCourse() {
  var paginationEle = document.querySelectorAll('.lp-archive-courses .learn-press-pagination .page-numbers');
  paginationEle.length > 0 && paginationEle.forEach(function (ele) {
    return ele.addEventListener('click', function (event) {
      event.preventDefault();
      event.stopPropagation();
      var urlString = event.currentTarget.getAttribute('href');

      if (urlString) {
        var url = new URL(urlString);
        var params = {};
        url.searchParams.forEach(function (key, value) {
          params[value] = key;
        });

        var current = _toConsumableArray(paginationEle).filter(function (el) {
          return el.classList.contains('current');
        });

        var paged = event.currentTarget.textContent || ele.classList.contains('next') && parseInt(current[0].textContent) + 1 || ele.classList.contains('prev') && parseInt(current[0].textContent) - 1;
        lpArchiveRequestCourse(_objectSpread(_objectSpread({}, params), {}, {
          paged: paged
        }));
        window.history.pushState('', '', urlString);
      }
    });
  });
};

var lpArchiveGridListCourse = function lpArchiveGridListCourse() {
  var layout = LP.Cookies.get('courses-layout');
  var switches = document.querySelectorAll('.lp-courses-bar .switch-layout [name="lp-switch-layout-btn"]');
  switches.length > 0 && _toConsumableArray(switches).map(function (ele) {
    return ele.value === layout && (ele.checked = true);
  });
};

var lpArchiveGridListCourseHandle = function lpArchiveGridListCourseHandle() {
  var gridList = document.querySelectorAll('.lp-archive-courses input[name="lp-switch-layout-btn"]');
  gridList.length > 0 && gridList.forEach(function (element) {
    return element.addEventListener('change', function (e) {
      e.preventDefault();
      var layout = e.target.value;

      if (layout) {
        var dataLayout = document.querySelector('.lp-archive-courses .learn-press-courses[data-layout]');
        dataLayout && (dataLayout.dataset.layout = layout);
        LP.Cookies.set('courses-layout', layout);
      }
    });
  });
};

function LPArchiveCourseInit() {
  lpArchiveCourse();
  lpArchiveGridListCourseHandle();
  lpArchiveGridListCourse();
} //document.addEventListener( 'DOMContentLoaded', function( event ) {


LPArchiveCourseInit(); //} );

/***/ })

/******/ });
//# sourceMappingURL=courses.js.map