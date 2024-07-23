<?php
require('db_connect.php');
$searchTerm = isset($_POST['searchTerm']) ? $_POST['searchTerm'] : '';

// Construct the SQL query
$sql = "SELECT c.userId as client_id, c.name as client_name, c.email as client_email, c.phone as client_phone, 
               ch.name as coach_name, r.date 
        FROM requests r 
        JOIN user c ON r.user_id = c.userId 
        JOIN user ch ON r.coach_id = ch.userId 
        WHERE r.status_id = 2 AND c.role_id = 3 AND ch.role_id = 2";

if (!empty($searchTerm)) {
    $searchTermEscaped = $conn->real_escape_string($searchTerm);
    $sql .= " AND (c.name LIKE '%$searchTermEscaped%' OR ch.name LIKE '%$searchTermEscaped%')";
}

// For debugging: print the SQL query
// echo $sql;

// Execute the query
$result = $conn->query($sql);

// Check for query execution errors
if ($conn->error) {
    echo "Error: " . $conn->error;
    $conn->close();
    exit();
}

$rows = array();
while($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

$conn->close();

// Return the results as JSON
echo json_encode($rows);
?>
