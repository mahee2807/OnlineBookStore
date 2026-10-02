function addToCart() {

    let book = {
        name: "The Great Adventure",
        author: "John Smith",
        price: 399,
        image: "📖",
        quantity: 1
    };

    localStorage.setItem("cartBook", JSON.stringify(book));

    window.location.href = "cart.html";
}


function loadCart() {

    let storedBook = localStorage.getItem("cartBook");

    if (storedBook == null) {
        return;
    }

    let book = JSON.parse(storedBook);

    document.getElementById("cart-book-name").innerText = book.name;

    document.getElementById("cart-book-author").innerText = book.author;

    document.getElementById("cart-book-price").innerText =
        "₹" + book.price;

    document.getElementById("cart-book-image").innerText =
        book.image;

    document.getElementById("quantity").value =
        book.quantity || 1;

    updateTotal();
}


function updateTotal() {

    let storedBook = localStorage.getItem("cartBook");

    if (storedBook == null) {
        return;
    }

    let book = JSON.parse(storedBook);

    let quantity =
        parseInt(document.getElementById("quantity").value);

    if (isNaN(quantity) || quantity < 1) {

        quantity = 1;

        document.getElementById("quantity").value = 1;
    }

    let total = book.price * quantity;

    document.getElementById("cart-total").innerText =
        "₹" + total;

    document.getElementById("final-total").innerText =
        "₹" + total;

    book.quantity = quantity;

    localStorage.setItem(
        "cartBook",
        JSON.stringify(book)
    );
}


function removeFromCart() {

    localStorage.removeItem("cartBook");

    window.location.href = "cart.html";
}


document.addEventListener("DOMContentLoaded", function () {

    if (document.getElementById("quantity")) {
        loadCart();
    }

});