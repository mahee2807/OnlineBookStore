<?php

include "db.php";

$id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;

$sql = "SELECT * FROM books WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Book not found!");
}

$book = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>
        <?php echo $book["title"]; ?>
    </title>

    <link rel="stylesheet" href="../css/style.css">

</head>

<body>

<header>

    <div class="logo">
        📚 Online Book Store
    </div>

    <nav>
        <a href="../index.html">Home</a>
        <a href="book.php">Books</a>
        <a href="../cart.html">Cart 🛒</a>
    </nav>

</header>


<section class="details">

    <div class="details-image">
        📖
    </div>


    <div class="details-info">

        <h1>
            <?php echo $book["title"]; ?>
        </h1>

        <p>
            <strong>Author:</strong>
            <?php echo $book["author"]; ?>
        </p>

        <p class="details-price">
            ₹<?php echo $book["price"]; ?>
        </p>

        <p>
            <?php echo $book["description"]; ?>
        </p>

        <p>
            <strong>Category:</strong>
            <?php echo $book["category"]; ?>
        </p>

        <p>
            <strong>Stock:</strong>
            <?php echo $book["stock"]; ?>
        </p>

        <br>

        <a href="book.php" class="btn">
            Back to Books
        </a>

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

</body>

</html>