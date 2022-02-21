this["LP"] = this["LP"] || {}; this["LP"]["singleCourse"] =
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
/******/ 	return __webpack_require__(__webpack_require__.s = "./assets/src/apps/js/frontend/single-course.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./assets/src/apps/js/frontend/show-lp-overlay-complete-item.js":
/*!**********************************************************************!*\
  !*** ./assets/src/apps/js/frontend/show-lp-overlay-complete-item.js ***!
  \**********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../utils/lp-modal-overlay */ "./assets/src/apps/js/utils/lp-modal-overlay.js");
var $ = jQuery;

var lpModalOverlayCompleteItem = {
  elBtnFinishCourse: null,
  elBtnCompleteItem: null,
  init: function init() {
    if (!_utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].init()) {
      return;
    }

    if (undefined === lpGlobalSettings || 'yes' !== lpGlobalSettings.option_enable_popup_confirm_finish) {
      return;
    }

    this.elBtnFinishCourse = document.querySelectorAll('.lp-btn-finish-course');
    this.elBtnCompleteItem = document.querySelector('.lp-btn-complete-item');

    if (this.elBtnCompleteItem) {
      this.elBtnCompleteItem.addEventListener('click', function (e) {
        e.preventDefault();
        var form = e.target.closest('form');
        _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elLPOverlay.show();
        _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].setTitleModal(form.dataset.title);
        _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].setContentModal('<div class="pd-2em">' + form.dataset.confirm + '</div>');

        _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].callBackYes = function () {
          form.submit();
        };
      });
    }

    if (this.elBtnFinishCourse) {
      this.elBtnFinishCourse.forEach(function (element) {
        return element.addEventListener('click', function (e) {
          e.preventDefault();
          var form = e.target.closest('form');
          _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elLPOverlay.show();
          _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].setTitleModal(form.dataset.title);
          _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].setContentModal('<div class="pd-2em">' + form.dataset.confirm + '</div>');

          _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].callBackYes = function () {
            form.submit();
          };
        });
      });
    }
  }
};
/* harmony default export */ __webpack_exports__["default"] = (lpModalOverlayCompleteItem);

/***/ }),

/***/ "./assets/src/apps/js/frontend/single-course.js":
/*!******************************************************!*\
  !*** ./assets/src/apps/js/frontend/single-course.js ***!
  \******************************************************/
/*! exports provided: default, init, initCourseTabs, initCourseSidebar, enrollCourse */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "init", function() { return init; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initCourseTabs", function() { return initCourseTabs; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initCourseSidebar", function() { return initCourseSidebar; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "enrollCourse", function() { return enrollCourse; });
/* harmony import */ var _single_course_index__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./single-course/index */ "./assets/src/apps/js/frontend/single-course/index.js");
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/url */ "@wordpress/url");
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_url__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _show_lp_overlay_complete_item__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./show-lp-overlay-complete-item */ "./assets/src/apps/js/frontend/show-lp-overlay-complete-item.js");
/* harmony import */ var _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../utils/lp-modal-overlay */ "./assets/src/apps/js/utils/lp-modal-overlay.js");
/* harmony import */ var _single_curriculum_skeleton__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./single-curriculum/skeleton */ "./assets/src/apps/js/frontend/single-curriculum/skeleton.js");
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }






/* harmony default export */ __webpack_exports__["default"] = (_single_course_index__WEBPACK_IMPORTED_MODULE_0__["default"]);
var init = function init() {
  wp.element.render( /*#__PURE__*/React.createElement(_single_course_index__WEBPACK_IMPORTED_MODULE_0__["default"], null));
};
var $ = jQuery;

var initCourseTabs = function initCourseTabs() {
  $('#learn-press-course-tabs').on('change', 'input[name="learn-press-course-tab-radio"]', function (e) {
    var selectedTab = $('input[name="learn-press-course-tab-radio"]:checked').val();
    LP.Cookies.set('course-tab', selectedTab);
    $('label[for="' + $(e.target).attr('id') + '"]').closest('li').addClass('active').siblings().removeClass('active');
  });
};

var initCourseSidebar = function initCourseSidebar() {
  var $sidebar = $('.course-summary-sidebar');

  if (!$sidebar.length) {
    return;
  }

  var $window = $(window);
  var $scrollable = $sidebar.children();
  var offset = $sidebar.offset();
  var scrollTop = 0;
  var maxHeight = $sidebar.height();
  var scrollHeight = $scrollable.height();
  var options = {
    offsetTop: 32
  };

  var onScroll = function onScroll() {
    scrollTop = $window.scrollTop();
    var top = scrollTop - offset.top + options.offsetTop;

    if (top < 0) {
      $sidebar.removeClass('slide-top slide-down');
      $scrollable.css('top', '');
      return;
    }

    if (top > maxHeight - scrollHeight) {
      $sidebar.removeClass('slide-down').addClass('slide-top');
      $scrollable.css('top', maxHeight - scrollHeight);
    } else {
      $sidebar.removeClass('slide-top').addClass('slide-down');
      $scrollable.css('top', options.offsetTop);
    }
  };

  $window.on('scroll.fixed-course-sidebar', onScroll).trigger('scroll.fixed-course-sidebar');
}; // Rest API Enroll course - Nhamdv.


