      google.load('visualization', '1.1', {packages: ['gauge']});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Sleep Score', 80],
          ['Emotions Score', 60],
          ['Activity Score', 70]
        ]);

        var options = {
          width: 800, height: 300,
          redFrom: 0, redTo: 35,
          yellowFrom:35, yellowTo: 60,
          greenFrom:60, greenTo: 100,
          minorTicks: 5
        };

        var chart = new google.visualization.Gauge(document.getElementById('gauge_div'));

        chart.draw(data, options);

        
      }