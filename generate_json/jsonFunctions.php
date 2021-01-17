<?php 

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
  if(!$queryResult) {
    echo "Database joining query error ". mysqli_error($conn);
    exit();
  }

  $pairDataArray = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);

  return $pairDataArray;
}

function toJSON($allPairData){
  //store final result
  $res = array();
  $res['data'] = array();

  foreach ($allPairData as $index => $pair) {
    array_push($res['data'], $pair);
  }

  $jsonVal = json_encode($res, JSON_PRETTY_PRINT);
  
  //check if encode was success
  if ($jsonVal) {
    return $jsonVal;
  } else {
    echo 'Error in encoding JSON data : ' . json_last_error_msg();
    exit();
  }
  
}


function calcScore($donor, $patient){
  return 1;
}

function isMatch($donor, $patient){
  // Can donor donate blood to patient?

  // prescence of unacceptable antigen

  return true;
}
