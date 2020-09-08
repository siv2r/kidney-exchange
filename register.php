<?php

function random_strings($length_of_string) 
{ 
  // String of all alphanumeric character 
  $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 

  // Shufle the $str_result and returns substring 
  // of specified length 
  return substr(str_shuffle($str_result), 0, $length_of_string); 
}

// Array ( [recipient_fname] => Karthik [recipient_lname] => Kumar [recipient_age] => 30 [recipient_gender] => male [recipient_btype] => A +ve [recipient_hlatypes] => Array ( [0] => A29 [1] => B12 [2] => DR51 ) [recipient_unantigens] => Array ( [0] => B12 [1] => B13 ) [recipient_histcrossmatch] => -ve [donor_fname] => Vijay [donor_lname] => Kumar [donor_age] => 40 [donor_gender] => male [donor_btype] => B -ve [donor_hlatypes] => Array ( [0] => A29 [1] => B13 [2] => DR52 ) [h_name] => Dr. Mehta's [submit] => submit )

$registration = "";
$errors = "";
$id = "";

if(isset($_POST['submit'])){

  //id generation
  $post_id = random_strings(5);
  $id = $_POST['recipient_fname'][0] . $_POST['recipient_lname'][0]. $_POST['donor_fname'][0]. $_POST['donor_lname'][0] . "#" . $post_id;

  //recipient info
  $recipient_name = $_POST['recipient_fname'] . ' ' . $_POST['recipient_lname'];
  $recipient_age = $_POST['recipient_age'];
  $recipient_gender = $_POST['recipient_gender'];
  $recipient_btype = $_POST['recipient_btype'];
  $recipient_hlatypes = implode(',', $_POST['recipient_hlatypes']);
  $recipient_unantigens = implode(',', $_POST['recipient_unantigens']);
  $hist_cross = $_POST['recipient_histcrossmatch'];

  //donor info
  $donor_name = $_POST['donor_fname'] . ' ' . $_POST['donor_lname'];
  $donor_age = $_POST['donor_age'];
  $donor_gender = $_POST['donor_gender'];
  $donor_btype = $_POST['donor_btype'];
  $donor_hlatypes = implode(',', $_POST['donor_hlatypes']);

  //hospital info
  $hosp_name = $_POST['h_name'];

  //connecting to database
  include("templates/db-connect.php");

  //creating sql queries
  $sql1 = "INSERT INTO recipients VALUES ('$id', '$recipient_name', '$recipient_age', '$recipient_gender', '$recipient_btype', '$recipient_hlatypes', '$recipient_unantigens', '$hist_cross' )";
  $sql2 = "INSERT INTO donors VALUES ('$id', '$donor_name', '$donor_age', '$donor_gender', '$donor_btype', '$donor_hlatypes')";
  $sql3 = "INSERT INTO hospitals VALUES ('$id', '$hosp_name')";

  if(!mysqli_query($conn, $sql1))
  {
    $error = 'recipient query error' . mysqli_error($conn);
  }

  if(!mysqli_query($conn, $sql2))
  {
    $error = 'donor query error' . mysqli_error($conn);
  }

  if(!mysqli_query($conn, $sql3))
  {
    $error = 'hospital query error' . mysqli_error($conn);
    exit;
  }

  $registration = "registration successful";

}

?>


<!DOCTYPE html>

<html lang="en">

<style>

section{
  margin: 0;
  background-image: url("./images/register.jpg");
  opacity: 0.9;

}

form {
    background-color: whitesmoke;
    border: 3px solid #f1f1f1;
    opacity: 0.8;
    margin-top: 10px;
}

form, option, select{
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
}

#recipient{
    float: left;
    width: 47%;
    margin: 10px;
    padding: 10px;
    -webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
    -moz-box-sizing: border-box;    /* Firefox, other Gecko */
    box-sizing: border-box;         /* Opera/IE 8+ */
}

