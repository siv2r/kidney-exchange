<!--this file conatins the neccessary variables -->
<?php require_once("../include/hlaValues.inc.php"); ?> 

<div class='input-field'> 
  <div class="label-box">
    <label>HLA Antigens</label>
  </div>
  <div class="input-box">
    <div class="antigen">

      <label for="r_hla_a"> A
        <label class="required">*</label>
      </label>
      
      <select class="beautify requiredField single" id="r_hla_a" name="r_hla_a[]" multiple>  <!-- added requiredField class -->
        <?php
          foreach ($HlaA as $value) {
            echo "<option value='$value'>$value</option>"; 
          }
        ?>
      </select>
    </div>


    <div class="antigen">
      <label for="r_hla_b"> B
        <label class="required">*</label>
      </label>

      <select class="beautify requiredField single" id="r_hla_b" name="r_hla_b[]" multiple> <!-- added requiredField class -->
        <?php
          foreach ($HlaB as $value) {
            echo "<option value='$value'>$value</option>"; 
          }
        ?>
      </select>
    </div>

    <div class="antigen">
      <label for="r_hla_dr">DR
        <label class="required">*</label>
      </label>

      <select class="beautify single requiredField" id="r_hla_dr" name="r_hla_dr[]" multiple>   <!-- added requiredField class -->
        <?php
          foreach ($HlaDR as $value) {
            echo "<option value='$value'>$value</option>"; 
          }
        ?>
      </select>
    </div>

    <div class="antigen">
      <label for="r_hla_c"> C</label>
      <select class="beautify single" id="r_hla_c" name="r_hla_c[]" multiple>
        <?php
          foreach ($HlaC as $value) {
            if ($value == "None") {
              echo "<option value=''>$value</option>";
            }
            else {
              echo "<option value='$value'>$value</option>";
            }
          }
        ?>
      </select>
    </div>

    <div class="antigen">
      <label for="r_hla_dq">DQ</label>
      <select class="beautify single" id="r_hla_dq" name="r_hla_dq[]" multiple>
        <?php
          foreach ($HlaDQ as $value) {
            if ($value == "None") {
              echo "<option value=''>$value</option>";
            }
            else {
              echo "<option value='$value'>$value</option>";
            }
          }
        ?>
      </select>
    </div>

    <div class="antigen">
      <label for="r_hla_dp">DP</label>
      <select class="beautify single" id="r_hla_dp" name="r_hla_dp[]" multiple>
        <?php
          foreach ($HlaDP as $value) {
            if ($value == "None") {
              echo "<option value=''>$value</option>";
            }
            else {
              echo "<option value='$value'>$value</option>";
            }
          }
        ?>
      </select>
    </div>
  </div>
</div>


<div class="input-field">
  <div class="label-box">
    <label for="r_hla-report" class="label-box">HLA report</label>
    <label class="required">* </label>
  </div>     
  <div class="input-box">
    <input type="file" id="r_hla-report" name="r_hla-report" class="requiredField single">
  </div>
</div>


<div class='input-field'> 
  <div class="label-box">
    <label>Unacceptable Antigens</label>
  </div>

  <div class="input-box">
    <div class="antigen">
      <label for="r_ua_a"> A</label>
      <select class="beautify single" id="r_ua_a" name="r_ua_a[]" multiple>
        <?php
          foreach ($HlaA as $value) {
            if ($value == "Null") {
              echo "<option value=''>None</option>";
            }
            else {
              echo "<option value='$value'>$value</option>";
            }
          }
        ?>
      </select>
    </div>

    <div class="antigen">
      <label for="r_ua_b"> B</label>
      <select class="beautify single" id="r_ua_b" name="r_ua_b[]" multiple>
        <?php
          foreach ($HlaB as $value) {
            if ($value == "Null") {
              echo "<option value=''>None</option>";
            }
            else {
              echo "<option value='$value'>$value</option>";
            }
          }
        ?>
      </select>
    </div>

    <div class="antigen">
      <label for="r_ua_dr">DR</label>
      <select class="beautify single" id="r_ua_dr" name="r_ua_dr[]" multiple>
        <?php
          foreach ($HlaDR as $value) {
            if ($value == "Null") {
              echo "<option value=''>None</option>";
            }
            else {
              echo "<option value='$value'>$value</option>";
            }
          }
        ?>
      </select>
    </div>

    <div class="antigen">
      <label for="r_ua_c"> C</label>
      <select class="beautify single" id="r_ua_c" name="r_ua_c[]" multiple>
        <?php
          foreach ($HlaC as $value) {
            if ($value == "None") {
              echo "<option value=''>$value</option>";
            }
            else {
              echo "<option value='$value'>$value</option>";
            }
          }
        ?>
      </select>
    </div>

    
    <div class="antigen">
      <label for="r_ua_dq">DQ</label>
      <select class="beautify single" id="r_ua_dq" name="r_ua_dq[]" multiple>
        <?php
          foreach ($HlaDQ as $value) {
            if ($value == "None") {
              echo "<option value=''>$value</option>";
            }
            else {
              echo "<option value='$value'>$value</option>";
            }
          }
        ?>
      </select>
    </div>

    <div class="antigen">
      <label for="r_ua_dp">DP</label>
      <select class="beautify single" id="r_ua_dp" name="r_ua_dp[]" multiple>
        <?php
          foreach ($HlaDP as $value) {
            if ($value == "None") {
              echo "<option value=''>$value</option>";
            }
            else {
              echo "<option value='$value'>$value</option>";
            }
          }
        ?>
      </select>
    </div>
  </div>
</div>

<div class="input-field">
  <div class="label-box">
    <label for="r_ua-report">DSA report</label>  
    <label class="required">* </label>
  </div>   
  <div class="input-box">
    <input type="file" id="r_ua-report" name="r_ua-report" class="requiredField single">
  </div>
</div>
