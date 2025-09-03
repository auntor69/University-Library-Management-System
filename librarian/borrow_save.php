<?php
include('dbcon.php');

$id        = isset($_POST['selector']) ? $_POST['selector'] : '';
$member_id = $_POST['member_id'];
$due_date  = $_POST['due_date'];

if ($id == '') { 
    header("Location: borrow.php");
    exit();
} else {
    // Insert into borrow table
    $query = "INSERT INTO borrow (member_id, date_borrow, due_date) 
              VALUES ('$member_id', NOW(), '$due_date')";
    mysqli_query($connection, $query) or die(mysqli_error($connection));

    // Get last inserted borrow_id
    $borrow_id = mysqli_insert_id($connection);

    // Insert into borrowdetails for each selected book
    $N = count($id);
    for ($i = 0; $i < $N; $i++) {
        $book_id = $id[$i];
        $query_details = "INSERT INTO borrowdetails (book_id, borrow_id, borrow_status) 
                          VALUES ('$book_id', '$borrow_id', 'pending')";
        mysqli_query($connection, $query_details) or die(mysqli_error($connection));
    }

    header("Location: borrow.php");
    exit();
}
?>
