<?php
include('dbcon.php');
session_start();

if (isset($_POST['login'])) {
    $student_no = $_POST['student_no'];
    $password = $_POST['password'];

    // Prepare and execute query
    $stmt = $connection->prepare("SELECT student_id, password FROM students WHERE student_no=? AND status='active'");
    $stmt->bind_param("s", $student_no);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($student_id, $hashed_password);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $hashed_password)) {
            $_SESSION['id'] = $student_id;
            header('Location: dashboard.php');
            exit();
        } else {
            // Wrong password
            header('Location: access_denied.php');
            exit();
        }
    } else {
        // Student number not found or not active
        header('Location: access_denied.php');
        exit();
    }

    $stmt->close();
}
?>
