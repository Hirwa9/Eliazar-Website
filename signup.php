<?php
// Your database connection code here

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'connect.php'; // Connect
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user into the database
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashedPassword);

    if ($stmt->execute()) {
        // User registered successfully
        // Redirect or show a success message
    } else {
        // Error occurred
        // Handle the error
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
}
?>
