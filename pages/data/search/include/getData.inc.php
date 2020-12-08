<?php 

session_start();

$status = '';
$statusMsg = '';

if(isset($_POST['submit'])) {

  //connection to database and custom functions
  include("../templates/db-connect.php");
  include("../include/functions.inc.php");

  $pair_id = $_POST['id'];

  // check if pair id is valid or not
  if (isValidPairId($pair_id) == false) {
    header("location: ../pages/dataSearch.php?error=invalidPairId");
    exit();
  }

  // check if pair id is present in database
  if (getPairById($conn, $pair_id) == false) {
    header("location: ../pages/dataSearch.php?error=noPairIdExists");
    exit();
  }

  //check if the transplant coordinator is searching in the same hospital
  $checkHospid = explode('-', $pair_id);
  if ($_SESSION['userType'] === "Transplant coordinator" && $_SESSION['hospId'] != $checkHospid[0]) {
    header("location: ../pages/dataSearch.php?error=notSameHosp");
    exit();
  } 
  
  $patient_id = $pair_id . '-p';
  $donor_id = $pair_id . '-d';

  //get data from the database
  $pData = getPatientById($conn, $patient_id);
  $pFiles = getPatientFilesById($conn, $patient_id);
  $dData = getDonorById($conn, $donor_id);
  $dFiles = getDonorFilesById($conn, $donor_id);

  if($pData == false || $dData == false || $pFiles == false || $dFiles == false) {
    echo "Database fetch error" . '<br>';
    exit();
  }

  //calculate BMI and Date
  $pBMI = bmiVal($pData['height'], $pData['weight']);
  $pCreated = formatDate($pData['created_at']);
  $pUpdated = formatDate($pData['updated_at']);

  $dBMI = bmiVal($dData['height'], $dData['weight']);
  $dCreated = formatDate($dData['created_at']);
  $dUpdated = formatDate($dData['updated_at']);
}

else {
  header("location: ../pages/dataSearch.php");
}
