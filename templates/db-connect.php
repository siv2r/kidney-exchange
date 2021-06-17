<?php 

$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "kidney_exchange";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>
