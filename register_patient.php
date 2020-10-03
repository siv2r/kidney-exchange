<?php

function random_strings($length_of_string)
{
	// String of all alphanumeric character
	$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

	// Shufle the $str_result and returns substring
	// of specified length
	return substr(str_shuffle($str_result), 0, $length_of_string);
}

// Array ( [r_fname] => Karthik [r_lname] => Kumar [r_age] => 45 [r_gender] => male [r_diab_type] => type2 [r_b_press] => 120/80 [r_btype] => A +ve [r_hla_a] => Array ( [0] => A-9 [1] => A-11 ) [r_hla_b] => Array ( [0] => B-5 [1] => B-8 ) [r_hla_c] => Array ( [0] => C-1 [1] => C-2 ) [r_hla_dr] => Array ( [0] => DR-15 ) [ua_a] => Array ( [0] => A-2 ) [ua_dr] => Array ( [0] => DR-12 ) [r_histcross] => -ve [d_fname] => Anand [d_lname] => Balaji [d_age] => 35 [d_gender] => male [d_b_press] => 110/90 [d_gfr] => 80 [d_diab_type] => none [d_btype] => AB +ve [d_hla_a] => Array ( [0] => A-11 ) [d_hla_b] => Array ( [0] => B-7 ) [d_hla_dr] => Array ( [0] => DR-14 ) [h_name] => Fortis Malar )

$registration = "";
$error = "";
$r_id = "";
$d_id = "";

if(!empty($_POST)){

	//id generation
	$mid_id = random_strings(5);
  $r_id = $_POST['h_name'] . '-' . $mid_id . '-' . 'p';
  $d_id = $_POST['h_name'] . '-' . $mid_id . '-' . 'd';

	//recipient info
	$r_name = $_POST['r_fname'] . ' ' . $_POST['r_lname'];
	$r_age = $_POST['r_age'];
	$r_gender = $_POST['r_gender'];
	$r_diab_type = $_POST['r_diab_type'];
	$r_b_press = $_POST['r_b_press'];
	$r_btype = $_POST['r_btype'];
  $r_histcross = $_POST['r_histcross'];
  
	//donor info
	$d_name = $_POST['d_fname'] . ' ' . $_POST['d_lname'];
	$d_age = $_POST['d_age'];
	$d_gender = $_POST['d_gender'];
	$d_b_press = $_POST['d_b_press'];
	$d_gfr= $_POST['d_gfr'];
	$d_diab_type= $_POST['d_diab_type'];
	$d_btype = $_POST['d_btype'];

  //getting the hla informatoin from $_POST
  $r_hla = '';
  $r_ua = '';
  $d_hla = '';
  $pattern1 = "/r_hla_[a-z0-9]+/";
  $pattern2 = "/ua_[a-z0-9]+/";
  $pattern3 = "/d_hla_[a-z0-9]+/";

  foreach($_POST as $key => $value){
    if(!is_array($value)) continue;

    if(preg_match($pattern1, $key)){
      if(empty($r_hla)){
        $r_hla = implode(',', $value);
      }
      else{
        $r_hla = $r_hla . ',' . implode(',', $value);
      }
      
    }

    if(preg_match($pattern2, $key)){
      if(empty($r_ua)){
        $r_ua = implode(',', $value);
      }
      else{
        $r_ua = $r_ua . ',' . implode(',', $value);
      }
    }

    if(preg_match($pattern3, $key)){
      if(empty($d_hla)){
        $d_hla = implode(',', $value);
      }
      else{
        $d_hla = $d_hla . ',' . implode(',', $value);
      }
    }

  }
  
	//connecting to database
	include("templates/db-connect.php");

	//creating sql queries
	$sql1 = "INSERT INTO recipients VALUES ('$r_id', '$r_name', '$r_age', '$r_gender', '$r_diab_type', '$r_b_press', '$r_btype', '$r_hla', '$r_ua', '$r_histcross' )";
	$sql2 = "INSERT INTO donors VALUES ('$d_id', '$d_name', '$d_age', '$d_gender', '$d_diab_type', '$d_gfr', '$d_b_press', '$d_btype', '$d_hla')";


	if(!mysqli_query($conn, $sql1))
	{
		$error = 'recipient query error' . mysqli_error($conn);
	}

	if(!mysqli_query($conn, $sql2))
	{
		$error = 'donor query error' . mysqli_error($conn);
	}

	$registration = "registration successful";

  $_POST = array();
}

