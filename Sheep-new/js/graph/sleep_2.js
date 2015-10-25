function AddNamespace5() {
	var svg = jQuery('#chart_div svg');
	svg.attr("xmlns", "http://www.w3.org/2000/svg");
	svg.css('overflow', 'visible');
}
function AddNamespace6() {
	var svg = jQuery('#chart2_div svg');
	svg.attr("xmlns", "http://www.w3.org/2000/svg");
	svg.css('overflow', 'visible');
}
var days;


$.ajax({
	type: 'POST',
	url: 'sleepmeasures.php',
	async: false,
	data: {test: '1'},
	dataType: 'text',
	success: function(response){
		days = JSON.parse(response);
	}
});  


google.load("visualization", "1", {packages:["gauge"]});
google.setOnLoadCallback(drawChart);
var data = getData(days[0]);
var value = getFinalSleepScore(getSleepScore("morning",2,data),0);
var value2 = getFinalSleepScore(0,getSleepScore("evening",2,data));
value = Math.round(value);
value2 = Math.round(value2);
function drawChart() {
        var data1 = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['AM', value],
          ]);

        var options1 = {
          min:0, max:100,
          width: 800, height: 280,
          redFrom: 0, redTo: 20,
          yellowFrom: 20, yellowTo: 40,
          greenFrom: 40, greenTo: 100,
          minorTicks: 5
        };

        var chart1 = new google.visualization.Gauge(document.getElementById('chart2_div'));
  google.visualization.events.addListener(chart1, 'ready', AddNamespace6);

        chart1.draw(data1, options1);
        
        var data2 = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['PM', value2],
          ]);

        var options2 = {
          min:0, max:100,
          width: 800, height: 280,
          redFrom: 0, redTo: 20,
          yellowFrom: 20, yellowTo: 40,
          greenFrom: 40, greenTo: 100,
          minorTicks: 5
        };

        var chart2 = new google.visualization.Gauge(document.getElementById('chart_div'));
  google.visualization.events.addListener(chart2, 'ready', AddNamespace5);

        chart2.draw(data2, options2);
      }
      var temp = getDuration("morning",2,data);
      $("#deepDuration1").append(temp.toFixed(2));
      temp = getAverageDuration("morning",2,data);
      $("#avgDeep1").append(temp.toFixed(2));
      temp = getInstance("morning",2,data);
      $("#deepInstance1").append(temp);
      temp = getDuration("morning",1,data);
      $("#lightDuration1").append(temp.toFixed(2));
      temp = getAverageDuration("morning",1,data);
      $("#avgLight1").append(temp.toFixed(2));
      temp = getInstance("morning",1,data);
      $("#lightInstance1").append(temp.toFixed(0));
      temp = getDuration("morning",0,data);
      $("#wakeDuration1").append(temp.toFixed(2));
      temp = getAverageDuration("morning",0,data);
      $("#avgWake1").append(temp.toFixed(2));
      temp = getInstance("morning",0,data);
      $("#wakeInstance1").append(temp.toFixed(0));
      $("#pmsummary").append(getDrillDownAmMessage(value, getDuration("evening",2,data)));

      temp = getDuration("evening",2,data);
      $("#deepDuration").append(temp.toFixed(2));
      temp = getAverageDuration("evening",2,data);
      $("#avgDeep").append(temp.toFixed(2));
      temp = getInstance("evening",2,data);
      $("#deepInstance").append(temp);
      temp = getDuration("evening",1,data);
      $("#lightDuration").append(temp.toFixed(2));
      temp = getAverageDuration("evening",1,data);
      $("#avgLight").append(temp.toFixed(2));
      temp = getInstance("evening",1,data);
      $("#lightInstance").append(temp.toFixed(0));
      temp = getDuration("evening",0,data);
      $("#wakeDuration").append(temp.toFixed(2));
      temp = getAverageDuration("evening",0,data);
      $("#avgWake").append(temp.toFixed(2));
      temp = getInstance("evening",0,data);
      $("#wakeInstance").append(temp.toFixed(0));
      $("#amsummary").append(getDrillDownPmMessage(value2));