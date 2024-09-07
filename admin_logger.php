<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'connect.php'; // Connect
    $email = $_POST['uname'];
    $password = $_POST['psw'];

    // Check SQL if the username exists
    $sql = "SELECT * FROM admin_users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Check if any rows are returned
    if ($user) {
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Login successful, redirect to admin dashboard
            session_start();
            $_SESSION["username"] = $email;
            header("Location: admin_cpanel.php");
            exit(); // Ensure no further code is executed after the redirect
        } else {
            // Password does not match
            header("Location: invalid_admin.html");
            exit(); // Ensure no further code is executed after the redirect
        }
    } else {
        // Username does not exist
        header("Location: invalid_admin.html");
        exit(); // Ensure no further code is executed after the redirect
    }

    $stmt->close();
}
// Close connection
$conn->close();
?>
