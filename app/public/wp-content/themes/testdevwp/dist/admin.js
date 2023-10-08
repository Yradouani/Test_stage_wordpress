/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js-admin/image-upload.js":
/*!**************************************!*\
  !*** ./src/js-admin/image-upload.js ***!
  \**************************************/
/***/ (() => {

// import { media, select } from 'wp';

jQuery('.services-types-image-upload').on('click', function (event) {
  event.preventDefault();
  event.stopImmediatePropagation();
  var file_frame = wp.media.frames.file_frame = wp.media({
    title: 'Sélectionner une image',
    multiple: false
  });
  file_frame.open().on('select', function () {
    var uploadedImage = file_frame.state().get('selection').first().toJSON();
    console.log(uploadedImage);
    var imageId = uploadedImage.id;
    var imageSrc = uploadedImage.url;
    console.log(imageId);
    console.log(jQuery('#services_types_image'));
    jQuery('#services_types_image').val(imageId);
    if (jQuery('#update-img-container img').length > 0) {
      console.log("coucou");
      jQuery('#update-img-container img').attr('src', imageSrc);
    } else {
      var newImage = jQuery('<img>').attr('src', imageSrc);
      console.log("salut");
      console.log(newImage);
      jQuery('#update-img-container').append(newImage);
    }
  });
  return false;
});
jQuery('.services-types-image-remove').on('click', function (event) {
  jQuery('#services_types_image').val("");
});

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
(() => {
"use strict";
/*!****************************!*\
  !*** ./src/index-admin.js ***!
  \****************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _js_admin_image_upload__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./js-admin/image-upload */ "./src/js-admin/image-upload.js");
/* harmony import */ var _js_admin_image_upload__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_js_admin_image_upload__WEBPACK_IMPORTED_MODULE_0__);

})();

/******/ })()
;
//# sourceMappingURL=admin.js.map