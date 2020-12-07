<?php 

function getPairDataById ($conn, $pair_id) {

  $query = 
  "SELECT patients.blood_group AS patientBloodGroup, 
  donors.blood_group AS donorBloodGroup, 
  patients.name AS patientName, 
  donors.name AS donorName, 
  patients.dob AS patientDOB, 
  donors.dob AS donorDOB, 
  patients.sex AS patientSex, 
  donors.sex AS donorSex, 
  patients.ua_antigens AS patientUA, 
  patients.hla_antigens AS patientHLA, 
  donors.hla_antigens AS donorHLA, 
  pd_pairs.pair_id AS pairId
  FROM ((pd_pairs 
  INNER JOIN patients ON pd_pairs.patient_id = patients.id) 
  INNER JOIN donors ON pd_pairs.donor_id = donors.id)
  WHERE pd_pairs.pair_id = '$pair_id'
  LIMIT 1";

  $result = mysqli_query($conn, $query);
  if(!$result) {
    echo "givenPairId database query error" . mysqli_error($conn);
    exit();
  }

  $pairData = mysqli_fetch_assoc($result);

  return $pairData;

}

// return allowed blood group as array
function getAllowedPatientBgrp ($donorBgrp) {
  $allowedPatientBgrp = []; //result array

  //remove Rh factor i.e, A +ve -> A
  $donorBgrpNoRh = explode(' ', $donorBgrp)[0];

  //donor's own blood grp is allowed (both +ve and -ve)
  //don't forget sapce in ' +ve'
  array_push($allowedPatientBgrp, $donorBgrpNoRh . ' +ve'); 
  array_push($allowedPatientBgrp, $donorBgrpNoRh . ' -ve');

  // A or B can donate to AB
  if($donorBgrpNoRh == 'A' || $donorBgrpNoRh == 'B') {
    array_push($allowedPatientBgrp, 'AB +ve');
    array_push($allowedPatientBgrp, 'AB -ve');
  }

  // O can donate to A, B, AB
  else if($donorBgrpNoRh == 'O') {
    array_push($allowedPatientBgrp, 'AB +ve');
    array_push($allowedPatientBgrp, 'AB -ve');
    array_push($allowedPatientBgrp, 'A +ve');
    array_push($allowedPatientBgrp, 'A -ve');
    array_push($allowedPatientBgrp, 'B +ve');
    array_push($allowedPatientBgrp, 'B -ve');
  }

  return $allowedPatientBgrp;
}

// return allowed donor blood group as array
function getAllowedDonorBgrp ($patientBgrp) {
  $allowedDonorBgrp = []; //result array

  //remove Rh factor i.e, A +ve -> A
  $patientBgrpNoRh = explode(' ', $patientBgrp)[0];

  //patient's own blood grp is allowed (both +ve and -ve)
  //don't forget sapce in ' +ve'
  array_push($allowedDonorBgrp, $patientBgrpNoRh . ' +ve'); 
  array_push($allowedDonorBgrp, $patientBgrpNoRh . ' -ve');

  // A or B can recieve blood from O
  if($patientBgrpNoRh == 'A' || $patientBgrpNoRh == 'B') {
    array_push($allowedDonorBgrp, 'O +ve');
    array_push($allowedDonorBgrp, 'O -ve');
  }

  // AB can recieve blood from O, A, B
  else if($patientBgrpNoRh == 'AB') {
    array_push($allowedDonorBgrp, 'O +ve');
    array_push($allowedDonorBgrp, 'O -ve');
    array_push($allowedDonorBgrp, 'A +ve');
    array_push($allowedDonorBgrp, 'A -ve');
    array_push($allowedDonorBgrp, 'B +ve');
    array_push($allowedDonorBgrp, 'B -ve');
  }

  return $allowedDonorBgrp;
}

function filterHLA($givenHLA) {
  $pattern = "/(A|B|DR|Dw)/"; //allowed hla values
  $filteredHLA = array();

  foreach ($givenHLA as $key => $value) {
    if(preg_match($pattern, $value)) {
      array_push($filteredHLA, $value);
    }
  }

  return $filteredHLA;
}


function findPairScore($inputPair, $matchedPair) {

  //Pair score is calculated only for A, B, DR anitgens. Antigens C, DQ, DP are ignored

  //1. Finding pair score : (P_inp & D_match)
  $inputPatientHLA = explode(", ", $inputPair['patientHLA']);
  $matchedDonorHLA = explode(", ", $matchedPair['donorHLA']);
  //allow only A, B, DR and Dw
  $inputPatientHLA = filterHLA($inputPatientHLA);
  $matchedDonorHLA = filterHLA($matchedDonorHLA);
  //calculate pair score for (P_inp & D_match)
  $score1 = array_intersect($inputPatientHLA, $matchedDonorHLA);
  $score1 = sizeof($score1);

  //2. Finding pair score for P_match & D_inp
  $inputDonorHLA = explode(", ", $inputPair['donorHLA']);
  $matchedPatientHLA = explode(", ", $matchedPair['patientHLA']);
  //allow only A, B, DR and Dw
  $inputDonorHLA = filterHLA($inputDonorHLA);
  $matchedPatientHLA = filterHLA($matchedPatientHLA);
  // calculate pair score for P_match & D_inp
  $score2 = array_intersect($inputDonorHLA, $matchedPatientHLA);
  $score2 = sizeof($score2);

  $finalScore = $score1+$score2;

  //make the scores as fraction
  $score1 = $score1 . '/6';
  $score2 = $score2 . '/6';
  $finalScore = $finalScore . '/6';

  $pairScore = array($score1, $score2, $finalScore);
  return $pairScore;
}

