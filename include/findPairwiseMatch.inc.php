<?php
session_start();

if (isset($_POST['id'])) {
  //connection to database and custom functions
  require_once "../db-connect.php";
  require_once "../include/functions.inc.php";
  require_once "../include/matchFunctions.inc.php";
  require_once "../functions/scoring.func.php";

  $pair_id = $_POST['id'];

  // check if pair id is valid or not
  if (isValidPairId($pair_id) == false) {
    header("location: ../pages/pairwiseMatch.php?error=invalidPairId");
    exit();
  }

  // check if pair id is present in database
  if (getPairById($conn, $pair_id) == false) {
    header("location: ../pages/pairwiseMatch.php?error=noPairIdExists");
    exit();
  }

  //check if the transplant coordinator is searching in the same hospital
  $checkHospid = explode('-', $pair_id);
  if ($_SESSION['userType'] === "Transplant coordinator" && $_SESSION['hospId'] != $checkHospid[0]) {
    header("location: ../pages/pairwiseMatch.php?error=notSameHosp");
    exit();
  }

  $givenPairData = getPairDataById($conn, $pair_id);
  $matchResults = getMatches($conn, $pair_id);
} else {
  header("location: ../pages/pairwiseMatch.php");
}
