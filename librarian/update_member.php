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
    $status = $_POST['status'];

    // Prepare the query
    $query = "UPDATE member 
              SET firstname=?, lastname=?, gender=?, address=?, contact=?, type=?, year_level=?, status=? 
              WHERE member_id=?";

    $stmt = mysqli_prepare($connection, $query);
    if ($stmt === false) {
        die("MySQLi Prepare failed: " . mysqli_error($connection));
    }

    // Bind parameters (s = string, i = integer)
    mysqli_stmt_bind_param($stmt, "ssssssssi", $firstname, $lastname, $gender, $address, $contact, $type, $year_level, $status, $id);

    // Execute statement
    if (mysqli_stmt_execute($stmt)) {
        // Redirect after successful update
        header('Location: member.php');
        exit();
    } else {
        die("Update failed: " . mysqli_stmt_error($stmt));
    }

    // Close statement
    mysqli_stmt_close($stmt);
}
?>
