<!--
 * Filename:     registration.php
 * Author:       Andrew Laing
 * Email:        parisianconnections@gmail.com
 * Last updated: 31/05/2019.
 * Description:  The Registration page contain a form which allows
 *               site visitors to create an account for ordering food.
-->

<?php
  include 'includes/loginScripts.inc.php';
   
  /* If there is not an active session start one */
  if (session_status() == PHP_SESSION_NONE) {
     session_start();
  }   
  $_SESSION['registration'] = 1;
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
  
  <script>  
  function checkUsername(str) {
    if (str == "") {
      document.getElementById("usrname").value = "";
      return;
    } 
    else { 
      if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
      } 
      else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }

      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("usrname").value = this.responseText;
        }
      };
      xmlhttp.open("GET","ajaxhandlers/customerExists.php?q="+str,true);
      xmlhttp.send();
    }
  }
  
  </script>
  
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
    <h1>Registration Page</h1>    
  </div>
  
  <!-- Navigation bar -->
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <ul class="nav navbar-nav">
        <li class="active"><a href="../index.php">Home</a></li>
        
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
        <form role="form" name="frmRegister" method="post" action="registered.php">
          <h1>Registration Form</h1> 
          <br />
          <label for="usrname">Username</label>
          <input type="text" id="usrname" name="usrname" placeholder="Choose a unique username ..." 
                 maxlength="35" onchange="checkUsername(this.value)" required="" autofocus >
        
          <label for="pwd">Password</label>
          <input type="password" id="pwd" name="pwd" placeholder="Choose a strong password ..."
                 maxlength="255" required="">
          
          <label for="pwdconfirm">Confirm Password</label>
          <input type="password" id="pwdconfirm" name="pwdconfirm" placeholder="Confirm your password ..." 
                 maxlength="255" required="">

          <label for="lname">Surname</label>
          <input type="text" id="lname" name="lname" placeholder="Your surname ..." 
                 maxlength="35" required="">

          <label for="fname">First Name</label>
          <input type="text" id="fname" name="fname" placeholder="Your first name ..." 
                 maxlength="35" required="">

          <label for="addr1">Address line 1</label>
          <input type="text" id="addr1" name="addr1" placeholder="First line of your address ..." 
                 maxlength="35" required="">

          <label for="addr2">Address line 2 (optional)</label>
          <input type="text" id="addr2" name="addr2" placeholder="Second line of your address ..." 
                 maxlength="35">

          <label for="pcode">Postcode</label>
          <input type="text" id="pcode" name="pcode" placeholder="Your postcode ..." 
                 maxlength="8" required="">

          <label for="phoneno">Phone number</label>&nbsp;(without spaces e.g., 018118055)
          <input type="text" id="phoneno" name="phoneno" placeholder="Your contact number ..." 
                 maxlength="35">

          <label for="email">Email Address</label>
          <input type="text" id="email" name="email" placeholder="Your email address ..."
                 maxlength="49">
          <p><i>* You must supply either a valid phone number or email address so that we will be able to contact you.</i></p>
          <button type="submit" class="btn btn-info btn-order" name="register" 
                  value="register" onClick="return validate_registration()">SUBMIT</button>
        </form>
        <button class="btn btn-info btn-cancel" name="cancel" 
          value="cancel"  onClick="location.href='../index.php';">CANCEL</button>
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
