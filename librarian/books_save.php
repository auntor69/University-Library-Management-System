<?php 
include('dbcon.php');

if (isset($_POST['submit'])) {
    $book_title      = $_POST['book_title'];
    $category_id     = $_POST['category_id'];
    $author          = $_POST['author'];
    $book_copies     = $_POST['book_copies'];
    $book_pub        = $_POST['book_pub'];
    $publisher_name  = $_POST['publisher_name'];
    $isbn            = $_POST['isbn'];
    $copyright_year  = $_POST['copyright_year'];
    $status          = $_POST['status'];

    $query = "INSERT INTO book 
        (book_title, category_id, author, book_copies, book_pub, publisher_name, isbn, copyright_year, date_added, status) 
        VALUES 
        ('$book_title','$category_id','$author','$book_copies','$book_pub','$publisher_name','$isbn','$copyright_year',NOW(),'$status')";

    mysqli_query($connection, $query) or die(mysqli_error($connection));

    header('Location: books.php');
    exit();
}
?>
