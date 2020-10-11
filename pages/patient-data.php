<?php 

$status = '';
$statusMsg = '';

if(isset($_POST['submit'])){
  $id = $_POST['id'];

  include("../templates/db-connect.php");

  //Create query
  $query = "SELECT * FROM patients WHERE id = '$id' LIMIT 1";

  //Fectch the results
  $result = mysqli_query($conn, $query);


  if(mysqli_num_rows($result) == 0){
    header("Location: data.php");
  } 

  $row = mysqli_fetch_array($result, MYSQLI_NUM);
}

?>

<!DOCTYPE html>
<html lang="en">

<link rel="stylesheet" href="../css/form-style.css">
<link rel="stylesheet" href="../css/data-style.css">

<style>
  .nav-container{
    position: static;
  }
</style>


<?php include("../templates/header.php") ?>

  <div class="nav-container">
    <?php include("../templates/nav-bar.php") ?>
  </div>

  <div class="wrapper">
    <div class="input-field">
      <div class="heading-box">
        <h3>Patient details</h3>
      </div>

      <div class="pass-img-box">
        <label for="passport-img">
          <img id="pass-img" src="../images/blank-avatar.png">
        </label>
        <input type="file" id="passport-img" name="r_img" class="requiredField">
      </div>
    </div>

    <fieldset>
      <legend>Personal Information</legend>
            
      <div class='input-field'>
        <div class="label-box">
          <label>Id</label>
        </div>
        <div class="input-box">
          <p><?php echo $row[0] ?></p>
        </div >
      </div>

      <div class='input-field'>
        <div class="label-box">
          <label>Name</label>
        </div>
        <div class="input-box">
          <p><?php echo $row[1] ?></p>
        </div>
      </div>

      <div class='input-field'>
        <div class="label-box">
          <label>Sex</label>
        </div>
        <div class="input-box">
          <p><?php echo $row[2] ?></p>
        </div>
      </div>

      <div class='input-field'>
        <div class="label-box">
          <label>Date of Birth</label>
        </div>
        <div class="input-box">
          <p><?php echo $row[3] ?></p>
        </div>
      </div>

      <div class='input-field'>
        <div class="label-box">
          <label>Height</label>
        </div>
        <div class="input-box">
          <p><?php echo $row[4] ?></p>
        </div>
      </div>

      <div class='input-field'>
        <div class="label-box">
          <label>Weight</label>
        </div>
        <div class="input-box">
          <p><?php echo $row[5] ?></p>
        </div>
      </div>

      <div class='input-field'>
        <div class="label-box">
          <label>BMI</label>
        </div>
        <div class="input-box">
          <p><?php echo number_format(($row[5]*100*100)/($row[4]*$row[4]), 2) ?></p>
        </div>
      </div>

      <div class='input-field'>
        <div class="label-box">
          <label>Blood Group</label>
        </div>
        <div class="input-box">
          <p><?php echo $row[6] ?></p>
        </div>
      </div>

    </fieldset>

    <fieldset>
      <legend>Contact Information</legend>

      <div class='input-field addr'>
        <div class="label-box">
          <label>Address  </label>
        </div>
        <div class="input-box">
          <p><?php echo $row[7] ?></p>
        </div>
      </div>

      <div class='input-field'>
        <div class="label-box">
          <label>Contact number  </label>
        </div>
        <div class="input-box">
          <p><?php echo $row[8] ?></p>
        </div>
      </div>

      <div class='input-field'>
        <div class="label-box">
          <label>Email</label>
        </div>
        <div class="input-box">
          <p><?php echo $row[9] ?></p>
        </div>
      </div>

    </fieldset>

    <fieldset>

      <legend>Medical Information</legend>

      <div class='input-field'>
        <div class="label-box">
          <label>HLA Antigens</lable>
        </div>
        <div class="input-box">
          <p><?php echo $row[10] ?></p>
        </div>
      </div>

      <div class='input-field'>
        <div class="label-box">
          <label>Unacceptable Antigens</lable>
        </div>
        <div class="input-box">
          <p><?php echo $row[11] ?></p>
        </div>
      </div>

      <div class='input-field'>
        <div class="label-box">
          <label>Basic disease  </lable>
        </div>
        <div class="input-box">
          <p><?php echo $row[12] ?></p>
        </div>
      </div>

      <div class='input-field'>
        <div class="label-box">
          <label>Genetics/renal biopsy </label>
        </div>
        <div class="input-box">
          <p><?php echo $row[13] ?></p>
        </div>
      </div>

      <div class='input-field'>
        <div class="label-box">
          <label for="comorb">Comorbid conditions  </label>
        </div>
        <div class="input-box">
          <p><?php echo $row[14] ?></p>
        </div>
      </div>

      <div class='input-field'>
        <div class="label-box">
          <label>HIV </label>
        </div>
        <div class="input-box">
          <p><?php echo $row[15] ?></p>
        </div>
      </div>

      <div class='input-field'>
        <div class="label-box">
          <label for="r_hepB">Hepatitis B </label>
        </div>
        <div class="input-box">
          <p><?php echo $row[16] ?></p>
        </div>
      </div>

      <div class='input-field'>
        <div class="label-box">
          <label for="r_hepC">Hepatitis C </label>
        </div>
        <div class="input-box">
          <p><?php echo $row[17] ?></p>
        </div>
      </div>

      <div class='input-field'>
        <div class="label-box">
          <label for="prev-transp">Previous Transplant  </label>
        </div>
        <div class="input-box">
          <p><?php echo $row[18] ?></p>
        </div>
      </div>

      <div class='input-field'>
        <div class="label-box">
          <label>Dialysis  </label>
        </div>
        <div class="input-box">
          <p><?php echo $row[19] ?></p>
        </div>
      </div>

      <div class='input-field'>
        <div class="label-box">
          <label>Deceased donor program  </label>
        </div>
        <div class="input-box">
          <p><?php echo $row[20] ?></p>
        </div>
      </div>

      <div class='input-field'>
        <div class="label-box">
          <label>Primary Nephrologist</label>
        </div>
        <div class="input-box">
          <p><?php echo $row[21] ?></p>
        </div>
      </div>

      <div class='input-field'>
        <div class="label-box">
          <label>Hospital/Dialysis Center  </label>
        </div>
        <div class="input-box">
          <p><?php echo $row[22] ?></p>
        </div>
      </div>

      <div class='input-field'>
        <div class="label-box">
          <label>Provisional Clearance  </label>
        </div>
        <div class="input-box">
          <p><?php echo $row[23] ?></p>
        </div>
      </div>

      <div class='input-field'>
        <div class="label-box">
          <label>Pre-transplant surgery planned</label>
        </div>
        <div class="input-box">
          <p><?php echo $row[24] ?></p>
        </div>
      </div>

      <div class='input-field'>
        <div class="label-box">
          <label>Created at  </label>
        </div>
        <div class="input-box">
          <p><?php echo $row[25] ?></p>
        </div>
      </div>

      <div class='input-field'>
        <div class="label-box">
          <label>Updated at</label>
        </div>
        <div class="input-box">
          <p><?php echo $row[26] ?></p>
        </div>
      </div>

      </div>
  </div>




  <script src="../scripts/data.js"></script>
</body>
</html>