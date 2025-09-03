<?php
include('dbcon.php'); // make sure this defines $conn as the mysqli connection

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: users.php");
        exit();
    } else {
        echo "Error deleting user: " . $conn->error;
    }
} else {
    echo "No user ID specified.";
}
?>
