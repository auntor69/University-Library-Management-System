<?php
include('dbcon.php'); // Make sure $conn = new mysqli(...) is inside this file

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Use prepared statement
    $stmt = $conn->prepare("UPDATE book SET status = 'Archive' WHERE book_id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: books.php");
        exit();
    } else {
        echo "Error updating book status: " . $conn->error;
    }
} else {
    echo "No book ID provided.";
}
?>
