let offset = 0;
let loading = false;        // Prevent duplicate AJAX calls
let sort = 'default';
let allLoaded = false;
let curSearch = "";

const productContainer = document.getElementById('product-container');
const loader = document.getElementById('loader');

// MAIN INITIAL START
document.addEventListener("DOMContentLoaded", () => {
    attachAddToCartEvents();
    setUpSearch();

    // Load product list only once
    const hadSearch = handleSearchParam();
    if (!hadSearch) {
        loadProducts(); // Only load default list if URL has no ?search=
    }
});

// --- SORT FEATURE ---
const sortButtons = document.querySelectorAll(".sort-btn");
sortButtons.forEach(btn => {
    btn.addEventListener("click", () => {

        // Highlight active button
        sortButtons.forEach(b => b.classList.remove("active"));
        btn.classList.add("active");

        // Update sorting option
        sort = btn.dataset.sort;

        // Reset state
        offset = 0;
        allLoaded = false;
        productContainer.innerHTML = "";

        // Load with current search + sort
        loadProducts(curSearch);
    });
});

// --- INFINITE SCROLL ---
function handleScroll() {
    if (
        !loading &&
        !allLoaded &&
        window.innerHeight + window.scrollY >=
        document.documentElement.scrollHeight - 200
    ) {
        loadProducts(curSearch);
    }
}
window.addEventListener('scroll', handleScroll);

// --- LOAD PRODUCTS ---
function loadProducts(search = curSearch) {
    if (loading) return; // Prevent double load

    curSearch = search;
    loading = true;
    loader.style.display = 'block';

    const params = new URLSearchParams({
        offset,
        sort,
        search: curSearch
    });

    fetch("product/get-product.php?" + params.toString())
        .then(res => res.text())
        .then(data => {
            const cleanData = data.trim();

            if (cleanData !== "") {

                if (offset === 0) {
                    productContainer.innerHTML = ""; // fresh filter
                }

                productContainer.insertAdjacentHTML("beforeend", cleanData);
                offset += 6;
                attachAddToCartEvents();
            } else {
                allLoaded = true; // No more products
            }
        })
        .catch(err => console.error("Error loading products:", err))
        .finally(() => {
            loader.style.display = "none";
            loading = false;
        });
}

// --- ADD TO CART ---
function attachAddToCartEvents() {
    const buttons = document.querySelectorAll(".add-to-cart:not([data-bound])");

    buttons.forEach(button => {
        button.dataset.bound = "true";
        button.addEventListener("click", function () {
            const productId = this.getAttribute("product-id");

            fetch("cart/add-to-cart.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "id=" + encodeURIComponent(productId)
            })
                .then(res => res.text())
                .then(alert)
                .catch(err => console.error("Add to cart error:", err));
        });
    });
}

// --- SEARCH ---
function setUpSearch() {
    const form = document.querySelector(".search-box");
    const input = form.querySelector("input[type='text']");

    form.addEventListener("submit", (e) => {
        e.preventDefault();
        const query = input.value.trim();

        offset = 0;
        allLoaded = false;
        curSearch = query;
        productContainer.innerHTML = "";

        loadProducts(query);
    });
}

// --- HANDLE ?search= FROM URL ---
function handleSearchParam() {
    const urlParams = new URLSearchParams(window.location.search);
    const search = urlParams.get("search");
    const input = document.querySelector(".search-box input[type='text']");

    if (search && input) {
        input.value = search;
        curSearch = search;

        offset = 0;
        allLoaded = false;
        productContainer.innerHTML = "";

        loadProducts(search);
        return true;
    }
    return false;
}
