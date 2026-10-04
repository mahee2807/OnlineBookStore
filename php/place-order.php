<?php

include "db.php";


// Check request

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    die("Invalid request.");

}


// Get cart

$cart_json = $_POST["cart"] ?? "";


if ($cart_json == "") {

    die("Cart data was not received.");

}


$cart = json_decode(
    $cart_json,
    true
);


if (!is_array($cart)) {

    die("Invalid cart data.");

}


if (count($cart) == 0) {

    die("Cart is empty.");

}


// Calculate total

$total = 0;


foreach ($cart as $book) {

    $price =
        isset($book["price"])
        ? (float)$book["price"]
        : 0;

    $quantity =
        isset($book["quantity"])
        ? (int)$book["quantity"]
        : 1;


    if ($quantity < 1) {
        $quantity = 1;
    }


    $total +=
        $price * $quantity;
}


// Insert order

$sql = "
    INSERT INTO orders
    (user_id, total_amount)
    VALUES
    (NULL, ?)
";


$stmt = mysqli_prepare(
    $conn,
    $sql
);


if (!$stmt) {

    die(
        "Order error: " .
        mysqli_error($conn)
    );

}


mysqli_stmt_bind_param(
    $stmt,
    "d",
    $total
);


if (!mysqli_stmt_execute($stmt)) {

    die(
        "Order could not be saved: " .
        mysqli_stmt_error($stmt)
    );

}


// Get Order ID

$order_id =
    mysqli_insert_id($conn);


mysqli_stmt_close($stmt);


// Check Order ID

if (!$order_id) {

    die("Order ID was not created.");

}


// Insert books into order_items

$item_sql = "
    INSERT INTO order_items
    (order_id, book_id, quantity, price)
    VALUES
    (?, ?, ?, ?)
";


$item_stmt = mysqli_prepare(
    $conn,
    $item_sql
);


if (!$item_stmt) {

    die(
        "Order item error: " .
        mysqli_error($conn)
    );

}


foreach ($cart as $book) {

    $book_id =
        isset($book["id"])
        ? (int)$book["id"]
        : 0;

    $price =
        isset($book["price"])
        ? (float)$book["price"]
        : 0;

    $quantity =
        isset($book["quantity"])
        ? (int)$book["quantity"]
        : 1;


    if ($quantity < 1) {
        $quantity = 1;
    }


    if ($book_id <= 0) {

        die("Invalid book ID.");

    }


    mysqli_stmt_bind_param(
        $item_stmt,
        "iiid",
        $order_id,
        $book_id,
        $quantity,
        $price
    );


    if (!mysqli_stmt_execute($item_stmt)) {

        die(
            "Book could not be saved: " .
            mysqli_stmt_error($item_stmt)
        );

    }

}


mysqli_stmt_close($item_stmt);

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Order Successful
    </title>

    <link
        rel="stylesheet"
        href="../css/style.css"
    >

</head>

<body>


<header>

    <div class="logo">
        📚 Online Book Store
    </div>

    <nav>

        <a href="../index.html">
            Home
        </a>

        <a href="book.php">
            Books
        </a>

        <a href="../cart.html">
            Cart 🛒
        </a>

    </nav>

</header>


<section class="checkout-page">

    <h1>
        🎉 Order Placed Successfully!
    </h1>


    <h2>
        Order ID: #<?php echo $order_id; ?>
    </h2>


    <p>
        Your order has been saved successfully.
    </p>


    <h2>
        Total: ₹<?php echo number_format($total, 2); ?>
    </h2>


    <br>


    <a
        href="../index.html"
        class="small-btn"
    >
        Continue Shopping
    </a>

</section>


<footer>

    <h3>
        📚 Online Book Store
    </h3>

    <p>
        Your place to discover and purchase books online.
    </p>

    <p>
        © 2026 Online Book Store
    </p>

</footer>


<script>

// Clear both possible cart names

localStorage.removeItem("cart");

localStorage.removeItem("cartBook");

</script>


</body>

</html>