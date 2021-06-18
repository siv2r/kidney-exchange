<!DOCTYPE html>
<html lang="en">

<!-- <link rel="stylesheet" href="../css/styles.css"> -->
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kidney Exchange Program</title>
  <!-- adding jQuery, select2 plugin and custom script file -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/additional-methods.min.js"></script>
  <script src="../js/reg-form.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
@import url(https://fonts.googleapis.com/css?family=Open+Sans);

* {
  font-family:"Open Sans";
  margin: 0%;
  box-sizing: border-box;
}


.header-img{
  background-image: url(../images/darkBackground.jpg);
  background-size: cover;
  background-position: top;
  position: relative;
  min-height: 400px;
}

</style>

<link rel="stylesheet" href="../css/form-style.css">
<link rel="stylesheet" href="../css/backToTop.css">

</head>


<body>
<!-- Back to top button -->
<a id="button" style="text-decoration:none"></a>


  <div class="header-img">
      <?php include "../templates/navBar.php";?>
    <h2 id="pd-heading" class="text-center mt-5 py-5">Registration form</h2>
  </div>

  <div class="container col-lg-8 col-sm-12 registrationform px-0">
    <form action="./form-process.php" method="post" id="reg-form" enctype="multipart/form-data" class="px-0">

      <div class='tab'>

        <div class="input-field">
        <div class="heading-box">
          <h3 class="text-center">Patient details</h3>
        </div>

        <div class="pass-img-box">
          <label for="r_img">
            <img id="r-pass-img" src="../images/blank-avatar.png">
          </label>
          <input type="file" id="r_img" name="r_img" class="requiredField">
        </div>
       </div>

        <fieldset>
          <legend><h3 class="text-center">Personal Information</h3></legend>

          <div class='input-field'>
            <div class="label-box">
              <label>Name</label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="text" name="r_fname" value="" class="single requiredField" placeholder="First Name">
              <input type="text" name="r_lname" value="" class="single requiredField" placeholder="Last Name">
            </div >
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label>Sex  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="radio" id='male' name='r_sex' value="Male">
              <label for="male">Male</label>
              <input type="radio" id='female' name='r_sex' value="Female">
              <label for="female">Female</label>
              <input type="radio" id='other' name='r_sex' value="Other">
              <label for="other">Other</label>
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="r_dob">Date of Birth  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="date" id="r_dob" name="r_dob" value="" class="requiredField single" min="1951-01-01">
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label>Height (cms)  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="number" name="r_height" id="r_height" value="" class="requiredField single">
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label>Weight (kgs)  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="number" name="r_weight" id="r_weight" value="" class="requiredField single">
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label>BMI (kg/m<sup>2</sup>)  </label>
            </div>
            <div class="input-box">
              <input type="number" name="r_bmi" id="r_bmi" value="" class="single" readonly>
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="btype">Blood group  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <select id="r_b-type" name="r_b-type" class="requiredField single">
                <option value="" disabled selected>Choose</option>
                <option value="O +ve">O +ve</option>
                <option value="O -ve">O -ve</option>
                <option value="A +ve">A +ve</option>
                <option value="A -ve">A -ve</option>
                <option value="B +ve">B +ve</option>
                <option value="B -ve">B -ve</option>
                <option value="AB +ve">AB +ve</option>
                <option value="AB -ve">AB -ve</option>
              </select>
            </div>
          </div>

          <div class="input-field">
            <div class="label-box">
              <label for="blood-report">Blood report  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="file" id="blood-report" name="r_b-report" value="" class="requiredField single">
            </div>
          </div>

        </fieldset>



        <fieldset>
          <legend>Contact Information</legend>

          <div class='input-field addr'>
            <div class="label-box">
              <label>Address  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="text" id="r_addr1" name="r_addr1" value="" placeholder="e.g Address line 1" class="requiredField single">
              <input type="text" id="r_addr2" name="r_addr2" value="" placeholder="e.g Address line 2" class="requiredField single">
              <input type="text" id="r_city" name="r_city" value="" placeholder="e.g Chennai" class="requiredField single">
              <input type="text" id="r_state" name="r_state" value="" placeholder="e.g TamilNadu" class="requiredField single">
              <input type="number" id="r_pincode" name="r_pincode" value="" placeholder="e.g 600001" class="requiredField single">
              <input type="text" id="r_country" name="r_country" value="" placeholder="e.g India" class="requiredField single">
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label>Contact number  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="number" name="r_cno" value="" class="requiredField single">
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label>Email address  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="email" name="r_email" value="" class="requiredField single">
            </div>
          </div>

        </fieldset>

        <fieldset>

          <legend>Medical Information</legend>

          <?php include "../templates/r_hla.php";?>

          <div class='input-field'>
            <div class="label-box">
              <label>Basic disease  </lable>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="text" name="r_b-disease" value="" class="requiredField single">
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label>Genetics/renal biopsy (if any)  </label>
            </div>
            <div class="input-box">
              <input type="text" name="r_gr-biopsy" class="single">
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="comorb">Comorbid conditions  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <select class="beautify requiredField single" id="comorb" name="r_comorb[]" multiple>
                <option value="None">None</option>
                <option value="Type1 DM">Type1 DM</option>
                <option value="Type2 DM">Type2 DM</option>
                <option value="Hypertension">Hypertension</option>
                <option value="Coronary artery disease">Coronary Artery Disease</option>
                <option value="Chronic liver disease">Chronic liver disease</option>
                <option value="Chronic obstructive pulmonary disease">Chronic Obstructive Pulmonary disease</option>
                <option value="Cancer">Cancer</option>
                <option value="Others">Others</option>
              </select>
            </div>
          </div>

          <div class='input-field' id='comorb-others'>     <!--   If others is selected in comorb field -->
            <div class="label-box">
              <label>Others  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="text" name="r_comorb-others" value="" class="requiredField single">
            </div>
          </div>

          <label id="serology">Serology status for viral disease </label>

          <div class='input-field'>
            <div class="label-box">
              <label>HIV </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="radio" id='hiv-p' name='r_hiv' value="Positive">
              <label for="hiv-p">Positive</label>
              <input type="radio" id='hiv-n' name='r_hiv' value="Negative">
              <label for="hiv-n">Negative</label>
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="r_hepB">Hepatitis B </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="radio" id='r_hepBP' name='r_hepB' value="Positive">
              <label for="r_hepBP">Positive</label>
              <input type="radio" id='r_hepBN' name='r_hepB' value="Negative">
              <label for="r_hepBN">Negative</label>
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="r_hepC">Hepatitis C </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="radio" id='r_hepCP' name='r_hepC' value="Positive">
              <label for="r_hepCP">Positive</label>
              <input type="radio" id='r_hepCN' name='r_hepC' value="Negative">
              <label for="r_hepCN">Negative</label>
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="prev-transp">Previous Transplant  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <select id="prev-transp" name="r_prev-transp" class="requiredField single">
                <option value="" selected disabled>Choose</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
          </div>

          <div class='input-field' id='dot'>
            <div class="label-box">
              <label>Date of Transplant  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="date" name="r_dot" value="" class="requiredField single">
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label>Mode of Dialysis  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <select id="mode-of-dialysis" name="r_mod" class="requiredField single">
                <option value="" selected disabled>Choose</option>
                <option value="Hemodialysis">Hemodialysis</option>
                <option value="Peritoneal dialysis">Peritoneal dialysis</option>
                <option value="No dialysis">No dialysis</option>
              </select>
            </div>
          </div>

          <div class='input-field' id="date-of-dialysis">
            <div class="label-box">
              <label>Date of start of dialysis  </label>
              <label class="required">* </label>
            </div> <!--   For hemodialysis and peritoneal dialysis -->
            <div class="input-box">
              <input type="date" name="r_dod" value="" class="requiredField single">
            </div>
          </div>

          <div class='input-field' id="vascular-access">
            <div class="label-box">
              <label>Vascualar access  </label>
              <label class="required">* </label>
            </div>  <!--   For hemodialysis only -->
            <div class="input-box">
              <select name="r_vs-access" class="requiredField single">
                <option value="" selected disabled>Choose</option>
                <option value="AV fistula">AV fistula</option>
                <option value="AV graft">AV graft</option>
                <option value="Tunelled catheter">Tunelled catheter</option>
                <option value="Temporary catheter">Temporary catheter</option>
              </select>
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label>Registered in Deceased Donor Program  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <select id="ddp" name="r_ddp" class="requiredField single">
                <option value="" selected disabled>Choose</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
          </div>

          <div class='input-field' id="ddp-regno">
            <div class="label-box">
              <label for="ddp-regno">Registraion number  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="text" id="r_ddp-regno" name="r_ddp-regno" value="" class="requiredField single">
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="prime-nephro">Primary Nephrologist  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="text" id="prime-nephro" name="r_p-nephro" value="" class="requiredField single">
            </div>
          </div>

          <!-- <div class='input-field'>
            <div class="label-box">
              <label for="dialysis-center">Dialysis center or Hospital  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="text" id="dialysis-center" name="r_d-center" value="" class="requiredField single">
            </div>
          </div> -->

          <div class='input-field'>
            <div class="label-box">
              <label for="dialysis-center">Dialysis center or Hospital  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <select name="r_d-center" class="requiredField single">
                <?php

require_once "../db-connect.php";
require_once "../include/functions.inc.php";

if ($_SESSION['userType'] === "Transplant coordinator") {
  $val = $_SESSION['userHospital']['id'];
  $name = $_SESSION['userHospital']['name'];
  echo "<option value='$val' selected >$name</option>";
} else if ($_SESSION['userType'] === "Admin") {
  if ($hosp_array = getHospitals($conn)) {
    echo "<option value='' selected disabled>Choose</option>";
    foreach ($hosp_array as $key => $value) {
      $optionVal = $value['id'];
      $optionName = $value['name'];
      echo "<option value='$optionVal'>$optionName</option>";
    }
  } else {
    echo "Error in getting hospitals from the database";
  }
}

?>
              </select>
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="prov-clear">Provisional clearance by primary nephrologist  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <select id="prov-clear" name="r_prov-clear" class="requiredField single">
                <option value="" selected disabled>Choose</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label>Any pre transplant procedures/surgery planned </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <select id="pre-transp" name="r_pre-transp" class="requiredField single">
                <option value="" selected disabled>Choose</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
          </div>

          <div class='input-field' id='pre-transp-specify'>     <!--   If yes is selected in pre-transp-surg field -->
            <div class="label-box">
              <label>Please specify </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="text" name="pre-transp-specify" value="" class="requiredField single">
            </div>
          </div>

        </fieldset>
      </div>

      <div class='tab'>

        <div class="input-field">
            <div class="heading-box">
              <h3>Donor details</h3>
            </div>

            <div class="pass-img-box">
              <label for="d_img">
                <img id="d-pass-img" src="../images/blank-avatar.png">
              </label>
              <input type="file" id="d_img" name="d_img" class="requiredField">
            </div>
        </div>

        <fieldset>
          <legend>Personal Information</legend>

          <div class='input-field'>
            <div class="label-box">
              <label>Name  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="text" name="d_fname" value="" class="double requiredField">
              <input type="text" name="d_lname" value="" class="double requiredField">
            </div >
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label>Sex  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="radio" id='male' name='d_sex' value="Male">
              <label for="male">Male</label>
              <input type="radio" id='female' name='d_sex' value="Female">
              <label for="female">Female</label>
              <input type="radio" id='other' name='d_sex' value="Other">
              <label for="other">Other</label>
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="d_dob">Date of Birth  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="date" id="d_dob" name="d_dob" value="" class="requiredField single" min="1951-01-01">
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="d_height">Height (cms)  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="number" name="d_height" id="d_height" value="" class="requiredField single">
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="d_weight">Weight (kgs)  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="number" name="d_weight" id="d_weight" value="" class="requiredField single">
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="d_bmi">BMI (kg/m<sup>2</sup>)  </label>
            </div>
            <div class="input-box">
              <input type="number" name="d_bmi" id="d_bmi" class="single" readonly>
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="d_b-type">Blood group  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <select id="d_b-type" name="d_b-type" class="requiredField single">
                <option value="" disabled selected>Choose</option>
                <option value="O +ve">O +ve</option>
                <option value="O -ve">O -ve</option>
                <option value="A +ve">A +ve</option>
                <option value="A -ve">A -ve</option>
                <option value="B +ve">B +ve</option>
                <option value="B -ve">B -ve</option>
                <option value="AB +ve">AB +ve</option>
                <option value="AB -ve">AB -ve</option>
              </select>
            </div>
          </div>

          <div class="input-field">
            <div class="label-box">
              <label for="d_b-report">Blood report  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="file" id="d_b-report" name="d_b-report" class="requiredField single">
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="d_rel-donor">Relation to donor  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <select id="d_rel-donor" name="d_rel" class="requiredField single">
                <option value="" selected disabled>Choose</option>
                <option value="Father">Father</option>
                <option value="Mother">Mother</option>
                <option value="Spouse">Spouse</option>
                <option value="Son">Son</option>
                <option value="Daughter">Daughter</option>
                <option value="Brother">Brother</option>
                <option value="Sister">Sister</option>
                <option value="Paternal grandmother">Paternal grandmother</option>
                <option value="Paternal grandfather">Paternal grandfather</option>
                <option value="Maternal grandmother">Maternal grandmother</option>
                <option value="Maternal grandfather">Maternal grandfather</option>
              </select>
            </div>
          </div>

        </fieldset>



        <fieldset>
          <legend>Contact Information</legend>

          <div class='input-field'>
            <div class="label-box">
              <label>Address  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="text" id="d_addr1" name="d_addr1" value=""  placeholder="e.g Address line 1" class="requiredField single">
              <input type="text" id="d_addr2" name="d_addr2" value=""  placeholder="e.g Address line 2" class="requiredField single">
              <input type="text" id="d_city" name="d_city"  value="" placeholder="e.g Chennai" class="requiredField double">
              <input type="text" id="d_state" name="d_state" value=""  placeholder="e.g TamilNadu" class="requiredField double">
              <input type="number" id="d_pincode" name="d_pincode" value="" placeholder="e.g 600001" class="requiredField double">
              <input type="text" id="d_country" name="d_country" value="" placeholder="e.g India" class="requiredField double">
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label>Contact number  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="number" name="d_cno" value="" class="requiredField single">
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label>Email address  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="email" name="d_email" value="" class="requiredField single">
            </div>
          </div>

        </fieldset>

        <fieldset>

          <legend>Medical Information</legend>

          <?php include "../templates/d_hla.php";?>

          <div class='input-field'>
            <div class="label-box">
              <label for="d_comorb">Pre-existing illness  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <select class="beautify requiredField single" id="comorb2" name="d_comorb[]" multiple>
                <option value="None">None</option>
                <option value="Type1 DM">Type1 DM</option>
                <option value="Type2 DM">Type2 DM</option>
                <option value="Hypertension">Hypertension</option>
                <option value="Coronary artery disease">Coronary Artery Disease</option>
                <option value="Chronic liver disease">Chronic liver disease</option>
                <option value="Chronic obstructive pulmonary disease">Chronic Obstructive Pulmonary disease</option>
                <option value="Cancer">Cancer</option>
                <option value="Others">Others</option>
              </select>
            </div>
          </div>

          <div class='input-field' id='comorb-others2'>     <!--   If others is selected in comorb field -->
              <div class="label-box">
                <label>Others  </label>
                <label class="required">* </label>
              </div>
              <div class="input-box">
                <input type="text" class="requredField single" name="d_comorb-others">
              </div>
          </div>

          <label id="serology">Serology status for viral disease </label>

          <div class='input-field'>
            <div class="label-box">
              <label>HIV </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="radio" id='d_hiv-p' name='d_hiv' value="Positive">
              <label for="d_hiv-p">Positive</label>
              <input type="radio" id='d_hiv-n' name='d_hiv' value="Negative">
              <label for="d_hiv-n">Negative</label>
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="d_hepB">Hepatitis B </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="radio" id='d_hepBP' name='d_hepB' value="Positive">
              <label for="d_hepBP">Positive</label>
              <input type="radio" id='d_hepBN' name='d_hepB' value="Negative">
              <label for="d_hepBN">Negative</label>
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="d_hepC">Hepatitis C </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="radio" id='d_hepCP' name='d_hepC' value="Positive">
              <laCel for="d_hepCP">Positive</laCel>
              <input type="radio" id='d_hepCN' name='d_hepC' value="Negative">
              <label for="d_hepCN">Negative</label>
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="d_alcohol">Alcohol intake  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <select id="d_alcohol" name="d_alcohol" class="requiredField single">
                <option value="" selected disabled>Choose</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="d_smoking">Smoking  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <select id="d_smoking" name="d_smoking" class="requiredField single">
                <option value="" selected disabled>Choose</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="d_prov-clear">Provisional clearance by primary nephrologist  </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <select id="d_prov-clear" name="d_prov-clear" class="requiredField single">
                <option value="" selected disabled>Choose</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
          </div>

        </fieldset>
      </div>

      <div id='btn-block'>
        <button type="button" style="width: auto;" id='prev-btn'>Previous</button>
        <button type="button" style="width: auto;" id='next-btn'>Next</button>
      </div>

    </form>
  </div>
<script src="../js/backToTop.js"></script>
<?php

require_once "../include/footer.inc.php";
