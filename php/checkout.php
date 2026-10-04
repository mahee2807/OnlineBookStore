<?php include "db.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<header>
    <div class="logo">📚 Online Book Store</div>
    <nav>
        <a href="../index.html">Home</a>
        <a href="book.php">Books</a>
        <a href="../cart.html">Cart 🛒</a>
    </nav>
</header>

<section class="checkout-page">

    <h1>Checkout</h1>

    <form action="place-order.php" method="POST">

        <input type="hidden" name="cart" id="cart">

        <input type="text" name="name" placeholder="Full Name" required>

        <input type="email" name="email" placeholder="Email" required>

        <input type="text" name="phone" placeholder="Phone" required>

        <textarea name="address" placeholder="Address" required></textarea>

        <input type="text" name="city" placeholder="City" required>

        <input type="text" name="pincode" placeholder="Pincode" required>

        <div id="summary"></div>

        <button type="submit" class="small-btn">
            Place Order
        </button>

    </form>

</section>

<footer>
    <h3>📚 Online Book Store</h3>
    <p>Your place to discover and purchase books online.</p>
</footer>

<script>

let cart = JSON.parse(localStorage.getItem("cartBook")) || [];

document.getElementById("cart").value = JSON.stringify(cart);

let summary = document.getElementById("summary");

if (!cart.length) {

    summary.innerHTML = "<p>Your cart is empty.</p>";

} else {

    let book = cart[0];
    let qty = Number(book.quantity) || 1;
    let total = Number(book.price) * qty;

    summary.innerHTML = `
        <h2>Order Summary</h2>
        <p>Book: ${book.name || book.title}</p>
        <p>Author: ${book.author}</p>
        <p>Price: ₹${book.price}</p>
        <p>Quantity: ${qty}</p>
        <h3>Total: ₹${total}</h3>
    `;
}

</script>

</body>
</html>