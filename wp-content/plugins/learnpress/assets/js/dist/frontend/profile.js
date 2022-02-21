this["LP"] = this["LP"] || {}; this["LP"]["profile"] =
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
/******/ 	return __webpack_require__(__webpack_require__.s = "./assets/src/apps/js/frontend/profile.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./assets/src/apps/js/frontend/profile.js":
/*!************************************************!*\
  !*** ./assets/src/apps/js/frontend/profile.js ***!
  \************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _profile_course_tab__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./profile/course-tab */ "./assets/src/apps/js/frontend/profile/course-tab.js");
/* harmony import */ var _profile_statistic__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./profile/statistic */ "./assets/src/apps/js/frontend/profile/statistic.js");
/* harmony import */ var _profile_order_recover__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./profile/order-recover */ "./assets/src/apps/js/frontend/profile/order-recover.js");
/* harmony import */ var _profile_avatar__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./profile/avatar */ "./assets/src/apps/js/frontend/profile/avatar.js");




document.addEventListener('DOMContentLoaded', function (event) {
  Object(_profile_course_tab__WEBPACK_IMPORTED_MODULE_0__["default"])();
  Object(_profile_statistic__WEBPACK_IMPORTED_MODULE_1__["default"])();
  Object(_profile_order_recover__WEBPACK_IMPORTED_MODULE_2__["default"])();
});

if (document.getElementById('learnpress-avatar-upload')) {
  wp.element.render( /*#__PURE__*/React.createElement(_profile_avatar__WEBPACK_IMPORTED_MODULE_3__["default"], null), document.getElementById('learnpress-avatar-upload'));
}

/***/ }),

/***/ "./assets/src/apps/js/frontend/profile/avatar.js":
/*!*******************************************************!*\
  !*** ./assets/src/apps/js/frontend/profile/avatar.js ***!
  \*******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return Avatar; });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/api-fetch */ "@wordpress/api-fetch");
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var react_easy_crop__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! react-easy-crop */ "./node_modules/react-easy-crop/index.module.js");
function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }





function Avatar() {
  var _useState = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["useState"])(),
      _useState2 = _slicedToArray(_useState, 2),
      file = _useState2[0],
      setFile = _useState2[1];

  var _useState3 = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["useState"])(0),
      _useState4 = _slicedToArray(_useState3, 2),
      width = _useState4[0],
      setWidth = _useState4[1];

  var _useState5 = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["useState"])(0),
      _useState6 = _slicedToArray(_useState5, 2),
      height = _useState6[0],
      setHeight = _useState6[1];

  var _useState7 = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["useState"])({
    x: 0,
    y: 0
  }),
      _useState8 = _slicedToArray(_useState7, 2),
      crop = _useState8[0],
      setCrop = _useState8[1];

  var _useState9 = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["useState"])(0),
      _useState10 = _slicedToArray(_useState9, 2),
      rotation = _useState10[0],
      setRotation = _useState10[1];

  var _useState11 = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["useState"])(null),
      _useState12 = _slicedToArray(_useState11, 2),
      croppedAreaPixels = _useState12[0],
      setCroppedAreaPixels = _useState12[1];

  var _useState13 = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["useState"])(0),
      _useState14 = _slicedToArray(_useState13, 2),
      naturalWidth = _useState14[0],
      setNaturalWidth = _useState14[1];

  var _useState15 = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["useState"])(0),
      _useState16 = _slicedToArray(_useState15, 2),
      naturalHeight = _useState16[0],
      setNaturalHeight = _useState16[1];

  var _useState17 = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["useState"])(false),
      _useState18 = _slicedToArray(_useState17, 2),
      loading = _useState18[0],
      setLoading = _useState18[1];

  var _useState19 = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["useState"])(true),
      _useState20 = _slicedToArray(_useState19, 2),
      skeleton = _useState20[0],
      setSkeleton = _useState20[1];

  var _useState21 = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["useState"])(''),
      _useState22 = _slicedToArray(_useState21, 2),
      uploadError = _useState22[0],
      setUploadError = _useState22[1];

  var _useState23 = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["useState"])({
    type: '',
    message: ''
  }),
      _useState24 = _slicedToArray(_useState23, 2),
      notice = _useState24[0],
      setNotice = _useState24[1];

  var fileInput = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["useRef"])();
  Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["useEffect"])(function () {
    function getAvatar() {
      return _getAvatar.apply(this, arguments);
    }

    function _getAvatar() {
      _getAvatar = _asyncToGenerator( /*#__PURE__*/regeneratorRuntime.mark(function _callee() {
        var _response$data, _response$data2, _response$data3, response;

        return regeneratorRuntime.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                setSkeleton(true);
                _context.prev = 1;
                _context.next = 4;
                return _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_1___default()({
                  method: 'GET',
                  path: 'lp/v1/profile/get-avatar'
                });

              case 4:
                response = _context.sent;
                setWidth(response !== null && response !== void 0 && (_response$data = response.data) !== null && _response$data !== void 0 && _response$data.width ? parseInt(response.data.width) : 0);
                setHeight(response !== null && response !== void 0 && (_response$data2 = response.data) !== null && _response$data2 !== void 0 && _response$data2.height ? parseInt(response.data.height) : 0);
                setFile(response !== null && response !== void 0 && (_response$data3 = response.data) !== null && _response$data3 !== void 0 && _response$data3.url ? response.data.url : '');
                _context.next = 13;
                break;

              case 10:
                _context.prev = 10;
                _context.t0 = _context["catch"](1);
                setNotice({
                  type: 'error',
                  message: _context.t0.message
                });

              case 13:
                setSkeleton(false);

              case 14:
              case "end":
                return _context.stop();
            }
          }
        }, _callee, null, [[1, 10]]);
      }));
      return _getAvatar.apply(this, arguments);
    }

    getAvatar();
  }, []);

  function readFile(file) {
    return new Promise(function (resolve) {
      var reader = new FileReader();
      reader.addEventListener('load', function () {
        return resolve(reader.result);
      }, false);
      reader.readAsDataURL(file);
    });
  }

  var onCropComplete = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["useCallback"])(function (croppedArea, croppedAreaPixels) {
    setCroppedAreaPixels(croppedAreaPixels);
  }, []);

  var base64Resize = function base64Resize(base64, width, height) {
    return new Promise(function (resolve, reject) {
      var canvas = document.createElement('canvas');
      var img = document.createElement('img');
      img.src = base64;
      img.setAttribute('crossOrigin', 'anonymous');

      img.onload = function () {
        if (img.naturalWidth > width || img.naturalHeight > height) {
          canvas.width = width;
          canvas.height = height;
          var ctx = canvas.getContext('2d');
          ctx.drawImage(img, 0, 0, width, height);
          resolve(canvas.toDataURL('image/jpeg'));
        }

        resolve(base64);
      };

      img.onerror = function (err) {
        return reject(err);
      };
    });
  };

  var updateAvatar = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["useCallback"])( /*#__PURE__*/_asyncToGenerator( /*#__PURE__*/regeneratorRuntime.mark(function _callee2() {
    var croppedImage, imageResize, response, _yield$response, data, status, message;

    return regeneratorRuntime.wrap(function _callee2$(_context2) {
      while (1) {
        switch (_context2.prev = _context2.next) {
          case 0:
            setLoading({
              save: true
            });
            _context2.prev = 1;
            _context2.next = 4;
            return getCroppedImg(file, croppedAreaPixels, rotation);

          case 4:
            croppedImage = _context2.sent;
            _context2.next = 7;
            return base64Resize(croppedImage, width, height);

          case 7:
            imageResize = _context2.sent;
            _context2.next = 10;
            return _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_1___default()({
              path: 'lp/v1/profile/upload-avatar',
              method: 'POST',
              data: {
                file: imageResize || ''
              }
            });

          case 10:
            response = _context2.sent;
            _context2.next = 13;
            return response;

          case 13:
            _yield$response = _context2.sent;
            data = _yield$response.data;
            status = _yield$response.status;
            message = _yield$response.message;

            if (status === 'success') {
              window.location.reload();
            }

            setNotice({
              type: status,
              message: message
            });
            _context2.next = 24;
            break;

          case 21:
            _context2.prev = 21;
            _context2.t0 = _context2["catch"](1);
            setNotice({
              type: 'error',
              message: _context2.t0.message || ''
            });

          case 24:
            setLoading({
              save: false
            });

          case 25:
          case "end":
            return _context2.stop();
        }
      }
    }, _callee2, null, [[1, 21]]);
  })), [croppedAreaPixels, rotation]);

  var setFileInput = /*#__PURE__*/function () {
    var _ref2 = _asyncToGenerator( /*#__PURE__*/regeneratorRuntime.mark(function _callee3(fileUpload) {
      var file, img;
      return regeneratorRuntime.wrap(function _callee3$(_context3) {
        while (1) {
          switch (_context3.prev = _context3.next) {
            case 0:
              _context3.next = 2;
              return readFile(fileUpload);

            case 2:
              file = _context3.sent;
              img = new Image();
              _context3.next = 6;
              return file;

            case 6:
              img.src = _context3.sent;
              _context3.next = 9;
              return function () {
                setNaturalWidth(img.naturalWidth);
                setNaturalHeight(img.naturalHeight);
                var error = '';

                if (parseInt(fileUpload.size) > 2097152) {
                  error = Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__["__"])('File size too large. You need to upload a file < 2MB', 'learnpress');
                } else if (img.naturalWidth < width || img.naturalHeight < height) {
                  error = Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__["sprintf"])(Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__["__"])('Image size must be greater than or equal to %1$sx%2$spx', 'learnpress'), width, height);
                }

                if (error) {
                  setUploadError(error);
                } else {
                  setUploadError('');
                  setFile(file);
                }
              };

            case 9:
              img.onload = _context3.sent;

            case 10:
            case "end":
              return _context3.stop();
          }
        }
      }, _callee3);
    }));

    return function setFileInput(_x) {
      return _ref2.apply(this, arguments);
    };
  }();

  function removeAvatar() {
    return _removeAvatar.apply(this, arguments);
  }

  function _removeAvatar() {
    _removeAvatar = _asyncToGenerator( /*#__PURE__*/regeneratorRuntime.mark(function _callee4() {
      var response, _yield$response2, data, status, message;

      return regeneratorRuntime.wrap(function _callee4$(_context4) {
        while (1) {
          switch (_context4.prev = _context4.next) {
            case 0:
              if (!confirm(Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__["__"])('Are you sure you want to remove your avatar?', 'learnpress'))) {
                _context4.next = 20;
                break;
              }

              setLoading({
                remove: true
              });
              _context4.prev = 2;
              _context4.next = 5;
              return _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_1___default()({
                path: 'lp/v1/profile/remove-avatar',
                method: 'POST'
              });

            case 5:
              response = _context4.sent;
              _context4.next = 8;
              return response;

            case 8:
              _yield$response2 = _context4.sent;
              data = _yield$response2.data;
              status = _yield$response2.status;
              message = _yield$response2.message;
              setNotice({
                type: status,
                message: message
              });
              setFile('');
              _context4.next = 19;
              break;

            case 16:
              _context4.prev = 16;
              _context4.t0 = _context4["catch"](2);
              setNotice({
                type: 'error',
                message: _context4.t0.message || ''
              });

            case 19:
              setLoading({
                remove: false
              });

            case 20:
            case "end":
              return _context4.stop();
          }
        }
      }, _callee4, null, [[2, 16]]);
    }));
    return _removeAvatar.apply(this, arguments);
  }

  return /*#__PURE__*/React.createElement("div", {
    className: "learnpress_avatar"
  }, !skeleton ? /*#__PURE__*/React.createElement(React.Fragment, null, file && !uploadError && /*#__PURE__*/React.createElement(React.Fragment, null, naturalHeight && naturalWidth ? /*#__PURE__*/React.createElement("div", {
    className: "learnpress_avatar__cropper"
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      position: 'relative',
      width: naturalWidth,
      height: naturalHeight,
      zIndex: 9999,
      maxWidth: '100%',
      maxHeight: '800px'
    }
  }, /*#__PURE__*/React.createElement(react_easy_crop__WEBPACK_IMPORTED_MODULE_3__["default"], {
    image: file,
    crop: crop,
    zoom: "1",
    cropSize: {
      width: width,
      height: height
    },
    onCropChange: setCrop,
    onCropComplete: onCropComplete
  })), /*#__PURE__*/React.createElement("div", null, /*#__PURE__*/React.createElement("button", {
    className: "learnpress_avatar__button learnpress_avatar__button--save ".concat(loading !== null && loading !== void 0 && loading.save ? 'learnpress_avatar__button--loading' : ''),
    onClick: updateAvatar
  }, Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__["__"])('Save', 'learnpress')))) : /*#__PURE__*/React.createElement("div", {
    className: "learnpress_avatar__cropper"
  }, /*#__PURE__*/React.createElement("img", {
    src: file,
    alt: ""
  }), /*#__PURE__*/React.createElement("div", null, /*#__PURE__*/React.createElement("button", {
    className: "learnpress_avatar__button learnpress_avatar__button--replace",
    onClick: function onClick() {
      return fileInput.current && fileInput.current.click();
    }
  }, Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__["__"])('Replace', 'learnpress')), /*#__PURE__*/React.createElement("button", {
    className: "learnpress_avatar__button learnpress_avatar__button--remove ".concat(loading !== null && loading !== void 0 && loading.remove ? 'learnpress_avatar__button--loading' : ''),
    onClick: removeAvatar
  }, Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__["__"])('Remove', 'learnpress'))))), /*#__PURE__*/React.createElement("form", {
    style: {
      display: !file ? '' : 'none'
    }
  }, /*#__PURE__*/React.createElement("div", {
    className: "learnpress_avatar__form"
  }, /*#__PURE__*/React.createElement("div", {
    className: "learnpress_avatar__form-group"
  }, /*#__PURE__*/React.createElement("label", {
    htmlFor: "avatar-file"
  }, /*#__PURE__*/React.createElement("div", {
    className: "learnpress_avatar__form__upload"
  }, /*#__PURE__*/React.createElement("div", null, /*#__PURE__*/React.createElement("span", null, /*#__PURE__*/React.createElement("svg", {
    viewBox: "64 64 896 896",
    focusable: "false",
    "data-icon": "plus",
    width: "1em",
    height: "1em",
    fill: "currentColor",
    "aria-hidden": "true"
  }, /*#__PURE__*/React.createElement("defs", null, /*#__PURE__*/React.createElement("style", null)), /*#__PURE__*/React.createElement("path", {
    d: "M482 152h60q8 0 8 8v704q0 8-8 8h-60q-8 0-8-8V160q0-8 8-8z"
  }), /*#__PURE__*/React.createElement("path", {
    d: "M176 474h672q8 0 8 8v60q0 8-8 8H176q-8 0-8-8v-60q0-8 8-8z"
  }))), /*#__PURE__*/React.createElement("div", null, Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__["__"])('Upload', 'learnpress')))), /*#__PURE__*/React.createElement("input", {
    ref: fileInput,
    type: "file",
    id: "avatar-file",
    accept: "image/*",
    onChange: function onChange(e) {
      return setFileInput(e.target.files && e.target.files.length > 0 ? e.target.files[0] : '');
    }
  }))))), uploadError && /*#__PURE__*/React.createElement("div", {
    className: "lp-ajax-message error",
    style: {
      display: 'block'
    }
  }, uploadError), !uploadError && notice && notice.type && notice.message && /*#__PURE__*/React.createElement("div", {
    className: "lp-ajax-message ".concat(notice.type),
    style: {
      display: 'block'
    }
  }, notice.message)) : /*#__PURE__*/React.createElement("ul", {
    className: "lp-skeleton-animation"
  }, /*#__PURE__*/React.createElement("li", {
    style: {
      width: 200,
      height: 200
    }
  }), /*#__PURE__*/React.createElement("li", {
    style: {
      width: 200,
      height: 20
    }
  }), /*#__PURE__*/React.createElement("li", {
    style: {
      width: 200,
      height: 20
    }
  })));
} // Link: https://codesandbox.io/s/q8q1mnr01w

