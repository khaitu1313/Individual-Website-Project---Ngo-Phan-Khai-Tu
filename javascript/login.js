function showPopup(type, message) {
    const popup = document.getElementById("popup");
    const icon = document.getElementById("popup-icon");
    const msg = document.getElementById("popup-message");

    if(type === "success") {
        icon.innerHTML = "✔️";
        icon.style.color = "green";
    } else {
        icon.innerHTML = "❌";
        icon.style.color = "red";
    }

    msg.textContent = message;
    
    popup.classList.add("show");

    // auto-close
    setTimeout(() => {
        popup.classList.remove("show");
    }, 3000);
}

const urlParams = new URLSearchParams(window.location.search);

if (urlParams.get('error') === 'invalid_credentials') {
    showPopup("fail", "Invalid username or password!");
}

if (urlParams.get('error') === 'empty_fields') {
    showPopup("fail", "Please fill all fields!");
}