<?php
session_start();

if (isset($_POST['submit'])) {
  //Do we need database connection??

} else {
  header("location: ../pages/globalMatch.php");
}
