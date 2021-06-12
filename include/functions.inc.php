<?php

function emptyInputSignup($uname, $email, $hosp_id, $pswd, $re_pswd) {
  if (empty($uname) || empty($email) || empty($hosp_id) || empty($pswd) || empty($re_pswd)) {
    return true;
  } else {
    return false;
  }
}

function invalidUname($uname) {
  if (!preg_match("/^[a-zA-z0-9_]+$/", $uname)) {
    return true;
  } else {
    return false;
  }
}

function invalidHospId($hosp_id) {
  if (!filter_var($hosp_id, FILTER_VALIDATE_INT)) {
    return true;
  } else {
    return false;
  }
}

function invalidEmail($email) {
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return true;
  } else {
    return false;
  }
}

function noPswdMatch($pswd, $re_pswd) {
  if ($pswd !== $re_pswd) {
    return true;
  } else {
    return false;
  }
}

function UnameExists($conn, $uname, $email) {
  $query = "SELECT * FROM users WHERE username = ? OR email = ?;";

  // using prepared statements method to prevent sql injections by the user
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    header("location: ../pages/signup.php?error=userstmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $uname, $email);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($result)) {
    return $row;
  } else {
    return false;
  }
}

function getHospitalById($conn, $hosp_id) {
  $query = "SELECT * FROM hospitals WHERE id = ?;";

  // using prepared statements method to prevent sql injections by the user
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    header("location: ../pages/signup.php?error=hospstmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "i", $hosp_id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($result)) {
    return $row;
  } else {
    return false;
  }
}

function createUser($conn, $uname, $email, $hosp_id, $pswd) {
  $query = "INSERT INTO users (username, `password`, email, `type`, hosp_id) VALUES (?, ?, ?, ?, ?);";

  $type = "Transplant coordinator";
  $encryptedPswd = password_hash($pswd, PASSWORD_DEFAULT);

  // using prepared statements method to prevent sql injections by the user
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    header("location: ../pages/signup.php?error=userstmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ssssi", $uname, $encryptedPswd, $email, $type, $hosp_id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  // redirect user on success
  header("location: ../pages/signup.php?error=none");
  exit();
}

function createAdmin($conn, $uname, $email, $hosp_id, $pswd) {
  $query = "INSERT INTO users (username, `password`, email, `type`, hosp_id) VALUES (?, ?, ?, ?, ?);";

  $type = "Admin";
  $encryptedPswd = password_hash($pswd, PASSWORD_DEFAULT);

  // using prepared statements method to prevent sql injections by the user
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    header("location: ../pages/signup.php?error=adminstmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ssssi", $uname, $encryptedPswd, $email, $type, $hosp_id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  exit();
}

function emptyInputLogin($uid, $pswd) {
  if (empty($uid) || empty($pswd)) {
    return true;
  } else {
    return false;
  }
}

function loginUser($conn, $uid, $pswd) {
  // the row from the database is assigned to $userExists as an associative array
  $userExists = UnameExists($conn, $uid, $uid);

  if (!$userExists) {
    header("location: ../pages/login.php?error=invalidUsername");
    exit();
  }

  $pswdHashed = $userExists['password'];
  $checkPswd = password_verify($pswd, $pswdHashed);

  if ($checkPswd === false) {
    header("location: ../pages/login.php?error=invalidPassword");
    exit();
  } else if ($checkPswd === true) {
    session_start();

    $_SESSION['userId'] = $userExists['username'];
    $_SESSION['userType'] = $userExists['type'];
    $_SESSION['hospId'] = $userExists['hosp_id'];
    $_SESSION['userEmail'] = $userExists['email'];

    if ($userExists['hosp_id'] !== 0) { // get the hospital data if the user is not an Admin

      //this contains hospital data as an associative array
      $_SESSION['userHospital'] = getHospitalById($conn, $userExists['hosp_id']);
    }

    //redirect to index page
    header("location: ../index.php");
    exit();
  }

}

function getHospitals($conn) { //returns all hospitals in database as associative array
  $query = "SELECT * FROM hospitals;";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $hosp_array = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $hosp_array;
  } else {
    return false;
  }
}

function deletePatientById($conn, $patient_id) {
  $query1 = "DELETE FROM patients WHERE id=$patient_id;";
  $query2 = "DELETE FROM patient_files WHERE id=$patient_id;";

  if (!mysqli_query($conn, $query1)) {
    echo 'patients delete query error' . mysqli_error($conn);
    return false;
  }

  if (!mysqli_query($conn, $query2)) {
    echo 'patient_files delete query error' . mysqli_error($conn);
    return false;
  }

  return true;
}

function deleteDonorById($conn, $donor_id) {
  $query1 = "DELETE FROM donors WHERE id=$donor_id;";
  $query2 = "DELETE FROM donor_files WHERE id=$donor_id;";

  if (!mysqli_query($conn, $query1)) {
    echo 'donors delete query error' . mysqli_error($conn);
    return false;
  }

  if (!mysqli_query($conn, $query2)) {
    echo 'donor_files delete query error' . mysqli_error($conn);
    return false;
  }

  return true;
}

function deletePairById($conn, $pair_id) {
  $query = "DELETE FROM pd_pairs WHERE pair_id=$pair_id;";

  if (!mysqli_query($conn, $query)) {
    echo 'pd_pairs delete query error' . mysqli_error($conn);
    return false;
  }

  return true;
}

function getPatientById($conn, $patient_id) {
  $query = "SELECT * FROM patients WHERE id = ?;";

  // using prepared statements method to prevent sql injections by the user
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    echo "getPatientById() stmt failed";
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $patient_id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($result)) {
    return $row;
  } else {
    return false;
  }
}

