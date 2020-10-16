<?php 

if (isset($_POST['uname'])) {

  // get variable information from the signup form
  $uname = $_POST['uname'];
  $email = $_POST['email'];
  $hosp_id = $_POST['hosp_id'];
  $pswd = $_POST['pswd'];
  $re_pswd = $_POST['re_pswd'];

  require_once("../templates/db-connect.php");
  require_once("functions.inc.php");

  if (emptyInputs($uname, $email, $hosp_id, $pswd, $re_pswd) !== false) {
    header("location: ../pages/signup.php?error=emptyInputs");
    exit();
  }

  if (invalidUname($uname, $email, $hosp_id, $pswd, $re_pswd) !== false) {
    header("location: ../pages/signup.php?error=invalidUname");
    exit();
  }

  if (invalidHospId($uname, $email, $hosp_id, $pswd, $re_pswd) !== false) {
    header("location: ../pages/signup.php?error=invalidHospId");
    exit();
  }

  if (invalidEmail($uname, $email, $hosp_id, $pswd, $re_pswd) !== false) {
    header("location: ../pages/signup.php?error=invalidEmail");
    exit();
  }

  if (noPswdMatch($uname, $email, $hosp_id, $pswd, $re_pswd) !== false) {
    header("location: ../pages/signup.php?error=noPswdMatch");
    exit();
  }

  if (UnameExists($uname, $email, $hosp_id, $pswd, $re_pswd) !== false) {
    header("location: ../pages/signup.php?error=unameExists");
    exit();
  }

  if (noHospIdExists($uname, $email, $hosp_id, $pswd, $re_pswd) !== false) {
    header("location: ../pages/signup.php?error=noHospIdExists");
    exit();
  }

  createUser($conn, $uname, $email, $hosp_id, $pswd);

}

else {
  header("location: ../pages/signup.php");
}

