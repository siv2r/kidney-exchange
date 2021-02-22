<?php
require_once '../include/functions.inc.php';
require_once '../templates/db-connect.php';
require_once '../functions/json.func.php';
require_once "../include/matchFunctions.inc.php";
require_once "../functions/scoring.func.php";

if (isset($_POST['submit'])) {
  //get pd-pair data from database && convert to json
  $data = getAllPairData($conn);
  $jsonData = toJSON($data);
  //create the compatiblity graph (also json)
  $graph = createGraph($jsonData);

  //write to a file
  $fptr = fopen('graph.json', 'w');
  fwrite($fptr, $graph);
  fclose($fp);

} else {
  header("location: ../pages/globalMatch.php");
}
