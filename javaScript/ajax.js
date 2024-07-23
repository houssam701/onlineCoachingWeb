function saveData(personId) {
    // Send AJAX request
    $.ajax({
        type: "POST",
        url: "request.php", // URL of the PHP page to save data
        data: { id: personId }, // Data to send
        success: function(response) {
            openPopup(response);
        }
    });
}