#donor{
    float: left;
    width: 47%;
    margin: 10px;
    padding: 10px;
    -webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
    -moz-box-sizing: border-box;    /* Firefox, other Gecko */
    box-sizing: border-box;         /* Opera/IE 8+ */
}

#hospital{
    float: left;
    width: 47%;
    margin: 10px;
    padding: 5px;
    -webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
    -moz-box-sizing: border-box;    /* Firefox, other Gecko */
    box-sizing: border-box;         /* Opera/IE 8+ */
}

input[type="text"], input[type="number"], select{
    display: block;
    margin: 10px 0px;
    padding: 10px;
}

#register_header{
    text-align: center;
}

#r_btype_label, #d_btype_label{
    display: block;
    margin-top: 10px;
    margin: 10px, 10px;
}

button {
  background-color: darkgrey;
  color: black;
  padding: 10px;
  margin: 10px;
  border: none;
  cursor: pointer;
  width: 15%;
  font-size: 18px;
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
}

button:hover {
  opacity: 0.8;
}

#reg {
    color: green;
    text-align: center;
}

#your_id{
    text-align: center;
}

</style>

<?php include("templates/header.php"); ?>

<section>

<form action="#" method="POST" class="container">

  <h2 id="register_header">Registration Form</h2>

  <?php if(!empty($registration)) { ?>

    <p id="reg">Registration successful!</p>
  
  <?php } ?>

  <?php if(!empty($id)) { ?>

    <p id="your_id"><?php echo "Your id : '$id' ";  ?></p>

  <?php } ?>
    
  <fieldset id="recipient">

  <legend>Recipient Information:</legend>

  <label for="r_fname">First Name:</label>
  <input type="text" id="r_fname" name="recipient_fname" value="" placeholder="e.g John"  pattern="[A-Z][a-z]*" title="Start with uppercase followed by lowercase alphabets" required> 


  <label for="r_lname">Last Name:</label>
  <input type="text" id="r_lname" name="recipient_lname" value="" placeholder="e.g Smith" pattern="[A-Z][a-z]*" title="Start with uppercase followed by lowercase alphabets" required> 
  

  <label for="r_age">Age:</label>
  <input type="number" id="r_age" name="recipient_age" value="" placeholder="20" required> 
  

  Gender:
  <input type="radio" id="r_male" name="recipient_gender" value="male" required>
  <label for="r_male">Male</label>
  <input type="radio" id="r_female" name="recipient_gender" value="female">
  <label for="r_female">Female</label>
  <input type="radio" id="r_other" name="recipient_gender" value="other">
  <label for="r_other">Other</label>

  <!-- <label>Place of residence:</label>
  <input type="text" name="recipient_addr1" value="" placeholder="e.g Address line 1"> 
  <input type="text" name="recipient_addr2" value="" placeholder="e.g Address line 2"> 
  <input type="text" name="recipient_district" value="" placeholder="e.g Chennai"> 
  <input type="text" name="recipient_state" value="" placeholder="e.g TamilNadu"> 
  <input type="number" name="recipient_pincode" value="" placeholder="e.g 600001">  -->
  

  <label for="r_btype" id="r_btype_label">Blood Type:</label>
  <select name="recipient_btype" required>
      <option value="O +ve">O +ve</option>
      <option value="O -ve">O -ve</option>
      <option value="A +ve">A +ve</option>
      <option value="A -ve">A -ve</option>
      <option value="B +ve">B +ve</option>
      <option value="B -ve">B -ve</option>
      <option value="AB +ve">AB +ve</option>
      <option value="AB -ve">AB -ve</option>
  </select>

  <label for="r_hlatype">HLA Antigens:</label>
  <select name="recipient_hlatypes[]" id="r_hlatype" multiple required>
      <option value="A1">A1</option>
      <option value="A29">A29</option>
      <option value="B12">B12</option>
      <option value="B13">B13</option>
      <option value="DR51">DR51</option>
      <option value="DR52">DR52</option>
      <option value="DR2">DR2</option>
      <option value="DQB1">DQB1</option>
  </select>

  <label for="r_ua">Unacceptable Antigens:</label>
  <select name="recipient_unantigens[]" id="r_ua" multiple required>
      <option value="A1">A1</option>
      <option value="A29">A29</option>
      <option value="B12">B12</option>
      <option value="B13">B13</option>
      <option value="DR51">DR51</option>
      <option value="DR52">DR52</option>
      <option value="DR2">DR2</option>
      <option value="DQB1">DQB1</option>
  </select>

  <label for="h_crossmatch">Historical crossmatch</label>
  <select name="recipient_histcrossmatch" id="h_crossmatch" required>
      <option value="+ve">+ve</option>
      <option value="-ve">-ve</option>
  </select>
      
  </fieldset>

  

  <fieldset id="donor">

  <legend>Donor Information:</legend>

  <label for="d_fname">First Name:</label>
  <input type="text" id="d_fname" name="donor_fname" value="" placeholder="e.g John" pattern="[A-Z][a-z]*" title="Start with uppercase followed by lowercase alphabets" required> 


  <label for="d_lname">Last Name:</label>
  <input type="text" id="d_lname" name="donor_lname" value="" placeholder="e.g Smith" pattern="[A-Z][a-z]*" title="Start with uppercase followed by lowercase alphabets" required> 
  

  <label for="d_age">Age:</label>
  <input type="number" id="d_age" name="donor_age" value="" placeholder="20" required> 
  

  Gender:
  <input type="radio" id="d_male" name="donor_gender" value="male" required>
  <label for="d_male">Male</label>
  <input type="radio" id="d_female" name="donor_gender" value="female">
  <label for="d_female">Female</label>
  <input type="radio" id="d_other" name="donor_gender" value="other">
  <label for="d_other">Other</label>

  <!-- <label>Place of residence:</label>
  <input type="text" name="donor_addr1" value="" placeholder="e.g Address line 1"> 
  <input type="text" name="donor_addr2" value="" placeholder="e.g Address line 2"> 
  <input type="text" name="donor_district" value="" placeholder="e.g Chennai"> 
  <input type="text" name="donor_state" value="" placeholder="e.g TamilNadu"> 
  <input type="number" name="donor_pincode" value="" placeholder="e.g 600001">  -->
  

  <label for="d_btype" id="d_btype_label">Blood Type:</label>
  <select name="donor_btype" id="d_btype" required>
    <option value="O +ve">O +ve</option>
    <option value="O -ve">O -ve</option>
    <option value="A +ve">A +ve</option>
    <option value="A -ve">A -ve</option>
    <option value="B +ve">B +ve</option>
    <option value="B -ve">B -ve</option>
    <option value="AB +ve">AB +ve</option>
    <option value="AB -ve">AB -ve</option>
  </select>

  <label for="d_hlatype">HLA Antigens:</label>
  <select name="donor_hlatypes[]" id="d_hlatype" multiple required>
    <option value="A1">A1</option>
    <option value="A29">A29</option>
    <option value="B12">B12</option>
    <option value="B13">B13</option>
    <option value="DR51">DR51</option>
    <option value="DR52">DR52</option>
    <option value="DR2">DR2</option>
    <option value="DQB1">DQB1</option>
  </select>

  </fieldset>

  

  <fieldset id="hospital">
      <legend>Hospital Information:</legend>

      <label for="hospital_name">Name:</label>
      <select id="hospital_name" name="h_name" required>
          <option value="Dr. Mehta">Dr. Mehta</option>
          <option value="Apollo">Apollo</option>
          <option value="Fortis Malar">Fortis Malar</option>
          <option value="Dr. Kamakshi Memorial">Dr. Kamakshi Memorial</option>
      </select>
  </fieldset>
  
  <button type="submit" name="submit" value="submit">Register</button> 

</form>

</section>

</body>

</html>