
//Ecommerce-Sale-Details

// get colors array from the string
function getChartColorsArray(chartId) {
    var colors = $(chartId).attr('data-colors');
    var colors = JSON.parse(colors);
    return colors.map(function(value){
        var newValue = value.replace(' ', '');
        if(newValue.indexOf('--') != -1) {
            var color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
            if(color) return color;
        } else {
            return newValue;
        }
    })
}

// Doughnut Chart
var doughnutColors = getChartColorsArray("#doughnut-chart");
var dom = document.getElementById("doughnut-chart");
var myChart = echarts.init(dom);
var app = {};
option = null;

option = {
    tooltip: {
        trigger: 'item',
        formatter: "{a} <br/>{b}: {c} ({d}%)"
    },
    legend: {
        orient: 'horizontal',
        y: 'bottom',
        data: ['Total Sales','Target'],
        textStyle: {color: '#858d98'}
    },
    color: doughnutColors, //['#1c84ee', '#ffbf53', '#fd625e', '#4ba6ef', '#1c84ee'],
    series: [
        {
            name:'Total sales',
            type:'pie',
            radius: ['30%', '50%'],
            avoidLabelOverlap: false,
            label: {
                normal: {
                    show: false,
                    position: 'center'
                },
                emphasis: {
                    show: true,
                    textStyle: {
                        fontSize: '20',
                        fontWeight: 'bold'
                    }
                }
            },
            labelLine: {
                normal: {
                    show: false
                }
            },
            data:[
                {value:335, name:'Total Sales'},
                {value:310, name:'Target'}
            ]
        }
    ]
};
;
if (option && typeof option === "object") {
    myChart.setOption(option, true);
};


//   spline_area
var splneAreaColors = getChartColorsArray("#spline_area");
var options = {
    chart: {
        height: 300,
        type: 'area',
        toolbar: {
            show: false,
        }
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        curve: 'smooth',
        width: 3,
    },
    series: [{
        name: 'series1',
        data: [34, 40, 28, 52, 42, 109, 100]
    }, {
        name: 'series2',
        data: [32, 60, 34, 46, 34, 52, 41]
    }],
    colors: splneAreaColors,
    xaxis: {
        type: 'datetime',
        categories: ["2018-09-19T00:00:00", "2018-09-19T01:30:00", "2018-09-19T02:30:00", "2018-09-19T03:30:00", "2018-09-19T04:30:00", "2018-09-19T05:30:00", "2018-09-19T06:30:00"],                
    },
    grid: {
        borderColor: '#f1f1f1',
    },
    tooltip: {
        x: {
            format: 'dd/MM/yy HH:mm'
        },
    }
}

var chart = new ApexCharts(
    document.querySelector("#spline_area"),
    options
);

chart.render();

ChartColorChange(chart,'#spline_area');

//Distibuted chart

var options = {
    series: [
    {
      data: [
        {
          x: 'New Delhi',
          y: 218
        },
        {
          x: 'Kolkata',
          y: 149
        },
        {
          x: 'Mumbai',
          y: 184
        },
        {
          x: 'Ahmedabad',
          y: 55
        },
        {
          x: 'Bangaluru',
          y: 84
        },
        {
          x: 'Pune',
          y: 31
        },
        {
          x: 'Chennai',
          y: 70
        },
        {
          x: 'Jaipur',
          y: 30
        },
        {
          x: 'Surat',
          y: 44
        },
        {
          x: 'Hyderabad',
          y: 68
        },
        {
          x: 'Lucknow',
          y: 28
        },
        {
          x: 'Indore',
          y: 19
        },
        {
          x: 'Kanpur',
          y: 29
        }
      ]
    }
  ],
    legend: {
    show: false
  },
  chart: {
    height: 352,
    type: 'treemap',
    toolbar: {
        show: false,
    }
  },
//   title: {
//     text: '',
//     align: 'center'
//   },
  colors: [
    '#A2D2FF',
    '#9dc9f2',
    '#9dc9f2',
    '#9dc9f2',
    '#9dc9f2',
    '#9dc9f2',
    '#7ab1d6',
    '#7ab1d6',
    '#7ab1d6',
    '#7ab1d6',
    '#9dc9f2',
    '#9dc9f2'
  ],
  plotOptions: {
    treemap: {
      distributed: true,
      enableShades: false
    }
  }
  };

  var chart = new ApexCharts(document.querySelector("#apex-chart"), options);
  chart.render();
