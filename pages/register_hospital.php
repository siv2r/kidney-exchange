<?php



// Array ( [hosp_name] => Fortis Malar [hosp_addr1] => No. 52, 1st Main Rd, Gandhi Nagar [hosp_addr2] => Adyar [hosp_district] => Chennai [hosp_state] => Tamil Nadu [hosp_pincode] => 600020 [hosp_type] => Private [hosp_license] => TN#17654 [nephro_fname] => Pradeep [nephro_lname] => Rajashekar [nephro_id] => FM#154 [surg_fname] => Anirudh [surg_lname] => Tiwari [surg_id] => FM#162 [submit] => submit )

if(isset($_POST['submit'])){

  $insertion = "";
  $error = "";
  $id = "";

  //hospital info
  $hosp_name = $_POST['hosp_name'];
  $hosp_addr = "{$_POST['hosp_addr1']}, {$_POST['hosp_addr2']}, {$_POST['hosp_district']}, {$_POST['hosp_state']} {$_POST['hosp_pincode']}";
  $hosp_type = $_POST['hosp_type'];
  $hosp_license = $_POST['hosp_license'];
  $nephro_name = "{$_POST['nephro_fname']} {$_POST['nephro_lname']}";
  $nephro_id = $_POST['nephro_id'];
  $surg_name = "{$_POST['surg_fname']} {$_POST['surg_lname']}";
  $surg_id = $_POST['surg_id'];


	//connecting to database
  include("../templates/db-connect.php");
  
  //check if this hospital record is present in the database
  $sql_check = "SELECT EXISTS (SELECT * FROM hospitals WHERE license='$hosp_license' LIMIT 1)";
  $check_result = mysqli_query($conn, $sql_check);
  if(!$check_result) $error = 'Dabase check error'. mysqli_error($conn);
  $check_result_array = mysqli_fetch_array($check_result, MYSQLI_NUM);

//  print_r($check_result_array);

  if($check_result_array[0] == 0){
    $insertion = "done";
    //insert the values if not present
    $sql_insert = "INSERT INTO hospitals(`name`, `addr`, `type`, `license`, `nephro_name`, `nephro_id`, `surg_name`, `surg_id`) VALUES ('$hosp_name', '$hosp_addr', '$hosp_type', '$hosp_license', '$nephro_name', '$nephro_id', '$surg_name', '$surg_id')";

    if(!mysqli_query($conn, $sql_insert)){
      $insertion = "";
      echo 'Insetion query error' . mysqli_error($conn);
    }

  }

  $id_query = "SELECT id FROM hospitals WHERE license='$hosp_license' LIMIT 1";
  $id_query_result = mysqli_query($conn, $id_query);
  if(!$id_query_result) $error = 'id query error'. mysqli_error($conn);
  $id_query_result_array  = mysqli_fetch_array($id_query_result, MYSQLI_NUM);

  $id = $id_query_result_array[0];

}

?>


<!DOCTYPE html>

<html lang="en">

<style>

body{
	margin: 0;
	background-image: url("../images/register.jpg");
	opacity: 0.9;
  background-size: 300%;
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

legend{
  font-weight: bold;
  font-size: 20px;
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

#regHeader{
	text-align: center;
}

label{
  box-sizing: border-box;
  display: inline-block;
  margin-top: 20px;
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
  margin-left: 37%;
}

button:hover {
	opacity: 0.8;
}

#reg_success {
  font-size: 22px;
  color: green;
  text-align: center;
  font-weight: bold;
}

#reg{
  font-size: 22px;
  color: orange;
  text-align: center;
  font-weight: bold;
}

#reg_fail{
  font-size: 22px;
  color: red;
  text-align: center;
  font-weight: bold;
}

#your_id{
  font-size: 22px;
	text-align: center;
  font-weight: bold;
}

</style>

<?php include("../templates/header.php"); ?>

  <form action="#" method="POST" id="regForm">

  <?php if(!empty($insertion) && !empty($id)) { ?>
    <p id="reg_success">Registration successful!</p>
    <p id="reg_success"><?php echo "Your Hospital id : '$id' ";  ?></p>
  <?php } else if(empty($insertion) && !empty($id)) { ?>
    <p id="reg">Your hospital is already registered</p>
    <p id="reg"><?php echo "Your Hospital id : '$id' ";  ?></p>
  <?php } else if(!empty($error)) { ?>
    <p id="reg_fail">Registration Failed!</p>
    <p id="reg_fail"><?php echo "Please try again afterwards";  ?></p>
  <?php } ?>

  <h2 id="regHeader">Registration Form (Hospital)</h2>

  <fieldset>
  <legend>Hospital Information</legend>

  <label for="hoso">Name:</label>
	<input type="text" id="hosp_name" name="hosp_name" value="" placeholder="Dr. Mehta"  pattern="[A-Z][a-zA-z._ ]*" title="Start with uppercase and Do not use apostophe" required>

	<label>Address:</label>
	<input type="text" name="hosp_addr1" value="" placeholder="e.g Address line 1" required>
	<input type="text" name="hosp_addr2" value="" placeholder="e.g Address line 2" required>
	<input type="text" name="hosp_district" value="" placeholder="e.g Chennai" required>
	<input type="text" name="hosp_state" value="" placeholder="e.g TamilNadu" required>
	<input type="number" name="hosp_pincode" value="" placeholder="e.g 600001" required> 


	<label for="type" id="type">Type:</label>
	<select name="hosp_type" required>
			<option value="" selected="true" disabled="disabled">Choose</option>
			<option value="Government">Government</option>
			<option value="Private (Govn insured)">Private (Govn insured)</option>
			<option value="Private">Private</option>
  </select>
  
  <label>License Information:</label>
  <input type="text" name="hosp_license" value="" required>

  </fieldset>
  
  <fieldset>
    <legend>Nephrologist Information</legend>

    <label for="nephro_fname">First Name:</label>
    <input type="text" id="nephro_fname" name="nephro_fname" value="" placeholder="e.g John"  pattern="[A-Z][a-z]*" title="Start with uppercase followed by lowercase alphabets" required>


    <label for="nephro_lname">Last Name:</label>
    <input type="text" id="nephro_lname" name="nephro_lname" value="" placeholder="e.g Smith" pattern="[A-Z][a-z]*" title="Start with uppercase followed by lowercase alphabets" required>

    <label>ID:</label>
	  <input type="text" name="nephro_id" value="" required>
  </fieldset>

  <fieldset>
    <legend>Surgeon Information</legend>

    <label for="surg_fname">First Name:</label>
    <input type="text" id="surg_fname" name="surg_fname" value="" placeholder="e.g John"  pattern="[A-Z][a-z]*" title="Start with uppercase followed by lowercase alphabets" required>


    <label for="surg_lname">Last Name:</label>
    <input type="text" id="surg_lname" name="surg_lname" value="" placeholder="e.g Smith" pattern="[A-Z][a-z]*" title="Start with uppercase followed by lowercase alphabets" required>

    <label>ID:</label>
	  <input type="text" name="surg_id" value="" required> 
  </fieldset>

  <button type="submit" name="submit" value="submit">Submit</button>
  
</form>

</body>

</html>