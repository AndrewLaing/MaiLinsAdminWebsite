<!--
 * Filename:     about.php
 * Author:       Andrew Laing
 * Email:        parisianconnections@gmail.com
 * Last updated: 31/05/2019.
 * Description:  The About page contains general details about the chef, 
 *               veganism, and the restaurant.
-->
<?php
   include 'includes/loginScripts.inc.php'
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
    <h1>About us</h1>
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
        
        <li class="active"><a href="about.php">About us</a></li>
        <li><a href="feedback.php">Feedback</a></li>
        <li><a href="privacy.php">Privacy Policy</a></li>
        <li><a href="termsandconditions.php">Terms and Conditions</a></li>
      </ul>
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
  <div class="row">
    <div class="col col-sm-7 content">
      <h1>About us</h1> 
  	  <p>Our chef, Mai-Lin Tien, is passionate about using locally-produced organic vegetables in her original vegan recipes.</p>
	    <p>Born to a family of Cambodian refugees who fled to England to escape the atrocities of the Khmer Rouge in the 1970's, Tien has spent her formative years celebrating her new-found freedom amongst the emerging Punk subculture where she first encountered Vegan ethics. Tien was always passionate about cooking and was taught the basics by her father, a traditional Phnom Penh street-food chef, from an early age.</p>
	    <p>Tien's recipes are renowned by the local vegan community and her restaurant has been visited by celebrities such as James Cameron, Taylor Swift and Paul McCartney.</p>
	    <p>Mai-Lin's Vegan Takeaway Restaurant only uses the freshest vegan-friendly ingredients. If you have any allergies, please let us know in advance. Any requests for vegan specialities not on the menu will be considered as Tien is always looking to expand her repertoire.</p>
      <br />
      <h1>What is Veganism</h1>
	    <p>Veganism is a way of living which seeks to exclude, as far as is possible and practicable, all forms of exploitation of, and cruelty to, animals for food, clothing or any other purpose.</p>
      <p>There are many ways to embrace vegan living. Yet one thing all vegans have in common is a plant-based diet avoiding all animal foods such as meat (including fish, shellfish and insects), dairy, eggs and honey - as well as products like leather and any tested on animals. </p>
      <p>Vegans avoid exploiting animals for any purpose, with compassion being a key reason many choose a vegan lifestyle. From accessories and clothing to makeup and bathroom items, animal products and products tested on animals are found in more places than you might expect. Fortunately nowadays there are affordable and easily-sourced alternatives to just about everything.</p>
      <br />
      <h1>Visit our restaurant</h1>
	    <p>At the foundation of our popular takeaway service is our restaurant. Situated in the heart of Liverpool on Seel Street, Mai-Lin's Vegan Takeaway Restaurant serves food throughout the day in a relaxed traditional Cambodian atmosphere. Our restaurant has served impressive Vegan cuisine since 1984. There is seating for up to 50 people and group bookings are accepted one day in advance.</p>
	    <p>Our friendly staff are waiting to serve you. We sincerely hope that you will enjoy our food.</p>	
	    <br />
	  </div>
	  <div class="col col-sm-1 content">
	    <br />
    </div>
	  <div class="col col-sm-4 content">
	    <br />
      <img class="img-responsive foodImgs" src="../imgs/tien.png" alt="Mai-Lin Tien" title="Mai-Lin Tien">	  
	    <br /><p>Enjoy the unique food prepared by our famous Vegan chef Mai-Lin Tien</p>	  <br />	  <br />
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
