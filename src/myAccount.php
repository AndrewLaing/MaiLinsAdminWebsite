<!--
 * Filename:     myAccount.php
 * Author:       Andrew Laing
 * Email:        parisianconnections@gmail.com
 * Last updated: 02/07/2019.
 * Description:  The page allows the user to view their account details. 
-->

<?php
   include 'includes/loginScripts.inc.php'
?>

<?php
   include 'includes/level_0_user.inc.php'
?>

<?php
/* Turn off error reporting to stop info leaks */
//error_reporting(0);

  if( !(isset($_SESSION['staffID']) ) ) {
    echo '<h1>ERROR</h1>';
    echo '<p>You do not have the right to view this page, and your IP address (';
    echo $_SERVER['REMOTE_ADDR'];
    echo ') has been logged!<br />';
    echo 'Please contact your administrator as quickly as possible to explain why you attempted to open this page!';
    echo '<p>You will be logged out of your account and redirected back to the home page in 20 seconds</p>';
    echo'<img src="/imgs/breachDetected.jpg" alt="Girl in a jacket" style="width:100%;"> ';

    /* Unset Session cookie values */
    session_unset(); 
    
    /* Redirect back to the home page */
    $headerText = 'Refresh:20; url="/index.php"';
    header($headerText);

    exit;
  } else {
    $staffID = $_SESSION['staffID']; 
  }

  /* Connect to the DB, get the product details and add them to an array */
  $mysqli = new mysqli("localhost","webuser","webuser","fooddb");

  if ($mysqli->connect_errno) {
    /* Redirect to error page here */
    header('Location: ../errorPage.php');
    exit;
  }

  if(strlen($staffID)>0) {
    $stmt = $mysqli->prepare("CALL getStaffDetailsByIDNumber(?)");
    $stmt->bind_param("s", $staffID);
  } 

  /* Run the query */
  if (! ( @$stmt->execute() )) {
    /* Redirect to error page here */
    header('Location: ../errorPage.php');
    exit;
  }
  else { 	
    $query = @$stmt->get_result();
    $result = [];
    $counter = 0;

    while($row = $query->fetch_assoc()) {
      $result[$counter] = $row;
      $counter++;
    }
  }

  $mysqli->close(); 
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
  
</head> <!-- END OF HEAD SECTION -->

<body>

<!-- Header -->
<header class="header">
  <!-- Page title -->
  <div id="title" class="jumbotron">
    <h1>Mai-Lin&apos;s Vegan Takeaway Restaurant</h1>      
    <h1>My Account Details</h1>
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


  <div class="form-inline"> <!-- START OF DETAILS SECTION -->
      <hr> <!-- Note this has a different meaning in HTML5 so it is styled with CSS -->
      <h3 class="inputHeaders">MY ACCOUNT DETAILS</h3>
      <hr>

      <!-- Row containing details -->
      <div class="row">
        <!-- Left-hand column -->
        <div class="form-group col-sm-6">

        <label for="d_staffId" class="control-label inputLabel" >ID Number</label>
        <input type="text" id="d_staffId" name="d_staffId" placeholder="Staff ID Number ..." maxlength="34" 
               value="<?php echo $result[0]['staffID']; ?>"
               class="form-control inputField" readonly>
        <br />

        <label for="d_username" class="control-label inputLabel" >Username</label>
        <input type="text" id="d_username" name="d_username" placeholder="Username ..." maxlength="34" 
               value="<?php echo $result[0]['username']; ?>"
               class="form-control inputField" readonly>
        <br />

        <label for="d_fname" class="control-label inputLabel"  >First Name </label>
        <input type="text" id="d_fname" name="d_fname" placeholder="First name ..." maxlength="34" 
               value="<?php echo $result[0]['firstname']; ?>"
               class="form-control inputField" readonly>
        <br />

        <label for="d_surname" class="control-label inputLabel" >Surname</label>
        <input type="text" id="d_surname" name="d_surname" placeholder="Surname ..." maxlength="34" 
               value="<?php echo $result[0]['surname']; ?>"
               class="form-control inputField" readonly>
        <br />

        <label for="d_jobpos" class="control-label inputLabel">Position</label>
        <input type="text" id="d_jobpos" name="d_jobpos" placeholder="Current job position ..." maxlength="34" 
               value="<?php echo $result[0]['jobPosition']; ?>"
               class="form-control inputField" readonly>
        <br />
        </div>

        <!-- Right-hand column -->
        <div class="form-group col-sm-6">
          <label for="d_email" class="control-label inputLabel"  >Email Address </label>
          <input type="text" id="d_email" name="d_email" placeholder="Email Address ..." maxlength="49" 
                 value="<?php echo $result[0]['emailAddress']; ?>"
                 class="form-control inputField" readonly>
          <br />

          <label for="d_phoneno" class="control-label inputLabel" >Phone Number</label>
          <input type="text" id="d_phoneno" name="d_phoneno" placeholder="Phone Number ..." maxlength="34" 
                 value="<?php echo $result[0]['phoneNumber']; ?>"
                 class="form-control inputField" readonly>
          <br />

          <label for="d_address1" class="control-label inputLabel" >Address Line 1</label>
          <input type="text" id="d_address1" name="d_address1" placeholder="Address Line 1" maxlength="34" 
                 value="<?php echo $result[0]['addressLine1']; ?>"
                 class="form-control inputField" readonly>
          <br />

          <label for="d_address2" class="control-label inputLabel">Address Line 2</label>
          <input type="text" id="d_address2" name="d_address2" placeholder="Address Line 2 ..." maxlength="34" 
                 value="<?php echo $result[0]['addressLine2']; ?>"
                 class="form-control inputField" readonly>
          <br />

          <label for="d_postcode" class="control-label inputLabel">Postcode</label>
          <input type="text" id="d_postcode" name="d_postcode" placeholder="Postcode ..." maxlength="7" 
                 value="<?php echo $result[0]['postcode']; ?>"
                 class="form-control inputField" readonly>
          <br />
        </div>
      </div>  <!-- End of row -->


      </div>  <!-- End of row -->
    </div> <!-- END OF DETAILS SECTION -->
    <br />
      <div>
        <p class="otherLinks"><a href="changeMyAccountDetails.php">Change your Account Details</a></p>
        <p class="otherLinks"><a href="changeMyPassword.php">Change your Password</a></p>       
      </div> 
      <br />
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
