<?php
require_once '../include/functions.inc.php';
require_once '../db-connect.php';
require_once '../functions/json.func.php';
require_once "../include/matchFunctions.inc.php";
require_once "../functions/scoring.func.php";

//get pd-pair data from database && convert to json
$data     = getAllPairData( $conn );
$jsonData = toJSON( $data );

//create the compatiblity graph (also json)
$graph = createGraph( $jsonData );

//make it downloadable on the website
header( 'Content-disposition: attachment; filename=cmpGraph.json' );
header( 'Content-type: application/json' );

echo ( $graph );
