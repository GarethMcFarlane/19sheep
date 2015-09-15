<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>19 Sheep - Dashboard</title>

		<!-- Bootstrap Core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">

		<!-- Fonts -->
		<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="css/nivo-lightbox.css" rel="stylesheet" />
		<link href="css/nivo-lightbox-theme/default/default.css" rel="stylesheet" type="text/css" />
		<link href="css/animate.css" rel="stylesheet" />
		<!-- Squad theme CSS -->

		<link href="color/default.css" rel="stylesheet">
		<script src="js/memuscript.js"></script>
		<link rel="stylesheet" href="css/memustyles.css">
		<link href="css/style.css" rel="stylesheet">
		<link href="css/profile.css" rel="stylesheet">

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
			<div class="login-home">
				<a class="btn-signin" href="signin.php">Sign in</a>

				<a class="btn-signin" href="signup.php">Sign up</a>
			</div>
		</div>
		<section class="dashboard bg-gray">
			<div class="container outbox">
				<div class="row" style="margin-top:60px;">
					<p>
						I am graph
					</p>
					<div class="drop-circle">
						<a type="button" class="showdiv-l"> <i class="fa fa-plus-circle fa-2x"></i> <i class="fa fa-caret-square-o-down fa-2x"></i> </a>
					</div>
				</div>
				<div class="row hidden-div-l hidden">
					<p>
						I am Hide
					</p>
				</div>
				<div class="row">
					<p>
						I am other graph;
					</p>
				</div>
			</div>

		</section>
		<section class="dashboard bg-white">
			<div class="container outbox">
				<div class="row bg-dark" style="margin-top:60px;">
					<p>
						I am graph
					</p>
					<div class="drop-circle">
						<a type="button" class="showdiv-r"> <i class="fa fa-plus-circle fa-4"></i> <i class="fa fa-caret-square-o-down fa-4"></i> </a>
					</div>
				</div>
				<div class="row hidden-div-r hidden bg-white">
					<p>
						I am Hide
					</p>
				</div>
				<div class="row bg-dark">
					<p>
						I am other graph;
					</p>
				</div>
			</div>

		</section>
		<script src="js/jquery-latest.min.js" type="text/javascript"></script>

		<script src="js/hide.js"></script>
	</body>

</html>