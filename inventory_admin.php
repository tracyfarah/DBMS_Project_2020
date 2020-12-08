<!DOCTYPE html>
<?php
require("./php/inventory_admindb.php");
session_start();
$connection = connectDB();
$id = $_SESSION['id'];
?>
<html class="no-js">

<head>
    <meta charset="utf-8">
    <title>Admin Page</title>
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


    <div class="page-heading text-center">

        <div class="container zoomIn animated">

            <h1 class="page-title">Ogranization Admin Page <span class="title-under"></span></h1>
            <p class="page-description">
                For members of the organization only.
            </p>

        </div>

    </div>

    <div class="main-container fadeIn animated">

        <div class="container">

            <div class="row">

                <div>

                    <h2 class="title-style-2">Your Information <span class="title-under"></span></h2>

                    <div class="form-group col-md-5">
                        <strong>Available Food boxes: </strong>
                        <span id="cl_name">
                            <?php
                            $result = getFood($connection, "SELECT `countof_food_boxes` FROM inventory WHERE Iid = $id");
                            echo $result; ?></span>
                        <form method="POST">
                            <input type="hidden" name="hid_type" value="food">
                            <button type="submit" class="btn pull-right" id="bt_request">Buy Food Boxes</button>
                        </form>
                        <br><br>
                        <strong>Available Medical Kits: </strong><span id="cl_cap">
                            <?php
                            $result = getMed($connection, "SELECT `countof_medical_kits` FROM inventory WHERE Iid = $id");
                            echo $result; ?></span>
                        <form method="POST">
                            <input type="hidden" name="hid_type" value="kits">
                            <button type="submit" class="btn pull-right" id="bt_request">Buy Medical Kits</button>
                        </form>
                        <br><br>
                        <strong>Available Beds: </strong><span id="cl_maxcap">
                            <?php
                            $result = getBeds($connection, "SELECT `countof_beds` FROM inventory WHERE Iid = $id");
                            echo $result; ?></span>
                        <form method="POST">
                            <input type="hidden" name="hid_type" value="beds">
                            <button type="submit" class="btn pull-right" id="bt_request">Buy Beds</button>
                        </form>
                        <br><br>
                        <strong>Budget: </strong><span id="cl_volunteers">
                            <?php
                            $result = getBudget($connection, "SELECT `budget` FROM organization");
                            echo $result; ?>$</span><br><br>
                    </div>
                    <div class="col-md-2"></div>
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['hid_type'] == "kits") {
        buyKits($connection, $id);
    }
    if ($_POST['hid_type'] == "food") {
        buyFood($connection, $id);
    }
    if ($_POST['hid_type'] == "beds") {
        buyBeds($connection, $id);
    }
}
?>