var createImage = function createImage(url) {
  return new Promise(function (resolve, reject) {
    var image = new Image();
    image.addEventListener('load', function () {
      return resolve(image);
    });
    image.addEventListener('error', function (error) {
      return reject(error);
    });
    image.setAttribute('crossOrigin', 'anonymous'); // needed to avoid cross-origin issues on CodeSandbox

    image.src = url;
  });
};

function getRadianAngle(degreeValue) {
  return degreeValue * Math.PI / 180;
}
/**
 * Returns the new bounding area of a rotated rectangle.
 *
 * @param  width
 * @param  height
 * @param  rotation
 */


function rotateSize(width, height, rotation) {
  var rotRad = getRadianAngle(rotation);
  return {
    width: Math.abs(Math.cos(rotRad) * width) + Math.abs(Math.sin(rotRad) * height),
    height: Math.abs(Math.sin(rotRad) * width) + Math.abs(Math.cos(rotRad) * height)
  };
}
/**
 * This function was adapted from the one in the ReadMe of https://github.com/DominicTobias/react-image-crop
 *
 * @param  imageSrc
 * @param  pixelCrop
 * @param  rotation
 * @param  flip
 */


function getCroppedImg(_x2, _x3) {
  return _getCroppedImg.apply(this, arguments);
}

function _getCroppedImg() {
  _getCroppedImg = _asyncToGenerator( /*#__PURE__*/regeneratorRuntime.mark(function _callee5(imageSrc, pixelCrop) {
    var rotation,
        flip,
        image,
        canvas,
        ctx,
        rotRad,
        _rotateSize,
        bBoxWidth,
        bBoxHeight,
        data,
        _args5 = arguments;

    return regeneratorRuntime.wrap(function _callee5$(_context5) {
      while (1) {
        switch (_context5.prev = _context5.next) {
          case 0:
            rotation = _args5.length > 2 && _args5[2] !== undefined ? _args5[2] : 0;
            flip = _args5.length > 3 && _args5[3] !== undefined ? _args5[3] : {
              horizontal: false,
              vertical: false
            };
            _context5.next = 4;
            return createImage(imageSrc);

          case 4:
            image = _context5.sent;
            canvas = document.createElement('canvas');
            ctx = canvas.getContext('2d');

            if (ctx) {
              _context5.next = 9;
              break;
            }

            return _context5.abrupt("return", null);

          case 9:
            rotRad = getRadianAngle(rotation); // calculate bounding box of the rotated image

            _rotateSize = rotateSize(image.width, image.height, rotation), bBoxWidth = _rotateSize.width, bBoxHeight = _rotateSize.height; // set canvas size to match the bounding box

            canvas.width = bBoxWidth;
            canvas.height = bBoxHeight; // translate canvas context to a central location to allow rotating and flipping around the center

            ctx.translate(bBoxWidth / 2, bBoxHeight / 2);
            ctx.rotate(rotRad);
            ctx.scale(flip.horizontal ? -1 : 1, flip.vertical ? -1 : 1);
            ctx.translate(-image.width / 2, -image.height / 2); // draw rotated image

            ctx.drawImage(image, 0, 0); // croppedAreaPixels values are bounding box relative
            // extract the cropped image using these values

            data = ctx.getImageData(pixelCrop.x, pixelCrop.y, pixelCrop.width, pixelCrop.height); // set canvas width to final desired crop size - this will clear existing context

            canvas.width = pixelCrop.width;
            canvas.height = pixelCrop.height; // paste generated rotate image at the top left corner

            ctx.putImageData(data, 0, 0); // As Base64 string

            return _context5.abrupt("return", canvas.toDataURL('image/jpeg'));

          case 23:
          case "end":
            return _context5.stop();
        }
      }
    }, _callee5);
  }));
  return _getCroppedImg.apply(this, arguments);
}

/***/ }),

/***/ "./assets/src/apps/js/frontend/profile/course-tab.js":
/*!***********************************************************!*\
  !*** ./assets/src/apps/js/frontend/profile/course-tab.js ***!
  \***********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/url */ "@wordpress/url");
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_url__WEBPACK_IMPORTED_MODULE_0__);
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

 // Rest API load content course enrolled, created - Nhamdv.

var courseTab = function courseTab() {
  var elements = document.querySelectorAll('.learn-press-course-tab__filter__content');

  var getResponse = function getResponse(ele, dataset) {
    var append = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : false;
    var viewMoreEle = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : false;
    wp.apiFetch({
      path: Object(_wordpress_url__WEBPACK_IMPORTED_MODULE_0__["addQueryArgs"])('lp/v1/profile/course-tab', dataset),
      method: 'GET'
    }).then(function (response) {
      var skeleton = ele.querySelector('.lp-skeleton-animation');
      skeleton && skeleton.remove();

      if (response.status === 'success' && response.data) {
        if (append) {
          ele.innerHTML += response.data;
        } else {
          ele.innerHTML = response.data;
        }
      } else if (append) {
        ele.innerHTML += "<div class=\"lp-ajax-message\" style=\"display:block\">".concat(response.message && response.message, "</div>");
      } else {
        ele.innerHTML = "<div class=\"lp-ajax-message\" style=\"display:block\">".concat(response.message && response.message, "</div>");
      }

      if (viewMoreEle) {
        viewMoreEle.classList.remove('loading');
        var paged = viewMoreEle.dataset.paged;
        var numberPage = viewMoreEle.dataset.number;

        if (numberPage <= paged) {
          viewMoreEle.remove();
        }

        viewMoreEle.dataset.paged = parseInt(paged) + 1;
      }

      viewMore(ele, dataset);
    })["catch"](function (error) {
      if (append) {
        ele.innerHTML += "<div class=\"lp-ajax-message error\" style=\"display:block\">".concat(error.message && error.message, "</div>");
      } else {
        ele.innerHTML = "<div class=\"lp-ajax-message error\" style=\"display:block\">".concat(error.message && error.message, "</div>");
      }

      if (viewMoreEle) {
        viewMoreEle.classList.remove('loading');
        var paged = viewMoreEle.dataset.paged;
        var numberPage = viewMoreEle.dataset.number;

        if (numberPage <= paged) {
          viewMoreEle.remove();
        }

        viewMoreEle.dataset.paged = parseInt(paged) + 1;
      }
    });
  };

  if ('IntersectionObserver' in window) {
    var eleObserver = new IntersectionObserver(function (entries, observer) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          var ele = entry.target;
          var params = ele.parentNode.querySelector('.lp_profile_tab_input_param');

          var data = _objectSpread(_objectSpread({}, JSON.parse(params.value)), {}, {
            status: ele.dataset.tab || ''
          });

          getResponse(ele, data);
          eleObserver.unobserve(ele);
        }
      });
    });

    _toConsumableArray(elements).map(function (ele) {
      if (ele.dataset.tab !== 'all') {
        eleObserver.observe(ele);
      } else {
        var params = ele.parentNode.querySelector('.lp_profile_tab_input_param');

        var data = _objectSpread(_objectSpread({}, JSON.parse(params.value)), {}, {
          status: ele.dataset.tab === 'all' ? '' : ele.dataset.tab || ''
        });

        getResponse(ele, data);
      }
    });
  }

  var changeFilter = function changeFilter() {
    var tabs = document.querySelectorAll('.learn-press-course-tab-filters');
    tabs.forEach(function (tab) {
      var filters = tab.querySelectorAll('.learn-press-filters a');
      filters.forEach(function (filter) {
        filter.addEventListener('click', function (e) {
          e.preventDefault();
          var tabName = filter.dataset.tab;

          _toConsumableArray(filters).map(function (ele) {
            ele.classList.remove('active');
          });

          filter.classList.add('active');

          _toConsumableArray(tab.querySelectorAll('.learn-press-course-tab__filter__content')).map(function (ele) {
            ele.style.display = 'none';

            if (ele.dataset.tab === tabName) {
              ele.style.display = '';
            }
          });
        });
      });
    });
  };

  changeFilter();

  var changeTab = function changeTab() {
    var tabUls = document.querySelectorAll('.learn-press-profile-course__tab__inner');
    tabUls.forEach(function (tabUl) {
      var tabs = tabUl.querySelectorAll('li> a');
      tabs.forEach(function (tab) {
        tab.addEventListener('click', function (e) {
          e.preventDefault();
          var tabName = tab.dataset.tab;

          _toConsumableArray(tabs).map(function (ele) {
            ele.classList.remove('active');
          });

          tab.classList.add('active');

          _toConsumableArray(document.querySelectorAll('.learn-press-course-tab-filters')).map(function (ele) {
            ele.style.display = 'none';

            if (ele.dataset.tab === tabName) {
              ele.style.display = '';
            }
          });
        });
      });
    });
  };

  changeTab();

  var viewMore = function viewMore(ele, dataset) {
    var viewMoreEle = ele.querySelector('button[data-paged]');

    if (viewMoreEle) {
      viewMoreEle.addEventListener('click', function (e) {
        e.preventDefault();
        var paged = viewMoreEle && viewMoreEle.dataset.paged;
        viewMoreEle.classList.add('loading');
        var element = dataset.layout === 'list' ? '.lp_profile_course_progress' : '.learn-press-courses';
        getResponse(ele.querySelector(element), _objectSpread(_objectSpread({}, dataset), {
          paged: paged
        }), true, viewMoreEle);
      });
    }
  };
};

