<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>19 Sheep</title>

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

		<link rel="stylesheet" href="css/doc.css">
		<link rel="stylesheet" href="css/font.css">
		<!--[if lt IE 9]>
		<script src="../documentation/assets/js/html5.js"></script>
		<![endif]-->

		<!-- LayerSlider stylesheet -->
		<link rel="stylesheet" href="css/layerslider.css" type="text/css">
		<!-- External libraries: jQuery & GreenSock -->
		<script src="js/jquery.js" type="text/javascript"></script>
		<script src="js/greensock.js" type="text/javascript"></script>
		<!-- LayerSlider script files -->
		<script src="js/layerslider.transitions.js" type="text/javascript"></script>
		<script src="js/layerslider.kreaturamedia.jquery.js" type="text/javascript"></script>

		<link href="css/style.css" rel="stylesheet">

	</head>

	<?php

	session_start();

	if ($_SESSION['loggedin'] == 1) {
		header("Location: profile.php");
	}
	?>

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
			<div class="login-home">

			</div>
		</div>

		<section id="slide">
			<div id="slider-wrapper">
				<div id="layerslider" style="width:1170px;height:720px;max-width: 1170px; padding:15px;">
					<div class="ls-slide" data-ls="slidedelay:4000;transition3d:3,34;">
						<img src="img/index/log your dreams.jpg" class="ls-bg" alt="Slide background"/>
						<h1 class="ls-l" style="top:20px;left:500px;font-family: Oswald;font-weight: 600;; font-size:75px;color: #fff;white-space: nowrap;" data-ls="offsetxin:0;durationin:3000;rotateyin:60;transformoriginin:right 50% 0;offsetxout:-50;durationout:2000;showuntil:300;fadeout:0;transformoriginout:left 50% 0;">Log your dreams</h1>

					</div>
					<div class="ls-slide" data-ls="slidedelay:3000;transition3d:29;timeshift:-3000;">
						<img src="img/index/keep_track_of_yourfamily's wellness.jpg" class="ls-bg" alt="Slide background"/>
						<h1 class="ls-l" style="font-family: Oswald; top:565px;left:80px;font-weight: 500; text-align: center; opacity: .5;width:340px;font-size:70px;color: #FFCC00;border-radius:5px;white-space: nowrap;" data-ls="offsetxin:0;durationin:3500;easingin:easeOutElastic;rotatexin:90;transformoriginin:50% bottom 0;fadeout:5;rotateout:0;delayin:1000;transformoriginout:left 30% 0;">Keep track of your family's wellness</h1>

					</div>
					<div class="ls-slide" data-ls="slidedelay:3000;transition3d:1;">
						<img src="img/index/review_your_exercise_stats.jpg" class="ls-bg" alt="Slide background"/>
						<h1 class="ls-l" style="top:100px;left:100px;font-weight: 500;height:40px;padding-right:10px;font-family: Oswald;padding-left:10px;font-size:75px;line-height:37px;color: #4A76FF ;border-radius:4px;white-space: nowrap;" data-ls="offsetxin:0;durationin:3000;fadein:5;transformoriginin:right 50% 0;offsetxout:0;durationout:500;showuntil:300;easingout:easeInBack;rotateyout:0;transformoriginout:right 50% 0;">Track your activities</h1>

					</div>
					<div class="ls-slide" data-ls="slidedelay:3000;transition3d:8;">
						<img src="img/index/change_your_office_culture.jpg" class="ls-bg" alt="Slide background"/>
						<p class="ls-l" style="top:524px;left:56px;font-family: Oswald;font-weight: 300; opacity: .4;font-size:120px;color: #000000;white-space: nowrap;" data-ls="offsetxin:0;durationin:1500;scalexin:0;scaleyin:0;offsetxout:0;scalexout:0;scaleyout:0;">
							Change your office culture
						</p>
					</div>
					<div class="ls-slide" data-ls="slidedelay:3000;transition3d:2,4;timeshift:-1000;">
						<img src="img/index/make sense of the metrics.jpg" class="ls-bg" alt="Slide background"/>
						<p class="ls-l" style="top:460px;left:100px;font-family:'Indie Flower'; font-weight: 400; text-align: center;padding-right:10px;font-size:75px;line-height:37px;color:#ffffff;white-space: nowrap;" data-ls="offsetxin:0;durationin:2500;delayin:1000;easingin:easeOutElastic;rotatexin:90;transformoriginin:50% top 0;offsetxout:0;durationout:1000;rotatexout:90;transformoriginout:50% bottom 0;">
							Make sense of the metrics
						</p>
					</div>
					<div class="ls-slide" data-ls="slidedelay:3000;transition3d:44,26;timeshift:-1000;">
						<img src="img/index/discover high performance sleep.jpg" class="ls-bg" alt="Slide background"/>
						<p class="ls-l" style="top:600px;left:100px;font-family: Oswald; font-weight: 400; text-align: center;padding-right:10px;font-size:75px;line-height:37px;color:#B0B0B0;white-space: nowrap;" data-ls="offsetxin:12;durationin:2500;delayin:1000;easingin:easeOutElastic;transformoriginin:50% top 0;offsetxout:0;durationout:1000;rotatexout:90;transformoriginout:50% bottom 0;">
							Discover high performance sleep
						</p>
					</div>
					<div class="ls-slide" data-ls="slidedelay:3000;transition3d:70,66;timeshift:-1000;">
						<img src="img/index/share_your_experiences.jpg" class="ls-bg" alt="Slide background"/>
						<p class="ls-l" style="top:30px;left:40px;font-family: Oswald; font-weight: 400; text-align: center;padding-right:10px;font-size:75px;line-height:37px;color:#ffffff;white-space: nowrap;" data-ls="offsetxin:0;durationin:2500;delayin:1000;easingin:easeOutElastic;fadein:10;transformoriginin:50% top 0;offsetxout:0;durationout:1000;rotatexout:90;transformoriginout:50% bottom 0;">
							Share your
						</p>
						<p class="ls-l" style="top:30px;left:370px;font-family: Oswald; font-weight: 400; text-align: center;padding-right:10px;font-size:75px;line-height:37px;color:#ffe796;white-space: nowrap;" data-ls="offsetxin:0;durationin:2500;delayin:1000;easingin:easeOutElastic;fadein:10;transformoriginin:50% top 0;offsetxout:0;durationout:1000;rotatexout:90;transformoriginout:50% bottom 0;">
							experiences
						</p>
					</div>
					<div class="ls-slide" data-ls="slidedelay:3000;transition3d:15,45;timeshift:-1000;">
						<img src="img/index/record wellnesss commitments.jpg" class="ls-bg" alt="Slide background"/>
						<p class="ls-l" style="top:60px;left:320px;font-family: Oswald; font-weight: 400; text-align: center;padding-right:10px;font-size:75px;line-height:37px;color:#627762;white-space: nowrap;" data-ls="offsetxin:0;durationin:2500;delayin:1000;easingin:easeOutElastic;scalein:1.5;transformoriginin:50% top 0;offsetxout:0;durationout:1000;transformoriginout:50% bottom 0;">
							Record wellness commitments
						</p>
					</div>
				</div>
			</div>
		</section>
		<section id="store" class="text-center store">

			<div class="container">
				<div class="vendor vedio-box">
					<iframe src="https://www.youtube.com/embed/zaxEqtDFym4" width="854" height="480" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
				</div>

				<div id="slider" class="store-box">
					<figure>
						<a href="http://shop.19sheep.com"><img src="img/index/activite-1.jpg" alt=""></a>
						<a href="http://shop.19sheep.com"><img src="img/index/pop_grey.jpg" alt=""></a>
						<a href="http://shop.19sheep.com"><img src="img/index/pop_white.jpg" alt=""></a>
						<a href="http://shop.19sheep.com"><img src="img/index/bp_monitor.jpg" alt=""></a>
						<a href="http://shop.19sheep.com"><img src="img/index/security_camera.jpg" alt=""></a>
						<a href="http://shop.19sheep.com"><img src="img/index/smartbaby.jpg" alt=""></a>
						<a href="http://shop.19sheep.com"><img src="img/index/scales.jpg" alt=""></a>
					</figure>
				</div>
			</div>
		</section>
		<!-- Core JavaScript Files -->
		<script src="js/startslide.js"></script>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.easing.min.js"></script>
		<script src="js/classie.js"></script>
		<script src="js/gnmenu.js"></script>
		<script src="js/jquery.scrollTo.js"></script>
		<script src="js/nivo-lightbox.min.js"></script>
		<script src="js/stellar.js"></script>
		<script src="js/jquery.fitvids.js"></script>
		<script>
			$(".container").fitVids();

		</script>

	</body>

</html>
