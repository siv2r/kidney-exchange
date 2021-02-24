<?php
require_once '../include/functions.inc.php';
require_once '../templates/db-connect.php';
require_once '../functions/json.func.php';
require_once "../include/matchFunctions.inc.php";
require_once "../functions/scoring.func.php";
require_once "../functions/cmdLine.func.php";

if (isset($_POST['submit'])) {
  $data = getAllPairData($conn);
  $jsonData = toJSON($data);
  $graph = createGraph($jsonData);

  //TODO: try to supply json data to pipeline.py without creating a file
  writeJSONfile($graph, 'graph.json');

  $global_match = findGlobalSoln();
  var_dump($global_match);

  // redirect to the page where the results are displayed
  // header("location: ../pages/displayGlobalMatch.php");

} else {
  header("location: ../pages/globalMatch.php");
}
