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

section{
  background: #DFCFBE;
}

table {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
}

#recipients{
  width: 80%;
  margin: auto;
} 

#donors{
  width: 60%;
  margin: auto;
}

#hospitals{
  width: 30%;
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

<section class="w3-container w3-section w3-2019-sweet-corn">

  <br><br>

  <h2 id="rh">Recipients</h2>

  <table id="recipients">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Age</th>
      <th>Gender</th>
      <th>Blood Type</th>
      <th>HLA Antigens</th>
      <th>Unacceptable Antigens</th>
      <th>Historic Crossmatch</th>
    </tr>
    
    <?php foreach($result1_array as $row1){ ?>
      <tr>
        <td><?php echo $row1['id'] ?></td>
        <td><?php echo $row1['name'] ?></td>
        <td><?php echo $row1['age'] ?></td>
        <td><?php echo $row1['gender'] ?></td>
        <td><?php echo $row1['blood_type'] ?></td>
        <td><?php echo $row1['hla_antigens'] ?></td>
        <td><?php echo $row1['unacceptable_antigens'] ?></td>
        <td><?php echo $row1['historical_crossmatch'] ?></td>
      </tr>
    <?php } ?>

  </table><br><br>

  <h2 id="dh">Donors</h2>

  <table id="donors">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Age</th>
      <th>Gender</th>
      <th>Blood Type</th>
      <th>HLA Antigens</th>
    </tr>

    
    <?php foreach($result2_array as $row2){ ?>
      <tr>
        <td><?php echo $row2['id'] ?></td>
        <td><?php echo $row2['name'] ?></td>
        <td><?php echo $row2['age'] ?></td>
        <td><?php echo $row2['gender'] ?></td>
        <td><?php echo $row2['blood_type'] ?></td>
        <td><?php echo $row2['hla_antigens'] ?></td>
      </tr>
    <?php } ?>
      
  </table><br><br>

  <h2 id="hh">Hospitals</h2>

  <table id="hospitals">
    <tr>
      <th>ID</th>
      <th>Name</th>
    </tr>


      <?php foreach($result3_array as $row3){ ?>
        <tr>
          <td><?php echo $row3['id'] ?></td>
          <td><?php echo $row3['name'] ?></td>
        </tr>
      <?php } ?>

  </table>

</section>

</body>
</html>