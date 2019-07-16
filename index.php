<!--
 * Filename:     index.php
 * Author:       Andrew Laing
 * Email:        parisianconnections@gmail.com
 * Last updated: 17/06/2019.
 * Description:  Index page for the admin site's home page.
 *               Has navbar dropdown hover functionality.
-->

<?php
   include 'src/includes/loginScripts.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Mai-Lin's Vegan Takeaway Restaurant</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Stylesheets and JS for Bootstrap -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script> 
  <script src="js/bootstrap-hover-dropdown.js"></script> 
  
  <!-- My JavaScript-->
  <script type="text/javascript" src="js/script.js"></script>

  <!-- My stylesheet -->
  <link href="css/style.css" rel="stylesheet">
  
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
    <h1>Database Administration Site</h1> 
  </div>
  
  <!-- Navigation bar -->
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <!-- Create the Left NavBar -->
      <?php
          include 'src/includes/adminNavBarLeft.inc.php';
      ?>

      <!-- Create the Right NavBar -->
      <ul class="nav navbar-nav navbar-right">
        <!-- Generated with PHP to take login status into account -->
        <?php
          if( !(isset($_SESSION['login']) && $_SESSION['login'] != '') ) {
              echo '<li><a href="#" id="loginBtn">Login</a></li>'; 
              session_unset(); 
          }
          else {
              echo '<li><a href="src/myAccount.php">Your Account</a></li>  ';
              echo '<li><a href="javascript:confirm_logout();">Log out</a></li>  ';
          }
        ?> 
      </ul>
    </div>
  </nav>    
</header> <!-- END OF HEADER SECTION -->


<!-- Main content. -->
<div class="container-fluid"> 
  <div class="row">
    <div class="col col-sm-12 content">
      <br /><br />
	    <img class="img-responsive foodImgs" src="imgs/mailinLogo.png" 
           title="Mai-Lin Logo" alt="Mai-Lin Logo" 
           style="max-width: 900px; margin:0px auto;display:block" >
      <br /><br />
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
       Email: <a href="mailto:info@mailinsrestaurant.com?Subject=Table%20booking" 
                 target="_top">info@mailinsrestaurant.com</a><br />
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
        <form role="form" name="frmLogin" method="post" 
              action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" 
                   name="username" placeholder="Enter username">

            <br />
            
            <label for="password"></span> Password</label>
            <input type="password" class="form-control" id="pwd" 
                   name="pwd" placeholder="Enter password">
          </div>
          <div class="modal-login-btn">
            <button type="submit" class="btn btn-success btn-block" name="LoginBtn" 
                    value="LoginBtn" onClick="return validate_login()">
            Login</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal">Cancel</button>

        <p><a href="mailto:admin@mailinsrestaurant.com?Subject=Forgotten%20Password">Forgotten your Password?</a></p>
      </div>
    </div> <!-- End of .modal-content -->
  </div>   <!-- End of .modal-dialog -->
</div>     <!-- End of #loginModal -->   

</body>
</html>
