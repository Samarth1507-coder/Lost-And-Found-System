<?php
// Connect to MySQL
include 'db_connect.php'; // Make sure this file has $conn = mysqli_connect(...)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form inputs
    $itmname=$_POST['itemname'];
$location=$_POST['location'];
$description=$_POST['description'];

//founders details
$usname=$_POST['usname'];
$phonenumber=$_POST['phonenumber'];
$email=$_POST['email'];


    // Image Upload
    $image_path = NULL;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir); // create folder if it doesn't exist
        }

        $image_name = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . time() . "_" . $image_name;

        // Move uploaded file to target folder
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_path = $target_file;
        }
    }

    // Insert into database
    $stmt = mysqli_prepare($conn, "INSERT INTO itemsfound (itemname, location, description, usname, phonenumber, email, image_path) VALUES (?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssssss", $itmname, $location, $description, $usname, $phonenumber, $email, $image_path);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<h3>Item reported successfully!</h3>";
        echo "<a href='all_items.php'>See All Items</a>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
