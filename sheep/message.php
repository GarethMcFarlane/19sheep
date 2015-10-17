<!DOCTYPE html>
<?php session_start(); ?>
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

	<title>19 Sheep - Messages</title>
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
	<link href="css/profile.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-latest.min.js"></script>
	
	<link rel="stylesheet" href="css/memustyles.css">
	<script type="text/javascript" src="js/memuscript.js"></script>
	
	<style>
	.msgtext {
		color: #666;
	}
	.msgtext:hover {
		color: #666;
	}
	</style>
</head>

<?php
include ("functions.php");
?>

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
				<li>
					<a href='commitments.php'>My Commitments</a>
				</li>
				<li class="active">
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
	<section id="signin">
		<div class="container">
			<div class="row" style="margin-top:60px;">
				<div class="col-md-8 col-md-offset-2 signin-box">


					<h3 class="sign-up-title" style="color: #000000; text-align: center">Inbox</h3>

					<?php
					$user = $_SESSION['email'];
					try {
						$req1 = $db -> prepare('SELECT * FROM message WHERE(user1 = :user OR user2 = :user) GROUP BY convoid');
							//$req1 = $db->query('SELECT * FROM pm WHERE(user1 = :user OR user2 = :user)');

						$req1 -> bindParam(':user', $user, PDO::PARAM_STR);
						$req1 -> execute();
					} catch (PDOException $e) {
						echo 'Connection failed: ' . $e -> getMessage();
					}
					?>

					<table class = "table table-hover" style="width:100%">
						<thead>
							<tr>
								<th>From</th>
								<th>Date Sent</th>
								<th>Title</th>
							</tr>
						</thead>
						<tbody>
							<?php
							while ($row = $req1->fetch()) {
								?>
								
								<tr>
									<td> <a class="msgtext" href="read_pm.php?id=<?php echo $row['convoid']; ?>#reply">
										<?php
										if ($row['user1'] == $user) {
											$name = $db -> prepare("SELECT fullName FROM users WHERE (email = :user2)");
											$name -> bindParam(':user2', $row['user2'], PDO::PARAM_STR);
											$name -> execute();
										} else {
											$name = $db -> prepare("SELECT fullName FROM users WHERE (email = :user1)");
											$name -> bindParam(':user1', $row['user1'], PDO::PARAM_STR);
											$name -> execute();
										}
										$nn = $name -> fetch();
										echo $nn["fullName"];
										?>
									</a></td>
									<td>
										<a class="msgtext" href="read_pm.php?id=<?php echo $row['convoid']; ?>#reply">
											<?php echo $row['mytimestamp']; ?>
										</a>
									</td>
									<td>
										<a class="msgtext" href="read_pm.php?id=<?php echo $row['convoid']; ?>#reply">
											<?php echo $row['title']; ?>
										</a>
									</td>
								</tr>
								
								<?php
							}
							//$req1 = mysql_query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, users.id as userid, users.username from pm as m1, pm as m2,users where ((m1.user1="'.$_SESSION['userid'].'" and m1.user1read="no" and users.id=m1.user2) or (m1.user2="'.$_SESSION['userid'].'" and m1.user2read="no" and users.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');

							//$req2 = mysql_query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, users.id as userid, users.username from pm as m1, pm as m2,users where ((m1.user1="'.$_SESSION['userid'].'" and m1.user1read="yes" and users.id=m1.user2) or (m1.user2="'.$_SESSION['userid'].'" and m1.user2read="yes" and users.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
							?>
						</tbody>
					</table>
				</div>
			</div>
			<?php
			$query2 = "SELECT MAX(convoid) FROM message";


			try {
				$stmt2 = $db -> prepare($query2);
				$result2 = $stmt2 -> execute();
			} catch (PDOException $ex) {
				die("Failed to run query: " . $ex -> getMessage());
				exit();
			}

			$row = $stmt2->fetch();
			$convoid = $row['MAX(convoid)'] + 1;

			?>
			<div class="row">
				<div class="col-md-8 col-md-offset-2 signin-box">
					<h3 class="sign-up-title" style="color: #000000; text-align: center">New Message</h3>
					<form method="POST" action="read_pm.php?id=<?php echo $convoid;?>" accept-charset="UTF-8" role="form" id="newpm" class="form-signin text-center">
						<fieldset>
							<Label>Email Address:</Label>
							<input class="form-control" name="emailaddress" type="text" id="email" required="required">
							<Label>Message:</Label>
							<input class="form-control" name="message" type="text" id="message" required="required">
							<input class="submit btn btn-success" id="submit" value="Send" type="submit">
						</fieldset>
					</form>
				</div>
			</div>
		</div>

	</section>
	<script src="js/bootstrap.min.js"></script>

</body>

</html>