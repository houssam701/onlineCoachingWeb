function fetchData(searchTerm = '') {
    $.ajax({
        url: 'fetch_client.php',
        type: 'POST',
        data: { searchTerm: searchTerm },
        success: function(response) {
            const data = JSON.parse(response);
            let tableContent = '';
            data.forEach(row => {
                tableContent += `<tr>
                    <td>${row.client_id}</td>
                    <td>${row.client_name}</td>
                    <td>${row.client_email}</td>
                    <td>${row.client_phone}</td>
                    <td>${row.coach_name}</td>
                    <td>${row.date}</td>
                </tr>`;
            });
            $('#resultsTable').html(tableContent);
        }
    });
}

$('#searchButton2').on('click', function() {
    const searchTerm = $('#searchTerm').val();
    fetchData(searchTerm);
});

$('#displayAllButton2').on('click', function() {
    $('#searchTerm').val('');
    fetchData();
});

// Fetch all data initially
fetchData();