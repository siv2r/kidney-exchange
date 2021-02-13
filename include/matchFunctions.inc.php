<?php

function getPairDataById($conn, $pair_id) {

  $query =
    "SELECT pd_pairs.pair_id AS pairId,
  pd_pairs.patient_id AS pId,
  pd_pairs.donor_id AS dId,
  pd_pairs.hosp_id AS hospId,
  pd_pairs.status AS pairStatus,
  patients.name AS pName,
  patients.sex AS pSex,
  patients.dob AS pDob,
  patients.height AS pHeight,
  patients.weight AS pWeight,
  patients.blood_group AS pBGrp,
  patients.address AS pAddress,
  patients.contact_number AS pMobile,
  patients.email AS pEmail,
  patients.hla_antigens AS pHla,
  patients.ua_antigens AS pUA,
  patients.basic_disease AS pBasicDisease,
  patients.gr_biopsy AS pGrbiopsy,
  patients.comorb AS pComorb,
  patients.hiv AS pHiv,
  patients.hep_b AS pHepb,
  patients.hep_c AS pHepc,
  patients.prev_transp AS pPrevTransp,
  patients.dialysis AS pDialysis,
  patients.dd_program AS pDDProgram,
  patients.prime_nephro AS pNephro,
  patients.prov_clearance AS pProvClearance,
  patients.pre_transp_surgery AS pPreSurgery,
  patients.created_at AS pCreatedAt,
  patients.updated_at AS pUpdatedAt,
  donors.name AS dName,
  donors.sex AS dSex,
  donors.dob AS dDob,
  donors.height AS dHeight,
  donors.weight AS dWeight,
  donors.blood_group AS dBGrp,
  donors.relation AS dRelation,
  donors.address AS dAddress,
  donors.contact_number AS dMobile,
  donors.email AS dEmail,
  donors.hla_antigens AS dHla,
  donors.comorb AS pComorb,
  donors.hiv AS dHiv,
  donors.hep_b AS dHepb,
  donors.hep_c AS dHepc,
  donors.alcohol AS dAlcohol,
  donors.smoking AS dSmoking,
  donors.prov_clearance AS dProvClearance,
  donors.created_at AS dCreatedAt,
  donors.updated_at AS dUpdatedAt
  FROM ((pd_pairs
  INNER JOIN patients ON pd_pairs.patient_id = patients.id)
  INNER JOIN donors ON pd_pairs.donor_id = donors.id)
  WHERE pd_pairs.pair_id = '$pair_id'
  LIMIT 1";

  $result = mysqli_query($conn, $query);
  if (!$result) {
    echo "givenPairId database query error" . mysqli_error($conn);
    exit();
  }
  $pairData = mysqli_fetch_assoc($result);

  return $pairData;
}

function getAllPairData($conn) {
  //naming convension for JSON dump
  $allPairData =
    "SELECT pd_pairs.pair_id AS pairId,
  pd_pairs.patient_id AS pId,
  pd_pairs.donor_id AS dId,
  pd_pairs.hosp_id AS hospId,
  pd_pairs.status AS pairStatus,
  patients.name AS pName,
  patients.sex AS pSex,
  patients.dob AS pDob,
  patients.height AS pHeight,
  patients.weight AS pWeight,
  patients.blood_group AS pBGrp,
  patients.address AS pAddress,
  patients.contact_number AS pMobile,
  patients.email AS pEmail,
  patients.hla_antigens AS pHla,
  patients.ua_antigens AS pUA,
  patients.basic_disease AS pBasicDisease,
  patients.gr_biopsy AS pGrbiopsy,
  patients.comorb AS pComorb,
  patients.hiv AS pHiv,
  patients.hep_b AS pHepb,
  patients.hep_c AS pHepc,
  patients.prev_transp AS pPrevTransp,
  patients.dialysis AS pDialysis,
  patients.dd_program AS pDDProgram,
  patients.prime_nephro AS pNephro,
  patients.prov_clearance AS pProvClearance,
  patients.pre_transp_surgery AS pPreSurgery,
  patients.created_at AS pCreatedAt,
  patients.updated_at AS pUpdatedAt,
  donors.name AS dName,
  donors.sex AS dSex,
  donors.dob AS dDob,
  donors.height AS dHeight,
  donors.weight AS dWeight,
  donors.blood_group AS dBGrp,
  donors.relation AS dRelation,
  donors.address AS dAddress,
  donors.contact_number AS dMobile,
  donors.email AS dEmail,
  donors.hla_antigens AS dHla,
  donors.comorb AS pComorb,
  donors.hiv AS dHiv,
  donors.hep_b AS dHepb,
  donors.hep_c AS dHepc,
  donors.alcohol AS dAlcohol,
  donors.smoking AS dSmoking,
  donors.prov_clearance AS dProvClearance,
  donors.created_at AS dCreatedAt,
  donors.updated_at AS dUpdatedAt
  FROM ((pd_pairs
  INNER JOIN patients ON pd_pairs.patient_id = patients.id)
  INNER JOIN donors ON pd_pairs.donor_id = donors.id)";

  $queryResult = mysqli_query($conn, $allPairData);
  if (!$queryResult) {
    echo "Database joining query error " . mysqli_error($conn);
    exit();
  }
  $pairDataArray = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);

  return $pairDataArray;
}


