<?php
$username = "";
$password = "";

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
function passwordMatches($connection, $username, $password, $center)
{
    if ($center == "food-bank") {
        $result = selectQuery($connection, "SELECT `Fid` FROM `food-bank` WHERE `name`='$username'");
        return $result[0]["Fid"] == $password;
    }
    if ($center == "clinics") {
        $result = selectQuery($connection, "SELECT `Cid` FROM `clinics` WHERE `name`='$username'");
        return $result[0]["Cid"] == $password;
    }
    if ($center == "shelter") {
        $result = selectQuery($connection, "SELECT `Sid` FROM `shelter` WHERE `name`='$username'");
        return $result[0]["Sid"] == $password;
    }
    if ($center == "inventory") {
        $result = selectQuery($connection, "SELECT `Iid` FROM `inventory` WHERE `Organization_name`='$username'");
        return $result[0]["Iid"] == $password;
    }
}
function signInUser($connection, $username, $password, $center)
{
    if ($center == "clinic") {
        $center = "clinics";
        if (passwordMatches($connection, $username, $password, $center)) {
            return 1;
        }
    }
    if ($center == "food") {
        $center = "food-bank";
        if (passwordMatches($connection, $username, $password, $center)) {
            return 2;
        }
    }
    if ($center == "shelter") {
        if (passwordMatches($connection, $username, $password, $center)) {
            return 3;
        }
    }
    if ($center == "inventory") {
        if (passwordMatches($connection, $username, $password, $center)) {
            return 4;
        }
    }
    return -1;
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
