<!DOCTYPE html>
<?php
require("./php/what_we_need_db.php");
$connection = connectDB();
$food = getFood($connection);
$kits = getMed($connection);
$volunteers = getVolunteers($connection);
$money = getMoney($connection);
?>
<html class="no-js">

<head>
	<meta charset="utf-8">
	<title>What We Need</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Dosis:400,700' rel='stylesheet' type='text/css'>

	<!-- Bootsrap -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">


	<!-- Font awesome -->
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<!-- PrettyPhoto -->
	<link rel="stylesheet" href="assets/css/prettyPhoto.css">

	<!-- Template main Css -->
	<link rel="stylesheet" href="assets/css/style.css">

	<!-- Modernizr -->
	<script src="assets/js/modernizr-2.6.2.min.js"></script>


</head>

<body>
	<!-- NAVBAR
    ================================================== -->

	<header class="main-header">


		<nav class="navbar navbar-static-top">

			<div class="navbar-top">

				<div class="container">
					<div class="row">

						<div class="col-sm-6 col-xs-12">

							<ul class="list-unstyled list-inline header-contact">
								<li> <i class="fa fa-envelope"></i> helplebanon@gmail.com </li>
							</ul> <!-- /.header-contact  -->

						</div>

						<div class="col-sm-6 col-xs-12 text-right">

							<ul class="list-unstyled list-inline header-social">

								<li> <a href="#"> <i class="fa fa-facebook"></i> </a> </li>
								<li> <a href="#"> <i class="fa fa-twitter"></i> </a> </li>
								<li> <a href="#"> <i class="fa fa-google"></i> </a> </li>
								<li> <a href="#"> <i class="fa fa-youtube"></i> </a> </li>
								<li> <a href="#"> <i class="fa fa fa-pinterest-p"></i> </a> </li>
							</ul> <!-- /.header-social  -->

						</div>


					</div>
				</div>

			</div>

			<div class="navbar-main">

				<div class="container">

					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">

							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>

						</button>


					</div>

					<div id="navbar" class="navbar-collapse collapse pull-right">

						<ul class="nav navbar-nav">

							<li><a href="index.html">HOME</a></li>

							<li><a href="causes.php">WHAT WE NEED</a></li>
							<li><a href="help.php">REQUEST HELP</a></li>
							<li><a href="donations.php">DONATE</a></li>
							<li><a href="volunteer.php">VOLUNTEER</a></li>
							<li><a href="about.html">ABOUT US</a></li>
							<li id="right"><a href="login.php">LOGIN</a></li>

						</ul>

					</div> <!-- /#navbar -->

				</div> <!-- /.container -->

			</div> <!-- /.navbar-main -->


		</nav>

	</header> <!-- /. main-header -->


	<div class="page-heading text-center" style="background: url('assets/images/explosion.jpg') no-repeat center;">

		<div class="container zoomIn animated">

			<h1 class="page-title">WHAT WE NEED <span class="title-under"></span></h1>
			<p class="page-description">
				Discover what we need and how you can help.<br>
				Any small donation can make a huge impact on someone's life.
			</p>

		</div>

	</div>

	<div class="main-container">

		<div class="our-causes fadeIn animated">

			<div class="container">

				<h2 class="title-style-1">How to Help <span class="title-under"></span></h2>

				<div class="row">


					<div class="col-md-3 col-sm-6">

						<div class="cause" style="height: 500px;">

							<img src="assets/images/foodbox.jpg" style="height: fit-to-scale;" alt="" class="cause-img">

							<div class="progress cause-progress">
								<?php $perc = ($food / 300) * 100;
								echo "<div class='progress-bar' role='progressbar' aria-valuenow='$food' aria-valuemin='0' aria-valuemax='1000000' style='width: $perc%; color: black';>$food</div>"; ?>
							</div>

							<h4 class="cause-title"><a href="#">FOOD BOXES</a></h4>
							<div class="cause-details">

							</div>
							<div class="btn-holder text-center">

								<a href="./donations.php" class="btn btn-primary" data-toggle="modal" data-target="#donateModal"> DONATE NOW</a>

							</div>



						</div> <!-- /.cause -->

					</div>

					<div class="col-md-3 col-sm-6">

						<div class="cause" style="height: 500px;">

							<img src="assets/images/medkit.jpg" style="height: fit-to-scale;" alt="" class="cause-img">

							<div class="progress cause-progress">
								<?php $perc = ($kits / 200) * 100;
								echo "<div class='progress-bar' role='progressbar' aria-valuenow='$kits' aria-valuemin='0' aria-valuemax='1000000' style='width: $perc%; color: black';>$kits</div>"; ?>
							</div>

							<h4 class="cause-title"><a href="#">MEDICAL KITS</a></h4>
							<div class="cause-details">

							</div>

							<div class="btn-holder text-center">

								<a href="./donations.php" class="btn btn-primary" data-toggle="modal" data-target="#donateModal"> DONATE NOW</a>

							</div>



						</div> <!-- /.cause -->

					</div>


					<div class="col-md-3 col-sm-6">

						<div class="cause" style="height: 500px;">

							<img src="assets/images/volunteers.jpg" style="height: fit-to-scale;" alt="" class="cause-img">

							<div class="progress cause-progress">
								<?php $perc = ($volunteers / 150) * 100;
								echo "<div class='progress-bar' role='progressbar' aria-valuenow='$volunteers' aria-valuemin='0' aria-valuemax='150' style='width: $perc%; color: black';>$volunteers</div>"; ?>
							</div>

							<h4 class="cause-title"><a href="#">VOLUNTEERS</a></h4>
							<div class="cause-details">

							</div>

							<div class="btn-holder text-center">

								<a href="./volunteers.php" class="btn btn-primary" data-toggle="modal" data-target="#donateModal"> SIGN UP NOW</a>

							</div>



						</div> <!-- /.cause -->

					</div>

					<div class="col-md-3 col-sm-6">

						<div class="cause" style="height: 500px;">

							<img src="assets/images/donation.jpg" style="height: fit-to-scale;" alt="" class="cause-img">

							<div class="progress cause-progress">

								<?php $perc = ($money / 1000000) * 100;
								$amount = $money . "$";
								echo "<div class='progress-bar' role='progressbar' aria-valuenow='$money' aria-valuemin='0' aria-valuemax='1000000' style='width: $perc%; color: black';>$amount</div>"; ?>

							</div>

							<h4 class="cause-title"><a href="#">MONEY </a></h4>
							<div class="cause-details">

							</div>

							<div class="btn-holder text-center">

								<a href="./donations.php" class="btn btn-primary" > DONATE NOW</a>

							</div>



						</div> <!-- /.cause -->

					</div>

				</div>
			</div>
		</div> <!-- /.our-causes -->
	</div> <!-- /.main-container  -->

	<footer class="main-footer">

		<div class="footer-top">

		</div>

	</footer> <!-- main-footer -->



</body>

</html>