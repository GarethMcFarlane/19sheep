<!DOCTYPE html>
<html lang="en">

	<head>

		<?php
		session_start();
		?>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>19 Sheep - Dashboard</title>

		<!-- Bootstrap Core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<!-- Fonts -->
		<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="css/nivo-lightbox.css" rel="stylesheet" />
		<link href="css/nivo-lightbox-theme/default/default.css" rel="stylesheet" type="text/css" />
		<link href="css/animate.css" rel="stylesheet" />
		<!-- Squad theme CSS -->

		<link href="color/default.css" rel="stylesheet">
		<script src="js/memuscript.js"></script>
		<script src="js/xepOnline.jqPlugin.js"></script>
		<script src="js/jquery-latest.min.js"></script>
		<link rel="stylesheet" href="css/memustyles.css">
		<link href="css/style.css" rel="stylesheet">
		<link href="css/profile.css" rel="stylesheet">

		<script type="text/javascript" src="js/helpingmethods.js"></script>
		<script type="text/javascript" src="js/displayGraphs.js"></script>

	</head>

	<body data-spy="scroll">
		<div class="container  header-main">
			<div class="icon">
				<img src="img/index/19sleep.png" style="width: 50px; height: 50px;" class="icon">
			</div>
			<div id='cssmenu'>
				<ul>
					<li>
						<a href="index.php">19 Sheep</a>
					</li>
					<li>
						<a href='mood.php'>Mood Logger</a>
					</li>
					<li>
						<a href='dreamdetail.php'>Dream Analysis</a>
					</li>
					<li>
						<a href='#'>My commitment</a>
					</li>

				</ul>
			</div>
				<div class="login-home">
					<a class="btn-signin" href="logout.php">Log Out</a>
				</div>
		</div>



		<?php


			if (!isset($_SESSION['email'])) {
				//User isn't logged in, return to login page.
				header("Location: signin.php");
			}


			if (!isset($_SESSION["userid"])) {
		?>
			<p align="center">No Withings device detected.  Please click the button below to connect.</p>
			<div align="center" class="btn-box">
			<a class="btn profile-btn" href="http://19sheep.com/api.php">Connect</a>
			</div>
		<?php
			} else {
		?>
		<section class="bg-gray">
			<div id="print-box">
				<div class="dashboard">
					<div class="container outbox">
						<h3>Sleep Score Gauge</h3>
						<div class="row" style="margin-top:60px;">
							
							<script>
							var sleep_json;
							$.ajax({
								type: 'POST',
								url: 'sleepmeasures.php',
								async: false,
								data: {test: '1'},
								dataType: 'text',
								success: function(response){
									sleep_json = JSON.parse(response);
								}
							});

							google.load("visualization", "1", {packages:["gauge"]});
							google.setOnLoadCallback(drawChart);
							var sleep_data = getData(sleep_json);
							var sleep_value = 100*(getSleepScore("evening",2,sleep_data)*0.75+getSleepScore("morning",2,sleep_data)*0.25).toFixed(2);

							function drawChart() {
								var sleep_data = google.visualization.arrayToDataTable([
									['Label', 'Value'],
									[' ', sleep_value],
									]);

								var sleep_options = {
									min:0, max:100,
									width: 600, height: 150,
									redFrom: 0, redTo: 20,
									yellowFrom:20, yellowTo: 50,
									greenFrom:50, greenTo:100,
									minorTicks: 5
								};

								var sleep_chart = new google.visualization.Gauge(document.getElementById('chart_div'));

								sleep_chart.draw(sleep_data, sleep_options);

								setInterval(function() {
									sleep_data.setValue(0, 0, 1);
									sleep_chart.draw(sleep_data, sleep_options);
								}, 13000);
							}
							</script>

							<div align="center" id="chart_div" style="width: 400px; height: 120px;"></div>
							<div class="drop-circle">
								<a type="button" class="showdiv-l"><i class="fa fa-caret-square-o-down fa-2x"></i> </a>
							</div>
						</div>
						<div class="row hidden-div-l hidden">

						</div>
						<div class="row">

							<div class="drop-circle">
								<a type="button" class="showdiv-l-2"> <i class="fa fa-caret-square-o-down fa-2x"></i> </a>
							</div>
						</div>
						<div class="row hidden-div-l-2 hidden">

						</div>
					</div>
				</div>
				<div class="dashboard">
					<div class="container outbox">
						<h3>Activity Score Gauge</h3>
						<div class="row" style="margin-top:60px;">
							
							<script>
							var activity_json;
							$.ajax({
								type: 'POST',
								url: 'activitymeasures.php',
								async: false,
								data: {test: '1'},
								dataType: 'text',
								success: function(response){
									activity_json = JSON.parse(response);
								}
							});


							google.load("visualization", "1", {packages:["gauge"]});
							google.setOnLoadCallback(drawChart);
							var data = getActivityData(activity_json);
							var value = totalActivityScore(data);

							function drawChart() {
								var data = google.visualization.arrayToDataTable([
									['Label', 'Value'],
									[' ', value],
									]);

								var options = {
									min:0, max:3000,
									width: 600, height: 150,
									redFrom: 0, redTo: 20,
									yellowFrom:20, yellowTo: 50,
									greenFrom:50, greenTo:100,
									minorTicks: 5
								};

								var chart = new google.visualization.Gauge(document.getElementById('activity_div'));

								chart.draw(data, options);

								setInterval(function() {
									data.setValue(0, 0, 1);
									chart.draw(data, options);
								}, 13000);
							}
							</script>
							<div align="center" id="activity_div" style="width: 400px; height: 120px;"></div>
							<div class="drop-circle">
								<a type="button" class="showdiv-r"> <i class="fa fa-caret-square-o-down fa-2x"></i> </a>
							</div>
						</div>
						<div class="row hidden-div-r hidden bg-white">

						</div>
						<div class="row">

							<div class="drop-circle">
								<a type="button" class="showdiv-r-2"> <i class="fa fa-caret-square-o-down fa-2x"></i> </a>
							</div>
						</div>
						<div class="row hidden-div-r-2 hidden">

						</div>
					</div>
				</div>
			</div>
		</section>
		<?php
			} 
		?>
		<script src="js/jquery-latest.min.js" type="text/javascript"></script>

		<script src="js/hide.js"></script>
	</body>



</html>