var enrollCourse = function enrollCourse() {
  var formEnrolls = document.querySelectorAll('form.enroll-course');

  if (formEnrolls.length > 0) {
    formEnrolls.forEach(function (formEnroll) {
      var submit = /*#__PURE__*/function () {
        var _ref = _asyncToGenerator( /*#__PURE__*/regeneratorRuntime.mark(function _callee(id, btnEnroll) {
          var response, status, redirect, message;
          return regeneratorRuntime.wrap(function _callee$(_context) {
            while (1) {
              switch (_context.prev = _context.next) {
                case 0:
                  _context.prev = 0;
                  _context.next = 3;
                  return wp.apiFetch({
                    path: 'lp/v1/courses/enroll-course',
                    method: 'POST',
                    data: {
                      id: id
                    }
                  });

                case 3:
                  response = _context.sent;
                  btnEnroll.classList.remove('loading');
                  btnEnroll.disabled = false;
                  status = response.status, redirect = response.data.redirect, message = response.message;

                  if (message && status) {
                    btnEnroll.style.display = 'none';
                    formEnroll.innerHTML += "<div class=\"lp-enroll-notice ".concat(status, "\">").concat(message, "</div>");

                    if (redirect) {
                      window.location.href = redirect;
                    }
                  }

                  _context.next = 13;
                  break;

                case 10:
                  _context.prev = 10;
                  _context.t0 = _context["catch"](0);
                  form.innerHTML += "<div class=\"lp-enroll-notice error\">".concat(_context.t0.message && _context.t0.message, "</div>");

                case 13:
                case "end":
                  return _context.stop();
              }
            }
          }, _callee, null, [[0, 10]]);
        }));

        return function submit(_x, _x2) {
          return _ref.apply(this, arguments);
        };
      }();

      formEnroll.addEventListener('submit', function (event) {
        event.preventDefault();
        var id = formEnroll.querySelector('input[name=enroll-course]').value;
        var btnEnroll = formEnroll.querySelector('button.button-enroll-course');
        btnEnroll.classList.add('loading');
        btnEnroll.disabled = true;
        submit(id, btnEnroll);
      });
    });
  } // Reload when press back button in chrome.


  if (document.querySelector('.course-detail-info') !== null) {
    window.addEventListener('pageshow', function (event) {
      var hasCache = event.persisted || typeof window.performance != 'undefined' && String(window.performance.getEntriesByType('navigation')[0].type) == 'back_forward';

      if (hasCache) {
        location.reload();
      }
    });
  }
}; // Rest API purchase course - Nhamdv.


var purchaseCourse = function purchaseCourse() {
  var forms = document.querySelectorAll('form.purchase-course');

  if (forms.length > 0) {
    forms.forEach(function (form) {
      // Allow Repurchase.
      var allowRepurchase = function allowRepurchase() {
        var continueRepurchases = document.querySelectorAll('.lp_allow_repuchase_select');
        continueRepurchases.forEach(function (repurchase) {
          var radios = repurchase.querySelectorAll('[name=_lp_allow_repurchase_type]');

          for (var i = 0, length = radios.length; i < length; i++) {
            if (radios[i].checked) {
              var repurchaseType = radios[i].value;
              var id = form.querySelector('input[name=purchase-course]').value;
              var btnBuynow = form.querySelector('button.button-purchase-course');
              btnBuynow.classList.add('loading');
              btnBuynow.disabled = true;
              submit(id, btnBuynow, repurchaseType);
              break;
            }
          }
        });
      };

      var submit = /*#__PURE__*/function () {
        var _ref2 = _asyncToGenerator( /*#__PURE__*/regeneratorRuntime.mark(function _callee2(id, btn) {
          var repurchaseType,
              response,
              status,
              _response$data,
              redirect,
              type,
              html,
              titlePopup,
              message,
              _args2 = arguments;

          return regeneratorRuntime.wrap(function _callee2$(_context2) {
            while (1) {
              switch (_context2.prev = _context2.next) {
                case 0:
                  repurchaseType = _args2.length > 2 && _args2[2] !== undefined ? _args2[2] : false;
                  _context2.prev = 1;
                  _context2.next = 4;
                  return wp.apiFetch({
                    path: 'lp/v1/courses/purchase-course',
                    method: 'POST',
                    data: {
                      id: id,
                      repurchaseType: repurchaseType
                    }
                  });

                case 4:
                  response = _context2.sent;

                  if (btn) {
                    btn.classList.remove('loading');
                    btn.disabled = false;
                  }

                  status = response.status, _response$data = response.data, redirect = _response$data.redirect, type = _response$data.type, html = _response$data.html, titlePopup = _response$data.titlePopup, message = response.message;

                  if (!(type === 'allow_repurchase' && status === 'success')) {
                    _context2.next = 17;
                    break;
                  }

                  if (form.querySelector('.lp_allow_repuchase_select')) {
                    _context2.next = 15;
                    break;
                  }

                  if (_utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_3__["default"].init()) {
                    _context2.next = 11;
                    break;
                  }

                  return _context2.abrupt("return");

                case 11:
                  _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_3__["default"].elLPOverlay.show();
                  _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_3__["default"].setTitleModal(titlePopup || '');
                  _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_3__["default"].setContentModal(html);

                  _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_3__["default"].callBackYes = function () {
                    _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_3__["default"].elLPOverlay.hide();
                    allowRepurchase();
                  };

                case 15:
                  _context2.next = 18;
                  break;

                case 17:
                  if (message && status) {
                    form.innerHTML += "<div class=\"lp-enroll-notice ".concat(status, "\">").concat(message, "</div>");

                    if ('success' === status && redirect) {
                      window.location.href = redirect;
                    }
                  }

                case 18:
                  _context2.next = 23;
                  break;

                case 20:
                  _context2.prev = 20;
                  _context2.t0 = _context2["catch"](1);
                  form.innerHTML += "<div class=\"lp-enroll-notice error\">".concat(_context2.t0.message && _context2.t0.message, "</div>");

                case 23:
                case "end":
                  return _context2.stop();
              }
            }
          }, _callee2, null, [[1, 20]]);
        }));

        return function submit(_x3, _x4) {
          return _ref2.apply(this, arguments);
        };
      }();

      form.addEventListener('submit', function (event) {
        event.preventDefault();
        var id = form.querySelector('input[name=purchase-course]').value;
        var btn = form.querySelector('button.button-purchase-course');
        btn.classList.add('loading');
        btn.disabled = true;
        submit(id, btn);
      });
    });
  }
};

