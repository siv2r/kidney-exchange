<?php 
require_once('../include/functions.inc.php');
require_once('./jsonFunctions.php');

function createGraph($jsonFileName){
    // get the json data ---> change this method according to neccessity
    $json = file_get_contents($jsonFileName);

    // convert the json to php array
    $dataArray = json_decode($json, true);
    $pairData = $dataArray['data'];
    $dataLen = sizeof($pairData);

    // cmp graph array
    $cmpGraph = array();
    $cmpGraph['data'] = array();

    for ($i=0; $i < $dataLen; $i++) { 
        $pairId = $pairData[$i]['pairId'];
        $pairIdContents = array();

        //add pairId's data required for matching
        $pairIdContents['sources'] = array($pairData[$i]['dId']);
        $pairIdContents['dAge'] = toAge($pairData[$i]['dDob']);

        //find the matches
        $pairIdContents['matches'] = array();
        for ($j=0; $j < $dataLen; $j++) { 
            if ($j === $i){
                continue;
            }

            if (isMatch($pairData[$i], $pairData[$j])) {
                $matchContents = array();
                $matchContents['recipient'] = $pairData[$j]['pId'];
                $matchContents['score'] = calcScore($pairData[$i], $pairData[$j]);

                //push the match contents
                array_push($pairIdContents['matches'], $matchContents);
            } 
        }

        //add current pair result to the final output
        $cmpGraph['data'][$pairId] = $pairIdContents;
    }

    //convert the result to json
    $jsonCmpGraph = json_encode($cmpGraph, JSON_PRETTY_PRINT);

    return $jsonCmpGraph;
}

//create the compatiblity graph
$fileName = 'jsonFile.json';
$graph = createGraph($fileName);

//make it downloadable on the website
header('Content-disposition: attachment; filename=cmpGraph.json');
header('Content-type: application/json');

echo($graph);
