<?php
/**
 * Undocumented function
 *
 * @param  [type] $givenArray
 * @param  string $filter
 * @return array  $filteredValues
 */
function filterArray( $givenArray, $filter = "/(A|B|DR|Dw)/" ) {
  $filteredValues = [];

  foreach ( $givenArray as $key => $value ) {
    if ( preg_match( $filter, $value ) ) {
      array_push( $filteredValues, $value );
    }
  }

  return $filteredValues;
}

/**
 * returns score according mismatch of DR Hla of pair1's donor with pair2's patient
 *
 * @param  array   $pair1 - donating pair (so, donor of this pair will be taken)
 * @param  array   $pair2 - recieving pair (so, patient of this pair will be taken)
 * @return integer - score wrt to mismatch of DR
 */
function DRmismatch( $pair1, $pair2 ) {
  $donorHla   = explode( ", ", $pair1['dHla'] );
  $patientHla = explode( ", ", $pair2['pHla'] );
  // consider only DR
  $donorHla   = filterArray( $donorHla, "/(DR)/" );
  $patientHla = filterArray( $patientHla, "/(DR)/" );

  $commonDRs = array_intersect( $donorHla, $patientHla );
  $mismatch  = 2 - sizeof( $commonDRs );

//score according to mismatch
  if ( $mismatch === 0 ) {
    return 2;
  } elseif ( $mismatch === 1 ) {
    return 1;
  } else {
    return 0;
  }
}

/**
 * returns score according match of A, B, DR, Dw  Hla of pair1's donor with pair2's patient
 *
 * @param  array   $pair1 - donating pair (so, donor of this pair will be taken)
 * @param  array   $pair2 - recieving pair (so, patient of this pair will be taken)
 * @return integer - score wrt to matching of all 6 HLA's
 */
function zeroHlaMismatch( $pair1, $pair2 ) {
  // TODO: Should we consider only A, B, DR, Dw? or All the HLA
  $donorHla   = explode( ", ", $pair1['dHla'] );
  $patientHla = explode( ", ", $pair2['pHla'] );
  // consider only DR, Dw, A, B
  $donorHla   = filterArray( $donorHla );
  $patientHla = filterArray( $patientHla );

  $commonHLAs = array_intersect( $donorHla, $patientHla );
  $match      = sizeof( $commonHLAs );

//score according to mismatch
  if ( $match === 6 ) {
    return 6;
  } else {
    return 0;
  }
}

/**
 * Not implemented yet
 *
 * @return integer
 */
function highPRA() {
  return 0;
}
/**
 * Undocumented function
 *
 * @param  [type] $pair1
 * @param  [type] $pair2
 * @return string
 */
function travelDist( $pair1, $pair2 ) {
//TODO: Currently, using pincode but this will change. Then how to measure distance??
  $donorAddress   = explode( ", ", $pair1['dAddress'] );
  $patientAddress = explode( ", ", $pair2['pAddress'] );
  //filter out the pincode
  $donorLocation   = filterArray( $donorAddress, "/^[1-9]{1}[0-9]{5}$/" );
  $patientLocation = filterArray( $patientAddress, "/^[1-9]{1}[0-9]{5}$/" );

  if ( sizeof( $donorLocation ) !== sizeof( $patientLocation ) ) {
    echo "Invalid donor or patient loaction after filter :(";
    exit();
  }

  if ( $donorLocation[0] === $patientLocation[0] ) {
    return 3;
  } else {
    return 0;
  }
}
/**
 * Undocumented function
 *
 * @param [type] $pair1
 * @return string
 */
function pediatricPatient( $pair1 ) {
  $patientDob = $pair1['pDob'];
  $patientAge = toAge( $patientDob );

  if ( $patientAge <= 5 ) {
    return 4;
  } else
  if ( $patientAge <= 17 ) {
    return 2;
  }

  return 0;
}
/**
 * Undocumented function
 *
 * @param [type] $pair1
 * @return string
 */
function patientOnceDonor( $pair1 ) {
//TODO: Information unavailable in the database
  return 0;
}
/**
 * Undocumented function
 *
 * @return string
 */
function negCrossMatch() {
//TODO: Information unavialbe in the database
  return 0;
}
/**
 * Undocumented function
 *
 * @param string $pair1
 * @param string $pair2
 * @return integer
 */
function ageDiffDonors( $pair1, $pair2 ) {
  $donor1Dob = $pair1['dDob'];
  $donor1Age = toAge( $donor1Dob );
  $donor2Dob = $pair2['dDob'];
  $donor2Age = toAge( $donor2Dob );

  $ageDiff = abs( $donor1Age - $donor2Age );

  if ( $ageDiff <= 20 ) {
    return 3;
  }

  return 0;
}

/**
 * Calculates score for the edge from $pair1's donor to $pair2's patient
 * in the compatibility graph
 *
 * @param  array   $pair1 contains patient donor data of donating pair
 * @param  array   $pair2 contains patient donor data of accepting pair
 * @return integer score weight of the edge
 */
function calcScore( $pair1, $pair2 ) {
  $score = 0;

  //add scores due to diff parameters
  $score += DRmismatch( $pair1, $pair2 );
  $score += zeroHlaMismatch( $pair1, $pair2 );
  $score += highPRA();
  $score += travelDist( $pair1, $pair2 );
  $score += pediatricPatient( $pair1 );
  $score += patientOnceDonor( $pair1 );
  $score += negCrossMatch();
  $score += ageDiffDonors( $pair1, $pair2 );

  return $score;
}

/**
 * Combines the edge weight of two arcs in a 2-way match
 *
 * Ex: 1->2 is 20
 *     2->1 is 30
 *     then, 1<->2 is 50
 *
 * @param  integer   $score1 weight of the edge from donor1 to patient2
 * @param  integer   $score2 weight of the edge form donor2 to patient1
 * @return integer
 */
function combinedPairScore( $score1, $score2 ) {
  $combined = $score1 + $score2;

  return $combined;
}