var retakeCourse = function retakeCourse() {
  var elFormRetakeCourses = document.querySelectorAll('.lp-form-retake-course');

  if (!elFormRetakeCourses.length) {
    return;
  }

  elFormRetakeCourses.forEach(function (elFormRetakeCourse) {
    var elButtonRetakeCourses = elFormRetakeCourse.querySelector('.button-retake-course');
    var elCourseId = elFormRetakeCourse.querySelector('[name=retake-course]').value;
    var elAjaxMessage = elFormRetakeCourse.querySelector('.lp-ajax-message');

    var submit = function submit(elButtonRetakeCourse) {
      wp.apiFetch({
        path: '/lp/v1/courses/retake-course',
        method: 'POST',
        data: {
          id: elCourseId
        }
      }).then(function (res) {
        var status = res.status,
            message = res.message,
            data = res.data;
        elAjaxMessage.innerHTML = message;

        if (undefined != status && status === 'success') {
          elButtonRetakeCourse.style.display = 'none';
          setTimeout(function () {
            window.location.replace(data.url_redirect);
          }, 1000);
        } else {
          elAjaxMessage.classList.add('error');
        }
      })["catch"](function (err) {
        elAjaxMessage.classList.add('error');
        elAjaxMessage.innerHTML = 'error: ' + err.message;
      }).then(function () {
        elButtonRetakeCourse.classList.remove('loading');
        elButtonRetakeCourse.disabled = false;
        elAjaxMessage.style.display = 'block';
      });
    };

    elFormRetakeCourse.addEventListener('submit', function (e) {
      e.preventDefault();
    });
    elButtonRetakeCourses.addEventListener('click', function (e) {
      e.preventDefault();
      elButtonRetakeCourses.classList.add('loading');
      elButtonRetakeCourses.disabled = true;
      submit(elButtonRetakeCourses);
    });
  });
}; // Rest API load content course progress - Nhamdv.


var courseProgress = function courseProgress() {
  var elements = document.querySelectorAll('.lp-course-progress-wrapper');

  if (!elements.length) {
    return;
  }

  if ('IntersectionObserver' in window) {
    var eleObserver = new IntersectionObserver(function (entries, observer) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          var ele = entry.target;
          setTimeout(function () {
            getResponse(ele);
          }, 600);
          eleObserver.unobserve(ele);
        }
      });
    });

    _toConsumableArray(elements).map(function (ele) {
      return eleObserver.observe(ele);
    });
  }

  var getResponse = /*#__PURE__*/function () {
    var _ref3 = _asyncToGenerator( /*#__PURE__*/regeneratorRuntime.mark(function _callee3(ele) {
      var response, data;
      return regeneratorRuntime.wrap(function _callee3$(_context3) {
        while (1) {
          switch (_context3.prev = _context3.next) {
            case 0:
              _context3.next = 2;
              return wp.apiFetch({
                path: 'lp/v1/lazy-load/course-progress',
                method: 'POST',
                data: {
                  courseId: lpGlobalSettings.post_id || '',
                  userId: lpGlobalSettings.user_id || ''
                }
              });

            case 2:
              response = _context3.sent;
              data = response.data;
              ele.innerHTML = data;

            case 5:
            case "end":
              return _context3.stop();
          }
        }
      }, _callee3);
    }));

    return function getResponse(_x5) {
      return _ref3.apply(this, arguments);
    };
  }();
};

var accordionExtraTab = function accordionExtraTab() {
  var elements = document.querySelectorAll('.course-extra-box');

  _toConsumableArray(elements).map(function (ele) {
    var title = ele.querySelector('.course-extra-box__title');
    title.addEventListener('click', function () {
      var panel = title.nextElementSibling;
      var eleActive = document.querySelector('.course-extra-box.active');

      if (eleActive && !ele.classList.contains('active')) {
        eleActive.classList.remove('active');
        eleActive.querySelector('.course-extra-box__content').style.display = 'none';
      }

      if (!ele.classList.contains('active')) {
        ele.classList.add('active');
        panel.style.display = 'block';
      } else {
        ele.classList.remove('active');
        panel.style.display = 'none';
      }
    });
  });
};

