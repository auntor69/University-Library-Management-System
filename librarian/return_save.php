<?php 
include('dbcon.php');

$id = mysqli_real_escape_string($connection, $_GET['id']);
$book_id = mysqli_real_escape_string($connection, $_GET['book_id']);

$query = "UPDATE borrow 
          LEFT JOIN borrowdetails ON borrow.borrow_id = borrowdetails.borrow_id
          SET borrow_status='returned', date_return = NOW()
          WHERE borrow.borrow_id='$id' AND borrowdetails.book_id='$book_id'";

if (mysqli_query($connection, $query)) {
    header('Location: view_borrow.php');
    exit();
} else {
    die("Error: " . mysqli_error($connection));
}
?>
