<?php 
function toJSON($allPairData){
  //store final result
  $res = array();
  $res['data'] = array();

  foreach ($allPairData as $index => $pair) {
    array_push($res['data'], $pair);
  }

  $jsonVal = json_encode($res, JSON_PRETTY_PRINT);
  
  //check if encode was success
  if ($jsonVal) {
    return $jsonVal;
  } else {
    echo 'Error in encoding JSON data : ' . json_last_error_msg();
    exit();
  }
  
}
