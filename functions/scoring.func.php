<?php
/**
 * Undocumented function
 *
 * @param array $inputPair
 * @param [type] $matchedPair
 * @return void
 */
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

  $finalScore = $score1 + $score2;

  //make the scores as fraction
  $score1 = $score1 . '/6';
  $score2 = $score2 . '/6';
  $finalScore = $finalScore . '/6';

  $pairScore = array($score1, $score2, $finalScore);
  return $pairScore;
}

/**
 * Calculate weight for the edge from $pair1's donor to $pair2's patient
 * in the compatibility graph
 *
 * @param array $pair1 contains patient donor data of donating pair
 * @param array $pair2 contains patient donor data of accepting pair
 * @return integer score for the edge
 */
function calcScore($pair1, $pair2) {
  $donorHla = explode(", ", $pair1['dHla']);
  $patientHla = explode(", ", $pair2['pHla']);

  // only A, B, DR, Dw should be used for scoring
  $donorHla = filterHLA($donorHla);
  $patientHla = filterHLA($patientHla);

  $commonHla = array_intersect($donorHla, $patientHla);
  $score = sizeof($commonHla);

  return $score;
}

/**
 * Undocumented function
 *
 * @param [type] $score1
 * @param [type] $score2
 * @return void
 */
function combinedPairScore($score1, $score2) {
  $combined = $score1 + $score2;
  return $combined;
}
