"use strict";
var options = {
        series: [{
            name: "Total Document",
            type: 'column',
            data: documentByCategoryData,
    }],
chart: {
    height: 452,
        type: 'line',
        toolbar: {
        show: false
    },
    zoom: {
        enabled: false
    }
},
legend: {
    show: false
},
dataLabels: {
    enabled: false
},
stroke: {
    width: [0, 0],
        curve: 'smooth',
},
plotOptions: {
    bar: {
        columnWidth: "20%",
            startingShape: "rounded",
            endingShape: "rounded",
    }
},
fill: {
    opacity: [1, 0.08],
        gradient: {
        type: "horizontal",
            opacityFrom: 0.5,
            opacityTo: 0.1,
            stops: [100, 100, 100]
    }
},
    states: {
    normal: {
        filter: {
            type: 'darken',
                value: 1,
        }
    },
    hover: {
        filter: {
            type: 'darken',
                value: 1,
        }
    },
    active: {
        allowMultipleDataPointsSelection: false,
            filter: {
            type: 'darken',
                value: 1,
        }
    },
},
grid: {
    strokeDashArray: 2,
},

yaxis: {

    labels: {
        formatter: function (y) {
            return y.toFixed(0);
        },
        style: {
            colors: '#262626',
                fontSize: '14px',
                fontWeight: 500,
                fontFamily: 'Roboto, sans-serif'
        }
    },
},
xaxis: {
    categories: documentByCategory,
    axisTicks: {
        show: false
    },
    axisBorder: {
        show: false
    },
    labels: {
        style: {
            colors: '#262626',
                fontSize: '14px',
                fontWeight: 500,
                fontFamily: 'Roboto, sans-serif'
        },
    },
},
responsive: [
    {
        breakpoint: 1441,
        options: {
            chart: {
                height: 445
            }
        },
    },
    {
        breakpoint: 1366,
        options: {
            chart: {
                height: 320
            }
        },
    },
]
};
var chart = new ApexCharts(document.querySelector("#document_by_cat"), options);
chart.render();


var options = {
        series: [{
            name: "Total Document",
            type: 'column',
            data: documentBySubCategoryData,
    }],
chart: {
    height: 452,
        type: 'line',
        toolbar: {
        show: false
    },
    zoom: {
        enabled: false
    }
},
legend: {
    show: false
},
dataLabels: {
    enabled: false
},
stroke: {
    width: [0, 0],
        curve: 'smooth',
},
plotOptions: {
    bar: {
        columnWidth: "20%",
            startingShape: "rounded",
            endingShape: "rounded",
    }
},
fill: {
    opacity: [1, 0.08],
        gradient: {
        type: "horizontal",
            opacityFrom: 0.5,
            opacityTo: 0.1,
            stops: [100, 100, 100]
    }
},
    states: {
    normal: {
        filter: {
            type: 'darken',
                value: 1,
        }
    },
    hover: {
        filter: {
            type: 'darken',
                value: 1,
        }
    },
    active: {
        allowMultipleDataPointsSelection: false,
            filter: {
            type: 'darken',
                value: 1,
        }
    },
},
grid: {
    strokeDashArray: 2,
},

yaxis: {

    labels: {
        formatter: function (y) {
            return y.toFixed(0);
        },
        style: {
            colors: '#262626',
                fontSize: '14px',
                fontWeight: 500,
                fontFamily: 'Roboto, sans-serif'
        }
    },
},
xaxis: {
    categories: documentBySubCategory,
    axisTicks: {
        show: false
    },
    axisBorder: {
        show: false
    },
    labels: {
        style: {
            colors: '#262626',
                fontSize: '14px',
                fontWeight: 500,
                fontFamily: 'Roboto, sans-serif'
        },
    },
},
responsive: [
    {
        breakpoint: 1441,
        options: {
            chart: {
                height: 445
            }
        },
    },
    {
        breakpoint: 1366,
        options: {
            chart: {
                height: 320
            }
        },
    },
]
};
var chart = new ApexCharts(document.querySelector("#document_by_subcat"), options);
chart.render();


