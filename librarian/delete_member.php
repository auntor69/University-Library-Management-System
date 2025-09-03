<?php
include('dbcon.php'); // make sure $conn = new mysqli(...) is inside this file

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Use prepared statement to avoid SQL injection
    $stmt = $conn->prepare("DELETE FROM member WHERE member_id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: member.php");
        exit();
    } else {
        echo "Error deleting member: " . $conn->error;
    }
} else {
    echo "No member ID provided.";
}
?>
