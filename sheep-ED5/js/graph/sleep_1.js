google.load("visualization", "1", {
	packages : ["gauge"]
}); 

function AddNamespace() {
	var svg = jQuery('#chart_1 svg');
	svg.attr('xmlns', 'http://www.w3.org/2000/svg');
	svg.css('overflow', 'visible');
}

google.setOnLoadCallback(drawChart);
var json = {
	"status" : 0,
	"body" : {
		"model" : 16,
		"series" : [{
			"startdate" : 1441285440,
			"state" : 2,
			"enddate" : 1441286700
		}, {
			"startdate" : 1441286700,
			"state" : 1,
			"enddate" : 1441288020
		}, {
			"startdate" : 1441288020,
			"state" : 2,
			"enddate" : 1441291680
		}, {
			"startdate" : 1441291680,
			"state" : 1,
			"enddate" : 1441293060
		}, {
			"startdate" : 1441293060,
			"state" : 2,
			"enddate" : 1441295160
		}, {
			"startdate" : 1441295160,
			"state" : 1,
			"enddate" : 1441295460
		}, {
			"startdate" : 1441295460,
			"state" : 0,
			"enddate" : 1441296000
		}, {
			"startdate" : 1441296000,
			"state" : 1,
			"enddate" : 1441297920
		}, {
			"startdate" : 1441297920,
			"state" : 2,
			"enddate" : 1441299960
		}, {
			"startdate" : 1441299960,
			"state" : 1,
			"enddate" : 1441302840
		}, {
			"startdate" : 1441302840,
			"state" : 2,
			"enddate" : 1441304640
		}, {
			"startdate" : 1441304640,
			"state" : 1,
			"enddate" : 1441306921
		}]
	}
};
var data = getData(json);
var value = getSleepScore("evening", 2, data);

function drawChart() {
	var data = google.visualization.arrayToDataTable([['Label', 'Value'], ['', value]]);

	var options = {
		min : 0,
		max : 1,
		width : 800,
		height : 240,
		redFrom : 0,
		redTo : 0.07,
		yellowFrom : 0.07,
		yellowTo : 0.2,
		greenFrom : 0.2,
		greenTo : 1,
		minorTicks : 5
	};

	var chart = new google.visualization.Gauge(document.getElementById('chart_1'));
	google.visualization.events.addListener(chart, 'ready', AddNamespace);	
	chart.draw(data, options);

	setInterval(function() {
		data.setValue(0, 0, 1);
		chart.draw(data, options);
	}, 13000);
}
