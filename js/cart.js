function loadCart() {

    let data = localStorage.getItem("cartBook");

    if (data == null) {
        return;
    }

    let book = JSON.parse(data);

    document.getElementById("cart-book-name").innerText = book.name;
    document.getElementById("cart-book-author").innerText = book.author;
    document.getElementById("cart-book-price").innerText = "₹" + book.price;
    document.getElementById("cart-book-image").innerText = book.image;

    document.getElementById("quantity").value = book.quantity;

    updateTotal();
}


function updateTotal() {

    let data = localStorage.getItem("cartBook");

    if (data == null) {
        return;
    }

    let book = JSON.parse(data);

    let quantity = Number(document.getElementById("quantity").value);

    if (quantity < 1) {
        quantity = 1;
        document.getElementById("quantity").value = 1;
    }

    let total = Number(book.price) * quantity;

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


window.onload = function() {

    if (document.getElementById("quantity")) {
        loadCart();
    }

};