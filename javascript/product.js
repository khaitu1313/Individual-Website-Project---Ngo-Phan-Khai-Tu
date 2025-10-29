document.addEventListener("DOMContentLoaded", function() {
    const buttons = document.querySelector(".add-to-cart");

    buttons.forEach(buttons => {
        buttons.addEventListener("click", function() {
            productId = this.getAttribute("product-id");

            fetch("add-to-cart.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "id=" + encodeURIComponent(productId)
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
            })
            .catch(error => {
                console.error("Error adding to cart", error);
            })
        });
    });
});