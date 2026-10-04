<?php

include "db.php";

/* Check if book ID exists */
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    die("Invalid book ID.");
}

$book_id = (int) $_GET["id"];

/* Get book from database */
$sql = "SELECT * FROM books WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Database error: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "i", $book_id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    die("Book not found.");
}

$book = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        <?php echo htmlspecialchars($book["title"]); ?>
        - Online Book Store
    </title>

    <link rel="stylesheet" href="../css/style.css">

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


<section class="book-details-page">


    <div class="book-details">


        <div class="book-img">

            📖

        </div>


        <div class="book-info">


            <p class="small-title">
                BOOK DETAILS
            </p>


            <h1>
                <?php echo htmlspecialchars($book["title"]); ?>
            </h1>


            <h3>
                Author:
                <?php echo htmlspecialchars($book["author"]); ?>
            </h3>


            <h2>
                ₹<?php echo number_format((float)$book["price"], 2); ?>
            </h2>


            <?php if (isset($book["description"]) && $book["description"] != "") { ?>

                <p>
                    <?php echo htmlspecialchars($book["description"]); ?>
                </p>

            <?php } else { ?>

                <p>
                    Discover this book from our online collection.
                </p>

            <?php } ?>


            <button
                type="button"
                class="small-btn"
                onclick="addToCart()"
            >
                Add to Cart 🛒
            </button>


        </div>


    </div>


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

/*
 * Book information from PHP
 */

const book = {

    id: <?php echo (int)$book["id"]; ?>,

    title:
        <?php echo json_encode($book["title"]); ?>,

    author:
        <?php echo json_encode($book["author"]); ?>,

    price:
        <?php echo (float)$book["price"]; ?>,

    quantity: 1

};


/*
 * Add book to cart
 */

function addToCart() {

    let cart =
        JSON.parse(
            localStorage.getItem("cart")
        ) || [];


    /*
     * Check if this book is already
     * in the cart
     */

    const existingBook =
        cart.find(function(item) {

            return Number(item.id) === Number(book.id);

        });


    if (existingBook) {

        existingBook.quantity =
            Number(existingBook.quantity || 1) + 1;

    } else {

        cart.push({

            id: Number(book.id),

            title: book.title,

            author: book.author,

            price: Number(book.price),

            quantity: 1

        });

    }


    /*
     * Save cart
     */

    localStorage.setItem(
        "cart",
        JSON.stringify(cart)
    );


    alert("Book added to cart!");


    /*
     * Go to cart
     */

    window.location.href = "../cart.html";

}

</script>


</body>

</html>