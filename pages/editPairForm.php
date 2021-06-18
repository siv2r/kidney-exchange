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
  <script src="../js/editPairForm.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/backToTop.css">
</head>

<style>
  @import url(https://fonts.googleapis.com/css?family=Open+Sans);

  * {
    font-family: "Open Sans";
    margin: 0%;
    box-sizing: border-box;
  }

  

  .header-img {
    /* background-image: url("https://images.unsplash.com/photo-1502485019198-a625bd53ceb7?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80");  */
    background-image: url(../images/darkBackground.jpg);
    background-size: cover;
    background-position: top;
    position: relative;
    min-height: 400px;
  }
  #pd-heading
  {
    margin-top: 20vh !important;
  }
  @media screen and (max-width: 992px) {
    #next-btn, #prev-btn
  {
    padding:14px 10px !important;
    width:40% !important;
  }
  #reg-form
  {
    padding: 20px 10px !important;
  }
  
  .label-box{
  flex: 2.5 0 0;
  text-align: left;
  padding: 5px 10px;
  font-size: 22px;
  line-height: 1.6em;
}
#d-pass-img{
  margin:0 auto !important;
}
}

</style>

<link rel="stylesheet" href="../css/form-style.css">

<?php

if (isset($_GET['pair_id'])) {

  $patient_id = $_GET['pair_id'] . '-p';
  $donor_id = $_GET['pair_id'] . '-d';

  require_once "../include/getPairData.inc.php"; //creates and assigns values for the variables
} else {
  header("location: ../pages/dataOverview.php");
}

?>

