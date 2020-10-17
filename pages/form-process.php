<?php 

function random_strings($length_of_string){

	$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

	// Shufle the $str_result and returns substring of specified length
	return substr(str_shuffle($str_result), 0, $length_of_string);
}

// --------------------------------------------create a message page to display the registraion result------------------

/*------------------data format----------------------------------------------


Array ( [r_img] => card-with-images-data.png [r_fname] => Karthik [r_lname] => Kumar [r_sex] => male [r_dob] => 1987-09-23 [r_height] => 178.56 [r_weight] => 85 
[r_bmi] => 26.66 [r_b-type] => A -ve [r_b-report] => card-with-images-data.png 

[r_addr1] => NEW NO.AP859, H-BLOCK GROUND FLOOR, 11TH MN RD, 2ND ST [r_addr2] => Anna nagar [r_city] => Chennai [r_state] => Tamilnadu [r_pincode] => 600040 [r_country] => India [r_cno] => 9883756673 [r_email] => anna42@gmail.com 

[r_hla_a] => Array ( [0] => A2 [1] => A203 ) [r_hla_b] => Array ( [0] => [1] => ) [r_hla_dr] => Array ( [0] => [1] => ) [r_hla-report] => card-with-images-data.png [r_ua_a] => Array ( [0] => A1 [1] => A203 ) [r_ua_b] => Array ( [0] => ) [r_ua_dr] => Array ( [0] => ) [r_ua-report] => card-with-images-data.png 

[r_b-disease] => flu, cold [r_gr-biopsy] => [r_comorb] => Array ( [0] => Type1 DM [1] => Type2 DM [2] => Others ) [r_comorb-others] => comorb others [r_hiv] => negative [r_hepB] => positive [r_hepC] => negative [r_prev-transp] => yes [r_dot] => 2015-09-23 [r_mod] => hemodialysis [r_dod] => 2015-08-23 [r_vs-access] => AV graft [r_ddp] => yes [r_ddp-regno] => 802385034 
[r_p-nephro] => John Doe [r_d-center] => Mehta [r_prov-clear] => yes [r_pre-transp] => yes [pre-transp-specify] => pre transp specify

[d_fname] => Anand [d_lname] => Balaji [d_sex] => on [d_dob] => 1990-09-23 [d_height] => 159 [d_weight] => 78.54 [d_bmi] => 31.07 [d_b-type] => A +ve [d_b-report] => card-with-images-data.png [d_rel] => Son [d_addr1] => NEW NO.AP859, H-BLOCK GROUND FLOOR, 11TH MN RD, 2ND ST [d_addr2] => Anna nagar [d_city] => Chennai [d_state] => Tamilnadu [d_pincode] => 600040 [d_country] => India [d_cno] => 9882749983 [d_email] => tambhi42@gmail.com 

[d_hla_a] => Array ( [0] => A1 [1] => A9 ) [d_hla_b] => Array ( [0] => [1] => ) [d_hla_dr] => Array ( [0] => [1] => ) [d_hla-report] => card-with-images-data.png 

[d_comorb] => Array ( [0] => Type1 DM [1] => Type2 DM [2] => Others ) [d_comorb-others] => donor comorb others [d_hiv] => on [d_hepB] => on [d_hepC] => on [d_alcohol] => yes [d_smoking] => yes [d_prov-clear] => yes )



----------------------------------------------------------------------------*/

$status = '';
$statusMsg = '';

