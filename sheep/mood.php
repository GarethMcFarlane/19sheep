
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>19 Sheep - Mood Logger</title>

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
		<script src="js/color.js"></script>
		<link rel="stylesheet" href="css/memustyles.css">
		<link href="css/style.css" rel="stylesheet">
		<link href="css/input.css" rel="stylesheet">

	</head>

	<body data-spy="scroll">
		<div class="container  header-main">
			<div class="icon">
				<img src="img/index/19sleep.png" style="width: 50px; height: 50px;" class="icon">
			</div>
			<div id='cssmenu'>
				<ul>
					<li>
						<a href="index.php">19 Sheep</a>
					</li>
					<li class='active'>
						<a href='mood.php'>Mood Logger</a>
					</li>
					<li>
						<a href='dreamdetail.php'>Dream Analysis</a>
					</li>
					

				</ul>
			</div>
		</div>
		<section id="mood-detail" class="home-section text-center">
			<div class="container">
				<div class="row">
				<div class="row">
					<h3>Mood Record</h3>
				</div>
				<form class="form-horizontal" role="form">
					<div>
						<p>
							Tell us how you are feeling about your dream by linking
						</p>

						<p>
							First choose whether the dream made you feel good, or not good
						</p>
						<p>
							Next, choose if the dream was about your inner reality, or the outside world
						</p>
						<p>
							<b>1)</b> blue with either red or green <b>OR</b>
						</p>

						<p>
							<b>2)</b> yellow with either red or green.
						</p>
					</div>

					<div>
						<fieldset>
							<label for="m1"><div class="triangle" id="tri1"></div></label>
							<input type="radio" value="1"  name="optradio1" id="m1" class="selector"/>

							<label for="m2"><div class="triangle" id="tri2"></div></label>
							<input type="radio" value="0"  name="optradio1" id="m2" class="selector"/>

							<label for="m3"><div class="triangle" id="tri3"></div></label>
							<input type="radio" value="1"  name="optradio2" id="m3" class="selector"/>

							<label for="m4"><div class="triangle" id="tri4"></div></label>
							<input type="radio" value="0"  name="optradio2" id="m4" class="selector"/>
						</fieldset>
						<a href="index.php">
						<input type="button" class="action-button quiz-btn" value="Input more detail" />
						</a>
						<input class="submit action-button quiz-btn" value="Submit" type="submit">

					</div>
				</form>
				</div>
			</div>

		</section>

	</body>

</html>