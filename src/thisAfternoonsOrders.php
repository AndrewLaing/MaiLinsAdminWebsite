<!--
 * Filename:     viewStaffRecords.php
 * Author:       Andrew Laing
 * Email:        parisianconnections@gmail.com
 * Last updated: 25/06/2019.
 * Description:  The page allows the user to search for and view
 *               staff records. 
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
  

  <script type = "text/javascript" language = "javascript">
    /*  Declare variables used for records here. */
    var dataArray = new array();  
    var currentRecord=1;  
    var numberOfRecords=0;

    function updateDetailsFields($dataArray, $currentRecord) {         
      /* Update the fields */ 
        $("input[name=d_staffId].inputField").val($dataArray[$currentRecord]["staffID"]); 
        $("input[name=d_username].inputField").val($dataArray[$currentRecord]["username"]);
        $("input[name=d_surname].inputField").val($dataArray[$currentRecord]["surname"]);
        $("input[name=d_fname].inputField").val($dataArray[$currentRecord]["firstname"]);
        $("input[name=d_address1].inputField").val($dataArray[$currentRecord]["addressLine1"]);
        $("input[name=d_address2].inputField").val($dataArray[$currentRecord]["addressLine2"]);
        $("input[name=d_postcode].inputField").val($dataArray[$currentRecord]["postcode"]);
        $("input[name=d_phoneno].inputField").val($dataArray[$currentRecord]["phoneNumber"]);
        $("input[name=d_email].inputField").val($dataArray[$currentRecord]["emailAddress"]);
        $("input[name=d_jobpos].inputField").val($dataArray[$currentRecord]["jobPosition"]);
    }

    
    function clearDetailsFields() {         
          /* Update the fields */ 
          $("input[name=d_staffId].inputField").val(""); 
          $("input[name=d_username].inputField").val("");
          $("input[name=d_surname].inputField").val("");
          $("input[name=d_fname].inputField").val("");
          $("input[name=d_address1].inputField").val("");
          $("input[name=d_address2].inputField").val("");
          $("input[name=d_postcode].inputField").val("");
          $("input[name=d_phoneno].inputField").val("");
          $("input[name=d_email].inputField").val("");
          $("input[name=d_jobpos].inputField").val("");
    }
  </script>

  <script type="text/javascript" src="../js/JQStaffSearchFunctions.js"></script>
  
</head> <!-- END OF HEAD SECTION -->

<body>

<!-- Header -->
<header class="header">
  <!-- Page title -->
  <div id="title" class="jumbotron">
    <h1>Mai-Lin&apos;s Vegan Takeaway Restaurant</h1>      
    <h1>View Orders</h1>
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
<div class="container-fluid main-content"> 
  <div class="container">
    <div class="form-inline"> <!-- START OF SEARCH SECTION -->
      <hr> <!-- Note this has a different meaning in HTML5 so it is styled with CSS -->            
      <h3 class="inputHeaders">THIS AFTERNOON'S ORDERS. (12:00 - 19:00)</h3>
      <hr>
     </div>
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
