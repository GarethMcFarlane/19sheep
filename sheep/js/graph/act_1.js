var act_days;


$.ajax({
  type: 'POST',
  url: 'activitymeasures.php',
  async: false,
  data: {test: '1'},
  dataType: 'text',
  success: function(response){
    act_days = JSON.parse(response);
  }
});  



google.load("visualization", "1", {packages:["gauge"]});
google.setOnLoadCallback(drawChart);
var act_data = getActivityData(act_days);
var index = act_data.length - 1;
var act_value = totalActivityScore(act_data[index]);

function drawChart() {
  var act_data = google.visualization.arrayToDataTable([
    ['Label', 'Value'],
    [' ', act_value],
    ]);

  var act_options = {
    min:0, max:600,
    width: 800, height: 240,
    redFrom: 0, redTo: 200,
    yellowFrom:200, yellowTo: 400,
    greenFrom:400, greenTo:600,
    minorTicks: 5
  };

  var act_chart = new google.visualization.Gauge(document.getElementById('chart_2'));
  act_chart.draw(act_data, act_options);
  $("p.summary").append(getActivityGaugeMessage(value,81));   
}