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
function getRemCap($connection, $query)
{
    $result = $connection->query($query);

    $row = $result->fetch_assoc();
    return $row['rem_capacity'];
}
function getMaxCap($connection, $query)
{
    $result = $connection->query($query);

    $row = $result->fetch_assoc();
    return $row['max_cap'];
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
function getFamilies($connection, $query)
{
    $result = $connection->query($query);

    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['name'] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>" . $row['SSN'] . "</td></tr>";
    }
}
function requestBed($connection, $id)
{
    $result = $connection->query("SELECT countof_beds FROM inventory");
    $row = $result->fetch_assoc();
    $count = $row['countof_beds'];
    if ($row['countof_beds'] == 0) {
        echo "<script type='text/javascript'>alert('Beds are currently unavailable.');</script>";
    } else if ($row['countof_beds'] < 5) {
        echo "<script type='text/javascript'>alert('Less than 5 beds have been transferred to you. More will be available soon');</script>";
        $connection->query("UPDATE `inventory` SET countof_beds = '0'");
        $connection->query("UPDATE `shelter` SET max_cap = max_cap + '$count', rem_capacity = rem_capacity + '$count' WHERE `Sid` = $id");
    } else {
        echo "<script type='text/javascript'>alert('5 beds have been transferred to you');</script>";
        $connection->query("UPDATE `inventory` SET countof_beds = countof_beds - '5'");
        $connection->query("UPDATE `shelter` SET max_cap = max_cap + '5', rem_capacity = rem_capacity + '5' WHERE `Sid` = $id");
    }
}
function removeFamily($connection, $SSN)
{
    $id = $connection->query("SELECT Shelter_Sid FROM `shelter_log` WHERE Families_SSN = $SSN");
    $connection->query("DELETE FROM `shelter_log` WHERE Families_SSN = $SSN");
    $res = $id->fetch_assoc();
    $res = $res['Shelter_Sid'];
    $member = $connection->query("SELECT members FROM `families` WHERE Families_SSN = $SSN");
    $member = $member->fetch_assoc();
    $member = $member['members'];
    $connection->query("UPDATE `shelter` SET rem_capacity = rem_capacity + $member WHERE `Sid` = $id");
    echo "<script type='text/javascript'>alert('The Family has been removed from the database, if it exists. Please reload for updated table.');</script>";
}
