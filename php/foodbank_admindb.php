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
function getName($connection, $query)
{
    $result = $connection->query($query);

    $row = $result->fetch_assoc();
    return $row['name'];
}
function getLocation($connection, $query)
{
    $result = $connection->query($query);

    $row = $result->fetch_assoc();
    return $row['location'];
}
function getVolunteers($connection, $query)
{
    $result = $connection->query($query);

    $row = $result->fetch_assoc();
    return $row['volunteers'];
}
function getStock($connection, $query)
{
    $result = $connection->query($query);

    $row = $result->fetch_assoc();
    return $row['available_stock'];
}
function requestFood($connection, $id)
{
    $result = $connection->query("SELECT countof_food_boxes FROM inventory");
    $row = $result->fetch_assoc();
    $count = $row['countof_food_boxes'];
    if ($row['countof_food_boxes'] == 0) {
        echo "<script type='text/javascript'>alert('Medical food boxes are currently unavailable.');</script>";
    } else if ($row['countof_food_boxes'] < 5) {
        echo "<script type='text/javascript'>alert('Less than 5 food boxes have been transferred to you. More will be available soon');</script>";
        $connection->query("UPDATE `inventory` SET countof_food_boxes = '0'");
        $connection->query("UPDATE `food-bank` SET `available_stock`= available_stock + '$count' WHERE Fid = '$id'");
    } else {
        echo "<script type='text/javascript'>alert('5 food boxes have been transferred to you');</script>";
        $connection->query("UPDATE `inventory` SET countof_food_boxes = countof_food_boxes - '5'");
        $connection->query("UPDATE `food-bank` SET `available_stock`= available_stock + '5' WHERE Fid = '$id'");
    }
}
