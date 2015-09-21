function AddNamespace3() {
	var svg = jQuery('#chart_div_1 svg');
	svg.attr("xmlns", "http://www.w3.org/2000/svg");
	svg.css('overflow', 'visible');
}

google.setOnLoadCallback(drawChart);
function drawChart() {

	var data = google.visualization.arrayToDataTable([['Label', 'Value'], ['Morning', 80],['Evening', 60]]);

	var options = {
		width : 300,
		height : 240,
		redFrom : 90,
		redTo : 100,
		yellowFrom : 75,
		yellowTo : 90,
		minorTicks : 5
	};

	var chart = new google.visualization.Gauge(document.getElementById('chart_div_1'));
	google.visualization.events.addListener(chart, 'ready', AddNamespace3);
	chart.draw(data, options);

	setInterval(function() {
		data.setValue(0, 1, 40 + Math.round(60 * Math.random()));
		chart.draw(data, options);
	}, 13000);
}