<!--
 * Filename:     passwordChanged.php
 * Author:       Andrew Laing
 * Email:        parisianconnections@gmail.com
 * Last updated: 31/05/2019.
 * Description:  The Password Changed page is used to confirm 
 *               to the user that their password has been changed 
 *               to that entered on the form in the changePassword.php page. 
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
function changePassword() {
  $customerID = '';
  $currentpwd = '';
  $newpwd = '';
  
  /* Get the current customerID from the session cookie */
  $customerID = $_SESSION['customerID'];

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
    $headerText = 'Refresh:5; url="../index.php"';
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
    $SQL = $mysqli->prepare('CALL checkPasswordIDCombo(?,?)');
    $SQL->bind_param('is', $customerID, $currentpwd);
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
        $SQL = $mysqli->prepare('CALL updatePassword(?,?)');
        $SQL->bind_param('is', $customerID, $newpwd);
        if ($SQL->execute()) {
          echo '<br />';
          echo '<h1 class="indentedText">Success</h1><p class="indentedText">Your password has been changed.</p>';
          echo '<p class="indentedText">Click <a href="../index.php">here</a> to return to the home page.</p>';
          echo '<br />';
        }
        else {
          echo '<br />';
          echo '<h1 class="indentedText">Error</h1><p class="indentedText">Unable to change password.</p>';
          echo '<p class="indentedText">Click <a href="changePassword.php">here</a> to return to previous page.</p>';
          echo '<br />';
        }
        $mysqli->close(); 
      }
    }
    /* If the user has entered their current password incorrectly, print an error message */
    else {
        echo '<br />';
        echo '<h1 class="indentedText">Error</h1><p class="indentedText">You have entered your current password incorrectly.</p>';
        echo '<p class="indentedText">Click <a href="changePassword.php">here</a> to return to previous page.</p>';
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
      <h1>Change Password</h1>  
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
    changePassword();
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
