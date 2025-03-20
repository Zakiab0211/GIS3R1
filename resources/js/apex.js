import ApexCharts from 'apexcharts';

document.addEventListener("DOMContentLoaded", function() {
    var options = {
        series: [{
            name: 'Sales',
            data: [10, 20, 30, 40]
        }],
        chart: {
            type: 'line',
            height: 350
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr']
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
});
