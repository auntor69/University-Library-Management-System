<?php
include('dbcon.php');
session_start();

if (isset($_POST['login'])) {
    $student_no = $_POST['student_no'];
    $password = $_POST['password'];

    // Use prepared statement to prevent SQL injection
    $stmt = mysqli_prepare($connection, "SELECT student_id, password FROM students WHERE student_no = ? AND status = 'active'");
    mysqli_stmt_bind_param($stmt, "s", $student_no);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($result)) {
        // If you hashed passwords, use password_verify($password, $row['password'])
        if ($password === $row['password']) { // replace with password_verify if hashed
            $_SESSION['id'] = $row['student_id'];
            header('Location: dashboard.php');
            exit;
        } else {
            header('Location: access_denied.php');
            exit;
        }
    } else {
        header('Location: access_denied.php');
        exit;
    }
}
?>
