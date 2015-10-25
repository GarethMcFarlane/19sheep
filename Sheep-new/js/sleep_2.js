
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

function drawChart() {
	var morning_data = google.visualization.arrayToDataTable([
		['Label', 'Value'],
		[' ', morning_value],
		]);

	var morning_options = {
		min:0, max:100,
		width: 800, height: 240,
		redFrom: 0, redTo: 20,
		yellowFrom: 20, yellowTo: 40,
		greenFrom: 40, greenTo: 100,
		minorTicks: 5
	};

	var morning_chart = new google.visualization.Gauge(document.getElementById('morning_drill'));

	morning_chart.draw(morning_data, morning_options);
}
var temp = getDuration("morning",2,morning_data);
$("#deepDuration").append(temp.toFixed(2));
temp = getAverageDuration("morning",2,morning_data);
$("#avgDeep").append(temp.toFixed(2));
temp = getInstance("morning",2,morning_data);
$("#deepInstance").append(temp);
temp = getDuration("morning",1,morning_data);
$("#lightDuration").append(temp.toFixed(2));
temp = getAverageDuration("morning",1,morning_data);
$("#avgLight").append(temp.toFixed(2));
temp = getInstance("morning",1,morning_data);
$("#lightInstance").append(temp.toFixed(0));
temp = getDuration("morning",0,morning_data);
$("#wakeDuration").append(temp.toFixed(2));
temp = getAverageDuration("morning",0,morning_data);
$("#avgWake").append(temp.toFixed(2));
temp = getInstance("morning",0,morning_data);
$("#wakeInstance").append(temp.toFixed(0));
$("#morningSummary").append(getDrillDownAmMessage(value));