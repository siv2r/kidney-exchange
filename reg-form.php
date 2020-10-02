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
  <script src="scripts/reg-form.js"></script> 
</head>

<style>

* {
  font-family: Verdana, Geneva, Tahoma, sans-serif;
  margin: 0%;
  box-sizing: border-box;
}

.wrapper{
  width: 70%;
  margin: auto;
  padding: 10px;
  box-sizing: border-box;
}

</style>

<link rel="stylesheet" href="./css/form-style.css">

<body>

  <div class="header-img">
    <div class="nav-container">
      <?php include("templates/nav-bar.php") ?>
    </div>
    <h2 id="heading">Registration form</h2>
  </div>

  <div class="wrapper">
    <form action="#" method="POST" id="reg-form">
      
      <div class='tab'>
        <h3 >Patient details</h3>
        
        <fieldset>
          <legend>Personal Information</legend>
        
          <!-- <div id="pass-img">
            <label for="passport-img">
              <img src="images/user.png">
            </label>
            <input type="file" id="passport-img" name="r_img" class="requiredField">
          </div> -->
        
          <div class='input-field' id='name'>
            <div class="label-box">
              <label>Name :</label>
            </div>
            <div class="input-box">
              <input type="text" name="r_fname" class="double">
              <input type="text" name="r_lname" class="double">
            </div >
          </div>
                
          <div class='input-field' id='sex'>
            <div class="label-box"> 
              <label>Sex :</label>
            </div>
            <div class="input-box">
              <input type="radio" id='male' name='r_sex'>
              <label for="male">Male</label>
              <input type="radio" id='female' name='r_sex'>
              <label for="female">Female</label>
              <input type="radio" id='other' name='r_sex'>
              <label for="other">Other</label>
            </div>
          </div>
        
          <div class='input-field' id='dob'>
            <div class="label-box">
              <label for="do-birth">Date of Birth :</label>
            </div>
            <div class="input-box">
              <input type="date" id="do-birth" name="r_dob" class="requiredField single">
            </div>
          </div>
        
          <div class='input-field' id='height'>
            <div class="label-box">
              <label>Height (cms) :</label>
            </div>
            <div class="input-box">
              <input type="number" name="r_height" id="r_height" class="requiredField single">
            </div>
          </div>
        
          <div class='input-field' id='weight'>
            <div class="label-box">
              <label>Weight (kgs) :</label>
            </div>
            <div class="input-box">
              <input type="number" name="r_weight" id="r_weight" class="requiredField single">
            </div>
          </div>
        
          <div class='input-field'>
            <div class="label-box">
              <label>BMI (kg/m<sup>2</sup>) :</label>
            </div>
            <div class="input-box">
              <input type="number" name="r_bmi" id="r_bmi" class="single" readonly>
            </div>
          </div>
        
          <div class='input-field'>
            <div class="label-box">
              <label for="btype">Blood group :</label>
            </div>
            <div class="input-box">
              <select id="btype" name="r_b-type" class="requiredField single">
                <option value="" disabled selected>Choose</option>
                <option value="">O +ve</option>
                <option value="">O -ve</option>
                <option value="">A +ve</option>
                <option value="">A -ve</option>
                <option value="">B +ve</option>
                <option value="">B -ve</option>
                <option value="">AB +ve</option>
                <option value="">AB -ve</option>
              </select>
            </div>
          </div>
        
          <div class="input-field">
            <div class="label-box">
              <label for="blood-report">Blood report :</label>
            </div>
            <div class="input-box">
              <input type="file" id="blood-report" name="r_b-report" class="requiredField single">
            </div>
          </div>
        
        </fieldset>
        
        
        
        <fieldset>
          <legend>Contact Information</legend>
        
          <div class='input-field addr'>
            <div class="label-box">
              <label>Address :</label>
            </div>
            <div class="input-box">
              <input type="text" id="addr1" name="r_addr1" placeholder="e.g Address line 1" class="requiredField single">
              <input type="text" id="addr2" name="r_addr2" placeholder="e.g Address line 2" class="requiredField single">
              <input type="text" id="city" name="r_city" placeholder="e.g Chennai" class="requiredField double">
              <input type="text" id="state" name="r_state" placeholder="e.g TamilNadu" class="requiredField double">
              <input type="number" id="zip-code" name="r_zip-code" placeholder="e.g 600001" class="requiredField double"> 
              <input type="text" id="country" name="r_country" placeholder="e.g India" class="requiredField double"> 
            </div>
          </div>
        
          <div class='input-field'>
            <div class="label-box">
              <label>Contact number :</label>
            </div>
            <div class="input-box">
              <input type="number" name="r_cno" class="requiredField single">
            </div>
          </div>
        
          <div class='input-field'>
            <div class="label-box">
              <label>Email address :</label>
            </div>
            <div class="input-box">
              <input type="email" name="r_email" class="requiredField single">
            </div>
          </div>
        
        </fieldset>
        
        <fieldset>
        
          <legend>Medical Information</legend>

          <?php include("templates/r_hla.php") ?>
        
          <div class='input-field'>
            <div class="label-box">
              <label>Basic disease :</lable>
            </div>
            <div class="input-box">
              <input type="text" name="r_b-disease" class="requiredField single">
            </div>
          </div>
        
          <div class='input-field'>
            <div class="label-box">
              <label>Genetics/renal biopsy (if any) :</label>
            </div>
            <div class="input-box">
              <input type="text" name="r_gr-biopsy" class="single">
            </div>
          </div>
        
          <div class='input-field'>
            <div class="label-box">
              <label for="comorb">Comorbid conditions :</label>
            </div>
            <div class="input-box">
              <select class="beautify requiredField single" id="comorb" multiple='multiple' name="r_comorb">
                <option value="">None</option>
                <option value="">Type1 DM</option>
                <option value="">Type2 DM</option>
                <option value="">Hypertension</option>
                <option value="">Coronary Artery Disease</option>
                <option value="">Chronic liver disease</option>
                <option value="">Chronic Obstructive Pulmonary disease</option>
                <option value="">Cancer</option>
                <option value="Others">Others</option>
              </select>
            </div>
          </div>
        
          <div class='input-field' id='comorb-others'>     <!--   If others is selected in comorb field -->
            <div class="label-box">
              <label>Others :</label>
            </div>
            <div class="input-box">
              <input type="text" name="r_comorb-others" class="requiredField single">
            </div>
          </div>
        
          <label id="serology">Serology stautus for viral disease:</label>
        
          <div class='input-field'>
            <div class="label-box">
              <label>HIV -</label>
            </div>
            <div class="input-box">
              <input type="radio" id='hiv-p' name='r_hiv'>
              <label for="hiv-p">Positive</label>
              <input type="radio" id='hiv-n' name='r_hiv'>
              <label for="hiv-n">Negative</label>
            </div>
          </div>
        
          <div class='input-field'>
            <div class="label-box">
              <label for="r_hepB">Hepatitis B -</label>
            </div>
            <div class="input-box">
              <input type="radio" id='r_hepBP' name='r_hepB'>
              <label for="r_hepBP">Positive</label>
              <input type="radio" id='r_hepBN' name='r_hepB'>
              <label for="r_hepBN">Negative</label>
            </div>
          </div>
        
          <div class='input-field'>
            <div class="label-box">
              <label for="r_hepC">Hepatitis C -</label>
            </div>
            <div class="input-box">
              <input type="radio" id='r_hepCP' name='r_hepC'>
              <laCel for="r_hepCP">Positive</laCel>
              <input type="radio" id='r_hepCN' name='r_hepC'>
              <label for="r_hepCN">Negative</label>
            </div>
          </div>
        
          <div class='input-field'>
            <div class="label-box">
              <label for="prev-transp">Previous Transplant :</label>
            </div>
            <div class="input-box">
              <select id="prev-transp" name="r_prev-transp" class="requiredField single">
                <option value="" selected disabled>Choose</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
              </select>
            </div>
          </div>
        
          <div class='input-field' id='date-of-transp'>
            <div class="label-box">
              <label>Date of Transplant :</label> 
            </div>
            <div class="input-box">
              <input type="date" name="r_dot" class="requiredField single">
            </div>
          </div>
        
          <div class='input-field'>
            <div class="label-box">
              <label>Mode of Dialysis :</label>
            </div>
            <div class="input-box">
              <select id="mode-of-dialysis" name="r_mod" class="requiredField single">
                <option value="" selected disabled>Choose</option>
                <option value="hemodialysis">Hemodialysis</option>
                <option value="peritoneal dialysis">Peritoneal dialysis</option>
                <option value="no dialysis">No dialysis</option>
              </select>
            </div>
          </div>
        
          <div class='input-field' id="date-of-dialysis">
            <div class="label-box">
              <label>Date of start of dialysis :</label> 
            </div> <!--   For hemodialysis and peritoneal dialysis -->
            <div class="input-box">
              <input type="date" name="r_dod" class="requiredField single">
            </div>
          </div>
        
          <div class='input-field  ' id="vascular-access">
            <div class="label-box">
              <label>Vascualar access :</label>
            </div>  <!--   For hemodialysis only -->
            <div class="input-box">
              <select name="r_vs-access" class="requiredField single">
                <option value="">AV fistula</option>
                <option value="">AV graft</option>
                <option value="">Tunelled catheter</option>
                <option value="">Temporary catheter</option>
              </select>
            </div>
          </div>
        
          <div class='input-field'>
            <div class="label-box">
              <label>Registered in Deceased Donor Program :</label>
            </div>
            <div class="input-box">
              <select id="ddp" name="r_ddp" class="requiredField single">
                <option value="" selected disabled>Choose</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
              </select>
            </div>
          </div>
        
          <div class='input-field' id="ddp-regno">
            <div class="label-box">
              <label for="ddp-regno">Registraion number :</label> 
            </div> 
            <div class="input-box">
              <input type="text" id="ddp-regno" name="r_ddp-regno" class="requiredField single">
            </div>
          </div>
        
          <div class='input-field'>
            <div class="label-box">
              <label for="prime-nephro">Primary Nephrologist :</label>
            </div>  
            <div class="input-box">
              <input type="text" id="prime-nephro" name="r_p-nephro" class="requiredField single">
            </div>
          </div>
        
          <div class='input-field'>
            <div class="label-box">
              <label for="dialysis-center">Dialysis center or Hospital :</label> 
            </div> 
            <div class="input-box">
              <input type="text" id="dialysis-center" name="r_d-center" class="requiredField single">
            </div>
          </div>
          
          <div class='input-field'>
            <div class="label-box">
              <label for="prov-clear">Provisional clearance by primary nephrologist :</label>
            </div>
            <div class="input-box">
              <select id="prov-clear" name="r_prov-clear" class="requiredField single">
                <option value="" selected disabled>Choose</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
              </select>
            </div>
          </div>
        
          <div class='input-field'>
            <div class="label-box">
              <label>Any pre transplant procedures/surgery planned :</label>
            </div>
            <div class="input-box">
              <select  id='pre-transp' name="r_pre-transp" class="requiredField single">
                <option value="" selected disabled>Choose</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
              </select>
            </div>
          </div>
        
          <div class='input-field' id='pre-transp-specify'>     <!--   If yes is selected in pre-transp-surg field -->
            <div class="label-box">
              <label>Please specify :</label>
            </div>
            <div class="input-box">
              <input type="text" name="r_pre-transp-specify" class="requiredField single">
            </div>
          </div>
          
        </fieldset>
      </div>
    
      <div class='tab'>
        <h3 >Donor details</h3>
        
        <fieldset>
          <legend>Personal Information</legend>
        
          <!-- <div id="pass-img">
            <label for="passport-img">
              <img src="images/user.png">
            </label>
            <input type="file" id="passport-img">
          </div> -->
        
          <div class='input-field' id='name'>
            <div class="label-box">
              <label>Name :</label>
            </div>
            <div class="input-box">
              <input type="text" name="d_fname" class="double">
              <input type="text" name="d_lname" class="double">
            </div >
          </div>
                
          <div class='input-field' id='sex'>
            <div class="label-box"> 
              <label>Sex :</label>
            </div>
            <div class="input-box">
              <input type="radio" id='male' name='d_sex'>
              <label for="male">Male</label>
              <input type="radio" id='female' name='d_sex'>
              <label for="female">Female</label>
              <input type="radio" id='other' name='dd_sex'>
              <label for="other">Other</label>
            </div>
          </div>
        
          <div class='input-field' id='dob'>
            <div class="label-box">
              <label for="d_dob">Date of Birth :</label>
            </div>
            <div class="input-box">
              <input type="date" id="d_dob" name="d_dob" class="requiredField single">
            </div>
          </div>
        
          <div class='input-field' id='height'>
            <div class="label-box">
              <label for="d_height">Height (cms) :</label>
            </div>
            <div class="input-box">
              <input type="number" name="d_height" id="d_height" class="requiredField single">
            </div>
          </div>
        
          <div class='input-field' id='weight'>
            <div class="label-box">
              <label for="d_weight">Weight (kgs) :</label>
            </div>
            <div class="input-box">
              <input type="number" name="d_weight" id="d_weight" class="requiredField single">
            </div>
          </div>
        
          <div class='input-field'>
            <div class="label-box">
              <label>BMI (kg/m<sup>2</sup>) :</label>
            </div>
            <div class="input-box">
              <input type="number" name="d_bmi" id="d_bmi" class="single" readonly>
            </div>
          </div>
        
          <div class='input-field'>
            <div class="label-box">
              <label for="btype">Blood group :</label>
            </div>
            <div class="input-box">
              <select id="btype" name="r_b-type" class="requiredField single">
                <option value="" disabled selected>Choose</option>
                <option value="">O +ve</option>
                <option value="">O -ve</option>
                <option value="">A +ve</option>
                <option value="">A -ve</option>
                <option value="">B +ve</option>
                <option value="">B -ve</option>
                <option value="">AB +ve</option>
                <option value="">AB -ve</option>
              </select>
            </div>
          </div>
        
          <div class="input-field">
            <div class="label-box">
              <label for="blood-report">Blood report :</label>
            </div>
            <div class="input-box">
              <input type="file" id="blood-report" name="r_b-report" class="requiredField single">
            </div>
          </div>
        
          <div class='input-field'>
            <div class="label-box">
              <label for="d_rel-donor">Relation to donor :</label>
            </div>
            <div class="input-box" id="d_rel-donor">
              <select>
                <option value="">Father</option>
                <option value="">Mother</option>
                <option value="">Spouse</option>
                <option value="">Son</option>
                <option value="">Daughter</option>
                <option value="">Paternal grandmother</option>
                <option value="">Paternal grandfather</option>
                <option value="">Maternal grandmother</option>
                <option value="">Maternal grandfather</option>
              </select>
            </div>
          </div>
        
        </fieldset>
        
        
        
        <fieldset>
          <legend>Contact Information</legend>
        
          <div class='input-field addr'>
            <div class="label-box">
              <label>Address :</label>
            </div>
            <div class="input-box">
              <input type="text" id="addr1" name="r_addr1" placeholder="e.g Address line 1" class="requiredField single">
              <input type="text" id="addr2" name="r_addr2" placeholder="e.g Address line 2" class="requiredField single">
              <input type="text" id="city" name="r_city" placeholder="e.g Chennai" class="requiredField double">
              <input type="text" id="state" name="r_state" placeholder="e.g TamilNadu" class="requiredField double">
              <input type="number" id="zip-code" name="r_zip-code" placeholder="e.g 600001" class="requiredField double"> 
              <input type="text" id="country" name="r_country" placeholder="e.g India" class="requiredField double"> 
            </div>
          </div>
        
          <div class='input-field'>
            <div class="label-box">
              <label>Contact number :</label>
            </div>
            <div class="input-box">
              <input type="number" name="r_cno" class="requiredField single">
            </div>
          </div>
        
          <div class='input-field'>
            <div class="label-box">
              <label>Email address :</label>
            </div>
            <div class="input-box">
              <input type="email" name="r_email" class="requiredField single">
            </div>
          </div>
        
        </fieldset>
        
        <fieldset>
        
          <legend>Medical Information</legend>

          <?php include("templates/d_hla.php") ?>
        
          <div class='input-field'>
            <div class="label-box">
              <label for="comorb">Pre-existing illness :</label>
            </div>
            <div class="input-box">
              <select class="beautify single" id="comorb2" multiple='multiple'>
                <option value="">None</option>
                <option value="">Type1 DM</option>
                <option value="">Type2 DM</option>
                <option value="">Hypertension</option>
                <option value="">Coronary Artery Disease</option>
                <option value="">Chronic liver disease</option>
                <option value="">Chronic Obstructive Pulmonary disease</option>
                <option value="">Cancer</option>
                <option value="Others">Others</option>
              </select>
            </div>
          </div>
        
          <div class='input-field' id='comorb-others2'>     <!--   If others is selected in comorb field -->
              <div class="label-box">
                <label>Others :</label>
              </div>
              <div class="input-box">
                <input type="text">
              </div>
          </div>
        
          <label id="serology">Serology stautus for viral disease:</label>

          <div class='input-field'>
            <div class="label-box">
              <label>HIV -</label>
            </div>
            <div class="input-box">
              <input type="radio" id='hiv-p' name='r_hiv'>
              <label for="hiv-p">Positive</label>
              <input type="radio" id='hiv-n' name='r_hiv'>
              <label for="hiv-n">Negative</label>
            </div>
          </div>
        
          <div class='input-field'>
            <div class="label-box">
              <label for="r_hepB">Hepatitis B -</label>
            </div>
            <div class="input-box">
              <input type="radio" id='r_hepBP' name='r_hepB'>
              <label for="r_hepBP">Positive</label>
              <input type="radio" id='r_hepBN' name='r_hepB'>
              <label for="r_hepBN">Negative</label>
            </div>
          </div>
        
          <div class='input-field'>
            <div class="label-box">
              <label for="r_hepC">Hepatitis C -</label>
            </div>
            <div class="input-box">
              <input type="radio" id='r_hepCP' name='r_hepC'>
              <laCel for="r_hepCP">Positive</laCel>
              <input type="radio" id='r_hepCN' name='r_hepC'>
              <label for="r_hepCN">Negative</label>
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="prov-clear">Alcohol intake :</label>
            </div>
            <div class="input-box">
              <select id="prov-clear" name="r_prov-clear" class="requiredField single">
                <option value="" selected disabled>Choose</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
              </select>
            </div>
          </div>

          <div class='input-field'>
            <div class="label-box">
              <label for="prov-clear">Smoking :</label>
            </div>
            <div class="input-box">
              <select id="prov-clear" name="r_prov-clear" class="requiredField single">
                <option value="" selected disabled>Choose</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
              </select>
            </div>
          </div>
        
          <div class='input-field'>
            <div class="label-box">
              <label for="prov-clear">Provisional clearance by primary nephrologist :</label>
            </div>
            <div class="input-box">
              <select id="prov-clear" name="r_prov-clear" class="requiredField single">
                <option value="" selected disabled>Choose</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
              </select>
            </div>
          </div>
        
        </fieldset>
      </div>
    
      <div id="msg_tab">
        <p>Registration confirmation info:</p>
      </div>
    
    
      <div id='btn-block'>
        <button type="button" id='prev-btn'>Previous</button>
        <button type="button" id='next-btn'>Next</button>
      </div>
    
    
    
    </form>
  </div>
</body>

</html> 



