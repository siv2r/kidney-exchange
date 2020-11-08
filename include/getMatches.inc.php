<?php 


function getMatches ($pair_id) {

  require_once("../templates/db-connect.php"); // connect to the database

  $givenDataQuery = 
  "SELECT patients.blood_group AS patientBloodGroup, 
  donors.blood_group AS donorBloodGroup, 
  patients.name AS patientName, 
  donors.name AS donorName, 
  patients.ua_antigens AS patientUA, 
  patients.hla_antigens AS patientHLA, 
  donors.hla_antigens AS donorHLA, 
  pd_pairs.pair_id AS pairId
  FROM ((pd_pairs 
  INNER JOIN patients ON pd_pairs.patient_id = patients.id) 
  INNER JOIN donors ON pd_pairs.donor_id = donors.id)
  WHERE pd_pairs.pair_id = '$pair_id'
  LIMIT 1";

  $givenPairResult = mysqli_query($conn, $givenDataQuery);
  if(!$givenPairResult) {
    echo "givenPairId database query error" . mysqli_error($conn);
    exit();
  }

  $givenPairData = mysqli_fetch_assoc($givenPairResult);
  
  // do not forget to give space in ' +ve'. patient is matched with a donor
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

    //P1 - D2
    $givenPatientUA = explode(", ", $givenPairData['patientUA']);
    $totalPairDonorHLA = explode(", ", $row['donorHLA']);
    if (array_intersect($givenPatientUA, $totalPairDonorHLA)) {
      unset($totalPairsData[$key]);
      continue;
    }
    //P2 - D1
    $givenDonorHLA = explode(", ", $givenPairData['donorHLA']);
    $totalPairPatientUA = explode(", ", $row['patientUA']);
    if (array_intersect($givenDonorHLA, $totalPairPatientUA)) {
      unset($totalPairsData[$key]);
      continue;
    }

    // Now both blood matches and DSA not present
    // compute the HLA ranking of P1-D2
    $givenPatientHLA = explode(", ", $givenPairData['patientHLA']);
    $totalPairDonorHLA = explode(", ", $row['donorHLA']);
    $commonHLA = array_intersect($givenPatientHLA, $totalPairDonorHLA);

    $pairScore = sizeof($commonHLA) . '/14'; // since 7 HLA are there

    $validPair = 
    array($row['pairId'], $row['patientName'], $row['donorName'], $pairScore);

    array_push($matchResults, $validPair);
  }

  //sort the result
  function cmp($a, $b) {
    if ($a[3] == $b[3]) {
      return 0;
    }
    return ($a[3] > $b[3]) ? -1 : 1;
  }

  usort($matchResults, "cmp");

  return $matchResults;
}