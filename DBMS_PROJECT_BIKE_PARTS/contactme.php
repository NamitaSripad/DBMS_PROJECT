<?php
// Include your database connection code here

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["contactName"];
    $email = $_POST["contactEmail"];
    $message = $_POST["contactMessage"];

    // Perform the database insertion (replace with your actual database code)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "garage_management";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Message sent successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    header("refresh:3; url=home.html");

    $conn->close();
}
?>