var courseContinue = function courseContinue() {
  var formContinue = document.querySelector('form.continue-course');

  if (formContinue != null) {
    var getResponse = /*#__PURE__*/function () {
      var _ref4 = _asyncToGenerator( /*#__PURE__*/regeneratorRuntime.mark(function _callee4(ele) {
        var response;
        return regeneratorRuntime.wrap(function _callee4$(_context4) {
          while (1) {
            switch (_context4.prev = _context4.next) {
              case 0:
                _context4.next = 2;
                return wp.apiFetch({
                  path: 'lp/v1/courses/continue-course',
                  method: 'POST',
                  data: {
                    courseId: lpGlobalSettings.post_id || '',
                    userId: lpGlobalSettings.user_id || ''
                  }
                });

              case 2:
                response = _context4.sent;
                return _context4.abrupt("return", response);

              case 4:
              case "end":
                return _context4.stop();
            }
          }
        }, _callee4);
      }));

      return function getResponse(_x6) {
        return _ref4.apply(this, arguments);
      };
    }();

    getResponse(formContinue).then(function (result) {
      if (result.status === 'success') {
        formContinue.style.display = 'block';
        formContinue.action = result.data;
      }
    });
  }
};


$(window).on('load', function () {
  var $popup = $('#popup-course');
  var timerClearScroll;
  var $curriculum = $('#learn-press-course-curriculum');
  accordionExtraTab();
  initCourseTabs();
  initCourseSidebar();
  enrollCourse();
  purchaseCourse();
  retakeCourse();
  courseProgress();
  courseContinue();
  _show_lp_overlay_complete_item__WEBPACK_IMPORTED_MODULE_2__["default"].init();
  Object(_single_curriculum_skeleton__WEBPACK_IMPORTED_MODULE_4__["default"])();
});

/***/ }),

/***/ "./assets/src/apps/js/frontend/single-course/index.js":
/*!************************************************************!*\
  !*** ./assets/src/apps/js/frontend/single-course/index.js ***!
  \************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _learnpress_quiz__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @learnpress/quiz */ "@learnpress/quiz");
/* harmony import */ var _learnpress_quiz__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_learnpress_quiz__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _store__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./store */ "./assets/src/apps/js/frontend/single-course/store/index.js");
/* harmony import */ var _store__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_store__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _single_curriculum_components_sidebar__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../single-curriculum/components/sidebar */ "./assets/src/apps/js/frontend/single-curriculum/components/sidebar.js");
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); Object.defineProperty(subClass, "prototype", { writable: false }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } else if (call !== void 0) { throw new TypeError("Derived constructors may only return object or undefined"); } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }




 // Use toggle in Curriculum tab.

var SingleCourse = /*#__PURE__*/function (_Component) {
  _inherits(SingleCourse, _Component);

  var _super = _createSuper(SingleCourse);

  function SingleCourse() {
    _classCallCheck(this, SingleCourse);

    return _super.apply(this, arguments);
  }

  _createClass(SingleCourse, [{
    key: "render",
    value: function render() {
      return /*#__PURE__*/React.createElement(React.Fragment, null);
    }
  }]);

  return SingleCourse;
}(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["Component"]);

/* harmony default export */ __webpack_exports__["default"] = (SingleCourse);

function run() {
  Object(_single_curriculum_components_sidebar__WEBPACK_IMPORTED_MODULE_3__["Sidebar"])();
}

document.addEventListener('DOMContentLoaded', function () {
  run();
});

/***/ }),

/***/ "./assets/src/apps/js/frontend/single-course/store/index.js":
/*!******************************************************************!*\
  !*** ./assets/src/apps/js/frontend/single-course/store/index.js ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * Created by tu on 9/19/19.
 */

/***/ }),

/***/ "./assets/src/apps/js/frontend/single-curriculum/components/search.js":
/*!****************************************************************************!*\
  !*** ./assets/src/apps/js/frontend/single-curriculum/components/search.js ***!
  \****************************************************************************/
/*! exports provided: searchCourseContent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "searchCourseContent", function() { return searchCourseContent; });
var searchCourseContent = function searchCourseContent() {
  var popup = document.querySelector('#popup-course');
  var list = document.querySelector('#learn-press-course-curriculum');

  if (popup && list) {
    var items = list.querySelector('.curriculum-sections');
    var form = popup.querySelector('.search-course');
    var search = popup.querySelector('.search-course input[type="text"]');

    if (!search || !items || !form) {
      return;
    }

    var sections = items.querySelectorAll('li.section');
    var dataItems = items.querySelectorAll('li.course-item');
    var dataSearch = [];
    dataItems.forEach(function (item) {
      var itemID = item.dataset.id;
      var name = item.querySelector('.item-name');
      dataSearch.push({
        id: itemID,
        name: name ? name.textContent.toLowerCase() : ''
      });
    });

    var submit = function submit(event) {
      event.preventDefault();
      var inputVal = search.value;
      form.classList.add('searching');

      if (!inputVal) {
        form.classList.remove('searching');
      }

      var outputs = [];
      dataSearch.forEach(function (i) {
        if (!inputVal || i.name.match(inputVal.toLowerCase())) {
          outputs.push(i.id);
          dataItems.forEach(function (c) {
            if (outputs.indexOf(c.dataset.id) !== -1) {
              c.classList.remove('hide-if-js');
            } else {
              c.classList.add('hide-if-js');
            }
          });
        }
      });
      sections.forEach(function (section) {
        var listItem = section.querySelectorAll('.course-item');
        var isTrue = [];
        listItem.forEach(function (a) {
          if (outputs.includes(a.dataset.id)) {
            isTrue.push(a.dataset.id);
          }
        });

        if (isTrue.length === 0) {
          section.classList.add('hide-if-js');
        } else {
          section.classList.remove('hide-if-js');
        }
      });
    };

    var clear = form.querySelector('.clear');

    if (clear) {
      clear.addEventListener('click', function (e) {
        e.preventDefault();
        search.value = '';
        submit(e);
      });
    }

    form.addEventListener('submit', submit);
    search.addEventListener('keyup', submit);
  }
};

/***/ }),

