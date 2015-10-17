<?php require_once("functions.php"); 
?>
<?php
    if (!empty($_POST)) {

        if (empty($_POST['password'])) {
            die("Please enter a password.");
			exit();
        }
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            die("Invalid E-Mail Address");
			exit();
        }
        if ($_POST['password'] != $_POST['passwordconfirm']) {
        	die("Passwords don\'t match");
        	exit();
        }
        $query = "
            SELECT
                1
            FROM users
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

        $row = $stmt->fetch();

        if ($row) {
            die("This email address is already registered");
			exit();
        }
        $query = "
            INSERT INTO users (
                password,
                salt,
                email
            ) VALUES (
                :password,
                :salt,
                :email
            )
        ";
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
        $password = hash('sha256', $_POST['password'] . $salt);
        for ($round = 0; $round < 65536; $round++) {
            $password = hash('sha256', $password . $salt);
        }
        $query_params = array(
            ':password' => $password,
            ':salt' => $salt,
            ':email' => $_POST['email']
        );

        try {
            $stmt = $db->prepare($query);

            $result = $stmt->execute($query_params);
        } catch (PDOException $ex) {
            die("Failed to run query: " . $ex->getMessage());
			exit();
        }
        $_SESSION['email'] = $_POST['email'];
        header("Location: signupdetail.php");
        die("Redirecting to login.php");
		//exit();
    }
    ?>
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

		<title>19 Sheep - Sign up</title>

		<!-- Bootstrap Core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">

		<!-- Fonts -->
		<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="css/nivo-lightbox.css" rel="stylesheet" />
		<link href="css/nivo-lightbox-theme/default/default.css" rel="stylesheet" type="text/css" />
		<!-- Squad theme CSS -->

		<link href="color/default.css" rel="stylesheet">
		<script src="js/jquery-latest.min.js" type="text/javascript"></script>
		<script src="js/memuscript.js"></script>
		<link rel="stylesheet" href="css/memustyles.css">
		<link href="css/style.css" rel="stylesheet">

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
						<form method="POST" action="signup.php" accept-charset="UTF-8" role="form" id="signupform" class="form-signin text-center">
							<fieldset>
								<input class="form-control" placeholder="E-mail" name="email" type="text" required="required">
								<input class="form-control" placeholder="Password" name="password" value="" type="password" required="required">
								<input class="form-control" placeholder="Confirm Password" name="passwordconfirm" value="" type="password" required="required">
								
								<input class="submit action-button" value="Reset" type="reset">
								<input class="submit action-button" value="Submit" type="submit">
							</fieldset>
						</form>
					</div>
				</div>
			</div>

		</section>

	</body>

</html>