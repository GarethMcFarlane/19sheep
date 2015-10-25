google.load("visualization", "1", {
	packages : ["corechart"]
});

function AddNamespace() {
	var svg = jQuery('#donutchart svg');
	svg.attr("xmlns", "http://www.w3.org/2000/svg");
	svg.css('overflow', 'visible');
}

google.setOnLoadCallback(drawChart);
function drawChart() {
	var data = google.visualization.arrayToDataTable([['Task', 'Hours per Night'], ['Print', 2], ['Light Sleep', 4], ['Deep Sleep', 3], ['Dreaming', 1], ['Restless', 1]]);

	var options = {
		title : 'Sleep Analysis',
		pieHole : 0.4,
	};

	var chart = new google.visualization.PieChart(document.getElementById('donutchart'));

	google.visualization.events.addListener(chart, 'ready', AddNamespace);

	chart.draw(data, options);
}