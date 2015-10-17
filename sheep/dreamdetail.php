<!DOCTYPE html>
<html lang="en">

<head>
<?php
session_start();
if (!isset($_SESSION['email'])) {
	//User isn't logged in, return to login page.
	header("Location: signin.php");
}
	?>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>19 Sheep - Dream Analysis</title>

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
				<li class="active">
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
		<section id="signin">
			<div style="margin-top: 60px; padding-left: 20px;">
				<?php if ($_SESSION['email'] == 'damian@inceptionstrategies.com' || $_SESSION['email'] == 'testuser@gmail.com') {?>
				<a href="dreamdetailreview.php" class="btn" role="button" style="width: 140px; max-width: 140px; margin-left: 10px; margin-bottom: 20px;">User Dreams</a>
				<?php } ?>
			</div>
			<div class="container">
				
				<div class="row hidden tut_video" id="tut_video">
					<h3 class="sign-up-title" style="color: #000000;">How to log your dream</h3>
					<iframe src="https://player.vimeo.com/video/142584057" width="650" height="400" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
<p><a href="https://vimeo.com/142584057">Dream Logger Tutorial</a> from <a href="https://vimeo.com/inceptionstrategies">damian</a> on <a href="https://vimeo.com">Vimeo</a>.</p>
		
				</div>
				<div class="row">
					<form method="POST" action="dreamdetailreview.php" accept-charset="UTF-8" role="form" id="dream-detail-form" class="dream-form">
						<fieldset>
							<div class = "container">
								<h3 class="sign-up-title" style="color: #000000;">Tell us more about your dream</h3>
								<p>
									You can find a tutorial video <a id="tut_link" href="#tutvideo">here</a>, click again to hide video.
								</p>
								<p>
									Was the dream
								</p>
							</div>
							<div class="container">
								<label class="btn">
									<input type="radio" name="emotion" id="option1" value="Yes" >
									Good </label>
								<label class="btn">
									<input type="radio" name="emotion" id="option2" value="No">
									Not Good </label>
							</div>
						</fieldset>
						<hr>
						<fieldset>
							<div class = "container ">
								<h3> Dream Actors </h3>
							</div>
							<div class="left-selections">
								<label class="checkbox">
									<input type="checkbox" value="You" name="actors[]">
									You</label>
								<label class="checkbox">
									<input type="checkbox" value="Partner" name="actors[]">
									Partner</label>
								<label class="checkbox">
									<input type="checkbox" value="Ex-Partner" name="actors[]">
									Ex Partner</label>
								<label class="checkbox">
									<input type="checkbox" value="Father" name="actors[]">
									Father</label>
								<label class="checkbox">
									<input type="checkbox" value="Mother" name="actors[]">
									Mother</label>
								<label class="checkbox">
									<input type="checkbox" value="Son" name="actors[]">
									Son</label>
								<label class="checkbox">
									<input type="checkbox" value="Daughter" name="actors[]">
									Daughter</label>
								<label class="checkbox">
									<input type="checkbox" value="Grandfather" name="actors[]">
									Grandfather</label>
								<label class="checkbox">
									<input type="checkbox" value="Grandmother" name="actors[]">
									Grandmother</label>
								<label class="checkbox">
									<input type="checkbox" value="Uncle" name="actors[]">
									Uncle</label>
								<label class="checkbox">
									<input type="checkbox" value="Aunt" name="actors[]">
									Aunt</label>
								<label class="checkbox">
									<input type="checkbox" value="Cousin" name="actors[]">
									Cousin</label>
								<label class="checkbox">
									<input type="checkbox" value="Friend" name="actors[]">
									Friend</label>
								<label class="checkbox">
									<input type="checkbox" value="Boss" name="actors[]">
									Boss</label>
								<label class="checkbox">
									<input type="checkbox" value="Co-Worker" name="actors[]">
									co-worker</label>
								<label class="checkbox">
									<input type="checkbox" value="Total Stranger" name="actors[]">
									Total Stranger</label>
								<label class="checkbox">
									<input type="checkbox" value="Pet" name="actors[]">
									Pet</label>
								<label class="checkbox">
									<input type="checkbox" value="Animal" name="actors[]">
									Animal</label>
								<label class="checkbox">
									<input type="checkbox" value="Tree/Plant" name="actors[]">
									Tree/Plant</label>
								<label class="checkbox">
									<input type="checkbox" value="Other" name="actors[]">
									Other <i>-Please State</i></label>
							</div>
						</fieldset>
						<hr>
						<fieldset>
							<div class = "container">
								<h3> Your role in the dream? </h3>
							</div>
							<div class = "left-selections">
								<label class="checkbox">
									<input type="checkbox" value="Carer" name="yourrole[]">
									Carer</label>
								<label class="checkbox">
									<input type="checkbox" value="Lover" name="yourrole[]">
									Lover</label>
								<label class="checkbox">
									<input type="checkbox" value="Teacher" name="yourrole[]">
									Teacher</label>
								<label class="checkbox">
									<input type="checkbox" value="Adventurer" name="yourrole[]">
									Adventurer</label>
								<label class="checkbox">
									<input type="checkbox" value="Supporter" name="yourrole[]">
									Supporter</label>

								<label class="checkbox">
									<input type="checkbox" value="Message Deliverer" name="yourrole[]">
									Message Deliverer</label>
								<label class="checkbox">
									<input type="checkbox" value="Worker" name="yourrole[]">
									Worker</label>
								<label class="checkbox">
									<input type="checkbox" value="Friend" name="yourrole[]">
									Friend</label>
								<label class="checkbox">
									<input type="checkbox" value="Other" name="yourrole[]">
									Other <i> - Please State</i></label>
							</div>
						</fieldset>
						<hr>
						<fieldset>
							<div class = "container ">

								<h3> Their role in the dream? </h3>
							</div>
							<div class = "left-selections">
								<label class="checkbox">
									<input type="checkbox" value="Carer" name="theirrole[]">
									Carer</label>
								<label class="checkbox">
									<input type="checkbox" value="Lover" name="theirrole[]">
									Lover</label>
								<label class="checkbox">
									<input type="checkbox" value="Teacher" name="theirrole[]">
									Teacher</label>
								<label class="checkbox">
									<input type="checkbox" value="Adventurer" name="theirrole[]">
									Adventurer</label>
								<label class="checkbox">
									<input type="checkbox" value="Supporter" name="theirrole[]">
									Supporter</label>

								<label class="checkbox">
									<input type="checkbox" value="Message Deliverer" name="theirrole[]">
									Message Deliverer</label>
								<label class="checkbox">
									<input type="checkbox" value="Worker" name="theirrole[]">
									Worker</label>
								<label class="checkbox">
									<input type="checkbox" value="Friend" name="theirrole[]">
									Friend</label>
								<label class="checkbox">
									<input type="checkbox" value="Other" name="theirrole[]">
									Other <i> - Please State</i></label>
							</div>
						</fieldset>
						<hr>
						<fieldset>
							<div class = "container ">

								<h3> Dream Theme </h3>
							</div>
							<div class = "left-selections">
								<label class="checkbox">
									<input type="checkbox" value="Love" name="theme[]">
									Love</label>
								<label class="checkbox">
									<input type="checkbox" value="Compassion" name="theme[]">
									Compassion</label>
								<label class="checkbox">
									<input type="checkbox" value="Tolerance" name="theme[]">
									Tolerance</label>
								<label class="checkbox">
									<input type="checkbox" value="Learning" name="theme[]">
									Learning</label>
								<label class="checkbox">
									<input type="checkbox" value="Support" name="theme[]">
									Support</label>

								<label class="checkbox">
									<input type="checkbox" value="Teaching" name="theme[]">
									Teaching</label>
								<label class="checkbox">
									<input type="checkbox" value="Desire" name="theme[]">
									Desire</label>
								<label class="checkbox">
									<input type="checkbox" value="Affection" name="theme[]">
									Affection</label>
								<label class="checkbox">
									<input type="checkbox" value="Sexuality" name="theme[]">
									Sexuality</label>
								<label class="checkbox">
									<input type="checkbox" value="Joy" name="theme[]">
									Joy</label>

								<label class="checkbox">
									<input type="checkbox" value="Ecstasy" name="theme[]">
									Ecstasy</label>
								<label class="checkbox">
									<input type="checkbox" value="Adventure" name="theme[]">
									Adventure</label>
								<label class="checkbox">
									<input type="checkbox" value="Betrayal" name="theme[]">
									Betrayal</label>
								<label class="checkbox">
									<input type="checkbox" value="Jealousy" name="theme[]">
									Jealousy</label>
								<label class="checkbox">
									<input type="checkbox" value="Envy" name="theme[]">
									Envy</label>

								<label class="checkbox">
									<input type="checkbox" value="Anger" name="theme[]">
									Anger</label>
								<label class="checkbox">
									<input type="checkbox" value="Voilence" name="theme[]">
									Violence</label>
								<label class="checkbox">
									<input type="checkbox" value="Guilt" name="theme[]">
									Guilt</label>
								<label class="checkbox">
									<input type="checkbox" value="Escape" name="theme[]">
									Escape</label>
								<label class="checkbox">
									<input type="checkbox" value="Trapped" name="theme[]">
									Trapped</label>
								<label class="checkbox">
									<input type="checkbox" value="Isolation" name="theme[]">
									Isolation</label>

								<label class="checkbox">
									<input type="checkbox" value="Other" name="theme[]">
									Other <i> - Please State</i></label>
							</div>
						</fieldset>
						<hr>
						<fieldset>
							<div class = "container ">
								<h3> Dream lighting </h3>
							</div>
							<div class = "left-selections">
								<label class="checkbox">
									<input type="checkbox" value="Intense lights/Colours" name="lighting[]">
									Intense lights/Colours</label>
								<label class="checkbox">
									<input type="checkbox" value="Normal" name="lighting[]">
									Normal</label>
								<label class="checkbox">
									<input type="checkbox" value="Grey, barren expanse of nothing" name="lighting[]">
									Grey, barren expanse of nothing</label>
							</div>
						</fieldset>
						<hr>
						<fieldset>
							<div class = "container ">

								<h3> Dream Clarity </h3>
							</div>
							<div class = "left-selections">
								<label class="checkbox">
									<input type="checkbox" value="Heaven-like bliss" name="clarity[]">
									Heaven-like bliss</label>
								<label class="checkbox">
									<input type="checkbox" value="Super emotional HD" name="clarity[]">
									Super emotional HD</label>
								<label class="checkbox">
									<input type="checkbox" value="Very Clear" name="clarity[]">
									Very Clear</label>
								<label class="checkbox">
									<input type="checkbox" value="Average" name="clarity[]">
									Average</label>
								<label class="checkbox">
									<input type="checkbox" value="Fuzzy" name="clarity[]">
									Fuzzy</label>
								<label class="checkbox">
									<input type="checkbox" value="Hard to make out" name="clarity[]">
									Hard to make out</label>
							</div>
						</fieldset>
						<hr>
						<fieldset>
							<div class = "container ">
								<h3> Dream Power </h3>
							</div>
							<div class = "left-selections">
								<label class="checkbox">
									<input type="checkbox" value="can guide or fly" name="power[]">
									can glide or fly</label>
								<label class="checkbox">
									<input type="checkbox" value="can levitate" name="power[]">
									can levitate</label>
								<label class="checkbox">
									<input type="checkbox" value="can walk above ground" name="power[]">
									can walk above ground</label>
								<label class="checkbox">
									<input type="checkbox" value="can breathe underwater" name="power[]">
									can breathe underwater</label>
								<label class="checkbox">
									<input type="checkbox" value="can change myself into living things" name="power[]">
									can change myself into living things</label>
								<label class="checkbox">
									<input type="checkbox" value="experience telepathy" name="power[]">
									experience telepathy</label>
								<label class="checkbox">
									<input type="checkbox" value="can sing amazingly" name="power[]">
									can sing amazingly</label>
								<label class="checkbox">
									<input type="checkbox" value="hear amazing sounds" name="power[]">
									hear amazing sounds</label>
								<label class="checkbox">
									<input type="checkbox" value="can travel through solid objects" name="power[]">
									can travel through solid objects</label>
								<label class="checkbox">
									<input type="checkbox" value="teleport to other destinations" name="power[]">
									teleport to other destinations</label>
								<label class="checkbox">
									<input type="checkbox" value="can build things by wil" name="power[]">
									can build things by will</label>
								<label class="checkbox">
									<input type="checkbox" value="can destroy things by will" name="power[]">
									can destroy things by will</label>
								<label class="checkbox">
									<input type="checkbox" value="can see or communicate with people who have passed" name="power[]">
									can see or communicate with people who have passed</label>
								<label class="checkbox">
									<input type="checkbox" value="witness the past" name="power[]">
									witness the past</label>
								<label class="checkbox">
									<input type="checkbox" value="ee future alternatives" name="power[]">
									see future alternatives</label>
								<label class="checkbox">
									<input type="checkbox" value="can communicate with animals" name="power[]">
									can communicate with animals</label>
								<label class="checkbox">
									<input type="checkbox" value="an communicate with plants/trees" name="power[]">
									can communicate with plants/trees</label>
								<label class="checkbox">
									<input type="checkbox" value="attract wealth" name="power[]">
									attract wealth</label>
								<label class="checkbox">
									<input type="checkbox" value="good health" name="power[]">
									good health</label>
							</div>
						</fieldset>
						<hr>
						<fieldset>
							<div class = "container ">

								<h3> Dream Blocks </h3>
							</div>
							<div class = "left-selections">
								<label class="checkbox">
									<input type="checkbox" value="can't walk" name="blocks[]">
									can't walk</label>
								<label class="checkbox">
									<input type="checkbox" value="can't run" name="blocks[]">
									can't run</label>
								<label class="checkbox">
									<input type="checkbox" value="can't talk" name="blocks[]">
									can't talk</label>
								<label class="checkbox">
									<input type="checkbox" value="can't hear" name="blocks[]">
									can't hear</label>
								<label class="checkbox">
									<input type="checkbox" value="can't breathe" name="blocks[]">
									can't breathe</label>
								<label class="checkbox">
									<input type="checkbox" value="being chased" name="blocks[]">
									being chased</label>
								<label class="checkbox">
									<input type="checkbox" value="walking naked in front of people" name="blocks[]">
									walking naked in front of people</label>
								<label class="checkbox">
									<input type="checkbox" value="can't find something" name="blocks[]">
									can't find something</label>
								<label class="checkbox">
									<input type="checkbox" value="lost friends" name="blocks[]">
									lost friends</label>
								<label class="checkbox">
									<input type="checkbox" value="lost famil" name="blocks[]">
									lost family</label>
								<label class="checkbox">
									<input type="checkbox" value="lost partner" name="blocks[]">
									lost partner</label>
								<label class="checkbox">
									<input type="checkbox" value="lost children" name="blocks[]">
									lost children</label>
								<label class="checkbox">
									<input type="checkbox" value="poverty" name="blocks[]">
									poverty</label>
								<label class="checkbox">
									<input type="checkbox" value="illness" name="blocks[]">
									illness</label>
								<label class="checkbox">
									<input type="checkbox" value="dying" name="blocks[]">
									dying</label>
								<label class="checkbox">
									<input type="checkbox" value="dead" name="blocks[]">
									dead</label>
								<label class="checkbox">
									<input type="checkbox" value="can't think straight" name="blocks[]">
									can't think straight</label>
							</div>
						</fieldset>
						<hr>
						<fieldset>
							<div class = "container ">
								<h3> Dream Physics </h3>
							</div>
							<div class = "left-selections">
								<label class="checkbox">
									<input type="checkbox" value="like normal waking day" name="physiscs[]">
									like normal waking day</label>
								<label class="checkbox">
									<input type="checkbox" value="atmosphere thicker and more viscous" name="physiscs[]">
									atmosphere thicker and more viscous</label>
								<label class="checkbox">
									<input type="checkbox" value="super heavy gravity" name="physiscs[]">
									super heavy gravity</label>
								<label class="checkbox">
									<input type="checkbox" value="atmosphere watery" name="physiscs[]">
									atmosphere watery</label>
								<label class="checkbox">
									<input type="checkbox" value="atmosphere electric and humming" name="physiscs[]">
									atmosphere electric and humming</label>
							</div>
						</fieldset>
						<hr>
						<fieldset>
							<div class = "container ">
								<h3> Dream Lucidity </h3>
							</div>
							<div class = "left-selections">
								<label class="checkbox">
									<input type="checkbox" value="woke up too soon" name="lucidity[]">
									woke up too soon</label>
								<label class="checkbox">
									<input type="checkbox" value="very lucid" name="lucidity[]">
									very lucid</label>
								<label class="checkbox">
									<input type="checkbox" value="mildly lucid" name="lucidity[]">
									mildly lucid</label>
								<label class="checkbox">
									<input type="checkbox" value="not lucid - difficulty remembering" name="lucidity[]">
									not lucid - difficulty remembering</label>
							</div>
						</fieldset>
						<hr>
						<fieldset>
							<div class ="container ">
								<h3> Description of your dream </h3>
							</div>
							<div class="left-selections">
								<label for="comment">Dream Details:</label>
								<textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
							</div>
							<br>
							<div class="agreement">
								<label class="checkbox">
									<input type="checkbox" value="Yes" name="assistme">
									 I would like 19 sheep to assist me interpreting this dream</label>
							</div>
							<input class="btn submit" value="Reset" type="reset">
							<input class="btn submit" value="Submit" type="submit">

						</fieldset>
					</form>
				</div>
			</div>
			</div>

		</section>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/hide.js"></script>
	</body>

</html>