function getMatches ($conn, $pair_id) {

  // get the data of given pair
  $inputPair = getPairDataById($conn, $pair_id);

  $allowedPatientBgrp = getAllowedPatientBgrp($inputPair['donorBloodGroup']);
  $allowedDonorBgrp = getAllowedDonorBgrp($inputPair['patientBloodGroup']);

  // covert to comma separated strings for sql query
  // is of form-----A +ve', 'A -ve', 'O +ve', 'O -ve -----final open and close quotes is given in the sql query
  $allowedPatientBgrpStr = implode("', '", $allowedPatientBgrp);
  $allowedDonorBgrpStr   = implode("', '", $allowedDonorBgrp);

  // gives records with matching blood group
  $possibleMatchQuery = 
  "SELECT patients.blood_group AS patientBloodGroup, 
  donors.blood_group AS donorBloodGroup, 
  patients.name AS patientName, 
  donors.name AS donorName, 
  patients.dob AS patientDOB, 
  donors.dob AS donorDOB, 
  patients.sex AS patientSex, 
  donors.sex AS donorSex, 
  patients.ua_antigens AS patientUA, 
  patients.hla_antigens AS patientHLA, 
  donors.hla_antigens AS donorHLA, 
  pd_pairs.pair_id AS pairId
  FROM ((pd_pairs 
  INNER JOIN patients ON pd_pairs.patient_id = patients.id) 
  INNER JOIN donors ON pd_pairs.donor_id = donors.id)
  WHERE patients.blood_group IN ('$allowedPatientBgrpStr') 
  AND donors.blood_group IN ('$allowedDonorBgrpStr')";

  $queryResult = mysqli_query($conn, $possibleMatchQuery);
  if(!$queryResult) {
    echo "Database possibleMatchQuery error ". mysqli_error($conn);
    exit();
  }

  $matchedPairArray = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);
  $matchResults = array();

  foreach ($matchedPairArray as $key => $matchedPair) {

    //delete the record containing the same pairId
    if ($matchedPair['pairId'] == $inputPair['pairId']) {
      unset($matchedPairArray[$key]);
      continue;
    }

    // (P_inp, D_inp)     ---> patient and donor of input pair i.e, $inputPair 
    // (P_match, D_match) ---> patient and donor of a possible match i.e, $matchedPair

    // check unacceptable antigens for P_inp & D_match
    $inputPatientUA = explode(", ", $inputPair['patientUA']);
    $matchedDonorHLA = explode(", ", $matchedPair['donorHLA']); 
    if (array_intersect($inputPatientUA, $matchedDonorHLA)) {
      unset($matchedPairArray[$key]);
      continue;
    }
    
    // check unacceptable antigens for P_match & D_inp
    $matchedPatientUA = explode(", ", $matchedPair['patientUA']);
    $inputDonorHLA = explode(", ", $inputPair['donorHLA']);
    if (array_intersect($inputDonorHLA, $matchedPatientUA)) {
      unset($matchedPairArray[$key]);
      continue;
    }

    // Now both blood matches and DSA not present
    // finding the pair score of input pair and matched pair
    $pairScore = findPairScore($inputPair, $matchedPair);


    $validPair = 
    array(
      "pairId" => $matchedPair['pairId'], 
      "patientSex" => $matchedPair['patientSex'], 
      "donorSex" => $matchedPair['donorSex'],
      "patientDOB" => $matchedPair['patientDOB'],
      "donorDOB" => $matchedPair['donorDOB'],
      "patientBloodGroup" => $matchedPair['patientBloodGroup'],
      "donorBloodGroup" => $matchedPair['donorBloodGroup'],
      "patientHLA" => $matchedPair['patientHLA'],
      "donorHLA" => $matchedPair['donorHLA'],
      "pairScore" => $pairScore 
      //pairScore[0] -> P_inp&D_match
      //pariScore[1] -> P_match&D_inp
      //pariScore[2] -> (P_inp&D_match) + (P_match&D_inp)
    );

    array_push($matchResults, $validPair);
  }

  // sort all the valid pair in descending order
  function cmp($a, $b) {
    if ($a['pairScore'][2] == $b['pairScore'][2]) {
      return 0;
    }
    return ($a['pairScore'][2] > $b['pairScore'][2]) ? -1 : 1;
  }

  usort($matchResults, "cmp");

  return $matchResults;
}