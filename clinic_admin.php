<!DOCTYPE html>
<?php
require("./php/clinic_admindb.php");
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

            <h1 class="page-title">Clinic Admin Page <span class="title-under"></span></h1>
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
                        <strong>Name: </strong>
                        <span id="cl_name">
                            <?php
                            $result = getName($connection, "SELECT `name` FROM clinics WHERE Cid = $id");
                            echo $result; ?></span>
                        <br><br>
                        <strong>Location: </strong><span id="cl_location">
                            <?php
                            $result = getLocation($connection, "SELECT `location` FROM clinics WHERE Cid = $id");
                            echo $result; ?></span>
                        <br><br>
                        <strong>Capacity: </strong><span id="cl_cap">
                            <?php
                            $result = getRemCap($connection, "SELECT `rem_capacity` FROM clinics WHERE Cid = $id");
                            echo $result; ?></span>
                        <strong>Max Capacity: </strong><span id="cl_maxcap">
                            <?php
                            $result = getMaxCap($connection, "SELECT `max_cap` FROM clinics WHERE Cid = $id");
                            echo $result; ?></span>
                        <form method="POST">
                            <input type="hidden" name="hid_type" value="kits">
                            <button type="submit" class="btn pull-right" id="bt_request">Request Medical Kits</button>
                        </form>
                        <br><br>
                        <strong>Number of Volunteers: </strong><span id="cl_volunteers">
                            <?php
                            $result = getVolunteers($connection, "SELECT `volunteers` FROM clinics WHERE Cid = $id");
                            echo $result; ?></span><br><br>
                        <strong>Families: </strong><br><br>
                        <table id="fam_table" class="table-style-1" style="margin-left: 20px;">
                            <tr>
                                <th>Family Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th>Initial SSN</th>
                            </tr>
                            <?php getFamilies($connection, "SELECT F.name, F.SSN FROM `families` F INNER JOIN `clinics_log` L ON F.SSN = L.Families_SSN AND L.Clinics_Cid = $id"); ?>
                        </table>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="form-group col-md-4">
                        <strong>Remove Families: </strong> <br><br>
                        <form method="POST">
                            <label for="txt_removefam" style="font-weight: normal;">Enter Family SSN:</label>
                            <input type="number" name="txt_removefam" class="form-control" placeholder="Enter Family SSN" id="txt_removefam" required><br>
                            <input type="hidden" name="hid_type" value="family">
                            <button type="submit" class="btn btn-primary pull-5" id="bt_removefam">Remove</button>
                        </form>
                    </div>
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
        requestKit($connection);
    }
    if ($_POST['hid_type'] == "family") {
        removeFamily($connection, $_POST['txt_removefam']);
    }
}
?>