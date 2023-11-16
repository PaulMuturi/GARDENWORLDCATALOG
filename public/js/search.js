document.addEventListener('DOMContentLoaded', function () {
    var searchInput = document.getElementById('searchInput');

    searchInput.addEventListener('input', function () {
        var searchTerm = searchInput.value.toLowerCase();
        var allProducts = document.querySelectorAll('.tr');

        allProducts.forEach(function (product) {
            var search_param_1 = product.querySelector('.search_param_1').textContent.toLowerCase();
            var search_param_2 = product.querySelector('.search_param_2').textContent.toLowerCase();
            var search_param_3 = product.querySelector('.search_param_3').textContent.toLowerCase();
            var search_param_4 = product.querySelector('.search_param_4').textContent.toLowerCase();
            // Add more selectors for other properties you want to search

            if (search_param_1 && search_param_1.includes(searchTerm) || search_param_2 && search_param_2.includes(searchTerm) || search_param_3 && search_param_3.includes(searchTerm) || search_param_4 && search_param_4.includes(searchTerm)) {
                product.style.display = ''; // Show matching products
            } else {
                product.style.display = 'none'; // Hide non-matching products
            }
        });
    });
});