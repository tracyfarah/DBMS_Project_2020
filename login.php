<!DOCTYPE html>
<?php ob_start(); ?>
<html class="no-js">

<head>
  <meta charset="utf-8">
  <title>Login to your account.</title>
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

  <div class="page-heading text-center" style="background: url('assets/images/login.jpg') center;">

    <div class="container zoomIn animated">

      <h1 class="page-title">SIGN IN <span class="title-under"></span></h1>
      <p class="page-description">
        For members of the organization only.
      </p>

    </div>

  </div>

  <div class="main-container fadeIn animated">

    <div class="container">

      <div class="row">

        <div class="col-md-6 col-sm-12 col-form">

          <h2 class="title-style-2">Log in to your account <span class="title-under"></span></h2>

          <form method="POST" class="contact-form ajax-form">

            <div class="row">

              <div class="form-group col-md-7">
                <label for="username"><strong>Username</strong></label>
                <input type="text" name="txt_username" class="form-control" placeholder="Enter Username" id="txt_username" required>
              </div>

              <div class="form-group col-md-7">
                <label for="txt_pass"><strong>Password</strong></label>
                <input type="password" name="txt_pass" class="form-control" placeholder="Enter Username" id="txt_pass" required>
              </div>

              <div class="form-group col-md-8">
                <label for="txt_type"><strong>Section</strong></label><br>
                <input type="radio" id="clinic" name="txt_type" value="clinic">
                <label for="clinc" style="font-weight: normal;">Clinic</label><br>
                <input type="radio" id="shelter" name="txt_type" value="shelter">
                <label for="shelter" style="font-weight: normal;">Shelter</label><br>
                <input type="radio" id="food" name="txt_type" value="food">
                <label for="food" style="font-weight: normal;">Feeding Center</label><br>
                <input type="radio" id="inventory" name="txt_type" value="inventory">
                <label for="inventory" style="font-weight: normal;">Inventory</label><br>
              </div>

            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary pull-5">Sign in</button>
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
require("./php/logindb.php");
$connection = connectDB();
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $result = signInUser($connection, $_POST['txt_username'], $_POST['txt_pass'], $_POST['txt_type']);
  if ($result == 1) {
    $_SESSION['id'] = $_POST['txt_pass'];
    header("Location: clinic_admin.php");
  }
  if ($result == 2) {
    $_SESSION['id'] = $_POST['txt_pass'];
    header("Location: foodbank_admin.php");
  }
  if ($result == 3) {
    $_SESSION['id'] = $_POST['txt_pass'];
    header("Location: shelter_admin.php");
  }
  if ($result == 4) {
    $_SESSION['id'] = $_POST['txt_pass'];
    header("Location: inventory_admin.php");
  }
  if ($result == -1) {
    echo "<script type='text/javascript'>alert('The username, domain or password is wrong. Please try again.');</script>";
  }
}
ob_flush();
?>