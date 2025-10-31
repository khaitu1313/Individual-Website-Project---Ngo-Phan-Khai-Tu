let offset = 0;
let loading = false;    // Flag used for preventing duplicate in AJAX requesting
let sort = 'default';
let allLoaded = false;

const productContainer = document.getElementById('product-container');
const loader = document.getElementById('loader');
const sortSelect = document.getElementById('sort');

// Initial load
loadProducts();

// Handle sorting
sortSelect.addEventListener('change', () => {
    sort = sortSelect.value;
    offset = 0;
    productContainer.innerHTML = '';
    loadProducts();
});

function handleScroll() {
    if (
        !loading &&
        !allLoaded &&
        window.innerHeight + window.scrollY >= document.body.offsetHeight - 200 // Detect scroll near the bottom to show more products
    ) {
        loadProducts();
    }
}

window.addEventListener('scroll', handleScroll);

function loadProducts() {
    loading = true;
    loader.style.display = 'block';

    const params = new URLSearchParams({ offset, sort });
    fetch('product/get-product.php?' + params.toString())
        .then(res => res.text())
        .then(data => {
            const cleanData = data.trim();
            if (cleanData !== '') {
                productContainer.insertAdjacentHTML('beforeend', cleanData);
                offset += 6; // same as PHP $limit
                attachAddToCartEvents(); // events for new products
            } else {
                // No more products — stop scroll loading
                allLoaded = true;
                window.removeEventListener('scroll', handleScroll);
                console.log('All products loaded.');
            }
        })
        .catch(err => console.error('Error loading products:', err))
        .finally(() => {
            loader.style.display = 'none';
            loading = false;
        });
}

// Handle Add-to-cart
function attachAddToCartEvents() {
    const buttons = document.querySelectorAll(".add-to-cart:not([data-bound])"); // [data-bound] preventing adding new eventlistener to the buttons that already had one

    buttons.forEach(button => {
        button.dataset.bound = "true"; // prevent double binding
        button.addEventListener("click", function() {
            const productId = this.getAttribute("product-id");

            fetch("cart/add-to-cart.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "id=" + encodeURIComponent(productId)
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
            })
            .catch(error => {
                console.error("Error adding to cart", error);
            });
        });
    });
}

// Run on initial load too
document.addEventListener("DOMContentLoaded", attachAddToCartEvents);