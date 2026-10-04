<?php

$conn = mysqli_connect("localhost", "root", "", "book_store");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

echo "Database Connected Successfully!";

?>