function loadCart() {

    let data = localStorage.getItem("cartBook");

    if (!data) {
        return;
    }

    let book = JSON.parse(data);

    document.getElementById("cart-book-name").innerText = book.name;
    document.getElementById("cart-book-author").innerText = book.author;
    document.getElementById("cart-book-price").innerText = "₹" + book.price;

    document.getElementById("quantity").value = book.quantity;

    updateTotal();
}


function updateTotal() {

    let data = localStorage.getItem("cartBook");

    if (!data) {
        return;
    }

    let book = JSON.parse(data);

    let quantity = Number(document.getElementById("quantity").value);

    if (quantity < 1) {
        quantity = 1;
        document.getElementById("quantity").value = 1;
    }

    book.quantity = quantity;

    localStorage.setItem("cartBook", JSON.stringify(book));

    let total = Number(book.price) * quantity;

    document.getElementById("cart-total").innerText = "₹" + total;
    document.getElementById("final-total").innerText = "₹" + total;
}


function removeFromCart() {

    localStorage.removeItem("cartBook");

    window.location.href = "cart.html";
}


window.onload = loadCart;