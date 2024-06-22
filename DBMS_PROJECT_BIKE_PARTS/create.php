<?php


// initializing variables
$email = $_POST['email'];
$password = $_POST['password'];
$errors = array();

// connect to the database
$con = new mysqli("localhost", "root", "", "garage_management");
if ($con->connect_error) {
    die("Failed to connect : " . $con->connect_error);
} else {
    // Prepare and execute the SQL query
    $stmt = $con->prepare("INSERT INTO user (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $password);
    if ($stmt->execute()) {
        echo "Registration successful Returning to home page in 3s...";
        // Close the statement and database connection
        $stmt->close();
        $con->close();
        // Redirect to login page after 3 seconds
        header("refresh:3; url=index_login.html");
        exit(); // Ensure no further output is sent
    } else {
        echo "Error: " . $stmt->error;
        // Close the statement and database connection
        $stmt->close();
        $con->close();
    }
}


?>