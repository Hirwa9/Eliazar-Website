<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "eliazar";

try {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    error_log($e->getMessage()); // Log the error
    die("Database connection error. Please try again."); // User-friendly message
}
