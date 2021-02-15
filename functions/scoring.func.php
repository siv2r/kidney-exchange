<?php
/**
 * Calculates score for the edge from $pair1's donor to $pair2's patient
 * in the compatibility graph
 *
 * @param array $pair1 contains patient donor data of donating pair
 * @param array $pair2 contains patient donor data of accepting pair
 * @return integer score weight of the edge
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
 * Combines the two edge weight for a 2-way match
 * 
 * Ex: 1->2 is 20
 *     2->1 is 30 
 *     then, 1<->2 is 50
 *
 * @param integer $score1 weight of the edge from donor1 to patient2
 * @param integer $score2 weight of the edge form donor2 to patient1
 * @return integer
 */
function combinedPairScore($score1, $score2) {
  $combined = $score1 + $score2;
  return $combined;
}
