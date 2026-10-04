<?php

include "db.php";

$sql = "SELECT * FROM books";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Books - Online Book Store</title>

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


<section class="books-page">

    <p class="small-title">
        OUR COLLECTION
    </p>

    <h1>
        All Books
    </h1>


    <div class="all-books">

        <?php while ($book = mysqli_fetch_assoc($result)) { ?>

            <div class="card">

                <div class="book-img">
                    📖
                </div>

                <h3>
                    <?php echo $book["title"]; ?>
                </h3>

                <p>
                    <?php echo $book["author"]; ?>
                </p>

                <b>
                    ₹<?php echo $book["price"]; ?>
                </b>

                <br><br>

                <a
                    href="book-details.php?id=<?php echo $book['id']; ?>"
                    class="small-btn">
                    View
                </a>

            </div>

        <?php } ?>

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