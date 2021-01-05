<?php 

if (isset($_POST['uname'])) {

  // get variable information from the signup form
  $uname = $_POST['uname'];
  $email = $_POST['email'];
  $hosp_id = $_POST['hosp_id'];
  $pswd = $_POST['pswd'];
  $re_pswd = $_POST['re_pswd'];

  require_once("../../../include/dbConnect.inc.php");
  require_once("../../../include/functions.inc.php");

  if (emptyInputSignup($uname, $email, $hosp_id, $pswd, $re_pswd) !== false) {
    header("location: ../signup.php?error=emptyInputSignup");
    exit();
  }

  else if (invalidUname($uname) !== false) {
    header("location: ../signup.php?error=invalidUname");
    exit();
  }

  else if (invalidHospId($hosp_id) !== false) {
    header("location: ../signup.php?error=invalidHospId");
    exit();
  }

  else if (invalidEmail($email) !== false) {
    header("location: ../signup.php?error=invalidEmail");
    exit();
  }

  else if (noPswdMatch($pswd, $re_pswd) !== false) {
    header("location: ../signup.php?error=noPswdMatch");
    exit();
  }

  else if (UnameExists($conn, $uname, $email) !== false) {
    header("location: ../signup.php?error=unameExists");
    exit();
  }

  else if (getHospitalById($conn, $hosp_id) === false) {
    header("location: ../signup.php?error=noHospIdExists");
    exit();
  }

  createUser($conn, $uname, $email, $hosp_id, $pswd);

}

else {
  header("location: ../signup.php");
}

