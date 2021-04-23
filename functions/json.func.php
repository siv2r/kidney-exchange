<?php

/**
 * Convertes data from the database to a certain JSON format
 *
 * @param  array  $allPairData
 * @return void
 */
function toJSON( $allPairData ) {
  //store final result
  $res         = [];
  $res['data'] = [];

  foreach ( $allPairData as $index => $pair ) {
    $pairId = $pair['pairId'];
    unset( $pair['pairId'] );
    $res['data'][$pairId] = $pair;
  }

  $jsonVal = json_encode( $res, JSON_PRETTY_PRINT );

//check if encode was success
  if ( $jsonVal ) {
    return $jsonVal;
  } else {
    echo 'Error in encoding JSON data : ' . json_last_error_msg();
    exit();
  }
}

/**
 * Creates the compatibility graph for all the data in database
 *
 * @param  json $jsonData     contains all the data from database in json format
 * @return json compatibility graph
 */
function createGraph( $jsonData ) {
  // convert the json to php array
  $dataArray = json_decode( $jsonData, true );
  $pairData  = $dataArray['data'];
  $dataLen   = sizeof( $pairData );

  // cmp graph array
  $cmpGraph         = [];
  $cmpGraph['data'] = [];

// for ($i = 0; $i < $dataLen; $i++) {

//   $pairId = $pairData[$i]['pairId'];

//   $pairIdContents = array();

//   //add pairId's data required for matching

//   $pairIdContents['sources'] = array($pairData[$i]['pairId']);

//   $pairIdContents['dAge'] = toAge($pairData[$i]['dDob']);

//   //find the matches

//   $pairIdContents['matches'] = array();

//   for ($j = 0; $j < $dataLen; $j++) {

//     if ($j === $i) {

//       continue;

//     }

//     if (isMatch($pairData[$i], $pairData[$j])) {

//       $matchContents = array();

//       $matchContents['recipient'] = $pairData[$j]['pairId'];

//       $matchContents['score'] = calcScore($pairData[$i], $pairData[$j]);

//       //push the match contents

//       array_push($pairIdContents['matches'], $matchContents);

//     }

//   }

//   //add current pair result to the final output

//   $cmpGraph['data'][$pairId] = $pairIdContents;

// }
  foreach ( $pairData as $donatePairId => $donatePairValue ) {
    $donatePairCmpGrphValue = [];

    //add pairId's data required for matching
    $donatePairCmpGrphValue['sources'] = [$donatePairId];
    $donatePairCmpGrphValue['dAge']    = toAge( $donatePairValue['dDob'] );

    //find the matches
    $donatePairCmpGrphValue['matches'] = [];

    foreach ( $pairData as $acceptPairId => $acceptPairValue ) {
      if ( $acceptPairId === $donatePairId ) {
        continue;
      }

      if ( isMatch( $donatePairValue, $acceptPairValue ) ) {
        $matchContents              = [];
        $matchContents['recipient'] = $acceptPairId;
        $matchContents['score']     = calcScore( $donatePairValue,
          $acceptPairValue );

        //push the match contents
        array_push( $donatePairCmpGrphValue['matches'], $matchContents );
      }
    }

    //add current pair result to the final output
    $cmpGraph['data'][$donatePairId] = $donatePairCmpGrphValue;
  }

  //convert the result to json
  $jsonCmpGraph = json_encode( $cmpGraph, JSON_PRETTY_PRINT );

  return $jsonCmpGraph;
}

/**
 * Creates a .json file in the server
 *
 * @param  json   $data - the json data which must to stored in the file
 * @param  string $name - name of the required file
 * @return void
 */
function writeJSONfile( $data, $name ) {
  $fptr = fopen( "$name", "w" ) or die( "unable to create graph.json file :("
  );
  $check = fwrite( $fptr, $data );

  if ( $check === false ) {
    echo "Unable to write json file";
    exit();
  }

  fclose( $fptr );
  chmod( $name, 0755 );
}