<body>
<!-- Back to top button -->
<a id="button" style="text-decoration:none"></a>

  <div class="header-img">
    <div class="nav-container">
      <?php include "../templates/navBar.php";?>
    </div>
    <h2 id="pd-heading" class="text-center mt-5">Edit pd pair form</h2>
  </div>

  <div class="container col-lg-8 col-sm-12 registrationform px-0">
    <form action="../include/updatePair.inc.php" method="post" id="reg-form" enctype="multipart/form-data">

      <input type="text" name="r_id" value="<?php echo $patient_id; ?>" hidden>
      <input type="text" name="d_id" value="<?php echo $donor_id; ?>" hidden>

      <div class='tab'>

        <div class="input-field">
          <div class="heading-box">
            <h3 class="text-center">Patient details</h3>
          </div>

          <div class="pass-img-box">
            <label for="r_img">
              <img id="r-pass-img" src="../images/blank-avatar.png">
            </label>
            <input type="file" id="r_img" name="r_img">
          </div>
        </div>

        <fieldset>
          <legend>Personal Information</legend>

          <div class='input-field'>
            <div class="label-box">
              <label>Name</label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="text" name="r_fname" value="<?php echo $rNameArray[0]; ?>" class="single requiredField">
              <input type="text" name="r_lname" value="<?php echo $rNameArray[1]; ?>" class="single requiredField">
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label>Sex </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="radio" id='male' name='r_sex' value="Male" <?php if ($rSex == 'Male') {
  echo "checked";
}
?>>
              <label for="male">Male</label>
              <input type="radio" id='female' name='r_sex' value="Female" <?php if ($rSex == 'Female') {
  echo "checked";
}
?>>
              <label for="female">Female</label>
              <input type="radio" id='Other' name='r_sex' value="Other" <?php if ($rSex == 'Other') {
  echo "checked";
}
?>>
              <label for="Other">Other</label>
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="r_dob">Date of Birth </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="date" id="r_dob" name="r_dob" value="<?php echo $rDOB; ?>" class="requiredField single">
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label>Height (cms) </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="number" name="r_height" id="r_height" value="<?php echo $rHeight; ?>" class="requiredField single">
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label>Weight (kgs) </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="number" name="r_weight" id="r_weight" value="<?php echo $rWeight; ?>" class="requiredField single">
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label>BMI (kg/m<sup>2</sup>) </label>
            </div>
            <div class="input-box">
              <input type="number" name="r_bmi" id="r_bmi" value="<?php echo $rBMI; ?>" class="single" readonly>
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="btype">Blood group </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <select id="r_b-type" name="r_b-type" class="requiredField single">
                <option value="" disabled selected>Choose</option>
                <option value="O +ve" <?php if ($rBloodGroup == "O +ve") {
  echo "selected";
}
?>>O +ve</option>
                <option value="O -ve" <?php if ($rBloodGroup == "O -ve") {
  echo "selected";
}
?>>O -ve</option>
                <option value="A +ve" <?php if ($rBloodGroup == "A +ve") {
  echo "selected";
}
?>>A +ve</option>
                <option value="A -ve" <?php if ($rBloodGroup == "A -ve") {
  echo "selected";
}
?>>A -ve</option>
                <option value="B +ve" <?php if ($rBloodGroup == "B +ve") {
  echo "selected";
}
?>>B +ve</option>
                <option value="B -ve" <?php if ($rBloodGroup == "B -ve") {
  echo "selected";
}
?>>B -ve</option>
                <option value="AB +ve" <?php if ($rBloodGroup == "AB +ve") {
  echo "selected";
}
?>>AB +ve</option>
                <option value="AB -ve" <?php if ($rBloodGroup == "AB -ve") {
  echo "selected";
}
?>>AB -ve</option>
              </select>
            </div>
          </div>

          <div class="input-field">
            <div class="label-box">
              <label for="blood-report">Blood report </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="file" id="blood-report" name="r_b-report" value="" class="single">
            </div>
          </div>

        </fieldset>



        <fieldset>
          <legend>Contact Information</legend>

          <div class='input-field addr'>
            <div class="label-box">
              <label>Address </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="text" id="r_addr1" name="r_addr1" value="<?php echo $rAddressArray[0]; ?>" placeholder="e.g Address line 1" class="requiredField single">
              <input type="text" id="r_addr2" name="r_addr2" value="<?php echo $rAddressArray[1]; ?>" placeholder="e.g Address line 2" class="requiredField single">
              <input type="text" id="r_city" name="r_city" value="<?php echo $rAddressArray[2]; ?>" placeholder="e.g Chennai" class="requiredField double">
              <input type="text" id="r_state" name="r_state" value="<?php echo $rAddressArray[3]; ?>" placeholder="e.g TamilNadu" class="requiredField double">
              <input type="number" id="r_pincode" name="r_pincode" value="<?php echo $rAddressArray[4]; ?>" placeholder="e.g 600001" class="requiredField double">
              <input type="text" id="r_country" name="r_country" value="<?php echo $rAddressArray[5]; ?>" placeholder="e.g India" class="requiredField double">
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label>Contact number </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="number" name="r_cno" value="<?php echo $rCno; ?>" class="requiredField single">
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label>Email address </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="email" name="r_email" value="<?php echo $rEmail; ?>" class="requiredField single">
            </div>
          </div>

        </fieldset>

        <fieldset>

          <legend>Medical Information</legend>

          <?php include "../templates/edit_rHla.php";?>

          <div class='input-field'>
            <div class="label-box">
              <label>Basic disease </lable>
                <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="text" name="r_b-disease" value="<?php echo $rBasicDisease; ?>" class="requiredField single">
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label>Genetics/renal biopsy (if any) </label>
            </div>
            <div class="input-box">
              <input type="text" name="r_gr-biopsy" value="<?php echo $rBiopsy; ?>" class="single">
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="comorb">Comorbid conditions </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <select class="beautify requiredField single" id="comorb" name="r_comorb[]" multiple>
                <?php foreach ($ComorbValues as $val): ?>
                  <option value="<?php echo $val; ?>" <?php if (in_array($val, $rComorbArray)) {
  echo "selected";
}
?>><?php echo $val; ?></option>
                <?php endforeach;?>
              </select>
            </div>
          </div>

          <div class='input-field' id='comorb-others'>
            <!--   If others is selected in comorb field -->
            <div class="label-box">
              <label>Others </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="text" name="r_comorb-others" value="<?php echo $rComorbOthers; ?>" class="requiredField single">
            </div>
          </div>

          <label id="serology">Serology stautus for viral disease </label>

          <div class='input-field'>
            <div class="label-box">
              <label>HIV </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="radio" id='hiv-p' name='r_hiv' value="Positive" <?php if ($rHiv == "Positive") {
  echo "checked";
}
?>>
              <label for="hiv-p">Positive</label>
              <input type="radio" id='hiv-n' name='r_hiv' value="Negative" <?php if ($rHiv == "Negative") {
  echo "checked";
}
?>>
              <label for="hiv-n">Negative</label>
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="r_hepB">Hepatitis B </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="radio" id='r_hepBP' name='r_hepB' value="Positive" <?php if ($rHepB == "Positive") {
  echo "checked";
}
?>>
              <label for="r_hepBP">Positive</label>
              <input type="radio" id='r_hepBN' name='r_hepB' value="Negative" <?php if ($rHepB == "Negative") {
  echo "checked";
}
?>>
              <label for="r_hepBN">Negative</label>
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="r_hepC">Hepatitis C </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="radio" id='r_hepCP' name='r_hepC' value="Positive" <?php if ($rHepC == "Positive") {
  echo "checked";
}
?>>
              <label for="r_hepCP">Positive</label>
              <input type="radio" id='r_hepCN' name='r_hepC' value="Negative" <?php if ($rHepC == "Negative") {
  echo "checked";
}
?>>
              <label for="r_hepCN">Negative</label>
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="prev-transp">Previous Transplant </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <select id="prev-transp" name="r_prev-transp" class="requiredField single">
                <option value="" selected disabled>Choose</option>
                <option value="Yes" <?php if ($rPrevTransp[0] == "Yes") {
  echo "selected";
}
?>>Yes</option>
                <option value="No" <?php if ($rPrevTransp[0] == "No") {
  echo "selected";
}
?>>No</option>
              </select>
            </div>
          </div>

          <div class='input-field' id='dot'>
            <div class="label-box">
              <label>Date of Transplant </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="date" name="r_dot" value="<?php echo $rPrevTransp[1]; ?>" class="requiredField single">
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label>Mode of Dialysis </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <select id="mode-of-dialysis" name="r_mod" class="requiredField single">
                <option value="" selected disabled>Choose</option>
                <option value="Hemodialysis" <?php if ($rDialysis[0] == "Hemodialysis") {
  echo "selected";
}
?>>Hemodialysis</option>
                <option value="Peritoneal dialysis" <?php if ($rDialysis[0] == "Peritoneal dialysis") {
  echo "selected";
}
?>>Peritoneal dialysis</option>
                <option value="No dialysis" <?php if ($rDialysis[0] == "No dialysis") {
  echo "selected";
}
?>>No dialysis</option>
              </select>
            </div>
          </div>

          <div class='input-field' id="date-of-dialysis">
            <div class="label-box">
              <label>Date of start of dialysis </label>
              <label class="required">* </label>
            </div> <!--   For hemodialysis and peritoneal dialysis -->
            <div class="input-box">
              <input type="date" name="r_dod" value="<?php echo $rDialysis[1]; ?>" class="requiredField single">
            </div>
          </div>

          <div class='input-field' id="vascular-access">
            <div class="label-box">
              <label>Vascualar access </label>
              <label class="required">* </label>
            </div> <!--   For hemodialysis only -->
            <div class="input-box">
              <select name="r_vs-access" class="requiredField single">
                <option value="" selected disabled>Choose</option>
                <option value="AV fistula" <?php if ($rDialysis[2] == "AV fistula") {
  echo "selected";
}
?>>AV fistula</option>
                <option value="AV graft" <?php if ($rDialysis[2] == "AV graft") {
  echo "selected";
}
?>>AV graft</option>
                <option value="Tunelled catheter" <?php if ($rDialysis[2] == "Tunelled catheter") {
  echo "selected";
}
?>>Tunelled catheter</option>
                <option value="Temporary catheter" <?php if ($rDialysis[2] == "Temporary catheter") {
  echo "selected";
}
?>>Temporary catheter</option>
              </select>
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label>Registered in Deceased Donor Program </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <select id="ddp" name="r_ddp" class="requiredField single">
                <option value="" selected disabled>Choose</option>
                <option value="Yes" <?php if ($rDDP[0] == "Yes") {
  echo "selected";
}
?>>Yes</option>
                <option value="No" <?php if ($rDDP[0] == "No") {
  echo "selected";
}
?>>No</option>
              </select>
            </div>
          </div>

          <div class='input-field' id="ddp-regno">
            <div class="label-box">
              <label for="ddp-regno">Registraion number </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="text" id="r_ddp-regno" name="r_ddp-regno" value="<?php echo $rDDP[1]; ?>" class="requiredField single">
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="prime-nephro">Primary Nephrologist </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="text" id="prime-nephro" name="r_p-nephro" value="<?php echo $rPrimeNephro; ?>" class="requiredField single">
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
              <label for="dialysis-center">Dialysis center or Hospital </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <select name="r_d-center" class="requiredField single">
                <?php

