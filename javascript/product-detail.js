document.getElementById("add-cart").addEventListener("click", () => {
    const id = document.getElementById("add-cart").dataset.id;
    const qty = document.getElementById("quantity").value;

    fetch("cart/add-to-cart.php", {
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: `id=${id}&quantity=${qty}`
    })
    .then(res => res.text())
    .then(data => alert(data));
});
