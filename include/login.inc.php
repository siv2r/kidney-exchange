<?php 

if(isset($_POST["submit"])){
  $uid = $_POST["uid"];
  $pswd = $_POST["pswd"];

  require_once("../templates/db-connect.php");
  require_once("functions.inc.php");

  if(emptyInputLogin($uid, $pswd) !== false) {
    header("Location: ../pages/login.php?error=emptyInputLogin");
    exit();
  }

  echo "user is going to be logged in";
  loginUser($conn, $uid, $pswd);
  echo "user logged in";
}

else{
  header("Location: ../pages/login.php");
}