
google.load('visualization', '1', {packages: ['corechart', 'bar']});
google.setOnLoadCallback(drawChart);



      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Corporate', 'Sales & Marketing', 'Warehouse'],
          ['2014', 6.7, 8.2, 7.3],
          ['2015', 6.8, 8.0, 7.6],
          ['2016', 6.2, 7.5, 7.3],
          ['2017', 6.1, 8.2, 8.3]
        ]);

        var options = {
          chart: {
            title: 'Corporate Health Overview',
            subtitle: 'Departmental Sleep Hours: 2014-2017',
          },
          bars: 'horizontal', // Required for Material Bar Charts.
          hAxis: {format: 'decimal'},
          height: 400,
          colors: ['#1b9000', '#d95f02', '#7570b3']
        };

       var chart = new google.charts.Bar(document.getElementById('chart_div'));

        chart.draw(data, google.charts.Bar.convertOptions(options));

      }
