document.addEventListener("DOMContentLoaded", function() {
    const quantityControls = document.querySelectorAll(".quantity-control");

    quantityControls.forEach(control => {
        const decreaseBtn = control.querySelector(".decrease");
        const increaseBtn = control.querySelector(".increase");
        const input = control.querySelector("input");
        const index = control.dataset.index;

        // Handle increase
        increaseBtn.addEventListener("click", () => {
            updateQuantity(index, "increase", input);
        });

        // Handle decrease
        decreaseBtn.addEventListener("click", () => {
            updateQuantity(index, "decrease", input);
        });
    });

    // Function to call PHP via AJAX
    function updateQuantity(index, action, inputField) {
        fetch("update-cart.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "index=" + encodeURIComponent(index) + "&action=" + encodeURIComponent(action)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                inputField.value = data.newQuantity;
                document.querySelector(".cart-summary h2").textContent = "Total: $" + data.newTotal.toFixed(2);
                if (data.removed) {
                    // Reload or remove item if quantity reached 0
                    location.reload();
                }
            } else {
                alert("Error updating cart!");
            }
        })
        .catch(error => console.error("Update failed:", error));
    }
});