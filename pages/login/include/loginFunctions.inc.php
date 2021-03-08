<?php 

function emptyInputLogin($uid, $pswd) {
  if (empty($uid) || empty($pswd)) {
    return true;
  }
  else {
    return false;
  }
}

function loginUser($conn, $uid, $pswd) {
  // the row from the database is assigned to $userExists as an associative array
  $userExists = UnameExists($conn, $uid, $uid);

  if(!$userExists) {
    header("location: ../login.php?error=invalidUsername");
    exit();
  }

  $pswdHashed = $userExists['password'];
  $checkPswd = password_verify($pswd, $pswdHashed);

  if($checkPswd === false) {
    header("location: ../login.php?error=invalidPassword");
    exit();
  }

  else if ($checkPswd === true) {
    session_start();

    $_SESSION['userId'] = $userExists['username'];
    $_SESSION['userType'] = $userExists['type'];
    $_SESSION['hospId'] = $userExists['hosp_id'];
    $_SESSION['userEmail'] = $userExists['email'];

    if($userExists['hosp_id'] !== 0) { // get the hospital data if the user is not an Admin
      
      //this contains hospital data as an associative array
      $_SESSION['userHospital'] = getHospitalById($conn, $userExists['hosp_id']);
    }

    //redirect to index page
    header("location: ../../../index.php");
    exit();
  }

}