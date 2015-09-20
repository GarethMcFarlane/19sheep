<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>19 Sheep - Message</title>

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
	</head>
<body>
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
<?php

//We check if the user is logged
//if(isset($_SESSION['username']))
//{
// for now hardcode the user
$userid = 3;
//We check if the ID of the discussion is defined

//if(isset($_GET['id'])) {
$convoid = intval($_GET['id']);
$db_host = "localhost";
$db_name = "messagedb";
$db_user = "root";
$db_pass = "";

try {
	$db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
} catch (PDOException $e) {
	echo 'Connection failed: ' . $e->getMessage();
}
		
$req1 = $db->prepare('SELECT * FROM pm WHERE(convoid = :id)');
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
		$msubmit = $db->prepare('INSERT INTO pm (id, convoid, title, user1, user2, message, timestamp, user1read, user2read) VALUES (:id, :convoid, :title, :user1, :user2, :message, NOW(), :user1read, :user2read)');
		
		$idrow = $db->query('SELECT count(*) FROM PM');
		$id = ($idrow->fetch()[0] + 1);

		$msubmit->bindParam(':id', $id, PDO::PARAM_INT);
		$msubmit->bindParam(':convoid', $convoid, PDO::PARAM_INT);
		$msubmit->bindParam(':title', $title, PDO::PARAM_INT);
		$msubmit->bindParam(':user1', $userid, PDO::PARAM_INT);
		$msubmit->bindParam(':message', $message);
		//$msubmit->bindParam(':timestamp', time());
		
		$false = FALSE;
		$true = TRUE;
		
		$msubmit->bindParam(':user1read', $true, PDO::PARAM_INT);
		$msubmit->bindParam(':user2read', $false, PDO::PARAM_INT);
		
		//user 1 is always the initiating sender, user2 is the reciever
		if ($userid == $user1) {	
			$msubmit->bindParam(':user2', $user2, PDO::PARAM_INT);
		} else {
			$msubmit->bindParam(':user2', $user1, PDO::PARAM_INT);
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
				$req2 = $db->prepare('SELECT * FROM pm WHERE(convoid = :id)');
				$req2->bindParam(':id', $convoid, PDO::PARAM_INT);
				$req2->execute();
				
				$Qname = $db->prepare('SELECT username FROM users WHERE (id = :userid)');
				$Qname->bindParam(':userid', $userid, PDO::PARAM_INT);
				$Qname->execute();
				$myname = $Qname->fetch()[0];
				
				$tname = $db->prepare('SELECT username FROM users WHERE (id = :userid)');
				// if I am user 1, we take user2's name as the other convo name
				// otherwise, we take user1's
				if ($user1 == $userid){
					$tname->bindParam(':userid', $user2, PDO::PARAM_INT);
				} else {
					$tname->bindParam(':userid', $user1, PDO::PARAM_INT);
				}
				$tname->execute();
				$theirname = $tname->fetch()[0];
				while($row = $req2->fetch())
				{
				?>
					 <p> Sent: <?php echo $row['timestamp'];?> </p>
					 <h6> <?php if ($row['user1'] == $userid){
							echo $myname;
							}else {
							echo $theirname;
							}
							?> Said: </h6>
							
					 <p> <?php 
								echo stripslashes($row['message']);  ?> </p>
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