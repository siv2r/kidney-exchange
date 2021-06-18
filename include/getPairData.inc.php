<?php

// this will be included in editPairForm.php

require_once "../db-connect.php";
require_once "../include/functions.inc.php";

$pData = getPatientById($conn, $patient_id);
$dData = getDonorById($conn, $donor_id);

if (!$pData) {
  echo "ERROR: fetching patient data";
}

if (!$dData) {
  echo "ERROR: fetching donor data";
}

//set available comorb values
$ComorbValues = array("None", "Type1 DM", "Type2 DM", "Hypertension", "Coronary artery disease", "Chronic liver disease", "Chronic obstructive pulmonary disease", "Cancer", "Others");

// get recipient form variables
$rNameArray = explode(" ", $pData['name']);
$rSex = $pData['sex'];
$rDOB = $pData['dob'];
$rHeight = $pData['height'];
$rWeight = $pData['weight'];

$rBMI = '';
if (!empty($rHeight) && !empty($rWeight)) {
  $rBMI = number_format(($rWeight * 100 * 100) / ($rHeight * $rHeight), 2);
}

$rBloodGroup = $pData['blood_group'];

$rAddressArray = explode(", ", $pData['address']);
//set null for other fields if it was partially filled
while (sizeof($rAddressArray) < 6) {
  array_push($rAddressArray, '');
}
//combine 1st and 2nd element since, addr1 and addr2 can have ', ' in them and we need exactly 6 field values
while (sizeof($rAddressArray) > 6) {
  $rAddressArray[1] = $rAddressArray[0] . ', ' . $rAddressArray[1];
  array_shift($rAddressArray);
}

$rCno = $pData['contact_number'];
$rEmail = $pData['email'];
$rHlaArray = explode(", ", $pData['hla_antigens']);
$rUaArray = explode(", ", $pData['ua_antigens']);
$rBasicDisease = $pData['basic_disease'];
$rBiopsy = $pData['gr_biopsy'];

$rComorbOthers = '';
$rComorbOthersCheck = 0;
$rComorbOthersArray = array(); //since user might have entered many comma separated values in the others field
$rComorbArray = explode(", ", $pData['comorb']);

foreach ($rComorbArray as $key => $value) {
  if (in_array($value, $ComorbValues)) {
    continue;
  }

  array_push($rComorbOthersArray, $value);
  unset($rComorbArray[$key]); //delete the comorb others element
  $rComorbOthersCheck = 1;
}

if ($rComorbOthersCheck === 1) { //if user has entered data in the others field
  $rComorbOthers = implode(", ", $rComorbOthersArray);
  array_push($rComorbArray, "Others");
}

$rHiv = $pData['hiv'];
$rHepB = $pData['hep_b'];
$rHepC = $pData['hep_c'];

$rPrevTransp = explode(", ", $pData['prev_transp']);
while (sizeof($rPrevTransp) < 2) {
  array_push($rPrevTransp, '');
}

$rDialysis = explode(", ", $pData['dialysis']);
while (sizeof($rDialysis) < 3) {
  array_push($rDialysis, '');
}

$rDDP = explode(", ", $pData['dd_program']);
while (sizeof($rDDP) < 2) {
  array_push($rDDP, '');
}

$rPrimeNephro = $pData['prime_nephro'];
$rHosp = $pData['hospital'];
$rProvClear = $pData['prov_clearance'];

$rPreTranspSurg = explode(", ", $pData['pre_transp_surgery']);
while (sizeof($rPreTranspSurg) < 2) {
  array_push($rPreTranspSurg, '');
}

//get donor variables
$dNameArray = explode(" ", $dData['name']);
$dSex = $dData['sex'];
$dDOB = $dData['dob'];
$dHeight = $dData['height'];
$dWeight = $dData['weight'];

$dBMI = '';
if (!empty($dHeight) && !empty($dWeight)) {
  $dBMI = number_format(($dWeight * 100 * 100) / ($dHeight * $dHeight), 2);
}

$dBloodGroup = $dData['blood_group'];
$dRelation = $dData['relation'];
$dAddressArray = explode(", ", $dData['address']);
//set null for other fields if it was partially filled
while (sizeof($dAddressArray) < 6) {
  array_push($dAddressArray, '');
}
//combine 1st and 2nd element since, addr1 and addr2 can have ', ' in them and we need exactly 6 field values
while (sizeof($dAddressArray) > 6) {
  $dAddressArray[1] = $dAddressArray[0] . ', ' . $dAddressArray[1];
  array_shift($dAddressArray);
}

$dCno = $dData['contact_number'];
$dEmail = $dData['email'];
$dHlaArray = explode(", ", $dData['hla_antigens']);

$dComorbOthers = '';
$dComorbOthersCheck = 0;
$dComorbOthersArray = array(); //since user might have entered many comma separated values in the others field
$dComorbArray = explode(", ", $dData['comorb']);

foreach ($dComorbArray as $key => $value) {
  if (in_array($value, $ComorbValues)) {
    continue;
  }

  array_push($dComorbOthersArray, $value);
  unset($dComorbArray[$key]); //delete the comorb others element
  $dComorbOthersCheck = 1;
}

if ($dComorbOthersCheck === 1) { //if user has entered data in the others field
  $dComorbOthers = implode(", ", $dComorbOthersArray);
  array_push($dComorbArray, "Others");
}

$dHiv = $dData['hiv'];
$dHepB = $dData['hep_b'];
$dHepC = $dData['hep_c'];
$dAlcohol = $dData['alcohol'];
$dSmoking = $dData['smoking'];
$dProvClear = $dData['prov_clearance'];

//set relation values
$relationValues = array(
  "Father",
  "Mother",
  "Spouse",
  "Son",
  "Daughter",
  "Brother",
  "Sister",
  "Paternal grandmother",
  "Paternal grandfather",
  "Maternal grandmother",
  "Maternal grandfather",
);