function getPatientFilesById($conn, $patient_id) {
  $query = "SELECT * FROM patient_files WHERE id = ?;";

  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    echo "getPatientFilesById() stmt failed";
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $patient_id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($result)) {
    return $row;
  } else {
    return false;
  }
}

function getDonorFilesById($conn, $donor_id) {
  $query = "SELECT * FROM donor_files WHERE id = ?;";

  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    echo "getDonorFilesById() stmt failed";
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $donor_id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($result)) {
    return $row;
  } else {
    return false;
  }
}

function getDonorById($conn, $donor_id) {
  $query = "SELECT * FROM donors WHERE id = ?;";

  // using prepared statements method to prevent sql injections by the user
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    echo "getDonorById() stmt failed";
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $donor_id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($result)) {
    return $row;
  } else {
    return false;
  }
}

function getPairById($conn, $pair_id) {
  $query = "SELECT * FROM pd_pairs WHERE pair_id = ?;";

  // using prepared statements method to prevent sql injections by the user
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    echo "getPairById() stmt failed";
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $pair_id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($result)) {
    return $row;
  } else {
    return false;
  }
}

function getPatients($conn) { //returns all patients in database as associative array
  $query = "SELECT * FROM patients ORDER BY id;";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $patients_array = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $patients_array;
  } else {
    return false;
  }
}

function getDonors($conn) { //returns all patients in database as associative array
  $query = "SELECT * FROM donors ORDER BY id;";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $donors_array = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $donors_array;
  } else {
    return false;
  }
}

function bmiVal($height, $weight) {
  $res = '';
  if (!empty($height) && !empty($weight)) {
    $res = number_format(($weight * 100 * 100) / ($height * $height), 2);
  }
  return $res;
}

function formatDate($timestamp) {
  $ts = strtotime($timestamp);
  return date("d-m-Y", $ts);
}

function toAge($dob) {
  return date_diff(date_create($dob), date_create('today'))->y;
}

function isValidPairId($pair_id) {
  $pair_id_array = explode('-', $pair_id);
  if (sizeof($pair_id_array) !== 2) {
    return false;
  }

  return true;
}
