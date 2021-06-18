<?php
session_start();

$status = "";
$statusMsg = "";

if (isset($_POST['h_name'])) {

  //hospital info
  $h_name = addslashes($_POST['h_name']);
  $h_addr = "{$_POST['h_addr1']}, {$_POST['h_addr2']}, {$_POST['h_city']}, {$_POST['h_state']} {$_POST['h_pincode']}";
  $h_addr = addslashes($h_addr);
  $h_type = addslashes($_POST['h_type']);
  $h_license = addslashes($_POST['h_license']);

  //nephrologist info
  $nephro_name = "{$_POST['nephro_fname']} {$_POST['nephro_lname']}";
  $nephro_name = addslashes($nephro_name);
  $nephro_id = addslashes($_POST['nephro_id']);

  //surgeon info
  $surg_name = "{$_POST['surg_fname']} {$_POST['surg_lname']}";
  $surg_name = addslashes($surg_name);
  $surg_id = addslashes($_POST['surg_id']);

  //connecting to database
  include "../db-connect.php";

  $_SESSION['form'] = 'hospital-form';

  //check if this hospital record is present in the database
  $check_record = "SELECT * FROM hospitals WHERE license='$h_license' LIMIT 1";
  $record_result = mysqli_query($conn, $check_record);
  if (mysqli_num_rows($record_result) > 0) {
    $status = 0;
    $statusMsg = "This hospital is already registered with us";
    $row = mysqli_fetch_assoc($record_result);
    $id = $row['h_id'];

    //store data in session variable
    $_SESSION['status'] = $status;
    $_SESSION['msg'] = $statusMsg;
    $_SESSION['h_id'] = $id;

    //redirect to message page
    header("Location: ../pages/message.php ");
    exit();
  }

  $query = "INSERT INTO hospitals (`name`, `address`, `type`, license, nephro_name, nephro_id, surg_name, surg_id) VALUES ('$h_name', '$h_addr', '$h_type', '$h_license', '$nephro_name', '$nephro_id', '$surg_name', '$surg_id')";

  if (!mysqli_query($conn, $query)) {
    $status = 0;
    $statusMsg = "Insertion query error " . mysqli_error($conn);
  } else {
    $status = 1;
    $statusMsg = "Your registration is successful!!!";
    $last_id = mysqli_insert_id($conn);
  }

  //store data in session variable
  $_SESSION['status'] = $status;
  $_SESSION['msg'] = $statusMsg;
  $_SESSION['h_id'] = $last_id;

  //redirect to message page
  header("Location: ../pages/message.php ");
}
