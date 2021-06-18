<?php

require_once '../db-connect.php';
require_once 'functions.inc.php';

$uname = 'admin1';
$email = 'admin1@gmail.com';
$hosp_id = 0;
$pswd = 'kep1';

createAdmin($conn, $uname, $email, $hosp_id, $pswd);
