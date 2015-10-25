<!DOCTYPE html>
<html lang="en">

	<head>
	<?php
	session_start();
	require_once ("functions.php");
	if (!isset($_SESSION['email'])) {
		//User isn't logged in, return to login page.
		header("Location: signin.php");
	}
	?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>19 Sheep - Mood Logger</title>

	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<!-- Fonts -->
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="css/nivo-lightbox.css" rel="stylesheet" />
	<link href="css/nivo-lightbox-theme/default/default.css" rel="stylesheet" type="text/css" />
	<!-- Squad theme CSS -->
	<link href="color/default.css" rel="stylesheet">
	<link rel="stylesheet" href="css/memustyles.css">
	<link href="css/style.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-latest.min.js"></script>
	<script src="js/color.js"></script>
	<link href="css/input.css" rel="stylesheet">
	<link rel="stylesheet" href="css/memustyles.css">
	<script type="text/javascript" src="js/memuscript.js"></script>
	<link href="css/mood.css" rel="stylesheet">

</head>

<?php
session_start();
if (!empty($_POST)) {
	 if (!isset($_POST['optradio1']) || !isset($_POST['optradio2'])) {
			echo ("<SCRIPT LANGUAGE='JavaScript'>
    			window.alert('Your must select two feelings.')
   		 			window.location.href='mood.php';
    			</SCRIPT>");
			exit();
     }

	$bit1 = $_POST['optradio1'];
	$bit2 = $_POST['optradio2'];
	$val = $bit1 . $bit2;
	$query = "INSERT INTO mood (useremail, timestamp, val) VALUES (:email, NOW(), :val)";
	$query_params = array(':email' => $_SESSION['email'], ':val' => $val);

	try {
		$stmt = $db -> prepare($query);
		$result = $stmt -> execute($query_params);
	} catch (PDOException $ex) {
		die("Failed to run query: " . $ex -> getMessage());
		exit();
	}
}
?>


<body data-spy="scroll">
	<div class="header-main">
		<div id='cssmenu'>
			<ul>
				<li >
					<a href="index.php">19 Sheep</a>
				</li>
				<li class="active">
					<a href='mood.php'>My Mood</a>
				</li>
				<li>
					<a href='dreamdetail.php'>My Dreams</a>
				</li>
				<li>
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
	<section id="mood-detail" class="text-center">
		<div class="container">
			<div class="row" style="margin-bottom: 60px; margin-top: 60px;">
				<div >
				<h3 class="sign-up-title" style="color: #000000;">Mood Record</h3>
				</div>
				<form method="POST" action="mood.php" accept-charset="UTF-8" role="form" id="signupform" class="form-horizontal">
					<div>
						<p>
							Quick record  your feelings right now.
						</p>

						<p>
							Green for Good or Red for Not good;
						</p>
						<p>
							Yellow for my inner reality or Blue for my outside world;
						</p>
						<p>
							You can find a tutorial video <a id="tut_link" href="#tut_video">here</a>, click again to hide video.
						</p>
					</div>

					<div>
						<fieldset>
							<label for="m1"><div class="triangle" id="tri1"></div></label>
							<input type="radio" value="1"  name="optradio1" id="m1" class="selector"/>

							<label for="m2"><div class="triangle" id="tri2"></div></label>
							<input type="radio" value="0"  name="optradio1" id="m2" class="selector"/>

							<label for="m3"><div class="triangle" id="tri3"></div></label>
							<input type="radio" value="1"  name="optradio2" id="m3" class="selector"/>

							<label for="m4"><div class="triangle" id="tri4"></div></label>
							<input type="radio" value="0"  name="optradio2" id="m4" class="selector"/>
						</fieldset>
						<input class="submit action-button" value="Submit" type="submit">

					</div>
				</form>
			</div>
			<div class="row hidden tut_video" id="tut_video" style="margin-bottom:60px;">
				<h3 class="sign-up-title" style="color: #000000;">How to log your mood</h3>

				<iframe src="https://player.vimeo.com/video/142582075" width="650" height="400" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe> <p><a href="https://vimeo.com/142582075">Record your mood on 19Sheep</a> from <a href="https://vimeo.com/inceptionstrategies">damian</a> on <a href="https://vimeo.com">Vimeo</a>.</p>
				<br>
				<div align="center" style="margin-top: 20px;  cursor: pointer;"> 
						<a id="hide-btn" role="button">Hide Video</a>
					</div>
			</div>
			<div class="row" style="margin-bottom: 60px;">
				<div >
					<h3 class="sign-up-title" style="color: #000000;">Mood history</h3>

				</div>
				<table class="table" style=" display: none;">
					<thead>
						<tr>
							<td>Today</td>
							<td>Yesterday</td>
							<td><?php echo date("Y-m-d", strtotime("-2 days")); ?></td>
							<td><?php echo date("Y-m-d", strtotime("-3 days")); ?></td>
							<td><?php echo date("Y-m-d", strtotime("-4 days")); ?></td>
							<td><?php echo date("Y-m-d", strtotime("-5 days")); ?></td>
							<td><?php echo date("Y-m-d", strtotime("-6 days")); ?></td>
						</tr>
					</thead>
					<tbody>
						<?php
						$query2 = "SELECT * FROM mood WHERE (useremail = :email) ORDER BY id DESC LIMIT 7";

						$query_params2 = array(':email' => $_SESSION['email']);

						try {
							$stmt2 = $db -> prepare($query2);
							$result2 = $stmt2 -> execute($query_params2);
						} catch (PDOException $ex) {
							die("Failed to run query: " . $ex -> getMessage());
							exit();
						}
						?>
						<tr id="output">
							<?php
							while ($row = $stmt2->fetch()) {
								?>
								<td><?php echo ($row['val'] . ' ' . $row['timestamp']) ?><


/td>
											<?php
											}
	?>
	</tr>

	</tbody>
	<div class="result_box">
	<div id="r1" class="result wrapper">
	<div class="tooltip"></div>
	</div>
	<div id="r2" class="result wrapper">
	<div class="tooltip"></div>
	</div>
	<div id="r3" class="result wrapper">
	<div class="tooltip"></div>
	</div>
	<div id="r4" class="result wrapper">
	<div class="tooltip"></div>
	</div>
	<div id="r5" class="result wrapper">
	<div class="tooltip"></div>
	</div>
	<div id="r6" class="result wrapper">
	<div class="tooltip"></div>
	</div>
	<div id="r7" class="result wrapper">
	<div class="tooltip"></div>
	</div>
	</div>
	</div>
	</div>
	</section>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery-latest.min.js" type="text/javascript"></script>
	<script src="js/mood.js?v=2 "></script>
	<script src="js/hide.js"></script>
	</body>

</html>
