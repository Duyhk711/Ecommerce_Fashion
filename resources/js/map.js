
"use strict";

/*======== 1. SPLINA AREA CHART 01 ========*/
var splinaArea1 = document.querySelector("#spline-area-1");


//   /*======== 2. SPLINA AREA CHART 02 ========*/
var splinaArea2 = document.querySelector("#spline-area-2");
if (splinaArea2 !== null) {
  var splinaAreaOptions2 = {
    chart: {
      id: "spline-area-1",
      group: "social",
      height: 135,
      width: "100%",
      background: "#46c79e",
      type: "area",
      sparkline: {
        enabled: true,
      },
    },
    yaxis: {
      labels: {
        minWidth: 40,
      },
    },
    stroke: {
      width: 2,
    },
    colors: ["#ffffff"],
    fill: {
      type: "gradient",
      gradient: {
        shadeIntensity: 1,
        opacityFrom: 0.7,
        opacityTo: 0.3,
        stops: [0, 90, 100],
      },
    },
    tooltip: {
      followCursor: false,
      theme: "dark",
      x: {
        show: false,
      },
      marker: {
        show: false,
      },
      y: {
        title: {
          formatter: function () {
            return "";
          },
        },
      },
    },

    series: [
      {
        data: [0, 4, 6, 14, 8, 10, 17, 20, 16],
      },
    ],
  };
  var randerSplinaArea2 = new ApexCharts(splinaArea2, splinaAreaOptions2);
  randerSplinaArea2.render();
}

//   /*======== 3. SPLINA AREA CHART 03 ========*/
var splinaArea3 = document.querySelector("#spline-area-3");
if (splinaArea3 !== null) {
  var splinaAreaOptions3 = {
    chart: {
      id: "spline-area-3",
      group: "social",
      height: 135,
      width: "100%",
      background: "#9e6de0",
      type: "area",
      sparkline: {
        enabled: true,
      },
    },
    yaxis: {
      labels: {
        minWidth: 40,
      },
    },
    stroke: {
      width: 2,
    },
    colors: ["#ffffff"],
    fill: {
      type: "gradient",
      gradient: {
        shadeIntensity: 1,
        opacityFrom: 0.7,
        opacityTo: 0.3,
        stops: [0, 90, 100],
      },
    },
    tooltip: {
      followCursor: false,
      theme: "dark",
      x: {
        show: false,
      },
      marker: {
        show: false,
      },
      y: {
        title: {
          formatter: function () {
            return "";
          },
        },
      },
    },

    series: [
      {
        data: [0, 8, 20, 14, 17, 12, 14, 8, 5],
      },
    ],
  };
  var randerSplinaArea3 = new ApexCharts(splinaArea3, splinaAreaOptions3);
  randerSplinaArea3.render();
}

// /*======== 4. SPLINA AREA CHART 04 ========*/
var splinaArea4 = document.querySelector("#spline-area-4");
if (splinaArea4 !== null) {
  var splinaAreaOptions4 = {
    chart: {
      id: "spline-area-3",
      group: "social",
      height: 135,
      width: "100%",
      background: "#6696fe",
      type: "area",
      sparkline: {
        enabled: true,
      },
    },
    yaxis: {
      labels: {
        minWidth: 40,
      },
    },
    stroke: {
      width: 2,
    },
    colors: ["#ffffff"],
    fill: {
      type: "gradient",
      gradient: {
        shadeIntensity: 1,
        opacityFrom: 0.7,
        opacityTo: 0.3,
        stops: [0, 90, 100],
      },
    },
    tooltip: {
      followCursor: false,
      theme: "dark",
      x: {
        show: false,
      },
      marker: {
        show: false,
      },
      y: {
        title: {
          formatter: function () {
            return "";
          },
        },
      },
    },

    series: [
      {
        data: [0, 3, 8, 15, 20, 10, 12, 10, 5],
      },
    ],
  };
  var randerSplinaArea4 = new ApexCharts(splinaArea4, splinaAreaOptions4);
  randerSplinaArea4.render();
}

//   /*======== 5. MIXED CHART 01 ========*/
var mixedChart1 = document.querySelector("#mixed-chart-1");
if (mixedChart1 !== null) {
  var mixedOptions1 = {
    chart: {
      height: 370,
      type: "bar",
      toolbar: {
        show: false,
      },
    },
    colors: ["#9e6de0", "#faafca", "#f2e052"],
    legend: {
      show: true,
      position: "top",
      horizontalAlign: "right",
      markers: {
        width: 20,
        height: 5,
        radius: 0,
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "50%",
        barHeight: "10%",
        distributed: false,
      },
    },
    dataLabels: {
      enabled: false,
    },

    stroke: {
      show: true,
      width: 2,
      curve: "smooth",
    },

    series: [
      {
        name: "Income",
        type: "column",
        data: [44, 55, 57, 56, 61, 58, 63, 60, 66, 55, 47, 67],
      },
      {
        name: "Expenses",
        type: "column",
        data: [76, 85, 101, 98, 87, 100, 91, 40, 94, 50, 47, 55],
      },
      {
        name: "profit",
        data: [50, 40, 64, 87, -15, 104, 63, 42, 32, 60, 78, 25],
        type: "line",
      },
    ],

    xaxis: {
      categories: [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
      ],

      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
      crosshairs: {
        width: 40,
      },
    },

    fill: {
      opacity: 1,
    },

    tooltip: {
      shared: true,
      intersect: false,
      followCursor: true,
      fixed: {
        enabled: false,
      },
      x: {
        show: false,
      },
      y: {
        title: {
          formatter: function (seriesName) {
            return seriesName;
          },
        },
      },
    },
  };

  var randerMixedChart1 = new ApexCharts(mixedChart1, mixedOptions1);
  randerMixedChart1.render();
}

/*======== 6. RADIAL BAR CHART 01 ========*/
var radialBarChart1 = document.querySelector("#radial-bar-chart-1");
if (radialBarChart1 !== null) {
  var radialBarOptions1 = {
    chart: {
      width: "100%",
      type: "radialBar",
      height: 345,
    },
    plotOptions: {
      radialBar: {
        size: 100,
        hollow: {
          size: "60%",
        },
        dataLabels: {
          show: true,
          name: {
            show: true,
            fontSize: "14px",
            fontFamily: undefined,
            color: "#222",
          },
          value: {
            show: true,
            fontSize: "16px",
            fontFamily: undefined,
            color: undefined,
            offsetY: 16,
            formatter: function () {
              return "";
            },
          },
        },
      },
    },
    fill: {
      type: "solid",
      colors: "#9e6de0",
    },
    series: [70],
    labels: ["Yearly Revenue"],
  };

  var randerRadialBar1 = new ApexCharts(radialBarChart1, radialBarOptions1);
  randerRadialBar1.render();
}

/*======== 7. HORIZONTAL BAR CHART ========*/
var horBarChart1 = document.querySelector("#horizontal-bar-chart");
if (horBarChart1 !== null) {
  var horBarChartOptions = {
    chart: {
      height: 325,
      type: "bar",
      toolbar: {
        show: false,
      },
      stacked: true,
    },
    colors: ["#9e6de0", "#faafca"],
    plotOptions: {
      bar: {
        horizontal: true,
        barHeight: "20%",
        distributed: true,
      },
    },
    dataLabels: {
      enabled: false,
    },
    series: [
      {
        data: [50, 45, 38, 27, 33, 19],
      },
    ],

    xaxis: {
      categories: [
        "India",
        "USA",
        "Canada",
        "Russia",
        "Austrolia",
        "Argentina",
      ],
      labels: {
        formatter: function (categories) {
          return categories;
        },
      },
    },
    tooltip: {
      theme: "dark",
      x: {
        show: false,
      },
      y: {
        title: {
          formatter: (seriesName) => "Sales",
        },
      },
    },
  };

  var randerHorBarChart1 = new ApexCharts(horBarChart1, horBarChartOptions);
  randerHorBarChart1.render();
}