/***/ "./assets/src/apps/js/frontend/single-curriculum/components/sidebar.js":
/*!*****************************************************************************!*\
  !*** ./assets/src/apps/js/frontend/single-curriculum/components/sidebar.js ***!
  \*****************************************************************************/
/*! exports provided: Sidebar */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "Sidebar", function() { return Sidebar; });
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

var $ = jQuery;
var _lodash = lodash,
    throttle = _lodash.throttle;
var Sidebar = function Sidebar() {
  // Tungnx - Show/hide sidebar curriculumn
  var elSidebarToggle = document.querySelector('#sidebar-toggle'); // For style of theme

  var toggleSidebar = function toggleSidebar(toggle) {
    $('body').removeClass('lp-sidebar-toggle__open');
    $('body').removeClass('lp-sidebar-toggle__close');

    if (toggle) {
      $('body').addClass('lp-sidebar-toggle__close');
    } else {
      $('body').addClass('lp-sidebar-toggle__open');
    }
  }; // For lp and theme


  if (elSidebarToggle) {
    if ($(window).innerWidth() <= 768) {
      elSidebarToggle.setAttribute('checked', 'checked');
    } else if (LP.Cookies.get('sidebar-toggle')) {
      elSidebarToggle.setAttribute('checked', 'checked');
    } else {
      elSidebarToggle.removeAttribute('checked');
    }

    document.querySelector('#popup-course').addEventListener('click', function (e) {
      if (e.target.id === 'sidebar-toggle') {
        LP.Cookies.set('sidebar-toggle', e.target.checked ? true : false);
        toggleSidebar(LP.Cookies.get('sidebar-toggle'));
      }
    });
  } // End editor by tungnx


  var $curriculum = $('#learn-press-course-curriculum');
  $curriculum.find('.section-desc').each(function (i, el) {
    var a = $('<span class="show-desc"></span>').on('click', function () {
      b.toggleClass('c');
    });
    var b = $(el).siblings('.section-title').append(a);
  });
  $('.section').each(function () {
    var $section = $(this),
        $toggle = $section.find('.section-left');
    $toggle.on('click', function () {
      var isClose = $section.toggleClass('closed').hasClass('closed');
      var sections = LP.Cookies.get('closed-section-' + lpGlobalSettings.post_id) || [];
      var sectionId = parseInt($section.data('section-id'));
      var at = sections.findIndex(function (id) {
        return id == sectionId;
      });

      if (isClose) {
        sections.push(parseInt($section.data('section-id')));
      } else {
        sections.splice(at, 1);
      }

      LP.Cookies.remove('closed-section-(.*)');
      LP.Cookies.set('closed-section-' + lpGlobalSettings.post_id, _toConsumableArray(new Set(sections)));
    });
  });
};

/***/ }),

/***/ "./assets/src/apps/js/frontend/single-curriculum/scrolltoitem.js":
/*!***********************************************************************!*\
  !*** ./assets/src/apps/js/frontend/single-curriculum/scrolltoitem.js ***!
  \***********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../utils/lp-modal-overlay */ "./assets/src/apps/js/utils/lp-modal-overlay.js");

var $ = jQuery;
var scrollToItemCurrent = {
  init: function init() {
    this.scrollToItemViewing = function () {
      var elItemViewing = $('.viewing-course-item');

      if (elItemViewing.length) {
        var elCourseCurriculumn = $('#learn-press-course-curriculum');
        var heightCourseItemContentHeader = $('#popup-sidebar').outerHeight();
        var heightSectionTitle = $('.section-title').outerHeight();
        var heightSectionHeader = $('.section-header').outerHeight();
        var regex = new RegExp('^viewing-course-item-([0-9].*)');
        var classList = elItemViewing.attr('class');
        var classArr = classList.split(/\s+/);
        var idItem = 0;
        $.each(classArr, function (i, className) {
          var compare = regex.exec(className);

          if (compare) {
            idItem = compare[1];
            return false;
          }
        });

        if (0 === idItem) {
          return;
        }

        var elItemCurrent = $('.course-item-' + idItem);
        var offSetTop = elItemCurrent.offset().top;
        var offset = elItemCurrent.offset().top - elCourseCurriculumn.offset().top + elCourseCurriculumn.scrollTop();
        elCourseCurriculumn.animate({
          scrollTop: offset - heightSectionHeader
        }, 800);
      }
    };

    this.scrollToItemViewing();
  }
};
/* harmony default export */ __webpack_exports__["default"] = (scrollToItemCurrent);

/***/ }),

/***/ "./assets/src/apps/js/frontend/single-curriculum/skeleton.js":
/*!*******************************************************************!*\
  !*** ./assets/src/apps/js/frontend/single-curriculum/skeleton.js ***!
  \*******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return courseCurriculumSkeleton; });
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/url */ "@wordpress/url");
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_url__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/api-fetch */ "@wordpress/api-fetch");
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _scrolltoitem__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./scrolltoitem */ "./assets/src/apps/js/frontend/single-curriculum/scrolltoitem.js");
/* harmony import */ var _components_search__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./components/search */ "./assets/src/apps/js/frontend/single-curriculum/components/search.js");
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

// Rest API load content in Tab Curriculum - Nhamdv.




