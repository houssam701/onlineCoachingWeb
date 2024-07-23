$(document).ready(function() {
    function loadData(search = '') {
        $.ajax({
            url: 'fetch_data.php',
            type: 'POST',
            data: { search: search },
            dataType: 'json',
            success: function(data) {
                console.log(data); // Debug: Check the JSON response

                var tableBody = $('#dataTable tbody');
                tableBody.empty(); // Clear previous data

                $.each(data, function(index, row) {
                    var tr = $('<tr/>');
                    tr.append($('<td/>').text(row.userId));
                    tr.append($('<td/>').text(row.name));
                    tr.append($('<td/>').text(row.email));
                    tr.append($('<td/>').text(row.phone));
                    
                    // Create the update button
                    var updateButton = $('<button/>').attr('id', 'update').css({
                        'color': 'white',
                        'text-decoration': 'none',
                        'font-size': 'large'
                    }).append(
                        $('<a/>').attr('href', 'update.php?updateid=' + row.userId).css({
                            'color': 'white',
                            'text-decoration': 'none'
                        }).text('Update')
                    );
                    var deleteButton = $('<button/>').attr('id', 'delete').css({
                        'color': 'white',
                        'text-decoration': 'none',
                        'font-size': 'large'
                    }).append(
                        $('<a/>').attr('href', 'delete-user.php?deleteid=' + row.userId).css({
                            'color': 'white',
                            'text-decoration': 'none'
                        }).text('Delete')
                    );
                    var actionsCell = $('<td/>');
                    actionsCell.append(updateButton);
                    actionsCell.append(deleteButton);

                    // Add the actions cell to the row
                    tr.append(actionsCell);

                    tableBody.append(tr);
                });
            }
        });
    }

    // Handle search button click
    $('#searchButton').click(function() {
        var searchInput = $('#searchInput').val();
        loadData(searchInput);
    });

    // Handle display all button click
    $('#displayAllButton').click(function() {
        loadData();
    });

    // Initially load all data
    loadData();
});