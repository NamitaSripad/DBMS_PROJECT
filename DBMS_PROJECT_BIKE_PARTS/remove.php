<?php
// Database connection
$con = new mysqli("localhost", "root", "", "garage_management");

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Assuming you have a form or some way of identifying which entry to delete,
// let's say you have a form where you pass the entry ID through POST
if(isset($_POST['email'])) {
    $entry_id = $_POST['email'];

    // SQL to delete entry
    $sql = "DELETE FROM user WHERE email = ?";

    // Prepare and bind parameters
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $entry_id);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Entry deleted successfully.";
    } else {
        echo "Error deleting entry: " . $con->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$con->close();
?>
