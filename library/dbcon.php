<?php
$connection = mysqli_connect("localhost", "root", "", "lib_management");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
