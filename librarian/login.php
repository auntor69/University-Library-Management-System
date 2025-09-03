<?php
session_start();
include('dbcon.php'); // Make sure $connection is your mysqli connection

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare a statement to prevent SQL injection
    $stmt = $connection->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Check password (assuming passwords are stored hashed with password_hash)
        if (password_verify($password, $row['password'])) {
            $_SESSION['id'] = $row['user_id'];
            header('Location: dashboard.php');
            exit;
        } else {
            echo '<div class="alert alert-danger">Access Denied: Wrong Password</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Access Denied: User Not Found</div>';
    }
}
?>
