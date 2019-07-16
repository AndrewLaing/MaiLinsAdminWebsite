<!--
 * Filename:     staffPasswordChanged.php
 * Author:       Andrew Laing
 * Email:        parisianconnections@gmail.com
 * Last updated: 03/07/2019.
 * Description:  This page is used to change a staff member's password
 *               with the details posted from changeMyPassword.php
-->

<?php
   include 'includes/level_0_user.inc.php'
?>

<?php
function changePassword() {
  $staffID = '';
  $currentpwd = '';
  $newpwd = '';
  
  /* Get the currentstaffID from the session cookie */
  $staffID = $_SESSION['staffID'];

  /* Get the posted password details */
  foreach ($_POST as $key => $value) { 
    if ($key== 'currentpwd') {
      $currentpwd = $value;      
    }
    else if ($key== 'newpwd') {
      $newpwd = $value;             
    } 
  }  
  
    /* Validate the data POSTed just in case the user has bypassed the Javascript checks
   * or opened the page away from the Change Password page */
  if(strlen($currentpwd)==0 || strlen($newpwd)==0 ) {
    echo '<h1>ERROR</h1>';
    echo '<p>There has been a problem processing your data!</p>';
    echo '<p>You will be redirected back to the home page in 5 seconds</p>';
    
    /* Redirect back to the home page */
    $headerText = 'Refresh:5; url="/index.php"';
    header($headerText);

    exit;
  }
  
  /* Connect to the DB */
  $mysqli = new mysqli("localhost","webuser","webuser","fooddb");
  
  $res = -1;
  
  /* check connection */
  if (mysqli_connect_errno()) {
    header('Location: errorPage.php');
    exit();
  }  
  else {
    $SQL = $mysqli->prepare('CALL checkStaffPasswordIDCombo(?,?)');
    $SQL->bind_param('is', $staffID, $currentpwd);
    $SQL->execute();
    $result = $SQL->get_result();
    $mysqli->close(); 
    
    /* If the user has entered their current password correctly change it */
    if($result->num_rows == 1) {
      /* Connect to the DB */
      $mysqli = new mysqli("localhost","webuser","webuser","fooddb");
  
      /* check connection */
      if (mysqli_connect_errno()) {
        header('Location: errorPage.php');
        exit();
      }  
      else {
        $SQL = $mysqli->prepare('CALL updateStaffPassword(?,?)');
        $SQL->bind_param('is', $staffID, $newpwd);
        if ($SQL->execute()) {
          echo '<br />';
          echo '<h1 class="indentedText">Success</h1><p class="indentedText">Your password has been changed.</p>';
          echo '<p class="indentedText otherLinks">Click <a href="../index.php">here</a> to return to the home page.</p>';
          echo '<br />';
        }
        else {
          echo '<br />';
          echo '<h1 class="indentedText">Error</h1><p class="indentedText">Unable to change password.</p>';
          echo '<p class="indentedText otherLinks">Click <a href="changeMyPassword.php">here</a> to return to previous page.</p>';
          echo '<br />';
        }
        $mysqli->close(); 
      }
    }
    /* If the user has entered their current password incorrectly, print an error message */
    else {
        echo '<br />';
        echo '<h1 class="indentedText">Error</h1><p class="indentedText">You have entered your current password incorrectly.</p>';
        echo '<p class="indentedText otherLinks">Click <a href="changeMyPassword.php">here</a> to return to previous page.</p>';
          echo '<br />';
    }
  }
}
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
  
  <!-- My JavaScript-->
  <script type="text/javascript" src="../js/script.js"></script>

  <!-- My stylesheet -->
  <link href="../css/style.css" rel="stylesheet">

</head> <!-- END OF HEAD SECTION -->

<body>

<!-- Header -->
<header class="header">
  <!-- Page title -->
  <div id="title" class="jumbotron">
    <h1>Mai-Lin&apos;s Vegan Takeaway Restaurant</h1>      
    <h1>Password Changed</h1>
  </div>   
</header> <!-- END OF HEADER SECTION -->
  
  <?php
    changePassword();
  ?>
  
  <!-- Footer -->
  <footer class="footer footerDivs">
    <!-- Create the footer contents -->
    <?php
      include 'includes/footerContents.inc.php';
    ?>
  </footer> <!-- END OF FOOTER SECTION -->

</body>
</html>
