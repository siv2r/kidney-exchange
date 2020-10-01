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
  width: 80%;
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
        
          <div id="pass-img">
            <label for="passport-img">
              <img src="images/user.png">
            </label>
            <input type="file" id="passport-img" name="r_img">
          </div>
        
          <div class='input-field' id='name'>
            <label>Name :</label>
            <input type="text" name="r_fname">
            <input type="text" name="r_lname">
          </div>
                
          <div class='input-field' id='sex'>
            <label>Sex :</label>
            <input type="radio" id='male' name='r_sex'>
            <label for="male">Male</label>
            <input type="radio" id='female' name='r_sex'>
            <label for="female">Female</label>
            <input type="radio" id='other' name='r_sex'>
            <label for="other">Other</label>
          </div>
        
          <div class='input-field' id='dob'>
            <label for="do-birth">Date of Birth :</label>
            <input type="date" id="do-birth" name="r_dob">
          </div>
        
          <div class='input-field' id='height'>
            <label>Height (cms) :</label>
            <input type="number" name="r_height" id="r_height">
          </div>
        
          <div class='input-field' id='weight'>
            <label>Weight (kgs) :</label>
            <input type="number" name="r_weight" id="r_weight">
          </div>
        
          <div class='input-field'>
            <label>BMI (kg/m<sup>2</sup>) :</label>
            <input type="number" name="r_bmi" id="r_bmi" readonly>
          </div>
        
          <div class='input-field'>
            <label for="btype">Blood group :</label>
            <select id="btype" name="r_b-type">
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
        
          <div class="input-field">
            <label for="passport-img">Blood report :</label>
            </label>
            <input type="file" id="blood-report" name="r_b-report">
          </div>
        
        </fieldset>
        
        
        
        <fieldset>
          <legend>Contact Information</legend>
        
          <div class='input-field addr'>
            <label>Address :</label>
            <input type="text" id="addr1" name="r_addr1" placeholder="e.g Address line 1">
            <input type="text" id="addr2" name="r_addr2" placeholder="e.g Address line 2">
            <input type="text" id="city" name="r_city" placeholder="e.g Chennai">
            <input type="text" id="state" name="r_state" placeholder="e.g TamilNadu">
            <input type="number" id="zip-code" name="r_zip-code" placeholder="e.g 600001"> 
            <input type="text" id="country" name="r_country" placeholder="e.g India"> 
          </div>
        
          <div class='input-field'>
            <label>Contact number :</label>
            <input type="number" name="r_cno">
          </div>
        
          <div class='input-field'>
            <label>Email address :</label>
            <input type="email" name="r_email">
          </div>
        
        </fieldset>
        
        <fieldset>
        
          <legend>Medical Information</legend>

          <?php include("templates/r_hla.php") ?>
        
          <div class='input-field'>
            <label>Basic disease :</label>
            <input type="text" name="r_b-disease">
          </div>
        
          <div class='input-field'>
            <label>Genetics/renal biopsy (if any) :</label>
            <input type="text" name="r_gr-biopsy">
          </div>
        
          <div class='input-field'>
            <label for="comorb">Comorbid conditions :</label>
            <select class="beautify" id="comorb" multiple='multiple' name[]="r_comorb">
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
        
          <div class='input-field' id='comorb-others'>     <!--   If others is selected in comorb field -->
            <label>Others :</label>
            <input type="text" name="r_comorb-others">
          </div>
        
          <label id="serology">Serology stautus for viral disease:</label>
        
          <div class='input-field'>
            <label>HIV -</label>
            <input type="radio" id='hiv-p' name='r_hiv'>
            <label for="hiv-p">Positive</label>
            <input type="radio" id='hiv-n' name='r_hiv'>
            <label for="hiv-n">Negative</label>
          </div>
        
          <div class='input-field'>
            <label for="hep-b">Hepatitis B -</label>
            <input type="radio" id='hep-b-p' name='r_hep-b'>
            <label for="hep-b-p">Positive</label>
            <input type="radio" id='hep-b-n' name='r_hep-b'>
            <label for="hep-b-n">Negative</label>
          </div>
        
          <div class='input-field'>
            <label for="hep-c">Hepatitis C -</label>
            <input type="radio" id='hiv-p' name='r_hep-c'>
            <label for="hiv-p">Positive</label>
            <input type="radio" id='hiv-n' name='r_hep-c'>
            <label for="hiv-n">Negative</label>
          </div>
        
          <div class='input-field'>
            <label for="prev-transp">Previous Transplant :</label>
            <select id="prev-transp" name="r_prev-transp">
              <option value="" selected disabled>Choose</option>
              <option value="yes">Yes</option>
              <option value="no">No</option>
            </select>
          </div>
        
          <div class='input-field' id='date-of-transp'>
            <label>Date of Transplant :</label>  <!--If yes is given to previous transplant field -->
            <input type="date" name="r_dot">
          </div>
        
          <div class='input-field'>
            <label>Mode of Dialysis :</label>
            <select id="mode-of-dialysis" name="r_mod">
              <option value="" selected disabled>Choose</option>
              <option value="hemodialysis">Hemodialysis</option>
              <option value="peritoneal dialysis">Peritoneal dialysis</option>
              <option value="no dialysis">No dialysis</option>
            </select>
          </div>
        
          <div class='input-field' id="date-of-dialysis">
            <label>Date of start of dialysis :</label>  <!--   For hemodialysis and peritoneal dialysis -->
            <input type="date" name="r_dod">
          </div>
        
          <div class='input-field  ' id="vascular-access">
            <label>Vascualar access :</label>  <!--   For hemodialysis only -->
            <select name="r_vs-access">
              <option value="">AV fistula</option>
              <option value="">AV graft</option>
              <option value="">Tunelled catheter</option>
              <option value="">Temporary catheter</option>
            </select>
          </div>
        
          <div class='input-field'>
            <label>Registered in Deceased Donor Program :</label>
            <select id="ddp" name="r_ddp">
              <option value="" selected disabled>Choose</option>
              <option value="yes">Yes</option>
              <option value="no">No</option>
            </select>
          </div>
        
          <div class='input-field' id="ddp-regno">
            <label for="ddp-regno">Registraion number :</label>  
            <input type="text" id="ddp-regno" name="r_ddp-regno">
          </div>
        
          <div class='input-field'>
            <label for="prime-nephro">Primary Nephrologist :</label>  
            <input type="text" id="prime-nephro" name="r_p-nephro">
          </div>
        
          <div class='input-field'>
            <label for="dialysis-center">Dialysis center or Hospital :</label>  
            <input type="text" id="dialysis-center" name="r_d-center">
          </div>
          
          <div class='input-field'>
            <label for="prov-clear">Provisional clearance by primary nephrologist :</label>
            <select id="prov-clear" name="r_prov-clear">
              <option value="" selected disabled>Choose</option>
              <option value="yes">Yes</option>
              <option value="no">No</option>
            </select>
          </div>
        
          <div class='input-field'>
            <label>Any pre transplant procedures/surgery planned :</label>
            <select  id='pre-transp' name="r_pre-transp">
              <option value="" selected disabled>Choose</option>
              <option value="yes">Yes</option>
              <option value="no">No</option>
            </select>
          </div>
        
          <div class='input-field' id='pre-transp-specify'>     <!--   If yes is selected in pre-transp-surg field -->
            <label>Please specify :</label>
            <input type="text" name="r_pre-transp-specify">
          </div>
          
        </fieldset>
      </div>
    
      <div class='tab'>
        <h3 >Donor details</h3>
        
        <fieldset>
          <legend>Personal Information</legend>
        
          <div id="pass-img">
            <label for="passport-img">
              <img src="images/user.png">
            </label>
            <input type="file" id="passport-img">
          </div>
        
          <div class='input-field' id='name'>
            <label>Name :</label>
            <input type="text">
            <input type="text">
          </div>
        
          <div class='input-field' id='sex'>
            <label>Sex :</label>
            <input type="radio" id='male' name='sex'>
            <label for="male">Male</label>
            <input type="radio" id='female' name='sex'>
            <label for="female">Female</label>
            <input type="radio" id='other' name='sex'>
            <label for="other">Other</label>
          </div>
        
          <div class='input-field' id='dob'>
            <label for="do-birth">Date of Birth :</label>
            <input type="date" id="do-birth">
          </div>
        
          <div class='input-field' id='height'>
            <label>Height (cms) :</label>
            <input type="number" id="d_height">
          </div>
        
          <div class='input-field'>
            <label>Weight (kgs) :</label>
            <input type="number" id="d_weight">
          </div>
        
          <div class='input-field bmi'>
            <label>BMI (kg/m<sup>2</sup>) :</label>
            <input type="number" id="d_bmi" readonly>
          </div>
        
          <div class='input-field'>
            <label for="btype">Blood group :</label>
            <select id="btype">
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
        
          <div class="input-field">
            <label for="passport-img">Blood report :</label>
            </label>
            <input type="file" id="blood-report">
          </div>
        
          <div class='input-field'>
            <label for="rel-donor">Relation to donor :</label>
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
        
        </fieldset>
        
        
        
        <fieldset>
          <legend>Contact Information</legend>
        
          <div class='input-field addr'>
            <label>Address :</label>
            <input type="text" id="addr1" placeholder="e.g Address line 1">
            <input type="text" id="addr2" placeholder="e.g Address line 2">
            <input type="text" id="city" placeholder="e.g Chennai">
            <input type="text" id="state" placeholder="e.g TamilNadu">
            <input type="number" id="zip-code" placeholder="e.g 600001"> 
            <input type="text" id="country" placeholder="e.g India"> 
          </div>
        
          <div class='input-field'>
            <label>Contact number :</label>
            <input type="number">
          </div>
        
          <div class='input-field'>
            <label>Email address :</label>
            <input type="email">
          </div>
        
        </fieldset>
        
        <fieldset>
        
          <legend>Medical Information</legend>

          <?php include("templates/d_hla.php") ?>
        
          <div class='input-field'>
            <label for="comorb">Pre-existing illness :</label>
            <select class="beautify" id="comorb2" multiple='multiple'>
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
        
          <div class='input-field' id='comorb-others2'>     <!--   If others is selected in comorb field -->
              <label>Others :</label>
              <input type="text">
          </div>
        
          <label id="serology">Serology stautus for viral disease:</label>
        
          <div class='input-field'>
            <label>HIV -</label>
            <input type="radio" id='hiv-p' name='hiv'>
            <label for="hiv-p">Positive</label>
            <input type="radio" id='hiv-n' name='hiv'>
            <label for="hiv-n">Negative</label>
          </div>
        
          <div class='input-field'>
            <label for="hep-b">Hepatitis B -</label>
            <input type="radio" id='hep-b-p' name='hep-b'>
            <label for="hep-b-p">Positive</label>
            <input type="radio" id='hep-b-n' name='hep-b'>
            <label for="hep-b-n">Negative</label>
          </div>
        
          <div class='input-field'>
            <label for="hep-c">Hepatitis C -</label>
            <input type="radio" id='hiv-p' name='hiv'>
            <label for="hiv-p">Positive</label>
            <input type="radio" id='hiv-n' name='hiv'>
            <label for="hiv-n">Negative</label>
          </div>
        
          <div class='input-field'>
            <label for="prov-clear">Alcohol intake :</label>
            <select>
              <option value="">Yes</option>
              <option value="">No</option>
            </select>
          </div>
        
          <div class='input-field'>
            <label for="prov-clear">Smoking :</label>
            <select>
              <option value="">Yes</option>
              <option value="">No</option>
            </select>
          </div>
        
          <div class='input-field'>
            <label for="prov-clear">Provisional clearance by primary nephrologist :</label>
            <select id="prov-clear">
              <option value="">Yes</option>
              <option value="">No</option>
            </select>
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



