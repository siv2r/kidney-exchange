<!--this file conatins the neccessary variables -->
<?php require_once("../include/hlaValues.inc.php"); ?> 

<div class='input-field'> 
  <div class="label-box">
    <label>HLA Antigens   </label>
  </div>
  <div class="input-box">
    <div class="antigen">
      <label for="d_hla_a"> A  
        <label class="required">*</label>
      </label>

      <select class="beautify requiredField single" id="d_hla_a" name="d_hla_a[]" multiple>  <!-- added requiredField class -->
        <?php
          foreach ($HlaA as $value) {
            echo "<option value='$value'>$value</option>"; 
          }
        ?>
      </select>
    </div>


    <div class="antigen">
      <label for="d_hla_b"> B
        <label class="required">*</label>
      </label>
      <select class="beautify requiredField single" id="d_hla_b" name="d_hla_b[]" multiple> <!-- added requiredField class -->
        <?php
          foreach ($HlaB as $value) {
            echo "<option value='$value'>$value</option>"; 
          }
        ?>
      </select>
    </div>

    <div class="antigen">
      <label for="d_hla_dr">DR
        <label class="required">*</label>
      </label>
      <select class="beautify single requiredField" id="d_hla_dr" name="d_hla_dr[]" multiple>   <!-- added requiredField class -->
      <?php
        foreach ($HlaDR as $value) {
          echo "<option value='$value'>$value</option>"; 
        }
      ?>
      </select>
    </div>

    <div class="antigen">
      <label for="d_hla_c"> C   </label>
      <select class="beautify single" id="d_hla_c" name="d_hla_c[]" multiple>
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
      <label for="d_hla_dq">DQ   </label>
      <select class="beautify single" id="d_hla_dq" name="d_hla_dq[]" multiple>
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
      <label for="d_hla_dp">DP   </label>
      <select class="beautify single" id="d_hla_dp" name="d_hla_dp[]" multiple>
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
    <label for="d_hla-report" class="label-box">HLA report   </label>
    <label class="required">* </label>
  </div>     
  <div class="input-box">
    <input type="file" id="d_hla-report" name="d_hla-report" value="" class="requiredField single">
  </div>
</div>

