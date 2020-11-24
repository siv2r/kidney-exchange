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


function getMatches ($conn, $pair_id) {

  $givenPairData = getPairDataById($conn, $pair_id);
  
  // do not forget to give space in ' +ve'. patient is matched with a donor
  // diff function and modular
  $allowedPatientBgrp[] = explode(' ', $givenPairData['donorBloodGroup'])[0] . ' +ve';
  $allowedPatientBgrp[] = explode(' ', $givenPairData['donorBloodGroup'])[0] . ' -ve';
  $allowedDonorBgrp[]   = explode(' ', $givenPairData['patientBloodGroup'])[0] . ' +ve';
  $allowedDonorBgrp[]   = explode(' ', $givenPairData['patientBloodGroup'])[0] . ' -ve';

  $allowedPatientBgrpStr = implode("', '", $allowedPatientBgrp);
  $allowedDonorBgrpStr   = implode("', '", $allowedDonorBgrp);

  // gives records with matching blood group
  $totalDataQuery = 
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

  $totalPairsResult = mysqli_query($conn, $totalDataQuery);
  if(!$totalPairsResult) {
    echo "Database totalDataQuery error ". mysqli_error($conn);
    exit();
  }

  $totalPairsData = mysqli_fetch_all($totalPairsResult, MYSQLI_ASSOC);
  $matchResults = array();

  foreach ($totalPairsData as $key => $row) {

    //delete the record containing the same pairId
    if ($row['pairId'] == $givenPairData['pairId']) {
      unset($totalPairsData[$key]);
      continue;
    }

    //check for unaceptable antigens 

    //P1 - D2 some thing like D2j
    $givenPatientUA = explode(", ", $givenPairData['patientUA']);
    $totalPairDonorHLA = explode(", ", $row['donorHLA']); //change the name
    if (array_intersect($givenPatientUA, $totalPairDonorHLA)) {
      unset($totalPairsData[$key]);
      continue;
    }
    //P2j - D1
    $givenDonorHLA = explode(", ", $givenPairData['donorHLA']);
    $totalPairPatientUA = explode(", ", $row['patientUA']);
    if (array_intersect($givenDonorHLA, $totalPairPatientUA)) {
      unset($totalPairsData[$key]);
      continue;
    }

    // Now both blood matches and DSA not present
    // compute the HLA ranking of P1-D2j
    $givenPatientHLA = explode(", ", $givenPairData['patientHLA']);
    $totalPairDonorHLA = explode(", ", $row['donorHLA']);
    $commonHLA_P1_D2 = array_intersect($givenPatientHLA, $totalPairDonorHLA);
    $commonHLA_P1_D2 = sizeof($commonHLA_P1_D2) . '/14'; // since there are 7 HLA

    $givenDonorHLA = explode(", ", $givenPairData['donorHLA']);
    $totalPairPatientHLA = explode(", ", $row['patientHLA']);
    $commonHLA_P2_D1 = array_intersect($givenDonorHLA, $totalPairPatientHLA);
    $commonHLA_P2_D1 = sizeof($commonHLA_P2_D1) . '/14'; // since there are 7 HLA

    $pairScore = array($commonHLA_P1_D2, $commonHLA_P2_D1);


    $validPair = 
    array(
      "pairId" => $row['pairId'], 
      "patientSex" => $row['patientSex'], 
      "donorSex" => $row['donorSex'],
      "patientDOB" => $row['patientDOB'],
      "donorDOB" => $row['donorDOB'],
      "patientBloodGroup" => $row['patientBloodGroup'],
      "donorBloodGroup" => $row['donorBloodGroup'],
      "patientHLA" => $row['patientHLA'],
      "donorHLA" => $row['donorHLA'],
      "pairScore" => $pairScore //pairScore[0] -> P1$D2 and pariScore[1] -> P2$D1
    );

    array_push($matchResults, $validPair);
  }

  // //sort the result
  // function cmp($a, $b) {
  //   if ($a[3][0] == $b[3][0]) {
  //     return 0;
  //   }
  //   return ($a[3][0] > $b[3][0]) ? -1 : 1;
  // }

  // usort($matchResults, "cmp");

  return $matchResults;
}