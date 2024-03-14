document.addEventListener('DOMContentLoaded', function () {
    var searchInput = document.getElementById('searchInput');

    searchInput.addEventListener('input', function () {
        var searchTerm = searchInput.value.toLowerCase();
        var allItems = document.querySelectorAll('.tr');
        var search_param_1, search_param_2, search_param_3, search_param_4;
        allItems.forEach(function (item) {
            if (item.querySelector('.search_param_1'))
                search_param_1 = item.querySelector('.search_param_1').textContent.toLowerCase();
            if (item.querySelector('.search_param_2'))
                search_param_2 = item.querySelector('.search_param_2').textContent.toLowerCase();
            if (item.querySelector('.search_param_3'))
                search_param_3 = item.querySelector('.search_param_3').textContent.toLowerCase();
            if (item.querySelector('.search_param_4'))
                search_param_4 = item.querySelector('.search_param_4').textContent.toLowerCase();
            
            // Add more selectors for other properties you want to search

            if (search_param_1 && search_param_1.includes(searchTerm) || search_param_2 && search_param_2.includes(searchTerm) || search_param_3 && search_param_3.includes(searchTerm) || search_param_4 && search_param_4.includes(searchTerm)) {
                item.style.display = ''; // Show matching items
            } else {
                item.style.display = 'none'; // Hide non-matching items
            }
        });
    });
});