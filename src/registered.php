<!--
 * Filename:     registered.php
 * Author:       Andrew Laing
 * Email:        parisianconnections@gmail.com
 * Last updated: 31/05/2019.
 * Description:  The Registered page is used to confirm to the user that 
 *               their information entered into the form on the registration 
 *               page has been sent, an account has been created, and they 
 *               will now be able to log into a personal customer account.
-->

<?php
/* If there is not an active session start one */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
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
          <li class="active"><a href="feedback.php">Feedback</a></li>
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
    $usrname = '';
    $pwd = '';
    $lname = '';
    $fname = '';
    $addr1 = '';
    $addr2 = '';
    $postcode = '';
    $phoneno = '';
    $email = '';

    foreach ($_POST as $key => $value) {
      if ($key == 'usrname') {
        $usrname = $value;  
      }
      else if ($key == 'pwd') {
        $pwd = $value;             
      } 
      else if ($key == 'lname') {
        $lname = $value;              
      } 
      else if ($key == 'fname') {
        $fname = $value;           
      } 
      else if ($key == 'addr1') {
        $addr1 = $value;             
      } 
      else if ($key == 'addr2') {
        $addr2 = $value;               
      } 
      else if ($key == 'pcode') {
        $postcode = $value;           
      } 
      else if ($key == 'phoneno') {
        $phoneno = $value;            
      } 
      else if ($key == 'email') {
        $email = $value;             
      } 
    }

    /* Validate the data POSTed just in case the user has bypassed the Javascript checks
     * or opened the page away from the Change User Details page */
    if(strlen($usrname)==0 || strlen($pwd)==0 || strlen($lname)==0 || strlen($fname)==0 || strlen($postcode)==0 || (strlen($phoneno)==0 && strlen($email)==0) ) {
      echo '<h1>ERROR</h1>';
      echo '<p>There has been a problem processing your data!</p>';
      echo '<p>You will be redirected back to the home page in 5 seconds</p>';
      
      /* Redirect back to the home page */
      $headerText = 'Refresh:5; url="../index.php"';
      header($headerText);

      exit;
    }    
    
    
      /* Connect to the DB and insert the feedback message */
    $mysqli = new mysqli("localhost","webuser","webuser","fooddb");

    if ($mysqli->connect_errno) {
      echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
      /* Redirect to error page here */
      header('Location: errorPage.php');
      exit;
    }
    
    /* Prepare the insert statement */
    if ($stmt = $mysqli->prepare("CALL insertCustomerDetails(?,?,?,?,?,?,?,?,?)")) {
      $stmt->bind_param("sssssssss",$usrname, $pwd, $lname, $fname, $addr1, $addr2, $postcode, $phoneno, $email);
      
      if($stmt->execute()) {
        echo '<br /><br />';
        echo '<h1 class="indentedText">Account created</h1><p class="indentedText">You can now login with your username and password.</p>';
        echo '<br />';
        echo '<p class="indentedText">You will be redirected back to the home page in 5 seconds</p>';

        /* Redirect back to the home page */
        $headerText = 'Refresh:5; url="../index.php"';
        header($headerText);
        echo '<br /><br /><br /><br /><br />';        
      }   
      else {
        echo '<br /><br />';
        echo '<h1 class="indentedText">ERROR</h1><p class="indentedText">Unable to insert record</p>';
        echo '<br />';
        echo '<p class="indentedText">You will be redirected back to the home page in 5 seconds</p>';

        /* Redirect back to the home page */
        $headerText = 'Refresh:5; url="../index.php"';
        header($headerText);

        echo '<br /><br /><br /><br /><br />';
      }

    }    
    else {
      echo '<br /><br />';
      echo '<h1 class="indentedText">ERROR</h1><p class="indentedText">Unable to create account.</p>';
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
