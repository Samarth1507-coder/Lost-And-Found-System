<?php
// Start the session
session_start();

// Database configuration
$servername = "localhost";
$dbUsername = "root";           // your MySQL username
$dbPassword = "";               // your MySQL password
$dbName = "lost_and_found";     // your database name

// Create database connection
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName, 3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get and sanitize form data
$fullname = trim($_POST['fullname']);
$email = trim($_POST['email']);
$username = trim($_POST['username']);
$password = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];

// Check if passwords match
if ($password !== $confirmPassword) {
    echo "<script>alert('Passwords do not match.'); window.location.href='register.html';</script>";
    exit();
}

// Check if username already exists
$checkQuery = "SELECT id FROM users WHERE username = ?";
$stmt = $conn->prepare($checkQuery);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "<script>alert('Username already taken. Try a different one.'); window.location.href='register.html';</script>";
    $stmt->close();
    $conn->close();
    exit();
}
$stmt->close();

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert user into the database
$insertQuery = "INSERT INTO users (fullname, email, username, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($insertQuery);
$stmt->bind_param("ssss", $fullname, $email, $username, $hashedPassword);

if ($stmt->execute()) {
    echo "<script>alert('Registration successful! You can now log in.'); window.location.href='userlogin.html';</script>";
} else {
    echo "<script>alert('Error occurred. Please try again.'); window.location.href='register.html';</script>";
}

$stmt->close();
$conn->close();
?>
