document.addEventListener("DOMContentLoaded", () => {
    fetch("order/get-order.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("orderBody").innerHTML = data;
        })
        .catch(err => {
            document.getElementById("orderBody").innerHTML =
                "<tr><td colspan='4' class='no-orders'>Error loading orders.</td></tr>";
        });
});
