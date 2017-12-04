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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 46);
/******/ })
/************************************************************************/
/******/ ({

/***/ 46:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(47);


/***/ }),

/***/ 47:
/***/ (function(module, exports) {

//adds all the hours together and displays it in the table
function updateTotals(row) {
	var mb = $('#' + row + "morningbegin").find(":selected").text().split(':');
	var me = $('#' + row + "morningend").find(":selected").text().split(':');
	var ab = $('#' + row + "afternoonbegin").find(":selected").text().split(':');
	var ae = $('#' + row + "afternoonend").find(":selected").text().split(':');
	var eb = $('#' + row + "eveningbegin").find(":selected").text().split(':');
	var ee = $('#' + row + "eveningend").find(":selected").text().split(':');

	if (ab[0] == 12) {
		ab[0] = 0;
	}

	if (ee[0] == 1) {
		ee[0] = 13;
	}

	var m = me[0] - mb[0];
	m = m || 0;
	var a = ae[0] - ab[0];
	a = a || 0;
	var e = ee[0] - eb[0];
	e = e || 0;
	var tot = m + a + e;

	$('#' + row + "total").text(tot);
	$('#' + row + "totalin").val(tot);
	updateTotal();
}

//calculates the total hours worked
function updateTotal() {

	var week1total = 0;
	var week2total = 0;
	var temp = 0;

	for (var i = 0; i < 7; i++) {
		if (!isNaN(temp = parseInt($('#' + i + 'total').text()))) {
			week1total += temp;
		}
	}

	for (var i = 7; i < 14; i++) {
		if (!isNaN(temp = parseInt($('#' + i + 'total').text()))) {
			week2total += temp;
		}
	}

	$('#week1total').text(week1total);
	$('#week2total').text(week2total);
	$('#total').text(week1total + week2total);
	$('#week1totalin').val(week1total);
	$('#week2totalin').val(week2total);
	$('#totalin').val(week1total + week2total);
}

$(document).ready(function () {
	for (var i = 0; i < 14; i++) {
		updateTotals(i);
		console.log(i);
	}
});

/***/ })

/******/ });