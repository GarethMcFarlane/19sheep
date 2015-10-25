function AddNamespace4() {
	var svg = jQuery('#chart_1 svg');
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
var sleep_data = getData(days[0]);
var sleep_value = getFinalSleepScore(getSleepScore("morning",2,sleep_data),getSleepScore("evening",2,sleep_data));
sleep_value = Math.round(sleep_value);
function drawChart() {
  var sleep_data = google.visualization.arrayToDataTable([
    ['Label', 'Value'],
    [' ', sleep_value],
    ]);

  var sleep_options = {
    min:0, max:100,
    width: 800, height: 280,
    redFrom: 0, redTo: 20,
    yellowFrom: 20, yellowTo: 40,
    greenFrom: 40, greenTo: 100,
    minorTicks: 5
  };

  var sleep_chart = new google.visualization.Gauge(document.getElementById('chart_1'));
  google.visualization.events.addListener(sleep_chart, 'ready', AddNamespace4);

  sleep_chart.draw(sleep_data, sleep_options);
  $("#sleepsummary").append(getSleepGaugeMessage(sleep_value));
}