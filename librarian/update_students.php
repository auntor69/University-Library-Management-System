<?php 
include('dbcon.php');

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $type = $_POST['type'];
    $year_level = $_POST['year_level'];

    // Prepare the query using MySQLi
    $query = "UPDATE member 
              SET firstname=?, lastname=?, gender=?, address=?, contact=?, type=?, year_level=? 
              WHERE member_id=?";

    // Initialize prepared statement
    $stmt = mysqli_prepare($connection, $query);
    if ($stmt === false) {
        die("MySQLi Prepare failed: " . mysqli_error($connection));
    }

    // Bind parameters (s = string, i = integer)
    mysqli_stmt_bind_param($stmt, "sssssssi", $firstname, $lastname, $gender, $address, $contact, $type, $year_level, $id);

    // Execute statement
    if (mysqli_stmt_execute($stmt)) {
        // Redirect after successful update
        header('Location: students.php');
        exit();
    } else {
        die("Update failed: " . mysqli_stmt_error($stmt));
    }

    // Close statement
    mysqli_stmt_close($stmt);
}
?>
