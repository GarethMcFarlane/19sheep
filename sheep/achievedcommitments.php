<?php
session_start();
require_once("functions.php");
?>

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

</head>


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
	<section id="achieved" class="text-center">
		<div class="container">

			<div class="row" style="margin-bottom: 60px;">
				<div >
					<h4>Achieved Commitments</h4>
				</div>
				<table class="table">
					<thead align="center">
						<tr>
							<th align="center">Target</th>
							<th align="center">Type</th>
							<th align="center">Start Date</th>
							<th align="center">Deadline</th>
							<th align="center">Details</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query2 = "SELECT * FROM commitments WHERE (email = :email AND isachieved = 1)";

						$query_params2 = array(':email' => $_SESSION['email']);

						try {
							$stmt2 = $db -> prepare($query2);
							$result2 = $stmt2 -> execute($query_params2);
						} catch (PDOException $ex) {
							die("Failed to run query: " . $ex -> getMessage());
							exit();
						}
						?>
						
							<?php
							while ($row = $stmt2->fetch()) {
								?>
								<tr>
								<td><?php echo $row['targetperday']; ?></td>
								<td><?php echo $row['type']; ?></td>
								<td><?php echo $row['startday']; ?></td>
								<td><?php echo $row['deadline']; ?></td>
								<td><?php echo $row['text']; ?></td>
								</tr>
								<?php
							}
							?>
						

					</tbody>
				</table>
			</div>
		</div>
	</section>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery-latest.min.js" type="text/javascript"></script>
</body>

</html>

