<!DOCTYPE html>
<html lang="en">

<head>
	<?php
	session_start();
	include("fpdf.php");
	if (!isset($_SESSION['email'])) {
	//User isn't logged in, return to login page.
		header("Location: signin.php");
	}
	?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>19 Sheep - Dream Review</title>

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
	<script src="js/color.js"></script>
	<link rel="stylesheet" href="css/memustyles.css">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/input.css" rel="stylesheet">
	<style>
	table, th, td {
		border: 1px solid black;
		border-collapse: collapse;
	}
	th {
		text-align: center;
		font-weight: bold;
	}
	</style>
</head>

<?php
if (isset($_POST['actors'])) {

	$actors = '';
	$yourroles = '';
	$theirroles ='';
	$themes = '';
	$lightings = '';
	$clarities = '';
	$powers = '';
	$blocks ='';
	$physics = '';
	$lucidities = '';





	foreach($_POST['actors'] as $actor) {
		$actors = $actors . $actor . ', ';
	}

	foreach($_POST['yourrole'] as $yourrole) {
		$yourroles = $yourroles . $yourrole . ', ';
	}

	foreach($_POST['theirrole'] as $theirrole) {
		$theirroles = $theirroles . $theirrole . ', ';
	}

	foreach($_POST['theme'] as $theme) {
		$themes = $themes . $theme . ', ';
	}

	foreach($_POST['lighting'] as $lighting) {
		$lightings = $lightings . $lighting . ', ';
	}

	foreach($_POST['clarity'] as $clarity) {
		$clarities = $claritiess . $clarity . ', ';
	}

	foreach($_POST['power'] as $power) {
		$powers = $powers . $power . ', ';
	}

	foreach($_POST['blocks'] as $block) {
		$blocks = $blocks . $block . ', ';
	}

	foreach($_POST['physiscs'] as $physic) {
		$physics = $physics . $physic . ', ';
	}

	foreach($_POST['lucidity'] as $lucidity) {
		$lucidities = $lucidities . $lucidity . ', ';
	}


	$pdf = new FPDF();
	$pdf->SetTitle('Dream Detail');


	$pdf->AddPage('P'); 
	$pdf->SetFont('Helvetica');

	$pdf->Cell(40,10,'Dream detail overview for '. $_SESSION['email'] . ' on ' . date('Y-m-d'),0,2);
	$pdf->Cell(40,10,'-----------------------------------',0,2);
	$pdf->Cell(40,10,'Was the dream good? '.$_POST['emotion'],0,2);
	$pdf->Cell(40,10,'Dream Actors: '. $actors,0,2);
	$pdf->Cell(40,10,'Your Roles: '. $yourroles,0,2);
	$pdf->Cell(40,10,'Their Roles: '. $theirroles,0,2);
	$pdf->Cell(40,10,'Themes: '. $themes,0,2);
	$pdf->Cell(40,10,'Lighting: '. $lightings,0,2);
	$pdf->Cell(40,10,'Clarity: '. $clarities,0,2);
	$pdf->Cell(40,10,'Powers: '. $powers,0,2);
	$pdf->Cell(40,10,'Dream blocks: '. $blocks,0,2);
	$pdf->Cell(40,10,'Physics: '. $physics,0,2);
	$pdf->Cell(40,10,'Lucidity: '. $lucidities,0,2);
	$pdf->Cell(40,10,'Dream Description: '. $_POST['comment'],0,2);
	$pdf->Cell(40,10,'Do I need assistance with interpreting this dream?: '. $_POST['assistme'],0,2);




	ob_end_clean();
	
	$filename = 'PDF/' . $_SESSION['email'] . ' ' . date("Y-m-d h:i:s").'.pdf';
	$pdf->Output($filename,'F');

	header('Location: dreamdetail.php');
}
?>


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
	<section id="mood-detail" class="home-section text-center">
		<div class="container">

			<div id="row" align="center">
				<h3>User Dream Detail Submissions</h3>
				<table class="table" style="border: none;">
					<thead >
						<tr>
							<th>Filename</th>
							<th>Type</th>
							<th>Contact user</th>
						</tr>
					</thead>
					<tbody>
						<?php
        // Opens directory
						$myDirectory=opendir("PDF");

        // Gets each entry
						while($entryName=readdir($myDirectory)) {
							$dirArray[]=$entryName;
						}

        // Finds extensions of files
						function findexts ($filename) {
							$filename=strtolower($filename);
							$exts=split("[/\\.]", $filename);
							$n=count($exts)-1;
							$exts=$exts[$n];
							return $exts;
						}

        // Closes directory
						closedir($myDirectory);

        // Counts elements in array
						$indexCount=count($dirArray);

        // Sorts files
						sort($dirArray);

        // Loops through the array of files
						for($index=0; $index < $indexCount; $index++) {

          // Allows ./?hidden to show hidden files
							if($_SERVER['QUERY_STRING']=="hidden")
								{$hide="";
							$ahref="./";
							$atext="Hide";}
							else
								{$hide=".";
							$ahref="./?hidden";
							$atext="Show";}
							if(substr("$dirArray[$index]", 0, 1) != $hide) {

          // Gets File Names
								$name=$dirArray[$index];
								$namehref=$dirArray[$index];

          // Gets Extensions 
								$extn=findexts($dirArray[$index]); 

          // Gets file size 
								$size=number_format(filesize($dirArray[$index]));

          // Gets Date Modified Data
								$modtime=date("M j Y g:i A", filemtime($dirArray[$index]));
								$timekey=date("YmdHis", filemtime($dirArray[$index]));

          // Prettifies File Types, add more to suit your needs.
								switch ($extn){
									case "png": $extn="PNG Image"; break;
									case "jpg": $extn="JPEG Image"; break;
									case "svg": $extn="SVG Image"; break;
									case "gif": $extn="GIF Image"; break;
									case "ico": $extn="Windows Icon"; break;

									case "txt": $extn="Text File"; break;
									case "log": $extn="Log File"; break;
									case "htm": $extn="HTML File"; break;
									case "php": $extn="PHP Script"; break;
									case "js": $extn="Javascript"; break;
									case "css": $extn="Stylesheet"; break;
									case "pdf": $extn="PDF Document"; break;

									case "zip": $extn="ZIP Archive"; break;
									case "bak": $extn="Backup File"; break;

									default: $extn=strtoupper($extn)." File"; break;
								}

          // Separates directories
								if(is_dir($dirArray[$index])) {
									$extn="&lt;Directory&gt;"; 
									$size="&lt;Directory&gt;"; 
									$class="dir";
								} else {
									$class="file";
								}

          // Cleans up . and .. directories 
								if($name=="."){$name=". (Current Directory)"; $extn="&lt;System Dir&gt;";}
								if($name==".."){$name=".. (Parent Directory)"; $extn="&lt;System Dir&gt;";}

								$user_email = explode(" ", $namehref)[0];
          // Print 'em
								print("
									<tr class='$class'>
									<td><a href='PDF/$namehref'>$name</a></td>
									<td><a href='PDF/$namehref'>$extn</a></td>
									<td><a href='mailto:$user_email?Subject=Your%20Dream%20Analysis'>$user_email</a></td>
									</tr>");
								echo "<script>
								$('th').css('border','#000');
								$('td').css('border','#000');
								$('th').css('border-bottom', '2px solid #DDD;');
								$('td').css('border-top','1px solid #DDD;');

							</script>";	
							}
						}
						?>
					</tbody>
				</table>
			</div>

			<form class="form-horizontal" role="form">
				<div>

				</div>
			</form>
		</div>
		<script src="js/bootstrap.min.js"></script>
	</section>

</body>
</html>