/* harmony default export */ __webpack_exports__["default"] = (courseTab);

/***/ }),

/***/ "./assets/src/apps/js/frontend/profile/order-recover.js":
/*!**************************************************************!*\
  !*** ./assets/src/apps/js/frontend/profile/order-recover.js ***!
  \**************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return recoverOrder; });
var $ = window.jQuery;
function recoverOrder() {
  var wrap = $('.order-recover'),
      buttonRecoverOrder = wrap.find('.button-recover-order');

  var ajaxRecover = function ajaxRecover() {
    wrap.find('.learn-press-message').remove();
    $('.profile-recover-order').find('.learn-press-message').remove();
    $.post({
      url: '',
      data: wrap.serializeJSON(),
      beforeSend: function beforeSend() {
        buttonRecoverOrder.addClass('loading').attr('disabled', 'disabled');
      },
      success: function success(response) {
        response = LP.parseJSON(response);

        if (response.message) {
          var $msg = $('<div class="learn-press-message icon"><i class="fa"></i> ' + response.message + '</div>');

          if (response.result == 'error') {
            $msg.addClass('error');
          }

          wrap.before($msg);
        }

        if (response.redirect) {
          window.location.href = response.redirect;
        }

        buttonRecoverOrder.removeClass('loading').removeAttr('disabled', '');
      },
      error: function error() {
        buttonRecoverOrder.removeClass('loading').removeAttr('disabled', '');
      }
    });
  };

  buttonRecoverOrder.on('click', ajaxRecover);
}
;

/***/ }),

/***/ "./assets/src/apps/js/frontend/profile/statistic.js":
/*!**********************************************************!*\
  !*** ./assets/src/apps/js/frontend/profile/statistic.js ***!
  \**********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/url */ "@wordpress/url");
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_url__WEBPACK_IMPORTED_MODULE_0__);
 // Rest API load content course progress - Nhamdv.

var courseStatistics = function courseStatistics() {
  var elements = document.querySelector('.learn-press-profile-course__statistic');

  if (!elements) {
    return;
  }

  var getResponse = function getResponse(ele, dataset) {
    wp.apiFetch({
      path: Object(_wordpress_url__WEBPACK_IMPORTED_MODULE_0__["addQueryArgs"])('lp/v1/profile/statistic', dataset),
      method: 'GET'
    }).then(function (response) {
      if (response.status === 'success' && response.data) {
        ele.innerHTML = response.data;
      } else {
        ele.innerHTML = "<div class=\"lp-ajax-message error\" style=\"display:block\">".concat(response.message && response.message, "</div>");
      }
    })["catch"](function (err) {
      console.log(err); //ele.innerHTML += `<div class="lp-ajax-message error" style="display:block">${ err.message && err.message }</div>`;
    });
  };

  var elArgStatistic = document.querySelector('[name="args_query_user_courses_statistic"]');

  if (!elArgStatistic) {
    return;
  }

  var data = JSON.parse(elArgStatistic.value);
  getResponse(elements, data);
};

/* harmony default export */ __webpack_exports__["default"] = (courseStatistics);

/***/ }),

/***/ "./node_modules/normalize-wheel/index.js":
/*!***********************************************!*\
  !*** ./node_modules/normalize-wheel/index.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! ./src/normalizeWheel.js */ "./node_modules/normalize-wheel/src/normalizeWheel.js");


/***/ }),

/***/ "./node_modules/normalize-wheel/src/ExecutionEnvironment.js":
/*!******************************************************************!*\
  !*** ./node_modules/normalize-wheel/src/ExecutionEnvironment.js ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/**
 * Copyright (c) 2015, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the BSD-style license found in the
 * LICENSE file in the root directory of this source tree. An additional grant
 * of patent rights can be found in the PATENTS file in the same directory.
 *
 * @providesModule ExecutionEnvironment
 */

/*jslint evil: true */



var canUseDOM = !!(
  typeof window !== 'undefined' &&
  window.document &&
  window.document.createElement
);

/**
 * Simple, lightweight module assisting with the detection and context of
 * Worker. Helps avoid circular dependencies and allows code to reason about
 * whether or not they are in a Worker, even if they never include the main
 * `ReactWorker` dependency.
 */
var ExecutionEnvironment = {

  canUseDOM: canUseDOM,

  canUseWorkers: typeof Worker !== 'undefined',

  canUseEventListeners:
    canUseDOM && !!(window.addEventListener || window.attachEvent),

  canUseViewport: canUseDOM && !!window.screen,

  isInWorker: !canUseDOM // For now, this is true - might change in the future.

};

module.exports = ExecutionEnvironment;


/***/ }),

/***/ "./node_modules/normalize-wheel/src/UserAgent_DEPRECATED.js":
/*!******************************************************************!*\
  !*** ./node_modules/normalize-wheel/src/UserAgent_DEPRECATED.js ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * Copyright 2004-present Facebook. All Rights Reserved.
 *
 * @providesModule UserAgent_DEPRECATED
 */

/**
 *  Provides entirely client-side User Agent and OS detection. You should prefer
 *  the non-deprecated UserAgent module when possible, which exposes our
 *  authoritative server-side PHP-based detection to the client.
 *
 *  Usage is straightforward:
 *
 *    if (UserAgent_DEPRECATED.ie()) {
 *      //  IE
 *    }
 *
 *  You can also do version checks:
 *
 *    if (UserAgent_DEPRECATED.ie() >= 7) {
 *      //  IE7 or better
 *    }
 *
 *  The browser functions will return NaN if the browser does not match, so
 *  you can also do version compares the other way:
 *
 *    if (UserAgent_DEPRECATED.ie() < 7) {
 *      //  IE6 or worse
 *    }
 *
 *  Note that the version is a float and may include a minor version number,
 *  so you should always use range operators to perform comparisons, not
 *  strict equality.
 *
 *  **Note:** You should **strongly** prefer capability detection to browser
 *  version detection where it's reasonable:
 *
 *    http://www.quirksmode.org/js/support.html
 *
 *  Further, we have a large number of mature wrapper functions and classes
 *  which abstract away many browser irregularities. Check the documentation,
 *  grep for things, or ask on javascript@lists.facebook.com before writing yet
 *  another copy of "event || window.event".
 *
 */

var _populated = false;

// Browsers
var _ie, _firefox, _opera, _webkit, _chrome;

// Actual IE browser for compatibility mode
var _ie_real_version;

// Platforms
var _osx, _windows, _linux, _android;

// Architectures
var _win64;

// Devices
var _iphone, _ipad, _native;

var _mobile;

function _populate() {
  if (_populated) {
    return;
  }

  _populated = true;

  // To work around buggy JS libraries that can't handle multi-digit
  // version numbers, Opera 10's user agent string claims it's Opera
  // 9, then later includes a Version/X.Y field:
  //
  // Opera/9.80 (foo) Presto/2.2.15 Version/10.10
  var uas = navigator.userAgent;
  var agent = /(?:MSIE.(\d+\.\d+))|(?:(?:Firefox|GranParadiso|Iceweasel).(\d+\.\d+))|(?:Opera(?:.+Version.|.)(\d+\.\d+))|(?:AppleWebKit.(\d+(?:\.\d+)?))|(?:Trident\/\d+\.\d+.*rv:(\d+\.\d+))/.exec(uas);
  var os    = /(Mac OS X)|(Windows)|(Linux)/.exec(uas);

  _iphone = /\b(iPhone|iP[ao]d)/.exec(uas);
  _ipad = /\b(iP[ao]d)/.exec(uas);
  _android = /Android/i.exec(uas);
  _native = /FBAN\/\w+;/i.exec(uas);
  _mobile = /Mobile/i.exec(uas);

  // Note that the IE team blog would have you believe you should be checking
  // for 'Win64; x64'.  But MSDN then reveals that you can actually be coming
  // from either x64 or ia64;  so ultimately, you should just check for Win64
  // as in indicator of whether you're in 64-bit IE.  32-bit IE on 64-bit
  // Windows will send 'WOW64' instead.
  _win64 = !!(/Win64/.exec(uas));

  if (agent) {
    _ie = agent[1] ? parseFloat(agent[1]) : (
          agent[5] ? parseFloat(agent[5]) : NaN);
    // IE compatibility mode
    if (_ie && document && document.documentMode) {
      _ie = document.documentMode;
    }
    // grab the "true" ie version from the trident token if available
    var trident = /(?:Trident\/(\d+.\d+))/.exec(uas);
    _ie_real_version = trident ? parseFloat(trident[1]) + 4 : _ie;

    _firefox = agent[2] ? parseFloat(agent[2]) : NaN;
    _opera   = agent[3] ? parseFloat(agent[3]) : NaN;
    _webkit  = agent[4] ? parseFloat(agent[4]) : NaN;
    if (_webkit) {
      // We do not add the regexp to the above test, because it will always
      // match 'safari' only since 'AppleWebKit' appears before 'Chrome' in
      // the userAgent string.
      agent = /(?:Chrome\/(\d+\.\d+))/.exec(uas);
      _chrome = agent && agent[1] ? parseFloat(agent[1]) : NaN;
    } else {
      _chrome = NaN;
    }
  } else {
    _ie = _firefox = _opera = _chrome = _webkit = NaN;
  }

  if (os) {
    if (os[1]) {
      // Detect OS X version.  If no version number matches, set _osx to true.
      // Version examples:  10, 10_6_1, 10.7
      // Parses version number as a float, taking only first two sets of
      // digits.  If only one set of digits is found, returns just the major
      // version number.
      var ver = /(?:Mac OS X (\d+(?:[._]\d+)?))/.exec(uas);

      _osx = ver ? parseFloat(ver[1].replace('_', '.')) : true;
    } else {
      _osx = false;
    }
    _windows = !!os[2];
    _linux   = !!os[3];
  } else {
    _osx = _windows = _linux = false;
  }
}

