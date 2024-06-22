<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Database connection here
    $con = new mysqli("localhost", "root", "", "garage_management");
    if ($con->connect_error) {
        die("Failed to connect : " . $con->connect_error);
    } else {
        $stmt = $con->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        if ($stmt_result->num_rows > 0) {
            $data = $stmt_result->fetch_assoc();
            if ($data['password'] == $password) {
                echo "<h2>Login Successful</h2>";
                header("refresh:3; url=home.html");
            } else {
                echo "<h2>Invalid Email or password</h2>";
            }
        } else {
            echo "<h2>Invalid email or password</h2>";
        }
    }
} else {
    echo "<h2>Invalid request</h2>";
}
?>




