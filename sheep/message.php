<!DOCTYPE html>
<?php session_start();?>
<html lang="en">

	<head>
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
	<link href="css/animate.css" rel="stylesheet" />
	<!-- Squad theme CSS -->
	<link href="color/default.css" rel="stylesheet">
	<link rel="stylesheet" href="css/memustyles.css">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/profile.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-latest.min.js"></script>
	
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
	include("functions.php");
	?>
	
	<body data-spy="scroll">
					<div class="icon">
			<a href="index.php"><img src="img/index/19sleep.png" style="width: 50px; height: 50px;" class="icon"></a>
		</div>
		<div id='cssmenu'>
			<ul>
				<li>
					<a href="profile.php">Dashboard</a>
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
				<li>
					<a href='message.php'>Messages</a>
				</li>
			</ul>
		</div>
		<section id="signin">
			<div class="container">
				<div class="row" style="margin-top:60px;">
					<div class="col-md-8 col-md-offset-2 signin-box">


						<h3 class="sign-up-title" style="color: #000000; text-align: center">All Conversations to review</h3>

						<?php
							$user = $_SESSION['email'];
							try{
								$req1 = $db->prepare('SELECT * FROM message WHERE(user1 = :user OR user2 = :user) GROUP BY convoid');
								//$req1 = $db->query('SELECT * FROM pm WHERE(user1 = :user OR user2 = :user)');
								
								$req1->bindParam(':user', $user, PDO::PARAM_STR);
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
												$name = $db->prepare("SELECT fullName FROM users WHERE (email = :user2)");
												$name->bindParam(':user2', $row['user2'], PDO::PARAM_STR);
												$name->execute();
											} else {
												$name = $db->prepare("SELECT fullName FROM users WHERE (email = :user1)");
												$name->bindParam(':user1', $row['user1'], PDO::PARAM_STR);
												$name->execute();
											}
											$nn = $name->fetch();
											echo $nn["fullName"];
											?>
									</a></td>
									<td>
										<a class="msgtext" href="read_pm.php?id=<?php echo $row['convoid']; ?>#reply">
											<?php echo $row['mytimestamp'];?>
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