var UserAgent_DEPRECATED = {

  /**
   *  Check if the UA is Internet Explorer.
   *
   *
   *  @return float|NaN Version number (if match) or NaN.
   */
  ie: function() {
    return _populate() || _ie;
  },

  /**
   * Check if we're in Internet Explorer compatibility mode.
   *
   * @return bool true if in compatibility mode, false if
   * not compatibility mode or not ie
   */
  ieCompatibilityMode: function() {
    return _populate() || (_ie_real_version > _ie);
  },


  /**
   * Whether the browser is 64-bit IE.  Really, this is kind of weak sauce;  we
   * only need this because Skype can't handle 64-bit IE yet.  We need to remove
   * this when we don't need it -- tracked by #601957.
   */
  ie64: function() {
    return UserAgent_DEPRECATED.ie() && _win64;
  },

  /**
   *  Check if the UA is Firefox.
   *
   *
   *  @return float|NaN Version number (if match) or NaN.
   */
  firefox: function() {
    return _populate() || _firefox;
  },


  /**
   *  Check if the UA is Opera.
   *
   *
   *  @return float|NaN Version number (if match) or NaN.
   */
  opera: function() {
    return _populate() || _opera;
  },


  /**
   *  Check if the UA is WebKit.
   *
   *
   *  @return float|NaN Version number (if match) or NaN.
   */
  webkit: function() {
    return _populate() || _webkit;
  },

  /**
   *  For Push
   *  WILL BE REMOVED VERY SOON. Use UserAgent_DEPRECATED.webkit
   */
  safari: function() {
    return UserAgent_DEPRECATED.webkit();
  },

  /**
   *  Check if the UA is a Chrome browser.
   *
   *
   *  @return float|NaN Version number (if match) or NaN.
   */
  chrome : function() {
    return _populate() || _chrome;
  },


  /**
   *  Check if the user is running Windows.
   *
   *  @return bool `true' if the user's OS is Windows.
   */
  windows: function() {
    return _populate() || _windows;
  },


  /**
   *  Check if the user is running Mac OS X.
   *
   *  @return float|bool   Returns a float if a version number is detected,
   *                       otherwise true/false.
   */
  osx: function() {
    return _populate() || _osx;
  },

  /**
   * Check if the user is running Linux.
   *
   * @return bool `true' if the user's OS is some flavor of Linux.
   */
  linux: function() {
    return _populate() || _linux;
  },

  /**
   * Check if the user is running on an iPhone or iPod platform.
   *
   * @return bool `true' if the user is running some flavor of the
   *    iPhone OS.
   */
  iphone: function() {
    return _populate() || _iphone;
  },

  mobile: function() {
    return _populate() || (_iphone || _ipad || _android || _mobile);
  },

  nativeApp: function() {
    // webviews inside of the native apps
    return _populate() || _native;
  },

  android: function() {
    return _populate() || _android;
  },

  ipad: function() {
    return _populate() || _ipad;
  }
};

module.exports = UserAgent_DEPRECATED;


/***/ }),

/***/ "./node_modules/normalize-wheel/src/isEventSupported.js":
/*!**************************************************************!*\
  !*** ./node_modules/normalize-wheel/src/isEventSupported.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/**
 * Copyright 2013-2015, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the BSD-style license found in the
 * LICENSE file in the root directory of this source tree. An additional grant
 * of patent rights can be found in the PATENTS file in the same directory.
 *
 * @providesModule isEventSupported
 */



var ExecutionEnvironment = __webpack_require__(/*! ./ExecutionEnvironment */ "./node_modules/normalize-wheel/src/ExecutionEnvironment.js");

var useHasFeature;
if (ExecutionEnvironment.canUseDOM) {
  useHasFeature =
    document.implementation &&
    document.implementation.hasFeature &&
    // always returns true in newer browsers as per the standard.
    // @see http://dom.spec.whatwg.org/#dom-domimplementation-hasfeature
    document.implementation.hasFeature('', '') !== true;
}

/**
 * Checks if an event is supported in the current execution environment.
 *
 * NOTE: This will not work correctly for non-generic events such as `change`,
 * `reset`, `load`, `error`, and `select`.
 *
 * Borrows from Modernizr.
 *
 * @param {string} eventNameSuffix Event name, e.g. "click".
 * @param {?boolean} capture Check if the capture phase is supported.
 * @return {boolean} True if the event is supported.
 * @internal
 * @license Modernizr 3.0.0pre (Custom Build) | MIT
 */
function isEventSupported(eventNameSuffix, capture) {
  if (!ExecutionEnvironment.canUseDOM ||
      capture && !('addEventListener' in document)) {
    return false;
  }

  var eventName = 'on' + eventNameSuffix;
  var isSupported = eventName in document;

  if (!isSupported) {
    var element = document.createElement('div');
    element.setAttribute(eventName, 'return;');
    isSupported = typeof element[eventName] === 'function';
  }

  if (!isSupported && useHasFeature && eventNameSuffix === 'wheel') {
    // This is the only way to test support for the `wheel` event in IE9+.
    isSupported = document.implementation.hasFeature('Events.wheel', '3.0');
  }

  return isSupported;
}

module.exports = isEventSupported;


/***/ }),

/***/ "./node_modules/normalize-wheel/src/normalizeWheel.js":
/*!************************************************************!*\
  !*** ./node_modules/normalize-wheel/src/normalizeWheel.js ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/**
 * Copyright (c) 2015, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the BSD-style license found in the
 * LICENSE file in the root directory of this source tree. An additional grant
 * of patent rights can be found in the PATENTS file in the same directory.
 *
 * @providesModule normalizeWheel
 * @typechecks
 */



var UserAgent_DEPRECATED = __webpack_require__(/*! ./UserAgent_DEPRECATED */ "./node_modules/normalize-wheel/src/UserAgent_DEPRECATED.js");

var isEventSupported = __webpack_require__(/*! ./isEventSupported */ "./node_modules/normalize-wheel/src/isEventSupported.js");


// Reasonable defaults
var PIXEL_STEP  = 10;
var LINE_HEIGHT = 40;
var PAGE_HEIGHT = 800;

/**
 * Mouse wheel (and 2-finger trackpad) support on the web sucks.  It is
 * complicated, thus this doc is long and (hopefully) detailed enough to answer
 * your questions.
 *
 * If you need to react to the mouse wheel in a predictable way, this code is
 * like your bestest friend. * hugs *
 *
 * As of today, there are 4 DOM event types you can listen to:
 *
 *   'wheel'                -- Chrome(31+), FF(17+), IE(9+)
 *   'mousewheel'           -- Chrome, IE(6+), Opera, Safari
 *   'MozMousePixelScroll'  -- FF(3.5 only!) (2010-2013) -- don't bother!
 *   'DOMMouseScroll'       -- FF(0.9.7+) since 2003
 *
 * So what to do?  The is the best:
 *
 *   normalizeWheel.getEventType();
 *
 * In your event callback, use this code to get sane interpretation of the
 * deltas.  This code will return an object with properties:
 *
 *   spinX   -- normalized spin speed (use for zoom) - x plane
 *   spinY   -- " - y plane
 *   pixelX  -- normalized distance (to pixels) - x plane
 *   pixelY  -- " - y plane
 *
 * Wheel values are provided by the browser assuming you are using the wheel to
 * scroll a web page by a number of lines or pixels (or pages).  Values can vary
 * significantly on different platforms and browsers, forgetting that you can
 * scroll at different speeds.  Some devices (like trackpads) emit more events
 * at smaller increments with fine granularity, and some emit massive jumps with
 * linear speed or acceleration.
 *
 * This code does its best to normalize the deltas for you:
 *
 *   - spin is trying to normalize how far the wheel was spun (or trackpad
 *     dragged).  This is super useful for zoom support where you want to
 *     throw away the chunky scroll steps on the PC and make those equal to
 *     the slow and smooth tiny steps on the Mac. Key data: This code tries to
 *     resolve a single slow step on a wheel to 1.
 *
 *   - pixel is normalizing the desired scroll delta in pixel units.  You'll
 *     get the crazy differences between browsers, but at least it'll be in
 *     pixels!
 *
 *   - positive value indicates scrolling DOWN/RIGHT, negative UP/LEFT.  This
 *     should translate to positive value zooming IN, negative zooming OUT.
 *     This matches the newer 'wheel' event.
 *
 * Why are there spinX, spinY (or pixels)?
 *
 *   - spinX is a 2-finger side drag on the trackpad, and a shift + wheel turn
 *     with a mouse.  It results in side-scrolling in the browser by default.
 *
 *   - spinY is what you expect -- it's the classic axis of a mouse wheel.
 *
 *   - I dropped spinZ/pixelZ.  It is supported by the DOM 3 'wheel' event and
 *     probably is by browsers in conjunction with fancy 3D controllers .. but
 *     you know.
 *
 * Implementation info:
 *
 * Examples of 'wheel' event if you scroll slowly (down) by one step with an
 * average mouse:
 *
 *   OS X + Chrome  (mouse)     -    4   pixel delta  (wheelDelta -120)
 *   OS X + Safari  (mouse)     -  N/A   pixel delta  (wheelDelta  -12)
 *   OS X + Firefox (mouse)     -    0.1 line  delta  (wheelDelta  N/A)
 *   Win8 + Chrome  (mouse)     -  100   pixel delta  (wheelDelta -120)
 *   Win8 + Firefox (mouse)     -    3   line  delta  (wheelDelta -120)
 *
 * On the trackpad:
 *
 *   OS X + Chrome  (trackpad)  -    2   pixel delta  (wheelDelta   -6)
 *   OS X + Firefox (trackpad)  -    1   pixel delta  (wheelDelta  N/A)
 *
 * On other/older browsers.. it's more complicated as there can be multiple and
 * also missing delta values.
 *
 * The 'wheel' event is more standard:
 *
 * http://www.w3.org/TR/DOM-Level-3-Events/#events-wheelevents
 *
 * The basics is that it includes a unit, deltaMode (pixels, lines, pages), and
 * deltaX, deltaY and deltaZ.  Some browsers provide other values to maintain
 * backward compatibility with older events.  Those other values help us
 * better normalize spin speed.  Example of what the browsers provide:
 *
 *                          | event.wheelDelta | event.detail
 *        ------------------+------------------+--------------
 *          Safari v5/OS X  |       -120       |       0
 *          Safari v5/Win7  |       -120       |       0
 *         Chrome v17/OS X  |       -120       |       0
 *         Chrome v17/Win7  |       -120       |       0
 *                IE9/Win7  |       -120       |   undefined
 *         Firefox v4/OS X  |     undefined    |       1
 *         Firefox v4/Win7  |     undefined    |       3
 *
 */
