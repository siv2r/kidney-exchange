<?php

if (isset($_POST["submit"])) {
  $uid = $_POST["uid"];
  $pswd = $_POST["pswd"];

  require_once "../db-connect.php";
  require_once "functions.inc.php";

  if (emptyInputLogin($uid, $pswd) !== false) {
    header("Location: ../pages/login.php?error=emptyInputLogin");
    exit();
  }

  loginUser($conn, $uid, $pswd);

} else {
  header("Location: ../pages/login.php");
}