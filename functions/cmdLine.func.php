<?php
/**
 * Calls pipline.py with neccessary arguments to find global solution
 * @param  string   $maxCycle
 * @param  string   $optimality
 * @return string
 */
function findGlobalSoln( $maxCycle, $optimality ) {
  $base_command = '../.venv/bin/python3 pipeline.py -f ./graph.json';
  $arg_cycle    = "-s $maxCycle";
  $arg_opt      = "-o $optimality";
  $command      = "$base_command $arg_cycle $arg_opt";
  $command      = escapeshellcmd( $command );
  //TODO find a way to catch if error occurs
  $output = shell_exec( $command );

  return $output;
}