?>


<!DOCTYPE html>

<html lang="en">

<style>

body{
	margin: 0;
	background-image: url("./images/register.jpg");
	opacity: 0.9;
  background-size: 300%;
}
#radio-gender {
    vertical-align: middle !important;
    padding-bottom: 18px;
}

#regForm {
	box-sizing: border-box;
	background-color: #ffff;
	border: 3px solid #f1f1f1;
	width: 60%;
	min-width: 300px;
	margin: auto;
	padding: 40px;
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
}

.tab{
  display: none;
  word-break: break-all;
}

option, select{
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
}


input[type="text"], input[type="number"], select{
	display: block;
	width: 30%;
	margin: 10px 0px;
	padding: 8px 12px;
  color: #333333;
  background-color: #eeeeee;
  border: 1px solid #dddddd;
  border-radius: 5%;
  cursor: pointer;
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  font-size: 18px;
}

input:focus, input:hover, select:focus, select:hover{
  outline: none;
  border: 1px solid #aaaaaa;
}

input[type="radio"]{
  background-color: #eeeeee;
  border: 1px solid #dddddd;
  border-radius: 5%;
  cursor: pointer;
}

legend{
  font-weight: bold;
  font-size: 20px;
}

h3{
  font-size: 26px;
  text-align: center;
}

#ua select, #r_hla select, #d_hla select{
  display: inline-block;
  margin: 12px;
}

label{
  box-sizing: border-box;
  display: inline-block;
  margin-top: 20px;
}

#regHeader{
	text-align: center;
}

#r_btype_label, #d_btype_label{
	display: block;
	margin-top: 10px;
	margin: 10px, 10px;
}

fieldset{
  padding: 0px 20px 20px 20px;
  margin: 20px;
}

button {
	background-color: darkgrey;
	color: black;
	padding: 10px 20px;
  display: inline-block;
  margin: 10px;
	border: none;
	cursor: pointer;
  width: 28%;
	font-size: 18px;
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
}

button:hover {
	opacity: 0.8;
}

#button_block{
  float: right;
  text-align: left;
  box-sizing: border-box;
  width: 35%;
  padding: 10px;

}

#reg_success{
  font-size: 22px;
  color: green;
  text-align: center;
  font-weight: bold;
}

#reg_fail{
  font-size: 22px;
  color: red;
  text-align: center;
  font-weight: bold;
}

input.invalid{
  background-color: #ffdddd;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: darkgrey;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.3;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: darkgrey;
}
</style>

