<!-- get the data for given input pair from the database -->
<?php require_once("include/getData.inc.php")?>

<!DOCTYPE html>
<html lang="en">
<style>

/* --------------------Background--------------------------- */
  body{
    background-color: whitesmoke;
    background-repeat: no-repeat;
    background-size: cover;
  } 

  .nav-container{
    position: static;
  }

  img {
    border: 1px solid silver;
    display: block;
    margin: 20px 10% 20px 70%;
  }

  .heading {
    text-align: center;
    margin-top: 50px;
  }

  body {
    font-size: 20px;
  }

  button {
    background-color: #dcdcdc;
    color: black;
    padding: 10px 20px;
    display: inline-block;
    margin: 5px;
    cursor: pointer;
    font-size: 22px;
    border-radius: 5%;
    outline: none;
    border: none;
    width: 20%;
  }

  table {
    border-collapse: collapse;
    width: 80%;
    margin: auto;
    background-color: white;
    padding: 20px;
  }

  table td, table th {
    border: 1px solid #ddd;
    padding: 12px;
  }

  table tr:nth-child(even){background-color: #f2f2f2;}

  table tr:hover {background-color: #ddd;}

  table th {
    padding-top: 10px;
    padding-bottom: 10px;
    text-align: right;
    color: black;
    width: 35%;
    letter-spacing: 1px;
  }
</style>


<?php include("../templates/header.php") ?>

  <div class="nav-container">
    <?php include("../templates/nav-bar.php") ?>
  </div>

  <div class="wrapper">
    <button id="patientBtn">Patient</button>
    <button id="donorBtn">Donor</button>

    <div class="patient">
      <h2 class="heading">Patient data</h2>
      <img src="data:image/jpeg;base64,<?php echo base64_encode($pFiles['profile_pic']); ?>" width="183px" height="183px">
      <table>
        <tr>
          <th>Id</th>
          <td><?php echo $pData['id'] ?></td>
        </tr>
        <tr>
          <th>Name</th>
          <td><?php echo $pData['name'] ?></td>
        </tr>
        <tr>
          <th>Sex</th>
          <td><?php echo $pData['sex'] ?></td>
        </tr>
        <tr>
          <th>Date of Birth</th>
          <td><?php echo $pData['dob'] ?></td>
        </tr>
        <tr>
          <th>Height</th>
          <td><?php echo $pData['height'] ?></td>
        </tr>
        <tr>
          <th>Weight</th>
          <td><?php echo $pData['weight'] ?></td>
        </tr>
        <tr>
          <th>BMI</th>
          <td><?php echo $pBMI ?></td>
        </tr>
        <tr>
          <th>Blood Group</th>
          <td><?php echo $pData['blood_group'] ?></td>
        </tr>
        <tr>
          <th>Address</th>
          <td><?php echo $pData['address'] ?></td>
        </tr>
        <tr>
          <th>Contact No</th>
          <td><?php echo $pData['contact_number'] ?></td>
        </tr>
        <tr>
          <th>Email</th>
          <td><?php echo $pData['email'] ?></td>
        </tr>
        <tr>
          <th>HLA Antigens</th>
          <td><?php echo $pData['hla_antigens'] ?></td>
        </tr>
        <tr>
          <th>Unacceptable Antigens</th>
          <td><?php echo $pData['ua_antigens'] ?></td>
        </tr>
        <tr>
          <th>Basic Disease</th>
          <td><?php echo $pData['basic_disease'] ?></td>
        </tr>
        <tr>
          <th>Genetic/Renal Biopsy</th>
          <td><?php echo $pData['gr_biopsy'] ?></td>
        </tr>
        <tr>
          <th>Comorbid Condt</th>
          <td><?php echo $pData['comorb'] ?></td>
        </tr>
        <tr>
          <th>HIV</th>
          <td><?php echo $pData['hiv'] ?></td>
        </tr>
        <tr>
          <th>Hepatitis B</th>
          <td><?php echo $pData['hep_b'] ?></td>
        </tr>
        <tr>
          <th>Hepatitis C</th>
          <td><?php echo $pData['hep_c'] ?></td>
        </tr>
        <tr>
          <th>Previous Transplant</th>
          <td><?php echo $pData['prev_transp'] ?></td>
        </tr>
        <tr>
          <th>Dialysis</th>
          <td><?php echo $pData['dialysis'] ?></td>
        </tr>
        <tr>
          <th>Deceased Donor Program</th>
          <td><?php echo $pData['dd_program'] ?></td>
        </tr>
        <tr>
          <th>Primary Nephrologist</th>
          <td><?php echo $pData['prime_nephro'] ?></td>
        </tr>
        <tr>
          <th>Hospital</th>
          <td><?php echo $pData['hospital'] ?></td>
        </tr>
        <tr>
          <th>Provisional Clearance</th>
          <td><?php echo $pData['prov_clearance'] ?></td>
        </tr>
        <tr>
          <th>Pre Transplant Surgery</th>
          <td><?php echo $pData['pre_transp_surgery'] ?></td>
        </tr>
        <tr>
          <th>Created at</th>
          <td><?php echo $pCreated ?></td>
        </tr>
        <tr>
          <th>Updated at</th>
          <td><?php echo $pUpdated ?></td>
        </tr>
      </table>
    </div>
    
    <div class="donor">
      <h2 class="heading">Donor data</h2>
      <img src="data:image/jpeg;base64,<?php echo base64_encode($dFiles['profile_pic']); ?>" width="183px" height="183px">
      <table>
        <tr>
          <th>Id</th>
          <td><?php echo $dData['id'] ?></td>
        </tr>
        <tr>
          <th>Name</th>
          <td><?php echo $dData['name'] ?></td>
        </tr>
        <tr>
          <th>Sex</th>
          <td><?php echo $dData['sex'] ?></td>
        </tr>
        <tr>
          <th>Date of Birth</th>
          <td><?php echo $dData['dob'] ?></td>
        </tr>
        <tr>
          <th>Height</th>
          <td><?php echo $dData['height'] ?></td>
        </tr>
        <tr>
          <th>Weight</th>
          <td><?php echo $dData['weight'] ?></td>
        </tr>
        <tr>
          <th>BMI</th>
          <td><?php echo $dBMI ?></td>
        </tr>
        <tr>
          <th>Blood Group</th>
          <td><?php echo $dData['blood_group'] ?></td>
        </tr>
        <tr>
          <th>Relation to patient</th>
          <td><?php echo $dData['relation'] ?></td>
        </tr>
        <tr>
          <th>Address</th>
          <td><?php echo $dData['address'] ?></td>
        </tr>
        <tr>
          <th>Contact No</th>
          <td><?php echo $dData['contact_number'] ?></td>
        </tr>
        <tr>
          <th>Email</th>
          <td><?php echo $dData['email'] ?></td>
        </tr>
        <tr>
          <th>HLA Antigens</th>
          <td><?php echo $dData['hla_antigens'] ?></td>
        </tr>
        <tr>
          <th>Comorbid Condt</th>
          <td><?php echo $dData['comorb'] ?></td>
        </tr>
        <tr>
          <th>HIV</th>
          <td><?php echo $dData['hiv'] ?></td>
        </tr>
        <tr>
          <th>Hepatitis B</th>
          <td><?php echo $dData['hep_b'] ?></td>
        </tr>
        <tr>
          <th>Hepatitis C</th>
          <td><?php echo $dData['hep_c'] ?></td>
        </tr>
        <tr>
          <th>Alcohol</th>
          <td><?php echo $dData['alcohol'] ?></td>
        </tr>
        <tr>
          <th>Smoking</th>
          <td><?php echo $dData['smoking'] ?></td>
        </tr>
        <tr>
          <th>Provisional Clearance</th>
          <td><?php echo $dData['prov_clearance'] ?></td>
        </tr>
        <tr>
          <th>Created at</th>
          <td><?php echo $dCreated ?></td>
        </tr>
        <tr>
          <th>Updated at</th>
          <td><?php echo $dUpdated ?></td>
        </tr>
      </table>
    </div>
  </div>
  <script src="../scripts/pairData.js"></script>       
</body>
</html>