import './app';
import 'admin-lte/plugins/chart.js/Chart.js';
import $ from "jquery";

$(function () {
    $.ajax({
        url: "/estimates/getv1",
        type: 'post',
        success: function (response) {
            let podgrupy = [];
            let kwoty = [];

            $.each(response.data, function (index, value) {
                podgrupy.push(value.podgrupa);
                kwoty.push(value.kwota);
            });

            var donutChartCanvas = $('#pieChart').get(0).getContext('2d')
            var donutData = {
                labels: podgrupy,
                datasets: [
                    {
                        label: 'Amount',
                        data: kwoty,
                        backgroundColor: ['#f56954', '#d2d6de', '#00a65a', '#f39c12', '#d2d6de', '#00c0ef', '#3c8dbc', '#d2d6de', '#00a65a'],
                    }
                ],

            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    position: 'right'
                }
            }

            new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })
        }
    });

    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var areaChartData = {
      labels  : ['Grunty', 'Nieruchomości inwestycyjne', 'Budynki, lokale i obiekty', 'Pozostałe środki trwałe', 'Środki trwałe w budowie', 'Nal. długoterminowe', 'Wartości niematerialne', 'Dł. aktywa finansowe'],
      datasets: [
        {
          label               : 'Rok poprzedni',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27, -90, 120]
        },
        {
          label               : 'Rok aktualny',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [65, 59, 80, 81, 56, 55, 40, 20]
        },
      ]
    }

    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

});
