<!--
 * Filename:     changeAccountDetails.php
 * Author:       Andrew Laing
 * Email:        parisianconnections@gmail.com
 * Last updated: 31/05/2019.
 * Description:  The Change Account Details page enables customers
 *               to update their account details.
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
?>

<?php
   include 'includes/loginScripts.inc.php';
?>

<?php
  $arr=[];  /* Used to hold the retrieved account details */

  /* Connect to the DB, get the user details and add them to an array */
  $mysqli = new mysqli("localhost","webuser","webuser","fooddb");

  if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    /* Redirect to error page here */
    header('Location: errorPage.php');
    exit;
  }

  $arr = [];
  $customerID = $_SESSION['customerID'];
  $stmt = $mysqli->prepare("CALL getCustomerDetails(?)");
  $stmt->bind_param("s", $customerID);
  $stmt->execute();
  $arr = $stmt->get_result()->fetch_assoc();
  if(!$arr) exit('Customer record not found');
  
  $stmt->close();
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
  
  <!-- My JavaScript-->
  <script type="text/javascript" src="../js/script.js"></script>

  <!-- My stylesheet -->
  <link href="../css/style.css" rel="stylesheet">
  <link href="../css/feedback-form.css" rel="stylesheet">
  
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
    <h1>Change Account Details</h1>    
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

<!-- Main content. -->
<div class="container-fluid"> 
  <div class="row">
    <div class="col col-sm-12 content">
      
      <div class="container">
        <form role="form" name="frmChangeDetails" method="post" action="detailsChanged.php">
          <h1>Change Account Details</h1> 
          <br />
          <label for="lname">Surname</label>
          <input type="text" id="lname" name="lname" value="<?php echo $arr['surname']; ?>"
                 maxlength="35"  autofocus>

          <label for="fname">First Name</label>
          <input type="text" id="fname" name="fname" value="<?php echo $arr['firstname']; ?>"
                 maxlength="35">

          <label for="addr1">Address line 1</label>
          <input type="text" id="addr1" name="addr1" value="<?php echo $arr['addressLine1']; ?>"
                 maxlength="35">

          <label for="addr2">Address line 2 (optional)</label>
          <input type="text" id="addr2" name="addr2" value="<?php echo $arr['addressLine2']; ?>"
                 maxlength="35">

          <label for="pcode">Postcode</label>
          <input type="text" id="pcode" name="pcode" value="<?php echo $arr['postcode']; ?>"
                 maxlength="8">

          <label for="phoneno">Phone number</label>&nbsp;(without spaces e.g., 018118055)
          <input type="text" id="phoneno" name="phoneno" value="<?php echo $arr['phoneNumber']; ?>"
                 maxlength="35">

          <label for="email">Email Address</label>
          <input type="text" id="email" name="email" value="<?php echo $arr['emailAddress']; ?>"
                 maxlength="49">
          <p><i>* You must supply either a valid phone number or email address so that we will be able to contact you.</i></p>
          <button type="submit" class="btn btn-info btn-order" name="changedetails" 
                  value="changedetails"  onClick="return validate_details_change()">CHANGE DETAILS</button>
          
        </form>
        <button class="btn btn-info btn-cancel" name="cancel" 
                  value="cancel"  onClick="location.href='userDetails.php';">CANCEL</button>
        <br />
      </div>      
    </div>
  </div>    <!-- END OF ROW -->
</div>      <!-- END OF CONTAINER-FLUID -->


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


<!-- Login Modal -->
<div class="modal fade" id="loginModal" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="padding:35px 50px;">
        <!-- Close button -->
        <button type="button" class="close" data-dismiss="modal">&times;</button>  
        <h3>Login to your Account </h3>
      </div>
      
      <div class="modal-body" style="padding:40px 50px;">
        <form role="form" name="frmLogin" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">

            <br />
            
            <label for="password"></span> Password</label>
            <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Enter password">
          </div>
          <div class="modal-login-btn">
            <button type="submit" class="btn btn-success btn-block" name="LoginBtn" value="LoginBtn" onClick="return validate_login()">
            Login</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal">Cancel</button>
        <p>Not a member? <a href="registration.php">Sign Up</a></p>
        <p>Forgot <a href="mailto:admin@mailinsrestaurant.com?Subject=Forgotten%20Password">Password?</a></p>
      </div>
    </div> <!-- End of .modal-content -->
  </div>   <!-- End of .modal-dialog -->
</div>     <!-- End of #loginModal -->  

</body>
</html>
