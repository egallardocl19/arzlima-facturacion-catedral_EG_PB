//   Ecommerce-seller
// get colors array from the string
function getChartColorsArray(chartId) {
    var colors = $(chartId).attr('data-colors');
    var colors = JSON.parse(colors);
    return colors.map(function (value) {
        var newValue = value.replace(' ', '');
        if (newValue.indexOf('--') != -1) {
            var color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
            if (color) return color;
        } else {
            return newValue;
        }
    })
}


!function ($) {
    "use strict";

    var ChartJs = function () { };

    ChartJs.prototype.respChart = function (selector, type, data, options) {
        Chart.defaults.global.defaultFontColor = "#858d98",
            Chart.defaults.scale.gridLines.color = "rgba(133, 141, 152, 0.1)";
        // get selector by context
        var ctx = selector.get(0).getContext("2d");
        // pointing parent container to make chart js inherit its width
        var container = $(selector).parent();

        // enable resizing matter
        $(window).resize(generateChart);

        // this function produce the responsive Chart JS
        function generateChart() {
            // make chart width fit with its container
            var ww = selector.attr('width', $(container).width());
            switch (type) {
                case 'Line':
                    new Chart(ctx, { type: 'line', data: data, options: options });
                    break;
                case 'Doughnut':
                    new Chart(ctx, { type: 'doughnut', data: data, options: options });
                    break;
                case 'Pie':
                    new Chart(ctx, { type: 'pie', data: data, options: options });
                    break;
                case 'Bar':
                    new Chart(ctx, { type: 'bar', data: data, options: options });
                    break;
                case 'Radar':
                    new Chart(ctx, { type: 'radar', data: data, options: options });
                    break;
                case 'PolarArea':
                    new Chart(ctx, { data: data, type: 'polarArea', options: options });
                    break;
            }
            // Initiate new chart or Redraw

        };
        // run function - render chart at first load
        generateChart();
    },
        //init
        ChartJs.prototype.init = function () {
            //barchart
            var barChartColors = getChartColorsArray("#bar");
            var barChart = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "Sales Analytics",
                        backgroundColor: barChartColors[0],
                        borderColor: barChartColors[0],
                        borderWidth: 0,
                        hoverBackgroundColor: barChartColors[0],
                        hoverBorderColor: barChartColors[0],
                        data: [65, 59, 81, 45, 56, 80, 50, 20]
                    }
                ]
            };
            var barOpts = {
                scales: {
                    xAxes: [{
                        barPercentage: 0.2
                    }]
                }
            }
            this.respChart($("#bar"), 'Bar', barChart, barOpts);

            //donut chart
            var donutChartColors = getChartColorsArray("#doughnut");
            var donutChart = {
                labels: [
                    "Desktops",
                    "Tablets"
                ],
                datasets: [
                    {
                        data: [350, 150],
                        backgroundColor: donutChartColors,
                        hoverBackgroundColor: donutChartColors,
                        hoverBorderColor: "#fff"
                    }]
            };
            this.respChart($("#doughnut"), 'Doughnut', donutChart);

        },
        $.ChartJs = new ChartJs, $.ChartJs.Constructor = ChartJs

}(window.jQuery),

    //initializing
    function ($) {
        "use strict";
        $.ChartJs.init()
    }(window.jQuery);