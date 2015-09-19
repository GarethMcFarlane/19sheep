
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>19 Sheep - Mood Logger</title>

		<!-- Bootstrap Core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">

		<!-- Fonts -->
		<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="css/nivo-lightbox.css" rel="stylesheet" />
		<link href="css/nivo-lightbox-theme/default/default.css" rel="stylesheet" type="text/css" />
		<link href="css/animate.css" rel="stylesheet" />
		<!-- Squad theme CSS -->

		<link href="color/default.css" rel="stylesheet">
		<link href="css/social-buttons.css" rel="stylesheet">
		<script src="js/jquery-latest.min.js" type="text/javascript"></script>
		<script src="js/memuscript.js"></script>
		<script src="js/color.js"></script>
		<link rel="stylesheet" href="css/memustyles.css">
		<link href="css/style.css" rel="stylesheet">
		<link href="css/input.css" rel="stylesheet">
		<style>
		table, th, td {
			border: 1px solid black;
			border-collapse: collapse;
		}
		th {
			text-align: center;
			font-weight: bold;
		}
		</style>
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
					<li class='active'>
						<a href='mood.php'>Mood Logger</a>
					</li>
					<li>
						<a href='dreamdetail.php'>Dream Analysis</a>
					</li>
					

				</ul>
			</div>
		</div>
		<section id="mood-detail" class="home-section text-center">
			<div class="container">
				<div class="row">
				<div class="row">
					<h3>Dream Details to Review</h3>
				</div>
				<!--
	<--			<php
	//				$server = //insert server
	//				$db = //insert DB
	//				$query = mysql_query("select * from dreams where //toReview == true");
//				?>
				-->
				<form class="form-horizontal" role="form">
					<div>
						<table style ="width:100%"> 
							<tr>
								<th>User</th> 
								<th>Dream Title</th>
								<th>FileLink</th>
								<th>Remove from list</th>
							</tr>
							<tr>
								<td>User </td> 
								<td>Dream Title</td>
								<td>FileLink</td>
								<td><button type='button' class='btn btn-link'>Remove</button></td>
							</tr>
							<tr>
								<td>User </td> 
								<td>Dream Title</td>
								<td>FileLink</td>
								<td><button type='button' class='btn btn-link'>Remove</button></td>
							</tr>
							<!--<php
								while ($row = query) {
									echo "<tr>";
									echo "<td>".$row[user]."</td>";
									echo "<td>".$row[title]."</td>";
									echo "<td>".$row[link]."</td>";
									echo "<td> <button type='button' class='btn btn-link'>Remove</button>";
									echo "</tr>";
							?> -->
							</table>
					</div>
				</form>
				</div>
			</div>

		</section>

	</body>

</html>