<?php
session_start();

// Redirect to login if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: userlogin.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard - Online Lost and Found</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    header, footer {
      background-color: #2c3e50;
      color: white;
      padding: 15px;
      text-align: center;
    }

    .container {
      max-width: 800px;
      margin: 40px auto;
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      color: #3498db;
      margin-bottom: 20px;
    }

    p {
      font-size: 1.1em;
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

.nav-left a {
  color: white;
  text-decoration: none;
  margin-right: 20px;
  font-weight: 500;
}

.nav-left a:hover {
  text-decoration: underline;
}

.nav-right .logout-btn {
  background-color: #e74c3c;
  color: white;
  padding: 10px 16px;
  text-decoration: none;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

.nav-right .logout-btn:hover {
  background-color: #c0392b;
}

  </style>
</head>
<body>

  <header>
    <h1>Welcome to the Online Lost and Found System</h1>
    </header>
    <header>
  <div class="navbar">
    <nav class="nav-left">
      <a href="home.php">Home</a>
      <a href="found.html">Report Found</a>
      <a href="lost.html">Report Lost</a>
      <a href="all_items.php">All Items</a>
      <a href="contact.html">Contact</a>
    </nav>
    <div class="nav-right">
      <a href="logout.php" class="logout-btn">Logout</a>
    </div>
  </div>
</header>


  <div class="container">
    <h2>Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <p class="description">
      The Online Lost and Found System is a web-based platform that helps users report and track lost and found items.
      It enables students and staff in a college or university to log missing or discovered items and facilitates the return process.
      You are now logged in. From here, you can report lost or found items, view all items, or manage your account.</p>

  </div><br><br><br><br>

  <footer>
    <p>
      &copy; 2025 Online Lost and Found System<br>
      Contact us-<br>
      Samarth More<br> 
      moresamarth504@gmail.com<br>
      7038424658<br></p>
  </footer>

</body>
</html>
