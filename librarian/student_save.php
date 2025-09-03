<?php 
include('dbcon.php');

if (isset($_POST['submit'])) {
    $firstname = mysqli_real_escape_string($connection, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($connection, $_POST['lastname']);
    $gender = mysqli_real_escape_string($connection, $_POST['gender']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);
    $contact = mysqli_real_escape_string($connection, $_POST['contact']);
    $type = mysqli_real_escape_string($connection, $_POST['type']);
    $year_level = mysqli_real_escape_string($connection, $_POST['year_level']);

    $query = "INSERT INTO member (firstname, lastname, gender, address, contact, type, year_level) 
              VALUES ('$firstname', '$lastname', '$gender', '$address', '$contact', '$type', '$year_level')";

    if (mysqli_query($connection, $query)) {
        header('Location: member.php');
        exit();
    } else {
        die("Error: " . mysqli_error($connection));
    }
}
?>
