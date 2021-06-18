<?php

include_once "../db-connect.php";
include_once "../include/functions.inc.php";

if (isset($_GET['pair_id'])) {

  $pair_id = $_GET['pair_id'];
  $pairData = getPairById($conn, $pair_id);

  if ($pairData == false) {
    echo "Database fetch error" . "<br>";
    exit();
  }

  $toggleQuery = '';
  if ($pairData['status'] == 'Active') {
    $toggleQuery = "UPDATE pd_pairs SET `status`='Inactive' WHERE pair_id='$pair_id';";
  } else if ($pairData['status'] == 'Inactive') {
    $toggleQuery = "UPDATE pd_pairs SET `status`='Active' WHERE pair_id='$pair_id';";
  }

  echo $toggleQuery . '<br>';
  if (!mysqli_query($conn, $toggleQuery)) {
    echo "Database update error" . "<br>";
    exit();
  }

}

//redirect to the overview page after changing the status value
header("location: ../pages/dataOverview.php");