function normalizeWheel(/*object*/ event) /*object*/ {
  var sX = 0, sY = 0,       // spinX, spinY
      pX = 0, pY = 0;       // pixelX, pixelY

  // Legacy
  if ('detail'      in event) { sY = event.detail; }
  if ('wheelDelta'  in event) { sY = -event.wheelDelta / 120; }
  if ('wheelDeltaY' in event) { sY = -event.wheelDeltaY / 120; }
  if ('wheelDeltaX' in event) { sX = -event.wheelDeltaX / 120; }

  // side scrolling on FF with DOMMouseScroll
  if ( 'axis' in event && event.axis === event.HORIZONTAL_AXIS ) {
    sX = sY;
    sY = 0;
  }

  pX = sX * PIXEL_STEP;
  pY = sY * PIXEL_STEP;

  if ('deltaY' in event) { pY = event.deltaY; }
  if ('deltaX' in event) { pX = event.deltaX; }

  if ((pX || pY) && event.deltaMode) {
    if (event.deltaMode == 1) {          // delta in LINE units
      pX *= LINE_HEIGHT;
      pY *= LINE_HEIGHT;
    } else {                             // delta in PAGE units
      pX *= PAGE_HEIGHT;
      pY *= PAGE_HEIGHT;
    }
  }

  // Fall-back if spin cannot be determined
  if (pX && !sX) { sX = (pX < 1) ? -1 : 1; }
  if (pY && !sY) { sY = (pY < 1) ? -1 : 1; }

  return { spinX  : sX,
           spinY  : sY,
           pixelX : pX,
           pixelY : pY };
}


/**
 * The best combination if you prefer spinX + spinY normalization.  It favors
 * the older DOMMouseScroll for Firefox, as FF does not include wheelDelta with
 * 'wheel' event, making spin speed determination impossible.
 */
normalizeWheel.getEventType = function() /*string*/ {
  return (UserAgent_DEPRECATED.firefox())
           ? 'DOMMouseScroll'
           : (isEventSupported('wheel'))
               ? 'wheel'
               : 'mousewheel';
};

module.exports = normalizeWheel;


/***/ }),

/***/ "./node_modules/react-easy-crop/index.module.js":
/*!******************************************************!*\
  !*** ./node_modules/react-easy-crop/index.module.js ***!
  \******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/react-easy-crop/node_modules/tslib/tslib.es6.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var normalize_wheel__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! normalize-wheel */ "./node_modules/normalize-wheel/index.js");
/* harmony import */ var normalize_wheel__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(normalize_wheel__WEBPACK_IMPORTED_MODULE_2__);




/**
 * Compute the dimension of the crop area based on media size,
 * aspect ratio and optionally rotation
 */

function getCropSize(mediaWidth, mediaHeight, containerWidth, containerHeight, aspect, rotation) {
  if (rotation === void 0) {
    rotation = 0;
  }

  var _a = rotateSize(mediaWidth, mediaHeight, rotation),
      width = _a.width,
      height = _a.height;

  var fittingWidth = Math.min(width, containerWidth);
  var fittingHeight = Math.min(height, containerHeight);

  if (fittingWidth > fittingHeight * aspect) {
    return {
      width: fittingHeight * aspect,
      height: fittingHeight
    };
  }

  return {
    width: fittingWidth,
    height: fittingWidth / aspect
  };
}
/**
 * Compute media zoom.
 * We fit the media into the container with "max-width: 100%; max-height: 100%;"
 */

function getMediaZoom(mediaSize) {
  // Take the axis with more pixels to improve accuracy
  return mediaSize.width > mediaSize.height ? mediaSize.width / mediaSize.naturalWidth : mediaSize.height / mediaSize.naturalHeight;
}
/**
 * Ensure a new media position stays in the crop area.
 */

function restrictPosition(position, mediaSize, cropSize, zoom, rotation) {
  if (rotation === void 0) {
    rotation = 0;
  }

  var _a = rotateSize(mediaSize.width, mediaSize.height, rotation),
      width = _a.width,
      height = _a.height;

  return {
    x: restrictPositionCoord(position.x, width, cropSize.width, zoom),
    y: restrictPositionCoord(position.y, height, cropSize.height, zoom)
  };
}

function restrictPositionCoord(position, mediaSize, cropSize, zoom) {
  var maxPosition = mediaSize * zoom / 2 - cropSize / 2;
  return clamp(position, -maxPosition, maxPosition);
}

function getDistanceBetweenPoints(pointA, pointB) {
  return Math.sqrt(Math.pow(pointA.y - pointB.y, 2) + Math.pow(pointA.x - pointB.x, 2));
}
function getRotationBetweenPoints(pointA, pointB) {
  return Math.atan2(pointB.y - pointA.y, pointB.x - pointA.x) * 180 / Math.PI;
}
/**
 * Compute the output cropped area of the media in percentages and pixels.
 * x/y are the top-left coordinates on the src media
 */

function computeCroppedArea(crop, mediaSize, cropSize, aspect, zoom, rotation, restrictPosition) {
  if (rotation === void 0) {
    rotation = 0;
  }

  if (restrictPosition === void 0) {
    restrictPosition = true;
  } // if the media is rotated by the user, we cannot limit the position anymore
  // as it might need to be negative.


  var limitAreaFn = restrictPosition ? limitArea : noOp;
  var mediaBBoxSize = rotateSize(mediaSize.width, mediaSize.height, rotation);
  var mediaNaturalBBoxSize = rotateSize(mediaSize.naturalWidth, mediaSize.naturalHeight, rotation); // calculate the crop area in percentages
  // in the rotated space

  var croppedAreaPercentages = {
    x: limitAreaFn(100, ((mediaBBoxSize.width - cropSize.width / zoom) / 2 - crop.x / zoom) / mediaBBoxSize.width * 100),
    y: limitAreaFn(100, ((mediaBBoxSize.height - cropSize.height / zoom) / 2 - crop.y / zoom) / mediaBBoxSize.height * 100),
    width: limitAreaFn(100, cropSize.width / mediaBBoxSize.width * 100 / zoom),
    height: limitAreaFn(100, cropSize.height / mediaBBoxSize.height * 100 / zoom)
  }; // we compute the pixels size naively

  var widthInPixels = Math.round(limitAreaFn(mediaNaturalBBoxSize.width, croppedAreaPercentages.width * mediaNaturalBBoxSize.width / 100));
  var heightInPixels = Math.round(limitAreaFn(mediaNaturalBBoxSize.height, croppedAreaPercentages.height * mediaNaturalBBoxSize.height / 100));
  var isImgWiderThanHigh = mediaNaturalBBoxSize.width >= mediaNaturalBBoxSize.height * aspect; // then we ensure the width and height exactly match the aspect (to avoid rounding approximations)
  // if the media is wider than high, when zoom is 0, the crop height will be equals to image height
  // thus we want to compute the width from the height and aspect for accuracy.
  // Otherwise, we compute the height from width and aspect.

  var sizePixels = isImgWiderThanHigh ? {
    width: Math.round(heightInPixels * aspect),
    height: heightInPixels
  } : {
    width: widthInPixels,
    height: Math.round(widthInPixels / aspect)
  };

  var croppedAreaPixels = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__assign"])(Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__assign"])({}, sizePixels), {
    x: Math.round(limitAreaFn(mediaNaturalBBoxSize.width - sizePixels.width, croppedAreaPercentages.x * mediaNaturalBBoxSize.width / 100)),
    y: Math.round(limitAreaFn(mediaNaturalBBoxSize.height - sizePixels.height, croppedAreaPercentages.y * mediaNaturalBBoxSize.height / 100))
  });

  return {
    croppedAreaPercentages: croppedAreaPercentages,
    croppedAreaPixels: croppedAreaPixels
  };
}
/**
 * Ensure the returned value is between 0 and max
 */

function limitArea(max, value) {
  return Math.min(max, Math.max(0, value));
}

function noOp(_max, value) {
  return value;
}
/**
 * Compute crop and zoom from the croppedAreaPercentages.
 */


function getInitialCropFromCroppedAreaPercentages(croppedAreaPercentages, mediaSize, rotation, cropSize, minZoom, maxZoom) {
  var mediaBBoxSize = rotateSize(mediaSize.width, mediaSize.height, rotation); // This is the inverse process of computeCroppedArea

  var zoom = clamp(cropSize.width / mediaBBoxSize.width * (100 / croppedAreaPercentages.width), minZoom, maxZoom);
  var crop = {
    x: zoom * mediaBBoxSize.width / 2 - cropSize.width / 2 - mediaBBoxSize.width * zoom * (croppedAreaPercentages.x / 100),
    y: zoom * mediaBBoxSize.height / 2 - cropSize.height / 2 - mediaBBoxSize.height * zoom * (croppedAreaPercentages.y / 100)
  };
  return {
    crop: crop,
    zoom: zoom
  };
}
/**
 * Compute zoom from the croppedAreaPixels
 */

function getZoomFromCroppedAreaPixels(croppedAreaPixels, mediaSize, cropSize) {
  var mediaZoom = getMediaZoom(mediaSize);
  return cropSize.height > cropSize.width ? cropSize.height / (croppedAreaPixels.height * mediaZoom) : cropSize.width / (croppedAreaPixels.width * mediaZoom);
}
/**
 * Compute crop and zoom from the croppedAreaPixels
 */


function getInitialCropFromCroppedAreaPixels(croppedAreaPixels, mediaSize, rotation, cropSize, minZoom, maxZoom) {
  if (rotation === void 0) {
    rotation = 0;
  }

  var mediaNaturalBBoxSize = rotateSize(mediaSize.naturalWidth, mediaSize.naturalHeight, rotation);
  var zoom = clamp(getZoomFromCroppedAreaPixels(croppedAreaPixels, mediaSize, cropSize), minZoom, maxZoom);
  var cropZoom = cropSize.height > cropSize.width ? cropSize.height / croppedAreaPixels.height : cropSize.width / croppedAreaPixels.width;
  var crop = {
    x: ((mediaNaturalBBoxSize.width - croppedAreaPixels.width) / 2 - croppedAreaPixels.x) * cropZoom,
    y: ((mediaNaturalBBoxSize.height - croppedAreaPixels.height) / 2 - croppedAreaPixels.y) * cropZoom
  };
  return {
    crop: crop,
    zoom: zoom
  };
}
/**
 * Return the point that is the center of point a and b
 */

function getCenter(a, b) {
  return {
    x: (b.x + a.x) / 2,
    y: (b.y + a.y) / 2
  };
}
function getRadianAngle(degreeValue) {
  return degreeValue * Math.PI / 180;
}
/**
 * Returns the new bounding area of a rotated rectangle.
 */

function rotateSize(width, height, rotation) {
  var rotRad = getRadianAngle(rotation);
  return {
    width: Math.abs(Math.cos(rotRad) * width) + Math.abs(Math.sin(rotRad) * height),
    height: Math.abs(Math.sin(rotRad) * width) + Math.abs(Math.cos(rotRad) * height)
  };
}
/**
 * Clamp value between min and max
 */

function clamp(value, min, max) {
  return Math.min(Math.max(value, min), max);
}
/**
 * Combine multiple class names into a single string.
 */

function classNames() {
  var args = [];

  for (var _i = 0; _i < arguments.length; _i++) {
    args[_i] = arguments[_i];
  }

  return args.filter(function (value) {
    if (typeof value === 'string' && value.length > 0) {
      return true;
    }

    return false;
  }).join(' ').trim();
}

