<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "garage_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['partName'])) {
    $partName = $_GET['partName'];

    // Your SQL query to fetch part names from the database
    $sql_fetch = "SELECT part_name FROM bike_parts WHERE part_name = '$partName'";

    // Execute the query
    $result = $conn->query($sql_fetch);

    // Check if the part name exists in the database
    if ($result && $result->num_rows > 0) {
        // Your SQL query to update selected_count
        $sql_update = "UPDATE bike_parts SET selected_count = selected_count + 1 WHERE part_name = '$partName'";
        

        // Execute the query
        if ($conn->query($sql_update) === TRUE) {
            echo "Selected count updated successfully for part: $partName";
        } else {
            echo "Error updating selected count: " . $conn->error;
        }
    } else {
        echo "Error: Part name does not exist in the database.";
    }
    

    // Free the result set
    $result->free();
} else {
    echo "Error: No part name provided.";
}

// Close the database connection
$conn->close();
?>
