<?php
include('dbcon.php'); // Make sure $connection is defined in dbcon.php

if (isset($_POST['submit'])) {
    $firstname  = $_POST['firstname'];
    $lastname   = $_POST['lastname'];
    $gender     = $_POST['gender'];
    $address    = $_POST['address'];
    $contact    = $_POST['contact'];
    $type       = $_POST['type'];
    $year_level = $_POST['year_level'];

    // Prepare the insert statement
    $stmt = $connection->prepare("INSERT INTO member (firstname, lastname, gender, address, contact, type, year_level) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $firstname, $lastname, $gender, $address, $contact, $type, $year_level);

    if ($stmt->execute()) {
        header('Location: member.php');
        exit();
    } else {
        die("Error inserting member: " . $stmt->error);
    }

    $stmt->close();
}
?>
