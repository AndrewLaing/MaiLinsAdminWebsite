<!--
 * Filename:     deleteCustomerRecord.php
 * Author:       Andrew Laing
 * Email:        parisianconnections@gmail.com
 * Last updated: 28/06/2019.
 * Description:  The page allows the user to search for and delete
 *               customer records. 
-->

<?php
   include 'includes/loginScripts.inc.php'
?>

<?php
   include 'includes/level_3_user.inc.php'
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
  

  <script type = "text/javascript" language = "javascript">
    /*  Declare variables used for records here. */
    var dataArray = new array();  
    var currentRecord=1;  
    var numberOfRecords=0;

    function updateDetailsFields($dataArray, $currentRecord) {         
      /* Update the fields */ 
        $("input[name=d_customerId].inputField").val($dataArray[$currentRecord]["customerID"]); 
        $("input[name=d_username].inputField").val($dataArray[$currentRecord]["username"]);
        $("input[name=d_surname].inputField").val($dataArray[$currentRecord]["surname"]);
        $("input[name=d_fname].inputField").val($dataArray[$currentRecord]["firstname"]);
        $("input[name=d_address1].inputField").val($dataArray[$currentRecord]["addressLine1"]);
        $("input[name=d_address2].inputField").val($dataArray[$currentRecord]["addressLine2"]);
        $("input[name=d_postcode].inputField").val($dataArray[$currentRecord]["postcode"]);
        $("input[name=d_phoneno].inputField").val($dataArray[$currentRecord]["phoneNumber"]);
        $("input[name=d_email].inputField").val($dataArray[$currentRecord]["emailAddress"]);
    }

    
    function clearDetailsFields() {         
          /* Update the fields */ 
          $("input[name=d_customerId].inputField").val(""); 
          $("input[name=d_username].inputField").val("");
          $("input[name=d_surname].inputField").val("");
          $("input[name=d_fname].inputField").val("");
          $("input[name=d_address1].inputField").val("");
          $("input[name=d_address2].inputField").val("");
          $("input[name=d_postcode].inputField").val("");
          $("input[name=d_phoneno].inputField").val("");
          $("input[name=d_email].inputField").val("");
    }
  </script>

  <script type="text/javascript" src="../js/JQCustomerSearchFunctions.js"></script>
  
</head> <!-- END OF HEAD SECTION -->

<body>

