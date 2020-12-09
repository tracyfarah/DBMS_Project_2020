<?php
$fullname = "";
$SSN = 0;
$number = 0;
$address = "";
$email = "";
$donation_type = "";
$donation_amount = "";
$orgname = "HelpLebanon";

function connectDB()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dbproject";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
function addVolunteer($connection, $fullname, $SSN, $number, $address, $email, $donation_type)
{
    $orgname = "HelpLebanon";
    $results = executeQuery($connection, "INSERT INTO volunteers (Vid, name, phone_number, address, email) VALUES ('$SSN', '$fullname', '$number', '$address', '$email')");
    if ($donation_type == "vt_clinic") {
        $id = getMinCid($connection, "SELECT `Cid` FROM `clinics` WHERE volunteers = (SELECT MIN(volunteers) FROM `clinics`)");
        executeQuery($connection, "UPDATE `clinics` SET volunteers = volunteers + '1' WHERE Cid = '$id'");
        executeQuery($connection, "INSERT INTO `medical_volunteers` (`Clinics_Cid`, `Volunteers_Vid`) VALUES ('$id', '$SSN')");
        executeQuery($connection, "INSERT INTO `volunteer_in` (`Organization_name`, `Volunteers_Vid`) VALUES ('$orgname', '$SSN')");
        $location = getLocation($connection, "SELECT `location` FROM `clinics` WHERE Cid = '$id'");
    }
    if ($donation_type == "vt_food") {
        $id = getMinFid($connection, "SELECT `Fid` FROM `food-bank` WHERE volunteers = (SELECT MIN(volunteers) FROM `food-bank`)");
        executeQuery($connection, "UPDATE `food-bank` SET volunteers = volunteers + '1' WHERE Fid = '$id'");
        executeQuery($connection, "INSERT INTO `food-bank_volunteers` (`Food-Bank_Fid`, Volunteers_Vid) VALUES ('$id', '$SSN')");
        executeQuery($connection, "INSERT INTO `volunteer_in` (`Organization_name`, `Volunteers_Vid`) VALUES ('$orgname', '$SSN')");
        $location = getLocation($connection, "SELECT `location` FROM `food-bank` WHERE Fid = '$id'");
    }
    if ($donation_type == "vt_shelter") {
        $id = getMinSid($connection, "SELECT `Sid` FROM `shelter` WHERE volunteers = (SELECT MIN(volunteers) FROM `shelter`)");
        executeQuery($connection, "UPDATE `shelter` SET volunteers = volunteers + '1' WHERE `Sid` = '$id'");
        executeQuery($connection, "INSERT INTO `shelter_volunteers` (`Shelter_Sid`, Volunteers_Vid) VALUES ('$id', '$SSN')");
        executeQuery($connection, "INSERT INTO `volunteer_in` (`Organization_name`, `Volunteers_Vid`) VALUES ('$orgname', '$SSN')");
        $location = getLocation($connection, "SELECT `location` FROM `shelter` WHERE `Sid` = '$id'");
    }
    return $location;
}
function getLocation($connection, $query)
{
    $result = $connection->query($query);

    $row = $result->fetch_assoc();
    return $row['location'];
}
function getMinFid($connection, $query)
{
    $result = $connection->query($query);

    $row = $result->fetch_assoc();
    return $row['Fid'];
}
function getMinCid($connection, $query)
{
    $result = $connection->query($query);

    $row = $result->fetch_assoc();
    return $row['Cid'];
}
function getMinSid($connection, $query)
{
    $result = $connection->query($query);

    $row = $result->fetch_assoc();
    return $row['Sid'];
}
function executeQuery($connection, $query)
{
    $result = $connection->query($query);
    return $result;
}
function selectQuery($connection, $query)
{
    $result = $connection->query($query);

    $multiArray = array();
    while ($row = $result->fetch_assoc()) {
        array_push($multiArray, $row);
    }
    return $multiArray;
}
