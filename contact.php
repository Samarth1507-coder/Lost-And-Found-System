<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register - Online Lost and Found System</title>
  <style>
 * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f0f2f5;
      color: #333;
    }

    .navbar {
      background-color: #2c3e50;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 20px;
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .navbar .nav-left a {
      color: white;
      text-decoration: none;
      margin-right: 20px;
      font-weight: 500;
    }

    .navbar .nav-left a:hover {
      text-decoration: underline;
    }

    .navbar .nav-right .logout-btn {
      background-color: #e74c3c;
      color: white;
      padding: 10px 16px;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .navbar .nav-right .logout-btn:hover {
      background-color: #c0392b;
    }

    header{
      background-color: #2c3e50;
      color: white;
      text-align: center;
      padding: 15px 0;
    }
    </style>
</head>
<body>

  <header>
    <h1>Online Lost and Found System</h1>
  <div class="navbar">
      <nav class="nav-left">
        <a href="home.php">Home</a>
        <a href="found.html">Report Found</a>
        <a href="lost.html">Report Lost</a>
        <a href="all_items.html">All Items</a>
        <a href="contact.html">Contact</a>
      </nav>
      <div class="nav-right">
        <a href="logout.php" class="logout-btn">Logout</a>
      </div>
    </div>
  </header>
</body>
</html>

<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "lost_and_found";

// Create connection
$conn = new mysqli($servername, $username, $password, $database, 3307);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get and sanitize form data
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$subject = htmlspecialchars($_POST['subject']);
$message = htmlspecialchars($_POST['message']);

// Prepare and bind
$sql = "INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
  $stmt->bind_param("ssss", $name, $email, $subject, $message);

  if ($stmt->execute()) {
    echo "<h2>Thank you for your message! We will get back to you soon.</h2>";
  } else {
    echo "<h2>Error executing query: " . $stmt->error . "</h2>";
  }

  $stmt->close();
} else {
  echo "<h2>Error preparing statement: " . $conn->error . "</h2>";
}

$conn->close();
?>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<html>
    <head>
        <style>
            footer {
      background-color: #2c3e50;
      color: white;
      text-align: center;
      padding: 15px 0;
    }
        </style>
    </head>
    <body> 
<footer>
    <p>&copy; 2025 Online Lost and Found System</p>
  </footer>
    </body>
