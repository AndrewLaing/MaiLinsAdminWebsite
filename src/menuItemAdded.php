<!--
 * Filename:     menuItemUpdated.php
 * Author:       Andrew Laing
 * Email:        parisianconnections@gmail.com
 * Last updated: 02/07/2019.
 * Description:  This page is used to edit a menu item record with
 *               the details posted from editMenuItem.php
-->

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
    <h1>Add Staff Records</h1>
  </div>   
</header> <!-- END OF HEADER SECTION -->


<?php 
  $itemname = '';
  $category = '';
  $quantity = '';
  $description = '';
  $price = '';
  $filename = '';

  foreach ($_POST as $key => $value) {
    switch($key) {
      case "d_itemname":
        $itemname = $value; 
        break;
      case "d_category":
        $category = $value; 
        break;
      case "d_quantity":
        $quantity = $value; 
        break;
      case "d_description":
        $description = $value; 
        break;
      case "d_price":
        $price = $value; 
        break;
      case "d_filename":
        $filename = $value; 
        break;
      default:
        break;
    }
  } 

    /* START OF UPDATE RECORD */
    /* Connect to the DB and insert the new record */
    $mysqli = new mysqli("localhost","webuser","webuser","fooddb");

    if ($mysqli->connect_errno) {
      echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
      /* Redirect to error page here */
      header('Location: ../errorPage.php');
      exit;
    }

    /* Prepare the insert statement */
    if ($stmt = $mysqli->prepare("CALL insertProduct ((?),(?),(?),(?),(?),(?))")) {
      $stmt->bind_param("ssssss", $itemname, $category, $quantity, $description, $price, $filename);

      $stmt->execute();   

      echo '<br /><br />';
      echo '<h1 class="indentedText">Confirmation</h1><p class="indentedText">The record has been added.</p>';
      echo '<br />';
      echo '<p class="indentedText">You will be redirected back to the home page in 5 seconds</p>';

      /* Redirect back to the home page */
      $headerText = 'Refresh:5; url="/index.php"';
      header($headerText);

      echo '<br /><br /><br /><br /><br />';
    }    
    else {
      echo '<br /><br />';
      echo '<h1 class="indentedText">ERROR</h1><p class="indentedText">Unable to add the record.</p>';
      echo '<br />';
      echo '<p class="indentedText">You will be redirected back to the home page in 5 seconds</p>';

      /* Redirect back to the home page */
      $headerText = 'Refresh:5; url="/index.php"';
      header($headerText);
      echo '<br /><br /><br /><br /><br />';
    }
       
    /* close statement and connection */
    $stmt->close();
    $mysqli->close();

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
