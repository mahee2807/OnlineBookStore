<?php

session_start();

include "db.php";

if (!isset($_SESSION["user_id"])) {

    echo "Please login first";
    exit;

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id = $_SESSION["user_id"];

    $book_id = $_POST["book_id"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];

    $total_amount = $price * $quantity;


    // Insert order

    $sql = "INSERT INTO orders
            (user_id, total_amount)
            VALUES
            ('$user_id', '$total_amount')";


    if (mysqli_query($conn, $sql)) {

        $order_id = mysqli_insert_id($conn);


        // Insert order item

        $sql2 = "INSERT INTO order_items
                 (order_id, book_id, quantity, price)
                 VALUES
                 ('$order_id', '$book_id', '$quantity', '$price')";


        if (mysqli_query($conn, $sql2)) {

            echo "success";

        } else {

            echo "Order item failed: " . mysqli_error($conn);

        }

    } else {

        echo "Order failed: " . mysqli_error($conn);

    }

}

?>