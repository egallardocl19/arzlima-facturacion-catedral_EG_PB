/*
Template Name: Dason - Admin & Dashboard Template
Author: Themesbrand
Website: https://themesbrand.com/
Contact: themesbrand@gmail.com
File: Chart color js
*/


// get colors array from the string
function getChartColorsArray(chartId) {
    if (document.getElementById(chartId) !== null) {
        var colors = document.getElementById(chartId).getAttribute("data-colors");
        colors = JSON.parse(colors);
        return colors.map(function (value) {
            var newValue = value.replace(" ", "");
            if (newValue.indexOf(",") === -1) {
                var color = getComputedStyle(document.documentElement).getPropertyValue(
                    newValue
                );

                if (color) return color;
                else return newValue;
            } else {
                var val = value.split(",");
                if (val.length == 2) {
                    var rgbaColor = getComputedStyle(
                        document.documentElement
                    ).getPropertyValue(val[0]);
                    rgbaColor = "rgba(" + rgbaColor + "," + val[1] + ")";
                    return rgbaColor;
                } else {
                    return newValue;
                }
            }
        });
    }
}

function ChartColorChange(chartupdate, chartId) {
    document.querySelectorAll(".theme-color").forEach(function (item) {
        item.addEventListener("click", function (event) {
            setTimeout(() => {
                var linechartcustomerColors = getChartColorsArray(chartId);
                chartupdate.updateOptions({
                    colors: linechartcustomerColors
                })
            }, 0);
        });
    });
}