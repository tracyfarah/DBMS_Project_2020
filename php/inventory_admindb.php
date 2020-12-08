<?php
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
function getFood($connection, $query)
{
    $result = $connection->query($query);

    $row = $result->fetch_assoc();
    return $row['countof_food_boxes'];
}
function getMed($connection, $query)
{
    $result = $connection->query($query);

    $row = $result->fetch_assoc();
    return $row['countof_medical_kits'];
}
function getBeds($connection, $query)
{
    $result = $connection->query($query);

    $row = $result->fetch_assoc();
    return $row['countof_beds'];
}
function getBudget($connection, $query)
{
    $result = $connection->query($query);

    $row = $result->fetch_assoc();
    return $row['budget'];
}
function buyFood($connection, $id)
{
    $result = $connection->query("SELECT budget FROM organization");
    $row = $result->fetch_assoc();
    $count = $row['budget'];
    $count = $count / 10;
    $count = floor($count);
    if ($row['budget'] == 0) {
        echo "<script type='text/javascript'>alert('Not enough money.');</script>";
    } else if ($row['budget'] < 50) {
        echo "<script type='text/javascript'>alert('Less than 10 food boxes will be bought.');</script>";
        $connection->query("UPDATE `organization` SET budget = '0'");
        $connection->query("UPDATE `inventory` SET `countof_food_boxes`= countof_food_boxes + '$count' WHERE Iid = '$id'");
    } else {
        echo "<script type='text/javascript'>alert('10 food boxes have been transferred to you');</script>";
        $connection->query("UPDATE `organization` SET budget = budget - '50'");
        $connection->query("UPDATE `inventory` SET `countof_food_boxes`= countof_food_boxes + '10' WHERE Iid = '$id'");
    }
}
function buyKits($connection, $id)
{
    $result = $connection->query("SELECT budget FROM organization");
    $row = $result->fetch_assoc();
    $count = $row['budget'];
    $count = $count / 20;
    $count = floor($count);
    if ($row['budget'] == 0) {
        echo "<script type='text/javascript'>alert('Not enough money.');</script>";
    } else if ($row['budget'] < 200) {
        echo "<script type='text/javascript'>alert('Less than 10 medical kits have been bought.');</script>";
        $connection->query("UPDATE `organization` SET budget = '0'");
        $connection->query("UPDATE `inventory` SET `countof_medical_kits`= countof_medical_kits + '$count' WHERE Iid = '$id'");
    } else {
        echo "<script type='text/javascript'>alert('5 food boxes have been transferred to you');</script>";
        $connection->query("UPDATE `organization` SET budget = '0'");
        $connection->query("UPDATE `inventory` SET `countof_medical_kits`= countof_medical_kits + '10' WHERE Iid = '$id'");
    }
}
function buyBeds($connection, $id)
{
    $result = $connection->query("SELECT budget FROM organization");
    $row = $result->fetch_assoc();
    $count = $row['budget'];
    $count = $count / 30;
    $count = floor($count);
    if ($row['budget'] == 0) {
        echo "<script type='text/javascript'>alert('Not enough money.');</script>";
    } else if ($row['budget'] < 5) {
        echo "<script type='text/javascript'>alert('Less than 5 beds have been bought.');</script>";
        $connection->query("UPDATE `organization` SET budget = '0'");
        $connection->query("UPDATE `inventory` SET `countof_beds`= countof_beds + '$count' WHERE Iid = '$id'");
    } else {
        echo "<script type='text/javascript'>alert('5 food boxes have been transferred to you');</script>";
        $connection->query("UPDATE `organization` SET budget = '0'");
        $connection->query("UPDATE `inventory` SET `countof_food_boxes`= countof_food_boxes + '10' WHERE Iid = '$id'");
    }
}
