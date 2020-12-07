<?php
$fullname = "";
$SSN = 0;
$number = 0;
$address = "";
$email = "";
$request_type = "";
$request_amount = "";
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
function addRequest($connection, $fullname, $SSN, $number, $address, $email, $family_members, $request_type, $request_amount)
{
    $orgname = "HelpLebanon";
    if ($request_type == "radio_food") {
        if ($family_members < $request_amount * 3) {
            return 2;
        } else {
            executeQuery($connection, "INSERT INTO `families` (`SSN`, `Address`, `Phone_Number`, `members`, `email`, `name`) VALUES ('$SSN', '$address', '$number', '$family_members', '$email', '$fullname')");
            $id = getMaxFid($connection, "SELECT `Fid` FROM `food-bank` WHERE available_stock = (SELECT MAX(available_stock) FROM `food-bank`)");
            $stock = getStock($connection, "SELECT `available_stock` FROM `food-bank` WHERE Fid = $id");
            if ($stock <= 0) {
                return -2;
            }
            if ($stock < $request_amount) {
                return -2;
            }
            executeQuery($connection, "INSERT INTO `reach_out` (`Families_SSN`, `Organization_name`, `type`, `quantity`) VALUES ('$SSN', '$orgname', 'Food', '$request_amount')");
            executeQuery($connection, "UPDATE `food-bank` SET available_stock = available_stock - '$request_amount' WHERE Fid = $id");
            return 1;
        }
    }
    if ($request_type == "radio_shelter") {
        executeQuery($connection, "INSERT INTO `families` (`SSN`, `Address`, `Phone_Number`, `members`, `email`, `name`) VALUES ('$SSN', '$address', '$number', '$family_members', '$email', '$fullname')");
        $id = getMinSid($connection, "SELECT `Sid` FROM `shelter` WHERE rem_capacity = (SELECT MAX(rem_capacity) FROM `shelter`)");
        $capacity = getCapacity($connection, "SELECT `rem_capacity` FROM `shelter` WHERE `Sid` = $id");
        if ($capacity <= 0) {
            return -2;
        }
        if ($capacity < $family_members) {
            return -2;
        }
        executeQuery($connection, "INSERT INTO `shelter_log` (`Shelter_Sid`, `Families_SSN`) VALUES ('$id', '$SSN')");
        executeQuery($connection, "INSERT INTO `reach_out` (`Families_SSN`, `Organization_name`, `type`, `quantity`) VALUES ('$SSN', '$orgname', 'Shelter', '$family_members')");
        executeQuery($connection, "UPDATE `shelter` SET rem_capacity = rem_capacity - '$family_members' WHERE `Sid`= $id");
        return 1;
    }
    if ($request_type == "radio_medical") {
        executeQuery($connection, "INSERT INTO `families` (`SSN`, `Address`, `Phone_Number`, `members`, `email`, `name`) VALUES ('$SSN', '$address', $number, $family_members, $email, $fullname)");
        $id = getMinCid($connection, "SELECT `Cid` FROM `clinics` WHERE rem_capacity = (SELECT MAX(rem_capacity) FROM `clinics`)");
        $capacity = getCapacity($connection, "SELECT `rem_capacity` FROM `clinics` WHERE `Cid` = $id");
        if ($capacity <= 0) {
            return -2;
        }
        if ($capacity < $family_members) {
            return -2;
        }
        executeQuery($connection, "INSERT INTO `clinics_log` (`Clinics_Cid`, `Families_SSN`) VALUES ('$id', '$SSN')");
        executeQuery($connection, "INSERT INTO `reach_out` (`Families_SSN`, `Organization_name`, `type`, `quantity`) VALUES ('$SSN', '$orgname', 'Medical', '$request_amount')");
        executeQuery($connection, "UPDATE `shelter` SET rem_capacity = rem_capacity - '$request_amount' WHERE `Cid`= $id");
        return 1;
    }
}
function getStock($connection, $query)
{
    $result = $connection->query($query);
    $row = $result->fetch_assoc();
    return $row['available_stock'];
}
function getCapacity($connection, $query)
{
    $result = $connection->query($query);
    $row = $result->fetch_assoc();
    return $row['rem_capacity'];
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
function getMaxFid($connection, $query)
{
    $result = $connection->query($query);
    $row = $result->fetch_assoc();
    return $row['Fid'];
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
