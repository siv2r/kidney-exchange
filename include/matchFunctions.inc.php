<?php
// TODO: move this function to a different file
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

// TODO: move this function to a different file
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

/**
 * Finds the blood groups to which the donor can donate
 *
 * @param string $donorBgrp - Blood group of donor
 * @return array $allowedPatientBgrp - possible blood groups to which the donor 
 *                                     can donate his/her blood.
 */
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

/**
 * Checks if blood donation possible form donor of pair1 to patient of pair2
 *
 * @param array $pair1 - blood donating pd pair
 * @param array $pair2 - blood recieving pd pair
 * @return boolean ,true - donation possible, false - donation not possible
 */
function isBgrpMatch($pair1, $pair2) {
  $allowedPatientBgrp = getAllowedPatientBgrp($pair1['dBGrp']);
  $currentPatientBGrp = $pair2['pBGrp'];
  if (in_array($currentPatientBGrp, $allowedPatientBgrp)) {
    return true;
  }

  return false;
}

/**
 * Checks if pair1's donor has any HLA anitgens that cannot be accepted by 
 * pair2's patient. (i.e. prescence of unacceptable antigens in donor)
 * 
 * Ex:
 * HLA of pair1's donor - A1, A2, B35, B2, DR2, DR51
 * UA of pair2's donor - B3, DR2
 * 
 * return false since, donor has HLA that patient cannot accept (i.e. DR2)
 *
 * @param array $pair1 - kidney donating pair
 * @param array $pair2 - kidney accepting pair
 * @return boolean 
 */
function isUApresent($pair1, $pair2) {
  $donorHla = explode(", ", $pair1['dHla']);
  $patientUa = explode(", ", $pair2['pUA']);
  $result = array_intersect($donorHla, $patientUa);

  // donor has patient's unacceptable antigen
  if (!empty($result)) {
    return true;
  }

  return false;
}

/**
 * Undocumented function
 *
 * @param [type] $donor
 * @param [type] $patient
 * @return boolean
 */
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

/**
 * Undocumented function
 *
 * @param [type] $a
 * @param [type] $b
 * @return void
 */
function cmp($a, $b) {
  if ($a['totalScore'] == $b['totalScore']) {
    return 0;
  }
  return ($a['totalScore'] > $b['totalScore']) ? -1 : 1;
}

/**
 * Undocumented function
 *
 * @param [type] $conn
 * @param [type] $pair_id
 * @return void
 */
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
      $currentMatch['totalScore'] = combinedPairScore($currentMatch['dScore'], $currentMatch['pScore']);
      $currentMatch['dScore'] = $currentMatch['dScore'];
      $currentMatch['pScore'] = $currentMatch['pScore'];

      array_push($matches, $currentMatch);
    }
  }
  usort($matches, "cmp"); //sort the matches in descending order

  return $matches;
}