function getAllowedPatientBgrp($donorBgrp) {
  $allowedPatientBgrp = []; //result array

  //remove Rh factor i.e, A +ve -> A
  $donorBgrpNoRh = explode(' ', $donorBgrp)[0];

  //donor's own blood grp is allowed (both +ve and -ve)
  //don't forget sapce in ' +ve'
  array_push($allowedPatientBgrp, $donorBgrpNoRh . ' +ve');
  array_push($allowedPatientBgrp, $donorBgrpNoRh . ' -ve');

  // A or B can donate to AB
  if ($donorBgrpNoRh == 'A' || $donorBgrpNoRh == 'B') {
    array_push($allowedPatientBgrp, 'AB +ve');
    array_push($allowedPatientBgrp, 'AB -ve');
  }

  // O can donate to A, B, AB
  else if ($donorBgrpNoRh == 'O') {
    array_push($allowedPatientBgrp, 'AB +ve');
    array_push($allowedPatientBgrp, 'AB -ve');
    array_push($allowedPatientBgrp, 'A +ve');
    array_push($allowedPatientBgrp, 'A -ve');
    array_push($allowedPatientBgrp, 'B +ve');
    array_push($allowedPatientBgrp, 'B -ve');
  }

  return $allowedPatientBgrp;
}

function isBgrpMatch($donor, $patient) {
  $allowedPatientBgrp = getAllowedPatientBgrp($donor['dBGrp']);
  $currentPatientBGrp = $patient['pBGrp'];
  if (in_array($currentPatientBGrp, $allowedPatientBgrp)) {
    return true;
  }

  return false;
}

function isUApresent($donor, $patient) {
  $donorHla = explode(", ", $donor['dHla']);
  $patientUa = explode(", ", $patient['pUA']);
  $result = array_intersect($donorHla, $patientUa);

  // donor has patient's unacceptable antigen
  if (!empty($result)) {
    return true;
  }

  return false;
}

function filterHLA($givenHLA) {
  $pattern = "/(A|B|DR|Dw)/"; //allowed hla values
  $filteredHLA = array();

  foreach ($givenHLA as $key => $value) {
    if (preg_match($pattern, $value)) {
      array_push($filteredHLA, $value);
    }
  }

  return $filteredHLA;
}

function isMatch($donor, $patient) {
  // Can donor donate blood to patient?
  if (!isBgrpMatch($donor, $patient)) {
    return false;
  }
  // prescence of unacceptable antigen
  elseif (isUApresent($donor, $patient)) {
    return false;
  }

  return true;
}

// helper func for sorting matches
function cmp($a, $b) {
  if ($a['totalScore'] == $b['totalScore']) {
    return 0;
  }
  return ($a['totalScore'] > $b['totalScore']) ? -1 : 1;
}

function getMatches($conn, $pair_id) {
  $givenPair = getPairDataById($conn, $pair_id);
  $allPair = getAllPairData($conn);
  $allPairLen = sizeof($allPair);
  $matches = array();

  for ($i = 0; $i < $allPairLen; $i++) {
    $currentPair = $allPair[$i];
    if ($currentPair['pairId'] == $givenPair['pairId']) {
      continue;
    }

    // check match
    if (isMatch($givenPair, $currentPair) && isMatch($currentPair, $givenPair)) {
      $currentMatch = array();

      $currentMatch['pairData'] = $currentPair;
      //find the score
      $currentMatch['dScore'] = calcScore($givenPair, $currentPair);
      $currentMatch['pScore'] = calcScore($currentPair, $givenPair);
      $currentMatch['totalScore'] = combinedPairScore($currentMatch['dScore'], $currentMatch['pScore']) . '/12';
      $currentMatch['dScore'] = $currentMatch['dScore'] . '/6';
      $currentMatch['pScore'] = $currentMatch['pScore'] . '/6';

      array_push($matches, $currentMatch);
    }
  }
  usort($matches, "cmp"); //sort the matches in descending order

  return $matches;
}