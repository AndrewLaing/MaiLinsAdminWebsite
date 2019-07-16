<!--
 * Filename:     addStaffRecord.php
 * Author:       Andrew Laing
 * Email:        parisianconnections@gmail.com
 * Last updated: 27/06/2019.
 * Description:  The addStaffRecord page allows the user to add
 *               a new staff record to the database. 
 * Notes:        This page can only be used and viewed by staff members
 *               with access level 3 or greater.
-->

<?php
   include 'includes/loginScripts.inc.php'
?>

<?php
   include 'includes/level_2_user.inc.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Mai-Lin's Vegan Takeaway Restaurant</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Stylesheets and JS for Bootstrap -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script> 
  <script src="../js/bootstrap-hover-dropdown.js"></script>  
  
  <!-- My JavaScript-->
  <script type="text/javascript" src="../js/script.js"></script>

  <!-- My stylesheet -->
  <link href="../css/style.css" rel="stylesheet">
  <link href="../css/feedback-form.css" rel="stylesheet">

  <script>  
  /* This function is used to ensure that only unique staffIDs are chosen */
  function checkUsername(str) {
    if (str == "") {
      document.getElementById("d_username").value = "";
      return;
    } 
    else { 
      if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
      } 
      else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }

      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("d_username").value = this.responseText;
        }
      };
      xmlhttp.open("GET","ajaxhandlers/staffRecordExists.php?q="+str,true);
      xmlhttp.send();
    }
  }
  
  </script>
  
</head> <!-- END OF HEAD SECTION -->

<body>

<!-- Header -->
<header class="header">
  <!-- Page title -->
  <div id="title" class="jumbotron">
    <h1>Mai-Lin&apos;s Vegan Takeaway Restaurant</h1>      
    <h1>Add Staff Records</h1>
  </div>
  
  <!-- Navigation bar -->
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <!-- Create the Left NavBar -->
        <?php
          include 'includes/adminNavBarLeft.inc.php';
        ?>
      <!-- Create the Right NavBar -->
      <ul class="nav navbar-nav navbar-right">
        <!-- Generated with PHP to take login status into account -->
        <?php
           include 'includes/adminNavBarRight.inc.php'
        ?>   
      </ul>
    </div>
  </nav>    
</header> <!-- END OF HEADER SECTION -->

<!-- Main content. -->
<div class="container-fluid"> 
  <div class="container">
    <form role="form" class="form-inline" method="post" name="frmAddRecord" action="staffRecordAdded.php">
      <!-- Header for the details section -->
      <hr> <!-- Note this has a different meaning in HTML5 so it is styled with CSS -->
      <h3 class="inputHeaders">ENTER DETAILS</h3>
      <hr>

      <!-- Row containing details -->
      <div class="row">
        <!-- Left-hand column -->
        <div class="form-group col-sm-6">

        <label for="d_username" class="control-label inputLabel" >Username</label>
        <input type="text" id="d_username" name="d_username" placeholder="Username ..." maxlength="34" 
               onchange="checkUsername(this.value);" class="form-control inputField" 
               required="" autofocus>
        <br />

        <label for="d_password" class="control-label inputLabel" >Password</label>
        <input type="password" id="d_password" name="d_password" placeholder="Password ..." maxlength="34" 
               onchange="validate_password_length();" class="form-control inputField" required="">
        <br />

        <label for="d_confirmpass" class="control-label inputLabel" >Confirm</label>
        <input type="password" id="d_confirmpass" name="d_confirmpass" placeholder="Confirm Password ..." maxlength="34" 
               onchange="validate_confirm_password();" class="form-control inputField" required="">
        <br />

        <label for="d_fname" class="control-label inputLabel"  >First Name </label>
        <input type="text" id="d_fname" name="d_fname" placeholder="First name ..." maxlength="34" 
                class="form-control inputField" required="">
        <br />

        <label for="d_surname" class="control-label inputLabel" >Surname</label>
        <input type="text" id="d_surname" name="d_surname" placeholder="Surname ..." maxlength="34" 
                class="form-control inputField" required="">
        <br />

        <label for="d_jobpos" class="control-label inputLabel">Position</label>
        <input type="text" id="d_jobpos" name="d_jobpos" placeholder="Current job position ..." maxlength="34" 
                class="form-control inputField" required="">
        <br />
        </div>

        <!-- Right-hand column -->
        <div class="form-group col-sm-6">
            <label for="d_email" class="control-label inputLabel"  >Email Address </label>
            <input type="text" id="d_email" name="d_email" placeholder="Email Address ..." maxlength="49" 
                    class="form-control inputField">
            <br />

            <label for="d_phoneno" class="control-label inputLabel" >Phone Number</label>
            <input type="text" id="d_phoneno" name="d_phoneno" placeholder="Phone Number ..." maxlength="34" 
                    class="form-control inputField">
            <br />

            <label for="d_address1" class="control-label inputLabel" >Address Line 1</label>
            <input type="text" id="d_address1" name="d_address1" placeholder="Address Line 1" maxlength="34" 
                    class="form-control inputField">
            <br />

            <label for="d_address2" class="control-label inputLabel">Address Line 2</label>
            <input type="text" id="d_address2" name="d_address2" placeholder="Address Line 2 ..." maxlength="34" 
                    class="form-control inputField">
            <br />

            <label for="d_postcode" class="control-label inputLabel">Postcode</label>
            <input type="text" id="d_postcode" name="d_postcode" placeholder="Postcode ..." maxlength="7" 
                    class="form-control inputField">
            <br />

        </div>
      </div>  <!-- End of row -->

      <div class="row">
        <br />
        <hr> <!-- Note this has a different meaning in HTML5 so it is styled with CSS --> 
      </div>

      <!-- Row containing buttons -->
      <div class="row">
        <div class="form-group col-sm-12">
          <button type="button" class="btn btn-info btn-cancel" name="cancel" 
                  value="cancel"  onClick="alert('Action cancelled. Returning to the home page.'); location.href='../index.php';">CANCEL</button>
          <br />

          <button type="submit" class="btn btn-info btn-order" name="addrecord" 
                  value="addrecord" onClick="return validate_addStaffRecord_fields();">ADD RECORD</button>

        </div>
      </div>  <!-- End of row -->
    </form>

    <br />
  </div>    
</div>      <!-- END OF CONTAINER-FLUID -->


<!-- Footer -->
<footer class="footer footerDivs">
<!-- Create the footer contents -->
  <?php
    include 'includes/footerContents.inc.php';
  ?>
</footer> <!-- END OF FOOTER SECTION -->

<!-- LOGIN modal removed because page can only be viewed if user is logged in. -->

</body>
</html>
