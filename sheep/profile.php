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
	<link rel="shortcut icon" href="img/favicon.png">
	<title>19 Sheep - Dashboard</title>

	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<!-- Fonts -->
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="css/nivo-lightbox.css" rel="stylesheet" />
	<link href="css/nivo-lightbox-theme/default/default.css" rel="stylesheet" type="text/css" />
	<!-- Squad theme CSS -->
	<link href="color/default.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-latest.min.js"></script>
	<!-- Graph JS -->
	<script type="text/javascript" src="js/xepOnline.jqPlugin.js"></script>
	<link rel="stylesheet" href="css/memustyles.css">
	<script type="text/javascript" src="js/memuscript.js"></script>
	<link rel="stylesheet" type="text/css" href="css/gagueStyle.css">
	<link href="css/profile.css" rel="stylesheet">

	
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



	<?php
	if (!isset($_SESSION["userid"])) {
		?>
		<p align="center"style="margin-top: 30px;">No Withings device detected.  Please click the button below to connect.</p>
		<div align="center" class="btn-box">
			<a class="btn profile-btn submit" href="http://19sheep.com/api.php">Connect</a>
		</div>
		<?php
		} else {
		?>


		<section style="margin-top: 60px;">
			<div class="btn-box">
				<a class="btn profile-btn" href="#" onclick="return xepOnline.Formatter.Format('print-box', {render:'download',filename:'document'});">Save as PDF</a>
			</div>
			<div id="print-box" class="container">
				<div class="dashboard">
					<div class="container outbox">
						<div class="row text-center">
							<div class="graph_heading">
								<h3>Sleep Score</h3>
							</div>
							<div id="chart_1" class="graph_div"></div>
							<div class="message">
								<p id="sleepsummary" class="summary"></p>
							</div>
							<div class="drop-circle">
								<a type="button" class="showdiv-l" href="sleepdrill.php"><i class="fa fa-plus-square fa-2x"></i> </a>
							</div>
						</div>

						<div class="row text-center">
							<div class="graph_heading">
								<h3>Sleep Bank</h3>
							</div>
								<div id="chart_4" class="graph_div"></div>
								<div class="message">
									<p id="sleepbank" class="summary"></p>
								</div>
							
						</div>
					</div>

				</div>
				<div class="dashboard">
					<div class="container outbox">
						<div class="row text-center">
							<div class="graph_heading">
								<h3>Activity Score</h3>
							</div>

							<div id="chart_2" class="graph_div"></div>
							<div class="message">
								<p id="activitysummary1" class="summary"></p>
							</div>
							<div class="drop-circle">
								<a type="button" class="showdiv-r" href="actdrill.php"> <i class="fa fa-plus-square fa-2x"></i></a>
							</div>
						</div>

						<div class="row text-center">
							<div class="graph_heading">
								<h3>Activity Bank</h3>
							</div>
							<div id="chart_3" class="graph_div"></div>
							<div class="message">
								<p id="activitybank" class="summary"></p>
							</div>
						</div>


					</div>
				</div>
			</div>
		</section>
		
		<?php
		}
	?>
	<section>
			<div class="kbarticles text-center">
				<hr>
				<div class="container">
					<div class="row">
						<div class="kb_heading">Knowledge Base:</div>
					</div>
					<div class="row" style="margin-bottom: 5px;">
						<div class="articles">
							<button type="button" id="btn-1" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_1">
								Activity Goals
							</button>
							<div class="modal fade" id="myModal_1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_1">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_1">Activity Goals</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_activity goals.jpg" style="display:block; width:450px; height: 150px;"> Daytime activity is not only important for our daytime health and wellness. If we do not get enough physical, mental and emotional activity during the day then we may put ourselves to bed early and find that we are unable to sleep. Simply because, the energy stores of our body have not been exhausted enough.
											<br>
											<br>
											We can capture your daily and nightly activity data through your wearable device. But you will need to help us understand how you are feeling emotionally by giving us this information on a regular basis using our emotions logger.
											<br>
											<br>
											If you can find a little regular time to do this, the analysts at 19 sheep can provide you with some amazing reflection about the relationship between how you are feeling and what you have been doing.

										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="articles">
							<button type="button" id="btn-2" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_2">
								Alcohol
							</button>
							<div class="modal fade" id="myModal_2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_2">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_2">Alcohol</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_alcohol.jpg" style="display:block; width:450px; height: 150px;"> What we do before we go to bed, influences the experience we have during our sleep. If we look at the big picture, sleep is meant to be an opportunity for recharging, reflection and even adventure.
											<br>
											<br>
											When we consume alcohol immediately before bed, the influence of alcohol is “on board” when we enter our dreaming and sleep states.  For some people, this may be quite deliberate as they see alcohol as a way of getting to sleep. In this case, the alcohol isn’t really helping to address the underlying issue.
											<br>
											<br>
											Having alcohol in the system, is likely to reduce the restorative value of our sleep. Alcohol interferes with heart rate, body temperature, metabolism, brain chemicals and other systems that are required for a good night’s sleep. Moreover, it's important that organs such as the liver and kidneys have the opportunity to rest at night.
											<br>
											<br>
											Having some wine with our evening meal is a normal part of culture for many families. So we are recommending that you to give yourself an hour between your last drink and going to sleep and consider avoiding consuming large amounts of alcohol before bed.
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="articles">
							<button type="button" id="btn-3" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_3">
								Approved
							</button>
							<div class="modal fade" id="myModal_3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_3">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_3">Approved</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_approved.jpg" style="display:block; width:450px; height: 150px;"> Wearable devices showing our ‘approved’ logo have been through our testing process and represent good value for money. Our wearable device assessment criteria is as follows:
											<br>
											<br>
											<ul>
												<li>
													Automatic sleep detection so there is no need to tell the device you are going to bed or waking up.
												</li>
												<li>
													Waterproof - therefore no need to be taken off.
												</li>
												<li>
													Long battery life to avoid the need for daily or weekly recharging.
												</li>
												<li>
													Automatic syncing so no need to tell your smartphone to sync your wearable.
												</li>
												<li>
													High quality data interface and analytics.
												</li>
												<li>
													Stylish and aesthetically pleasing.
												</li>
											</ul>
											<br>
											<br>
											No wearable device is perfect, but if there is something pretty close.
											We will find it and let you know about it.
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="articles">
							<button type="button" id="btn-4" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_4">
								Before Bed
							</button>
							<div class="modal fade" id="myModal_4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_4">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_4">Before Bed</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_before bed.jpg" style="display:block; width:450px; height: 150px;">			Why does the sleep science team at 19 sheep split your sleep activity data up into two sessions?
											Why have an evening session from 9 PM to 12 midnight and a morning session from 12 midnight to 9 AM?  Why not just lump the whole thing in together and make it one long sleep session?
											<br>
											<br>
											Let us use a metaphor to explain this to you.
											<br>
											<br>
											During the day, if we are making a business presentation or participating in sports match - the last few hours before the performance will have a significant impact on the quality of your delivery.
											<br>
											<br>
											In the same way, if we are taking our sleep seriously, then we need to show reasonable preparation if we are expecting to achieve high-performance sleep.
											<br>
											<br>
											By separating your sleep data into before 12 midnight and after 12 midnight, the sleep analysts at 19 sheep can better understand how your evening choices are impacting on your sleeping performance.
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="articles">
							<button type="button" id="btn-5" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_5">
								Behaviour Change
							</button>
							<div class="modal fade" id="myModal_5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_5">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_5">Behaviour Change</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_before bed.jpg" style="display:block; width:450px; height: 150px;"> If you are looking to, or have recently purchased a wearable sleep and activity tracker, then you are well on your way to achieving some behaviour change for yourself.
											<br>
											<br>
											Or perhaps you are purchasing device for somebody else? Then you will be providing a great personal service for that person.  How can we be so confident that merely using a wearable activity tracker will change a person's behaviour?
											<br>
											<br>
											As people, we are generally not used to being confronted with data about our own wellness unless we are being given some lab results from the doctor.  While we have managed to progress, most of us still feel ‘in the dark’ about our own wellness.
											<br>
											<br>
											Precision medicine and the wearable revolution changes all that, by providing individuals with their own data, allowing them to make better decisions and begin to play a role in the maintenance and generation of their own health and wellness.
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="articles">
							<button type="button" id="btn-6" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_6">
								Blog
							</button>
							<div class="modal fade" id="myModal_6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_6">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_6">Blog</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_blog.jpg" style="display:block; width:450px; height: 150px;"> Please join us regularly here for the latest happenings in wearable activity trackers, sleep research, and wellness musings.
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="articles">
							<button type="button" id="btn-7" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_7">
								Body Temperature
							</button>
							<div class="modal fade" id="myModal_7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_7">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_7">Body Temperature</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_body temperature.jpg" style="display:block; width:450px; height: 150px;"> Whilst the majority of wearable sleeping activity trackers do not measure body temperature, it remains an important indicator of sleeping efficiency.
											<br>
											<br>
											So, how do you achieve optimal body temperature during your night of sleep?  Well the first thing to realise is that there is no single or perfect temperature for sleep.
											<br>
											<br>
											Different people sleep at different temperatures, so it's more accurate to say that most people sleep within a range of body temperature.
											<br>
											<br>
											There are a number of stages that we will pass through during each night of sleep. Each stage can correspond with changes in brainwave activity, respiration, heart rate, metabolism and body temperature.
											<br>
											<br>
											High-performance sleepers, show flexible adjustment of these indicators up and down, during the evening as they sleep, so that they get the most out of each stage of sleep.
											<br>
											<br>
											Problems can emerge when our body temperature becomes stuck or is higher or lower than would be otherwise optimal for each stage.
											<br>
											<br>
											To avoid this happening, we need to be mindful of our preparation before bed, the clothes we wear to bed, the bedroom environment, bed sheeting and quilting, having adequate hydration and avoiding alcohol and drugs before sleep.
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="articles">
							<button type="button" id="btn-8" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_8">
								Caffeine
							</button>
							<div class="modal fade" id="myModal_8" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_8">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_8">Caffeine</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_caffeine.jpg" style="display:block; width:450px; height: 150px;"> Nearly everyone drinks caffeine at some stage or another.  Some people like to start their day with a coffee. Others like to drink caffeine-boosted soft-drinks throughout the day.  Indeed, some people even like to have coffee just before they go to bed.
											<br>
											<br>
											Caffeine changes the metabolism of chemicals in your brain. Some of these chemicals are required for sleep. Overconsumption of these chemicals, without adequate time for replacement, can lead to lack of sleep, irritability and wakefulness.  Our best advice to you, is to avoid having caffeine drinks and products just before sleep.
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="articles">
							<button type="button" id="btn-9" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_9">
								Corporate
							</button>
							<div class="modal fade" id="myModal_9" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_9">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_9">Corporate</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_corporate.jpg" style="display:block; width:450px; height: 150px;"> 19 Sheep is a private company that is wholly owned by Inception Strategies pty ltd.
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="articles">
							<button type="button" id="btn-10" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_10">
								Culture Change
							</button>
							<div class="modal fade" id="myModal_10" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_10">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_10">Culture Change</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_corporate.jpg" style="display:block; width:450px; height: 150px;"> If you want to change your organisation’s culture, then you need to provide your staff with information about their behaviour.  The team at 19 sheep can deploy a workforce culture change solution to achieve this in your organisation using wearable and other technologies.
											<br>
											<br>
											Our activity and sleep analysis services can provide you and your staff information about themselves that can lead to a new mental and physical health roadmap for your organisation.
											<br>
											<br>
											We will report to you regularly using valid metrics to demonstrate the wellness of your staff and indicate the priority areas for change.
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="articles">
							<button type="button" id="btn-11" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_11">
								Dashboard
							</button>
							<div class="modal fade" id="myModal_11" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_11">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_11">Dashboard</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_dashboard.jpg" style="display:block; width:450px; height: 150px;"> Your enterprise dashboard is a single page where you can view summary graphs for your employee wellness data.
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="articles">
							<button type="button" id="btn-12" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_12">
								Daytime Summary
							</button>
							<div class="modal fade" id="myModal_12" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_12">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_12">Daytime Summary</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_daytime summary.jpg" style="display:block; width:450px; height: 150px;"> Your daytime summary is your activity performance between 9 AM to 9 PM.
											<br>
											<br>
											Here, you will see all of your daytime activity stats grouped together. This is when most of us do our productive work and exercise. Why is it relevant for wellness and sleep?
											<br>
											<br>
											It's been shown that regular exercise and mental effort involved with a quality workday increases wellness and provides opportunities for improved sleep at night.
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="articles">
							<button type="button" id="btn-13" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_13">
								Deep Sleep
							</button>
							<div class="modal fade" id="myModal_13" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_13">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_13">Deep Sleep</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_deep sleep.jpg" style="display:block; width:450px; height: 150px;"> Deep sleep is important to all of us. There are some types of rest that can only be achieved during deep sleep. If it is our wish to be fully recovered and refreshed in the morning, then we need to find a way to regularly experience deep sleep.
											<br>
											<br>
											Our sleep analysts at 19 sheep  believe it is essential to get at least three hours of deep sleep per night, or otherwise risk harm to body and brain. For example, research has recently shown that a lack of deep sleep increases a person's risk for cardiovascular disease, diabetes, infections and possibly even Alzheimer's disease.
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="articles">
							<button type="button"  id="btn-14" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_14">
								Dream Interpretation
							</button>
							<div class="modal fade" id="myModal_14" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_14">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_14">Dream Interpretation</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_dream interpretation.jpg" style="display:block; width:450px; height: 150px;">			All of the our dream interpretation staff have completed the 19 sheep dream interpretation course.
											The course and will suit open minded, emotionally well grounded people who are able to understand complex topics, who have a good understanding of human emotion and feel a sense of adventure about learning new things.
											<br>
											<br>
											If you are interested in doing this online course please feel free to contact us at courses@19sheep.com
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="articles">
							<button type="button" id="btn-15" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_15">
								Dream Analysis
							</button>
							<div class="modal fade" id="myModal_15" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_15">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_15">Dream Analysis</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_dream analyzer.jpg" style="display:block; width:450px; height: 150px;"> The general standard of dream analysis available online is very poor.
											<br>
											<br>
											Most of us have been brainwashed into thinking that a certain dream symbol has a definitive meaning. Millions of dollars are spent each year globally on dream interpretation books, and dream ‘bibles’ that wrongly claim to know your psyche.
											<br>
											<br>
											19 sheep offer dream analysis services for our users at no cost. This is a public service and is designed to promote improved understanding and communication of dream material in society. We begin with a simple dream analyser questionnaire, and follow up with more details questions afterwards.
											<br>
											<br>
											Your dream information is not shared with anybody and is secure. Users of our enterprise service will not have access to the dream information of their employees.
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">
													Close
												</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="articles">
							<button type="button" id="btn-16" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_16">
								Dream & productivity
							</button>
							<div class="modal fade" id="myModal_16" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_16">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_16">Dream & productivity</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_dreaming and productivity.jpg" style="display:block; width:450px; height: 150px;"> Effective dreamers wake up feeling more refreshed, positive and ready to face the day.
											<br>
											<br>
											High-performance dreaming supports visionary leadership where people can see a problem from a number of different dimensions or viewpoints and are able to translate solutions which have pre considered the embedded alternatives.
											<br>
											<br>
											If we are unable to access our dreams effectively, then we have effectively lost a key adviser and sounding board for our concepts and ideas.
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="articles">
							<button type="button" id="btn-17" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_17">
								Emotion Logger
							</button>
							<div class="modal fade" id="myModal_17" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_17">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_17">Emotion Logger</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_emotion logger.jpg" style="display:block; width:450px; height: 150px;"> By letting us know what your emotions are, we can begin to include them alongside your sleep and activity charts, allowing you to have a better understanding of how your emotions are interplaying with your sleep, activity and behaviour.  Our emotions logger uses a simple four-colour system that can be accessed easily via your phone or your desktop.
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="articles">
							<button type="button" id="btn-18" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_18">
								Evening Summary
							</button>
							<div class="modal fade" id="myModal_18" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_18">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_18">Evening Summary</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_evening summary.jpg" style="display:block; width:450px; height: 150px;"> Your evening sleep summary is your sleep performance between 9 PM and 12 midnight.
											<br>
											<br>
											This period is a key sleep preparation and sleep time for all individuals.
											<br>
											<br>
											19 sheep will provide you with details and analysis about your activity during this time period and suggest how it may be impacting on your sleep for the rest of the night.
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="articles">
							<button type="button" id="btn-19" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_19">
								Workforce Wellness
							</button>
							<div class="modal fade" id="myModal_19" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_19">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_19">Workforce Wellness</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_workforce wellness.jpg" style="display:block; width:450px; height: 150px;"> Organisations with good employee wellness are happy places, where people feel supported to carry out their job to the best of their ability. Places, where people feel obligated to participate in wellness activity outside of their job, so that they can be the very best person they can be when they come to the office.  In fact, nearly all employees who would like to bring a stronger version of themselves to work, but many don't quite know how to procure it.
											<br>
											<br>
											By linking your employees with 19 sheep wellness services, we can work closely with them to identify what is working well in their wellness and how we can improve on it.  As the wellness of one employee lifts, it spreads through the rest of the work team as a new workplace culture, encouraging others to consider similar changes via the power of example.
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="articles">
							<button type="button" id="btn-20" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_20">
								Insomnia
							</button>
							<div class="modal fade" id="myModal_20" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_20">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_20">Insomnia</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_insomia.jpg" style="display:block; width:450px; height: 150px;"> Insomnia is a debilitating condition that affects large numbers of people across the world, who find it difficult to get to sleep and stay in sleep. It's important to recognise that insomnia is not normal, and should not be left un-checked for long periods of time as lack of sleep is likely to increase the level of accidents and practical danger in the person's daily life.
											<br>
											<br>
											Prolonged and repeated insomnia is likely to degrade a person's wellness very quickly and significant effort should be made as soon as possible to identify the root causes to achieve a sustainable solution. Long-term sufferers of insomnia should be in a regular programme of care that is supervised by their medical practitioner.
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="articles">
							<button type="button" id="btn-21" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_21">
								High Performance Sleep
							</button>
							<div class="modal fade" id="myModal_21" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_21">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_21">High Performance Sleep</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_light performance sleep.jpg" style="display:block; width:450px; height: 150px;"> Light sleep, has an important role in the rejuvenation of body systems. Whilst there are certain types of fatigue that are best addressed with deep sleep, there are others that may be addressed effectively with light sleep. Light sleep is also the gateway into and out of deep sleep and therefore performs and important buffering role for the psyche in adjusting into and out of the more complex environments that can accompany deep sleep.
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="articles">
							<button type="button" id="btn-22" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_22">
								Light Sleep
							</button>
							<div class="modal fade" id="myModal_22" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_22">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_22">Light Sleep</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_light sleep.jpg" style="display:block; width:450px; height: 150px;"> Light sleep, has an important role in the rejuvenation of body systems. Whilst there are certain types of fatigue that are best addressed with deep sleep, there are others that may be addressed effectively with light sleep. Light sleep is also the gateway into and out of deep sleep and therefore performs and important buffering role for the psyche in adjusting into and out of the more complex environments that can accompany deep sleep.
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="articles">
							<button type="button" id="btn-23" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_23">
								Media
							</button>
							<div class="modal fade" id="myModal_23" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_23">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_23">Media</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_media.jpg" style="display:block; width:450px; height: 150px;"> For media enquiries please contact:
											<br>
											<br>
											media@19sheep.com
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="articles">
							<button type="button" id="btn-24" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_24">
								Morning Summary
							</button>
							<div class="modal fade" id="myModal_24" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_24">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_24">Morning Summary</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_morning summary.jpg" style="display:block; width:450px; height: 150px;"> The morning summary shows our sleeping performance between the hours of 12 midnight and 9 AM.
											<br>
											Of particular interest is whether deep sleep was achieved, how much and where it occurred.
											<br>
											<br>
											The morning summary provides separate data that we can compare with the evening sleep data.
											For example, if we have prepared well for sleep and achieve high performance in our evening sleep with significant deep sleep achieved before 12 midnight then we may expect the morning summary to be a little more moderate. Equally, if we are performing poorly in evening sleep we may expect that the burden for achieving deep sleep will fall to the morning period.

										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="articles">
							<button type="button" id="btn-25" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_25">
								Nightmares
							</button>
							<div class="modal fade" id="myModal_25" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_25">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_25">Nightmares</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_nightmares.jpg" style="display:block; width:450px; height: 150px;"> Nightmares occur for a variety of reasons.
											<br>
											<br>
											They may happen because the body has become overheated or dehydrated and signals to the brain that the person should wake up from their sleep. In such a case, the nightmare is the tool par excellence’ to prod the happy sleeper out of their slumber to get a drink, and, or, throw off a blanket.
											<br>
											<br>
											Nightmares can also occur when people are dealing with dream issues that they do not have the psychological frameworks to understand. For example, children are often ill-prepared to understand the unstructured ways that dream events can manifest and, as a result, can experience acute levels of fear.
											<br>
											<br>
											As people become more aware and educated about dreams and their purpose, they can realise that dreams, whilst valid, mostly do not represent real physical events and therefore do not attract the same level of consequence that could be expected of the same actions in the physical world.

										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="articles">
							<button type="button" id="btn-26" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_26">
								REM Sleep
							</button>
							<div class="modal fade" id="myModal_26" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_26">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_26">REM Sleep</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_rem sleep.jpg" style="display:block; width:450px; height: 150px;"> REM sleep is an important part of the deep sleep process. Often occurring in the early stages of deep sleep, REM sleep corresponds with a change in brainwave patterns that allow for specific processes to be undertaken by the dreaming brain.
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="articles">
							<button type="button" id="btn-27" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_27">
								Reviews
							</button>
							<div class="modal fade" id="myModal_27" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_27">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_27">Reviews</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_reviews.jpg" style="display:block; width:450px; height: 150px;"> From time to time, 19 sheep will conduct reviews about new sleep and activity trackers that enter the marketplace. We will attempt to be objective as possible about our reviews and will suggest products to our members that our best mix of quality, value and after sales support.
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="articles">
							<button type="button" id="btn-28" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_28">
								Return on Investment
							</button>
							<div class="modal fade" id="myModal_28" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_28">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_28">Return on Investment</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_return investments.jpg" style="display:block; width:450px; height: 150px;"> Return on investment or (ROI) is an important indicator of your company wellness program.
											<br>
											As an employer, your bottom line is eroded by absenteeism, low productivity, staff turnover and low morale. A successful company wellness program can make a significant impact to your employee culture by simply showing that you care.  Providing staff with wearable activity and sleep trackers plus a monitoring and reporting service like ours, is likely to make them feel more valued and better able to identify the roadblocks that are preventing them from finding their stronger selves and feeling more engaged on the job.
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="articles">
							<button type="button" id="btn-29" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_29">
								Sleep Goals
							</button>
							<div class="modal fade" id="myModal_29" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_29">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_29">Sleep Goals</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_sleep goals.jpg" style="display:block; width:450px; height: 150px;"> For the most part, the wellness industry has been focused on diet, nutrition and activity. All of these things are immensely important, but they are skewed towards the physical end of the spectrum, leaving most of us relatively perplexed about how to assess or improve our psychological health without necessarily booking in to see ‘a shrink’.
											<br>
											<br>
											19 sheep is not in the business of undermining the value of going to see a psychologist or psychiatrist, which may be something that most people tend to do not very often. We would rather be your wellness partner that uses your sleep as an early warning barometer of your mental health.
											<br>
											<br>
											In other words, prolonged, repeated and ongoing sleep problems are indicative of other issues that must be present and dealt with, if you are to improve. By using our sleep assessment services you can get a better understanding of your sleep performance and feel better informed and empowered to make stronger choices for your care.

										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="articles">
							<button type="button" id="btn-30" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_30">
								Sleep Science
							</button>
							<div class="modal fade" id="myModal_30" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_30">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_30">Sleep Science</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_sleepscience.jpg" style="display:block; width:450px; height: 150px;"> 19 sheep uses your sleep data to calculate variables that we have engineered to better understand the detail of your sleep patterns.
											<br>
											<br>
											We like to know how long it is taking you to fall asleep? How long it is before you fall into deep sleep?
											Is your deep sleep achieved from a few sleeping intervals or is scattered throughout the night? What is the total amount of time you spend in light sleep? How much time do you regularly spend awake during the night? How would you emotionally rate your sleep experience? Are your dreams positive and uplifting or negative and draining?
											<br>
											<br>
											All of these things fascinate us at 19 sheep.
											We look forward to being your sleep science and wellness partner.

										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="articles">
							<button type="button" id="btn-31" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_31">
								Snoring
							</button>
							<div class="modal fade" id="myModal_31" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_31">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_31">Snoring</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_snoring.jpg" style="display:block; width:450px; height: 150px;"> Snoring is a type of noisy irregular, nasally biased breathing that occurs during sleep. Generally, it is seen as a physical problem that can arise due to a number of factors such as blocked nose, head cold, lying in the wrong position, inappropriate environmental air temperature, histamine or allergic response to an environmental or dietary stimuli, or, as a symptom of a bigger problem like sleep apnoea.
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="articles">
							<button type="button" id="btn-32" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_32">
								Social
							</button>
							<div class="modal fade" id="myModal_32" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_32">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_32">Social</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_social.jpg" style="display:block; width:450px; height: 150px;"> Being social about your wellness is a good thing. If we can involve others in the setting of our wellness goals then there is a greater social motivation to succeed.
											<br>
											<br>
											However, many wellness solutions tend to be competitive and pit people against each other to see who can do the most steps or earn the most points.  Such approaches favour those people who were more physically oriented and actively disadvantages people who are less so.
											<br>
											<br>
											This can bring about a dangerous situation where those people who are most in need of wellness improvement are pitted against those people who are already ‘there’. This can reinforce feelings of helplessness and induce less physically oriented people to give up and avoid further social embarrassment.
											<br>
											<br>
											19 sheep’s approach to wellness is about being collaborative and mutually supporting which recognises that nobody is perfect and that we are all on a journey to improving our health. Ideally, wellness goals should be relative and reflect where each person is at rather than be a source for division and competition.

										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="articles">
							<button type="button" id="btn-33" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_33">
								Special Advisors
							</button>
							<div class="modal fade" id="myModal_33" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_33">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_33">Special Advisors</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_special advisers.jpg" style="display:block; width:450px; height: 150px;"> 19 sheep is supported by a talented group of special advisers who take an interest in wellness, activity, sleep, finance and social entrepreneurship.  We look forward to introducing them to you soon.
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="articles">
							<button type="button" id="btn-34" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_34">
								Store
							</button>
							<div class="modal fade" id="myModal_34" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_34">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_34">Store</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_store.jpg" style="display:block; width:450px; height: 150px;"> 19 sheep is delighted to bring you the latest and greatest activity and sleep trackers for your wellness benefit. Order direct with us to bundle with our wellness service to achieve holistic outcomes that are tailored directly to you.
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="articles">
							<button type="button" id="btn-35" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_35">
								Testimonials
							</button>
							<div class="modal fade" id="myModal_35" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_35">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_35">Testimonials</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_testimonials.jpg" style="display:block; width:450px; height: 150px;"> The following testimonials let you know what other people think about our service:
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="articles">
							<button type="button" id="btn-36" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_36">
								Triumph of the Month
							</button>
							<div class="modal fade" id="myModal_36" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_36">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_36">Triumph of the Week</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_triumph of the month.jpg" style="display:block; width:450px; height: 150px;"> Triumph of the month is an example of a personal triumph achieved by one of our members, that is unique due to its inspiration, motivation and effort.
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="articles">
							<button type="button" id="btn-37" class="btn btn-primary btn-articles hidden" data-toggle="modal" data-target="#myModal_37">
								Triumph of the Week
							</button>
							<div class="modal fade" id="myModal_37" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_37">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel_37">Triumph of the Week</h4>
										</div>
										<div class="modal-body">
											<img src="img/articles/19sheep_triumph of the week.jpg" style="display:block; width:450px; height: 150px;"> The Triumph of the week is an approved excerpt taken from one of our member’s individual pages. Continue reading for below inspiration!
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="refresh">
							<i class="fa fa-refresh fa-3x" id="btn-refresh"></i>
						</div>
					</div>
				</div>
			</div>
		</section>
	<script src="js/jquery-latest.min.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/knowledge.js"></script>
	<script type="text/javascript" src="js/helpingmethods.js"></script>
	<script type="text/javascript" src="js/graph/sleep_1.js"></script>
	<script type="text/javascript" src="js/graph/sleep_2.js"></script>
	<script type="text/javascript" src="js/graph/sleep_3.js"></script>
	<script type="text/javascript" src="js/graph/act_1.js"></script>
	<script type="text/javascript" src="js/graph/act_3.js"></script>
	<script type="text/javascript" src="js/graph/act_4.js"></script>

</body>



</html>
