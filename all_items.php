<?php
include 'db_connect.php';

$typeFilter = $_GET['type'] ?? 'all';

// Build query based on filter
if ($typeFilter == 'lost') {
    $query = "SELECT itemname, location, description, ownername AS contactname, phonenumber, email, image_path, 'Lost' as itemtype FROM lostitems";
} elseif ($typeFilter == 'found') {
    $query = "SELECT itemname, location, description, usname AS contactname, phonenumber, email, image_path, 'Found' as itemtype FROM itemsfound";
} else {
    $query = "SELECT itemname, location, description, ownername AS contactname, phonenumber, email, image_path, 'Lost' as itemtype FROM lostitems
              UNION
              SELECT itemname, location, description, usname AS contactname, phonenumber, email, image_path, 'Found' as itemtype FROM itemsfound";
}


$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Items</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        header, footer {
      background-color: #2c3e50;
      color: white;
      padding: 15px;
      text-align: center;
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

        .filter-bar {
            text-align: center;
            margin-bottom: 30px;
        }
        .filter-bar select {
            padding: 10px;
            font-size: 16px;
        }
        .items-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        .item-card {
            background: white;
            width: 280px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .item-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
        }
        .item-card h3 {
            margin: 10px 0 5px;
            color: #3498db;
        }
        .item-card p {
            margin: 5px 0;
            font-size: 0.95em;
        }
        .itemtype {
            font-weight: bold;
            color: #e67e22;
        }
    </style>
</head>
<body>

<header>
 <h1>Online Lost And Found System</h1>
</header>

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
<center>
    <h1>All Reported Items</h1>
</center>
<div class="filter-bar">
    <form method="GET" action="all_items.php">
        <label for="type">Filter by type:</label>
        <select name="type" id="type" onchange="this.form.submit()">
            <option value="all" <?= $typeFilter === 'all' ? 'selected' : '' ?>>All</option>
            <option value="lost" <?= $typeFilter === 'lost' ? 'selected' : '' ?>>Lost Items</option>
            <option value="found" <?= $typeFilter === 'found' ? 'selected' : '' ?>>Found Items</option>
        </select>
    </form>
</div>

<div class="items-grid">
<?php while($row = mysqli_fetch_assoc($result)): ?>
    <div class="item-card">
        <img src="<?= htmlspecialchars($row['image_path']) ?>" alt="Item Image">
        <h3><?= htmlspecialchars($row['itemname']) ?></h3>
        <p><span class="itemtype"><?= htmlspecialchars($row['itemtype']) ?></span></p>
        <p><strong>Location:</strong> <?= htmlspecialchars($row['location']) ?></p>
        <p><strong>Description:</strong> <?= htmlspecialchars($row['description']) ?></p>
        <p><strong>Name:</strong> <?= htmlspecialchars($row['contactname']) ?></p>
        <p><strong>email:</strong> <?= htmlspecialchars($row['email']) ?></p>
        <p><strong>contact number:</strong> <?= htmlspecialchars($row['phonenumber']) ?></p>
    </div>
<?php endwhile; ?>
</div>

</body>
</html>
