<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>19 Sheep - Dream Data Review</title>

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
		<link rel="stylesheet" href="css/memustyles.css">
		<link href="css/style.css" rel="stylesheet">
		
	
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
		$db_host = "localhost";
		$db_name = "messagedb";
		$db_user = "root";
		$db_pass = "";
		
		try {
			$db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
		} catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
		}
	?>
	
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
						<a href='dreamdetail.php'>Dream Analysis</a>
					</li>

				</ul>
			</div>
		</div>
		<section id="signin">
			<div class="container">
				<div class="row" style="margin-top:60px;">
					<div class="col-md-8 col-md-offset-2 signin-box">


						<h3 class="sign-up-title" style="color: #000000; text-align: center">All Conversations to review</h3>

						<?php
							$user = 3; // CHANGE THIS TO POINT TO THE CURRENT USER INSTEAD
							try{
								$req1 = $db->prepare('SELECT * FROM pm WHERE(user1 = :user OR user2 = :user) GROUP BY convoid');
								//$req1 = $db->query('SELECT * FROM pm WHERE(user1 = :user OR user2 = :user)');
								
								$req1->bindParam(':user', $user, PDO::PARAM_INT);
								$req1->execute();
							} catch (PDOException $e) {
								echo 'Connection failed: ' . $e->getMessage();
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
											if ($row['user1'] == $user){
												$name = $db->query("SELECT * FROM users WHERE (id = '".$row['user2']."')");
											} else {
												$name = $db->query("SELECT * FROM users WHERE (id = '".$row['user1']."')");
											}
											$nn = $name->fetch();
											echo $nn[1];
											?>
									</a></td>
									<td>
										<a class="msgtext" href="read_pm.php?id=<?php echo $row['convoid']; ?>#reply">
											<?php echo $row['timestamp'];?>
										</a>
									</td>
									<td>
										<a class="msgtext" href="read_pm.php?id=<?php echo $row['convoid']; ?>#reply">
											<?php echo $row['title'];?>
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
			</div>

		</section>
	</body>

</html>