function courseCurriculumSkeleton() {
  var Sekeleton = function Sekeleton() {
    var elementCurriculum = document.querySelector('.learnpress-course-curriculum');

    if (!elementCurriculum) {
      return;
    }

    getResponse(elementCurriculum);
  };

  var getResponse = /*#__PURE__*/function () {
    var _ref = _asyncToGenerator( /*#__PURE__*/regeneratorRuntime.mark(function _callee(ele) {
      var skeleton, itemID, sectionID, page, response, data, status, message, section_ids, returnData, response2, data2, pages2, page2;
      return regeneratorRuntime.wrap(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              skeleton = ele.querySelector('.lp-skeleton-animation');
              itemID = ele.dataset.id;
              sectionID = ele.dataset.section;
              _context.prev = 3;
              page = 1;
              _context.next = 7;
              return _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_1___default()({
                path: Object(_wordpress_url__WEBPACK_IMPORTED_MODULE_0__["addQueryArgs"])('lp/v1/lazy-load/course-curriculum', {
                  courseId: lpGlobalSettings.post_id || '',
                  page: page,
                  sectionID: sectionID || ''
                }),
                method: 'GET'
              });

            case 7:
              response = _context.sent;
              data = response.data, status = response.status, message = response.message, section_ids = response.section_ids;

              if (!(status === 'error')) {
                _context.next = 11;
                break;
              }

              throw new Error(message || 'Error');

            case 11:
              returnData = data;

              if (!sectionID) {
                _context.next = 27;
                break;
              }

              if (!(section_ids && !section_ids.includes(sectionID))) {
                _context.next = 23;
                break;
              }

              _context.next = 16;
              return getResponsive('', page + 1, sectionID);

            case 16:
              response2 = _context.sent;

              if (!response2) {
                _context.next = 21;
                break;
              }

              data2 = response2.data2, pages2 = response2.pages2, page2 = response2.page2;
              _context.next = 21;
              return parseContentItems({
                ele: ele,
                returnData: returnData,
                sectionID: sectionID,
                itemID: itemID,
                data2: data2,
                pages2: pages2,
                page2: page2
              });

            case 21:
              _context.next = 25;
              break;

            case 23:
              _context.next = 25;
              return parseContentItems({
                ele: ele,
                returnData: returnData,
                sectionID: sectionID,
                itemID: itemID
              });

            case 25:
              _context.next = 28;
              break;

            case 27:
              returnData && ele.insertAdjacentHTML('beforeend', returnData);

            case 28:
              _context.next = 33;
              break;

            case 30:
              _context.prev = 30;
              _context.t0 = _context["catch"](3);
              ele.insertAdjacentHTML('beforeend', "<div class=\"lp-ajax-message error\" style=\"display:block\">".concat(_context.t0.message || 'Error: Query lp/v1/lazy-load/course-curriculum', "</div>"));

            case 33:
              skeleton && skeleton.remove();
              Object(_components_search__WEBPACK_IMPORTED_MODULE_3__["searchCourseContent"])();

            case 35:
            case "end":
              return _context.stop();
          }
        }
      }, _callee, null, [[3, 30]]);
    }));

    return function getResponse(_x) {
      return _ref.apply(this, arguments);
    };
  }();

  var parseContentItems = /*#__PURE__*/function () {
    var _ref3 = _asyncToGenerator( /*#__PURE__*/regeneratorRuntime.mark(function _callee2(_ref2) {
      var ele, returnData, sectionID, itemID, data2, pages2, page2, parser, doc, sections, loadMoreBtn, section, items, item_ids, sectionContent, itemLoadMore, responseItem, data3, pages3, paged3;
      return regeneratorRuntime.wrap(function _callee2$(_context2) {
        while (1) {
          switch (_context2.prev = _context2.next) {
            case 0:
              ele = _ref2.ele, returnData = _ref2.returnData, sectionID = _ref2.sectionID, itemID = _ref2.itemID, data2 = _ref2.data2, pages2 = _ref2.pages2, page2 = _ref2.page2;
              parser = new DOMParser();
              doc = parser.parseFromString(returnData, 'text/html');

              if (data2) {
                sections = doc.querySelector('.curriculum-sections');
                loadMoreBtn = doc.querySelector('.curriculum-more__button');

                if (loadMoreBtn) {
                  if (pages2 <= page2) {
                    loadMoreBtn.remove();
                  } else {
                    loadMoreBtn.dataset.page = page2;
                  }
                }

                sections.insertAdjacentHTML('beforeend', data2);
              }

              section = doc.querySelector("[data-section-id=\"".concat(sectionID, "\"]"));

              if (!section) {
                _context2.next = 17;
                break;
              }

              items = section.querySelectorAll('.course-item');
              item_ids = _toConsumableArray(items).map(function (item) {
                return item.dataset.id;
              });
              sectionContent = section.querySelector('.section-content');
              itemLoadMore = section.querySelector('.section-item__loadmore');

              if (!(itemID && !item_ids.includes(itemID))) {
                _context2.next = 17;
                break;
              }

              _context2.next = 13;
              return getResponsiveItem('', 2, sectionID, itemID);

            case 13:
              responseItem = _context2.sent;
              data3 = responseItem.data3, pages3 = responseItem.pages3, paged3 = responseItem.paged3;

              if (pages3 <= paged3) {
                itemLoadMore.remove();
              } else {
                itemLoadMore.dataset.page = paged3;
              }

              if (data3 && sectionContent) {
                sectionContent.insertAdjacentHTML('beforeend', data3);
              }

            case 17:
              ele.insertAdjacentHTML('beforeend', doc.body.innerHTML);
              _scrolltoitem__WEBPACK_IMPORTED_MODULE_2__["default"].init();

            case 19:
            case "end":
              return _context2.stop();
          }
        }
      }, _callee2);
    }));

    return function parseContentItems(_x2) {
      return _ref3.apply(this, arguments);
    };
  }();

  var getResponsiveItem = /*#__PURE__*/function () {
    var _ref4 = _asyncToGenerator( /*#__PURE__*/regeneratorRuntime.mark(function _callee3(returnData, paged, sectionID, itemID) {
      var response, data, pages, status, message, item_ids;
      return regeneratorRuntime.wrap(function _callee3$(_context3) {
        while (1) {
          switch (_context3.prev = _context3.next) {
            case 0:
              _context3.next = 2;
              return _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_1___default()({
                path: Object(_wordpress_url__WEBPACK_IMPORTED_MODULE_0__["addQueryArgs"])('lp/v1/lazy-load/course-curriculum-items', {
                  sectionId: sectionID || '',
                  page: paged
                }),
                method: 'GET'
              });

            case 2:
              response = _context3.sent;
              data = response.data, pages = response.pages, status = response.status, message = response.message, item_ids = response.item_ids;

              if (!(status === 'success')) {
                _context3.next = 8;
                break;
              }

              returnData += data;

              if (!(sectionID && item_ids && itemID && !item_ids.includes(itemID))) {
                _context3.next = 8;
                break;
              }

              return _context3.abrupt("return", getResponsiveItem(returnData, paged + 1, sectionID, itemID));

            case 8:
              return _context3.abrupt("return", {
                data3: returnData,
                pages3: pages,
                paged3: paged,
                status3: status,
                message3: message
              });

            case 9:
            case "end":
              return _context3.stop();
          }
        }
      }, _callee3);
    }));

    return function getResponsiveItem(_x3, _x4, _x5, _x6) {
      return _ref4.apply(this, arguments);
    };
  }();

  var getResponsive = /*#__PURE__*/function () {
    var _ref5 = _asyncToGenerator( /*#__PURE__*/regeneratorRuntime.mark(function _callee4(returnData, page, sectionID) {
      var response, data, pages, status, message, section_ids;
      return regeneratorRuntime.wrap(function _callee4$(_context4) {
        while (1) {
          switch (_context4.prev = _context4.next) {
            case 0:
              _context4.next = 2;
              return _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_1___default()({
                path: Object(_wordpress_url__WEBPACK_IMPORTED_MODULE_0__["addQueryArgs"])('lp/v1/lazy-load/course-curriculum', {
                  courseId: lpGlobalSettings.post_id || '',
                  page: page,
                  sectionID: sectionID || '',
                  loadMore: true
                }),
                method: 'GET'
              });

            case 2:
              response = _context4.sent;
              data = response.data, pages = response.pages, status = response.status, message = response.message, section_ids = response.section_ids;

              if (!(status === 'success')) {
                _context4.next = 8;
                break;
              }

              returnData += data;

              if (!(sectionID && section_ids && !section_ids.includes(sectionID))) {
                _context4.next = 8;
                break;
              }

              return _context4.abrupt("return", getResponsive(returnData, page + 1, sectionID));

            case 8:
              return _context4.abrupt("return", {
                data2: returnData,
                pages2: pages,
                page2: page,
                status2: status,
                message2: message
              });

            case 9:
            case "end":
              return _context4.stop();
          }
        }
      }, _callee4);
    }));

    return function getResponsive(_x7, _x8, _x9) {
      return _ref5.apply(this, arguments);
    };
  }();

  Sekeleton();
  document.addEventListener('click', function (e) {
    var sectionBtns = document.querySelectorAll('.section-item__loadmore');

    _toConsumableArray(sectionBtns).map( /*#__PURE__*/function () {
      var _ref6 = _asyncToGenerator( /*#__PURE__*/regeneratorRuntime.mark(function _callee5(sectionBtn) {
        var sectionItem, sectionId, sectionContent, paged, response, data3, pages3, status3, message3;
        return regeneratorRuntime.wrap(function _callee5$(_context5) {
          while (1) {
            switch (_context5.prev = _context5.next) {
              case 0:
                if (!sectionBtn.contains(e.target)) {
                  _context5.next = 22;
                  break;
                }

                sectionItem = sectionBtn.parentNode;
                sectionId = sectionItem.getAttribute('data-section-id');
                sectionContent = sectionItem.querySelector('.section-content');
                paged = parseInt(sectionBtn.dataset.page);
                sectionBtn.classList.add('loading');
                _context5.prev = 6;
                _context5.next = 9;
                return getResponsiveItem('', paged + 1, sectionId, '');

              case 9:
                response = _context5.sent;
                data3 = response.data3, pages3 = response.pages3, status3 = response.status3, message3 = response.message3;

                if (!(status3 === 'error')) {
                  _context5.next = 13;
                  break;
                }

                throw new Error(message3 || 'Error');

              case 13:
                if (pages3 <= paged + 1) {
                  sectionBtn.remove();
                } else {
                  sectionBtn.dataset.page = paged + 1;
                }

                sectionContent.insertAdjacentHTML('beforeend', data3);
                _context5.next = 20;
                break;

              case 17:
                _context5.prev = 17;
                _context5.t0 = _context5["catch"](6);
                sectionContent.insertAdjacentHTML('beforeend', "<div class=\"lp-ajax-message error\" style=\"display:block\">".concat(_context5.t0.message || 'Error: Query lp/v1/lazy-load/course-curriculum', "</div>"));

              case 20:
                sectionBtn.classList.remove('loading');
                Object(_components_search__WEBPACK_IMPORTED_MODULE_3__["searchCourseContent"])();

              case 22:
              case "end":
                return _context5.stop();
            }
          }
        }, _callee5, null, [[6, 17]]);
      }));

      return function (_x10) {
        return _ref6.apply(this, arguments);
      };
    }()); // Load more Sections


    var moreSections = document.querySelectorAll('.curriculum-more__button');

    _toConsumableArray(moreSections).map( /*#__PURE__*/function () {
      var _ref7 = _asyncToGenerator( /*#__PURE__*/regeneratorRuntime.mark(function _callee6(moreSection) {
        var paged, sections, response2, data2, pages2, status2, message2;
        return regeneratorRuntime.wrap(function _callee6$(_context6) {
          while (1) {
            switch (_context6.prev = _context6.next) {
              case 0:
                if (!moreSection.contains(e.target)) {
                  _context6.next = 21;
                  break;
                }

                paged = parseInt(moreSection.dataset.page);
                sections = moreSection.parentNode.parentNode.querySelector('.curriculum-sections');

                if (!(paged && sections)) {
                  _context6.next = 21;
                  break;
                }

                moreSection.classList.add('loading');
                _context6.prev = 5;
                _context6.next = 8;
                return getResponsive('', paged + 1, '');

              case 8:
                response2 = _context6.sent;
                data2 = response2.data2, pages2 = response2.pages2, status2 = response2.status2, message2 = response2.message2;

                if (!(status2 === 'error')) {
                  _context6.next = 12;
                  break;
                }

                throw new Error(message2 || 'Error');

              case 12:
                if (pages2 <= paged + 1) {
                  moreSection.remove();
                } else {
                  moreSection.dataset.page = paged + 1;
                }

                sections.insertAdjacentHTML('beforeend', data2);
                _context6.next = 19;
                break;

              case 16:
                _context6.prev = 16;
                _context6.t0 = _context6["catch"](5);
                sections.insertAdjacentHTML('beforeend', "<div class=\"lp-ajax-message error\" style=\"display:block\">".concat(_context6.t0.message || 'Error: Query lp/v1/lazy-load/course-curriculum', "</div>"));

              case 19:
                moreSection.classList.remove('loading');
                Object(_components_search__WEBPACK_IMPORTED_MODULE_3__["searchCourseContent"])();

              case 21:
              case "end":
                return _context6.stop();
            }
          }
        }, _callee6, null, [[5, 16]]);
      }));

      return function (_x11) {
        return _ref7.apply(this, arguments);
      };
    }()); // Show/Hide accordion


    if (document.querySelector('.learnpress-course-curriculum')) {
      var sections = document.querySelectorAll('.section');

      _toConsumableArray(sections).map(function (section) {
        if (section.contains(e.target)) {
          var toggle = section.querySelector('.section-left');
          toggle.contains(e.target) && section.classList.toggle('closed');
        }
      });
    }
  });
}

