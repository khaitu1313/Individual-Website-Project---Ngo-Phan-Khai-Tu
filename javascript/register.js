document.addEventListener("DOMContentLoaded", function() {
    const data = document.getElementById("register-data");
    if(!data) return;

    const message = data.dataset.message;
    const shouldRedirect = data.dataset.redirect === "true";

    if (message) {
        alert(message);
    }

    if (shouldRedirect) {
        window.location.href = "../login.php";
    }
});