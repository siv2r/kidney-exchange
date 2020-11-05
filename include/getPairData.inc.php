<?php

require_once("../templates/db-connect.php");
require_once("../include/functions.inc.php");

$pData = getPatientById($conn, $patient_id);
$dData = getDonorById($conn, $donor_id);

if(!$pData) {
  echo "ERROR: fetching patient data";
}

if(!$dData) {
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
if(!empty($rHeight) && !empty($rWeight)) {
  $rBMI = number_format(($rWeight*100*100)/($rHeight*$rHeight), 2);
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
  if(in_array($value, $ComorbValues)) 
    continue;
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
while(sizeof($rPrevTransp) < 2) {
  array_push($rPrevTransp, '');
}

$rDialysis = explode(", ", $pData['dialysis']);
while(sizeof($rDialysis) < 3) {
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
if(!empty($dHeight) && !empty($dWeight)) {
  $dBMI = number_format(($dWeight*100*100)/($dHeight*$dHeight), 2);
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
  if(in_array($value, $ComorbValues)) 
    continue;
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
  "Maternal grandfather"
);


//set HLA default values
$HlaA = array (
  "Null",
  "A1",
  "A2",
  "A203",
  "A210",
  "A3",
  "A9",
  "A10",
  "A11",
  "A19",
  "A23(9)",
  "A24(9)",
  "A2403",
  "A25(10)",
  "A26(10)",
  "A28",
  "A29(19)",
  "A30(19)",
  "A31(19)",
  "A32(19)",
  "A33(19)",
  "A34(10)",
  "A36",
  "A43",
  "A66(10)",
  "A68(28)",
  "A69(28)",
  "A74(19)",
  "A80"
);

$HlaB = array (
  "Null",
  "B5",
  "B7",
  "B703",
  "B8",
  "B12",
  "B13",
  "B14",
  "B15",
  "B16",
  "B17",
  "B18",
  "B21",
  "B22",
  "B27",
  "B2708",
  "B35",
  "B37",
  "B38(16)",
  "B39(16)",
  "B3901",
  "B3901",
  "B3901",
  "B3902",
  "B40",
  "B4005",
  "B41",
  "B42",
  "B44(12)",
  "B45(12)",
  "B46",
  "B47",
  "B48",
  "B49(21)",
  "B50(21)",
  "B51(5)",
  "B5102",
  "B5103",
  "B52(5)",
  "B53",
  "B54(22)",
  "B55(22)",
  "B56(22)",
  "B57(17)",
  "B58(17)",
  "B59",
  "B60(40)",
  "B61(40)",
  "B62(15)",
  "B63(15)",
  "B64(14)",
  "B65(14)",
  "B67"
);

$HlaDR = array (
  "Null",
  "DR1",
  "DR103",
  "DR2",
  "DR3",
  "DR4",
  "DR5",
  "DR6",
  "DR7",
  "DR8",
  "DR9",
  "DR10",
  "DR11(5)",
  "DR12(5)",
  "DR13(6)",
  "DR14(6)",
  "DR1403",
  "DR1404",
  "DR15(2)",
  "DR16(2)",
  "DR17(3)",
  "DR18(3)",
  "DR51",
  "DR52",
  "DR53"
);

$HlaC = array (
  "None",
  "Cw1",
  "Cw2",
  "Cw3",
  "Cw4",
  "Cw5",
  "Cw6",
  "Cw7",
  "Cw8",
  "Cw9(w3)",
  "Cw10(w3)"
);

$HlaD = array (
  "None",
  "Dw1",
  "Dw2",
  "Dw3",
  "Dw4",
  "Dw5",
  "Dw6",
  "Dw7",
  "Dw8",
  "Dw9",
  "Dw10",
  "Dw11(w7)",
  "Dw12",
  "Dw13",
  "Dw14",
  "Dw15",
  "Dw16",
  "Dw17(w7)",
  "Dw18(w6)",
  "Dw19(w6)",
  "Dw20",
  "Dw21",
  "Dw22",
  "Dw23",
  "Dw24",
  "Dw25",
  "Dw26"
);

$HlaDQ = array (
  "None",
  "DQ1",
  "DQ2",
  "DQ3",
  "DQ4",
  "DQ5(1)",
  "DQ6(1)",
  "DQ7(3)",
  "DQ8(3)",
  "DQ9(3)"
);

$HlaDP = array (
  "None",
  "DPw1",
  "DPw2",
  "DPw3",
  "DPw4",
  "DPw5",
  "DPw6"
);