var css_248z = ".reactEasyCrop_Container {\n  position: absolute;\n  top: 0;\n  left: 0;\n  right: 0;\n  bottom: 0;\n  overflow: hidden;\n  user-select: none;\n  touch-action: none;\n  cursor: move;\n  display: flex;\n  justify-content: center;\n  align-items: center;\n}\n\n.reactEasyCrop_Image,\n.reactEasyCrop_Video {\n  will-change: transform; /* this improves performances and prevent painting issues on iOS Chrome */\n}\n\n.reactEasyCrop_Contain {\n  max-width: 100%;\n  max-height: 100%;\n  margin: auto;\n  position: absolute;\n  top: 0;\n  bottom: 0;\n  left: 0;\n  right: 0;\n}\n.reactEasyCrop_Cover_Horizontal {\n  width: 100%;\n  height: auto;\n}\n.reactEasyCrop_Cover_Vertical {\n  width: auto;\n  height: 100%;\n}\n\n.reactEasyCrop_CropArea {\n  position: absolute;\n  left: 50%;\n  top: 50%;\n  transform: translate(-50%, -50%);\n  border: 1px solid rgba(255, 255, 255, 0.5);\n  box-sizing: border-box;\n  box-shadow: 0 0 0 9999em;\n  color: rgba(0, 0, 0, 0.5);\n  overflow: hidden;\n}\n\n.reactEasyCrop_CropAreaRound {\n  border-radius: 50%;\n}\n\n.reactEasyCrop_CropAreaGrid::before {\n  content: ' ';\n  box-sizing: border-box;\n  position: absolute;\n  border: 1px solid rgba(255, 255, 255, 0.5);\n  top: 0;\n  bottom: 0;\n  left: 33.33%;\n  right: 33.33%;\n  border-top: 0;\n  border-bottom: 0;\n}\n\n.reactEasyCrop_CropAreaGrid::after {\n  content: ' ';\n  box-sizing: border-box;\n  position: absolute;\n  border: 1px solid rgba(255, 255, 255, 0.5);\n  top: 33.33%;\n  bottom: 33.33%;\n  left: 0;\n  right: 0;\n  border-left: 0;\n  border-right: 0;\n}\n";

var MIN_ZOOM = 1;
var MAX_ZOOM = 3;

