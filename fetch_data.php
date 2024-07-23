<?php
require('db_connect.php');

$search = isset($_POST['search']) ? $_POST['search'] : '';

if ($search) {
    $sql = "SELECT * FROM user WHERE name LIKE '%$search%' AND role_id=3";
} else {
    $sql = "SELECT * FROM user WHERE role_id=3";
}

$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();

echo json_encode($data);

?>