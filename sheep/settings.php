<?php 
session_start();
require("functions.php");

if(empty($_SESSION['email'])){ 
	header("Location: signin.php");  
	die("Redirecting to signin.php"); 
} 

    //Get existing user details.
$user_query = "SELECT fullName, height, weight, gender, birthday, location FROM users WHERE email = :email";
$user_query_params = array(':email' => $_SESSION['email']);


try { 
                // Execute the query 
	$stmt = $db->prepare($user_query); 
	$result = $stmt->execute($user_query_params); 
} 
catch(PDOException $ex) 
{ 
                // Note: On a production website, you should not output $ex->getMessage(). 
                // It may provide an attacker with helpful information about your code.  
	die("Failed to run query: " . $ex->getMessage()); 
} 

$row = $stmt->fetch();

if(!empty($_POST)) { 
	// Make sure the user entered a valid E-Mail address 
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
	{ 
		die("Invalid E-Mail Address"); 
	} 

        // If the user is changing their E-Mail address, we need to make sure that 
        // the new value does not conflict with a value that is already in the system. 
        // If the user is not changing their E-Mail address this check is not needed. 
	if($_POST['email'] != $_SESSION['email']) 
	{ 
            // Define our SQL query 
		$query = " 
		SELECT 
		1 
		FROM users 
		WHERE 
		email = :email 
		"; 

            // Define our query parameter values 
		$query_params = array( 
			':email' => $_POST['email'] 
			); 

		try 
		{ 
                // Execute the query 
			$stmt = $db->prepare($query); 
			$result = $stmt->execute($query_params); 
		} 
		catch(PDOException $ex) 
		{ 
                // Note: On a production website, you should not output $ex->getMessage(). 
                // It may provide an attacker with helpful information about your code.  
			die("Failed to run query: " . $ex->getMessage()); 
		} 

            // Retrieve results (if any) 
		$row = $stmt->fetch(); 
		if($row) 
		{ 
			die("This E-Mail address is already in use"); 
		} 
	} 


	if(!empty($_POST['password'])){ 
		$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
		$password = hash('sha256', $_POST['password'] . $salt); 
		for($round = 0; $round < 65536; $round++){ 
			$password = hash('sha256', $password . $salt); 
		} 
	} else{ 
            // If the user did not enter a new password we will not update their old one. 
		$password = null; 
		$salt = null; 
	}     

	$query_params = array( 
		':email' => $_POST['email']
		);  
        // If the user is changing their password, then we need parameter values for the new password hash and salt too. 
	if($password !== null){ 
		$query_params[':password'] = $password; 
		$query_params[':salt'] = $salt; 
	} 


	$query = " 
	UPDATE users 
	SET 
	email = :email 
	"; 

        // If the user is changing their password, then we extend the SQL query to include the password and salt columns and parameter tokens too. 
	if($password !== null){ 
		$query .= " 
		, password = :password 
		, salt = :salt 
		"; 
	} 
	$query .= " 
	WHERE 
	email = :email 
	";
	try { 
		$stmt = $db->prepare($query); 
		$result = $stmt->execute($query_params); 
	} catch(PDOException $ex){   
		die("Failed to run query: " . $ex->getMessage()); 
	}
        // Now that the user's E-Mail address has changed, the data stored in the $_SESSION array is stale; we need to update it so that it is accurate. 
	$_SESSION['email'] = $_POST['email']; 

	$query = "
	UPDATE users
	SET fullName=:fullName, height=:height, weight=:weight, gender=:gender, birthday=:birthday,location=:location 
	WHERE email=:email
	";
	$query_params = array(':fullName' => $_POST['fullName'], ':height' => $_POST['height'], ':weight' => $_POST['weight'], ':gender' => $_POST['gender'], ':birthday' => $_POST['birthday'], ':location' => $_POST['location'], ':email' => $_SESSION['email']);

	try {
		$stmt = $db -> prepare($query);
		$result = $stmt -> execute($query_params);
		header("Location: settings.php?update=yes");
		die("Redirecting to settings.php"); 
	} catch (PDOException $ex) {
		die("Failed to run query: " . $ex -> getMessage());
		exit();
	}
} 



