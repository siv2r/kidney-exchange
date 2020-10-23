<?php
session_start();
?>
<style>
  * {
    margin: 0%;
    padding: 0%;
  }

  nav {
    width: 100%;
    background-color: rgb(0, 0, 0, 0.2);
    /* not reflecting in the page */
    font-family: "Open Sans";
    font-size: 18px;
    line-height: 1em;
  }

  /* nav ul{
    text-align: left;
  } */

  .nav-wrap {
    width: 80%;
    margin: auto;
  }

  nav p {
    text-decoration: none;
    text-transform: uppercase;
    color: #fff;
    letter-spacing: 2px;
    padding: 22px;
    float: left;
    font-size: 20px;
  }

  nav ul {
    float: left;
  }

  nav ul li {
    list-style: none;
    /* display: inline-block; */
    float: left;
    position: relative;
  }

  nav ul.right-align {
    float: right;
  }

  nav:after {
    content: "";
    clear: both;
    display: block;
  }

  nav ul li a {
    display: block;
    text-decoration: none;
    text-transform: uppercase;
    color: #fff;
    letter-spacing: 2px;
    padding: 22px;
    transition: all ease 0.5s;
  }

  nav ul li ul {
    display: none;
    position: absolute;
    border-radius: 0px 0px 4px 4px;
    background-color: rgb(0, 0, 0, 0.2);
  }

  nav ul li:hover ul {
    display: block;
  }

  nav ul li ul li {
    display: block;
    width: 180px;
  }

  nav ul li a:hover {
    background-color: #a28089;
  }
</style>

<nav>
  <div class="nav-wrap">
    <p>Kidney Exchange</p>
    <ul>
      <li><a href="../index.php">Home</a></li>
      <li><a href="#">About</a></li>
      <li><a href="#">Contact</a></li>
    </ul>

    <?php
    if (isset($_SESSION['userId'])) {
      echo '<ul>';
      echo   '<li><a href="#">Register</a>';
      echo     '<ul>';
      echo       '<li><a href="reg-form.php">Patient</a></li>';
      if (isset($_SESSION['userId']) && $_SESSION['userType'] === "Admin") {
        echo       '<li><a href="register_hospital.php">Hospital</a></li>';
      }
      echo     '</ul>';
      echo   '</li>';
      echo   '<li><a href="#">Data</a>';
      echo     '<ul>';
      echo       '<li><a href="dataOverview.php">Overview</a></li>';
      echo       '<li><a href="dataSummary.php">Summary</a></li>';
      echo       '<li><a href="dataSearch.php">Search</a></li>';
      echo     '</ul>';
      echo   '</li>';
      echo '</ul>';
      echo '<ul class="right-align">';
      echo   '<li><a href="#">Profile</a></li>';
      echo   '<li><a href="../include/logout.inc.php">Logout</a></li>';
      echo '</ul>';
    } else {
      echo '<ul class="right-align">';
      echo   '<li><a href="login.php">Login</a></li>';
      echo   '<li><a href="signup.php">Sign Up</a></li>';
      echo '</ul>';
    }
    ?>
  </div>
</nav>