<!DOCTYPE html>
<?php
session_start();
include("functions.php");

?>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>19 Sheep - Message</title>

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
</head>
<body>
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
	<?php

//We check if the user is logged
//if(isset($_SESSION['username']))
//{
// for now hardcode the user
	$userid = $_SESSION["email"];
//We check if the ID of the discussion is defined

//if(isset($_GET['id'])) {
	$convoid = intval($_GET['id']);


	$req1 = $db->prepare('SELECT * FROM message WHERE(convoid = :id)');
	$req1->bindParam(':id', $convoid, PDO::PARAM_INT);
	$req1->execute();



//We check if the user have the right to read this discussion
//if($dn1['user1']==$_SESSION['userid'] or $dn1['user2']==$_SESSION['userid'])
	$row = $req1->fetch();
	$user1 = $row['user1'];
	$user2 = $row['user2'];
	$title = $row['title'];
//{
//The discussion will be placed in read messages
//if($dn1['user1']==$_SESSION['userid'])
	if (isset($_POST['emailaddress']) and $_POST['emailaddress'] != '') {
		$user1 = $_SESSION['email'];
		$user2 = $_POST['emailaddress'];
		$title = 'New Message';


		// $emailquery = 'SELECT COUNT(*) FROM users WHERE email = :email';
		// $emailquery_params = array(':email' => $user2);


		// try {
		// 	$stmt2 = $db -> prepare($emailquery);
		// 	$result2 = $stmt2 -> execute($emailquery_params);
		// } catch (PDOException $ex) {
		// 	die("Failed to run query: " . $ex -> getMessage());
		// 	exit();
		// }

		// $emailrow = $stm2->fetch();
		// if ($emailrow['COUNT(*)'] == 0) {
		// 	header('Location: message.php');
		// 	die('Invalid Email');
		// }
	}
//We get the list of the messages
//$req2 = mysql_query('select pm.timestamp, pm.message, users.id as userid, users.username, users.avatar from pm, users where pm.id="'.$id.'" and users.id=pm.user1 order by pm.id2');
//We check if the form has been sent

	if(isset($_POST['message']) and $_POST['message']!='')
	{
		$message = $_POST['message'];
        //We remove slashes depending on the configuration
		if(get_magic_quotes_gpc())
		{
			$message = stripslashes($message);
		}
        //We protect the variables
		$message = $db->quote($message);
        //We send the message and we change the status of the discussion to unread for the recipient
		$msubmit = $db->prepare('INSERT INTO message (id, convoid, title, user1, user2, messages, mytimestamp, user1read, user2read) VALUES (:id, :convoid, :title, :user1, :user2, :message, NOW(), :user1read, :user2read)');
		
		$idrow = $db->query('SELECT count(*) FROM message');

		$id = ($idrow->fetch()["count(*)"] + 1);

		$msubmit->bindParam(':id', $id, PDO::PARAM_INT);
		$msubmit->bindParam(':convoid', $convoid, PDO::PARAM_INT);
		$msubmit->bindParam(':title', $title, PDO::PARAM_INT);
		$msubmit->bindParam(':user1', $userid, PDO::PARAM_STR);
		$msubmit->bindParam(':message', $message);
		//$msubmit->bindParam(':timestamp', time());
		
		$false = FALSE;
		$true = TRUE;
		
		$msubmit->bindParam(':user1read', $true, PDO::PARAM_INT);
		$msubmit->bindParam(':user2read', $false, PDO::PARAM_INT);
		
		//user 1 is always the initiating sender, user2 is the reciever
		if ($userid == $user1) {	
			$msubmit->bindParam(':user2', $user2, PDO::PARAM_STR);
		} else {
			$msubmit->bindParam(':user2', $user1, PDO::PARAM_STR);
		}
		
		$msubmit->execute();
		$value = intval($_GET['id']);
		header('Location: '.$_SERVER['REQUEST_URI']);
		die;
	}
	?>

	<section id="messagelist">
		<div class="container">
			<div class="row" style="margin-top:60px;">
				<div class="col-md-8 col-md-offset-2">

					<h3><?php echo $title; ?></h3>

					<?php
					$req2 = $db->prepare('SELECT * FROM message WHERE(convoid = :id)');
					$req2->bindParam(':id', $convoid, PDO::PARAM_INT);
					$req2->execute();

					$Qname = $db->prepare('SELECT fullName FROM users WHERE (email = :userid)');
					$Qname->bindParam(':userid', $userid, PDO::PARAM_STR);
					$Qname->execute();
					$myname = $Qname->fetch()['fullName'];

					$tname = $db->prepare('SELECT fullName FROM users WHERE (email = :userid)');
				// if I am user 1, we take user2's name as the other convo name
				// otherwise, we take user1's
					if ($user1 == $userid){
						$tname->bindParam(':userid', $user2, PDO::PARAM_STR);
					} else {
						$tname->bindParam(':userid', $user1, PDO::PARAM_STR);
					}
					$tname->execute();
					$theirname = $tname->fetch()['fullName'];
					while($row = $req2->fetch())
					{
						?>
						<p> Sent: <?php echo $row['mytimestamp'];?> </p>
						<h6> <?php if ($row['user1'] == $userid){
							echo $myname;
						}else {
							echo $theirname;
						}
						?> Said: </h6>

						<p> <?php 
						echo stripslashes($row['messages']);  ?> </p>
						<hr>

						<?php
					}
					//We display the reply form
					?>

					<a name ="reply"> </a>
					<h3 name="reply">Reply</h3>
					<div class="center">
						<form action="read_pm.php?id=<?php echo $convoid; ?>" method="post">
							<label for="message" class="center">Message</label><br />
							<textarea cols="40" rows="5" name="message" id="message"></textarea><br />
							<input type="submit" value="Send" />
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php
//}
//}
//else
//{
//        echo '<div class="message">You dont have the rights to access this page.</div>';
//}
//}
//else
//{
/*        echo '<div class="message">This discussion does not exists.</div>';
}
}
else
{
        echo '<div class="message">The discussion ID is not defined.</div>';
}
}
else
{
        echo '<div class="message">You must be logged to access this page.</div>';
    } */
    ?>


</body>
</html>