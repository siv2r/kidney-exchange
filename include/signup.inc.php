<?php

if (isset($_POST['uname'])) {

  // get variable information from the signup form
  $uname = $_POST['uname'];
  $email = $_POST['email'];
  $hosp_id = $_POST['hosp_id'];
  $pswd = $_POST['pswd'];
  $re_pswd = $_POST['re_pswd'];

  require_once "../db-connect.php";
  require_once "functions.inc.php";

  if (emptyInputSignup($uname, $email, $hosp_id, $pswd, $re_pswd) !== false) {
    header("location: ../pages/signup.php?error=emptyInputSignup");
    exit();
  }

  if (invalidUname($uname) !== false) {
    header("location: ../pages/signup.php?error=invalidUname");
    exit();
  }

  if (invalidHospId($hosp_id) !== false) {
    header("location: ../pages/signup.php?error=invalidHospId");
    exit();
  }

  if (invalidEmail($email) !== false) {
    header("location: ../pages/signup.php?error=invalidEmail");
    exit();
  }

  if (noPswdMatch($pswd, $re_pswd) !== false) {
    header("location: ../pages/signup.php?error=noPswdMatch");
    exit();
  }

  if (UnameExists($conn, $uname, $email) !== false) {
    header("location: ../pages/signup.php?error=unameExists");
    exit();
  }

  if (getHospitalById($conn, $hosp_id) === false) {
    header("location: ../pages/signup.php?error=noHospIdExists");
    exit();
  }

  createUser($conn, $uname, $email, $hosp_id, $pswd);

} else {
  header("location: ../pages/signup.php");
}
