<?php
$servername="localhost";
$username="root";
$password="";
$database="lost_and_found";

$conn=mysqli_connect($servername,$username,$password,$database, 3307);

if(!$conn){
 die("connection failed");
}
else{
//echo "connected successfully";
}
?>