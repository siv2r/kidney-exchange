<?php 

require('vendor/autoload.php');

use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');



$servername = "localhost";
$username =$_ENV["USERNAME"];
$password = $_ENV["PASSWORD"];
$dbname = "kidney_exchange";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>