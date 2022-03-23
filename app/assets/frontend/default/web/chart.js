import $ from "jquery";
import 'admin-lte/plugins/chart.js/Chart.js';

let id =  $("#formularz").val();
$.ajax({
    url: "/estimates/getv2",
    type: 'post',
    data: {
        formularz: id
    },
    success: function (response) {
        let podgrupy = [];
        let kwoty = [];
        let suma = 0;
        var donutData = null;
        var donutOptions = null;

        $.each(response.data, function (index, value) {
            podgrupy.push(value.podgrupa);
            kwoty.push(value.kwota);
            suma += parseFloat(value.kwota);
        });

        var donutChartCanvas = $('#pieChart').get(0).getContext('2d')
        // http://jsfiddle.net/MasterXen/6S9DB/3/

        if(suma > 0) {
            donutData = {
                labels: podgrupy,
                datasets: [
                    {
                        label: 'Amount',
                        data: kwoty,
                        backgroundColor: ['#f56954', '#d2d6de', '#00a65a', '#f39c12', '#d2d6de', '#00c0ef', '#3c8dbc', '#d2d6de', '#00a65a'],
                    }
                ],

            }
        }
        else {
            donutData = {
                labels: ["Brak danych"],
                datasets: [
                    {
                        label: 'Amount',
                        data: [1],
                        backgroundColor: '#d2d6de',
                    }
                ],

            }
        }
        if(suma > 0) {
            donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
                beginAtZero: true,
                legend: {
                    position: 'right'
                },
                // legend: {
                //     display: false
                // },
                // tooltips: {
                //     callbacks: {
                //         label: function (tooltipItem) {
                //             return tooltipItem.yLabel;
                //         }
                //     }
                // }
            }
        }
        else {
            donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
                beginAtZero: true,
                legend: {
                    position: 'right'
                },
                tooltips: {
                    callbacks: {
                        label: function (tooltipItem) {
                            return tooltipItem.yLabel;
                        }
                    }
                }
            }
        }


        new Chart(donutChartCanvas, {
            type: 'pie',
            data: donutData,
            options: donutOptions
        })
    }
});