/***/ }),

/***/ "./assets/src/apps/js/utils/lp-modal-overlay.js":
/*!******************************************************!*\
  !*** ./assets/src/apps/js/utils/lp-modal-overlay.js ***!
  \******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
var $ = jQuery;
var elLPOverlay = null;
var lpModalOverlay = {
  elLPOverlay: null,
  elMainContent: null,
  elTitle: null,
  elBtnYes: null,
  elBtnNo: null,
  elFooter: null,
  elCalledModal: null,
  callBackYes: null,
  instance: null,
  init: function init() {
    if (this.instance) {
      return true;
    }

    this.elLPOverlay = $('.lp-overlay');

    if (!this.elLPOverlay.length) {
      return false;
    }

    elLPOverlay = this.elLPOverlay;
    this.elMainContent = elLPOverlay.find('.main-content');
    this.elTitle = elLPOverlay.find('.modal-title');
    this.elBtnYes = elLPOverlay.find('.btn-yes');
    this.elBtnNo = elLPOverlay.find('.btn-no');
    this.elFooter = elLPOverlay.find('.lp-modal-footer');
    $(document).on('click', '.close, .btn-no', function () {
      elLPOverlay.hide();
    });
    $(document).on('click', '.btn-yes', function (e) {
      e.preventDefault();
      e.stopPropagation();

      if ('function' === typeof lpModalOverlay.callBackYes) {
        lpModalOverlay.callBackYes();
      }
    });
    this.instance = this;
    return true;
  },
  setElCalledModal: function setElCalledModal(elCalledModal) {
    this.elCalledModal = elCalledModal;
  },
  setContentModal: function setContentModal(content, event) {
    this.elMainContent.html(content);

    if ('function' === typeof event) {
      event();
    }
  },
  setTitleModal: function setTitleModal(content) {
    this.elTitle.html(content);
  }
};
/* harmony default export */ __webpack_exports__["default"] = (lpModalOverlay);

/***/ }),

/***/ "@learnpress/quiz":
/*!***************************************!*\
  !*** external {"this":["LP","quiz"]} ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = this["LP"]["quiz"]; }());

/***/ }),

/***/ "@wordpress/api-fetch":
/*!**********************************!*\
  !*** external ["wp","apiFetch"] ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = window["wp"]["apiFetch"]; }());

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = window["wp"]["element"]; }());

/***/ }),

/***/ "@wordpress/url":
/*!*****************************!*\
  !*** external ["wp","url"] ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = window["wp"]["url"]; }());

/***/ })

/******/ });
//# sourceMappingURL=single-course.js.map