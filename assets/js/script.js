// script.js

document.addEventListener('DOMContentLoaded', function () {
    // Get the table and input elements
    var table = document.getElementById('customerTable');
    var input = document.getElementById('searchInput');

    // Add an input event listener to filter rows on user input
    input.addEventListener('input', function () {
        var filter = input.value.toUpperCase();
        var rows = table.getElementsByTagName('tr');

        // Loop through all rows and hide those that don't match the search query
        for (var i = 0; i < rows.length; i++) {
            var td = rows[i].getElementsByTagName('td')[0]; // Assuming the first column is the one to search
            if (td) {
                var txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        }
    });
});
