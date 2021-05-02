<?php
if (!isset($_SESSION)) {
  session_start();
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<style>
  * {
    margin: 0%;
    padding: 0%;
    box-sizing: border-box;
  }

  nav {
    background-color: rgb(0, 0, 0, 0.2);
    font-family: "Open Sans";
    line-height: 1em;
    display: flex;
    justify-content: space-around;
    align-items: center;
    min-height: 7vh;
  }


  .logo {
    text-decoration: none;
    text-transform: uppercase;
    color: #fff;
    letter-spacing: 4px;
    /* padding: 26px; */
    font-size: 24px;
    font-weight: 600;
    padding: 0px;
  }

  .brand_logo
  {
    float:left;
  }

  .brand_title
  {
    float:left;
    margin-top:30px;
    margin-left:20px;
  }

  .nav-links {
    display: flex;
    font-size: 18px;
  }

  .nav-links li {
    list-style: none;
  }

  .nav-links li a {
    display: block;
    text-decoration: none;
    text-transform: uppercase;
    color: #fff;
    letter-spacing: 3px;
    padding: 26px;
    transition: all ease 0.5s;
  }

  .nav-links li ul {
    display: none;
    position: absolute;
    border-radius: 0px 0px 4px 4px;
    background-color: rgb(0, 0, 0, 0.2);
  }

  .nav-links li:hover ul {
    display: block;
  }

  .nav-links li ul li {
    display: block;
    width: 180px;
  }

  .nav-links li a:hover {
    background-color: #a28089;
  }

  
    

</style>
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <img src="/kidney-exchange/images/logo3.png" class="brand_logo" width="100px" hight="100px">
    <a class="navbar-brand" href="/kidney-exchange/">KIDNEY EXCHANGE</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <?php
          if (isset($_SESSION['userId'])) {
            echo '<li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Register
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/kidney-exchange/pages/reg-form.php">Patient</a></li>';
              if ($_SESSION['userType'] === "Admin") {
                echo '<li><a class="dropdown-item" href="/kidney-exchange/pages/register_hospital.php">Hospital</a></li>';
              } 
            echo '</ul>
                  </li>';

              
            echo '<li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  MATCH
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="/kidney-exchange/pages/pairwiseMatch.php">PAIRWISE</a></li>
                  <li><a class="dropdown-item" href="/kidney-exchange/pages/globalMatch.php">gLOBAL</a></li>
                  </ul>
                    </li>';

             
            echo '<li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              DATA
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="/kidney-exchange/pages/dataOverview.php">Overview</a></li>
            <li><a class="dropdown-item" href="/kidney-exchange/pages/dataSummary.php">Summary</a></li>
            <li><a class="dropdown-item" href="/kidney-exchange/pages/dataSearch.php">Search</a></li>
      
              </ul>
                </li>';
            
                if ($_SESSION['userType'] === "Admin") {
                  echo '<li><a class="nav-link" href="/kidney-exchange/pages/jsonData.php">Json</a></li>';
                } 
                echo '<li><a class="nav-link" href="/kidney-exchange/include/logout.inc.php">Logout</a></li>';
               }
          else {
            echo '<li class="nav-item">
                  <a class="nav-link" href="/kidney-exchange/pages/login.php">Login</a>
                  </li>';
            echo '<li class="nav-item">
                  <a class="nav-link" href="/kidney-exchange/pages/signup.php">Sign Up</a>
                  </li>';

          }
        ?>
      </ul>
      
    </div>
  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>