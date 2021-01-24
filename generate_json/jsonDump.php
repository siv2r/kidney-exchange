<?php

require_once("../templates/db-connect.php");
require_once("./jsonFunctions.php");
require_once("../include/matchFunctions.inc.php");


//get pd-pair data from database
$data = getAllPairData($conn);
//conver to json
$jsonData = toJSON($data);

//make it downloadable on the website
header('Content-disposition: attachment; filename=jsonFile.json');
header('Content-type: application/json');

echo($jsonData);