// require_once("../db-connect.php");
// require_once("../include/functions.inc.php");

if ($_SESSION['userType'] === "Transplant coordinator") {
  $val = $_SESSION['userHospital']['id'];
  $name = $_SESSION['userHospital']['name'];
  echo "<option value='$val' selected >$name</option>"; //to store name or value?
} else if ($_SESSION['userType'] === "Admin") {
  if ($hosp_array = getHospitals($conn)) {
    foreach ($hosp_array as $key => $value) {
      $optionVal = $value['id'];
      $optionName = $value['name'];
      if ($optionVal == $rHosp) {
        echo "<option value='$optionVal' selected>$optionName</option>";
      } else {
        echo "<option value='$optionVal'>$optionName</option>";
      }
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
              <label for="prov-clear">Provisional clearance by primary nephrologist </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <select id="prov-clear" name="r_prov-clear" class="requiredField single">
                <option value="" selected disabled>Choose</option>
                <option value="Yes" <?php if ($rProvClear == "Yes") {
  echo "selected";
}
?>>Yes</option>
                <option value="No" <?php if ($rProvClear == "No") {
  echo "selected";
}
?>>No</option>
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
                <option value="Yes" <?php if ($rPreTranspSurg[0] == "Yes") {
  echo "selected";
}
?>>Yes</option>
                <option value="No" <?php if ($rPreTranspSurg[0] == "No") {
  echo "selected";
}
?>>No</option>
              </select>
            </div>
          </div>

          <div class='input-field' id='pre-transp-specify'>
            <!--   If yes is selected in pre-transp-surg field -->
            <div class="label-box">
              <label>Please specify </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="text" name="pre-transp-specify" value="<?php echo $rPreTranspSurg[1]; ?>" class="requiredField single">
            </div>
          </div>

        </fieldset>
      </div>

      <div class='tab'>

        <div class="input-field">
          <div class="heading-box">
            <h3 class="text-center">Donor details</h3>
          </div>

          <div class="pass-img-box">
            <label for="d_img">
              <img id="d-pass-img" src="../images/blank-avatar.png">
            </label>
            <input type="file" id="d_img" name="d_img">
          </div>
        </div>

        <fieldset>
          <legend>Personal Information</legend>

          <div class='input-field'>
            <div class="label-box">
              <label>Name </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="text" name="d_fname" value="<?php echo $dNameArray[0]; ?>" class="double requiredField">
              <input type="text" name="d_lname" value="<?php echo $dNameArray[1]; ?>" class="double requiredField">
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label>Sex </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="radio" id='male' name='d_sex' value="Male" <?php if ($dSex == 'Male') {
  echo "checked";
}
?>>
              <label for="male">Male</label>
              <input type="radio" id='Female' name='d_sex' value="Female" <?php if ($dSex == 'Female') {
  echo "checked";
}
?>>
              <label for="female">Female</label>
              <input type="radio" id='other' name='d_sex' value="Other" <?php if ($dSex == 'Other') {
  echo "checked";
}
?>>
              <label for="other">Other</label>
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="d_dob">Date of Birth </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="date" id="d_dob" name="d_dob" value="<?php echo $dDOB; ?>" class="requiredField single">
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="d_height">Height (cms) </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="number" name="d_height" id="d_height" value="<?php echo $dHeight; ?>" class="requiredField single">
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="d_weight">Weight (kgs) </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="number" name="d_weight" id="d_weight" value="<?php echo $dWeight; ?>" class="requiredField single">
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="d_bmi">BMI (kg/m<sup>2</sup>) </label>
            </div>
            <div class="input-box">
              <input type="number" name="d_bmi" id="d_bmi" value="<?php echo $dBMI; ?>" class="single" readonly>
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="d_b-type">Blood group </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <select id="d_b-type" name="d_b-type" class="requiredField single">
                <option value="" disabled selected>Choose</option>
                <option value="O +ve" <?php if ($dBloodGroup == "O +ve") {
  echo "selected";
}
?>>O +ve</option>
                <option value="O -ve" <?php if ($dBloodGroup == "O -ve") {
  echo "selected";
}
?>>O -ve</option>
                <option value="A +ve" <?php if ($dBloodGroup == "A +ve") {
  echo "selected";
}
?>>A +ve</option>
                <option value="A -ve" <?php if ($dBloodGroup == "A -ve") {
  echo "selected";
}
?>>A -ve</option>
                <option value="B +ve" <?php if ($dBloodGroup == "B +ve") {
  echo "selected";
}
?>>B +ve</option>
                <option value="B -ve" <?php if ($dBloodGroup == "B -ve") {
  echo "selected";
}
?>>B -ve</option>
                <option value="AB +ve" <?php if ($dBloodGroup == "AB +ve") {
  echo "selected";
}
?>>AB +ve</option>
                <option value="AB -ve" <?php if ($dBloodGroup == "AB -ve") {
  echo "selected";
}
?>>AB -ve</option>
              </select>
            </div>
          </div>

          <div class="input-field">
            <div class="label-box">
              <label for="d_b-report">Blood report </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="file" id="d_b-report" name="d_b-report" class="single">
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="d_rel-donor">Relation to donor </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <select id="d_rel-donor" name="d_rel" class="requiredField single">
                <option value="" selected disabled>Choose</option>
                <?php
foreach ($relationValues as $value) {
  if ($value == $dRelation) {
    echo "<option value='$value' selected>$value</option>";
  } else {
    echo "<option value='$value'>$value</option>";
  }
}
?>
              </select>
            </div>
          </div>

        </fieldset>



        <fieldset>
          <legend>Contact Information</legend>

          <div class='input-field'>
            <div class="label-box">
              <label>Address </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="text" id="d_addr1" name="d_addr1" value="<?php echo $dAddressArray[0]; ?>" placeholder="e.g Address line 1" class="requiredField single">
              <input type="text" id="d_addr2" name="d_addr2" value="<?php echo $dAddressArray[1]; ?>" placeholder="e.g Address line 2" class="requiredField single">
              <input type="text" id="d_city" name="d_city" value="<?php echo $dAddressArray[2]; ?>" placeholder="e.g Chennai" class="requiredField double">
              <input type="text" id="d_state" name="d_state" value="<?php echo $dAddressArray[3]; ?>" placeholder="e.g TamilNadu" class="requiredField double">
              <input type="number" id="d_pincode" name="d_pincode" value="<?php echo $dAddressArray[4]; ?>" placeholder="e.g 600001" class="requiredField double">
              <input type="text" id="d_country" name="d_country" value="<?php echo $dAddressArray[5]; ?>" placeholder="e.g India" class="requiredField double">
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label>Contact number </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="number" name="d_cno" value="<?php echo $dCno; ?>" class="requiredField single">
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label>Email address </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="email" name="d_email" value="<?php echo $dEmail; ?>" class="requiredField single">
            </div>
          </div>

        </fieldset>

        <fieldset>

          <legend>Medical Information</legend>

          <?php include "../templates/edit_dHla.php";?>

          <div class='input-field'>
            <div class="label-box">
              <label for="d_comorb">Pre-existing illness </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <select class="beautify requiredField single" id="comorb2" name="d_comorb[]" multiple>
                <?php foreach ($ComorbValues as $val): ?>
                  <option value="<?php echo $val; ?>" <?php if (in_array($val, $dComorbArray)) {
  echo "selected";
}
?>><?php echo $val; ?></option>
                <?php endforeach;?>
              </select>
            </div>
          </div>

          <div class='input-field' id='comorb-others2'>
            <!--   If others is selected in comorb field -->
            <div class="label-box">
              <label>Others </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="text" class="requredField single" name="d_comorb-others" value="<?php echo $dComorbOthers; ?>">
            </div>
          </div>

          <label id="serology">Serology stautus for viral disease </label>

          <div class='input-field'>
            <div class="label-box">
              <label>HIV </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="radio" id='d_hiv-p' name='d_hiv' value="Positive" <?php if ($dHiv == "Positive") {
  echo "checked";
}
?>>
              <label for="d_hiv-p">Positive</label>
              <input type="radio" id='d_hiv-n' name='d_hiv' value="Negative" <?php if ($dHiv == "Negative") {
  echo "checked";
}
?>>
              <label for="d_hiv-n">Negative</label>
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="d_hepB">Hepatitis B </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="radio" id='d_hepBP' name='d_hepB' value="Positive" <?php if ($dHepB == "Positive") {
  echo "checked";
}
?>>
              <label for="d_hepBP">Positive</label>
              <input type="radio" id='d_hepBN' name='d_hepB' value="Negative" <?php if ($dHepB == "Negative") {
  echo "checked";
}
?>>
              <label for="d_hepBN">Negative</label>
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="d_hepC">Hepatitis C </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <input type="radio" id='d_hepCP' name='d_hepC' value="Positive" <?php if ($dHepC == "Positive") {
  echo "checked";
}
?>>
              <laCel for="d_hepCP">Positive</laCel>
              <input type="radio" id='d_hepCN' name='d_hepC' value="Negative" <?php if ($dHepC == "Negative") {
  echo "checked";
}
?>>
              <label for="d_hepCN">Negative</label>
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="d_alcohol">Alcohol intake </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <select id="d_alcohol" name="d_alcohol" class="requiredField single">
                <option value="" selected disabled>Choose</option>
                <option value="Yes" <?php if ($dAlcohol == "Yes") {
  echo "selected";
}
?>>Yes</option>
                <option value="No" <?php if ($dAlcohol == "No") {
  echo "selected";
}
?>>No</option>
              </select>
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="d_smoking">Smoking </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <select id="d_smoking" name="d_smoking" class="requiredField single">
                <option value="" selected disabled>Choose</option>
                <option value="Yes" <?php if ($dSmoking == "Yes") {
  echo "selected";
}
?>>Yes</option>
                <option value="No" <?php if ($dSmoking == "No") {
  echo "selected";
}
?>>No</option>
              </select>
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="d_prov-clear">Provisional clearance by primary nephrologist </label>
              <label class="required">* </label>
            </div>
            <div class="input-box">
              <select id="d_prov-clear" name="d_prov-clear" class="requiredField single">
                <option value="" selected disabled>Choose</option>
                <option value="Yes" <?php if ($dProvClear == "Yes") {
  echo "selected";
}
?>>Yes</option>
                <option value="No" <?php if ($dProvClear == "No") {
  echo "selected";
}
?>>No</option>
              </select>
            </div>
          </div>

        </fieldset>
      </div>

      <div id='btn-block'>
        <button type="button" id='prev-btn'>Previous</button>
        <button type="button" id='next-btn'>Next</button>
      </div>

    </form>
  </div>
  
<script src="../js/backToTop.js"></script>
  <?php
require_once "../include/footer.inc.php";
