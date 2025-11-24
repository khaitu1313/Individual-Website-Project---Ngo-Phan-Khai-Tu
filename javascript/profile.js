document.addEventListener("DOMContentLoaded", () => {
    fetch("../dashboard/get-profile.php")
        .then(res => res.json())
        .then(data => {
            document.getElementById("email").value = data.email;
            document.getElementById("phone").value = data.phone;
            document.getElementById("address").value = data.address;
        });
});

document.getElementById("profileForm").addEventListener("submit", function(e){
    e.preventDefault();

    let formData = new FormData(this);

    fetch("../dashboard/update-profile.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(data => {
        let msg = document.getElementById("message");
        if (data === "success") {
            msg.innerHTML = "Profile updated!";
            msg.style.color = "green";
        } else {
            msg.innerHTML = data;
            msg.style.color = "red";
        }
    });
});