<!-- Header -->
<header class="header">
  <!-- Page title -->
  <div id="title" class="jumbotron">
    <h1>Mai-Lin&apos;s Vegan Takeaway Restaurant</h1>      
    <h1>View Customer Records</h1>
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
  <div class="form-inline"> <!-- START OF SEARCH SECTION -->
      <hr> <!-- Note this has a different meaning in HTML5 so it is styled with CSS -->            
      <h3 class="inputHeaders">SEARCH</h3>
      <hr>

      <div class="form-group col-sm-6">
        <label for="s_idnum" class="control-label inputLabel"  >ID Number </label>
        <input type="text" id="s_idnum" name="s_idnum" placeholder="Customer ID number ..." maxlength="34" 
                class="form-control inputField" autofocus>
        <br />

        <label for="s_uname" class="control-label inputLabel" >Username</label>
        <input type="text" id="s_uname" name="s_uname" placeholder="Username ..." maxlength="34" 
                class="form-control inputField" >
        <br />

        <label for="s_surname" class="control-label inputLabel" >Surname</label>
        <input type="text" id="s_surname" name="s_surname" placeholder="Surname ..." maxlength="34" 
                class="form-control inputField">

      </div>

      <div class="form-group col-sm-6">
        <button type="submit" class="btn btn-info searchBtn" name="searchBtn" id="searchBtn" 
                onClick="" value="searchBtn">FIND RECORDS</button>
      </div>

      <!-- This row is used to add a space after the previous row -->
      <!--      because the form is displayed inline. -->
      <div class="row">
        <div class="form-group col-sm-12">
          <br />
        </div>
      </div>
  </div> <!-- END OF SEARCH SECTION -->


  <form role="form" class="form-inline" method="post" name="frmDetails" action="customerRecordDeleted.php"> <!-- START OF DETAILS SECTION -->
      <hr> <!-- Note this has a different meaning in HTML5 so it is styled with CSS -->
      <h3 class="inputHeaders">DETAILS</h3>
      <hr>

      <!-- Row containing details -->
      <div class="row">
        <!-- Left-hand column -->
        <div class="form-group col-sm-6">

        <label for="d_customerId" class="control-label inputLabel" >ID Number</label>
        <input type="text" id="d_customerId" name="d_customerId" placeholder="Customer ID Number ..." maxlength="34" 
                class="form-control inputField" readonly>
        <br />

        <label for="d_username" class="control-label inputLabel" >Username</label>
        <input type="text" id="d_username" name="d_username" placeholder="Username ..." maxlength="34" 
                class="form-control inputField" readonly>
        <br />

        <label for="d_fname" class="control-label inputLabel"  >First Name </label>
        <input type="text" id="d_fname" name="d_fname" placeholder="First name ..." maxlength="34" 
                class="form-control inputField" readonly>
        <br />

        <label for="d_surname" class="control-label inputLabel" >Surname</label>
        <input type="text" id="d_surname" name="d_surname" placeholder="Surname ..." maxlength="34" 
                class="form-control inputField" readonly>
        <br />

        </div>

        <!-- Right-hand column -->
        <div class="form-group col-sm-6">
          <label for="d_email" class="control-label inputLabel"  >Email Address </label>
          <input type="text" id="d_email" name="d_email" placeholder="Email Address ..." maxlength="49" 
                  class="form-control inputField" readonly>
          <br />

          <label for="d_phoneno" class="control-label inputLabel" >Phone Number</label>
          <input type="text" id="d_phoneno" name="d_phoneno" placeholder="Phone Number ..." maxlength="34" 
                  class="form-control inputField" readonly>
          <br />

          <label for="d_address1" class="control-label inputLabel" >Address Line 1</label>
          <input type="text" id="d_address1" name="d_address1" placeholder="Address Line 1" maxlength="34" 
                  class="form-control inputField" readonly>
          <br />

          <label for="d_address2" class="control-label inputLabel">Address Line 2</label>
          <input type="text" id="d_address2" name="d_address2" placeholder="Address Line 2 ..." maxlength="34" 
                  class="form-control inputField" readonly>
          <br />

          <label for="d_postcode" class="control-label inputLabel">Postcode</label>
          <input type="text" id="d_postcode" name="d_postcode" placeholder="Postcode ..." maxlength="7" 
                  class="form-control inputField" readonly>
          <br />
          <div class="navigateBtnDiv">
          <button type="button" class="btn btn-info recordNavigateBtn" name="btnPrev" id="btnPrev"
                  value="btnPrev">Previous</button>
          <button type="button" class="btn btn-info recordNavigateBtn" name="btnNext" id="btnNext"
                  value="btnNext">Next</button>
          <br />
          </div>
        </div>
      </div>  <!-- End of row -->


      <div class="row">
        <br />
        <hr> <!-- Note this has a different meaning in HTML5 so it is styled with CSS --> 
      </div>

      <!-- Row containing buttons -->
      <div class="row">
        <div class="form-group col-sm-12">
          <!-- A button of type button does not submit -->
          <button type="button" class="btn btn-info btn-cancel" name="cancel" 
                    value="cancel"  onClick="alert('Action cancelled. Returning to the home page.'); window.location = '../index.php';">CANCEL</button>    

          <button type="submit" class="btn btn-info btn-order" name="delete" 
                  value="delete" onClick="return confirm_delete_record();">DELETE RECORD</button>

        </div>
      </div>  <!-- End of row -->
    </form>

    <br />
  </div>   


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
