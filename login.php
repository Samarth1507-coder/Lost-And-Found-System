<?php
// Start the session
session_start();
/*
// Database configuration
$servername = "localhost";
$username = "root";       // your MySQL username
$password = "";           // your MySQL password
$dbname = "lost_and_found";  // your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
*/
include 'db_connect.php';
// Get form values and sanitize
$user = trim($_POST['username']);
$pass = trim($_POST['password']);

// Prepare SQL statement to prevent SQL injection
$sql = "SELECT id, username, password FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();

    // Verify password
    if (password_verify($pass, $row['password'])) {
        // Login successful
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];

        // Redirect to dashboard or home page
        header("Location: home.php");
        exit();
    } else {
        // Invalid password
        echo "<script>alert('Invalid username or password.'); window.location.href='login.html';</script>";
    }
} else {
    // No user found
    echo "<script>alert('User not found. Please register first.'); window.location.href='login.html';</script>";
}

// Close connections
$stmt->close();
$conn->close();
?>
