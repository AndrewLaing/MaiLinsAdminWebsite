<!-- Generated with PHP to take login status into account -->
<?php
  if( !(isset($_SESSION['login']) && $_SESSION['login'] != '') ) {
      echo '<li><a href="viewMenu.php">Food Menu</a></li>';   
      session_unset(); 
  }
  else {
      echo '<li><a href="orderonline.php">Order online</a></li>  ';
  }
?>   