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
function getFood($connection)
{
    $result = $connection->query("SELECT `countof_food_boxes` FROM `inventory` WHERE Iid = '564387'");

    $row = $result->fetch_assoc();
    return $row['countof_food_boxes'];
}
function getMed($connection)
{
    $result = $connection->query("SELECT `countof_medical_kits` FROM `inventory` WHERE Iid = '564387'");

    $row = $result->fetch_assoc();
    return $row['countof_medical_kits'];
}
function getBeds($connection)
{
    $result = $connection->query("SELECT `countof_beds` FROM `inventory` WHERE Iid = '564387'");

    $row = $result->fetch_assoc();
    return $row['countof_beds'];
}
function getVolunteers($connection)
{
    $result = $connection->query("SELECT COUNT(*) FROM `volunteer_in`");

    $row = $result->fetch_assoc();
    return $row['COUNT(*)'];
}
function getMoney($connection)
{
    $result = $connection->query("SELECT `budget` FROM `organization` WHERE `name` = 'HelpLebanon'");

    $row = $result->fetch_assoc();
    return $row['budget'];
}
