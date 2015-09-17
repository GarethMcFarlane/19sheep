<!DOCTYPE html>
<html lang="en">

	<head>
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
		<link href="css/animate.css" rel="stylesheet" />
		<!-- Squad theme CSS -->

		<link href="color/default.css" rel="stylesheet">
		<link href="css/social-buttons.css" rel="stylesheet">
		<script src="js/jquery-latest.min.js" type="text/javascript"></script>
		<script src="js/memuscript.js"></script>
		<link rel="stylesheet" href="css/memustyles.css">
		<link href="css/style.css" rel="stylesheet">


		<?php


		include("functions.php");
		ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
		if (!empty($_POST)) {
			$query = "
			SELECT
				userid,
				username,
				password,
				salt,
				email
			FROM 
				users
			WHERE
				email = :email
			";
			$query_params = array(
				':email' => $_POST['email']
				);

			try {
				$stmt = $db->prepare($query);
				$result = $stmt->execute($query_params);
			} catch (PDOException $ex) {
				die("Failed to run query: " . $ex->getMessage());
			}

			$login_ok = false;
			$row = $stmt->fetch();
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
				$_SESSION['username'] = $row["username"];
				header("Location: profile.php");
				die("Login sucessful.  Redirecting to profile.");
			} else {
				echo "<script type=\"text/javascript\">
				alert('login Failed - Please try again.');
				</script>";
			}
		}
		?>







	</head>

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
			<div class="login-home">
				<a class="btn-signin" href="signin.php">Sign in</a>

				<a class="btn-signin" href="signup.php">Sign up</a>
			</div>
		</div>
		<section id="signin">
			<div class="container">
				<div class="row" style="margin-top:60px;">
					<div class="col-md-4 col-md-offset-4 signin-box">
						<form method="POST" action="signin.php" accept-charset="UTF-8" role="form" id="loginform" class="form-signin text-center">
							<fieldset>
								<h3 class="sign-up-title" style="color: #000000; text-align: center">Welcome back! Please sign in</h3>

								<input class="form-control email-title" placeholder="E-mail" name="email" type="text">
								<input class="form-control" placeholder="Password" name="password" value="" type="password">
								<a class="pull-right" href="#" style="color:#FD8A17;">Forgot password?</a>
								<input class="submit action-button " value="Login" type="submit">
								<p class="text-center" style="margin-top:10px;">
									OR
								</p>
								<a class="btn btn-block btn-social btn-facebook"> <i class="fa fa-facebook"></i> Sign in with Facebook </a>
								<a class="btn btn-block btn-social btn-google-plus"> <i class="fa fa-google-plus"></i> Sign in with Google </a>
								<br>
								<p class="text-center">
									<a href="signup.php" style="color:#FD8A17;" >Register for an account?</a>
								</p>
							</fieldset>
						</form>
					</div>
				</div>
			</div>

		</section>
	</body>

</html>