var Cropper =
/** @class */
function (_super) {
  Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__extends"])(Cropper, _super);

  function Cropper() {
    var _this = _super !== null && _super.apply(this, arguments) || this;

    _this.imageRef = null;
    _this.videoRef = null;
    _this.containerRef = null;
    _this.styleRef = null;
    _this.containerRect = null;
    _this.mediaSize = {
      width: 0,
      height: 0,
      naturalWidth: 0,
      naturalHeight: 0
    };
    _this.dragStartPosition = {
      x: 0,
      y: 0
    };
    _this.dragStartCrop = {
      x: 0,
      y: 0
    };
    _this.lastPinchDistance = 0;
    _this.lastPinchRotation = 0;
    _this.rafDragTimeout = null;
    _this.rafPinchTimeout = null;
    _this.wheelTimer = null;
    _this.state = {
      cropSize: null,
      hasWheelJustStarted: false
    }; // this is to prevent Safari on iOS >= 10 to zoom the page

    _this.preventZoomSafari = function (e) {
      return e.preventDefault();
    };

    _this.cleanEvents = function () {
      document.removeEventListener('mousemove', _this.onMouseMove);
      document.removeEventListener('mouseup', _this.onDragStopped);
      document.removeEventListener('touchmove', _this.onTouchMove);
      document.removeEventListener('touchend', _this.onDragStopped);
    };

    _this.clearScrollEvent = function () {
      if (_this.containerRef) _this.containerRef.removeEventListener('wheel', _this.onWheel);

      if (_this.wheelTimer) {
        clearTimeout(_this.wheelTimer);
      }
    };

    _this.onMediaLoad = function () {
      var cropSize = _this.computeSizes();

      if (cropSize) {
        _this.emitCropData();

        _this.setInitialCrop(cropSize);
      }

      if (_this.props.onMediaLoaded) {
        _this.props.onMediaLoaded(_this.mediaSize);
      }
    };

    _this.setInitialCrop = function (cropSize) {
      if (_this.props.initialCroppedAreaPercentages) {
        var _a = getInitialCropFromCroppedAreaPercentages(_this.props.initialCroppedAreaPercentages, _this.mediaSize, _this.props.rotation, cropSize, _this.props.minZoom, _this.props.maxZoom),
            crop = _a.crop,
            zoom = _a.zoom;

        _this.props.onCropChange(crop);

        _this.props.onZoomChange && _this.props.onZoomChange(zoom);
      } else if (_this.props.initialCroppedAreaPixels) {
        var _b = getInitialCropFromCroppedAreaPixels(_this.props.initialCroppedAreaPixels, _this.mediaSize, _this.props.rotation, cropSize, _this.props.minZoom, _this.props.maxZoom),
            crop = _b.crop,
            zoom = _b.zoom;

        _this.props.onCropChange(crop);

        _this.props.onZoomChange && _this.props.onZoomChange(zoom);
      }
    };

    _this.computeSizes = function () {
      var _a, _b, _c, _d, _e, _f;

      var mediaRef = _this.imageRef || _this.videoRef;

      if (mediaRef && _this.containerRef) {
        _this.containerRect = _this.containerRef.getBoundingClientRect();
        var containerAspect = _this.containerRect.width / _this.containerRect.height;
        var naturalWidth = ((_a = _this.imageRef) === null || _a === void 0 ? void 0 : _a.naturalWidth) || ((_b = _this.videoRef) === null || _b === void 0 ? void 0 : _b.videoWidth) || 0;
        var naturalHeight = ((_c = _this.imageRef) === null || _c === void 0 ? void 0 : _c.naturalHeight) || ((_d = _this.videoRef) === null || _d === void 0 ? void 0 : _d.videoHeight) || 0;
        var isMediaScaledDown = mediaRef.offsetWidth < naturalWidth || mediaRef.offsetHeight < naturalHeight;
        var mediaAspect = naturalWidth / naturalHeight; // We do not rely on the offsetWidth/offsetHeight if the media is scaled down
        // as the values they report are rounded. That will result in precision losses
        // when calculating zoom. We use the fact that the media is positionned relative
        // to the container. That allows us to use the container's dimensions
        // and natural aspect ratio of the media to calculate accurate media size.
        // However, for this to work, the container should not be rotated

        var renderedMediaSize = void 0;

        if (isMediaScaledDown) {
          switch (_this.props.objectFit) {
            default:
            case 'contain':
              renderedMediaSize = containerAspect > mediaAspect ? {
                width: _this.containerRect.height * mediaAspect,
                height: _this.containerRect.height
              } : {
                width: _this.containerRect.width,
                height: _this.containerRect.width / mediaAspect
              };
              break;

            case 'horizontal-cover':
              renderedMediaSize = {
                width: _this.containerRect.width,
                height: _this.containerRect.width / mediaAspect
              };
              break;

            case 'vertical-cover':
              renderedMediaSize = {
                width: _this.containerRect.height * mediaAspect,
                height: _this.containerRect.height
              };
              break;
          }
        } else {
          renderedMediaSize = {
            width: mediaRef.offsetWidth,
            height: mediaRef.offsetHeight
          };
        }

        _this.mediaSize = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__assign"])(Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__assign"])({}, renderedMediaSize), {
          naturalWidth: naturalWidth,
          naturalHeight: naturalHeight
        });
        var cropSize = _this.props.cropSize ? _this.props.cropSize : getCropSize(_this.mediaSize.width, _this.mediaSize.height, _this.containerRect.width, _this.containerRect.height, _this.props.aspect, _this.props.rotation);

        if (((_e = _this.state.cropSize) === null || _e === void 0 ? void 0 : _e.height) !== cropSize.height || ((_f = _this.state.cropSize) === null || _f === void 0 ? void 0 : _f.width) !== cropSize.width) {
          _this.props.onCropSizeChange && _this.props.onCropSizeChange(cropSize);
        }

        _this.setState({
          cropSize: cropSize
        }, _this.recomputeCropPosition);

        return cropSize;
      }
    };

    _this.onMouseDown = function (e) {
      e.preventDefault();
      document.addEventListener('mousemove', _this.onMouseMove);
      document.addEventListener('mouseup', _this.onDragStopped);

      _this.onDragStart(Cropper.getMousePoint(e));
    };

    _this.onMouseMove = function (e) {
      return _this.onDrag(Cropper.getMousePoint(e));
    };

    _this.onTouchStart = function (e) {
      document.addEventListener('touchmove', _this.onTouchMove, {
        passive: false
      }); // iOS 11 now defaults to passive: true

      document.addEventListener('touchend', _this.onDragStopped);

      if (e.touches.length === 2) {
        _this.onPinchStart(e);
      } else if (e.touches.length === 1) {
        _this.onDragStart(Cropper.getTouchPoint(e.touches[0]));
      }
    };

    _this.onTouchMove = function (e) {
      // Prevent whole page from scrolling on iOS.
      e.preventDefault();

      if (e.touches.length === 2) {
        _this.onPinchMove(e);
      } else if (e.touches.length === 1) {
        _this.onDrag(Cropper.getTouchPoint(e.touches[0]));
      }
    };

    _this.onDragStart = function (_a) {
      var _b, _c;

      var x = _a.x,
          y = _a.y;
      _this.dragStartPosition = {
        x: x,
        y: y
      };
      _this.dragStartCrop = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__assign"])({}, _this.props.crop);
      (_c = (_b = _this.props).onInteractionStart) === null || _c === void 0 ? void 0 : _c.call(_b);
    };

    _this.onDrag = function (_a) {
      var x = _a.x,
          y = _a.y;
      if (_this.rafDragTimeout) window.cancelAnimationFrame(_this.rafDragTimeout);
      _this.rafDragTimeout = window.requestAnimationFrame(function () {
        if (!_this.state.cropSize) return;
        if (x === undefined || y === undefined) return;
        var offsetX = x - _this.dragStartPosition.x;
        var offsetY = y - _this.dragStartPosition.y;
        var requestedPosition = {
          x: _this.dragStartCrop.x + offsetX,
          y: _this.dragStartCrop.y + offsetY
        };
        var newPosition = _this.props.restrictPosition ? restrictPosition(requestedPosition, _this.mediaSize, _this.state.cropSize, _this.props.zoom, _this.props.rotation) : requestedPosition;

        _this.props.onCropChange(newPosition);
      });
    };

    _this.onDragStopped = function () {
      var _a, _b;

      _this.cleanEvents();

      _this.emitCropData();

      (_b = (_a = _this.props).onInteractionEnd) === null || _b === void 0 ? void 0 : _b.call(_a);
    };

    _this.onWheel = function (e) {
      e.preventDefault();
      var point = Cropper.getMousePoint(e);
      var pixelY = normalize_wheel__WEBPACK_IMPORTED_MODULE_2___default()(e).pixelY;
      var newZoom = _this.props.zoom - pixelY * _this.props.zoomSpeed / 200;

      _this.setNewZoom(newZoom, point);

      if (!_this.state.hasWheelJustStarted) {
        _this.setState({
          hasWheelJustStarted: true
        }, function () {
          var _a, _b;

          return (_b = (_a = _this.props).onInteractionStart) === null || _b === void 0 ? void 0 : _b.call(_a);
        });
      }

      if (_this.wheelTimer) {
        clearTimeout(_this.wheelTimer);
      }

      _this.wheelTimer = window.setTimeout(function () {
        return _this.setState({
          hasWheelJustStarted: false
        }, function () {
          var _a, _b;

          return (_b = (_a = _this.props).onInteractionEnd) === null || _b === void 0 ? void 0 : _b.call(_a);
        });
      }, 250);
    };

    _this.getPointOnContainer = function (_a) {
      var x = _a.x,
          y = _a.y;

      if (!_this.containerRect) {
        throw new Error('The Cropper is not mounted');
      }

      return {
        x: _this.containerRect.width / 2 - (x - _this.containerRect.left),
        y: _this.containerRect.height / 2 - (y - _this.containerRect.top)
      };
    };

    _this.getPointOnMedia = function (_a) {
      var x = _a.x,
          y = _a.y;
      var _b = _this.props,
          crop = _b.crop,
          zoom = _b.zoom;
      return {
        x: (x + crop.x) / zoom,
        y: (y + crop.y) / zoom
      };
    };

    _this.setNewZoom = function (zoom, point) {
      if (!_this.state.cropSize || !_this.props.onZoomChange) return;

      var zoomPoint = _this.getPointOnContainer(point);

      var zoomTarget = _this.getPointOnMedia(zoomPoint);

      var newZoom = clamp(zoom, _this.props.minZoom, _this.props.maxZoom);
      var requestedPosition = {
        x: zoomTarget.x * newZoom - zoomPoint.x,
        y: zoomTarget.y * newZoom - zoomPoint.y
      };
      var newPosition = _this.props.restrictPosition ? restrictPosition(requestedPosition, _this.mediaSize, _this.state.cropSize, newZoom, _this.props.rotation) : requestedPosition;

      _this.props.onCropChange(newPosition);

      _this.props.onZoomChange(newZoom);
    };

    _this.getCropData = function () {
      if (!_this.state.cropSize) {
        return null;
      } // this is to ensure the crop is correctly restricted after a zoom back (https://github.com/ricardo-ch/react-easy-crop/issues/6)


      var restrictedPosition = _this.props.restrictPosition ? restrictPosition(_this.props.crop, _this.mediaSize, _this.state.cropSize, _this.props.zoom, _this.props.rotation) : _this.props.crop;
      return computeCroppedArea(restrictedPosition, _this.mediaSize, _this.state.cropSize, _this.getAspect(), _this.props.zoom, _this.props.rotation, _this.props.restrictPosition);
    };

    _this.emitCropData = function () {
      var cropData = _this.getCropData();

      if (!cropData) return;
      var croppedAreaPercentages = cropData.croppedAreaPercentages,
          croppedAreaPixels = cropData.croppedAreaPixels;

      if (_this.props.onCropComplete) {
        _this.props.onCropComplete(croppedAreaPercentages, croppedAreaPixels);
      }

      if (_this.props.onCropAreaChange) {
        _this.props.onCropAreaChange(croppedAreaPercentages, croppedAreaPixels);
      }
    };

    _this.emitCropAreaChange = function () {
      var cropData = _this.getCropData();

      if (!cropData) return;
      var croppedAreaPercentages = cropData.croppedAreaPercentages,
          croppedAreaPixels = cropData.croppedAreaPixels;

      if (_this.props.onCropAreaChange) {
        _this.props.onCropAreaChange(croppedAreaPercentages, croppedAreaPixels);
      }
    };

    _this.recomputeCropPosition = function () {
      if (!_this.state.cropSize) return;
      var newPosition = _this.props.restrictPosition ? restrictPosition(_this.props.crop, _this.mediaSize, _this.state.cropSize, _this.props.zoom, _this.props.rotation) : _this.props.crop;

      _this.props.onCropChange(newPosition);

      _this.emitCropData();
    };

    return _this;
  }

  Cropper.prototype.componentDidMount = function () {
    window.addEventListener('resize', this.computeSizes);

    if (this.containerRef) {
      this.props.zoomWithScroll && this.containerRef.addEventListener('wheel', this.onWheel, {
        passive: false
      });
      this.containerRef.addEventListener('gesturestart', this.preventZoomSafari);
      this.containerRef.addEventListener('gesturechange', this.preventZoomSafari);
    }

    if (!this.props.disableAutomaticStylesInjection) {
      this.styleRef = document.createElement('style');
      this.styleRef.setAttribute('type', 'text/css');
      this.styleRef.innerHTML = css_248z;
      document.head.appendChild(this.styleRef);
    } // when rendered via SSR, the image can already be loaded and its onLoad callback will never be called


    if (this.imageRef && this.imageRef.complete) {
      this.onMediaLoad();
    }
  };

  Cropper.prototype.componentWillUnmount = function () {
    var _a;

    window.removeEventListener('resize', this.computeSizes);

    if (this.containerRef) {
      this.containerRef.removeEventListener('gesturestart', this.preventZoomSafari);
      this.containerRef.removeEventListener('gesturechange', this.preventZoomSafari);
    }

    if (this.styleRef) {
      (_a = this.styleRef.parentNode) === null || _a === void 0 ? void 0 : _a.removeChild(this.styleRef);
    }

    this.cleanEvents();
    this.props.zoomWithScroll && this.clearScrollEvent();
  };

  Cropper.prototype.componentDidUpdate = function (prevProps) {
    var _a, _b, _c, _d, _e, _f, _g, _h, _j;

    if (prevProps.rotation !== this.props.rotation) {
      this.computeSizes();
      this.recomputeCropPosition();
    } else if (prevProps.aspect !== this.props.aspect) {
      this.computeSizes();
    } else if (prevProps.zoom !== this.props.zoom) {
      this.recomputeCropPosition();
    } else if (((_a = prevProps.cropSize) === null || _a === void 0 ? void 0 : _a.height) !== ((_b = this.props.cropSize) === null || _b === void 0 ? void 0 : _b.height) || ((_c = prevProps.cropSize) === null || _c === void 0 ? void 0 : _c.width) !== ((_d = this.props.cropSize) === null || _d === void 0 ? void 0 : _d.width)) {
      this.computeSizes();
    } else if (((_e = prevProps.crop) === null || _e === void 0 ? void 0 : _e.x) !== ((_f = this.props.crop) === null || _f === void 0 ? void 0 : _f.x) || ((_g = prevProps.crop) === null || _g === void 0 ? void 0 : _g.y) !== ((_h = this.props.crop) === null || _h === void 0 ? void 0 : _h.y)) {
      this.emitCropAreaChange();
    }

    if (prevProps.zoomWithScroll !== this.props.zoomWithScroll && this.containerRef) {
      this.props.zoomWithScroll ? this.containerRef.addEventListener('wheel', this.onWheel, {
        passive: false
      }) : this.clearScrollEvent();
    }

    if (prevProps.video !== this.props.video) {
      (_j = this.videoRef) === null || _j === void 0 ? void 0 : _j.load();
    }
  };

  Cropper.prototype.getAspect = function () {
    var _a = this.props,
        cropSize = _a.cropSize,
        aspect = _a.aspect;

    if (cropSize) {
      return cropSize.width / cropSize.height;
    }

    return aspect;
  };

  Cropper.prototype.onPinchStart = function (e) {
    var pointA = Cropper.getTouchPoint(e.touches[0]);
    var pointB = Cropper.getTouchPoint(e.touches[1]);
    this.lastPinchDistance = getDistanceBetweenPoints(pointA, pointB);
    this.lastPinchRotation = getRotationBetweenPoints(pointA, pointB);
    this.onDragStart(getCenter(pointA, pointB));
  };

  Cropper.prototype.onPinchMove = function (e) {
    var _this = this;

    var pointA = Cropper.getTouchPoint(e.touches[0]);
    var pointB = Cropper.getTouchPoint(e.touches[1]);
    var center = getCenter(pointA, pointB);
    this.onDrag(center);
    if (this.rafPinchTimeout) window.cancelAnimationFrame(this.rafPinchTimeout);
    this.rafPinchTimeout = window.requestAnimationFrame(function () {
      var distance = getDistanceBetweenPoints(pointA, pointB);
      var newZoom = _this.props.zoom * (distance / _this.lastPinchDistance);

      _this.setNewZoom(newZoom, center);

      _this.lastPinchDistance = distance;
      var rotation = getRotationBetweenPoints(pointA, pointB);
      var newRotation = _this.props.rotation + (rotation - _this.lastPinchRotation);
      _this.props.onRotationChange && _this.props.onRotationChange(newRotation);
      _this.lastPinchRotation = rotation;
    });
  };

  Cropper.prototype.render = function () {
    var _this = this;

    var _a = this.props,
        image = _a.image,
        video = _a.video,
        mediaProps = _a.mediaProps,
        transform = _a.transform,
        _b = _a.crop,
        x = _b.x,
        y = _b.y,
        rotation = _a.rotation,
        zoom = _a.zoom,
        cropShape = _a.cropShape,
        showGrid = _a.showGrid,
        _c = _a.style,
        containerStyle = _c.containerStyle,
        cropAreaStyle = _c.cropAreaStyle,
        mediaStyle = _c.mediaStyle,
        _d = _a.classes,
        containerClassName = _d.containerClassName,
        cropAreaClassName = _d.cropAreaClassName,
        mediaClassName = _d.mediaClassName,
        objectFit = _a.objectFit;
    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
      onMouseDown: this.onMouseDown,
      onTouchStart: this.onTouchStart,
      ref: function ref(el) {
        return _this.containerRef = el;
      },
      "data-testid": "container",
      style: containerStyle,
      className: classNames('reactEasyCrop_Container', containerClassName)
    }, image ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("img", Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__assign"])({
      alt: "",
      className: classNames('reactEasyCrop_Image', objectFit === 'contain' && 'reactEasyCrop_Contain', objectFit === 'horizontal-cover' && 'reactEasyCrop_Cover_Horizontal', objectFit === 'vertical-cover' && 'reactEasyCrop_Cover_Vertical', mediaClassName)
    }, mediaProps, {
      src: image,
      ref: function ref(el) {
        return _this.imageRef = el;
      },
      style: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__assign"])(Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__assign"])({}, mediaStyle), {
        transform: transform || "translate(" + x + "px, " + y + "px) rotate(" + rotation + "deg) scale(" + zoom + ")"
      }),
      onLoad: this.onMediaLoad
    })) : video && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("video", Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__assign"])({
      autoPlay: true,
      loop: true,
      muted: true,
      className: classNames('reactEasyCrop_Video', objectFit === 'contain' && 'reactEasyCrop_Contain', objectFit === 'horizontal-cover' && 'reactEasyCrop_Cover_Horizontal', objectFit === 'vertical-cover' && 'reactEasyCrop_Cover_Vertical', mediaClassName)
    }, mediaProps, {
      ref: function ref(el) {
        return _this.videoRef = el;
      },
      onLoadedMetadata: this.onMediaLoad,
      style: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__assign"])(Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__assign"])({}, mediaStyle), {
        transform: transform || "translate(" + x + "px, " + y + "px) rotate(" + rotation + "deg) scale(" + zoom + ")"
      }),
      controls: false
    }), (Array.isArray(video) ? video : [{
      src: video
    }]).map(function (item) {
      return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("source", Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__assign"])({
        key: item.src
      }, item));
    })), this.state.cropSize && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
      style: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__assign"])(Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__assign"])({}, cropAreaStyle), {
        width: this.state.cropSize.width,
        height: this.state.cropSize.height
      }),
      "data-testid": "cropper",
      className: classNames('reactEasyCrop_CropArea', cropShape === 'round' && 'reactEasyCrop_CropAreaRound', showGrid && 'reactEasyCrop_CropAreaGrid', cropAreaClassName)
    }));
  };

  Cropper.defaultProps = {
    zoom: 1,
    rotation: 0,
    aspect: 4 / 3,
    maxZoom: MAX_ZOOM,
    minZoom: MIN_ZOOM,
    cropShape: 'rect',
    objectFit: 'contain',
    showGrid: true,
    style: {},
    classes: {},
    mediaProps: {},
    zoomSpeed: 1,
    restrictPosition: true,
    zoomWithScroll: true
  };

  Cropper.getMousePoint = function (e) {
    return {
      x: Number(e.clientX),
      y: Number(e.clientY)
    };
  };

  Cropper.getTouchPoint = function (touch) {
    return {
      x: Number(touch.clientX),
      y: Number(touch.clientY)
    };
  };

  return Cropper;
}(react__WEBPACK_IMPORTED_MODULE_1___default.a.Component);

