<!--
 * Filename:     placeOrder.php
 * Author:       Andrew Laing
 * Email:        parisianconnections@gmail.com
 * Last updated: 31/05/2019.
 * Description:  The Place Order page will be used to confirm to 
 *               the user that their order entered into the form 
 *               on the orderOnline.php page has been placed. 
-->


<?php
/* If there is not an active session start one */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/* If the user is not logged in show a message then redirect 
 * to the home page after 5 seconds */
if( !(isset($_SESSION['login']) && $_SESSION['login'] != '') ) {
    echo '<h1>ERROR</h1>';
    echo '<p>You must be logged in to view this page!</p>';
    echo '<p>You will be redirected back to the home page in 5 seconds</p>';

    /* Unset Session cookie values */
    session_unset(); 
    
    /* Redirect back to the home page */
    $headerText = 'Refresh:5; url="../index.php"';
    header($headerText);

    exit;
}

/* Ensure that the customer has ordered at least one item before proceeding */
$countItems = 0;
foreach ($_POST as $key => $value) 
{
  if(endswith($key, 'hidden') && $value!=0) {
    $countItems++;       
  } 
  
  if($countItems>0) {
    break;    
  }
}    

if($countItems<1) {
  echo '<h1>ERROR</h1>';
  echo '<p>You have not selected any items!</p>';
  echo '<p>You will be redirected back to the previous page in 5 seconds</p>';
  
  /* Get the address of the previous page */
  $previous = "javascript:history.go(-1)";
  if(isset($_SERVER['HTTP_REFERER'])) {
      $previous = $_SERVER['HTTP_REFERER'];
  }
  
  /* Redirect back to the previous page */
  $headerText = 'Refresh:5; url="orderonline.php"';
  header($headerText);  
  
  exit;  
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
    </div>

    <!-- Navigation bar -->
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <ul class="nav navbar-nav">
          <li><a href="../index.php">Home</a></li>

          <!-- Generated with PHP to take login status into account -->
          <?php
             include 'includes/foodMenuOrOrderOnline.inc.php'
          ?>

          <li><a href="about.php">About us</a></li>
          <li><a href="feedback.php">Feedback</a></li>
          <li><a href="privacy.php">Privacy Policy</a></li>
          <li><a href="termsandconditions.php">Terms and Conditions</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <!-- Generated with PHP to take login status into account -->
          <?php
             include 'includes/registrationOrUserDetails.inc.php'
          ?>   
        </ul>
      </div>
    </nav>    
  </header> <!-- END OF HEADER SECTION -->  
  
<?php 
  function endswith($string, $test) {
      $strlen = strlen($string);
      $testlen = strlen($test);
      
      if ($testlen > $strlen) {
        return false;
      }
      
      return substr_compare($string, $test, $strlen - $testlen, $testlen) === 0;
  }

  $deliveryDatetime = '';
  $deliveryDate = '';
  $deliveryTime = '';
  $customerID = $_SESSION['customerID'];

  
  foreach ($_POST as $key => $value) {
    if ($key== 'deliveryDate') {
      //echo 'Delivery date = ' . $value . '<br />'; 
      $deliveryDatetime = $value . ' '; 
      $deliveryDate = $value;      
    }
    else if ($key== 'deliveryTime') {
      //echo 'Delivery time = ' . $value . '<br />';  
      $deliveryDatetime = $deliveryDatetime . $value; 
      $deliveryTime = $value;             
    } 
  }

  /* Connect to the DB, get the product details and add them to an array */
  $mysqli = new mysqli("localhost","webuser","webuser","fooddb");

  if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    /* Redirect to error page here */
    header('Location: errorPage.php');
    exit;
  }

  $orderId = -1;  /* Initialise the orderId */

  /* create a prepared statement */
  if ($stmt = $mysqli->prepare("SELECT addNewOrder(?,?)")) {

    /* add parameters to the statement */
    $stmt->bind_param("is", $customerID, $deliveryDatetime); 

    /* execute query */
    $stmt->execute();

    /* bind result from function call to orderID */
    $stmt->bind_result($orderID);

    /* fetch value */
    $stmt->fetch();

    /* close statement and connection */
    $stmt->close();
    $mysqli->close();
  }

  if ($orderID==-1) {
    echo '<h1>ERROR</h1><p>Unable to process your order. Please telephone the store to inform the website&apos;s administrator!</p><br />';
    exit();
  }
  
  /* Add new order here and store orderID returned for order Items */
  /* Connect to the DB, get the ordered item details and insert them into the db */
  $mysqli = new mysqli("localhost","webuser","webuser","fooddb");

  if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    /* Redirect to error page here */
    header('Location: errorPage.php');
    exit;
  }
  
  /* Prepare the insert statement */
  if ($stmt = $mysqli->prepare("CALL insertOrderItem(?,?,?)")) {
    $stmt->bind_param("iii",$param1, $param2, $param3);
    
    /* Loop here */
    foreach ($_POST as $key => $value) 
    {
      if(endswith($key, 'hidden') && $value!=0) {
        /* Add a new order item */
        $param1 = $orderID;          
        $param2 = str_replace("hidden","",$key); /* get the number from the key for the item id*/
        $param3 = $value;
        $stmt->execute();       
      } 
    }    
    /* End of loop here */    
    
    /* close statement and connection */
    $stmt->close();
    $mysqli->close();
  }

  echo '<br /><br />';
  echo '<h1 class="indentedText">Confirmation</h1><p class="indentedText">Your order has been placed and will arrive on ' . $deliveryDate . ' at ' . $deliveryTime . '</p>';
  echo '<br />';
  echo '<p class="indentedText">You will be redirected back to the home page in 5 seconds</p>';

  /* Redirect back to the home page */
  $headerText = 'Refresh:5; url="../index.php"';
  header($headerText);
  
  echo '<br /><br /><br /><br />'
?>

  
  <!-- Footer -->
  <footer class="footer footerDivs">
    <!-- LOCATION DETAILS -->
    <div class="col-sm-3 footerDivs">
      <h1>Location</h1> 
      <p>Mai-Lin&apos;s Vegan Takeaway Restaurant<br />78, Seel Street,<br /> Liverpool <br />L1 4BH</p>
    </div> 
    
    <!-- BOOKING DETAILS -->
    <div class="col-sm-3 footerDivs">
      <h1>Book Table</h1>
      <p>Telephone: <a href="tel:01514437777">0151 443 7777</a><br /> 
      Email: <a href="mailto:info@mailinsrestaurant.com?Subject=Table%20booking" target="_top">info@mailinsrestaurant.com</a><br />
      Skype: <a href="skype:MaiLinsResto?call">MaiLinsResto</a>
    </p>
    </div> 
    
    <!-- OPENING HOURS DETAILS -->
    <div class="col-sm-3 footerDivs">
      <h1>Opening Hours</h1> 
      <p>7 days a week<br />10am-10pm</p>
    </div> 

    <!-- SOCIAL MEDIA DETAILS -->  
    <div class="col-sm-3 footerDivs">
      <h1>Follow us</h1>
      <p>
      <a class="btn btn-icon btn-facebook" href="https://en-gb.facebook.com/TheVeganSociety">f</a>
      <a class="btn btn-icon btn-twitter" href="https://twitter.com/TheVeganSociety">t</a>
      </p>
    </div> 
  </footer> <!-- END OF FOOTER SECTION -->

</body>
</html>
