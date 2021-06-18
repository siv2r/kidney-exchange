<?php
session_start();
require_once "../db-connect.php";
require_once "../include/functions.inc.php";

if (isset($_GET['pair_id']) && isset($_GET['hosp_id'])) {
  $pair_id = $_GET['pair_id'];
  $patient_id = $pair_id . '-p';
  $donor_id = $pair_id . '-d';

  $pair_id = "'$pair_id'";
  $patient_id = "'$patient_id'";
  $donor_id = "'$donor_id'";

  if (!deletePatientById($conn, $patient_id)) {
    // header("location: ../pages/message.php?error=deletePatient");
    exit();
  }

  if (!deleteDonorById($conn, $donor_id)) {
    // header("location: ../pages/message.php?error=deleteDonor");
    exit();
  }

  if (!deletePairById($conn, $pair_id)) {
    // header("location: ../pages/message.php?error=deleteDonor");
    exit();
  }

  $_SESSION['form'] = 'delete';
  $_SESSION['del_r_id'] = $patient_id;
  $_SESSION['del_d_id'] = $donor_id;
  $_SESSION['status'] = 1;
  $_SESSION['msg'] = "The following pair is successfully deleted!";

  header("location: ../pages/message.php");

}