/* harmony default export */ __webpack_exports__["default"] = (Cropper);
//# sourceMappingURL=index.module.js.map


/***/ }),

/***/ "./node_modules/react-easy-crop/node_modules/tslib/tslib.es6.js":
/*!**********************************************************************!*\
  !*** ./node_modules/react-easy-crop/node_modules/tslib/tslib.es6.js ***!
  \**********************************************************************/
/*! exports provided: __extends, __assign, __rest, __decorate, __param, __metadata, __awaiter, __generator, __createBinding, __exportStar, __values, __read, __spread, __spreadArrays, __await, __asyncGenerator, __asyncDelegator, __asyncValues, __makeTemplateObject, __importStar, __importDefault, __classPrivateFieldGet, __classPrivateFieldSet */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "__extends", function() { return __extends; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "__assign", function() { return __assign; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "__rest", function() { return __rest; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "__decorate", function() { return __decorate; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "__param", function() { return __param; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "__metadata", function() { return __metadata; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "__awaiter", function() { return __awaiter; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "__generator", function() { return __generator; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "__createBinding", function() { return __createBinding; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "__exportStar", function() { return __exportStar; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "__values", function() { return __values; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "__read", function() { return __read; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "__spread", function() { return __spread; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "__spreadArrays", function() { return __spreadArrays; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "__await", function() { return __await; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "__asyncGenerator", function() { return __asyncGenerator; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "__asyncDelegator", function() { return __asyncDelegator; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "__asyncValues", function() { return __asyncValues; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "__makeTemplateObject", function() { return __makeTemplateObject; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "__importStar", function() { return __importStar; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "__importDefault", function() { return __importDefault; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "__classPrivateFieldGet", function() { return __classPrivateFieldGet; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "__classPrivateFieldSet", function() { return __classPrivateFieldSet; });
/*! *****************************************************************************
Copyright (c) Microsoft Corporation.

Permission to use, copy, modify, and/or distribute this software for any
purpose with or without fee is hereby granted.

THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES WITH
REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF MERCHANTABILITY
AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY SPECIAL, DIRECT,
INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES WHATSOEVER RESULTING FROM
LOSS OF USE, DATA OR PROFITS, WHETHER IN AN ACTION OF CONTRACT, NEGLIGENCE OR
OTHER TORTIOUS ACTION, ARISING OUT OF OR IN CONNECTION WITH THE USE OR
PERFORMANCE OF THIS SOFTWARE.
***************************************************************************** */
/* global Reflect, Promise */

var extendStatics = function(d, b) {
    extendStatics = Object.setPrototypeOf ||
        ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
        function (d, b) { for (var p in b) if (Object.prototype.hasOwnProperty.call(b, p)) d[p] = b[p]; };
    return extendStatics(d, b);
};

function __extends(d, b) {
    extendStatics(d, b);
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
}

var __assign = function() {
    __assign = Object.assign || function __assign(t) {
        for (var s, i = 1, n = arguments.length; i < n; i++) {
            s = arguments[i];
            for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p)) t[p] = s[p];
        }
        return t;
    }
    return __assign.apply(this, arguments);
}

function __rest(s, e) {
    var t = {};
    for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p) && e.indexOf(p) < 0)
        t[p] = s[p];
    if (s != null && typeof Object.getOwnPropertySymbols === "function")
        for (var i = 0, p = Object.getOwnPropertySymbols(s); i < p.length; i++) {
            if (e.indexOf(p[i]) < 0 && Object.prototype.propertyIsEnumerable.call(s, p[i]))
                t[p[i]] = s[p[i]];
        }
    return t;
}

function __decorate(decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
}

function __param(paramIndex, decorator) {
    return function (target, key) { decorator(target, key, paramIndex); }
}

function __metadata(metadataKey, metadataValue) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(metadataKey, metadataValue);
}

function __awaiter(thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
}

function __generator(thisArg, body) {
    var _ = { label: 0, sent: function() { if (t[0] & 1) throw t[1]; return t[1]; }, trys: [], ops: [] }, f, y, t, g;
    return g = { next: verb(0), "throw": verb(1), "return": verb(2) }, typeof Symbol === "function" && (g[Symbol.iterator] = function() { return this; }), g;
    function verb(n) { return function (v) { return step([n, v]); }; }
    function step(op) {
        if (f) throw new TypeError("Generator is already executing.");
        while (_) try {
            if (f = 1, y && (t = op[0] & 2 ? y["return"] : op[0] ? y["throw"] || ((t = y["return"]) && t.call(y), 0) : y.next) && !(t = t.call(y, op[1])).done) return t;
            if (y = 0, t) op = [op[0] & 2, t.value];
            switch (op[0]) {
                case 0: case 1: t = op; break;
                case 4: _.label++; return { value: op[1], done: false };
                case 5: _.label++; y = op[1]; op = [0]; continue;
                case 7: op = _.ops.pop(); _.trys.pop(); continue;
                default:
                    if (!(t = _.trys, t = t.length > 0 && t[t.length - 1]) && (op[0] === 6 || op[0] === 2)) { _ = 0; continue; }
                    if (op[0] === 3 && (!t || (op[1] > t[0] && op[1] < t[3]))) { _.label = op[1]; break; }
                    if (op[0] === 6 && _.label < t[1]) { _.label = t[1]; t = op; break; }
                    if (t && _.label < t[2]) { _.label = t[2]; _.ops.push(op); break; }
                    if (t[2]) _.ops.pop();
                    _.trys.pop(); continue;
            }
            op = body.call(thisArg, _);
        } catch (e) { op = [6, e]; y = 0; } finally { f = t = 0; }
        if (op[0] & 5) throw op[1]; return { value: op[0] ? op[1] : void 0, done: true };
    }
}

var __createBinding = Object.create ? (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    Object.defineProperty(o, k2, { enumerable: true, get: function() { return m[k]; } });
}) : (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    o[k2] = m[k];
});

function __exportStar(m, o) {
    for (var p in m) if (p !== "default" && !Object.prototype.hasOwnProperty.call(o, p)) __createBinding(o, m, p);
}

function __values(o) {
    var s = typeof Symbol === "function" && Symbol.iterator, m = s && o[s], i = 0;
    if (m) return m.call(o);
    if (o && typeof o.length === "number") return {
        next: function () {
            if (o && i >= o.length) o = void 0;
            return { value: o && o[i++], done: !o };
        }
    };
    throw new TypeError(s ? "Object is not iterable." : "Symbol.iterator is not defined.");
}

function __read(o, n) {
    var m = typeof Symbol === "function" && o[Symbol.iterator];
    if (!m) return o;
    var i = m.call(o), r, ar = [], e;
    try {
        while ((n === void 0 || n-- > 0) && !(r = i.next()).done) ar.push(r.value);
    }
    catch (error) { e = { error: error }; }
    finally {
        try {
            if (r && !r.done && (m = i["return"])) m.call(i);
        }
        finally { if (e) throw e.error; }
    }
    return ar;
}

function __spread() {
    for (var ar = [], i = 0; i < arguments.length; i++)
        ar = ar.concat(__read(arguments[i]));
    return ar;
}

function __spreadArrays() {
    for (var s = 0, i = 0, il = arguments.length; i < il; i++) s += arguments[i].length;
    for (var r = Array(s), k = 0, i = 0; i < il; i++)
        for (var a = arguments[i], j = 0, jl = a.length; j < jl; j++, k++)
            r[k] = a[j];
    return r;
};

function __await(v) {
    return this instanceof __await ? (this.v = v, this) : new __await(v);
}

function __asyncGenerator(thisArg, _arguments, generator) {
    if (!Symbol.asyncIterator) throw new TypeError("Symbol.asyncIterator is not defined.");
    var g = generator.apply(thisArg, _arguments || []), i, q = [];
    return i = {}, verb("next"), verb("throw"), verb("return"), i[Symbol.asyncIterator] = function () { return this; }, i;
    function verb(n) { if (g[n]) i[n] = function (v) { return new Promise(function (a, b) { q.push([n, v, a, b]) > 1 || resume(n, v); }); }; }
    function resume(n, v) { try { step(g[n](v)); } catch (e) { settle(q[0][3], e); } }
    function step(r) { r.value instanceof __await ? Promise.resolve(r.value.v).then(fulfill, reject) : settle(q[0][2], r); }
    function fulfill(value) { resume("next", value); }
    function reject(value) { resume("throw", value); }
    function settle(f, v) { if (f(v), q.shift(), q.length) resume(q[0][0], q[0][1]); }
}

function __asyncDelegator(o) {
    var i, p;
    return i = {}, verb("next"), verb("throw", function (e) { throw e; }), verb("return"), i[Symbol.iterator] = function () { return this; }, i;
    function verb(n, f) { i[n] = o[n] ? function (v) { return (p = !p) ? { value: __await(o[n](v)), done: n === "return" } : f ? f(v) : v; } : f; }
}

function __asyncValues(o) {
    if (!Symbol.asyncIterator) throw new TypeError("Symbol.asyncIterator is not defined.");
    var m = o[Symbol.asyncIterator], i;
    return m ? m.call(o) : (o = typeof __values === "function" ? __values(o) : o[Symbol.iterator](), i = {}, verb("next"), verb("throw"), verb("return"), i[Symbol.asyncIterator] = function () { return this; }, i);
    function verb(n) { i[n] = o[n] && function (v) { return new Promise(function (resolve, reject) { v = o[n](v), settle(resolve, reject, v.done, v.value); }); }; }
    function settle(resolve, reject, d, v) { Promise.resolve(v).then(function(v) { resolve({ value: v, done: d }); }, reject); }
}

function __makeTemplateObject(cooked, raw) {
    if (Object.defineProperty) { Object.defineProperty(cooked, "raw", { value: raw }); } else { cooked.raw = raw; }
    return cooked;
};

var __setModuleDefault = Object.create ? (function(o, v) {
    Object.defineProperty(o, "default", { enumerable: true, value: v });
}) : function(o, v) {
    o["default"] = v;
};

function __importStar(mod) {
    if (mod && mod.__esModule) return mod;
    var result = {};
    if (mod != null) for (var k in mod) if (k !== "default" && Object.prototype.hasOwnProperty.call(mod, k)) __createBinding(result, mod, k);
    __setModuleDefault(result, mod);
    return result;
}

function __importDefault(mod) {
    return (mod && mod.__esModule) ? mod : { default: mod };
}

function __classPrivateFieldGet(receiver, privateMap) {
    if (!privateMap.has(receiver)) {
        throw new TypeError("attempted to get private field on non-instance");
    }
    return privateMap.get(receiver);
}

function __classPrivateFieldSet(receiver, privateMap, value) {
    if (!privateMap.has(receiver)) {
        throw new TypeError("attempted to set private field on non-instance");
    }
    privateMap.set(receiver, value);
    return value;
}


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

/***/ "@wordpress/i18n":
/*!******************************!*\
  !*** external ["wp","i18n"] ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = window["wp"]["i18n"]; }());

/***/ }),

/***/ "@wordpress/url":
/*!*****************************!*\
  !*** external ["wp","url"] ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = window["wp"]["url"]; }());

/***/ }),

/***/ "react":
/*!*********************************!*\
  !*** external {"this":"React"} ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = this["React"]; }());

/***/ })

/******/ });
//# sourceMappingURL=profile.js.map