?> 
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>19 Sheep - Settings</title>

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
				<li class="active">
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
</div>
<section id="signin">
	<div class="container">
		<div class="row" style="margin-top:60px;">
			<div class="col-md-4 col-md-offset-4 signin-box">
				<form method="POST" action="settings.php" accept-charset="UTF-8" role="form" id="signupform" class="form-signin text-center">
					<fieldset>
						<input class="form-control" placeholder="email" name="email" type="text" value="<?php echo htmlentities($_SESSION['email'], ENT_QUOTES, 'UTF-8'); ?>">
						<input class="form-control" placeholder="password" name="password" type="text"  value="">
						<input class="form-control" placeholder="Name" name="fullName" type="text"  value="<?php echo $row['fullName']; ?>">
						<?php 
						if ($row['gender'] == 'm') {
							$gender = 'Male';
							$gender2 = 'Female';
						} else {
							$gender = 'Female';
							$gender2 = 'Male';
						}
						?>
						<select class="form-control" name="gender" size="1">
							<option value="<?php echo strtolower($gender); ?>" selected=""><?php echo $gender; ?></option>
							<option value="<?php echo strtolower($gender2); ?>"><?php echo $gender2; ?></option>
						</select>
						<?php 

						?>
						<input type="date" name="birthday" max="2015-10-09" value="<?php echo $row['birthday'];?>" class="form-control" placeholder="Birth Date: 1900-01-01">
						<input class="form-control unit-input" placeholder="Height" name="height" type="number" min="1" max="300" value ="<?php echo $row['height']; ?>" step="0.1">

						<select class="unit-select" name="height-unit" size="1">
							<option>Meters</option>
							<option>Feet</option>
						</select>

						<input class="form-control unit-input" placeholder="Weight" name="weight" type="number" min="1" max="1000" value ="<?php echo $row['weight']; ?>" step="0.1">

						<select class="unit-select" name="weight-unit" size="1">
							<option>Kilograms</option>
							<option>Pounds</option>
						</select>

						<select class="form-control" name="location" size="1">
							<option value="<?php echo $row['location']; ?>" selected=""><?php echo countryCodeToName($row['location']); ?> </option><option value="--">none </option><option value="AF">Afghanistan </option><option value="AL">Albania </option><option value="DZ">Algeria </option><option value="AS">American Samoa </option><option value="AD">Andorra </option><option value="AO">Angola </option><option value="AI">Anguilla </option><option value="AQ">Antarctica </option><option value="AG">Antigua and Barbuda </option><option value="AR">Argentina </option><option value="AM">Armenia </option><option value="AW">Aruba </option><option value="AU">Australia </option><option value="AT">Austria </option><option value="AZ">Azerbaijan </option><option value="BS">Bahamas </option><option value="BH">Bahrain </option><option value="BD">Bangladesh </option><option value="BB">Barbados </option><option value="BY">Belarus </option><option value="BE">Belgium </option><option value="BZ">Belize </option><option value="BJ">Benin </option><option value="BM">Bermuda </option><option value="BT">Bhutan </option><option value="BO">Bolivia </option><option value="BA">Bosnia and Herzegowina </option><option value="BW">Botswana </option><option value="BV">Bouvet Island </option><option value="BR">Brazil </option><option value="IO">British Indian Ocean Territory </option><option value="BN">Brunei Darussalam </option><option value="BG">Bulgaria </option><option value="BF">Burkina Faso </option><option value="BI">Burundi </option><option value="KH">Cambodia </option><option value="CM">Cameroon </option><option value="CA">Canada </option><option value="CV">Cape Verde </option><option value="KY">Cayman Islands </option><option value="CF">Central African Republic </option><option value="TD">Chad </option><option value="CL">Chile </option><option value="CN">China </option><option value="CX">Christmas Island </option><option value="CC">Cocos (Keeling) Islands </option><option value="CO">Colombia </option><option value="KM">Comoros </option><option value="CG">Congo </option><option value="CD">Congo, the Democratic Republic of the </option><option value="CK">Cook Islands </option><option value="CR">Costa Rica </option><option value="CI">Cote d'Ivoire </option><option value="HR">Croatia (Hrvatska) </option><option value="CU">Cuba </option><option value="CY">Cyprus </option><option value="CZ">Czech Republic </option><option value="DK">Denmark </option><option value="DJ">Djibouti </option><option value="DM">Dominica </option><option value="DO">Dominican Republic </option><option value="TP">East Timor </option><option value="EC">Ecuador </option><option value="EG">Egypt </option><option value="SV">El Salvador </option><option value="GQ">Equatorial Guinea </option><option value="ER">Eritrea </option><option value="EE">Estonia </option><option value="ET">Ethiopia </option><option value="FK">Falkland Islands (Malvinas) </option><option value="FO">Faroe Islands </option><option value="FJ">Fiji </option><option value="FI">Finland </option><option value="FR">France </option><option value="FX">France, Metropolitan </option><option value="GF">French Guiana </option><option value="PF">French Polynesia </option><option value="TF">French Southern Territories </option><option value="GA">Gabon </option><option value="GM">Gambia </option><option value="GE">Georgia </option><option value="DE">Germany </option><option value="GH">Ghana </option><option value="GI">Gibraltar </option><option value="GR">Greece </option><option value="GL">Greenland </option><option value="GD">Grenada </option><option value="GP">Guadeloupe </option><option value="GU">Guam </option><option value="GT">Guatemala </option><option value="GN">Guinea </option><option value="GW">Guinea-Bissau </option><option value="GY">Guyana </option><option value="HT">Haiti </option><option value="HM">Heard and Mc Donald Islands </option><option value="VA">Holy See (Vatican City State) </option><option value="HN">Honduras </option><option value="HK">Hong Kong </option><option value="HU">Hungary </option><option value="IS">Iceland </option><option value="IN">India </option><option value="ID">Indonesia </option><option value="IR">Iran (Islamic Republic of) </option><option value="IQ">Iraq </option><option value="IE">Ireland </option><option value="IL">Israel </option><option value="IT">Italy </option><option value="JM">Jamaica </option><option value="JP">Japan </option><option value="JO">Jordan </option><option value="KZ">Kazakhstan </option><option value="KE">Kenya </option><option value="KI">Kiribati </option><option value="KP">Korea, Democratic People's Republic of </option><option value="KR">Korea, Republic of </option><option value="KW">Kuwait </option><option value="KG">Kyrgyzstan </option><option value="LA">Lao People's Democratic Republic </option><option value="LV">Latvia </option><option value="LB">Lebanon </option><option value="LS">Lesotho </option><option value="LR">Liberia </option><option value="LY">Libyan Arab Jamahiriya </option><option value="LI">Liechtenstein </option><option value="LT">Lithuania </option><option value="LU">Luxembourg </option><option value="MO">Macau </option><option value="MK">Macedonia, The Former Yugoslav Republic of </option><option value="MG">Madagascar </option><option value="MW">Malawi </option><option value="MY">Malaysia </option><option value="MV">Maldives </option><option value="ML">Mali </option><option value="MT">Malta </option><option value="MH">Marshall Islands </option><option value="MQ">Martinique </option><option value="MR">Mauritania </option><option value="MU">Mauritius </option><option value="YT">Mayotte </option><option value="MX">Mexico </option><option value="FM">Micronesia, Federated States of </option><option value="MD">Moldova, Republic of </option><option value="MC">Monaco </option><option value="MN">Mongolia </option><option value="MS">Montserrat </option><option value="MA">Morocco </option><option value="MZ">Mozambique </option><option value="MM">Myanmar </option><option value="NA">Namibia </option><option value="NR">Nauru </option><option value="NP">Nepal </option><option value="NL">Netherlands </option><option value="AN">Netherlands Antilles </option><option value="NC">New Caledonia </option><option value="NZ">New Zealand </option><option value="NI">Nicaragua </option><option value="NE">Niger </option><option value="NG">Nigeria </option><option value="NU">Niue </option><option value="NF">Norfolk Island </option><option value="MP">Northern Mariana Islands </option><option value="NO">Norway </option><option value="OM">Oman </option><option value="PK">Pakistan </option><option value="PW">Palau </option><option value="PA">Panama </option><option value="PG">Papua New Guinea </option><option value="PY">Paraguay </option><option value="PE">Peru </option><option value="PH">Philippines </option><option value="PN">Pitcairn </option><option value="PL">Poland </option><option value="PT">Portugal </option><option value="PR">Puerto Rico </option><option value="QA">Qatar </option><option value="RE">Reunion </option><option value="RO">Romania </option><option value="RU">Russian Federation </option><option value="RW">Rwanda </option><option value="KN">Saint Kitts and Nevis </option><option value="LC">Saint LUCIA </option><option value="VC">Saint Vincent and the Grenadines </option><option value="WS">Samoa </option><option value="SM">San Marino </option><option value="ST">Sao Tome and Principe </option><option value="SA">Saudi Arabia </option><option value="SN">Senegal </option><option value="SC">Seychelles </option><option value="SL">Sierra Leone </option><option value="SG">Singapore </option><option value="SK">Slovakia (Slovak Republic) </option><option value="SI">Slovenia </option><option value="SB">Solomon Islands </option><option value="SO">Somalia </option><option value="ZA">South Africa </option><option value="GS">South Georgia and the South Sandwich Islands </option><option value="ES">Spain </option><option value="LK">Sri Lanka </option><option value="SH">St. Helena </option><option value="PM">St. Pierre and Miquelon </option><option value="SD">Sudan </option><option value="SR">Suriname </option><option value="SJ">Svalbard and Jan Mayen Islands </option><option value="SZ">Swaziland </option><option value="SE">Sweden </option><option value="CH">Switzerland </option><option value="SY">Syrian Arab Republic </option><option value="TW">Taiwan, Province of China </option><option value="TJ">Tajikistan </option><option value="TZ">Tanzania, United Republic of </option><option value="TH">Thailand </option><option value="TG">Togo </option><option value="TK">Tokelau </option><option value="TO">Tonga </option><option value="TT">Trinidad and Tobago </option><option value="TN">Tunisia </option><option value="TR">Turkey </option><option value="TM">Turkmenistan </option><option value="TC">Turks and Caicos Islands </option><option value="TV">Tuvalu </option><option value="UG">Uganda </option><option value="UA">Ukraine </option><option value="AE">United Arab Emirates </option><option value="GB">United Kingdom </option><option value="US">United States </option><option value="UM">United States Minor Outlying Islands </option><option value="UY">Uruguay </option><option value="UZ">Uzbekistan </option><option value="VU">Vanuatu </option><option value="VE">Venezuela </option><option value="VN">Viet Nam </option><option value="VG">Virgin Islands (British) </option><option value="VI">Virgin Islands (U.S.) </option><option value="WF">Wallis and Futuna Islands </option><option value="EH">Western Sahara </option><option value="YE">Yemen </option><option value="YU">Yugoslavia </option><option value="ZM">Zambia </option><option value="ZW">Zimbabwe </option>
						</select>
						<br>
						<input class="submit action-button" value="Reset" type="reset">
						<input class="submit action-button" value="Submit" type="submit">
					</fieldset>
				</form>
			</div>
		</div>
		<?php
		if ($_GET['update'] == 'yes') {
		?>
		<div class="alert alert-success col-md-4 col-md-offset-4" role="alert">Details updated successfully</div>
		<?php
		}
		?>
	</div>
</section>
<script src="js/jquery-latest.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.easing.min.js" type="text/javascript"></script>
</body>

</html>
