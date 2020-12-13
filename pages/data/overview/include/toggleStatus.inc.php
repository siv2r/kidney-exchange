<?php 

require_once("../../../../include/dbConnect.inc.php");
require_once("../../../../include/functions.inc.php");

if (isset($_GET['pair_id'])) {

  $pair_id = $_GET['pair_id'];
  $pairData = getPairById($conn, $pair_id);

  if($pairData == false) {
    echo "Database fetch error" . "<br>";
    exit();
  }

  $toggleQuery = '';
  if ($pairData['status'] == 'Active') {
    $toggleQuery = "UPDATE pd_pairs SET `status`='Inactive' WHERE pair_id='$pair_id';";
  }
  else if ($pairData['status'] == 'Inactive') {
    $toggleQuery = "UPDATE pd_pairs SET `status`='Active' WHERE pair_id='$pair_id';";
  }
  
  echo $toggleQuery . '<br>';
  if (!mysqli_query($conn, $toggleQuery)) {
    echo "Database update error" . "<br>";
    exit();
  }
  
} 

//redirect to the overview page if
  //1. after toggling the status value
  //2. if the person entered through browser url
header("location: ../overview.php");
