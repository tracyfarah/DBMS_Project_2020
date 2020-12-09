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
function addDonation($connection, $fullname, $SSN, $number, $address, $email, $donation_type, $donation_amount)
{
    $orgname = "HelpLebanon";
    $results = executeQuery($connection, "INSERT INTO donor (Did, name, phone_number, location, email) VALUES ('$SSN', '$fullname', '$number', '$address', '$email')");
    if ($donation_type == "dt_money") {
        executeQuery($connection, "INSERT INTO donates_to (Donor_idDonor, Organization_name, donation_type, quantity) VALUES ('$SSN', '$orgname', 'Money', '$donation_amount')");
        executeQuery($connection, "UPDATE organization SET budget = budget + '$donation_amount' WHERE name = '$orgname';");
    }
    if ($donation_type == "dt_food") {
        echo "hello";
        executeQuery($connection, "INSERT INTO donates_to (Donor_idDonor, Organization_name, donation_type, quantity) VALUES ('$SSN', '$orgname', 'Food', '$donation_amount')");
        executeQuery($connection, "UPDATE inventory SET countof_food_boxes = countof_food_boxes + '$donation_amount' WHERE Iid = '564387';");
    }
    if ($donation_type == "dt_shelter") {
        executeQuery($connection, "INSERT INTO donates_to (Donor_idDonor, Organization_name, donation_type, quantity) VALUES ('$SSN', '$orgname', 'Medical Supplies', '$donation_amount')");
        executeQuery($connection, "UPDATE inventory SET countof_medical_kits = countof_medical_kits + '$donation_amount' WHERE Iid = '564387';");
    }

    return $results;
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