<?php 
// dummy PR
$servername = "localhost";
$username = "siv2r";
$password = "sivaram535";
$dbname = "kidney_exchange";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>