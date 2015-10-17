<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]> <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]> <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<?php
session_start();
require_once ("functions.php");
?>

<html lang="en">
<!--<![endif]-->
	<head>
		<?php
		if (!isset($_SESSION['email'])) {
			//User isn't logged in, return to login page.
			header("Location: signin.php");
		}
		?>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>19 Sheep - Commitment</title>

		<!-- Bootstrap Core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">

		<!--//Fonts -->
		<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="css/nivo-lightbox.css" rel="stylesheet" />
		<link href="css/nivo-lightbox-theme/default/default.css" rel="stylesheet" type="text/css" />
		<link href="css/timeline.css" rel="stylesheet" />
		<!-- //Squad theme CSS -->

		<link href="color/default.css" rel="stylesheet">
		<link href="css/social-buttons.css" rel="stylesheet">
		<script src="js/jquery-latest.min.js" type="text/javascript"></script>
		<script src="js/memuscript.js"></script>
		<link rel="stylesheet" href="css/memustyles.css">
		<link href="css/style.css" rel="stylesheet">
		<link href="css/commitments.css" type="text/css" rel="stylesheet">
	</head>

	<?php
	if (!empty($_POST)) {
		if (empty($_POST['targetperday'])) {
			die("Please enter a goal per day");
			exit();
		}
		if (empty($_POST['deadline'])) {
			die("Please enter a deadline");
			exit();
		}
		if (empty($_POST['text'])) {
			die("Please enter text");
			exit();
		}
		if (empty($_POST['type'])) {
			die("Please enter the type of goal  you want to achieve");
			exit();
		}

		$query = " INSERT INTO commitments (targetperday, startday, deadline, text, isachieved, type, email)
VALUES (:targetperday, CURDATE(), :deadline, :text, 0, :type, :email)";

		$query_params = array(':targetperday' => $_POST['targetperday'], ':deadline' => $_POST['deadline'], ':text' => $_POST['text'], ':type' => $_POST['type'], ':email' => $_SESSION['email']);

		try {
			$stmt = $db -> prepare($query);
			$result = $stmt -> execute($query_params);
		} catch (PDOException $ex) {
			die("Failed to run query: " . $ex -> getMessage());
			exit();
		}

	}
	?>
	<body>

		<!--<script type="text/javascript" src="js/functionsJquery.js"></script>-->
		<script type="text/javascript" src="js/functions&Jquery.js?v=1"></script>
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
				<li>
					<a href='profile.php'>My Dashboard</a>
				</li>
				<li class="active">
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

		<div name="stuff1" id="stuff1"></div>

		<section class="sections">
			<div class="container">
				<div class="row">
					<div class="textCommit">
						<form method="POST" action="commitments.php" accept-charset="UTF-8" role="form" id="signupform" class="form-signin text-center">
							<fieldset>
								<label>Type:</label>
								<select class="form-control" id="Type" name="type">
									<option value="" selected="">(please select a type) </option>
									<option value="Intense Activity">Intense Activity</option>
									<option value="Medium Activity">Medium Activity</option>
									<option value="Light Activity">Light Activity</option>
									<option value="Steps">Steps</option>
									<option value="Weight">Weight</option>
									<option value="Blood Pressure">Blood Pressure</option>
									<option value="Total Sleep">Total Sleep</option>
									<option value="Wake-ups">Wake-ups</option>
									<option value="Evening Sleep">Evening Sleep</option>
									<option value="Morning Sleep">Morning Sleep</option>
									<option value="Sleep Score">Sleep Score</option>
								</select>
								<label>Target:</label>
								<input type="text" name="targetperday" class="form-control" id="Target" required="required">
								<label>Goal date:</label>
								<input class="form-control" name="deadline" type="date" id="GoalDate" required="required">

								<label>Make a commitment:</label>
								<input class="form-control" name="text" type="text" id="Commit" required="required">
								<br>
								<input class="submit btn btn-warning" value="Reset" type="reset">
								<input class="submit btn btn-success" id="submit" value="Submit" type="submit">

							</fieldset>
						</form>
					</div>

				</div>
				<div class="row">
					<div id="treeLine"></div>

					<div class="commitDivsStyle" id="commitDivs">
                    <?php 
						if(isset($_GET['complete'])){
							$query = ("UPDATE commitments SET isachieved = 1 WHERE id = :id");
							$query_params = array(':id' => $_GET['complete']);

							try {
								$stmt = $db->prepare($query);
								$result = $stmt->execute($query_params);
							} catch (PDOException $ex) {
								die("Failed to run query: " . $ex->getMessage());
								exit();
							}
						}
					?>
                    </div>
                    <div align="center"> 
						<a href="achievedcommitments.php" class="btn" role="button">View completed Commitments</a>
					</div>
				</div>
			</div>
		</section>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>