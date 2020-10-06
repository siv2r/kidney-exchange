<?php 

include("templates/db-connect.php");

$sql1 = "SELECT * FROM recipients ORDER BY id";
$sql2 = "SELECT * FROM donors ORDER BY id";
$sql3 = "SELECT * FROM hospitals ORDER BY id";

$result1 = mysqli_query($conn, $sql1);
$result2 = mysqli_query($conn, $sql2);
$result3 = mysqli_query($conn, $sql3);

$result1_array = mysqli_fetch_all($result1, MYSQLI_ASSOC);
$result2_array = mysqli_fetch_all($result2, MYSQLI_ASSOC);
$result3_array = mysqli_fetch_all($result3, MYSQLI_ASSOC);

mysqli_free_result($result1);
mysqli_free_result($result2);
mysqli_free_result($result3);

?>

<!DOCTYPE html>
<html lang="en">

<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-2019.css">

<style>

button {
	background-color: #dcdcdc;
	color: black;
	padding: 10px 20px;
  display: inline-block;
  margin: 10px;
	border: 2px solid #c0c0c0;
	cursor: pointer;
  width: 25%;
	font-size: 18px;
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-radius: 5%;
}

button:hover {
	opacity: 0.8;
}

#button_block{
  float: left;
  text-align: left;
  box-sizing: border-box;
  width: 40%;
  padding: 10px;
  display:block;
}  

body{
  background: #F0FFFF;
}

table {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
}

#recipients_med, #donors_med{
  width: 80%;
  margin: auto;
} 

#recipients_personal, #donors_personal{
  width: 50%;
  margin: auto;
}

#hospitals{
  width: 70%;
  margin: auto;
}

table td, table th {
  border: 1px solid #ddd;
  padding: 8px;
}

table tr:nth-child(even){background-color: #f2f2f2;}

table tr:hover {background-color: #ddd;}

table th {
  padding-top: 10px;
  padding-bottom: 10px;
  text-align: left;
  background-color: #39CCCC;
  color: black;
}

#rh, #dh, #hh {
  text-align: center;
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;

}

</style>

<?php include("templates/header.php"); ?>

  <div id="button_block">
    <button id="personalBtn">Personal info</button>
    <button id="medBtn">Medical info</button>
    <button id="hospBtn">Hospital info</button>
  </div> <br><br><br>

  <div class="personal_tab">

    <h2 id="rh">Recipients</h2>

    <table id="recipients_personal">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Age</th>
        <th>Gender</th>
      </tr>
      
      <?php foreach($result1_array as $row1){ ?>
        <tr>
          <td><?php echo $row1['id'] ?></td>
          <td><?php echo $row1['name'] ?></td>
          <td><?php echo $row1['age'] ?></td>
          <td><?php echo $row1['gender'] ?></td>
        </tr>
      <?php } ?>

    </table>

    <h2 id="dh">Donors</h2>

    <table id="donors_personal">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Age</th>
        <th>Gender</th>
      </tr>

      
      <?php foreach($result2_array as $row2){ ?>
        <tr>
          <td><?php echo $row2['id'] ?></td>
          <td><?php echo $row2['name'] ?></td>
          <td><?php echo $row2['age'] ?></td>
          <td><?php echo $row2['gender'] ?></td>
        </tr>
      <?php } ?>
        
    </table>

  </div>

  <div class="med_tab">

    <h2 id="rh">Recipients</h2>

    <table id="recipients_med">
      <tr>
        <th>ID</th>
        <th>Diabetes Type</th>
        <th>Blood Presuure</th>
        <th>Blood Type</th>
        <th>HLA Antigens</th>
        <th>Unacceptable Antigens</th>
        <th>Historic Crossmatch</th>
      </tr>
      
      <?php foreach($result1_array as $row1){ ?>
        <tr>
          <td><?php echo $row1['id'] ?></td>
          <td><?php echo $row1['diabetes_type'] ?></td>
          <td><?php echo $row1['blood_pressure'] ?></td>
          <td><?php echo $row1['blood_type'] ?></td>
          <td><?php echo $row1['hla_antigens'] ?></td>
          <td><?php echo $row1['unacceptable_antigens'] ?></td>
          <td><?php echo $row1['historical_crossmatch'] ?></td>
        </tr>
      <?php } ?>

    </table>

    <h2 id="dh">Donors</h2>

    <table id="donors_med">
      <tr>
        <th>ID</th>
        <th>Diabetes Type</th>
        <th>GFR</th>
        <th>Blood Pressure</th>
        <th>Blood Type</th>
        <th>HLA Antigens</th>
      </tr>

      
      <?php foreach($result2_array as $row2){ ?>
        <tr>
          <td><?php echo $row2['id'] ?></td>
          <td><?php echo $row2['diabetes_type'] ?></td>
          <td><?php echo $row2['gfr'] ?></td>
          <td><?php echo $row2['blood_pressure'] ?></td>
          <td><?php echo $row2['blood_type'] ?></td>
          <td><?php echo $row2['hla_antigens'] ?></td>
        </tr>
      <?php } ?>
        
    </table>

  </div>

  <div class="hosp_tab">
    <h2 id="hh">Hospitals Registered</h2>

    <table id="hospitals">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Address</th>
        <th>Type</th>
        <th>License</th>
        <th>Nephrologist</th>
        <th>Nephrologist ID</th>
        <th>Surgeon</th>
        <th>Surgeon ID</th>
      </tr>


        <?php foreach($result3_array as $row3){ ?>
          <tr>
            <td><?php echo $row3['id'] ?></td>
            <td><?php echo $row3['name'] ?></td>
            <td><?php echo $row3['addr'] ?></td>
            <td><?php echo $row3['type'] ?></td>
            <td><?php echo $row3['license'] ?></td>
            <td><?php echo $row3['nephro_name'] ?></td>
            <td><?php echo $row3['nephro_id'] ?></td>
            <td><?php echo $row3['surg_name'] ?></td>
            <td><?php echo $row3['surg_id'] ?></td>
          </tr>
        <?php } ?>

    </table>
  </div>

</section>

<script src="scripts/admin.js"></script>

</body>
</html>