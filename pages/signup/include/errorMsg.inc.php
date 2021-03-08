<?php 
  if(isset($_GET["error"])) {
    if ($_GET["error"] === "emptyInputSignup") {
      echo "<p id='failed'>Please fill all the fields</p>";
    }
    else if ($_GET["error"] === "invalidUname") {
      echo "<p id='failed'>Username must contain letters, numbers and underscores only</p>";
    }
    else if ($_GET["error"] === "invalidHospId") {
      echo "<p id='failed'>Invalid hospital id</p>";
    }
    else if ($_GET["error"] === "invalidEmail") {
      echo "<p id='failed'>Invalid email id</p>";
    }
    else if ($_GET["error"] === "noPswdMatch") {
      echo "<p id='failed'>The passwords do not match</p>";
    }
    else if ($_GET["error"] === "unameExists") {
      echo "<p id='failed'>This username is already taken</p>";
    }
    else if ($_GET["error"] === "noHospIdExists") {
      echo "<p id='failed'>Your hospital is not registered with us</p>";
    }
    else if ($_GET["error"] === "hospstmtfailed") {
      echo "<p id='failed'>Something went wrong while checking hospital id</p>";
    }
    else if ($_GET["error"] === "userstmtfailed") {
      echo "<p id='failed'>Something went wrong while creating user</p>";
    }
    else if ($_GET["error"] === "none") {
      echo "<p id='success'>Registration successful!!!</p>";
    }

  }
