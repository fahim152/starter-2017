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
/******/ 	return __webpack_require__(__webpack_require__.s = 132);
/******/ })
/************************************************************************/
/******/ ({

/***/ 132:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(133);


/***/ }),

/***/ 133:
/***/ (function(module, exports) {

function showChart(selector_name, chart_title, chart_data) {
    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable(chart_data);

        var options = {
            title: chart_title,
            curveType: 'function'
        };

        var chart = new google.visualization.LineChart(document.getElementById(selector_name));

        chart.draw(data, options);
    }
}
function loadResidenceChart() {
    var type = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'month';

    if ($("#prc_chart").length) {
        $.ajax({
            url: '/charts/residence',
            type: 'POST',
            data: {
                type: type
            }
        }).done(function (response) {
            var data = response.data;
            var selector_name = 'prc_chart';
            showChart(selector_name, 'Residence Chart', data);
        });
    }
}

function loadForeignerChart() {
    var type = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'month';

    if ($("#ftp_chart").length) {
        $.ajax({
            url: '/charts/foreigner',
            type: 'POST',
            data: {
                type: type
            }
        }).done(function (response) {
            var data = response.data;
            var selector_name = 'ftp_chart';
            showChart(selector_name, 'Foreigner Chart', data);
        });
    }
}

$('#chartResidenceSelector').change(function () {
    var option = $(this).find('option:selected').val();
    loadResidenceChart(option);
});

$('#chartForeignerSelector').change(function () {
    var option = $(this).find('option:selected').val();
    loadForeignerChart(option);
});

$(document).ready(function () {
    loadResidenceChart('month');
    loadForeignerChart('month');
});

/***/ })

/******/ });