<?php include("templates/header.php"); ?>


  <form action="#" method="POST" id="regForm">

  <?php if(!empty($registration) && empty($error)) { ?>
    <p id="reg_success">Registration successful!</p>
    <p id="reg_success"><?php echo "Recipient id : $r_id ";  ?></p>
    <p id="reg_success"><?php echo "Donor id : $d_id ";  ?></p>
  <?php } else if(!empty($error)) { ?>
    <p id="reg_fail">Registration failed!</p>
    <p id="reg_fail"><?php echo "$error";  ?></p>
  <?php }?>

	<h2 id="regHeader">Registration Form (Patient)</h2>

	<div class="tab">

	  <h3>Recipient Information:</h3>

    <fieldset>
    <legend>Personal Inforamtion</legend>
    <label for="r_fname">First Name:</label>
    <input type="text" id="r_fname" name="r_fname" value="" placeholder="e.g John">


    <label for="r_lname">Last Name:</label>
    <input type="text" id="r_lname" name="r_lname" value="" placeholder="e.g Smith">


    <label for="r_age">Age:</label>
    <input type="number" id="r_age" name="r_age" value="" placeholder="20">

    <label>Gender:</label>
    <div id="radio-gender">
    <input type="radio" id="r_male" name="r_gender" value="male">
    <label for="r_male">Male</label>
    <input type="radio" id="r_female" name="r_gender" value="female">
    <label for="r_female">Female</label>
    <input type="radio" id="r_other" name="r_gender" value="other">
    <label for="r_other">Other</label></div>

    <!-- <label>Place of residence:</label>
    <input type="text" name="r_addr1" value="" placeholder="e.g Address line 1">
    <input type="text" name="r_addr2" value="" placeholder="e.g Address line 2">
    <input type="text" name="r_district" value="" placeholder="e.g Chennai">
    <input type="text" name="r_state" value="" placeholder="e.g TamilNadu">
    <input type="number" name="r_pincode" value="" placeholder="e.g 600001">  -->


    </fieldset>



    
    <fieldset>

      <label for="r_diab_type">Diabetes Type:</label>
      <select name="r_diab_type" id="r_diab_type" >
        <option value="none">None</option>
        <option value="type1">Type 1</option>
        <option value="type2">Type 2</option>
        <option value="pre">Prediabetes</option>
        <option value="gestational">Gestational Diabetes</option>
      </select>

      <label for="r_b_press">Blood Pressure (in mmHg):</label>
      <input type="text" id="r_b_press" name="r_b_press" value="" placeholder="e.g 120/80">      

      <legend>Medical Information</legend>
      <label for="r_btype">Blood Type:</label>
      <select name="r_btype" >
        <option value="O +ve">O +ve</option>
        <option value="O -ve">O -ve</option>
        <option value="A +ve">A +ve</option>
        <option value="A -ve">A -ve</option>
        <option value="B +ve">B +ve</option>
        <option value="B -ve">B -ve</option>
        <option value="AB +ve">AB +ve</option>
        <option value="AB -ve">AB -ve</option>
      </select>

      <div id="r_hla">
        <label>HLA Antigens:</label> <br>
        <label for="r_hla_a[]">A :</label>
        <select name="r_hla_a[]" id="r_hla_a[]" multiple >
          <option value="A-1">1</option>
          <option value="A-2">2</option>
          <option value="A-3">3</option>
          <option value="A-9">9</option>
          <option value="A-10">10</option>
          <option value="A-11">11</option>
          <option value="A-19">19</option>
          <option value="A-23">23</option>
        </select>
        <label for="r_hla_b">B :</label>
        <select name="r_hla_b[]" id="r_hla_b" multiple >
          <option value="B-5">5</option>
          <option value="B-7">7</option>
          <option value="B-8">8</option>
          <option value="B-12">12</option>
          <option value="B-13">13</option>
          <option value="B-14">14</option>
          <option value="B-15">15</option>
          <option value="B-16">16</option>
        </select> <br> <!--NOTE: ------------------------break here-->
        <label for="r_hla_c">C :</label>
        <select name="r_hla_c[]" id="r_hla_c" multiple >
          <option value="C-1">1</option>
          <option value="C-2">2</option>
          <option value="C-3">3</option>
          <option value="C-4">4</option>
          <option value="C-5">5</option>
          <option value="C-6">6</option>
          <option value="C-7">7</option>
          <option value="C-8">8</option>
        </select>
        <label for="r_hla_dr">DR :</label>
        <select name="r_hla_dr[]" id="r_hla_dr" multiple >
          <option value="DR-10">10</option>
          <option value="DR-12">12</option>
          <option value="DR-14">14</option>
          <option value="DR-15">15</option>
          <option value="DR-16">16</option>
          <option value="DR-17">17</option>
          <option value="DR-18">18</option>
        </select> <br><!--NOTE: ------------------------break here-->
        <label for="r_hla_dqb1">DQB1 :</label>
        <select name="r_hla_dqb1[]" id="r_hla_dqb1" multiple >
          <option value="DQB1-1">1</option>
          <option value="DQB1-2">2</option>
          <option value="DQB1-3">3</option>
          <option value="DQB1-4">4</option>
          <option value="DQB1-5">5</option>
          <option value="DQB1-6">6</option>
          <option value="DQB1-7">7</option>
          <option value="DQB1-8">8</option>
        </select>
      </div>
      
      <div id="ua">
        <label>Unacceptable Anitgens:</label> <br>
        <label for="ua_a">A :</label>
        <select name="ua_a[]" id="ua_a" multiple class="chosen" >
          <option value="A-1">1</option>
          <option value="A-2">2</option>
          <option value="A-3">3</option>
          <option value="A-9">9</option>
          <option value="A-10">10</option>
          <option value="A-11">11</option>
          <option value="A-19">19</option>
          <option value="A-23">23</option>
        </select>
        <label for="ua_b">B :</label>
        <select name="ua_b[]" id="ua_b" multiple >
          <option value="B-5">5</option>
          <option value="B-7">7</option>
          <option value="B-8">8</option>
          <option value="B-12">12</option>
          <option value="B-13">13</option>
          <option value="B-14">14</option>
          <option value="B-15">15</option>
          <option value="B-16">16</option>
        </select> <br> <!--NOTE: ------------------------break here-->
        <label for="ua_c">C :</label>
        <select name="ua_c[]" id="ua_c" multiple >
          <option value="C-1">1</option>
          <option value="C-2">2</option>
          <option value="C-3">3</option>
          <option value="C-4">4</option>
          <option value="C-5">5</option>
          <option value="C-6">6</option>
          <option value="C-7">7</option>
          <option value="C-8">8</option>
        </select>
        <label for="ua_dr">DR :</label>
        <select name="ua_dr[]" id="ua_dr" multiple >
          <option value="DR-10">10</option>
          <option value="DR-12">12</option>
          <option value="DR-14">14</option>
          <option value="DR-15">15</option>
          <option value="DR-16">16</option>
          <option value="DR-17">17</option>
          <option value="DR-18">18</option>
        </select> <br> <!--NOTE: ------------------------break here-->
        <label for="ua_dqb1">DQB1 :</label>
        <select name="ua_dqb1[]" id="ua_dqb1" multiple >
          <option value="DQB1-1">1</option>
          <option value="DQB1-2">2</option>
          <option value="DQB1-3">3</option>
          <option value="DQB1-4">4</option>
          <option value="DQB1-5">5</option>
          <option value="DQB1-6">6</option>
          <option value="DQB1-7">7</option>
          <option value="DQB1-8">8</option>
        </select>
      </div>


      <label for="r_histcross">Historical crossmatch</label>
      <select name="r_histcross" id="r_histcross" >
        <option value="+ve">+ve</option>
        <option value="-ve">-ve</option>
      </select>
    </fieldset>

	</div>



	<div class="tab">

  <h3>Donor Information:</h3>
  
  <fieldset>
  <legend>Personal Information</legend>

	<label for="d_fname">First Name:</label>
	<input type="text" id="d_fname" name="d_fname" value="" placeholder="e.g John">


	<label for="d_lname">Last Name:</label>
	<input type="text" id="d_lname" name="d_lname" value="" placeholder="e.g Smith">


	<label for="d_age">Age:</label>
	<input type="number" id="d_age" name="d_age" value="" placeholder="20" >


	<label>Gender:</label>
	<input type="radio" id="d_male" name="d_gender" value="male" >
	<label for="d_male">Male</label>
	<input type="radio" id="d_female" name="d_gender" value="female">
	<label for="d_female">Female</label>
	<input type="radio" id="d_other" name="d_gender" value="other">
	<label for="d_other">Other</label>

	<!-- <label>Place of residence:</label>
	<input type="text" name="d_addr1" value="" placeholder="e.g Address line 1">
	<input type="text" name="d_addr2" value="" placeholder="e.g Address line 2">
	<input type="text" name="d_district" value="" placeholder="e.g Chennai">
	<input type="text" name="d_state" value="" placeholder="e.g TamilNadu">
  <input type="number" name="d_pincode" value="" placeholder="e.g 600001">  -->
  
  </fieldset>


  <fieldset>

  <legend>Medical Information</legend>


  <label for="d_b_press">Blood Pressure (in mmHg):</label>
  <input type="text" id="d_b_press" name="d_b_press" value="" placeholder="e.g 120/80"> 

  <label for="d_gfr">GFR (in ml/min per 1.73m<sup>2</sup>):</label>
  <input type="text" id="d_gfr" name="d_gfr" value="" placeholder="e.g 76"> 

  <label for="d_diab_type">Diabetes Type:</label>
	<select name="d_diab_type" id="d_diab_type" >
		<option value="none">None</option>
		<option value="type1">Type 1</option>
		<option value="type2">Type 2</option>
		<option value="pre">Prediabetes</option>
		<option value="gestational">Gestational Diabetes</option>
	</select>

	<label for="d_btype">Blood Type:</label>
	<select name="d_btype" id="d_btype" >
		<option value="O +ve">O +ve</option>
		<option value="O -ve">O -ve</option>
		<option value="A +ve">A +ve</option>
		<option value="A -ve">A -ve</option>
		<option value="B +ve">B +ve</option>
		<option value="B -ve">B -ve</option>
		<option value="AB +ve">AB +ve</option>
		<option value="AB -ve">AB -ve</option>
	</select>

  <div id="d_hla">
        <label>HLA Antigens:</label> <br>
        <label for="d_hla_a">A :</label>
        <select name="d_hla_a[]" id="d_hla_a" multiple >
          <option value="A-1">1</option>
          <option value="A-2">2</option>
          <option value="A-3">3</option>
          <option value="A-9">9</option>
          <option value="A-10">10</option>
          <option value="A-11">11</option>
          <option value="A-19">19</option>
          <option value="A-23">23</option>
        </select>
        <label for="d_hla_b">B :</label>
        <select name="d_hla_b[]" id="d_hla_b" multiple >
          <option value="B-5">5</option>
          <option value="B-7">7</option>
          <option value="B-8">8</option>
          <option value="B-12">12</option>
          <option value="B-13">13</option>
          <option value="B-14">14</option>
          <option value="B-15">15</option>
          <option value="B-16">16</option>
        </select> <br> <!--NOTE: ------------------------break here-->
        <label for="d_hla_c">C :</label>
        <select name="d_hla_c[]" id="d_hla_c" multiple >
          <option value="C-1">1</option>
          <option value="C-2">2</option>
          <option value="C-3">3</option>
          <option value="C-4">4</option>
          <option value="C-5">5</option>
          <option value="C-6">6</option>
          <option value="C-7">7</option>
          <option value="C-8">8</option>
        </select>
        <label for="d_hla_dr">DR :</label>
        <select name="d_hla_dr[]" id="d_hla_dr" multiple >
          <option value="DR-10">10</option>
          <option value="DR-12">12</option>
          <option value="DR-14">14</option>
          <option value="DR-15">15</option>
          <option value="DR-16">16</option>
          <option value="DR-17">17</option>
          <option value="DR-18">18</option>
        </select> <br> <!--NOTE: ------------------------break here-->
        <label for="d_hla_dqb1">DQB1 :</label>
        <select name="d_hla_dqb1[]" id="d_hla_dqb1" multiple >
          <option value="DQB1-1">1</option>
          <option value="DQB1-2">2</option>
          <option value="DQB1-3">3</option>
          <option value="DQB1-4">4</option>
          <option value="DQB1-5">5</option>
          <option value="DQB1-6">6</option>
          <option value="DQB1-7">7</option>
          <option value="DQB1-8">8</option>
        </select>
      </div>

  </div>
  
 </fieldset>



	<div class="tab">
		<h3>Hospital Information:</h3>

		<label for="hospital_name">Name:</label>
		<select id="hospital_name" name="h_name" >
				<option value="10000">Dr. Mehta</option>
				<option value="10005">Apollo</option>
				<option value="10003">Fortis Malar</option>
				<option value="10004">Dr. Kamakshi Memorial</option>
		</select>

  </div>

  <div  style="overflow: auto;">
    <div id="button_block">
      <button type="button" id="prevBtn">Previous</button>
      <button type="button" id="nextBtn">Next</button>
    </div>
  </div>

  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>
  
</form>

<script src="scripts/regForm.js"></script>



</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="scripts/validation.js"></script> 

</html>