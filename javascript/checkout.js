document.getElementById("payBtn").addEventListener("click", function () {

    // Show success popup
    document.getElementById("successPopup").style.display = "flex";

    // Redirect to real checkout processor
    setTimeout(function () {
        window.location.href = "checkout/process_checkout.php";
    }, 2000); // 2 sec delay
});