/*======== 7. HORIZONTAL BAR CHART2 ========*/
var horBarChart2 = document.querySelector("#horizontal-bar-chart2");
if (horBarChart2 !== null) {
  var options = {
    chart: {
      height: 350,
      type: "bar",
      toolbar: {
        show: false,
      },
    },
    colors: ["#9e6de0", "#faafca"],
    plotOptions: {
      bar: {
        horizontal: true,
        barHeight: "50%",
        dataLabels: {
          position: "top",
        },
      },
    },
    legend: {
      show: true,
      position: "top",
      horizontalAlign: "right",
      markers: {
        width: 20,
        height: 5,
        radius: 0,
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 1,
      colors: ["#fff"],
    },
    series: [
      {
        data: [44, 55, 41, 64, 22, 43, 21],
      },
      {
        data: [53, 32, 33, 52, 13, 44, 32],
      },
    ],
    xaxis: {
      categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
    },
    tooltip: {
      theme: "dark",
      x: {
        show: false,
      },
      y: {
        title: {
          formatter: (seriesName) => "Sales",
        },
      },
    },
  };

  var chart = new ApexCharts(horBarChart2, options);

  chart.render();
}

/*======== 8.1 TABLE SMALL BAR CHART 01  ========*/
var tableSmBarChart1 = document.querySelector("#tbl-chart-01");
if (tableSmBarChart1 !== null) {
  var tableSmBarChartOption1 = {
    chart: {
      height: 40,
      width: "100px",
      type: "bar",
      sparkline: {
        enabled: true,
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        endingShape: "rounded",
        columnWidth: "65%",
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2,
      colors: ["transparent"],
    },
    series: [
      {
        data: [20, 30, 40, 50, 40, 25, 52, 25, 45, 25],
      },
    ],
    fill: {
      opacity: 1,
    },
    colors: "#faafca",
    tooltip: {
      followCursor: false,
      theme: "dark",
      x: {
        show: false,
      },
      marker: {
        show: false,
      },
      y: {
        title: {
          formatter: function () {
            return "";
          },
        },
      },
    },
  };

  var randerTblSmChart1 = new ApexCharts(
    tableSmBarChart1,
    tableSmBarChartOption1
  );
  randerTblSmChart1.render();
}

/*======== 8.2 TABLE SMALL BAR CHART 02 ========*/
var tableSmBarChart2 = document.querySelector("#tbl-chart-02");
if (tableSmBarChart2 !== null) {
  var tableSmBarChartOption = {
    chart: {
      height: 40,
      width: "100px",
      type: "bar",
      sparkline: {
        enabled: true,
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        endingShape: "rounded",
        columnWidth: "65%",
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2,
      colors: ["transparent"],
    },
    series: [
      {
        data: [25, 55, 35, 45, 66, 20, 50, 20, 50, 20],
      },
    ],
    fill: {
      opacity: 1,
    },
    colors: "#faafca",
    tooltip: {
      followCursor: false,
      theme: "dark",
      x: {
        show: false,
      },
      marker: {
        show: false,
      },
      y: {
        title: {
          formatter: function () {
            return "";
          },
        },
      },
    },
  };

  var randerTblSmChart2 = new ApexCharts(
    tableSmBarChart2,
    tableSmBarChartOption
  );
  randerTblSmChart2.render();
}

/*======== 8.3 TABLE SMALL BAR CHART 03 ========*/
var tableSmBarChart3 = document.querySelector("#tbl-chart-03");
if (tableSmBarChart3 !== null) {
  var tableSmBarChartOption3 = {
    chart: {
      height: 40,
      width: "100px",
      type: "bar",
      sparkline: {
        enabled: true,
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        endingShape: "rounded",
        columnWidth: "65%",
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2,
      colors: ["transparent"],
    },
    series: [
      {
        data: [10, 30, 60, 15, 50, 45, 36, 17, 29, 65],
      },
    ],
    fill: {
      opacity: 1,
    },
    colors: "#faafca",
    tooltip: {
      followCursor: false,
      theme: "dark",
      x: {
        show: false,
      },
      marker: {
        show: false,
      },
      y: {
        title: {
          formatter: function () {
            return "";
          },
        },
      },
    },
  };

  var randerTblSmChart3 = new ApexCharts(
    tableSmBarChart3,
    tableSmBarChartOption3
  );
  randerTblSmChart3.render();
}

/*======== 8.4 TABLE SMALL BAR CHART 04 ========*/
var tableSmBarChart4 = document.querySelector("#tbl-chart-04");
if (tableSmBarChart4 !== null) {
  var tableSmBarChartOption4 = {
    chart: {
      height: 40,
      width: "100px",
      type: "bar",
      sparkline: {
        enabled: true,
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        endingShape: "rounded",
        columnWidth: "65%",
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2,
      colors: ["transparent"],
    },
    series: [
      {
        data: [17, 50, 35, 58, 65, 15, 30, 17, 25, 42],
      },
    ],
    fill: {
      opacity: 1,
    },
    colors: "#faafca",
    tooltip: {
      followCursor: false,
      theme: "dark",
      x: {
        show: false,
      },
      marker: {
        show: false,
      },
      y: {
        title: {
          formatter: function () {
            return "";
          },
        },
      },
    },
  };

  var randerTblSmChart4 = new ApexCharts(
    tableSmBarChart4,
    tableSmBarChartOption4
  );
  randerTblSmChart4.render();
}

/*======== 8.5 TABLE SMALL BAR CHART 05 ========*/
var tableSmBarChart5 = document.querySelector("#tbl-chart-05");
if (tableSmBarChart5 !== null) {
  var tableSmBarChartOption5 = {
    chart: {
      height: 40,
      width: "100px",
      type: "bar",
      sparkline: {
        enabled: true,
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        endingShape: "rounded",
        columnWidth: "65%",
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2,
      colors: ["transparent"],
    },
    series: [
      {
        data: [15, 42, 65, 49, 41, 29, 16, 45, 19, 17],
      },
    ],
    fill: {
      opacity: 1,
    },
    colors: "#faafca",
    tooltip: {
      followCursor: false,
      theme: "dark",
      x: {
        show: false,
      },
      marker: {
        show: false,
      },
      y: {
        title: {
          formatter: function () {
            return "";
          },
        },
      },
    },
  };

  var randerTblSmChart5 = new ApexCharts(
    tableSmBarChart5,
    tableSmBarChartOption5
  );
  randerTblSmChart5.render();
}

/*======== 8.6 TABLE SMALL BAR CHART 06 ========*/
var tableSmBarChart6 = document.querySelector("#tbl-chart-06");
if (tableSmBarChart6 !== null) {
  var tableSmBarChartOption6 = {
    chart: {
      height: 40,
      width: "100px",
      type: "bar",
      sparkline: {
        enabled: true,
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        endingShape: "rounded",
        columnWidth: "65%",
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2,
      colors: ["transparent"],
    },
    series: [
      {
        data: [5, 32, 51, 43, 60, 19, 26, 35, 27, 17],
      },
    ],
    fill: {
      opacity: 1,
    },
    colors: "#faafca",
    tooltip: {
      followCursor: false,
      theme: "dark",
      x: {
        show: false,
      },
      marker: {
        show: false,
      },
      y: {
        title: {
          formatter: function () {
            return "";
          },
        },
      },
    },
  };

  var randerTblSmChart6 = new ApexCharts(
    tableSmBarChart6,
    tableSmBarChartOption6
  );
  randerTblSmChart6.render();
}

/*======== 8.7 TABLE SMALL BAR CHART 07 ========*/
var tableSmBarChart7 = document.querySelector("#tbl-chart-07");
if (tableSmBarChart7 !== null) {
  var tableSmBarChartOption7 = {
    chart: {
      height: 40,
      width: "100px",
      type: "bar",
      sparkline: {
        enabled: true,
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        endingShape: "rounded",
        columnWidth: "65%",
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2,
      colors: ["transparent"],
    },
    series: [
      {
        data: [15, 42, 65, 49, 41, 29, 16, 45, 19, 17],
      },
    ],
    fill: {
      opacity: 1,
    },
    colors: "#faafca",
    tooltip: {
      followCursor: false,
      theme: "dark",
      x: {
        show: false,
      },
      marker: {
        show: false,
      },
      y: {
        title: {
          formatter: function () {
            return "";
          },
        },
      },
    },
  };

  var randerTblSmChart7 = new ApexCharts(
    tableSmBarChart7,
    tableSmBarChartOption7
  );
  randerTblSmChart7.render();
}

/*======== 8.8 TABLE SMALL BAR CHART 08 ========*/
var tableSmBarChart8 = document.querySelector("#tbl-chart-08");
if (tableSmBarChart8 !== null) {
  var tableSmBarChartOption8 = {
    chart: {
      height: 40,
      width: "100px",
      type: "bar",
      sparkline: {
        enabled: true,
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        endingShape: "rounded",
        columnWidth: "65%",
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2,
      colors: ["transparent"],
    },
    series: [
      {
        data: [8, 25, 35, 18, 65, 52, 20, 35, 19, 9],
      },
    ],
    fill: {
      opacity: 1,
    },
    colors: "#faafca",
    tooltip: {
      followCursor: false,
      theme: "dark",
      x: {
        show: false,
      },
      marker: {
        show: false,
      },
      y: {
        title: {
          formatter: function () {
            return "";
          },
        },
      },
    },
  };

  var randerTblSmChart8 = new ApexCharts(
    tableSmBarChart8,
    tableSmBarChartOption8
  );
  randerTblSmChart8.render();
}

/*======== 8.9 TABLE SMALL BAR CHART 09 ========*/
var tableSmBarChart9 = document.querySelector("#tbl-chart-09");
if (tableSmBarChart9 !== null) {
  var tableSmBarChartOption9 = {
    chart: {
      height: 40,
      width: "100px",
      type: "bar",
      sparkline: {
        enabled: true,
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        endingShape: "rounded",
        columnWidth: "65%",
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2,
      colors: ["transparent"],
    },
    series: [
      {
        data: [20, 32, 40, 19, 65, 19, 26, 23, 37, 20],
      },
    ],
    fill: {
      opacity: 1,
    },
    colors: "#faafca",
    tooltip: {
      followCursor: false,
      theme: "dark",
      x: {
        show: false,
      },
      marker: {
        show: false,
      },
      y: {
        title: {
          formatter: function () {
            return "";
          },
        },
      },
    },
  };

  var randerTblSmChart9 = new ApexCharts(
    tableSmBarChart9,
    tableSmBarChartOption9
  );
  randerTblSmChart9.render();
}

/*======== 8.10 TABLE SMALL BAR CHART 10 ========*/
var tableSmBarChart10 = document.querySelector("#tbl-chart-10");
if (tableSmBarChart10 !== null) {
  var tableSmBarChartOption10 = {
    chart: {
      height: 40,
      width: "100px",
      type: "bar",
      sparkline: {
        enabled: true,
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        endingShape: "rounded",
        columnWidth: "65%",
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2,
      colors: ["transparent"],
    },
    series: [
      {
        data: [9, 25, 61, 18, 38, 26, 19, 28, 50, 40],
      },
    ],
    fill: {
      opacity: 1,
    },
    colors: "#faafca",
    tooltip: {
      followCursor: false,
      theme: "dark",
      x: {
        show: false,
      },
      marker: {
        show: false,
      },
      y: {
        title: {
          formatter: function () {
            return "";
          },
        },
      },
    },
  };

  var randerTblSmChart10 = new ApexCharts(
    tableSmBarChart10,
    tableSmBarChartOption10
  );
  randerTblSmChart10.render();
}

/*======== 8.11 TABLE SMALL BAR CHART 11 ========*/
var tableSmBarChart11 = document.querySelector("#tbl-chart-11");
if (tableSmBarChart11 !== null) {
  var tableSmBarChartOption11 = {
    chart: {
      height: 40,
      width: "100px",
      type: "bar",
      sparkline: {
        enabled: true,
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        endingShape: "rounded",
        columnWidth: "65%",
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2,
      colors: ["transparent"],
    },
    series: [
      {
        data: [9, 42, 17, 35, 50, 52, 45, 65, 29, 38],
      },
    ],
    fill: {
      opacity: 1,
    },
    colors: "#faafca",
    tooltip: {
      followCursor: false,
      theme: "dark",
      x: {
        show: false,
      },
      marker: {
        show: false,
      },
      y: {
        title: {
          formatter: function () {
            return "";
          },
        },
      },
    },
  };
  var randerTblSmChart11 = new ApexCharts(
    tableSmBarChart11,
    tableSmBarChartOption11
  );
  randerTblSmChart11.render();
}

/*======== 8.12 TABLE SMALL BAR CHART 12 ========*/
var tableSmBarChart12 = document.querySelector("#tbl-chart-12");
if (tableSmBarChart12 !== null) {
  var tableSmBarChartOption12 = {
    chart: {
      height: 40,
      width: "100px",
      type: "bar",
      sparkline: {
        enabled: true,
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        endingShape: "rounded",
        columnWidth: "65%",
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2,
      colors: ["transparent"],
    },
    series: [
      {
        data: [15, 42, 65, 49, 41, 29, 16, 45, 19, 17],
      },
    ],
    fill: {
      opacity: 1,
    },
    colors: "#faafca",
    tooltip: {
      followCursor: false,
      theme: "dark",
      x: {
        show: false,
      },
      marker: {
        show: false,
      },
      y: {
        title: {
          formatter: function () {
            return "";
          },
        },
      },
    },
  };

  var randerTblSmChart12 = new ApexCharts(
    tableSmBarChart12,
    tableSmBarChartOption12
  );
  randerTblSmChart12.render();
}

/*======== 8.13 TABLE SMALL BAR CHART 13 ========*/
var tableSmBarChart13 = document.querySelector("#tbl-chart-13");
if (tableSmBarChart13 !== null) {
  var tableSmBarChartOption13 = {
    chart: {
      height: 40,
      width: "100px",
      type: "bar",
      sparkline: {
        enabled: true,
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        endingShape: "rounded",
        columnWidth: "65%",
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2,
      colors: ["transparent"],
    },
    series: [
      {
        data: [26, 17, 9, 30, 41, 55, 63, 45, 19, 16],
      },
    ],
    fill: {
      opacity: 1,
    },
    colors: "#faafca",
    tooltip: {
      followCursor: false,
      theme: "dark",
      x: {
        show: false,
      },
      marker: {
        show: false,
      },
      y: {
        title: {
          formatter: function () {
            return "";
          },
        },
      },
    },
  };

  var randerTblSmChart13 = new ApexCharts(
    tableSmBarChart13,
    tableSmBarChartOption13
  );
  randerTblSmChart13.render();
}

/*======== 8.14 TABLE SMALL BAR CHART 14 ========*/
var tableSmBarChart14 = document.querySelector("#tbl-chart-14");
if (tableSmBarChart14 !== null) {
  var tableSmBarChartOption14 = {
    chart: {
      height: 40,
      width: "100px",
      type: "bar",
      sparkline: {
        enabled: true,
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        endingShape: "rounded",
        columnWidth: "65%",
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2,
      colors: ["transparent"],
    },
    series: [
      {
        data: [15, 42, 65, 49, 41, 29, 16, 45, 19, 17],
      },
    ],
    fill: {
      opacity: 1,
    },
    colors: "#faafca",
    tooltip: {
      followCursor: false,
      theme: "dark",
      x: {
        show: false,
      },
      marker: {
        show: false,
      },
      y: {
        title: {
          formatter: function () {
            return "";
          },
        },
      },
    },
  };

  var randerTblSmChart14 = new ApexCharts(
    tableSmBarChart14,
    tableSmBarChartOption14
  );
  randerTblSmChart14.render();
}

/*======== 8.15 TABLE SMALL BAR CHART 15 ========*/
var tableSmBarChart15 = document.querySelector("#tbl-chart-15");
if (tableSmBarChart15 !== null) {
  var tableSmBarChartOption15 = {
    chart: {
      height: 40,
      width: "100px",
      type: "bar",
      sparkline: {
        enabled: true,
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        endingShape: "rounded",
        columnWidth: "65%",
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2,
      colors: ["transparent"],
    },
    series: [
      {
        data: [9, 19, 46, 25, 30, 15, 27, 18, 65, 50],
      },
    ],
    fill: {
      opacity: 1,
    },
    colors: "#faafca",
    tooltip: {
      followCursor: false,
      theme: "dark",
      x: {
        show: false,
      },
      marker: {
        show: false,
      },
      y: {
        title: {
          formatter: function () {
            return "";
          },
        },
      },
    },
  };

  var randerTblSmChart15 = new ApexCharts(
    tableSmBarChart15,
    tableSmBarChartOption15
  );
  randerTblSmChart15.render();
}
/*======== 9.1 STATUS SMALL BAR CHART 01  ========*/
var statusSmBarChart1 = document.querySelector("#status-sm-chart-01");
if (statusSmBarChart1 !== null) {
  var statusSmBarChartOption1 = {
    chart: {
      height: 40,
      width: "100px",
      type: "bar",
      sparkline: {
        enabled: true,
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        endingShape: "flat",
        columnWidth: "65%",
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2,
      colors: ["transparent"],
    },
    series: [
      {
        data: [20, 30, 40, 50, 40, 25, 52, 25, 45, 25],
      },
    ],
    fill: {
      opacity: 1,
    },
    colors: "#9e6de0",
    tooltip: {
      followCursor: false,
      theme: "dark",
      x: {
        show: false,
      },
      marker: {
        show: false,
      },
      y: {
        title: {
          formatter: function () {
            return "";
          },
        },
      },
    },
  };

  var randerStatusSmChart1 = new ApexCharts(
    statusSmBarChart1,
    statusSmBarChartOption1
  );
  randerStatusSmChart1.render();
}

/*======== 9.2 STATUS SMALL BAR CHART 02 ========*/
var statusSmBarChart2 = document.querySelector("#status-sm-chart-02");
if (statusSmBarChart2 !== null) {
  var statusSmBarChartOption2 = {
    chart: {
      height: 40,
      width: "100px",
      type: "bar",
      sparkline: {
        enabled: true,
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        endingShape: "flat",
        columnWidth: "65%",
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2,
      colors: ["transparent"],
    },
    series: [
      {
        data: [25, 55, 35, 45, 66, 20, 50, 20, 50, 20],
      },
    ],
    fill: {
      opacity: 1,
    },
    colors: "#46c79e",
    tooltip: {
      followCursor: false,
      theme: "dark",
      x: {
        show: false,
      },
      marker: {
        show: false,
      },
      y: {
        title: {
          formatter: function () {
            return "";
          },
        },
      },
    },
  };

  var randerStatusSmChart2 = new ApexCharts(
    statusSmBarChart2,
    statusSmBarChartOption2
  );
  randerStatusSmChart2.render();
}

/*======== 9.3 STATUS SMALL BAR CHART 03 ========*/
var statusSmBarChart3 = document.querySelector("#status-sm-chart-03");
if (statusSmBarChart3 !== null) {
  var statusSmBarChartOption3 = {
    chart: {
      height: 40,
      width: "100px",
      type: "bar",
      sparkline: {
        enabled: true,
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        endingShape: "flat",
        columnWidth: "65%",
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2,
      colors: ["transparent"],
    },
    series: [
      {
        data: [10, 30, 60, 15, 50, 45, 36, 17, 29, 65],
      },
    ],
    fill: {
      opacity: 1,
    },
    colors: "#04c7e0",
    tooltip: {
      followCursor: false,
      theme: "dark",
      x: {
        show: false,
      },
      marker: {
        show: false,
      },
      y: {
        title: {
          formatter: function () {
            return "";
          },
        },
      },
    },
  };

  var randerStatusSmChart3 = new ApexCharts(
    statusSmBarChart3,
    statusSmBarChartOption3
  );
  randerStatusSmChart3.render();
}

/*======== 10.1 LINE CHART 01 ========*/
var lineChart1 = document.querySelector("#line-chart-1");
if (lineChart1 !== null) {
  var lineChartOption1 = {
    chart: {
      height: 350,
      type: "line",
      toolbar: {
        show: false,
      },
    },
    stroke: {
      width: [2, 3],
      curve: "smooth",
      dashArray: [0, 5],
    },
    plotOptions: {
      horizontal: false,
    },
    colors: ["#9e6de0", "#fec400"],
    series: [
      {
        data: [6, 10, 8, 20, 15, 6, 21],
      },
      {
        data: [8, 6, 15, 10, 25, 8, 32],
      },
    ],
    labels: [
      "04 jan",
      "05 jan",
      "06 jan",
      "07 jan",
      "08 jan",
      "09 jan",
      "10 jan",
    ],
    markers: {
      size: [5, 0],
    },
    xaxis: {
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
    },
    tooltip: {
      theme: "dark",
      fixed: {
        enabled: false,
      },
      x: {
        show: false,
      },
      y: {
        title: {
          formatter: (labels) => labels,
        },
      },
      marker: {
        show: true,
      },
    },
    legend: {
      show: false,
    },
  };
  var randerLineChart1 = new ApexCharts(lineChart1, lineChartOption1);
  randerLineChart1.render();
}

/*======== 10.2 LINE CHART 02 ========*/
var lineChart2 = document.querySelector("#line-chart-2");
if (lineChart2 !== null) {
  var lineChartOption2 = {
    chart: {
      height: 350,
      type: "line",
      toolbar: {
        show: false,
      },
    },
    stroke: {
      width: [2, 3],
      curve: "smooth",
      dashArray: [0, 5],
    },
    plotOptions: {
      horizontal: false,
    },

    colors: ["#9e6de0", "#fec400"],
    series: [
      {
        data: [8, 15, 2, 12, 16, 25, 17],
      },
      {
        data: [5, 17, 12, 20, 11, 18, 12],
      },
    ],
    labels: [
      "04 jan",
      "05 jan",
      "06 jan",
      "07 jan",
      "08 jan",
      "09 jan",
      "10 jan",
    ],
    markers: {
      size: [5, 0],
    },
    xaxis: {
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
    },
    tooltip: {
      theme: "dark",
      shared: true,
      intersect: false,
      fixed: {
        enabled: false,
      },
      x: {
        show: false,
      },
      marker: {
        show: true,
      },
    },
    legend: {
      show: false,
    },
  };

  var randerLineChart2 = new ApexCharts(lineChart2, lineChartOption2);
  randerLineChart2.render();
}

/*======== 10.3 LINE CHART 03 ========*/
var lineChart3 = document.querySelector("#line-chart-3");
if (lineChart3 !== null) {
  var lineChartOption3 = {
    chart: {
      height: 350,
      type: "line",
      toolbar: {
        show: false,
      },
    },
    stroke: {
      width: [2, 3],
      curve: "smooth",
      dashArray: [0, 5],
    },
    plotOptions: {
      horizontal: false,
    },

    colors: ["#9e6de0", "#fec400"],
    series: [
      {
        data: [3, 9, 12, 24, 14, 11, 26],
      },
      {
        data: [6, 14, 18, 9, 22, 6, 17],
      },
    ],
    labels: [
      "04 jan",
      "05 jan",
      "06 jan",
      "07 jan",
      "08 jan",
      "09 jan",
      "10 jan",
    ],
    markers: {
      size: [5, 0],
    },
    xaxis: {
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
    },
    tooltip: {
      theme: "dark",
      shared: true,
      intersect: false,
      fixed: {
        enabled: false,
      },
      x: {
        show: false,
      },
      marker: {
        show: true,
      },
    },
    legend: {
      show: false,
    },
  };

  var randerLineChart3 = new ApexCharts(lineChart3, lineChartOption3);
  randerLineChart3.render();
}

/*======== 10.4 LINE CHART 04 ========*/
var lineChart4 = document.querySelector("#line-chart-4");
if (lineChart4 !== null) {
  var lineChartOption4 = {
    chart: {
      height: 350,
      type: "line",
      toolbar: {
        show: false,
      },
    },
    stroke: {
      width: [2, 3],
      curve: "smooth",
      dashArray: [0, 5],
    },
    plotOptions: {
      horizontal: false,
    },

    colors: ["#9e6de0", "#fec400"],

    legend: {
      show: true,
      position: "top",
      horizontalAlign: "right",
      markers: {
        width: 20,
        height: 5,
        radius: 0,
      },
    },
    series: [
      {
        data: [6, 10, 8, 20, 15, 6, 21],
      },
      {
        data: [8, 6, 15, 10, 25, 8, 32],
      },
    ],
    labels: [
      "04 jan",
      "05 jan",
      "06 jan",
      "07 jan",
      "08 jan",
      "09 jan",
      "10 jan",
    ],
    markers: {
      size: [5, 0],
    },
    xaxis: {
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
    },
    tooltip: {
      theme: "dark",
      shared: true,
      intersect: false,
      fixed: {
        enabled: false,
      },
      x: {
        show: false,
      },
      y: {
        title: {
          formatter: (labels) => labels,
        },
      },
      marker: {
        show: true,
      },
    },
  };
  var randerLineChart4 = new ApexCharts(lineChart4, lineChartOption4);
  randerLineChart4.render();
}

/*======== 11.1 BAR CHART LARGE 01 ========*/
var barChartLg1 = document.querySelector("#barchartlg1");
if (barChartLg1 !== null) {
  var barChartOptions1 = {
    chart: {
      height: 275,
      type: "bar",
      toolbar: {
        show: false,
      },
    },
    colors: ["#9e6de0", "#faafca", "#46c79e"],
    plotOptions: {
      bar: {
        horizontal: false,
        endingShape: "flat",
        columnWidth: "55%",
      },
    },
    legend: {
      position: "bottom",
      horizontalAlign: "left",
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2,
      colors: ["transparent"],
    },
    series: [
      {
        name: "Referral",
        data: [76, 85, 79, 88, 87, 65],
      },
      {
        name: "Direct",
        data: [44, 55, 57, 56, 61, 58],
      },
      {
        name: "Organic",
        data: [35, 41, 36, 26, 45, 48],
      },
    ],
    xaxis: {
      categories: ["4 Jan", "5 Jan", "6 Jan", "7 Jan", "8 Jan", "9 Jan"],
    },
    yaxis: {
      show: false,
    },
    fill: {
      opacity: 1,
    },
    tooltip: {
      theme: "dark",
      x: {
        show: false,
      },
      y: {
        formatter: function (val) {
          return "$ " + val;
        },
      },
      marker: {
        show: true,
      },
    },
  };
  var randerBarChartLg1 = new ApexCharts(barChartLg1, barChartOptions1);
  randerBarChartLg1.render();

  var items = document.querySelectorAll(
    "#user-acquisition .nav-underline-active-primary .nav-item"
  );
  items.forEach(function (item, index) {
    item.addEventListener("click", function () {
      if (index === 0) {
        randerBarChartLg1.updateSeries([
          {
            name: "Referral",
            data: [76, 85, 79, 88, 87, 65],
          },
          {
            name: "Direct",
            data: [44, 55, 57, 56, 61, 58],
          },
          {
            name: "Organic",
            data: [35, 41, 36, 26, 45, 48],
          },
        ]);
      } else if (index === 1) {
        randerBarChartLg1.updateSeries([
          {
            name: "iamabdus.com/referral",
            data: [66, 50, 35, 52, 52, 45],
          },
          {
            name: "github.com/referral",
            data: [49, 59, 75, 66, 15, 20],
          },
          {
            name: "(direct)/(none)",
            data: [55, 41, 65, 61, 53, 87],
          },
        ]);
      } else if (index === 2) {
        randerBarChartLg1.updateSeries([
          {
            name: "iamabdus.com",
            data: [64, 64, 58, 45, 77, 53],
          },
          {
            name: "tafcoder.com",
            data: [85, 25, 17, 12, 74, 15],
          },
          {
            name: "github.com",
            data: [51, 48, 53, 47, 55, 63],
          },
        ]);
      }
    });
  });
}

/*======== 11.2 BAR CHART LARGE 02 ========*/
var barChartLg2 = document.querySelector("#barchartlg2");
if (barChartLg2 !== null) {
  var trigoStrength = 3;
  var iteration = 11;

  function getRandom() {
    var i = iteration;
    return (
      (Math.sin(i / trigoStrength) * (i / trigoStrength) +
        i / trigoStrength +
        1) *
      (trigoStrength * 2)
    );
  }

  function getRangeRandom(yrange) {
    return (
      Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min
    );
  }

  function generateMinuteWiseTimeSeries(baseval, count, yrange) {
    var i = 0;
    var series = [];
    while (i < count) {
      var x = baseval;
      var y =
        (Math.sin(i / trigoStrength) * (i / trigoStrength) +
          i / trigoStrength +
          1) *
        (trigoStrength * 2);

      series.push([x, y]);
      baseval += 300000;
      i++;
    }
    return series;
  }

  var optionsColumn = {
    chart: {
      height: 315,
      type: "bar",
      toolbar: {
        show: false,
      },
      animations: {
        enabled: true,
        easing: "linear",
        dynamicAnimation: {
          speed: 1000,
        },
      },

      events: {
        animationEnd: function (chartCtx) {
          const newData = chartCtx.w.config.series[0].data.slice();
          newData.shift();
          window.setTimeout(function () {
            chartCtx.updateOptions(
              {
                series: [
                  {
                    name: "Load Average",
                    data: newData,
                  },
                ],
                xaxis: {
                  min: chartCtx.minX,
                  max: chartCtx.maxX,
                },
                subtitle: {
                  text: parseInt(
                    getRangeRandom({ min: 1, max: 20 })
                  ).toString(),
                },
              },
              false,
              false
            );
          }, 300);
        },
      },
      toolbar: {
        show: false,
      },
      zoom: {
        enabled: false,
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      width: 0,
    },
    colors: "#9e6de0",
    series: [
      {
        name: "Load Average",
        data: generateMinuteWiseTimeSeries(
          new Date("12/12/2016 00:20:00").getTime(),
          12,
          {
            min: 10,
            max: 110,
          }
        ),
      },
    ],
    title: {
      text: "Ave Page views per minute",
      align: "left",
      offsetY: 35,
      style: {
        fontSize: "12px",
        color: "#8a909d",
      },
    },
    subtitle: {
      text: "20%",
      floating: false,
      align: "left",
      offsetY: 0,
      style: {
        fontSize: "22px",
        color: "#9e6de0",
      },
    },
    fill: {
      type: "solid",
      colors: "#9e6de0",
    },
    xaxis: {
      type: "datetime",
      range: 2700000,
    },
    legend: {
      show: false,
    },
    tooltip: {
      theme: "dark",
      x: {
        show: false,
      },
      y: {
        formatter: function (val) {
          return val;
        },
      },
      marker: {
        show: true,
      },
    },
  };

  var chartColumn = new ApexCharts(barChartLg2, optionsColumn);
  chartColumn.render();

  window.setInterval(function () {
    iteration++;

    chartColumn.updateSeries([
      {
        name: "Load Average",
        data: [
          ...chartColumn.w.config.series[0].data,
          [chartColumn.w.globals.maxX + 210000, getRandom()],
        ],
      },
    ]);
  }, 5000);
}

/*======== 12.1 DONUT CHART 01 ========*/
var donutChart1 = document.querySelector("#donut-chart-1");
if (donutChart1 !== null) {
  var donutChartOptions1 = {
    chart: {
      type: "donut",
      height: 270,
    },

    colors: ["#bb91f2", "#af81eb", "#9e6de0"],
    labels: ["Desktop", "Tablet", "Mobile"],
    series: [45, 30, 25],
    legend: {
      show: false,
    },
    dataLabels: {
      enabled: false,
    },
    tooltip: {
      y: {
        formatter: function (val) {
          return +val + "%";
        },
      },
    },
  };

  var randerDonutchart1 = new ApexCharts(donutChart1, donutChartOptions1);

  randerDonutchart1.render();
}

/*======== 12.2 DONUT CHART 02 ========*/
var donutChart2 = document.querySelector("#donut-chart-2");
if (donutChart2 !== null) {
  var donutChartOptions2 = {
    chart: {
      type: "donut",
      height: 330,
    },

    colors: ["#bb91f2", "#af81eb", "#9e6de0"],
    labels: ["Desktop", "Tablet", "Mobile"],
    series: [45, 30, 25],
    legend: {
      show: true,
      position: "top",
      horizontalAlign: "left",
      markers: {
        radius: 0,
      },
    },
    dataLabels: {
      enabled: false,
    },
    tooltip: {
      y: {
        formatter: function (val) {
          return +val + "%";
        },
      },
    },
  };

  var randerDonutchart2 = new ApexCharts(donutChart2, donutChartOptions2);

  randerDonutchart2.render();
}

/*======== 13. PIE CHART ========*/
var SimplePieChart = document.querySelector("#simple-pie-chart");
if (SimplePieChart !== null) {
  var simplePieChartOptions = {
    chart: {
      width: 350,
      type: "pie",
    },
    colors: ["#9e6de0", "#46c79e", "#fd5190"],
    labels: ["First Data", "Second Data", "Third Data"],
    legend: {
      position: "top",
      horizontalAlign: "left",
      markers: {
        radius: 0,
      },
    },
    series: [65, 25, 10],
  };

  var simpleplePieChartRander = new ApexCharts(
    SimplePieChart,
    simplePieChartOptions
  );

  simpleplePieChartRander.render();
}

/*======== 14. RADER CHART ========*/
var SimpleRaderChart = document.querySelector("#simple-rader-chart");
if (SimpleRaderChart !== null) {
  var options = {
    chart: {
      height: 350,
      type: "radar",
      sparkline: {
        enabled: true,
      },
    },
    labels: [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "May",
      "Jun",
      "Jul",
      "Aug",
      "Sep",
      "Oct",
      "Nov",
      "Dec",
    ],
    series: [
      {
        data: [80, 50, 30, 40, 100, 20, 80, 50, 30, 40, 100, 20],
      },
      {
        data: [20, 30, 40, 80, 20, 80, 20, 30, 40, 80, 20, 80],
      },
    ],
    tooltip: {
      enabled: false,
    },
  };

  var chart = new ApexCharts(SimpleRaderChart, options);

  chart.render();
}

/*======== 15.1 ARIA CHART 01 ========*/
var ariaChartExample = document.querySelector("#aria-chart");
if (ariaChartExample !== null) {
  var options = {
    chart: {
      height: 350,
      type: "area",
      toolbar: {
        show: false,
      },
    },
    colors: ["#9e6de0", "#faafca"],
    fill: {
      colors: ["#9e6de0", "#faafca"],
      type: "solid",
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      curve: "smooth",
    },
    series: [
      {
        data: [31, 40, 28, 51, 42, 109, 100],
      },
      {
        data: [11, 32, 45, 32, 34, 52, 41],
      },
    ],
    legend: {
      show: false,
    },
    tooltip: {
      theme: "dark",
      x: {
        show: false,
      },
    },
  };

  var chart = new ApexCharts(ariaChartExample, options);

  chart.render();
}
/*!
 * Isotope PACKAGED v3.0.6
 *
 * Licensed GPLv3 for open source use
 * or Isotope Commercial License for commercial use
 *
 * https://isotope.metafizzy.co
 * Copyright 2010-2018 Metafizzy
 */

/**
 * Bridget makes jQuery widgets
 * v2.0.1
 * MIT license
 */

/* jshint browser: true, strict: true, undef: true, unused: true */

( function( window, factory ) {
  // universal module definition
  /*jshint strict: false */ /* globals define, module, require */
  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( 'jquery-bridget/jquery-bridget',[ 'jquery' ], function( jQuery ) {
      return factory( window, jQuery );
    });
  } else if ( typeof module == 'object' && module.exports ) {
    // CommonJS
    module.exports = factory(
      window,
      require('jquery')
    );
  } else {
    // browser global
    window.jQueryBridget = factory(
      window,
      window.jQuery
    );
  }

}( window, function factory( window, jQuery ) {
'use strict';

// ----- utils ----- //

var arraySlice = Array.prototype.slice;

// helper function for logging errors
// $.error breaks jQuery chaining
var console = window.console;
var logError = typeof console == 'undefined' ? function() {} :
  function( message ) {
    console.error( message );
  };

// ----- jQueryBridget ----- //

function jQueryBridget( namespace, PluginClass, $ ) {
  $ = $ || jQuery || window.jQuery;
  if ( !$ ) {
    return;
  }

  // add option method -> $().plugin('option', {...})
  if ( !PluginClass.prototype.option ) {
    // option setter
    PluginClass.prototype.option = function( opts ) {
      // bail out if not an object
      if ( !$.isPlainObject( opts ) ){
        return;
      }
      this.options = $.extend( true, this.options, opts );
    };
  }

  // make jQuery plugin
  $.fn[ namespace ] = function( arg0 /*, arg1 */ ) {
    if ( typeof arg0 == 'string' ) {
      // method call $().plugin( 'methodName', { options } )
      // shift arguments by 1
      var args = arraySlice.call( arguments, 1 );
      return methodCall( this, arg0, args );
    }
    // just $().plugin({ options })
    plainCall( this, arg0 );
    return this;
  };

  // $().plugin('methodName')
  function methodCall( $elems, methodName, args ) {
    var returnValue;
    var pluginMethodStr = '$().' + namespace + '("' + methodName + '")';

    $elems.each( function( i, elem ) {
      // get instance
      var instance = $.data( elem, namespace );
      if ( !instance ) {
        logError( namespace + ' not initialized. Cannot call methods, i.e. ' +
          pluginMethodStr );
        return;
      }

      var method = instance[ methodName ];
      if ( !method || methodName.charAt(0) == '_' ) {
        logError( pluginMethodStr + ' is not a valid method' );
        return;
      }

      // apply method, get return value
      var value = method.apply( instance, args );
      // set return value if value is returned, use only first value
      returnValue = returnValue === undefined ? value : returnValue;
    });

    return returnValue !== undefined ? returnValue : $elems;
  }

  function plainCall( $elems, options ) {
    $elems.each( function( i, elem ) {
      var instance = $.data( elem, namespace );
      if ( instance ) {
        // set options & init
        instance.option( options );
        instance._init();
      } else {
        // initialize new instance
        instance = new PluginClass( elem, options );
        $.data( elem, namespace, instance );
      }
    });
  }

  updateJQuery( $ );

}

// ----- updateJQuery ----- //

// set $.bridget for v1 backwards compatibility
function updateJQuery( $ ) {
  if ( !$ || ( $ && $.bridget ) ) {
    return;
  }
  $.bridget = jQueryBridget;
}

updateJQuery( jQuery || window.jQuery );

// -----  ----- //

return jQueryBridget;

}));

/**
 * EvEmitter v1.1.0
 * Lil' event emitter
 * MIT License
 */

/* jshint unused: true, undef: true, strict: true */

( function( global, factory ) {
  // universal module definition
  /* jshint strict: false */ /* globals define, module, window */
  if ( typeof define == 'function' && define.amd ) {
    // AMD - RequireJS
    define( 'ev-emitter/ev-emitter',factory );
  } else if ( typeof module == 'object' && module.exports ) {
    // CommonJS - Browserify, Webpack
    module.exports = factory();
  } else {
    // Browser globals
    global.EvEmitter = factory();
  }

}( typeof window != 'undefined' ? window : this, function() {



function EvEmitter() {}

var proto = EvEmitter.prototype;

proto.on = function( eventName, listener ) {
  if ( !eventName || !listener ) {
    return;
  }
  // set events hash
  var events = this._events = this._events || {};
  // set listeners array
  var listeners = events[ eventName ] = events[ eventName ] || [];
  // only add once
  if ( listeners.indexOf( listener ) == -1 ) {
    listeners.push( listener );
  }

  return this;
};

proto.once = function( eventName, listener ) {
  if ( !eventName || !listener ) {
    return;
  }
  // add event
  this.on( eventName, listener );
  // set once flag
  // set onceEvents hash
  var onceEvents = this._onceEvents = this._onceEvents || {};
  // set onceListeners object
  var onceListeners = onceEvents[ eventName ] = onceEvents[ eventName ] || {};
  // set flag
  onceListeners[ listener ] = true;

  return this;
};

proto.off = function( eventName, listener ) {
  var listeners = this._events && this._events[ eventName ];
  if ( !listeners || !listeners.length ) {
    return;
  }
  var index = listeners.indexOf( listener );
  if ( index != -1 ) {
    listeners.splice( index, 1 );
  }

  return this;
};

proto.emitEvent = function( eventName, args ) {
  var listeners = this._events && this._events[ eventName ];
  if ( !listeners || !listeners.length ) {
    return;
  }
  // copy over to avoid interference if .off() in listener
  listeners = listeners.slice(0);
  args = args || [];
  // once stuff
  var onceListeners = this._onceEvents && this._onceEvents[ eventName ];

  for ( var i=0; i < listeners.length; i++ ) {
    var listener = listeners[i]
    var isOnce = onceListeners && onceListeners[ listener ];
    if ( isOnce ) {
      // remove listener
      // remove before trigger to prevent recursion
      this.off( eventName, listener );
      // unset once flag
      delete onceListeners[ listener ];
    }
    // trigger listener
    listener.apply( this, args );
  }

  return this;
};

proto.allOff = function() {
  delete this._events;
  delete this._onceEvents;
};

return EvEmitter;

}));

/*!
 * getSize v2.0.3
 * measure size of elements
 * MIT license
 */

/* jshint browser: true, strict: true, undef: true, unused: true */
/* globals console: false */

( function( window, factory ) {
  /* jshint strict: false */ /* globals define, module */
  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( 'get-size/get-size',factory );
  } else if ( typeof module == 'object' && module.exports ) {
    // CommonJS
    module.exports = factory();
  } else {
    // browser global
    window.getSize = factory();
  }

})( window, function factory() {
'use strict';

// -------------------------- helpers -------------------------- //

// get a number from a string, not a percentage
function getStyleSize( value ) {
  var num = parseFloat( value );
  // not a percent like '100%', and a number
  var isValid = value.indexOf('%') == -1 && !isNaN( num );
  return isValid && num;
}

function noop() {}

var logError = typeof console == 'undefined' ? noop :
  function( message ) {
    console.error( message );
  };

// -------------------------- measurements -------------------------- //

var measurements = [
  'paddingLeft',
  'paddingRight',
  'paddingTop',
  'paddingBottom',
  'marginLeft',
  'marginRight',
  'marginTop',
  'marginBottom',
  'borderLeftWidth',
  'borderRightWidth',
  'borderTopWidth',
  'borderBottomWidth'
];

var measurementsLength = measurements.length;

function getZeroSize() {
  var size = {
    width: 0,
    height: 0,
    innerWidth: 0,
    innerHeight: 0,
    outerWidth: 0,
    outerHeight: 0
  };
  for ( var i=0; i < measurementsLength; i++ ) {
    var measurement = measurements[i];
    size[ measurement ] = 0;
  }
  return size;
}

// -------------------------- getStyle -------------------------- //

/**
 * getStyle, get style of element, check for Firefox bug
 * https://bugzilla.mozilla.org/show_bug.cgi?id=548397
 */
function getStyle( elem ) {
  var style = getComputedStyle( elem );
  if ( !style ) {
    logError( 'Style returned ' + style +
      '. Are you running this code in a hidden iframe on Firefox? ' +
      'See https://bit.ly/getsizebug1' );
  }
  return style;
}

// -------------------------- setup -------------------------- //

var isSetup = false;

var isBoxSizeOuter;

/**
 * setup
 * check isBoxSizerOuter
 * do on first getSize() rather than on page load for Firefox bug
 */
function setup() {
  // setup once
  if ( isSetup ) {
    return;
  }
  isSetup = true;

  // -------------------------- box sizing -------------------------- //

  /**
   * Chrome & Safari measure the outer-width on style.width on border-box elems
   * IE11 & Firefox<29 measures the inner-width
   */
  var div = document.createElement('div');
  div.style.width = '200px';
  div.style.padding = '1px 2px 3px 4px';
  div.style.borderStyle = 'solid';
  div.style.borderWidth = '1px 2px 3px 4px';
  div.style.boxSizing = 'border-box';

  var body = document.body || document.documentElement;
  body.appendChild( div );
  var style = getStyle( div );
  // round value for browser zoom. desandro/masonry#928
  isBoxSizeOuter = Math.round( getStyleSize( style.width ) ) == 200;
  getSize.isBoxSizeOuter = isBoxSizeOuter;

  body.removeChild( div );
}

// -------------------------- getSize -------------------------- //

function getSize( elem ) {
  setup();

  // use querySeletor if elem is string
  if ( typeof elem == 'string' ) {
    elem = document.querySelector( elem );
  }

  // do not proceed on non-objects
  if ( !elem || typeof elem != 'object' || !elem.nodeType ) {
    return;
  }

  var style = getStyle( elem );

  // if hidden, everything is 0
  if ( style.display == 'none' ) {
    return getZeroSize();
  }

  var size = {};
  size.width = elem.offsetWidth;
  size.height = elem.offsetHeight;

  var isBorderBox = size.isBorderBox = style.boxSizing == 'border-box';

  // get all measurements
  for ( var i=0; i < measurementsLength; i++ ) {
    var measurement = measurements[i];
    var value = style[ measurement ];
    var num = parseFloat( value );
    // any 'auto', 'medium' value will be 0
    size[ measurement ] = !isNaN( num ) ? num : 0;
  }

  var paddingWidth = size.paddingLeft + size.paddingRight;
  var paddingHeight = size.paddingTop + size.paddingBottom;
  var marginWidth = size.marginLeft + size.marginRight;
  var marginHeight = size.marginTop + size.marginBottom;
  var borderWidth = size.borderLeftWidth + size.borderRightWidth;
  var borderHeight = size.borderTopWidth + size.borderBottomWidth;

  var isBorderBoxSizeOuter = isBorderBox && isBoxSizeOuter;

  // overwrite width and height if we can get it from style
  var styleWidth = getStyleSize( style.width );
  if ( styleWidth !== false ) {
    size.width = styleWidth +
      // add padding and border unless it's already including it
      ( isBorderBoxSizeOuter ? 0 : paddingWidth + borderWidth );
  }

  var styleHeight = getStyleSize( style.height );
  if ( styleHeight !== false ) {
    size.height = styleHeight +
      // add padding and border unless it's already including it
      ( isBorderBoxSizeOuter ? 0 : paddingHeight + borderHeight );
  }

  size.innerWidth = size.width - ( paddingWidth + borderWidth );
  size.innerHeight = size.height - ( paddingHeight + borderHeight );

  size.outerWidth = size.width + marginWidth;
  size.outerHeight = size.height + marginHeight;

  return size;
}

return getSize;

});

/**
 * matchesSelector v2.0.2
 * matchesSelector( element, '.selector' )
 * MIT license
 */

/*jshint browser: true, strict: true, undef: true, unused: true */

( function( window, factory ) {
  /*global define: false, module: false */
  'use strict';
  // universal module definition
  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( 'desandro-matches-selector/matches-selector',factory );
  } else if ( typeof module == 'object' && module.exports ) {
    // CommonJS
    module.exports = factory();
  } else {
    // browser global
    window.matchesSelector = factory();
  }

}( window, function factory() {
  'use strict';

  var matchesMethod = ( function() {
    var ElemProto = window.Element.prototype;
    // check for the standard method name first
    if ( ElemProto.matches ) {
      return 'matches';
    }
    // check un-prefixed
    if ( ElemProto.matchesSelector ) {
      return 'matchesSelector';
    }
    // check vendor prefixes
    var prefixes = [ 'webkit', 'moz', 'ms', 'o' ];

    for ( var i=0; i < prefixes.length; i++ ) {
      var prefix = prefixes[i];
      var method = prefix + 'MatchesSelector';
      if ( ElemProto[ method ] ) {
        return method;
      }
    }
  })();

  return function matchesSelector( elem, selector ) {
    return elem[ matchesMethod ]( selector );
  };

}));

/**
 * Fizzy UI utils v2.0.7
 * MIT license
 */

/*jshint browser: true, undef: true, unused: true, strict: true */

( function( window, factory ) {
  // universal module definition
  /*jshint strict: false */ /*globals define, module, require */

  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( 'fizzy-ui-utils/utils',[
      'desandro-matches-selector/matches-selector'
    ], function( matchesSelector ) {
      return factory( window, matchesSelector );
    });
  } else if ( typeof module == 'object' && module.exports ) {
    // CommonJS
    module.exports = factory(
      window,
      require('desandro-matches-selector')
    );
  } else {
    // browser global
    window.fizzyUIUtils = factory(
      window,
      window.matchesSelector
    );
  }

}( window, function factory( window, matchesSelector ) {



var utils = {};

// ----- extend ----- //

// extends objects
utils.extend = function( a, b ) {
  for ( var prop in b ) {
    a[ prop ] = b[ prop ];
  }
  return a;
};

// ----- modulo ----- //

utils.modulo = function( num, div ) {
  return ( ( num % div ) + div ) % div;
};

// ----- makeArray ----- //

var arraySlice = Array.prototype.slice;

// turn element or nodeList into an array
utils.makeArray = function( obj ) {
  if ( Array.isArray( obj ) ) {
    // use object if already an array
    return obj;
  }
  // return empty array if undefined or null. #6
  if ( obj === null || obj === undefined ) {
    return [];
  }

  var isArrayLike = typeof obj == 'object' && typeof obj.length == 'number';
  if ( isArrayLike ) {
    // convert nodeList to array
    return arraySlice.call( obj );
  }

  // array of single index
  return [ obj ];
};

// ----- removeFrom ----- //

utils.removeFrom = function( ary, obj ) {
  var index = ary.indexOf( obj );
  if ( index != -1 ) {
    ary.splice( index, 1 );
  }
};

// ----- getParent ----- //

utils.getParent = function( elem, selector ) {
  while ( elem.parentNode && elem != document.body ) {
    elem = elem.parentNode;
    if ( matchesSelector( elem, selector ) ) {
      return elem;
    }
  }
};

// ----- getQueryElement ----- //

// use element as selector string
utils.getQueryElement = function( elem ) {
  if ( typeof elem == 'string' ) {
    return document.querySelector( elem );
  }
  return elem;
};

// ----- handleEvent ----- //

// enable .ontype to trigger from .addEventListener( elem, 'type' )
utils.handleEvent = function( event ) {
  var method = 'on' + event.type;
  if ( this[ method ] ) {
    this[ method ]( event );
  }
};

// ----- filterFindElements ----- //

utils.filterFindElements = function( elems, selector ) {
  // make array of elems
  elems = utils.makeArray( elems );
  var ffElems = [];

  elems.forEach( function( elem ) {
    // check that elem is an actual element
    if ( !( elem instanceof HTMLElement ) ) {
      return;
    }
    // add elem if no selector
    if ( !selector ) {
      ffElems.push( elem );
      return;
    }
    // filter & find items if we have a selector
    // filter
    if ( matchesSelector( elem, selector ) ) {
      ffElems.push( elem );
    }
    // find children
    var childElems = elem.querySelectorAll( selector );
    // concat childElems to filterFound array
    for ( var i=0; i < childElems.length; i++ ) {
      ffElems.push( childElems[i] );
    }
  });

  return ffElems;
};

// ----- debounceMethod ----- //

utils.debounceMethod = function( _class, methodName, threshold ) {
  threshold = threshold || 100;
  // original method
  var method = _class.prototype[ methodName ];
  var timeoutName = methodName + 'Timeout';

  _class.prototype[ methodName ] = function() {
    var timeout = this[ timeoutName ];
    clearTimeout( timeout );

    var args = arguments;
    var _this = this;
    this[ timeoutName ] = setTimeout( function() {
      method.apply( _this, args );
      delete _this[ timeoutName ];
    }, threshold );
  };
};

// ----- docReady ----- //

utils.docReady = function( callback ) {
  var readyState = document.readyState;
  if ( readyState == 'complete' || readyState == 'interactive' ) {
    // do async to allow for other scripts to run. metafizzy/flickity#441
    setTimeout( callback );
  } else {
    document.addEventListener( 'DOMContentLoaded', callback );
  }
};

// ----- htmlInit ----- //

// http://jamesroberts.name/blog/2010/02/22/string-functions-for-javascript-trim-to-camel-case-to-dashed-and-to-underscore/
utils.toDashed = function( str ) {
  return str.replace( /(.)([A-Z])/g, function( match, $1, $2 ) {
    return $1 + '-' + $2;
  }).toLowerCase();
};

var console = window.console;
/**
 * allow user to initialize classes via [data-namespace] or .js-namespace class
 * htmlInit( Widget, 'widgetName' )
 * options are parsed from data-namespace-options
 */
utils.htmlInit = function( WidgetClass, namespace ) {
  utils.docReady( function() {
    var dashedNamespace = utils.toDashed( namespace );
    var dataAttr = 'data-' + dashedNamespace;
    var dataAttrElems = document.querySelectorAll( '[' + dataAttr + ']' );
    var jsDashElems = document.querySelectorAll( '.js-' + dashedNamespace );
    var elems = utils.makeArray( dataAttrElems )
      .concat( utils.makeArray( jsDashElems ) );
    var dataOptionsAttr = dataAttr + '-options';
    var jQuery = window.jQuery;

    elems.forEach( function( elem ) {
      var attr = elem.getAttribute( dataAttr ) ||
        elem.getAttribute( dataOptionsAttr );
      var options;
      try {
        options = attr && JSON.parse( attr );
      } catch ( error ) {
        // log error, do not initialize
        if ( console ) {
          console.error( 'Error parsing ' + dataAttr + ' on ' + elem.className +
          ': ' + error );
        }
        return;
      }
      // initialize
      var instance = new WidgetClass( elem, options );
      // make available via $().data('namespace')
      if ( jQuery ) {
        jQuery.data( elem, namespace, instance );
      }
    });

  });
};

// -----  ----- //

return utils;

}));

/**
 * Outlayer Item
 */

( function( window, factory ) {
  // universal module definition
  /* jshint strict: false */ /* globals define, module, require */
  if ( typeof define == 'function' && define.amd ) {
    // AMD - RequireJS
    define( 'outlayer/item',[
        'ev-emitter/ev-emitter',
        'get-size/get-size'
      ],
      factory
    );
  } else if ( typeof module == 'object' && module.exports ) {
    // CommonJS - Browserify, Webpack
    module.exports = factory(
      require('ev-emitter'),
      require('get-size')
    );
  } else {
    // browser global
    window.Outlayer = {};
    window.Outlayer.Item = factory(
      window.EvEmitter,
      window.getSize
    );
  }

}( window, function factory( EvEmitter, getSize ) {
'use strict';

// ----- helpers ----- //

function isEmptyObj( obj ) {
  for ( var prop in obj ) {
    return false;
  }
  prop = null;
  return true;
}

// -------------------------- CSS3 support -------------------------- //


var docElemStyle = document.documentElement.style;

var transitionProperty = typeof docElemStyle.transition == 'string' ?
  'transition' : 'WebkitTransition';
var transformProperty = typeof docElemStyle.transform == 'string' ?
  'transform' : 'WebkitTransform';

var transitionEndEvent = {
  WebkitTransition: 'webkitTransitionEnd',
  transition: 'transitionend'
}[ transitionProperty ];

// cache all vendor properties that could have vendor prefix
var vendorProperties = {
  transform: transformProperty,
  transition: transitionProperty,
  transitionDuration: transitionProperty + 'Duration',
  transitionProperty: transitionProperty + 'Property',
  transitionDelay: transitionProperty + 'Delay'
};

// -------------------------- Item -------------------------- //

function Item( element, layout ) {
  if ( !element ) {
    return;
  }

  this.element = element;
  // parent layout class, i.e. Masonry, Isotope, or Packery
  this.layout = layout;
  this.position = {
    x: 0,
    y: 0
  };

  this._create();
}

// inherit EvEmitter
var proto = Item.prototype = Object.create( EvEmitter.prototype );
proto.constructor = Item;

proto._create = function() {
  // transition objects
  this._transn = {
    ingProperties: {},
    clean: {},
    onEnd: {}
  };

  this.css({
    position: 'absolute'
  });
};

// trigger specified handler for event type
proto.handleEvent = function( event ) {
  var method = 'on' + event.type;
  if ( this[ method ] ) {
    this[ method ]( event );
  }
};

proto.getSize = function() {
  this.size = getSize( this.element );
};

/**
 * apply CSS styles to element
 * @param {Object} style
 */
proto.css = function( style ) {
  var elemStyle = this.element.style;

  for ( var prop in style ) {
    // use vendor property if available
    var supportedProp = vendorProperties[ prop ] || prop;
    elemStyle[ supportedProp ] = style[ prop ];
  }
};

 // measure position, and sets it
proto.getPosition = function() {
  var style = getComputedStyle( this.element );
  var isOriginLeft = this.layout._getOption('originLeft');
  var isOriginTop = this.layout._getOption('originTop');
  var xValue = style[ isOriginLeft ? 'left' : 'right' ];
  var yValue = style[ isOriginTop ? 'top' : 'bottom' ];
  var x = parseFloat( xValue );
  var y = parseFloat( yValue );
  // convert percent to pixels
  var layoutSize = this.layout.size;
  if ( xValue.indexOf('%') != -1 ) {
    x = ( x / 100 ) * layoutSize.width;
  }
  if ( yValue.indexOf('%') != -1 ) {
    y = ( y / 100 ) * layoutSize.height;
  }
  // clean up 'auto' or other non-integer values
  x = isNaN( x ) ? 0 : x;
  y = isNaN( y ) ? 0 : y;
  // remove padding from measurement
  x -= isOriginLeft ? layoutSize.paddingLeft : layoutSize.paddingRight;
  y -= isOriginTop ? layoutSize.paddingTop : layoutSize.paddingBottom;

  this.position.x = x;
  this.position.y = y;
};

// set settled position, apply padding
proto.layoutPosition = function() {
  var layoutSize = this.layout.size;
  var style = {};
  var isOriginLeft = this.layout._getOption('originLeft');
  var isOriginTop = this.layout._getOption('originTop');

  // x
  var xPadding = isOriginLeft ? 'paddingLeft' : 'paddingRight';
  var xProperty = isOriginLeft ? 'left' : 'right';
  var xResetProperty = isOriginLeft ? 'right' : 'left';

  var x = this.position.x + layoutSize[ xPadding ];
  // set in percentage or pixels
  style[ xProperty ] = this.getXValue( x );
  // reset other property
  style[ xResetProperty ] = '';

  // y
  var yPadding = isOriginTop ? 'paddingTop' : 'paddingBottom';
  var yProperty = isOriginTop ? 'top' : 'bottom';
  var yResetProperty = isOriginTop ? 'bottom' : 'top';

  var y = this.position.y + layoutSize[ yPadding ];
  // set in percentage or pixels
  style[ yProperty ] = this.getYValue( y );
  // reset other property
  style[ yResetProperty ] = '';

  this.css( style );
  this.emitEvent( 'layout', [ this ] );
};

proto.getXValue = function( x ) {
  var isHorizontal = this.layout._getOption('horizontal');
  return this.layout.options.percentPosition && !isHorizontal ?
    ( ( x / this.layout.size.width ) * 100 ) + '%' : x + 'px';
};

proto.getYValue = function( y ) {
  var isHorizontal = this.layout._getOption('horizontal');
  return this.layout.options.percentPosition && isHorizontal ?
    ( ( y / this.layout.size.height ) * 100 ) + '%' : y + 'px';
};

proto._transitionTo = function( x, y ) {
  this.getPosition();
  // get current x & y from top/left
  var curX = this.position.x;
  var curY = this.position.y;

  var didNotMove = x == this.position.x && y == this.position.y;

  // save end position
  this.setPosition( x, y );

  // if did not move and not transitioning, just go to layout
  if ( didNotMove && !this.isTransitioning ) {
    this.layoutPosition();
    return;
  }

  var transX = x - curX;
  var transY = y - curY;
  var transitionStyle = {};
  transitionStyle.transform = this.getTranslate( transX, transY );

  this.transition({
    to: transitionStyle,
    onTransitionEnd: {
      transform: this.layoutPosition
    },
    isCleaning: true
  });
};

proto.getTranslate = function( x, y ) {
  // flip cooridinates if origin on right or bottom
  var isOriginLeft = this.layout._getOption('originLeft');
  var isOriginTop = this.layout._getOption('originTop');
  x = isOriginLeft ? x : -x;
  y = isOriginTop ? y : -y;
  return 'translate3d(' + x + 'px, ' + y + 'px, 0)';
};

// non transition + transform support
proto.goTo = function( x, y ) {
  this.setPosition( x, y );
  this.layoutPosition();
};

proto.moveTo = proto._transitionTo;

proto.setPosition = function( x, y ) {
  this.position.x = parseFloat( x );
  this.position.y = parseFloat( y );
};

// ----- transition ----- //

/**
 * @param {Object} style - CSS
 * @param {Function} onTransitionEnd
 */

// non transition, just trigger callback
proto._nonTransition = function( args ) {
  this.css( args.to );
  if ( args.isCleaning ) {
    this._removeStyles( args.to );
  }
  for ( var prop in args.onTransitionEnd ) {
    args.onTransitionEnd[ prop ].call( this );
  }
};

/**
 * proper transition
 * @param {Object} args - arguments
 *   @param {Object} to - style to transition to
 *   @param {Object} from - style to start transition from
 *   @param {Boolean} isCleaning - removes transition styles after transition
 *   @param {Function} onTransitionEnd - callback
 */
proto.transition = function( args ) {
  // redirect to nonTransition if no transition duration
  if ( !parseFloat( this.layout.options.transitionDuration ) ) {
    this._nonTransition( args );
    return;
  }

  var _transition = this._transn;
  // keep track of onTransitionEnd callback by css property
  for ( var prop in args.onTransitionEnd ) {
    _transition.onEnd[ prop ] = args.onTransitionEnd[ prop ];
  }
  // keep track of properties that are transitioning
  for ( prop in args.to ) {
    _transition.ingProperties[ prop ] = true;
    // keep track of properties to clean up when transition is done
    if ( args.isCleaning ) {
      _transition.clean[ prop ] = true;
    }
  }

  // set from styles
  if ( args.from ) {
    this.css( args.from );
    // force redraw. http://blog.alexmaccaw.com/css-transitions
    var h = this.element.offsetHeight;
    // hack for JSHint to hush about unused var
    h = null;
  }
  // enable transition
  this.enableTransition( args.to );
  // set styles that are transitioning
  this.css( args.to );

  this.isTransitioning = true;

};

// dash before all cap letters, including first for
// WebkitTransform => -webkit-transform
function toDashedAll( str ) {
  return str.replace( /([A-Z])/g, function( $1 ) {
    return '-' + $1.toLowerCase();
  });
}

var transitionProps = 'opacity,' + toDashedAll( transformProperty );

proto.enableTransition = function(/* style */) {
  // HACK changing transitionProperty during a transition
  // will cause transition to jump
  if ( this.isTransitioning ) {
    return;
  }

  var duration = this.layout.options.transitionDuration;
  duration = typeof duration == 'number' ? duration + 'ms' : duration;
  // enable transition styles
  this.css({
    transitionProperty: transitionProps,
    transitionDuration: duration,
    transitionDelay: this.staggerDelay || 0
  });
  // listen for transition end event
  this.element.addEventListener( transitionEndEvent, this, false );
};

// ----- events ----- //

proto.onwebkitTransitionEnd = function( event ) {
  this.ontransitionend( event );
};

proto.onotransitionend = function( event ) {
  this.ontransitionend( event );
};

// properties that I munge to make my life easier
var dashedVendorProperties = {
  '-webkit-transform': 'transform'
};

proto.ontransitionend = function( event ) {
  // disregard bubbled events from children
  if ( event.target !== this.element ) {
    return;
  }
  var _transition = this._transn;
  // get property name of transitioned property, convert to prefix-free
  var propertyName = dashedVendorProperties[ event.propertyName ] || event.propertyName;

  // remove property that has completed transitioning
  delete _transition.ingProperties[ propertyName ];
  // check if any properties are still transitioning
  if ( isEmptyObj( _transition.ingProperties ) ) {
    // all properties have completed transitioning
    this.disableTransition();
  }
  // clean style
  if ( propertyName in _transition.clean ) {
    // clean up style
    this.element.style[ event.propertyName ] = '';
    delete _transition.clean[ propertyName ];
  }
  // trigger onTransitionEnd callback
  if ( propertyName in _transition.onEnd ) {
    var onTransitionEnd = _transition.onEnd[ propertyName ];
    onTransitionEnd.call( this );
    delete _transition.onEnd[ propertyName ];
  }

  this.emitEvent( 'transitionEnd', [ this ] );
};

proto.disableTransition = function() {
  this.removeTransitionStyles();
  this.element.removeEventListener( transitionEndEvent, this, false );
  this.isTransitioning = false;
};

/**
 * removes style property from element
 * @param {Object} style
**/
proto._removeStyles = function( style ) {
  // clean up transition styles
  var cleanStyle = {};
  for ( var prop in style ) {
    cleanStyle[ prop ] = '';
  }
  this.css( cleanStyle );
};

var cleanTransitionStyle = {
  transitionProperty: '',
  transitionDuration: '',
  transitionDelay: ''
};

proto.removeTransitionStyles = function() {
  // remove transition
  this.css( cleanTransitionStyle );
};

// ----- stagger ----- //

proto.stagger = function( delay ) {
  delay = isNaN( delay ) ? 0 : delay;
  this.staggerDelay = delay + 'ms';
};

// ----- show/hide/remove ----- //

// remove element from DOM
proto.removeElem = function() {
  this.element.parentNode.removeChild( this.element );
  // remove display: none
  this.css({ display: '' });
  this.emitEvent( 'remove', [ this ] );
};

proto.remove = function() {
  // just remove element if no transition support or no transition
  if ( !transitionProperty || !parseFloat( this.layout.options.transitionDuration ) ) {
    this.removeElem();
    return;
  }

  // start transition
  this.once( 'transitionEnd', function() {
    this.removeElem();
  });
  this.hide();
};

proto.reveal = function() {
  delete this.isHidden;
  // remove display: none
  this.css({ display: '' });

  var options = this.layout.options;

  var onTransitionEnd = {};
  var transitionEndProperty = this.getHideRevealTransitionEndProperty('visibleStyle');
  onTransitionEnd[ transitionEndProperty ] = this.onRevealTransitionEnd;

  this.transition({
    from: options.hiddenStyle,
    to: options.visibleStyle,
    isCleaning: true,
    onTransitionEnd: onTransitionEnd
  });
};

proto.onRevealTransitionEnd = function() {
  // check if still visible
  // during transition, item may have been hidden
  if ( !this.isHidden ) {
    this.emitEvent('reveal');
  }
};

/**
 * get style property use for hide/reveal transition end
 * @param {String} styleProperty - hiddenStyle/visibleStyle
 * @returns {String}
 */
proto.getHideRevealTransitionEndProperty = function( styleProperty ) {
  var optionStyle = this.layout.options[ styleProperty ];
  // use opacity
  if ( optionStyle.opacity ) {
    return 'opacity';
  }
  // get first property
  for ( var prop in optionStyle ) {
    return prop;
  }
};

proto.hide = function() {
  // set flag
  this.isHidden = true;
  // remove display: none
  this.css({ display: '' });

  var options = this.layout.options;

  var onTransitionEnd = {};
  var transitionEndProperty = this.getHideRevealTransitionEndProperty('hiddenStyle');
  onTransitionEnd[ transitionEndProperty ] = this.onHideTransitionEnd;

  this.transition({
    from: options.visibleStyle,
    to: options.hiddenStyle,
    // keep hidden stuff hidden
    isCleaning: true,
    onTransitionEnd: onTransitionEnd
  });
};

proto.onHideTransitionEnd = function() {
  // check if still hidden
  // during transition, item may have been un-hidden
  if ( this.isHidden ) {
    this.css({ display: 'none' });
    this.emitEvent('hide');
  }
};

proto.destroy = function() {
  this.css({
    position: '',
    left: '',
    right: '',
    top: '',
    bottom: '',
    transition: '',
    transform: ''
  });
};

return Item;

}));



( function( window, factory ) {
  'use strict';
  // universal module definition
  /* jshint strict: false */ /* globals define, module, require */
  if ( typeof define == 'function' && define.amd ) {
    // AMD - RequireJS
    define( 'outlayer/outlayer',[
        'ev-emitter/ev-emitter',
        'get-size/get-size',
        'fizzy-ui-utils/utils',
        './item'
      ],
      function( EvEmitter, getSize, utils, Item ) {
        return factory( window, EvEmitter, getSize, utils, Item);
      }
    );
  } else if ( typeof module == 'object' && module.exports ) {
    // CommonJS - Browserify, Webpack
    module.exports = factory(
      window,
      require('ev-emitter'),
      require('get-size'),
      require('fizzy-ui-utils'),
      require('./item')
    );
  } else {
    // browser global
    window.Outlayer = factory(
      window,
      window.EvEmitter,
      window.getSize,
      window.fizzyUIUtils,
      window.Outlayer.Item
    );
  }

}( window, function factory( window, EvEmitter, getSize, utils, Item ) {
'use strict';

// ----- vars ----- //

var console = window.console;
var jQuery = window.jQuery;
var noop = function() {};

// -------------------------- Outlayer -------------------------- //

// globally unique identifiers
var GUID = 0;
// internal store of all Outlayer intances
var instances = {};


/**
 * @param {Element, String} element
 * @param {Object} options
 * @constructor
 */
function Outlayer( element, options ) {
  var queryElement = utils.getQueryElement( element );
  if ( !queryElement ) {
    if ( console ) {
      console.error( 'Bad element for ' + this.constructor.namespace +
        ': ' + ( queryElement || element ) );
    }
    return;
  }
  this.element = queryElement;
  // add jQuery
  if ( jQuery ) {
    this.$element = jQuery( this.element );
  }

  // options
  this.options = utils.extend( {}, this.constructor.defaults );
  this.option( options );

  // add id for Outlayer.getFromElement
  var id = ++GUID;
  this.element.outlayerGUID = id; // expando
  instances[ id ] = this; // associate via id

  // kick it off
  this._create();

  var isInitLayout = this._getOption('initLayout');
  if ( isInitLayout ) {
    this.layout();
  }
}

// settings are for internal use only
Outlayer.namespace = 'outlayer';
Outlayer.Item = Item;

// default options
Outlayer.defaults = {
  containerStyle: {
    position: 'relative'
  },
  initLayout: true,
  originLeft: true,
  originTop: true,
  resize: true,
  resizeContainer: true,
  // item options
  transitionDuration: '0.4s',
  hiddenStyle: {
    opacity: 0,
    transform: 'scale(0.001)'
  },
  visibleStyle: {
    opacity: 1,
    transform: 'scale(1)'
  }
};

var proto = Outlayer.prototype;
// inherit EvEmitter
utils.extend( proto, EvEmitter.prototype );

/**
 * set options
 * @param {Object} opts
 */
proto.option = function( opts ) {
  utils.extend( this.options, opts );
};

/**
 * get backwards compatible option value, check old name
 */
proto._getOption = function( option ) {
  var oldOption = this.constructor.compatOptions[ option ];
  return oldOption && this.options[ oldOption ] !== undefined ?
    this.options[ oldOption ] : this.options[ option ];
};

Outlayer.compatOptions = {
  // currentName: oldName
  initLayout: 'isInitLayout',
  horizontal: 'isHorizontal',
  layoutInstant: 'isLayoutInstant',
  originLeft: 'isOriginLeft',
  originTop: 'isOriginTop',
  resize: 'isResizeBound',
  resizeContainer: 'isResizingContainer'
};

proto._create = function() {
  // get items from children
  this.reloadItems();
  // elements that affect layout, but are not laid out
  this.stamps = [];
  this.stamp( this.options.stamp );
  // set container style
  utils.extend( this.element.style, this.options.containerStyle );

  // bind resize method
  var canBindResize = this._getOption('resize');
  if ( canBindResize ) {
    this.bindResize();
  }
};

// goes through all children again and gets bricks in proper order
proto.reloadItems = function() {
  // collection of item elements
  this.items = this._itemize( this.element.children );
};


/**
 * turn elements into Outlayer.Items to be used in layout
 * @param {Array or NodeList or HTMLElement} elems
 * @returns {Array} items - collection of new Outlayer Items
 */
proto._itemize = function( elems ) {

  var itemElems = this._filterFindItemElements( elems );
  var Item = this.constructor.Item;

  // create new Outlayer Items for collection
  var items = [];
  for ( var i=0; i < itemElems.length; i++ ) {
    var elem = itemElems[i];
    var item = new Item( elem, this );
    items.push( item );
  }

  return items;
};

/**
 * get item elements to be used in layout
 * @param {Array or NodeList or HTMLElement} elems
 * @returns {Array} items - item elements
 */
proto._filterFindItemElements = function( elems ) {
  return utils.filterFindElements( elems, this.options.itemSelector );
};

/**
 * getter method for getting item elements
 * @returns {Array} elems - collection of item elements
 */
proto.getItemElements = function() {
  return this.items.map( function( item ) {
    return item.element;
  });
};

// ----- init & layout ----- //

/**
 * lays out all items
 */
proto.layout = function() {
  this._resetLayout();
  this._manageStamps();

  // don't animate first layout
  var layoutInstant = this._getOption('layoutInstant');
  var isInstant = layoutInstant !== undefined ?
    layoutInstant : !this._isLayoutInited;
  this.layoutItems( this.items, isInstant );

  // flag for initalized
  this._isLayoutInited = true;
};

// _init is alias for layout
proto._init = proto.layout;

/**
 * logic before any new layout
 */
proto._resetLayout = function() {
  this.getSize();
};


proto.getSize = function() {
  this.size = getSize( this.element );
};

/**
 * get measurement from option, for columnWidth, rowHeight, gutter
 * if option is String -> get element from selector string, & get size of element
 * if option is Element -> get size of element
 * else use option as a number
 *
 * @param {String} measurement
 * @param {String} size - width or height
 * @private
 */
proto._getMeasurement = function( measurement, size ) {
  var option = this.options[ measurement ];
  var elem;
  if ( !option ) {
    // default to 0
    this[ measurement ] = 0;
  } else {
    // use option as an element
    if ( typeof option == 'string' ) {
      elem = this.element.querySelector( option );
    } else if ( option instanceof HTMLElement ) {
      elem = option;
    }
    // use size of element, if element
    this[ measurement ] = elem ? getSize( elem )[ size ] : option;
  }
};

/**
 * layout a collection of item elements
 * @api public
 */
proto.layoutItems = function( items, isInstant ) {
  items = this._getItemsForLayout( items );

  this._layoutItems( items, isInstant );

  this._postLayout();
};

/**
 * get the items to be laid out
 * you may want to skip over some items
 * @param {Array} items
 * @returns {Array} items
 */
proto._getItemsForLayout = function( items ) {
  return items.filter( function( item ) {
    return !item.isIgnored;
  });
};

/**
 * layout items
 * @param {Array} items
 * @param {Boolean} isInstant
 */
proto._layoutItems = function( items, isInstant ) {
  this._emitCompleteOnItems( 'layout', items );

  if ( !items || !items.length ) {
    // no items, emit event with empty array
    return;
  }

  var queue = [];

  items.forEach( function( item ) {
    // get x/y object from method
    var position = this._getItemLayoutPosition( item );
    // enqueue
    position.item = item;
    position.isInstant = isInstant || item.isLayoutInstant;
    queue.push( position );
  }, this );

  this._processLayoutQueue( queue );
};

/**
 * get item layout position
 * @param {Outlayer.Item} item
 * @returns {Object} x and y position
 */
proto._getItemLayoutPosition = function( /* item */ ) {
  return {
    x: 0,
    y: 0
  };
};

/**
 * iterate over array and position each item
 * Reason being - separating this logic prevents 'layout invalidation'
 * thx @paul_irish
 * @param {Array} queue
 */
proto._processLayoutQueue = function( queue ) {
  this.updateStagger();
  queue.forEach( function( obj, i ) {
    this._positionItem( obj.item, obj.x, obj.y, obj.isInstant, i );
  }, this );
};

// set stagger from option in milliseconds number
proto.updateStagger = function() {
  var stagger = this.options.stagger;
  if ( stagger === null || stagger === undefined ) {
    this.stagger = 0;
    return;
  }
  this.stagger = getMilliseconds( stagger );
  return this.stagger;
};

/**
 * Sets position of item in DOM
 * @param {Outlayer.Item} item
 * @param {Number} x - horizontal position
 * @param {Number} y - vertical position
 * @param {Boolean} isInstant - disables transitions
 */
proto._positionItem = function( item, x, y, isInstant, i ) {
  if ( isInstant ) {
    // if not transition, just set CSS
    item.goTo( x, y );
  } else {
    item.stagger( i * this.stagger );
    item.moveTo( x, y );
  }
};

/**
 * Any logic you want to do after each layout,
 * i.e. size the container
 */
proto._postLayout = function() {
  this.resizeContainer();
};

proto.resizeContainer = function() {
  var isResizingContainer = this._getOption('resizeContainer');
  if ( !isResizingContainer ) {
    return;
  }
  var size = this._getContainerSize();
  if ( size ) {
    this._setContainerMeasure( size.width, true );
    this._setContainerMeasure( size.height, false );
  }
};

/**
 * Sets width or height of container if returned
 * @returns {Object} size
 *   @param {Number} width
 *   @param {Number} height
 */
proto._getContainerSize = noop;

/**
 * @param {Number} measure - size of width or height
 * @param {Boolean} isWidth
 */
proto._setContainerMeasure = function( measure, isWidth ) {
  if ( measure === undefined ) {
    return;
  }

  var elemSize = this.size;
  // add padding and border width if border box
  if ( elemSize.isBorderBox ) {
    measure += isWidth ? elemSize.paddingLeft + elemSize.paddingRight +
      elemSize.borderLeftWidth + elemSize.borderRightWidth :
      elemSize.paddingBottom + elemSize.paddingTop +
      elemSize.borderTopWidth + elemSize.borderBottomWidth;
  }

  measure = Math.max( measure, 0 );
  this.element.style[ isWidth ? 'width' : 'height' ] = measure + 'px';
};

/**
 * emit eventComplete on a collection of items events
 * @param {String} eventName
 * @param {Array} items - Outlayer.Items
 */
proto._emitCompleteOnItems = function( eventName, items ) {
  var _this = this;
  function onComplete() {
    _this.dispatchEvent( eventName + 'Complete', null, [ items ] );
  }

  var count = items.length;
  if ( !items || !count ) {
    onComplete();
    return;
  }

  var doneCount = 0;
  function tick() {
    doneCount++;
    if ( doneCount == count ) {
      onComplete();
    }
  }

  // bind callback
  items.forEach( function( item ) {
    item.once( eventName, tick );
  });
};

/**
 * emits events via EvEmitter and jQuery events
 * @param {String} type - name of event
 * @param {Event} event - original event
 * @param {Array} args - extra arguments
 */
proto.dispatchEvent = function( type, event, args ) {
  // add original event to arguments
  var emitArgs = event ? [ event ].concat( args ) : args;
  this.emitEvent( type, emitArgs );

  if ( jQuery ) {
    // set this.$element
    this.$element = this.$element || jQuery( this.element );
    if ( event ) {
      // create jQuery event
      var $event = jQuery.Event( event );
      $event.type = type;
      this.$element.trigger( $event, args );
    } else {
      // just trigger with type if no event available
      this.$element.trigger( type, args );
    }
  }
};

// -------------------------- ignore & stamps -------------------------- //


/**
 * keep item in collection, but do not lay it out
 * ignored items do not get skipped in layout
 * @param {Element} elem
 */
proto.ignore = function( elem ) {
  var item = this.getItem( elem );
  if ( item ) {
    item.isIgnored = true;
  }
};

/**
 * return item to layout collection
 * @param {Element} elem
 */
proto.unignore = function( elem ) {
  var item = this.getItem( elem );
  if ( item ) {
    delete item.isIgnored;
  }
};

/**
 * adds elements to stamps
 * @param {NodeList, Array, Element, or String} elems
 */
proto.stamp = function( elems ) {
  elems = this._find( elems );
  if ( !elems ) {
    return;
  }

  this.stamps = this.stamps.concat( elems );
  // ignore
  elems.forEach( this.ignore, this );
};

/**
 * removes elements to stamps
 * @param {NodeList, Array, or Element} elems
 */
proto.unstamp = function( elems ) {
  elems = this._find( elems );
  if ( !elems ){
    return;
  }

  elems.forEach( function( elem ) {
    // filter out removed stamp elements
    utils.removeFrom( this.stamps, elem );
    this.unignore( elem );
  }, this );
};

/**
 * finds child elements
 * @param {NodeList, Array, Element, or String} elems
 * @returns {Array} elems
 */
proto._find = function( elems ) {
  if ( !elems ) {
    return;
  }
  // if string, use argument as selector string
  if ( typeof elems == 'string' ) {
    elems = this.element.querySelectorAll( elems );
  }
  elems = utils.makeArray( elems );
  return elems;
};

proto._manageStamps = function() {
  if ( !this.stamps || !this.stamps.length ) {
    return;
  }

  this._getBoundingRect();

  this.stamps.forEach( this._manageStamp, this );
};

// update boundingLeft / Top
proto._getBoundingRect = function() {
  // get bounding rect for container element
  var boundingRect = this.element.getBoundingClientRect();
  var size = this.size;
  this._boundingRect = {
    left: boundingRect.left + size.paddingLeft + size.borderLeftWidth,
    top: boundingRect.top + size.paddingTop + size.borderTopWidth,
    right: boundingRect.right - ( size.paddingRight + size.borderRightWidth ),
    bottom: boundingRect.bottom - ( size.paddingBottom + size.borderBottomWidth )
  };
};

/**
 * @param {Element} stamp
**/
proto._manageStamp = noop;

/**
 * get x/y position of element relative to container element
 * @param {Element} elem
 * @returns {Object} offset - has left, top, right, bottom
 */
proto._getElementOffset = function( elem ) {
  var boundingRect = elem.getBoundingClientRect();
  var thisRect = this._boundingRect;
  var size = getSize( elem );
  var offset = {
    left: boundingRect.left - thisRect.left - size.marginLeft,
    top: boundingRect.top - thisRect.top - size.marginTop,
    right: thisRect.right - boundingRect.right - size.marginRight,
    bottom: thisRect.bottom - boundingRect.bottom - size.marginBottom
  };
  return offset;
};

// -------------------------- resize -------------------------- //

// enable event handlers for listeners
// i.e. resize -> onresize
proto.handleEvent = utils.handleEvent;

/**
 * Bind layout to window resizing
 */
proto.bindResize = function() {
  window.addEventListener( 'resize', this );
  this.isResizeBound = true;
};

/**
 * Unbind layout to window resizing
 */
proto.unbindResize = function() {
  window.removeEventListener( 'resize', this );
  this.isResizeBound = false;
};

proto.onresize = function() {
  this.resize();
};

utils.debounceMethod( Outlayer, 'onresize', 100 );

proto.resize = function() {
  // don't trigger if size did not change
  // or if resize was unbound. See #9
  if ( !this.isResizeBound || !this.needsResizeLayout() ) {
    return;
  }

  this.layout();
};

/**
 * check if layout is needed post layout
 * @returns Boolean
 */
proto.needsResizeLayout = function() {
  var size = getSize( this.element );
  // check that this.size and size are there
  // IE8 triggers resize on body size change, so they might not be
  var hasSizes = this.size && size;
  return hasSizes && size.innerWidth !== this.size.innerWidth;
};

// -------------------------- methods -------------------------- //

/**
 * add items to Outlayer instance
 * @param {Array or NodeList or Element} elems
 * @returns {Array} items - Outlayer.Items
**/
proto.addItems = function( elems ) {
  var items = this._itemize( elems );
  // add items to collection
  if ( items.length ) {
    this.items = this.items.concat( items );
  }
  return items;
};

/**
 * Layout newly-appended item elements
 * @param {Array or NodeList or Element} elems
 */
proto.appended = function( elems ) {
  var items = this.addItems( elems );
  if ( !items.length ) {
    return;
  }
  // layout and reveal just the new items
  this.layoutItems( items, true );
  this.reveal( items );
};

/**
 * Layout prepended elements
 * @param {Array or NodeList or Element} elems
 */
proto.prepended = function( elems ) {
  var items = this._itemize( elems );
  if ( !items.length ) {
    return;
  }
  // add items to beginning of collection
  var previousItems = this.items.slice(0);
  this.items = items.concat( previousItems );
  // start new layout
  this._resetLayout();
  this._manageStamps();
  // layout new stuff without transition
  this.layoutItems( items, true );
  this.reveal( items );
  // layout previous items
  this.layoutItems( previousItems );
};

/**
 * reveal a collection of items
 * @param {Array of Outlayer.Items} items
 */
proto.reveal = function( items ) {
  this._emitCompleteOnItems( 'reveal', items );
  if ( !items || !items.length ) {
    return;
  }
  var stagger = this.updateStagger();
  items.forEach( function( item, i ) {
    item.stagger( i * stagger );
    item.reveal();
  });
};

/**
 * hide a collection of items
 * @param {Array of Outlayer.Items} items
 */
proto.hide = function( items ) {
  this._emitCompleteOnItems( 'hide', items );
  if ( !items || !items.length ) {
    return;
  }
  var stagger = this.updateStagger();
  items.forEach( function( item, i ) {
    item.stagger( i * stagger );
    item.hide();
  });
};

/**
 * reveal item elements
 * @param {Array}, {Element}, {NodeList} items
 */
proto.revealItemElements = function( elems ) {
  var items = this.getItems( elems );
  this.reveal( items );
};

/**
 * hide item elements
 * @param {Array}, {Element}, {NodeList} items
 */
proto.hideItemElements = function( elems ) {
  var items = this.getItems( elems );
  this.hide( items );
};

/**
 * get Outlayer.Item, given an Element
 * @param {Element} elem
 * @param {Function} callback
 * @returns {Outlayer.Item} item
 */
proto.getItem = function( elem ) {
  // loop through items to get the one that matches
  for ( var i=0; i < this.items.length; i++ ) {
    var item = this.items[i];
    if ( item.element == elem ) {
      // return item
      return item;
    }
  }
};

/**
 * get collection of Outlayer.Items, given Elements
 * @param {Array} elems
 * @returns {Array} items - Outlayer.Items
 */
proto.getItems = function( elems ) {
  elems = utils.makeArray( elems );
  var items = [];
  elems.forEach( function( elem ) {
    var item = this.getItem( elem );
    if ( item ) {
      items.push( item );
    }
  }, this );

  return items;
};

/**
 * remove element(s) from instance and DOM
 * @param {Array or NodeList or Element} elems
 */
proto.remove = function( elems ) {
  var removeItems = this.getItems( elems );

  this._emitCompleteOnItems( 'remove', removeItems );

  // bail if no items to remove
  if ( !removeItems || !removeItems.length ) {
    return;
  }

  removeItems.forEach( function( item ) {
    item.remove();
    // remove item from collection
    utils.removeFrom( this.items, item );
  }, this );
};

// ----- destroy ----- //

// remove and disable Outlayer instance
proto.destroy = function() {
  // clean up dynamic styles
  var style = this.element.style;
  style.height = '';
  style.position = '';
  style.width = '';
  // destroy items
  this.items.forEach( function( item ) {
    item.destroy();
  });

  this.unbindResize();

  var id = this.element.outlayerGUID;
  delete instances[ id ]; // remove reference to instance by id
  delete this.element.outlayerGUID;
  // remove data for jQuery
  if ( jQuery ) {
    jQuery.removeData( this.element, this.constructor.namespace );
  }

};

// -------------------------- data -------------------------- //

/**
 * get Outlayer instance from element
 * @param {Element} elem
 * @returns {Outlayer}
 */
Outlayer.data = function( elem ) {
  elem = utils.getQueryElement( elem );
  var id = elem && elem.outlayerGUID;
  return id && instances[ id ];
};


// -------------------------- create Outlayer class -------------------------- //

/**
 * create a layout class
 * @param {String} namespace
 */
Outlayer.create = function( namespace, options ) {
  // sub-class Outlayer
  var Layout = subclass( Outlayer );
  // apply new options and compatOptions
  Layout.defaults = utils.extend( {}, Outlayer.defaults );
  utils.extend( Layout.defaults, options );
  Layout.compatOptions = utils.extend( {}, Outlayer.compatOptions  );

  Layout.namespace = namespace;

  Layout.data = Outlayer.data;

  // sub-class Item
  Layout.Item = subclass( Item );

  // -------------------------- declarative -------------------------- //

  utils.htmlInit( Layout, namespace );

  // -------------------------- jQuery bridge -------------------------- //

  // make into jQuery plugin
  if ( jQuery && jQuery.bridget ) {
    jQuery.bridget( namespace, Layout );
  }

  return Layout;
};

function subclass( Parent ) {
  function SubClass() {
    Parent.apply( this, arguments );
  }

  SubClass.prototype = Object.create( Parent.prototype );
  SubClass.prototype.constructor = SubClass;

  return SubClass;
}

// ----- helpers ----- //

// how many milliseconds are in each unit
var msUnits = {
  ms: 1,
  s: 1000
};

// munge time-like parameter into millisecond number
// '0.4s' -> 40
function getMilliseconds( time ) {
  if ( typeof time == 'number' ) {
    return time;
  }
  var matches = time.match( /(^\d*\.?\d*)(\w*)/ );
  var num = matches && matches[1];
  var unit = matches && matches[2];
  if ( !num.length ) {
    return 0;
  }
  num = parseFloat( num );
  var mult = msUnits[ unit ] || 1;
  return num * mult;
}

// ----- fin ----- //

// back in global
Outlayer.Item = Item;

return Outlayer;

}));

/**
 * Isotope Item
**/

( function( window, factory ) {
  // universal module definition
  /* jshint strict: false */ /*globals define, module, require */
  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( 'isotope-layout/js/item',[
        'outlayer/outlayer'
      ],
      factory );
  } else if ( typeof module == 'object' && module.exports ) {
    // CommonJS
    module.exports = factory(
      require('outlayer')
    );
  } else {
    // browser global
    window.Isotope = window.Isotope || {};
    window.Isotope.Item = factory(
      window.Outlayer
    );
  }

}( window, function factory( Outlayer ) {
'use strict';

// -------------------------- Item -------------------------- //

// sub-class Outlayer Item
function Item() {
  Outlayer.Item.apply( this, arguments );
}

var proto = Item.prototype = Object.create( Outlayer.Item.prototype );

var _create = proto._create;
proto._create = function() {
  // assign id, used for original-order sorting
  this.id = this.layout.itemGUID++;
  _create.call( this );
  this.sortData = {};
};

proto.updateSortData = function() {
  if ( this.isIgnored ) {
    return;
  }
  // default sorters
  this.sortData.id = this.id;
  // for backward compatibility
  this.sortData['original-order'] = this.id;
  this.sortData.random = Math.random();
  // go thru getSortData obj and apply the sorters
  var getSortData = this.layout.options.getSortData;
  var sorters = this.layout._sorters;
  for ( var key in getSortData ) {
    var sorter = sorters[ key ];
    this.sortData[ key ] = sorter( this.element, this );
  }
};

var _destroy = proto.destroy;
proto.destroy = function() {
  // call super
  _destroy.apply( this, arguments );
  // reset display, #741
  this.css({
    display: ''
  });
};

return Item;

}));

/**
 * Isotope LayoutMode
 */

( function( window, factory ) {
  // universal module definition
  /* jshint strict: false */ /*globals define, module, require */
  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( 'isotope-layout/js/layout-mode',[
        'get-size/get-size',
        'outlayer/outlayer'
      ],
      factory );
  } else if ( typeof module == 'object' && module.exports ) {
    // CommonJS
    module.exports = factory(
      require('get-size'),
      require('outlayer')
    );
  } else {
    // browser global
    window.Isotope = window.Isotope || {};
    window.Isotope.LayoutMode = factory(
      window.getSize,
      window.Outlayer
    );
  }

}( window, function factory( getSize, Outlayer ) {
  'use strict';

  // layout mode class
  function LayoutMode( isotope ) {
    this.isotope = isotope;
    // link properties
    if ( isotope ) {
      this.options = isotope.options[ this.namespace ];
      this.element = isotope.element;
      this.items = isotope.filteredItems;
      this.size = isotope.size;
    }
  }

  var proto = LayoutMode.prototype;

  
  var facadeMethods = [
    '_resetLayout',
    '_getItemLayoutPosition',
    '_manageStamp',
    '_getContainerSize',
    '_getElementOffset',
    'needsResizeLayout',
    '_getOption'
  ];

  facadeMethods.forEach( function( methodName ) {
    proto[ methodName ] = function() {
      return Outlayer.prototype[ methodName ].apply( this.isotope, arguments );
    };
  });

  // -----  ----- //

  // for horizontal layout modes, check vertical size
  proto.needsVerticalResizeLayout = function() {
    // don't trigger if size did not change
    var size = getSize( this.isotope.element );
   
    var hasSizes = this.isotope.size && size;
    return hasSizes && size.innerHeight != this.isotope.size.innerHeight;
  };

  // ----- measurements ----- //

  proto._getMeasurement = function() {
    this.isotope._getMeasurement.apply( this, arguments );
  };

  proto.getColumnWidth = function() {
    this.getSegmentSize( 'column', 'Width' );
  };

  proto.getRowHeight = function() {
    this.getSegmentSize( 'row', 'Height' );
  };

  proto.getSegmentSize = function( segment, size ) {
    var segmentName = segment + size;
    var outerSize = 'outer' + size;
    // columnWidth / outerWidth // rowHeight / outerHeight
    this._getMeasurement( segmentName, outerSize );
    // got rowHeight or columnWidth, we can chill
    if ( this[ segmentName ] ) {
      return;
    }
    // fall back to item of first element
    var firstItemSize = this.getFirstItemSize();
    this[ segmentName ] = firstItemSize && firstItemSize[ outerSize ] ||
      // or size of container
      this.isotope.size[ 'inner' + size ];
  };

  proto.getFirstItemSize = function() {
    var firstItem = this.isotope.filteredItems[0];
    return firstItem && firstItem.element && getSize( firstItem.element );
  };

  // ----- methods that should reference isotope ----- //

  proto.layout = function() {
    this.isotope.layout.apply( this.isotope, arguments );
  };

  proto.getSize = function() {
    this.isotope.getSize();
    this.size = this.isotope.size;
  };

  // -------------------------- create -------------------------- //

  LayoutMode.modes = {};

  LayoutMode.create = function( namespace, options ) {

    function Mode() {
      LayoutMode.apply( this, arguments );
    }

    Mode.prototype = Object.create( proto );
    Mode.prototype.constructor = Mode;

    // default options
    if ( options ) {
      Mode.options = options;
    }

    Mode.prototype.namespace = namespace;
    // register in Isotope
    LayoutMode.modes[ namespace ] = Mode;

    return Mode;
  };

  return LayoutMode;

}));



( function( window, factory ) {
  // universal module definition
  /* jshint strict: false */ /*globals define, module, require */
  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( 'masonry-layout/masonry',[
        'outlayer/outlayer',
        'get-size/get-size'
      ],
      factory );
  } else if ( typeof module == 'object' && module.exports ) {
    // CommonJS
    module.exports = factory(
      require('outlayer'),
      require('get-size')
    );
  } else {
    // browser global
    window.Masonry = factory(
      window.Outlayer,
      window.getSize
    );
  }

}( window, function factory( Outlayer, getSize ) {



// -------------------------- masonryDefinition -------------------------- //

  // create an Outlayer layout class
  var Masonry = Outlayer.create('masonry');
  // isFitWidth -> fitWidth
  Masonry.compatOptions.fitWidth = 'isFitWidth';

  var proto = Masonry.prototype;

  proto._resetLayout = function() {
    this.getSize();
    this._getMeasurement( 'columnWidth', 'outerWidth' );
    this._getMeasurement( 'gutter', 'outerWidth' );
    this.measureColumns();

    // reset column Y
    this.colYs = [];
    for ( var i=0; i < this.cols; i++ ) {
      this.colYs.push( 0 );
    }

    this.maxY = 0;
    this.horizontalColIndex = 0;
  };

  proto.measureColumns = function() {
    this.getContainerWidth();
    // if columnWidth is 0, default to outerWidth of first item
    if ( !this.columnWidth ) {
      var firstItem = this.items[0];
      var firstItemElem = firstItem && firstItem.element;
      // columnWidth fall back to item of first element
      this.columnWidth = firstItemElem && getSize( firstItemElem ).outerWidth ||
        // if first elem has no width, default to size of container
        this.containerWidth;
    }

    var columnWidth = this.columnWidth += this.gutter;

    // calculate columns
    var containerWidth = this.containerWidth + this.gutter;
    var cols = containerWidth / columnWidth;
    // fix rounding errors, typically with gutters
    var excess = columnWidth - containerWidth % columnWidth;
    // if overshoot is less than a pixel, round up, otherwise floor it
    var mathMethod = excess && excess < 1 ? 'round' : 'floor';
    cols = Math[ mathMethod ]( cols );
    this.cols = Math.max( cols, 1 );
  };

  proto.getContainerWidth = function() {
    // container is parent if fit width
    var isFitWidth = this._getOption('fitWidth');
    var container = isFitWidth ? this.element.parentNode : this.element;
    // check that this.size and size are there
    // IE8 triggers resize on body size change, so they might not be
    var size = getSize( container );
    this.containerWidth = size && size.innerWidth;
  };

  proto._getItemLayoutPosition = function( item ) {
    item.getSize();
    // how many columns does this brick span
    var remainder = item.size.outerWidth % this.columnWidth;
    var mathMethod = remainder && remainder < 1 ? 'round' : 'ceil';
    // round if off by 1 pixel, otherwise use ceil
    var colSpan = Math[ mathMethod ]( item.size.outerWidth / this.columnWidth );
    colSpan = Math.min( colSpan, this.cols );
    // use horizontal or top column position
    var colPosMethod = this.options.horizontalOrder ?
      '_getHorizontalColPosition' : '_getTopColPosition';
    var colPosition = this[ colPosMethod ]( colSpan, item );
    // position the brick
    var position = {
      x: this.columnWidth * colPosition.col,
      y: colPosition.y
    };
    // apply setHeight to necessary columns
    var setHeight = colPosition.y + item.size.outerHeight;
    var setMax = colSpan + colPosition.col;
    for ( var i = colPosition.col; i < setMax; i++ ) {
      this.colYs[i] = setHeight;
    }

    return position;
  };

  proto._getTopColPosition = function( colSpan ) {
    var colGroup = this._getTopColGroup( colSpan );
    // get the minimum Y value from the columns
    var minimumY = Math.min.apply( Math, colGroup );

    return {
      col: colGroup.indexOf( minimumY ),
      y: minimumY,
    };
  };

  /**
   * @param {Number} colSpan - number of columns the element spans
   * @returns {Array} colGroup
   */
  proto._getTopColGroup = function( colSpan ) {
    if ( colSpan < 2 ) {
      // if brick spans only one column, use all the column Ys
      return this.colYs;
    }

    var colGroup = [];
    // how many different places could this brick fit horizontally
    var groupCount = this.cols + 1 - colSpan;
    // for each group potential horizontal position
    for ( var i = 0; i < groupCount; i++ ) {
      colGroup[i] = this._getColGroupY( i, colSpan );
    }
    return colGroup;
  };

  proto._getColGroupY = function( col, colSpan ) {
    if ( colSpan < 2 ) {
      return this.colYs[ col ];
    }
    // make an array of colY values for that one group
    var groupColYs = this.colYs.slice( col, col + colSpan );
    // and get the max value of the array
    return Math.max.apply( Math, groupColYs );
  };

  // get column position based on horizontal index. #873
  proto._getHorizontalColPosition = function( colSpan, item ) {
    var col = this.horizontalColIndex % this.cols;
    var isOver = colSpan > 1 && col + colSpan > this.cols;
    // shift to next row if item can't fit on current row
    col = isOver ? 0 : col;
    // don't let zero-size items take up space
    var hasSize = item.size.outerWidth && item.size.outerHeight;
    this.horizontalColIndex = hasSize ? col + colSpan : this.horizontalColIndex;

    return {
      col: col,
      y: this._getColGroupY( col, colSpan ),
    };
  };



  proto._getContainerSize = function() {
    this.maxY = Math.max.apply( Math, this.colYs );
    var size = {
      height: this.maxY
    };

    if ( this._getOption('fitWidth') ) {
      size.width = this._getContainerFitWidth();
    }

    return size;
  };

  proto._getContainerFitWidth = function() {
    var unusedCols = 0;
    // count unused columns
    var i = this.cols;
    while ( --i ) {
      if ( this.colYs[i] !== 0 ) {
        break;
      }
      unusedCols++;
    }
    // fit container to columns that have been used
    return ( this.cols - unusedCols ) * this.columnWidth - this.gutter;
  };

  proto.needsResizeLayout = function() {
    var previousWidth = this.containerWidth;
    this.getContainerWidth();
    return previousWidth != this.containerWidth;
  };

  return Masonry;

}));



( function( window, factory ) {
  // universal module definition
  /* jshint strict: false */ /*globals define, module, require */
  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( 'isotope-layout/js/layout-modes/masonry',[
        '../layout-mode',
        'masonry-layout/masonry'
      ],
      factory );
  } else if ( typeof module == 'object' && module.exports ) {
    // CommonJS
    module.exports = factory(
      require('../layout-mode'),
      require('masonry-layout')
    );
  } else {
    // browser global
    factory(
      window.Isotope.LayoutMode,
      window.Masonry
    );
  }

}( window, function factory( LayoutMode, Masonry ) {
'use strict';

// -------------------------- masonryDefinition -------------------------- //

  // create an Outlayer layout class
  var MasonryMode = LayoutMode.create('masonry');

  var proto = MasonryMode.prototype;

  var keepModeMethods = {
    _getElementOffset: true,
    layout: true,
    _getMeasurement: true
  };

  // inherit Masonry prototype
  for ( var method in Masonry.prototype ) {
    // do not inherit mode methods
    if ( !keepModeMethods[ method ] ) {
      proto[ method ] = Masonry.prototype[ method ];
    }
  }

  var measureColumns = proto.measureColumns;
  proto.measureColumns = function() {
    // set items, used if measuring first item
    this.items = this.isotope.filteredItems;
    measureColumns.call( this );
  };

  // point to mode options for fitWidth
  var _getOption = proto._getOption;
  proto._getOption = function( option ) {
    if ( option == 'fitWidth' ) {
      return this.options.isFitWidth !== undefined ?
        this.options.isFitWidth : this.options.fitWidth;
    }
    return _getOption.apply( this.isotope, arguments );
  };

  return MasonryMode;

}));

/**
 * fitRows layout mode
 */

( function( window, factory ) {
  // universal module definition
  /* jshint strict: false */ /*globals define, module, require */
  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( 'isotope-layout/js/layout-modes/fit-rows',[
        '../layout-mode'
      ],
      factory );
  } else if ( typeof exports == 'object' ) {
    // CommonJS
    module.exports = factory(
      require('../layout-mode')
    );
  } else {
    // browser global
    factory(
      window.Isotope.LayoutMode
    );
  }

}( window, function factory( LayoutMode ) {
'use strict';

var FitRows = LayoutMode.create('fitRows');

var proto = FitRows.prototype;

proto._resetLayout = function() {
  this.x = 0;
  this.y = 0;
  this.maxY = 0;
  this._getMeasurement( 'gutter', 'outerWidth' );
};

proto._getItemLayoutPosition = function( item ) {
  item.getSize();

  var itemWidth = item.size.outerWidth + this.gutter;
  // if this element cannot fit in the current row
  var containerWidth = this.isotope.size.innerWidth + this.gutter;
  if ( this.x !== 0 && itemWidth + this.x > containerWidth ) {
    this.x = 0;
    this.y = this.maxY;
  }

  var position = {
    x: this.x,
    y: this.y
  };

  this.maxY = Math.max( this.maxY, this.y + item.size.outerHeight );
  this.x += itemWidth;

  return position;
};

proto._getContainerSize = function() {
  return { height: this.maxY };
};

return FitRows;

}));

/**
 * vertical layout mode
 */

( function( window, factory ) {
  // universal module definition
  /* jshint strict: false */ /*globals define, module, require */
  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( 'isotope-layout/js/layout-modes/vertical',[
        '../layout-mode'
      ],
      factory );
  } else if ( typeof module == 'object' && module.exports ) {
    // CommonJS
    module.exports = factory(
      require('../layout-mode')
    );
  } else {
    // browser global
    factory(
      window.Isotope.LayoutMode
    );
  }

}( window, function factory( LayoutMode ) {
'use strict';

var Vertical = LayoutMode.create( 'vertical', {
  horizontalAlignment: 0
});

var proto = Vertical.prototype;

proto._resetLayout = function() {
  this.y = 0;
};

proto._getItemLayoutPosition = function( item ) {
  item.getSize();
  var x = ( this.isotope.size.innerWidth - item.size.outerWidth ) *
    this.options.horizontalAlignment;
  var y = this.y;
  this.y += item.size.outerHeight;
  return { x: x, y: y };
};

proto._getContainerSize = function() {
  return { height: this.y };
};

return Vertical;

}));


( function( window, factory ) {
  // universal module definition
  /* jshint strict: false */ /*globals define, module, require */
  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( [
        'outlayer/outlayer',
        'get-size/get-size',
        'desandro-matches-selector/matches-selector',
        'fizzy-ui-utils/utils',
        'isotope-layout/js/item',
        'isotope-layout/js/layout-mode',
        // include default layout modes
        'isotope-layout/js/layout-modes/masonry',
        'isotope-layout/js/layout-modes/fit-rows',
        'isotope-layout/js/layout-modes/vertical'
      ],
      function( Outlayer, getSize, matchesSelector, utils, Item, LayoutMode ) {
        return factory( window, Outlayer, getSize, matchesSelector, utils, Item, LayoutMode );
      });
  } else if ( typeof module == 'object' && module.exports ) {
    // CommonJS
    module.exports = factory(
      window,
      require('outlayer'),
      require('get-size'),
      require('desandro-matches-selector'),
      require('fizzy-ui-utils'),
      require('isotope-layout/js/item'),
      require('isotope-layout/js/layout-mode'),
      // include default layout modes
      require('isotope-layout/js/layout-modes/masonry'),
      require('isotope-layout/js/layout-modes/fit-rows'),
      require('isotope-layout/js/layout-modes/vertical')
    );
  } else {
    // browser global
    window.Isotope = factory(
      window,
      window.Outlayer,
      window.getSize,
      window.matchesSelector,
      window.fizzyUIUtils,
      window.Isotope.Item,
      window.Isotope.LayoutMode
    );
  }

}( window, function factory( window, Outlayer, getSize, matchesSelector, utils,
  Item, LayoutMode ) {



// -------------------------- vars -------------------------- //

var jQuery = window.jQuery;

// -------------------------- helpers -------------------------- //

var trim = String.prototype.trim ?
  function( str ) {
    return str.trim();
  } :
  function( str ) {
    return str.replace( /^\s+|\s+$/g, '' );
  };

// -------------------------- isotopeDefinition -------------------------- //

  // create an Outlayer layout class
  var Isotope = Outlayer.create( 'isotope', {
    layoutMode: 'masonry',
    isJQueryFiltering: true,
    sortAscending: true
  });

  Isotope.Item = Item;
  Isotope.LayoutMode = LayoutMode;

  var proto = Isotope.prototype;

  proto._create = function() {
    this.itemGUID = 0;
    // functions that sort items
    this._sorters = {};
    this._getSorters();
    // call super
    Outlayer.prototype._create.call( this );

    // create layout modes
    this.modes = {};
    // start filteredItems with all items
    this.filteredItems = this.items;
    // keep of track of sortBys
    this.sortHistory = [ 'original-order' ];
    // create from registered layout modes
    for ( var name in LayoutMode.modes ) {
      this._initLayoutMode( name );
    }
  };

  proto.reloadItems = function() {
    // reset item ID counter
    this.itemGUID = 0;
    // call super
    Outlayer.prototype.reloadItems.call( this );
  };

  proto._itemize = function() {
    var items = Outlayer.prototype._itemize.apply( this, arguments );
    // assign ID for original-order
    for ( var i=0; i < items.length; i++ ) {
      var item = items[i];
      item.id = this.itemGUID++;
    }
    this._updateItemsSortData( items );
    return items;
  };


  // -------------------------- layout -------------------------- //

  proto._initLayoutMode = function( name ) {
    var Mode = LayoutMode.modes[ name ];
    // set mode options
    // HACK extend initial options, back-fill in default options
    var initialOpts = this.options[ name ] || {};
    this.options[ name ] = Mode.options ?
      utils.extend( Mode.options, initialOpts ) : initialOpts;
    // init layout mode instance
    this.modes[ name ] = new Mode( this );
  };


  proto.layout = function() {
    // if first time doing layout, do all magic
    if ( !this._isLayoutInited && this._getOption('initLayout') ) {
      this.arrange();
      return;
    }
    this._layout();
  };

  // private method to be used in layout() & magic()
  proto._layout = function() {
    // don't animate first layout
    var isInstant = this._getIsInstant();
    // layout flow
    this._resetLayout();
    this._manageStamps();
    this.layoutItems( this.filteredItems, isInstant );

    // flag for initalized
    this._isLayoutInited = true;
  };

  // filter + sort + layout
  proto.arrange = function( opts ) {
    // set any options pass
    this.option( opts );
    this._getIsInstant();
    // filter, sort, and layout

    // filter
    var filtered = this._filter( this.items );
    this.filteredItems = filtered.matches;

    this._bindArrangeComplete();

    if ( this._isInstant ) {
      this._noTransition( this._hideReveal, [ filtered ] );
    } else {
      this._hideReveal( filtered );
    }

    this._sort();
    this._layout();
  };
 
  proto._init = proto.arrange;

  proto._hideReveal = function( filtered ) {
    this.reveal( filtered.needReveal );
    this.hide( filtered.needHide );
  };

  proto._getIsInstant = function() {
    var isLayoutInstant = this._getOption('layoutInstant');
    var isInstant = isLayoutInstant !== undefined ? isLayoutInstant :
      !this._isLayoutInited;
    this._isInstant = isInstant;
    return isInstant;
  };


  // -------------------------- filter -------------------------- //

  proto._filter = function( items ) {
    var filter = this.options.filter;
    filter = filter || '*';
    var matches = [];
    var hiddenMatched = [];
    var visibleUnmatched = [];

    var test = this._getFilterTest( filter );

    // test each item
    for ( var i=0; i < items.length; i++ ) {
      var item = items[i];
      if ( item.isIgnored ) {
        continue;
      }
      // add item to either matched or unmatched group
      var isMatched = test( item );
      // item.isFilterMatched = isMatched;
      // add to matches if its a match
      if ( isMatched ) {
        matches.push( item );
      }
      // add to additional group if item needs to be hidden or revealed
      if ( isMatched && item.isHidden ) {
        hiddenMatched.push( item );
      } else if ( !isMatched && !item.isHidden ) {
        visibleUnmatched.push( item );
      }
    }

    // return collections of items to be manipulated
    return {
      matches: matches,
      needReveal: hiddenMatched,
      needHide: visibleUnmatched
    };
  };

  // get a jQuery, function, or a matchesSelector test given the filter
  proto._getFilterTest = function( filter ) {
    if ( jQuery && this.options.isJQueryFiltering ) {
      // use jQuery
      return function( item ) {
        return jQuery( item.element ).is( filter );
      };
    }
    if ( typeof filter == 'function' ) {
      // use filter as function
      return function( item ) {
        return filter( item.element );
      };
    }
    // default, use filter as selector string
    return function( item ) {
      return matchesSelector( item.element, filter );
    };
  };

  // -------------------------- sorting -------------------------- //

  /**
   * @params {Array} elems
   * @public
   */
  proto.updateSortData = function( elems ) {
    // get items
    var items;
    if ( elems ) {
      elems = utils.makeArray( elems );
      items = this.getItems( elems );
    } else {
      // update all items if no elems provided
      items = this.items;
    }

    this._getSorters();
    this._updateItemsSortData( items );
  };

  proto._getSorters = function() {
    var getSortData = this.options.getSortData;
    for ( var key in getSortData ) {
      var sorter = getSortData[ key ];
      this._sorters[ key ] = mungeSorter( sorter );
    }
  };

  /**
   * @params {Array} items - of Isotope.Items
   * @private
   */
  proto._updateItemsSortData = function( items ) {
    // do not update if no items
    var len = items && items.length;

    for ( var i=0; len && i < len; i++ ) {
      var item = items[i];
      item.updateSortData();
    }
  };

 
  var mungeSorter = ( function() {
    
    function mungeSorter( sorter ) {
      // if not a string, return function or whatever it is
      if ( typeof sorter != 'string' ) {
        return sorter;
      }
      // parse the sorter string
      var args = trim( sorter ).split(' ');
      var query = args[0];
      // check if query looks like [an-attribute]
      var attrMatch = query.match( /^\[(.+)\]$/ );
      var attr = attrMatch && attrMatch[1];
      var getValue = getValueGetter( attr, query );
      // use second argument as a parser
      var parser = Isotope.sortDataParsers[ args[1] ];
      // parse the value, if there was a parser
      sorter = parser ? function( elem ) {
        return elem && parser( getValue( elem ) );
      } :
      // otherwise just return value
      function( elem ) {
        return elem && getValue( elem );
      };

      return sorter;
    }

    // get an attribute getter, or get text of the querySelector
    function getValueGetter( attr, query ) {
      // if query looks like [foo-bar], get attribute
      if ( attr ) {
        return function getAttribute( elem ) {
          return elem.getAttribute( attr );
        };
      }

      // otherwise, assume its a querySelector, and get its text
      return function getChildText( elem ) {
        var child = elem.querySelector( query );
        return child && child.textContent;
      };
    }

    return mungeSorter;
  })();

  // parsers used in getSortData shortcut strings
  Isotope.sortDataParsers = {
    'parseInt': function( val ) {
      return parseInt( val, 10 );
    },
    'parseFloat': function( val ) {
      return parseFloat( val );
    }
  };

  // ----- sort method ----- //

  // sort filteredItem order
  proto._sort = function() {
    if ( !this.options.sortBy ) {
      return;
    }
    // keep track of sortBy History
    var sortBys = utils.makeArray( this.options.sortBy );
    if ( !this._getIsSameSortBy( sortBys ) ) {
      // concat all sortBy and sortHistory, add to front, oldest goes in last
      this.sortHistory = sortBys.concat( this.sortHistory );
    }
    // sort magic
    var itemSorter = getItemSorter( this.sortHistory, this.options.sortAscending );
    this.filteredItems.sort( itemSorter );
  };

  // check if sortBys is same as start of sortHistory
  proto._getIsSameSortBy = function( sortBys ) {
    for ( var i=0; i < sortBys.length; i++ ) {
      if ( sortBys[i] != this.sortHistory[i] ) {
        return false;
      }
    }
    return true;
  };

  // -------------------------- methods -------------------------- //

  // get layout mode
  proto._mode = function() {
    var layoutMode = this.options.layoutMode;
    var mode = this.modes[ layoutMode ];
    if ( !mode ) {
      // TODO console.error
      throw new Error( 'No layout mode: ' + layoutMode );
    }
    // HACK sync mode's options
    // any options set after init for layout mode need to be synced
    mode.options = this.options[ layoutMode ];
    return mode;
  };

  proto._resetLayout = function() {
    // trigger original reset layout
    Outlayer.prototype._resetLayout.call( this );
    this._mode()._resetLayout();
  };

  proto._getItemLayoutPosition = function( item  ) {
    return this._mode()._getItemLayoutPosition( item );
  };

  proto._manageStamp = function( stamp ) {
    this._mode()._manageStamp( stamp );
  };

  proto._getContainerSize = function() {
    return this._mode()._getContainerSize();
  };

  proto.needsResizeLayout = function() {
    return this._mode().needsResizeLayout();
  };

  // -------------------------- adding & removing -------------------------- //

  // HEADS UP overwrites default Outlayer appended
  proto.appended = function( elems ) {
    var items = this.addItems( elems );
    if ( !items.length ) {
      return;
    }
    // filter, layout, reveal new items
    var filteredItems = this._filterRevealAdded( items );
    // add to filteredItems
    this.filteredItems = this.filteredItems.concat( filteredItems );
  };

  // HEADS UP overwrites default Outlayer prepended
  proto.prepended = function( elems ) {
    var items = this._itemize( elems );
    if ( !items.length ) {
      return;
    }
    // start new layout
    this._resetLayout();
    this._manageStamps();
    // filter, layout, reveal new items
    var filteredItems = this._filterRevealAdded( items );
    // layout previous items
    this.layoutItems( this.filteredItems );
    // add to items and filteredItems
    this.filteredItems = filteredItems.concat( this.filteredItems );
    this.items = items.concat( this.items );
  };

  proto._filterRevealAdded = function( items ) {
    var filtered = this._filter( items );
    this.hide( filtered.needHide );
    // reveal all new items
    this.reveal( filtered.matches );
    // layout new items, no transition
    this.layoutItems( filtered.matches, true );
    return filtered.matches;
  };

  /**
   * Filter, sort, and layout newly-appended item elements
   * @param {Array or NodeList or Element} elems
   */
  proto.insert = function( elems ) {
    var items = this.addItems( elems );
    if ( !items.length ) {
      return;
    }
    // append item elements
    var i, item;
    var len = items.length;
    for ( i=0; i < len; i++ ) {
      item = items[i];
      this.element.appendChild( item.element );
    }
    // filter new stuff
    var filteredInsertItems = this._filter( items ).matches;
    // set flag
    for ( i=0; i < len; i++ ) {
      items[i].isLayoutInstant = true;
    }
    this.arrange();
    // reset flag
    for ( i=0; i < len; i++ ) {
      delete items[i].isLayoutInstant;
    }
    this.reveal( filteredInsertItems );
  };

  var _remove = proto.remove;
  proto.remove = function( elems ) {
    elems = utils.makeArray( elems );
    var removeItems = this.getItems( elems );
    // do regular thing
    _remove.call( this, elems );
    // bail if no items to remove
    var len = removeItems && removeItems.length;
    // remove elems from filteredItems
    for ( var i=0; len && i < len; i++ ) {
      var item = removeItems[i];
      // remove item from collection
      utils.removeFrom( this.filteredItems, item );
    }
  };

  proto.shuffle = function() {
    // update random sortData
    for ( var i=0; i < this.items.length; i++ ) {
      var item = this.items[i];
      item.sortData.random = Math.random();
    }
    this.options.sortBy = 'random';
    this._sort();
    this._layout();
  };

  /**
   * trigger fn without transition
   * kind of hacky to have this in the first place
   * @param {Function} fn
   * @param {Array} args
   * @returns ret
   * @private
   */
  proto._noTransition = function( fn, args ) {
    // save transitionDuration before disabling
    var transitionDuration = this.options.transitionDuration;
    // disable transition
    this.options.transitionDuration = 0;
    // do it
    var returnValue = fn.apply( this, args );
    // re-enable transition for reveal
    this.options.transitionDuration = transitionDuration;
    return returnValue;
  };

  // ----- helper methods ----- //

  /**
   * getter method for getting filtered item elements
   * @returns {Array} elems - collection of item elements
   */
  proto.getFilteredItemElements = function() {
    return this.filteredItems.map( function( item ) {
      return item.element;
    });
  };

  // -----  ----- //

  return Isotope;

}));

document.addEventListener("DOMContentLoaded", function () {
  const checkAll = document.getElementById("checkAll");
  const checkboxes = document.querySelectorAll(".cart-checkbox");
  const totalPriceElement = document.getElementById("totalPrice");
  
  // Chức năng chọn tất cả
  checkAll.addEventListener("change", function () {
    // Lọc ra tất cả các checkbox không thuộc sản phẩm đã xóa
    const checkboxesToCheck = Array.from(checkboxes).filter((checkbox) => {
      const cartItemRow = checkbox.closest("tr");
      // Kiểm tra nếu dòng sản phẩm không bị xóa
      return !cartItemRow.classList.contains("deleted");
    });

    // Đánh dấu tất cả các checkbox còn lại là checked
    checkboxesToCheck.forEach((checkbox) => {
      checkbox.checked = checkAll.checked;
    });

    // Cập nhật tổng tiền sau khi thay đổi trạng thái checkbox
    updateTotalPrice2();
  });

  // Cập nhật tổng tiền khi thay đổi trạng thái checkbox
  checkboxes.forEach((checkbox) => {
    checkbox.addEventListener("change", updateTotalPrice2);
  });

  // Cập nhật số lượng
  window.changeQuantity = function (button, change) {
    const quantityInput = button.parentElement.querySelector(".quantity-input");
    const maxStock = parseInt(
      button.closest("tr").querySelector(".max-stock").value
    ); // Lấy số lượng tồn kho
    let currentQuantity = parseInt(quantityInput.value);

    // Kiểm tra nếu số lượng hiện tại + thay đổi không vượt quá số lượng tồn kho
    currentQuantity = Math.max(1, Math.min(currentQuantity + change, maxStock)); // Giới hạn số lượng giữa 1 và tồn kho
    quantityInput.value = currentQuantity;

    // Vô hiệu hóa nút "-" khi số lượng bằng 1
    const decreaseButton =
      button.parentElement.querySelector(".decrease-quantity");
    if (currentQuantity === 1) {
      decreaseButton.disabled = true;
    } else {
      decreaseButton.disabled = false;
    }

    // Vô hiệu hóa nút "+" khi đạt tồn kho
    const increaseButton =
      button.parentElement.querySelector(".increase-quantity");
    if (currentQuantity >= maxStock) {
      increaseButton.disabled = true;
    } else {
      increaseButton.disabled = false;
    }

    let itemId;
    const cartItemInput = button
      .closest("tr")
      .querySelector('input[name="cart_item_id"]');
    const variantInput = button
      .closest("tr")
      .querySelector('input[name="product_variant_id"]');

    if (cartItemInput) {
      itemId = cartItemInput.value;
    } else if (variantInput) {
      itemId = variantInput.value;
    } else {
      alert("Không tìm thấy thông tin sản phẩm");
      return;
    }

    updateCart(
      itemId,
      currentQuantity,
      cartItemInput ? "cart_item_id" : "product_variant_id"
    );
  };

  document.querySelectorAll(".quantity-input").forEach((input) => {
    // Lưu trữ số lượng hiện tại trước khi thay đổi
    let previousQuantity = parseInt(input.value);

    // Kiểm tra khi người dùng rời khỏi ô input (blur)
    input.addEventListener("blur", function () {
      const maxStock = parseInt(
        this.closest("tr").querySelector(".max-stock").value
      ); // Lấy số lượng tồn kho
      let currentQuantity = parseInt(this.value);

      // Nếu ô trống, không làm gì, đợi người dùng nhập xong
      if (!this.value) {
        return;
      }

      // Kiểm tra nếu người dùng nhập số hợp lệ
      if (isNaN(currentQuantity) || currentQuantity < 1) {
        this.value = previousQuantity;
        return;
      }

      // Nếu số lượng vượt quá tồn kho, hiển thị popup và đặt lại giá trị trước đó
      if (currentQuantity > maxStock) {
        showPopup(`Mặt hàng này chỉ còn ${maxStock} số lượng.`);
        this.value = previousQuantity; // Đặt lại về giá trị trước đó
        return;
      }

      // Cập nhật số lượng hợp lệ và lưu lại số lượng mới
      previousQuantity = currentQuantity;

      // Cập nhật nút tăng/giảm số lượng
      const increaseButton =
        this.parentElement.querySelector(".increase-quantity");
      const decreaseButton =
        this.parentElement.querySelector(".decrease-quantity");

      if (currentQuantity >= maxStock) {
        increaseButton.disabled = true;
      } else {
        increaseButton.disabled = false;
      }

      if (currentQuantity <= 1) {
        decreaseButton.disabled = true;
      } else {
        decreaseButton.disabled = false;
      }

      // Lấy thông tin sản phẩm để cập nhật giỏ hàng
      let itemId;
      const cartItemInput = this.closest("tr").querySelector(
        'input[name="cart_item_id"]'
      );
      const variantInput = this.closest("tr").querySelector(
        'input[name="product_variant_id"]'
      );

      if (cartItemInput) {
        itemId = cartItemInput.value;
      } else if (variantInput) {
        itemId = variantInput.value;
      } else {
        console.error("Không tìm thấy thông tin sản phẩm");
        return;
      }

      // Gửi request cập nhật giỏ hàng ngay sau khi người dùng nhập số hợp lệ
      updateCart(
        itemId,
        currentQuantity,
        cartItemInput ? "cart_item_id" : "product_variant_id"
      );
    });

    // Cho phép xóa số khi đang nhập, không ép buộc hiện số ngay lập tức
    input.addEventListener("input", function () {
      if (!this.value || this.value < 1) {
        this.value = ""; // Xóa giá trị khi đang chỉnh sửa
      }
    });
  });

  // Hàm hiển thị popup
  function showPopup(message) {
    const modal = document.getElementById("quantityPopup");
    const messageElement = document.getElementById("popupMessage");
    messageElement.textContent = message;
    modal.style.display = "block";
  }

  // Đóng popup khi nhấn nút close (X)
  document.querySelector(".close").addEventListener("click", function () {
    document.getElementById("quantityPopup").style.display = "none";
  });

  // Đóng popup khi nhấn bên ngoài modal
  window.addEventListener("click", function (event) {
    const modal = document.getElementById("quantityPopup");
    if (event.target == modal) {
      modal.style.display = "none";
    }
  });

  // Hàm gửi AJAX request để cập nhật giỏ hàng
  function updateCart(itemId, quantity, itemType) {
    // console.log(`${itemType}:`, itemId);
    // console.log("quantity:", quantity);

    let data = {};
    data[itemType] = itemId;
    data["quantity"] = quantity;

    fetch(updateUrl, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": csrfToken,
      },
      body: JSON.stringify(data),
    })
      .then((response) => {
        // console.log("Response status:", response.status);
        if (!response.ok) {
          throw new Error(
            "Cập nhật giỏ hàng thất bại với mã lỗi " + response.status
          );
        }
        return response.json();
      })
      .then((data) => {
        if (data.success) {
          // console.log("Giỏ hàng đã được cập nhật");
          updateTotalPrice2(); // Cập nhật tổng giá trị giỏ hàng
        } else {
          // console.error("Cập nhật giỏ hàng thất bại:", data.message);
        }
      })
      .catch((error) => {
        console.error("Lỗi:", error);
      });
  }

  function updateTotalPrice2() {
    const checkboxes = document.querySelectorAll(".cart-checkbox");
    let totalPrice = 0;

    checkboxes.forEach((checkbox) => {
      // Chỉ tính vào tổng giá nếu checkbox được chọn
      if (checkbox.checked) {
        const price = parseFloat(checkbox.getAttribute("data-price")) || 0;
        const quantity =
          parseInt(
            checkbox.closest("tr").querySelector(".quantity-input").value
          ) || 1;
        totalPrice += price * quantity;
      }
    });

    // Hiển thị tổng tiền đã định dạng
    document.getElementById("totalPrice").textContent =
      numberFormat(totalPrice * 1000, 0, ".", ",") + " ₫";
  }
  // XOA
  const removeButtons = document.querySelectorAll(".cart-remove");

  // Lưu trạng thái checkbox đã chọn
  let checkedItems = [];

  // Lưu lại trạng thái của các checkbox đã chọn
  function saveCheckedItems() {
    checkedItems = [];
    document.querySelectorAll(".cart-checkbox:checked").forEach((checkbox) => {
      checkedItems.push(checkbox.value); // Lưu giá trị của checkbox (ID sản phẩm, cart_item_id hoặc product_variant_id)
    });
  }

  // Khôi phục trạng thái checkbox đã chọn
  function restoreCheckedItems() {
    document.querySelectorAll(".cart-checkbox").forEach((checkbox) => {
      if (checkedItems.includes(checkbox.value)) {
        checkbox.checked = true;
      }
    });
  }

  removeButtons.forEach((button) => {
    button.addEventListener("click", function (event) {
      event.preventDefault(); // Ngừng hành động mặc định

      // Lưu lại trạng thái checkbox đã chọn trước khi xóa
      saveCheckedItems();

      const cartItemId = this.getAttribute("data-cart-item-id");
      const productVariantId = this.getAttribute("data-product-variant-id");

      // Gửi yêu cầu AJAX để xóa sản phẩm
      const data = cartItemId
        ? { cart_item_id: cartItemId }
        : { product_variant_id: productVariantId };
        const tooltipInstance = bootstrap.Tooltip.getInstance(this); // Lấy tooltip đã được gắn
        if (tooltipInstance) {
          tooltipInstance.dispose(); // Hủy tooltip
        }
      fetch(removeUrl, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": csrfToken,
        },
        body: JSON.stringify(data),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            // Xóa sản phẩm khỏi giao diện
            const cartItemRow = this.closest("tr");
            if (cartItemRow) {
              cartItemRow.remove();
            }

            // Khôi phục trạng thái checkbox đã chọn
            restoreCheckedItems();

            // Cập nhật lại tổng tiền
            updateTotalPrice2(); // Cập nhật tổng tiền
            updateCartCount();
            // setTimeout(() => {
            //   checkEmptyCart();  // Kiểm tra giỏ hàng trống sau khi cập nhật DOM
            // }, 50); 
          } else {
            alert("Lỗi: " + data.message);
          }
        })
        .catch((error) => {
          console.error("Lỗi:", error);
          alert("Không thể kết nối đến server!");
        });
        function updateCartCount() {
          $.ajax({
              url: '/cart/count', // Thay đổi đường dẫn này
              type: 'GET',
              success: function(data) {
                  $('.cart-count').text(data.count); // Cập nhật số lượng vào phần tử .cart-count
              },
              error: function(xhr) {
                  console.error('Error:', xhr);
              }
          });
      }
    });
  });
  // check gio hang trong
  function checkEmptyCart() {
    const cartItems = document.querySelectorAll(".cart-item"); // Lấy tất cả các phần tử sản phẩm trong giỏ
    const emptyCartMessage = document.querySelector(".cart-empty");
  
    if (cartItems.length === 0) {
      emptyCartMessage.style.display = "block"; // Hiển thị thông báo giỏ hàng trống
    } else {
      emptyCartMessage.style.display = "none"; // Ẩn thông báo giỏ hàng trống
    }
  }
});

function numberFormat(number, decimals, dec_point, thousands_sep) {
  // Chuyển đổi số thành chuỗi với số thập phân
  number = parseFloat(number).toFixed(decimals);

  // Phân tách phần nguyên và phần thập phân
  let parts = number.split(".");
  parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_sep); // Thêm dấu phân cách hàng nghìn

  // Kết hợp lại
  return parts.join(dec_point);
}
