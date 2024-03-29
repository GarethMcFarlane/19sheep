<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>19 Sheep - Dashboard</title>

		<!--Core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<!-- Fonts -->
		<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="css/nivo-lightbox.css" rel="stylesheet" />
		<link href="css/nivo-lightbox-theme/default/default.css" rel="stylesheet" type="text/css" />
		<link href="css/animate.css" rel="stylesheet" />
		<!-- Squad theme CSS -->

		<link href="color/default.css" rel="stylesheet">
		<link rel="stylesheet" href="css/memustyles.css">
		<link href="css/style.css" rel="stylesheet">
		<link href="css/profile.css" rel="stylesheet">
		
		<script type="text/javascript" src="js/memuscript.js"></script>
		<script type="text/javascript" src="js/xepOnline.jqPlugin.js"></script>
		<script type="text/javascript" src="js/helpingmethods.js"></script>
		<script type="text/javascript" src="js/graph/sleep_1.js"></script>
		<script type="text/javascript" src="js/graph/sleep_2.js"></script>
		<script type="text/javascript" src="js/graph/act_1.js"></script>
		<script type="text/javascript" src="js/graph/act_2.js"></script>
	</head>

	<body data-spy="scroll">
		<div class="container  header-main">
			<div class="icon">
				<img src="img/index/19sleep.png" style="width: 50px; height: 50px;" class="icon">
			</div>
			<div id='cssmenu'>
				<ul>
					<li>
						<a href="newindex.php">19 Sheep</a>
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
			<div>
				<ul class="nav navbar-top-links navbar-right">
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-user fa-3x"></i> </a>
						<!-- dropdown user-->
						<ul class="dropdown-menu dropdown-user">
							<li>
								<a href="profile.html"><i class="fa fa-user fa-fw"></i>User Profile</a>
							</li>
							<li>
								<a href="#"><i class="fa fa-gear fa-fw"></i>Settings</a>
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
				<a class="btn profile-btn" href="#">Withing</a>
			</div>
			<div id="print-box">
				<div class="dashboard">
					<div class="container outbox">
						<div class="row">
							<div class="graph_heading">
								<h3>Sleeping Score</h3>
							</div>
							<div id="chart_1" class="graph_div"></div>
							<div class="drop-circle">
								<a type="button" class="showdiv-l"><i class="fa fa-caret-square-o-down fa-2x"></i> </a>
							</div>
						</div>
						<div class="row hidden-div-l hidden">
							<div class="graph_heading">
								<h3>Sleeping Detail</h3>
							</div>
							<div id="chart_div_1" class="graph_div multi_graph"></div>
						</div>

						<div class="row">
							<p>
								I am bar chart;
							</p>
							<div class="drop-circle">
								<a type="button" class="showdiv-l-2"> <i class="fa fa-caret-square-o-down fa-2x"></i> </a>
							</div>
						</div>
						<div class="row hidden-div-l-2 hidden">
							<p>
								I am other Hide
							</p>
						</div>
					</div>

				</div>
				<div class="dashboard bg-gray">
					<div class="container outbox">
						<div class="row">
							<div class="graph_heading">
								<h3>Activity Score</h3>
							</div>
							<div id="chart_2" class="graph_div"></div>
							<div class="drop-circle">
								<a type="button" class="showdiv-r"> <i class="fa fa-caret-square-o-down fa-2x"></i> </a>
							</div>
						</div>
						<div class="row hidden-div-r hidden">
							<div class="graph_heading">
								<h3>Activity Detail</h3>
							</div>
							<div id="chart_div_2" class="graph_div multi_graph"></div>
						</div>

						<div class="row">
							<p>
								I am bar chart;
							</p>
							<div class="drop-circle">
								<a type="button" class="showdiv-r-2"> <i class="fa fa-caret-square-o-down fa-2x"></i> </a>
							</div>
						</div>
						<div class="row hidden-div-r-2 hidden">
							<p>
								I am other Hide
							</p>
						</div>

					</div>
				</div>
			</div>
		</section>
		<script src="js/jquery-latest.min.js" type="text/javascript"></script>
		<script src="js/hide.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>

</html>