<!DOCTYPE html>
<html lang="en">

<head>
<?php
session_start();
if (isset($_SESSION['email'])) {
	//User isn't logged in, return to login page.
	header("Location: profile.php");
}
	?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>19 Sheep - Log in</title>

	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">

	<!-- Fonts -->
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="css/nivo-lightbox.css" rel="stylesheet" />
	<link href="css/nivo-lightbox-theme/default/default.css" rel="stylesheet" type="text/css" />
	<!-- Squad theme CSS -->

	<link href="color/default.css" rel="stylesheet">
	<link href="css/social-buttons.css" rel="stylesheet">
	<script src="js/jquery-latest.min.js" type="text/javascript"></script>
	<script src="js/memuscript.js"></script>
	<link rel="stylesheet" href="css/memustyles.css">
	<link href="css/style.css" rel="stylesheet">

	<!-- Google API -->
	<meta name="google-signin-scope" content="profile email">
	<meta name="google-signin-client_id" content="618831851623-r74ltuc7ffsmnc1imf5blqo2ldkc87j4.apps.googleusercontent.com">
	<script src="https://apis.google.com/js/platform.js" async defer></script>

	<?php

	include ("functions.php");
	session_start();

	if ($_SESSION['loggedin'] == 1) {
		header('Location: profile.php');
	}
	if (!empty($_POST)) {
		$query = "
		SELECT
		userid,
		password,
		salt,
		email,
		OAuthToken,
		OAuthTokenSecret
		FROM 
		users
		WHERE
		email = :email
		";
		$query_params = array(':email' => $_POST['email']);

		try {
			$stmt = $db -> prepare($query);
			$result = $stmt -> execute($query_params);
		} catch (PDOException $ex) {
			die("Failed to run query: " . $ex -> getMessage());
		}

		$login_ok = false;
		$row = $stmt -> fetch();
		if ($row) {
			$check_password = hash('sha256', $_POST['password'] . $row['salt']);
			for ($round = 0; $round < 65536; $round++) {
				$check_password = hash('sha256', $check_password . $row['salt']);
			}

			if ($check_password === $row['password']) {
				$login_ok = true;
			}
		}
		if ($login_ok) {
			unset($row['salt']);
			unset($row['password']);
			$_SESSION['email'] = $row['email'];
			$_SESSION['loggedin'] = 1;
			if (!is_null($row['OAuthToken'])) {
				$_SESSION['OAuthToken'] = $row['OAuthToken'];
				$_SESSION['OAuthTokenSecret'] = $row['OAuthTokenSecret'];
				$_SESSION['userid'] = $row['userid'];
			}

			header("Location: profile.php");
			die("Login sucessful.  Redirecting to profile.");
		} else {
			echo "<script type=\"text/javascript\">
			alert('login Failed - Please try again.');
		</script>";
		}
	}
?>


<script>
	function onSignIn(googleUser) {
		var profile = googleUser.getBasicProfile();
		console.log('Name: ' + profile.getName());
		console.log('Email: ' + profile.getEmail());
	}
</script>




</head>

<body data-spy="scroll">
	<div class="container  header-main">
		
		<div id="cssmenu" style="width: 100%;">
				<ul>
				<li  class="active">
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
				<li>
					<a href='message.php'>My Messages</a>
				</li>
				<li>
					<a href='http://shop.19sheep.com'>My Shop</a>
				</li>

					<li style="float:right;">
						<a href="signin.php">LOGIN</a>
					</li>
					<li style="float:right;">
						<a href="signup.php">SIGN UP</a>
					</li>
				</ul>

			</div>
	</div>
	<section id="signin">
		<div class="container">
			<div class="row" style="margin-top:60px;">
				<div class="col-md-4 col-md-offset-4 signin-box">
					<form method="POST" action="signin.php" accept-charset="UTF-8" role="form" id="loginform" class="form-signin text-center">
						<fieldset>
							<input class="form-control email-title" placeholder="E-mail" name="email" type="text">
							<input class="form-control" placeholder="Password" name="password" value="" type="password">
							<input class="submit action-button" value="Login" type="submit">
							<p style="margin-top: 30px; font-size: 14px;">Login with Google Account</p>
							<div align="center" class="g-signin2" data-onsuccess="onSignIn"></div>
							<br>
							<a href="signup.php">Register for an account?</a>
						</fieldset>
					</form>
				</div>
			</div>
		</div>

	</section>
</body>

</html>