if(!empty($_POST['r_fname'])){

  //id generation
	$mid_id = random_strings(5);
  $r_id =  $mid_id . '-' . 'p';
  $d_id =  $mid_id . '-' . 'd';

  //patient info
  //patient personal info
  $r_name = $_POST['r_fname'] . ' ' . $_POST['r_lname'];
  $r_name = addslashes($r_name);
  $r_sex = $_POST['r_sex'];
  $r_dob = $_POST['r_dob'];
  $r_height = $_POST['r_height'];
  $r_weight = $_POST['r_weight'];
  // $r_bmi = $_POST['r_bmi'];
  $r_btype = $_POST['r_b-type'];
  
  //patient contact info
  $r_address = $_POST['r_addr1'] . ', ' . $_POST['r_addr2'] . ', ' . $_POST['r_city'] . ', ' . $_POST['r_state'] . ', ' . $_POST['r_pincode'] . ', ' . $_POST['r_country'];
  $r_address = addslashes($r_address);
  $r_cno = $_POST['r_cno'];
  $r_email = $_POST['r_email'];  // do we need addslashes() here?

  //patient medical info
  $r_basicd = addslashes($_POST['r_b-disease']);
  $r_gr = addslashes($_POST['r_gr-biopsy']);
  $r_comorb_array = $_POST['r_comorb'];

  foreach($r_comorb_array as $key => $value){
    if($value == 'Others'){
      $r_comorb_array[$key] = $_POST['r_comorb-others'];
    }
  }

  $r_comorb = addslashes(implode(', ', $r_comorb_array));
  $r_hiv = $_POST['r_hiv'];
  $r_hepb = $_POST['r_hepB'];
  $r_hepc = $_POST['r_hepC'];
  $r_prev_transp = $_POST['r_prev-transp'];

  if($r_prev_transp == 'yes'){
    $r_prev_transp = $r_prev_transp . ', '. $_POST['r_dot'];
  }

  $r_dialysis = $_POST['r_mod'];

  if($r_dialysis == 'hemodialysis'){
    $r_dialysis = $r_dialysis . ', '. $_POST['r_dod'] . ', ' . $_POST['r_vs-access'];
  }
  else if($r_dialysis == 'peritoneal dialysis'){
    $r_dialysis = $r_dialysis . ', '. $_POST['r_dod'];
  }

  $r_ddp = $_POST['r_ddp'];

  if($r_ddp == 'yes'){
    $r_ddp = $r_ddp . ', '. $_POST['r_ddp-regno'];
  }


  $r_nephro = addslashes($_POST['r_p-nephro']);
  $r_dcenter = addslashes($_POST['r_d-center']);
  $r_prov_clear = $_POST['r_prov-clear'];
  $r_pre_transp = $_POST['r_pre-transp'];

  if($r_pre_transp == 'yes'){
    $r_pre_transp = $r_pre_transp . ', ' . $_POST['pre-transp-specify'];
  }

  $r_pre_transp = addslashes($r_pre_transp);

  
  //donor info
  //donor personal info
	$d_name = $_POST['d_fname'] . ' ' . $_POST['d_lname'];
	$d_name = addslashes($d_name);
  $d_sex = $_POST['d_sex'];
  $d_dob = $_POST['d_dob'];
  $d_height = $_POST['d_height'];
  $d_weight = $_POST['d_weight'];
  // $d_bmi = $_POST['d_bmi'];
  $d_btype = $_POST['d_b-type'];
  $d_rel = $_POST['d_rel'];
  
  //donor contact info
  $d_address = $_POST['d_addr1'] . ', ' . $_POST['d_addr2'] . ', ' . $_POST['d_city'] . ', ' . $_POST['d_state'] . ', ' . $_POST['d_pincode'] . ', ' . $_POST['d_country'];
  $d_address = addslashes($d_address);
  $d_cno = $_POST['d_cno'];
  $d_email = $_POST['d_email'];

  //donor medical info
  $d_comorb_array = $_POST['d_comorb'];

  foreach($d_comorb_array as $key => $value){
    if($value == 'Others'){
      $d_comorb_array[$key] = addslashes($_POST['d_comorb-others']);
    }
  }

  $d_comorb = addslashes(implode(', ', $d_comorb_array));
  $d_hiv = $_POST['d_hiv'];
  $d_hepb = $_POST['d_hepB'];
  $d_hepc = $_POST['d_hepC'];
  $d_alcohol = $_POST['d_alcohol'];
  $d_smoking = $_POST['d_smoking'];
  $d_prov_clear = $_POST['d_prov-clear'];

  //getting the antigen information for both patient and donor
  $r_hla = '';
  $r_ua = '';
  $d_hla = '';
  $pattern1 = "/^r_hla_[abdrqpc]+/";
  $pattern2 = "/^r_ua_[abdrqpc]+/";
  $pattern3 = "/^d_hla_[abdrqpc]+/";

  foreach($_POST as $key => $value){
    if(!is_array($value) || empty($value)) continue;

    if(preg_match($pattern1, $key)){
      if(empty($r_hla)){
        $r_hla = implode(', ', $value);
      }
      else{
        $r_hla = $r_hla . ', ' . implode(', ', $value);
      }
      
    }

    else if(preg_match($pattern2, $key)){
      if(empty($r_ua)){
        $r_ua = implode(',', $value);
      }
      else{
        $r_ua = $r_ua . ', ' . implode(', ', $value);
      }
    }

    else if(preg_match($pattern3, $key)){
      if(empty($d_hla)){
        $d_hla = implode(', ', $value);
      }
      else{
        $d_hla = $d_hla . ', ' . implode(', ', $value);
      }
    }

  }

  // assign NULL values for the fields omitted while filling the form
  //patient variables
  $r_id          = "'$r_id'";
  $r_name        = (!empty($r_name)) ? "'$r_name'" : "NULL";
  $r_sex         = (!empty($r_sex)) ? "'$r_sex'" : "NULL";
  $r_dob         = (!empty($r_dob)) ? "'$r_dob'" : "NULL";
  $r_height      = (!empty($r_height)) ? "'$r_height'" : "NULL";
  $r_weight      = (!empty($r_weight)) ? "'$r_weight'" : "NULL";
  $r_btype       = (!empty($r_btype)) ? "'$r_btype'" : "NULL"; 

  $r_address     = (!empty($r_address)) ? "'$r_address'" : "NULL";
  $r_cno         = (!empty($r_cno)) ? "'$r_cno'" : "NULL";
  $r_email       = (!empty($r_email)) ? "'$r_email'" : "NULL";

  $r_basicd      = (!empty($r_basicd)) ? "'$r_basicd'" : "NULL";
  $r_gr          = (!empty($r_gr)) ? "'$r_gr'" : "NULL";
  $r_comorb      = (!empty($r_comorb)) ? "'$r_comorb'" : "NULL";
  $r_hiv         = (!empty($r_hiv)) ? "'$r_hiv'" : "NULL";
  $r_hepb        = (!empty($r_hepb)) ? "'$r_hepb'" : "NULL";
  $r_hepc        = (!empty($r_hepc)) ? "'$r_hepc'" : "NULL";
  $r_prev_transp = (!empty($r_prev_transp)) ? "'$r_prev_transp'" : "NULL";
  $r_dialysis    = (!empty($r_dialysis)) ? "'$r_dialysis'" : "NULL";
  $r_ddp         = (!empty($r_ddp)) ? "'$r_ddp'" : "NULL";
  $r_nephro      = (!empty($r_nephro)) ? "'$r_nephro'" : "NULL";
  $r_dcenter     = (!empty($r_dcenter)) ? "'$r_dcenter'" : "NULL";
  $r_prov_clear  = (!empty($r_prov_clear)) ? "'$r_prov_clear'" : "NULL";
  $r_pre_transp  = (!empty($r_pre_transp)) ? "'$r_pre_transp'" : "NULL";
  $r_hla         = (!empty($r_hla)) ? "'$r_hla'" : "NULL";
  $r_ua          = (!empty($r_ua)) ? "'$r_ua'" : "NULL";

  //donor varaiables
  $d_id          = "'$d_id'";
  $d_name        = (!empty($d_name)) ? "'$d_name'" : "NULL";
  $d_sex         = (!empty($d_sex)) ? "'$d_sex'" : "NULL";
  $d_dob         = (!empty($d_dob)) ? "'$d_dob'" : "NULL";
  $d_height      = (!empty($d_height)) ? "'$d_height'" : "NULL";
  $d_weight      = (!empty($d_weight)) ? "'$d_weight'" : "NULL";
  $d_btype       = (!empty($d_btype)) ? "'$d_btype'" : "NULL";
  $d_rel         = (!empty($d_rel)) ? "'$d_rel'" : "NULL";

  $d_address     = (!empty($d_address)) ? "'$d_address'" : "NULL";
  $d_cno         = (!empty($d_cno)) ? "'$d_cno'" : "NULL";
  $d_email       = (!empty($d_email)) ? "'$d_email'" : "NULL";

  $d_comorb      = (!empty($d_comorb)) ? "'$d_comorb'" : "NULL";
  $d_hiv         = (!empty($d_hiv)) ? "'$d_hiv'" : "NULL";
  $d_hepb        = (!empty($d_hepb)) ? "'$d_hepb'" : "NULL";
  $d_hepc        = (!empty($d_hepc)) ? "'$d_hepc'" : "NULL";
  $d_hla         = (!empty($d_hla)) ? "'$d_hla'" : "NULL";
  $d_alcohol     = (!empty($d_alcohol)) ? "'$d_alcohol'" : "NULL";
  $d_smoking     = (!empty($d_smoking)) ? "'$d_smoking'" : "NULL";
  $d_prov_clear  = (!empty($d_prov_clear)) ? "'$d_prov_clear'" : "NULL";

  // ---------------------------------------------------------------------------------------------------

  // $a[] = $r_name; 
  // $a[] =  $r_sex;
  // $a[] =   $r_dob ;
  // $a[] =   $r_height;
  // $a[] =   $r_weight;
  // $a[] =   $r_btype; 
  // $a[] = $r_id;
  // $a[] =   $r_address;
  // $a[] =   $r_cno;
  // $a[] =   $r_email;

  // $a[] =   $r_basicd;
  // $a[] =   $r_gr;
  // $a[] =   $r_comorb;
  // $a[] =   $r_hiv;
  // $a[] =   $r_hepb;
  // $a[] =   $r_hepc;
  // $a[] =   $r_prev_transp;
  // $a[] =   $r_dialysis;
  // $a[] =   $r_ddp;
  // $a[] =   $r_nephro;
  // $a[] =   $r_dcenter;
  // $a[] =   $r_prov_clear;
  // $a[] =   $r_pre_transp;
  // $a[] =   $r_hla;
  // $a[] =   $r_ua;


  // $b[] = $d_name; 
  // $b[] =  $d_sex;
  // $b[] =   $d_dob ;
  // $b[] =   $d_height;
  // $b[] =   $d_weight;
  // $b[] =   $d_btype; 
  // $b[] =   $d_rel; 
  // $b[] = $d_id;
  // $b[] =   $d_address;
  // $b[] =   $d_cno;
  // $b[] =   $d_email;

  // $b[] =   $d_comorb;
  // $b[] =   $d_hiv;
  // $b[] =   $d_hepb;
  // $b[] =   $d_hepc;
  // $b[] =   $d_prov_clear;
  // $b[] =   $d_hla;
  // $b[] =   $d_alcohol;
  // $b[] =   $d_smoking;

  // print_r($_POST);
  // echo '<br>';
  // print_r($a);
  // echo '<br>';
  // print_r($b);

  // --------------------------------processing the image and report data-----------------------------------------------------

  // patient files
  $r_img = "NULL";
  if(!empty($_FILES['r_img']['name'])){
    $r_img = addslashes(file_get_contents($_FILES['r_img']['tmp_name']));
    $r_img = "'$r_img'";
  }
  $r_b_report = "NULL";
  if(!empty($_FILES['r_b-report']['name'])){
    $r_b_report = addslashes(file_get_contents($_FILES['r_b-report']['tmp_name']));
    $r_b_report = "'$r_b_report'";
  }
  $r_hla_report = "NULL";
  if(!empty($_FILES['r_hla-report']['name'])){
    $r_hla_report = addslashes(file_get_contents($_FILES['r_hla-report']['tmp_name']));
    $r_hla_report = "'$r_hla_report'";
  }
  $r_ua_report = "NULL";
  if(!empty($_FILES['r_ua-report']['name'])){
    $r_ua_report = addslashes(file_get_contents($_FILES['r_ua-report']['tmp_name']));
    $r_ua_report = "'$r_ua_report'";
  }

  // donor files
  $d_img = "NULL";
  if(!empty($_FILES['d_img']['name'])){
    $d_img = addslashes(file_get_contents($_FILES['d_img']['tmp_name']));
    $d_img = "'$d_img'";
  }
  $d_b_report = "NULL";
  if(!empty($_FILES['d_b-report']['name'])){
    $d_b_report = addslashes(file_get_contents($_FILES['d_b-report']['tmp_name']));
    $d_b_report = "'$d_b_report'";
  }
  $d_hla_report = "NULL";
  if(!empty($_FILES['d_hla-report']['name'])){
    $d_hla_report = addslashes(file_get_contents($_FILES['d_hla-report']['tmp_name']));
    $d_hla_report = "'$d_hla_report'";
  }

  // Inserting into the database

	//connecting to database
	include("../templates/db-connect.php");

	//creating sql queries
  $sql1 = "INSERT INTO patients (id, `name`, sex, dob, height, `weight`, blood_group, `address`, contact_number, email, hla_antigens, ua_antigens, basic_disease, gr_biopsy, comorb, hiv, hep_b, hep_c, prev_transp, dialysis, dd_program, prime_nephro, hospital, prov_clearance, pre_transp_surgery) VALUES ($r_id, $r_name, $r_sex, $r_dob, $r_height, $r_weight, $r_btype, $r_address, $r_cno, $r_email, $r_hla, $r_ua, $r_basicd, $r_gr, $r_comorb, $r_hiv, $r_hepb, $r_hepc, $r_prev_transp, $r_dialysis, $r_ddp, $r_nephro, $r_dcenter, $r_prov_clear, $r_pre_transp)";

  $sql2 = "INSERT INTO donors (id, `name`, sex, dob, height, `weight`, blood_group, relation, `address`, contact_number, email, hla_antigens, comorb, hiv, hep_b, hep_c, alcohol, smoking, prov_clearance) VALUES ($d_id,   $d_name, $d_sex, $d_dob, $d_height, $d_weight, $d_btype,$d_rel, $d_address, $d_cno, $d_email, $d_hla,  $d_comorb, $d_hiv, $d_hepb, $d_hepc, $d_alcohol, $d_smoking, $d_prov_clear)";
  
 
  $sql3 = "INSERT INTO patient_files (id, profile_pic, blood_report, hla_report, dsa_report) VALUES ($r_id, $r_img, $r_b_report, $r_hla_report, $r_ua_report)";

  $sql4 = "INSERT INTO donor_files (id, profile_pic, blood_report, hla_report) VALUES ($d_id, $d_img, $d_b_report, $d_hla_report)";

  $sql5 = "INSERT INTO pd_pairs (pair_id, patient_id, donor_id, hosp_id, `status`) VALUES ('$mid_id' ,$r_id, $d_id, \"NULL\", 'y')";

  session_start();
  $_SESSION['form'] = 'pd-form';

	if(!mysqli_query($conn, $sql1)){
    $status = 0;
		$statusMsg = 'patient query error ' . mysqli_error($conn);
  }
  
	else if(!mysqli_query($conn, $sql2)){
    $status = 0;
		$statusMsg = 'donor query error ' . mysqli_error($conn);
  }
  
	else if(!mysqli_query($conn, $sql3)){
    $status = 0;
		$statusMsg = 'patient_files query error ' . mysqli_error($conn);
  }
  
	else if(!mysqli_query($conn, $sql4)){
    $status = 0;
		$statusMsg = 'donor_files query error ' . mysqli_error($conn);
  }

	else if(!mysqli_query($conn, $sql5)){
    $status = 0;
		$statusMsg = 'pd_pairs ' . mysqli_error($conn);
  }
  
  else{
    $status = 1;
    $statusMsg = 'Your registration is successful!!!';
    $_SESSION['r_id'] = $r_id;
    $_SESSION['d_id'] = $d_id;
  }

  $_SESSION['status'] = $status;
  $_SESSION['msg'] = $statusMsg;

  header("Location: ./message.php");
}

