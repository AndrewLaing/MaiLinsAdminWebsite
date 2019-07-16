<!--
 * Filename:     viewOrders.php
 * Author:       Andrew Laing
 * Email:        parisianconnections@gmail.com
 * Last updated: 31/05/2019.
 * Description:  This page provides staff member's with links to
 *               the view order pages.  
-->

<?php
   include 'includes/loginScripts.inc.php'
?>

<?php
   include 'includes/level_1_user.inc.php'
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
    
  <!-- JQuery syntax - used to open the Login modal -->
  <script>
  $(document).ready(function(){
    $("#loginBtn").click(function(){
      $("#loginModal").modal();
    });
  });
  </script>
  
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
<div class="container-fluid"> 
  <div class="container main-content">
  <div class="row">
    <div class="col col-sm-12 content">
      <hr> <!-- Note this has a different meaning in HTML5 so it is styled with CSS -->
        <h1>CHOOSE ORDERS TO VIEW</h1> 
        <hr>
      <br />
      <div>
      <p class="otherLinks"><a href="todaysOrders.php">VIEW ALL OF TODAY'S ORDERS</a></p>
        <p class="otherLinks"><a href="thisMorningsOrders.php">VIEW THIS MORNING'S ORDERS. (BEFORE 12:00) </a></p>   
        <p class="otherLinks"><a href="thisAfternoonsOrders.php">VIEW THIS AFTERNOON'S ORDERS. (12:00 - 19:00)</a></p>
        <p class="otherLinks"><a href="tonightsOrders.php">VIEW TONIGHT'S ORDERS (AFTER 19:00)</a></p>    
        <p class="otherLinks"><a href="tomorrowsOrders.php">VIEW TOMORROW'S ORDERS</a></p>
        <p class="otherLinks"><a href="allOrders.php">VIEW ALL ORDERS</a></p>     
        <br /><br />   
      </div> 
    </div>
  </div>    <!-- END OF ROW -->
</div>
</div>      <!-- END OF CONTAINER-FLUID -->


<!-- Footer -->
<footer class="footer footerDivs">
<!-- Create the footer contents -->
  <?php
    include 'includes/footerContents.inc.php';
  ?>
</footer> <!-- END OF FOOTER SECTION -->

</body>
</html>
