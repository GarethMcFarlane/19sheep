google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);
      
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Night'],
          ['Awake', 2],
          ['Light Sleep', 4],
          ['Deep Sleep', 3],
          ['Dreaming', 1],
          ['Restless', 1]
        ]);

        var options = {
          title: 'Sleep Analysis',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }