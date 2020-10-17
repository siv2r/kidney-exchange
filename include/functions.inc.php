<?php

function emptyInputSignup($uname, $email, $hosp_id, $pswd, $re_pswd) {
  if (empty($uname) || empty($email) || empty($hosp_id) || empty($pswd) || empty($re_pswd)) {
    return true;
  }
  else {
    return false;
  }
}

function invalidUname($uname) {
  if (!preg_match("/^[a-zA-z0-9_]+$/", $uname)) {
    return true;
  }
  else {
    return false;
  }
}

function invalidHospId($hosp_id) {
  if (!filter_var($hosp_id, FILTER_VALIDATE_INT)) {
    return true;
  }
  else {
    return false;
  }
}

function invalidEmail($email) {
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return true;
  }
  else {
    return false;
  }
}

function noPswdMatch($pswd, $re_pswd) {
  if ($pswd !== $re_pswd) {
    return true;
  }
  else {
    return false;
  }
}

function UnameExists($conn, $uname, $email) {
  $query = "SELECT * FROM users WHERE username = ? OR email = ?;";

  // using prepared statements method to prevent sql injections by the user
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $query)) {
    header("location: ../pages/signup.php?error=userstmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $uname, $email);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($result)) {
    return $row;
  }
  else {
    return false;
  }
}

function noHospIdExists($conn, $hosp_id) {
  $query = "SELECT * FROM hospitals WHERE id = ?;";

  // using prepared statements method to prevent sql injections by the user
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $query)) {
    header("location: ../pages/signup.php?error=hospstmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "i", $hosp_id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if (mysqli_fetch_assoc($result)) {
    return false;
  }
  else {
    return true;
  }
}

function createUser($conn, $uname, $email, $hosp_id, $pswd) {
  $query = "INSERT INTO users (username, `password`, email, `type`, hosp_id) VALUES (?, ?, ?, ?, ?);";

  $type = "Transplant coordinator";
  $encryptedPswd = password_hash($pswd, PASSWORD_DEFAULT);

  // using prepared statements method to prevent sql injections by the user
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $query)) {
    header("location: ../pages/signup.php?error=hospstmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ssssi", $uname, $encryptedPswd, $email, $type, $hosp_id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  // redirect user on success
  header("location: ../pages/signup.php?error=none");
  exit();
}

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
    header("location: ../pages/login.php?error=invalidUsername");
    exit();
  }

  $pswdHashed = $userExists['password'];
  $checkPswd = password_verify($pswd, $pswdHashed);

  if($checkPswd === false) {
    header("location: ../pages/login.php?error=invalidPassword");
    exit();
  }

  else if ($checkPswd === true) {
    session_start();

    $_SESSION['userId'] = $userExists['username'];
    $_SESSION['userType'] = $userExists['type'];
    $_SESSION['hospId'] = $userExists['hosp_id'];
    $_SESSION['userEmail'] = $userExists['email'];

    //redirect to index page
    header("location: ../index.php");
    exit();
  }

}