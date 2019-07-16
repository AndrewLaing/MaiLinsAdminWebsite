<!--
 * Filename:     accessLevelUpdated.php
 * Author:       Andrew Laing
 * Email:        parisianconnections@gmail.com
 * Last updated: 28/06/2019.
 * Description:  This page is used to change a staff members website
 *               access level with the details posted from editStaffRecord.php
-->

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
    <h1>Edit Staff Records</h1>
  </div>   
</header> <!-- END OF HEADER SECTION -->


<?php 
  $staffId = -1;
  $newAccessLevel = -1;
 
  foreach ($_POST as $key => $value) {
    switch($key) {
      case "d_staffId":
        $staffId = (int)$value; 
        break;
      case "d_accessLevel":
        $newAccessLevel = $value; 
        break;
      default:
        break;
    }
  } 
  if($staffId==-1 || $staffId==null || $newAccessLevel==-1 || $newAccessLevel==null || $newAccessLevel>3){
    echo '<br /><br />';
    echo '<h1 class="indentedText">ERROR</h1><p class="indentedText">Unable to change the staff members access level.</p>';
    echo '<br />';
    echo '<p class="indentedText">You will be redirected back to the home page in 5 seconds</p>';

    /* Redirect back to the home page */
    $headerText = 'Refresh:5; url="../index.php"';
    header($headerText);
    echo '<br /><br /><br /><br /><br />';
  }
  else { /* START OF UPDATE RECORD */
    /* Use try-catch block to stop information leakage */
    try {  /* START OF TRY BLOCK */ 
        /* Connect to the DB and update the record */
        $mysqli = new mysqli("localhost","webuser","webuser","fooddb");

        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            /* Redirect to error page here */
            header('Location: errorPage.php');
            exit;
        }

        /* Prepare the update statement */
        if ($stmt = $mysqli->prepare("CALL setStaffAccessLevel ((?),(?))")) {
            $stmt->bind_param("ii",$staffId, $newAccessLevel);

            $stmt->execute();   

            echo '<br /><br />';
            echo '<h1 class="indentedText">Confirmation</h1><p class="indentedText">The staff members access level has been changed.</p>';
            echo '<br />';
            echo '<p class="indentedText">You will be redirected back to the home page in 5 seconds</p>';

            /* Redirect back to the home page */
            $headerText = 'Refresh:5; url="../index.php"';
            header($headerText);

            echo '<br /><br /><br /><br /><br />';
        }    
        else {
            echo '<br /><br />';
            echo '<h1 class="indentedText">ERROR</h1><p class="indentedText">Unable to change the staff members access level.</p>';
            echo '<br />';
            echo '<p class="indentedText">You will be redirected back to the home page in 5 seconds</p>';

            /* Redirect back to the home page */
            $headerText = 'Refresh:5; url="../index.php"';
            header($headerText);
            echo '<br /><br /><br /><br /><br />';
        }
        
        /* close statement and connection */
        $stmt->close();
        $mysqli->close();
    }/* END OF TRY BLOCK */

    catch(Exception $e) {
        echo '<br /><br />';
        echo '<h1 class="indentedText">ERROR</h1><p class="indentedText">Unable to change the staff members access level.</p>';
        echo '<br />';
        echo '<p class="indentedText">You will be redirected back to the home page in 5 seconds</p>';

        /* Redirect back to the home page */
        $headerText = 'Refresh:5; url="../index.php"';
        header($headerText);
        echo '<br /><br /><br /><br /><br />';
    } /* END OF UPDATE RECORD */ 
}
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
