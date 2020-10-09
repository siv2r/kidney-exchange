<?php 

function random_strings($length_of_string){

	$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

	// Shufle the $str_result and returns substring of specified length
	return substr(str_shuffle($str_result), 0, $length_of_string);
}

// --------------------------------------------create a message page to display the registraion result

/*------------------data format----------------------------------------------


Array ( [r_img] => card-with-images-data.png [r_fname] => Karthik [r_lname] => Kumar [r_sex] => male [r_dob] => 1987-09-23 [r_height] => 178.56 [r_weight] => 85 [r_bmi] => 26.66 [r_b-type] => A -ve [r_b-report] => card-with-images-data.png [r_addr1] => NEW NO.AP859, H-BLOCK GROUND FLOOR, 11TH MN RD, 2ND ST [r_addr2] => Anna nagar [r_city] => Chennai [r_state] => Tamilnadu [r_pincode] => 600040 [r_country] => India [r_cno] => 9883756673 [r_email] => anna42@gmail.com [r_hla_a] => Array ( [0] => A2 [1] => A203 ) [r_hla_b] => Array ( [0] => [1] => ) [r_hla_dr] => Array ( [0] => [1] => ) [r_hla-report] => card-with-images-data.png [r_ua_a] => Array ( [0] => A1 [1] => A203 ) [r_ua_b] => Array ( [0] => ) [r_ua_dr] => Array ( [0] => ) [r_ua-report] => card-with-images-data.png [r_b-disease] => flu, cold [r_gr-biopsy] => [r_comorb] => Array ( [0] => Type1 DM [1] => Type2 DM [2] => Others ) [r_comorb-others] => comorb others [r_hiv] => negative [r_hepB] => positive [r_hepC] => negative [r_prev-transp] => yes [r_dot] => 2015-09-23 [r_mod] => hemodialysis [r_dod] => 2015-08-23 [r_vs-access] => AV graft [r_ddp] => yes [r_ddp-regno] => 802385034 [r_p-nephro] => John Doe [r_d-center] => Mehta [r_prov-clear] => yes [r_pre-transp] => yes [pre-transp-specify] => pre transp specify

[d_fname] => Anand [d_lname] => Balaji [d_sex] => on [d_dob] => 1990-09-23 [d_height] => 159 [d_weight] => 78.54 [d_bmi] => 31.07 [d_b-type] => A +ve [d_b-report] => card-with-images-data.png [d_rel-donor] => Son [d_addr1] => NEW NO.AP859, H-BLOCK GROUND FLOOR, 11TH MN RD, 2ND ST [d_addr2] => Anna nagar [d_city] => Chennai [d_state] => Tamilnadu [d_pincode] => 600040 [d_country] => India [d_cno] => 9882749983 [d_email] => tambhi42@gmail.com [d_hla_a] => Array ( [0] => A1 [1] => A9 ) [d_hla_b] => Array ( [0] => [1] => ) [d_hla_dr] => Array ( [0] => [1] => ) [d_hla-report] => card-with-images-data.png [d_comorb] => Array ( [0] => Type1 DM [1] => Type2 DM [2] => Others ) [d_comorb-others] => donor comorb others [d_hiv] => on [d_hepB] => on [d_hepC] => on [d_alcohol] => yes [d_smoking] => yes [d_prov-clear] => yes )



----------------------------------------------------------------------------*/

if(!empty($_POST)){

  print_r($_POST);

  echo '<br>' . '<br>' . '<br>';

  var_dump($_POST);
}

?>