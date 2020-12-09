<!DOCTYPE html>
<html class="no-js">

<head>
	<meta charset="utf-8">
	<title>Request Help</title>
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

	<div class="page-heading text-center" style="background: url('assets/images/request.jpg') center;">

		<div class="container zoomIn animated">

			<h1 class="page-title">REQUEST HELP <span class="title-under"></span></h1>
			<p class="page-description">
				If you need help or know families in urgent need please fill all the<br>
				info below and we will review it and provide you with the help needed.<br>

			</p>

		</div>

	</div>

	<div class="main-container fadeIn animated">

		<div class="container">

			<div class="row">

				<div class="col-md-7 col-sm-12 col-form">

					<h2 class="title-style-2">Fill this Form <span class="title-under"></span></h2>

					<form method="POST" class="contact-form ajax-form">

						<div class="row">

							<div class="form-group col-md-8">
								<label for="txt_famname"><strong>Name *</strong></label>
								<input type="text" name="txt_famname" class="form-control" placeholder="Enter Name" id="txt_username" required>
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
								<label for="txt_email"><strong>Email Address</strong> (optional)</label>
								<input type="text" name="txt_email" class="form-control" placeholder="Enter Email Address" id="txt_email">
							</div>

							<div class="form-group col-md-8">
								<label for="txt_members"><strong>Family Members *</strong></label>
								<input type="number" name="txt_members" id="txt_members" min="1" max="10" value="1">
							</div>

							<div class="form-group col-md-8">
								<label for="txt_helptype"><strong>What type of help do you need?</strong></label><br>
								<input type="radio" id="radio_food" name="help" value="radio_food">
								<label for="radio_food" style="font-weight: normal;">Food</label><br>
								<input type="radio" id="radio_shelter" name="help" value="radio_shelter">
								<label for="radio_shelter" style="font-weight: normal;">Shelter</label><br>
								<input type="radio" id="radio_medical" name="help" value="radio_medical">
								<label for="radio_medical" style="font-weight: normal;">Medical Attention</label><br>
								<label for="txt_qty" style="margin-right: 5px;"><strong>Quantity (use only for medical and food)</strong></label>
								<input type="number" name="txt_qty" id="txt_qty" min="1" max="10" value="1">
							</div>

							<div class="form-group col-md-8">
								<label for="txt_cmts"><strong>Other Comments</strong></label>
								<textarea name="txt_cmts" id="txt_cmts" class="form-control" placeholder="Leave your comments here."></textarea>
							</div>


						</div>
						<div class="form-group">
							<button type="submit" id="bt-request" class="btn btn-primary pull-5">Submit request</button>
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
require("./php/helpdb.php");
$connection = connectDB();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	echo $_POST['txt_email'];
	$result = addRequest($connection, $_POST["txt_famname"], $_POST["txt_ssn"], $_POST["txt_phone"], $_POST["txt_addr"], $_POST["txt_email"], $_POST["txt_members"], $_POST['help'], $_POST['txt_qty']);
	if ($result == 1) {
		echo "<script type='text/javascript'>alert('Request sent. We will get in contact with you shortly');</script>";
	}
	if ($result == 2) {
		echo "<script type='text/javascript'>alert('Request denied. Please note that a maximum of one box per 3 members can be ordered.');</script>";
	}
	if ($result == -2) {
		echo "<script type='text/javascript'>alert('We are sorry. There is not enough supplies to help you at the moment.');</script>";
	}
}
?>