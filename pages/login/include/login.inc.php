<?php 

if(isset($_POST["submit"])){
  $uid = $_POST["uid"];
  $pswd = $_POST["pswd"];

  require_once("../../../include/dbConnect.inc.php");
  // require_once("../../../include/functions.inc.php");
  require_once("loginFunctions.inc.php");

  if(emptyInputLogin($uid, $pswd) !== false) {
    header("Location: ../login.php?error=emptyInputLogin");
    exit();
  }

  loginUser($conn, $uid, $pswd);

}

else{
  header("Location: ../login.php");
}