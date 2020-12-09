<!DOCTYPE html>
<html class="no-js">

<head>
	<meta charset="utf-8">
	<title>Volunteer</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Dosis:400,700' rel='stylesheet' type='text/css'>

	<!-- Bootsrap -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">

	<!-- Font awesome -->
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

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

							</ul> <!-- /.header-social  -->

						</div>


					</div>
				</div>

			</div>

			<div class="navbar-main">

				<div class="container">

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


	<div class="page-heading text-center" style="background: url('assets/images/beirut6.jpg') center no-repeat;">

		<div class="container zoomIn animated">

			<h1 class="page-title">Volunteer<span class="title-under"></span></h1>
			<p class="page-description">
				Volunteer and help many others.<br>
				We will match you with groups of volunteers to help families and people in need.<br>
				Our team will be in contact with you very soon.
			</p>
		</div>
	</div>
	<div class="main-container fadeIn animated">
		<div class="container">
			<div class="row">
				<div class="col-md-7 col-sm-12 col-form">
					<h2 class="title-style-2">Sign up to volunteer <span class="title-under"></span></h2>
					<i>You must be at least 18* years of age.</i> <br><br>
					<form method="POST" class="contact-form ajax-form">

						<div class="row">

							<div class="form-group col-md-8">
								<label for="txt_volname"><strong>Full Name *</strong></label>
								<input type="text" name="txt_volname" class="form-control" placeholder="Enter Full Name" id="txt_volname" required>
							</div>

							<div class="form-group col-md-8">
								<label for="txt_ssn"><strong>Social Security Number *</strong></label>
								<input type="number" name="txt_ssn" class="form-control" placeholder="Enter SSN" id="txt_ssn" required>
							</div>


							<div class="form-group col-md-8">
								<label for="txt_phone"><strong>Phone Number *</strong></label>
								<input type="number" name="txt_phone" class="form-control" placeholder="Enter Phone Number" id="txt_phone" required>
							</div>

							<div class="form-group col-md-8">
								<label for="txt_addr"><strong>Address *</strong></label>
								<textarea name="txt_addr" id="txt_addr" class="form-control" placeholder="Enter your full address here." required></textarea>
							</div>

							<div class="form-group col-md-8">
								<label for="txt_email"><strong>Email Address *</strong></label>
								<input type="text" name="txt_email" class="form-control" placeholder="Enter Email Address" id="txt_email" required>
							</div>

							<div class="form-group col-md-8">
								<label for="txt_cmts"><strong>Other Comments</strong></label>
								<textarea name="txt_cmts" id="txt_cmts" class="form-control" placeholder="Leave your comments here."></textarea>
							</div>

							<div class="form-group col-md-8">
								<label for="txt_donation"><strong>Volunteering Domain</strong></label><br>
								<input type="radio" id="vt_food" name="txt_donation" value="vt_food">
								<label for="dt_money" style="font-weight: normal;">Food Distribution</label><br>
								<input type="radio" id="vt_clinic" name="txt_donation" value="vt_clinic">
								<label for="dt_food" style="font-weight: normal;">Medical Assistance</label><br>
								<input type="radio" id="vt_shelter" name="txt_donation" value="vt_shelter">
								<label for="dt_medical" style="font-weight: normal;">Shelter Supervision</label><br>
							</div>

						</div>
						<div class="form-group">
							<br><br>
							<button type="submit" id="bt_volunteer" class="btn btn-primary pull-5">Sign Up</button>
						</div>
					</form>
				</div>
			</div> <!-- /.row -->
		</div>
	</div>

	<footer class="main-footer">
		<div class="footer-top">
		</div>
	</footer> <!-- main-footer -->

</body>

</html>

<?php
require("./php/volunteerdb.php");
$connection = connectDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$result = addVolunteer($connection, $_POST["txt_volname"], $_POST["txt_ssn"], $_POST["txt_phone"], $_POST["txt_addr"], $_POST["txt_email"], $_POST["txt_donation"]);
	echo "<script type='text/javascript'>alert('You will be helping in our branch at $result.');</script>";
}
?>