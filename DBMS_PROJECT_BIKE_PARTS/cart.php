<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "garage_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['itemId'])) {
    $itemId = $_POST['itemId'];

    // Update selected_count to 0 in the database for the specified item
    $updateSql = "UPDATE bike_parts SET selected_count = 0 WHERE id = $itemId";
    if ($conn->query($updateSql) === TRUE) {
        echo 'Item removed successfully.';
    } else {
        echo 'Error updating item: ' . $conn->error;
    }
} else {
    // Fetch and display cart contents
    $sql = "SELECT id, part_name, part_type, selected_count FROM bike_parts #WHERE selected_count > 0";
    $result = $conn->query($sql);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="cart-item">';
            echo '<p>Part Name:  ' . $row["part_name"]  .' Selected Count: ' . $row["selected_count"] . '</p>';
            //echo '<p>ID: ' . $row["id"] . ' - Part Name: ' . $row["part_name"] . ' - Part Type: ' . $row["part_type"] . ' - Selected Count: ' . $row["selected_count"] . '</p>';
            echo '<button class="btn btn-danger" onclick="removeItem(' . $row["id"] . ')">Remove</button>&nbsp &nbsp';
            echo '</div>';
        }
        $result->free();
    } else {
        echo 'Error fetching cart contents: ' . $conn->error;
    }
}

$conn->close();
?>