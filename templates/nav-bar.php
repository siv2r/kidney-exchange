
<style>
  @import url(https://fonts.googleapis.com/css?family=Open+Sans);

  nav{
    width: 100%;
    background-color: rgb(0, 0, 0, 0.2);
    font-family: "Open Sans";
    font-size: 18px;
    line-height: 1em;
  }

  nav ul{
    text-align: center;
    margin: 0%;
  }

  nav ul li{
    list-style: none;
    display: inline-block;
  }

  nav ul li a{
    display: block;
    text-decoration: none;
    text-transform: uppercase;
    color: #fff;
    letter-spacing: 2px;
    padding: 22px;
    transition: all ease 0.5s;
  }

  nav ul li a:hover{
    background-color: #a28089; 
  }
</style>

<?php 
session_start();
?>

<nav>
  <ul>
    <li><a href="../index.php">Home</a></li>
    <li><a href="#">About</a></li>
    <li><a href="#">Contact</a></li>    
    <?php 
      if (isset($_SESSION['userId']) && $_SESSION['userType'] === "Admin") {
        echo '<li><a href="register_hospital.php">Register (Hospital)</a></li>';
      }

      if (isset($_SESSION['userId'])) {
        echo '<li><a href="reg-form.php">Register (Patient)</a></li>';
        echo '<li><a href="data.php">Data</a></li>';
        echo '<li id="login"><a href="#">Profile</a></li>';
        echo '<li id="login"><a href="../include/logout.inc.php">Logout</a></li>';
      }

      else {
        echo '<li id="login"><a href="login.php">Login</a></li>';
        echo '<li id="login"><a href="signup.php">Sign Up</a></li>';
      }
    ?>
  </ul>
</nav>