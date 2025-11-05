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

function loadProducts(search = "") {
    loading = true;
    loader.style.display = 'block';

    // Using AJAX for loading products
    const params = new URLSearchParams({ offset, sort, search });   // sent params to server
    fetch('product/get-product.php?' + params.toString())   // request using fetch()
        .then(res => res.text())                            // handle server response
        .then(data => {
            const cleanData = data.trim();
            if (cleanData !== '') {
                if (offset === 0) {
                    productContainer.innerHTML = ''; // offset === 0 means offset == 0 and type(offset) = type(0)
                }
                productContainer.insertAdjacentHTML('beforeend', cleanData); // update UI dynamically
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
    const buttons = document.querySelectorAll(".add-to-cart:not([data-bound])"); // [data-bound] preventing adding new eventlistener to the buttons that already had one while loading

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
document.addEventListener("DOMContentLoaded", () => {
    attachAddToCartEvents();
    setUpSearch();
    handleSearchParam();
});

function setUpSearch() {
    const searchForm = document.querySelector(".search-box");
    const searchInput = searchForm.querySelector("input[type='text']");

    searchForm.addEventListener("submit", function(e) {
        e.preventDefault();
        const query = searchInput.value.trim();  // remove spare spaces

        if (query) {
            // If user is NOT in product page, redirect to product page
            if (!(window.location.pathname.includes("product.php"))) {
                window.location.href = "product.php?search=" + encodeURIComponent(query);
            }
            // If already in product page, perform AJAX search
            else {
                offset = 0;
                allLoaded = false;
                productContainer.innerHTML = '';
                loadProducts(query);
            }
        }
    });
}

// Handle ?search= query from URL
function handleSearchParam() {
    const urlParams = new URLSearchParams(window.location.search);
    const search = urlParams.get("search");
    const searchInput = document.querySelector(".search-box input[type='text']");

    if (search && searchInput) {
        searchInput.value = search;
        loadProducts(search); // auto load filtered results
    }
}