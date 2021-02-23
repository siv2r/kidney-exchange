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

  //write to a file inside global_match folder
  //TODO: try to supply json data to pipeline.py without creating a file
  $fptr = fopen('graph.json', 'w') or die('unable to create graph.json file :(');
  fwrite($fptr, $graph);
  fclose($fptr);

  //now generate graph usning pipline.py
  $command = escapeshellcmd('python3 pipeline.py -f ./cmpGraph.json');
  $output = shell_exec($command);
  echo $output;

  // redirect to the page where the results are displayed

} else {
  header("location: ../pages/globalMatch.php");
}
