<?php 
include('dbcon.php');

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $book_title = $_POST['book_title'];
    $category_id = $_POST['category_id'];
    $author = $_POST['author'];
    $book_copies = $_POST['book_copies'];
    $book_pub = $_POST['book_pub'];
    $publisher_name = $_POST['publisher_name'];
    $isbn = $_POST['isbn'];
    $copyright_year = $_POST['copyright_year'];
    $status = $_POST['status'];

    // Prepare the query
    $query = "UPDATE book 
              SET book_title=?, category_id=?, author=?, book_copies=?, book_pub=?, publisher_name=?, isbn=?, copyright_year=?, status=?
              WHERE book_id=?";

    $stmt = mysqli_prepare($connection, $query);
    if ($stmt === false) {
        die("MySQLi Prepare failed: " . mysqli_error($connection));
    }

    // Bind parameters (s = string, i = integer)
    mysqli_stmt_bind_param(
        $stmt, 
        "sisiissssi", 
        $book_title, 
        $category_id, 
        $author, 
        $book_copies, 
        $book_pub, 
        $publisher_name, 
        $isbn, 
        $copyright_year, 
        $status, 
        $id
    );

    // Execute statement
    if (mysqli_stmt_execute($stmt)) {
        header('Location: books.php');
        exit();
    } else {
        die("Update failed: " . mysqli_stmt_error($stmt));
    }

    mysqli_stmt_close($stmt);
}
?>
