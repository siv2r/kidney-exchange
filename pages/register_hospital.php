<link rel="stylesheet" href="../css/form-style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/backToTop.css">
<style>
@import url(https://fonts.googleapis.com/css?family=Open+Sans);

body{
	margin: 0;
	/* background-image: url("../images/register.jpg"); */
	/* opacity: 0.9;
  background-size: 300%; */
  font-family: "Open Sans";
}

#hospForm {
	box-sizing: border-box;
	background-color: #ffff;
	border: 3px solid #f1f1f1;
}

.label-box{
  flex: 2.5 0 0;
  text-align: right;
  padding: 5px 10px;
  font-size: 22px;
  line-height: 1.6em;
}

.input-box{
  flex: 7 0 0;
  padding: 5px 10px;
}

.input-box .single{
  width: 80%;
}

.input-box .double{
  width: 39%;
}



/* input[type="text"], input[type="number"], select{
  color: #333333;
  background-color: #eeeeee;
  border: 1px solid #dddddd;
  border-radius: 5%;
  cursor: pointer;
} */

legend{
  font-weight: bold;
  font-size: 20px;
  letter-spacing: 0.5px;
  text-transform: uppercase;
}

/* input:focus, input:hover, select:focus, select:hover{
  outline: none;
  border: 1px solid #aaaaaa;
}  */


/* fieldset{
  padding: 0px 20px 20px 20px;
  margin: 20px;
} */

#hospForm button {
	background-color: darkgrey;
	color: black;
	padding: 10px 20px;
  display: inline-block;
  margin: auto;
	border: none;
	cursor: pointer;
  width: 30%;
  font-size: 20px;
  justify-content: center;
}

button:hover {
	opacity: 0.8;
}

.header-img{
  /* background-image: url("https://images.unsplash.com/photo-1502485019198-a625bd53ceb7?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80");  */
  background-image: url(../images/darkBackground.jpg);
  background-size: cover;
  background-position: top;
  position: relative;
  min-height: 400px;
}

#hosp-heading{
  color: #fff;
  letter-spacing: 2px;
  font-weight: 600;
  text-transform: uppercase;
}

/* ---------------------Coustom Error Class------------ */

.has-error{
  border: 1px solid #c51244;
  background-color: #fff0f4;
}

.help-block{
  color: #c51244;
  font-size: 18px;
  display: inline-block;
  width: 60%;
}

label.required{
  content:"*";
  color: red;
}

@media screen and (max-width: 992px) {
  .label-box{
  flex: 2.5 0 0;
  text-align: left;
  padding: 5px 10px;
  font-size: 22px;
  line-height: 1.6em;
}
}

</style>

<?php include "../templates/header.php";?>
<!-- Back to top button -->
<a id="button" style="text-decoration:none"></a>
  <div class="header-img">
      <?php include "../templates/navBar.php";?>
    <h2 id="hosp-heading" class="text-center mt-5 pt-5">Hospital form</h2>
  </div>

  <div class="container col-lg-9 col-sm-12">
    <form action="../include/getHosp.inc.php" method="POST" id="hospForm">

      <fieldset>
        <legend class="text-center mt-5">Hospital Information</legend>

        <div class='input-field'>
          <div class="label-box">
            <label>Name</label>
            <label class="required">* </label>
          </div>
          <div class="input-box">
            <input type="text" name="h_name" value="" class="single requiredField">
          </div >
        </div>

        <div class='input-field addr'>
          <div class="label-box">
            <label>Address  </label>
            <label class="required">* </label>
          </div>
          <div class="input-box">
            <input type="text" name="h_addr1" value="" placeholder="e.g Address line 1" class="requiredField single">
            <input type="text" name="h_addr2" value="" placeholder="e.g Address line 2" class="requiredField single">
            <input type="text" name="h_city" value="" placeholder="e.g Chennai" class="requiredField double">
            <input type="text" name="h_state" value="" placeholder="e.g TamilNadu" class="requiredField double">
            <input type="number" name="h_pincode" value="" placeholder="e.g 600001" class="requiredField double">
            <input type="text"  name="h_country" value="" placeholder="e.g India" class="requiredField double">
          </div>
        </div>

        <div class="input-field">
          <div class="label-box">
            <label for="type" id="type">Type</label>
            <label class="required">* </label>
          </div>
          <div class="input-box">
            <select name="h_type" class="requiredField single">
              <option value="" selected disabled>Choose</option>
              <option value="Government">Government</option>
              <option value="Private (Govn insured)">Private (Govn insured)</option>
              <option value="Private">Private</option>
            </select>
          </div>
        </div>

        <div class="input-field">
          <div class="label-box">
            <label>License Information</label>
            <label class="required">* </label>
          </div>
          <div class="input-box">
            <input type="text" name="h_license" class="requiredField single">
          </div>
        </div>

      </fieldset>

      <fieldset>
        <legend class="text-center mt-5">Nephrologist Information</legend>

        <div class='input-field'>
          <div class="label-box">
            <label>Name</label>
            <label class="required">* </label>
          </div>
          <div class="input-box">
            <input type="text" name="nephro_fname" value="" class="double requiredField">
            <input type="text" name="nephro_lname" value="" class="double requiredField">
          </div >
        </div>

        <div class="input-field">
          <div class="label-box">
            <label>ID</label>
            <label class="required">* </label>
          </div>
          <div class="input-box">
            <input type="text" name="nephro_id" value="" class="single requiredField">
          </div>
        </div>
      </fieldset>

      <fieldset>
        <legend class="text-center mt-5">Surgeon Information</legend>

        <div class='input-field'>
          <div class="label-box">
            <label>Name</label>
            <label class="required">* </label>
          </div>
          <div class="input-box">
            <input type="text" name="surg_fname" value="" class="double requiredField">
            <input type="text" name="surg_lname" value="" class="double requiredField">
          </div >
        </div>

        <div class="input-field">
          <div class="label-box">
            <label>ID</label>
            <label class="required">* </label>
          </div>
          <div class="input-box">
            <input type="text" name="surg_id" value="" class="single requiredField">
          </div>
        </div>
      </fieldset>

      <div class="input-field">
        <button type="button" name="submitBtn" value="submitBtn" id="submitBtn" class="mx-auto">Submit</button>
      </div>

    <form>
  </div>

  <script src="../js/validateHosp.js"></script>
  <script src="../js/backToTop.js"></script>
  <?php 
  require_once "../include/footer.inc.php";
