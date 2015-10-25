function AddNamespace7() {
	var svg = jQuery('#chart_4 svg');
	svg.attr("xmlns", "http://www.w3.org/2000/svg");
	svg.css('overflow', 'visible');
}
var sleep_bank_data;


$.ajax({
	type: 'POST',
	url: 'sleepmeasures.php',
	async: false,
	data: {test: '1'},
	dataType: 'text',
	success: function(response){
		sleep_bank_data = JSON.parse(response);
	}
});  


google.load('visualization', '1', {packages: ['corechart', 'bar']});
google.setOnLoadCallback(drawAxisTickColors);


var message = null;
var sleep_colors = generateColors(sleep_bank_data);
var sleep_daysName = getPreviousDaysName(3);
message = getSleepBankMessage(sleep_colors,sleep_daysName);
console.log(message);
function drawAxisTickColors() {
	var sleep_bank_data = google.visualization.arrayToDataTable([
		['bars','1',{ role: 'style' },'2',{ role: 'style' }],
		[sleep_daysName[2],2,sleep_colors[4],2,sleep_colors[5]],
		[sleep_daysName[1],2,sleep_colors[2],2,sleep_colors[3]],
		[sleep_daysName[0],2,sleep_colors[0],2,sleep_colors[1]],
		]);
	var sleep_bank_options = {
    enableInteractivity: false,
		isStacked: true, 
          legend: 'none', //disable the "color hint" at the top right corner.
          bar:{
            groupWidth: '95%' //disable the gap from the top and the bottom.
        },
        tooltip:{
            trigger: 'none'  //disable the pop up when hover over.
        },
          // chartArea: {
          //   // width: '30%',
          //   //   height: '40%'
          // },
          hAxis: {
            baselineColor: '#FFFFFF',
            textPosition: 'none', //disable the value at the horizontal axis.
            maxValue: 4 //6*4 = 24 i.e. google chart sperate the graph in 4 parts, in order to fill up the graph, the maximum have to be set to 24
        },
        vAxis: {
            title: ' ', //disable the y axis title.
            textStyle:{
            	fontSize: '14'
            }
        }
    };
    var sleep_bank_chart = new google.visualization.BarChart(document.getElementById('chart_4'));
      google.visualization.events.addListener(sleep_bank_chart, 'ready', AddNamespace7);

    sleep_bank_chart.draw(sleep_bank_data, sleep_bank_options);
    $("#sleepbank").append(message);
}
