



<!DOCTYPE html>
<?php
	session_start();
	require_once("functions.php");
?>

<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>19 Sheep - Commitment</title>

		<!-- Bootstrap Core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">

		<!--//Fonts -->
		<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="css/nivo-lightbox.css" rel="stylesheet" />
		<link href="css/nivo-lightbox-theme/default/default.css" rel="stylesheet" type="text/css" />
		<link href="css/animate.css" rel="stylesheet" />
		<!-- //Squad theme CSS -->

		<link href="color/default.css" rel="stylesheet">
		<link href="css/social-buttons.css" rel="stylesheet">
		<script src="js/jquery-latest.min.js" type="text/javascript"></script>
		<script src="js/memuscript.js"></script>
		<link rel="stylesheet" href="css/memustyles.css">
		<link href="css/style.css" rel="stylesheet">
		<link href="styles.css" type="text/css" rel="stylesheet">	
	</head>

	<?php
	if (!empty($_POST)) {
		if (empty($_POST['targetperday'])) {
            die("Please enter a goal per day");
			exit();
        }
        if (empty($_POST['deadline'])) {
            die("Please enter a deadline");
			exit();
        }
        if (empty($_POST['text'])) {
            die("Please enter text");
			exit();
        }
		if (empty($_POST['type'])) {
            die("Please enter the type of goal  you want to achieve");
			exit();
        }
		
	$query = " INSERT INTO commitments (targetperday, startday, deadline, text, isachieved, type, email) 
			   VALUES (:email, :targetperday, CURDATE(), :deadline, :text, 0, :type)";
	
	 
	 $query_params = array(
        ':targetperday' => $_POST['targetperday'],
		':deadline' => $_POST['deadline'],
		':text' => $_POST['text'],
		':type' => $_POST['type'],
		':email' => $_SESSION['email']
    );
	
	try {
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    } catch (PDOException $ex) {
        die("Failed to run query: " . $ex->getMessage());
		exit();
    }
	
}
?>
	<body>

		<script type="text/javascript" src="functionsJquery.js"></script>
		<body data-spy="scroll">
		<div class="container  header-main">
			<div class="icon">
				<img src="img/index/19sleep.png" style="width: 50px; height: 50px;" class="icon">
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
					<a href='commitments.php'>My commitment</a>
				</li>
				<li>
					<a href='message.php'>Messages</a>
				</li>
			</ul>
		</div>
		</div>
		
		<header>COMMITMENTS PAGE</header>
		
		<div name="stuff1" id="stuff1"></div>
		
		<section class="sections">
			<div class="container">
				<div class="row">
					<div class="textCommit">
						<form method="POST" action="commitments.php" accept-charset="UTF-8" role="form" id="signupform" class="form-signin text-center">
							<fieldset>
								<h3 class="sign-up-title" style="color: #000000; text-align: center">Provide more detail!</h3>

								<label>Type:</label>
								<select class="form-control" id="Type" name="type">
									<option value="" selected="">(please select a type) </option>
									<option value="Intense Activity">Intense Activity</option>
									<option value="Medium Activity">Medium Activity</option>
									<option value="Light Activity">Light Activity</option>
									<option value="Steps">Steps</option>
									<option value="Weight">Weight</option>
									<option value="Blood Pressure">Blood Pressure</option>
									<option value="Total Sleep">Total Sleep</option>
									<option value="Wake-ups">Wake-ups</option>
									<option value="Evening Sleep">Evening Sleep</option>
									<option value="Morning Sleep">Morning Sleep</option>
									<option value="Sleep Score">Sleep Score</option>
								</select>
								<label>Target:</label>
								<input type="text" name="targetperday" class="form-control" id="Target" required="required">
								<label>Goal date:</label>
								<input class="form-control" name="deadline" type="date" id="GoalDate" required="required">

								<label>Make a commitment:</label>
								<input class="form-control" name="text" type="text" id="Commit" required="required">
								<br>
								<input class="submit btn btn-success" id="submit" value="Submit" type="submit">
								<input class="submit btn btn-warning" value="Reset" type="reset">
							</fieldset>
						</form>
					</div>
					<div id="treeLine"></div>
					<div class="commitDivsStyle" id="commitDivs"></div>
					<div class="noneSubmitStyle" id="noneSubmit">You have not submitted any committments</div>
					
					<?php
					$query2 = "SELECT * FROM commitments WHERE (email = :email)";


					$query_params2 = array(
						':email' => $_SESSION['email']
						);

					try {
						$stmt2 = $db->prepare($query2);
						$result2 = $stmt2->execute($query_params2);
					} catch (PDOException $ex) {
						die("Failed to run query: " . $ex->getMessage());
						exit();
					}

					$commitments = $stmt2->fetchAll();
					var_dump($commitments);
					?>
				</div>
			</div>
		</section>
	</body>
</html>