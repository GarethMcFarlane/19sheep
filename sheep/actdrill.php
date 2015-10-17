<!DOCTYPE html>
<html lang="en">

<head>
<?php
session_start();
if (!isset($_SESSION['email'])) {
	//User isn't logged in, return to login page.
	header("Location: signin.php");
}
?>
	
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>19 Sheep - Activities Drilldown</title>

		<!-- Bootstrap Core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<!-- Fonts -->
		<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="css/nivo-lightbox.css" rel="stylesheet" />
		<link href="css/nivo-lightbox-theme/default/default.css" rel="stylesheet" type="text/css" />
		<!-- Squad theme CSS -->
		<link href="color/default.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<script type="text/javascript" src="js/jquery-latest.min.js"></script>
		<!-- Graph JS -->
		<script type="text/javascript" src="js/xepOnline.jqPlugin.js"></script>
		<link rel="stylesheet" href="css/memustyles.css">
		<script type="text/javascript" src="js/memuscript.js"></script>
		<link rel="stylesheet" type="text/css" href="css/gagueStyle.css">
		<link rel="stylesheet" type="text/css" href="css/drill.css">

	</head>

	<body data-spy="scroll">
		<div class="container  header-main">

			<div id='cssmenu'>
				<ul>
				<li >
					<a href="index.php">19 Sheep</a>
				</li>
				<li>
					<a href='mood.php'>My Mood</a>
				</li>
				<li>
					<a href='dreamdetail.php'>My Dreams</a>
				</li>
				<li class="active">
					<a href='profile.php'>My Dashboard</a>
				</li>
				<li>
					<a href='commitments.php'>My Commitments</a>
				</li>
				<li>
					<a href='message.php'>My Messages</a>
				</li>
				<li>
					<a href='http://shop.19sheep.com'>My Shop</a>
				</li>
			</ul>
			</div>
			<div>
				<ul class="nav navbar-top-links navbar-right">
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-user fa-3x"></i> </a>
						<!-- dropdown user-->
						<ul class="dropdown-menu dropdown-user">
							<li>
								<a href="settings.php"><i class="fa fa-gear fa-fw"></i>User Settings</a>
							</li>
							<hr>
							<li>
								<a href="logout.php"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
							</li>
						</ul>
						<!-- end dropdown-user -->
					</li>
					<!-- end main dropdown -->
				</ul>
			</div>
		</div>
		<section>
			<div class="btn-box">
				<a class="btn profile-btn" href="#" onclick="return xepOnline.Formatter.Format('print-box', {render:'download',filename:'document'});">Save as PDF</a>
			</div>
			<div id="print-box">
				<div class="container">
					<div class="row text-center">
						<div id="chart_div_9" class="graph_div" style="margin: auto; width:65%; height: 280px;"></div>
						<div class="message">
							<p id="actdrill" class="summary"></p>
						</div>
					</div>
				</div>
		</section>
		<script src="js/jquery-latest.min.js" type="text/javascript"></script>
		<script src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/helpingmethods.js"></script>
		<script type="text/javascript" src="js/graph/act_4.js"></script>

	</body>
</html>
