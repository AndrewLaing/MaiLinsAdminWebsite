<!--
 * Filename:     termsandconditions.php
 * Author:       Andrew Laing
 * Email:        parisianconnections@gmail.com
 * Last updated: 31/05/2019.
 * Description:  The Terms and Conditions page contains details about 
 *               the company’s terms and conditions for use of its site 
 *               and restaurant. 
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
    <h1>Terms and Conditions</h1>
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
        <li class="active"><a href="termsandconditions.php">Terms and Conditions</a></li>
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
      <h1>Terms and Conditions</h1> 
      <br />
      
      <h2>Allergen and Menu Information</h2>
      <p>Our chefs aim to prepare most of our foods from scratch to offer you a wide range of delicious dishes through a range of seasonal ingredients; therefore, please do not be deterred if you do not find one of your favourite dishes on the menu on a particular day.</p>
      <p>We will only serve vegan dishes. Our chefs are all vegans themselves and will not prepare non-vegan dishes.</p>
      <p>Please be aware when our chefs are cooking, we use and handle nuts and other allergens in many of our dishes. Should you have any special dietary requirements, please inform a member of staff immediately who will ask a Senior Chef to speak with you to explain our menu and upon request can make a specific dish for you.</p>
      <br />
      
      <h2>Car Park Area and Facilities</h2>
      <p>Car parking facilities are provided free of charge (subject to availability).</p>
      <p>Car parking facilities are only available for Mai-Lin&apos;s Vegan Takeaway Restaurant guests for a maximum period of two hours.</p>
      <p>Any vehicle left unattended overnight on the premises may be clamped and an appropriate fee will be payable to the third party for release.</p>
      <p>Management will not take any responsibility or liability for any theft, loss or damage to your personal property in the car park area.</p>
      <p>Management do not take any liability or responsibility for any damages and/or cleaning costs.</p>
      <br />
      
      <h2>General</h2>
      <p>Please do not leave any belongings unattended at any given time, Mai-Lin&apos;s Vegan Takeaway Restaurant will not be held responsible for any loss, theft or damage to your personal belongings.</p>      
      <p>Management do not take any responsibility or liability for any accident occurred with any unattended children during your visit to the restaurant, so kindly assist your children at all times during your visit to our restaurant.</p>      
      <p>Food and drinks items must only be consumed within the premises only. You are not permitted to take any food or drinks outside of the Restaurant building. If seen, an additional non-refundable charge will be applied to your bill at the manager&apos;s discretion.</p>      
      <p>No personal food and drink items are to be brought inside the restaurant premises.</p>      
      <p>Management has the right to refuse entry to any guests as this is a private property.</p>      
      <p>We make every effort to have high chair availability for your visit however it is subject to demand and at peak hours we do not guarantee this unless you confirmed this requirement at the time of booking.</p>      
      <br />
      
      <h2>Reservation Information</h2>
      <p>All table bookings are for a maximum of two hours, should your dining time exceed this or at particularly busy times, we may request you to vacate your table if required in busy hours.</p>
      <p>Any large groups of 10 or more will be required to pay a deposit of £5 per person. This deposit will then be deducted from the final bill amount.</p>
      <p>If the number of people in your booking is decreasing or increasing, please inform us at least 24 hours prior to your booking so that we can try our best to accommodate any changes. Please note that any deposits that have already been processed may be lost if there are any no-shows, which will be at the discretion of management.</p>
      <p>Kindly present a copy of your bill if requested, management reserves full right to question any guest in the restaurant premises and car park area.</p>
      <br />
   
      <h2>Smoking Area</h2>
      <p>Smoking is not permitted inside the restaurant premises under any circumstances; there is a designated smoking shelter available for guests to use, management requests guests to use this shelter any time they wish to smoke.</p>    
      <p>All cigarette buds must be fully extinguished after you have finished smoking and disposed of in the smoking bin provided by the shelter.</p>
      <p>Drinks are not permitted to be taken outside of the restaurant.</p>
      <br />
      
      <h2>Threatening Behaviour</h2>
      <p>At Mai-Lin&apos;s Vegan Takeaway Restaurant, we ensure we always follow a safe environment policy and protect the safety of all employees and guests.</p>
      <p>Any inappropriate behaviour including but not limited to physical or violent threats or actions towards any employees, members of management or guests will not be tolerated.</p>
      <p>Where necessary the police will be informed and you will be removed from the building.</p>
      <br />
      
      <h2>Special Occasions and Seasonal Events</h2>
      <p>If you choose to book your special occasion with us, or visit Mai-Lin&apos;s Vegan Takeaway Restaurant when there is a seasonal event, please note we can only confirm bookings after a deposit has been paid regardless of your booking size.</p>
      <p>Once deposits have been received only then are we able to guarantee your booking, if we do not receive a deposit for your booking within the required time frame, we reserve the right to cancel you&apos;re booking at any time without notice.</p>
      <p>Deposit amounts can vary depending on the booking size and seasonal event, please contact the Mai-Lin&apos;s Vegan Takeaway Restaurant team for further information.</p>
      <br />
      
      <h2>Special Offers/Promotional Prices</h2>
      <p>From time to time we may advertise and publish promotional prices and/or special offers however, in the event of any unforeseen circumstance management reserves the right to alter, amend or foreclose these promotions without prior notice.</p>
      <p>Such offers are always subject to availability.</p>
      <p>Such offers will only apply on limited days.</p>
      <p>We reserve the right to change our published rates at any time with or without notice.</p>
      <p>At certain times of the year our standard rates may not be valid, or be restricted.</p>
      <p>Upon arrival please ensure you advise the Mai-Lin&apos;s Vegan Takeaway Restaurant team if you have come into dine with us as part of a promotion, so we can confirm with you whether the promotion is still valid or had been withdrawn.</p>
      <br />
    
      <h2>NHS and Emergency Services</h2>
      <p>The NHS and Emergency Services do an excellent job and we want to say Thank you! At Mai-Lin&apos;s Vegan Takeaway Restaurant we offer a 10% off discount to all NHS employees and all Blue Light and Defence Privilege Cardholders comprising of the Police, Fire and Ambulance services. It&apos;s available Monday to Thursday on your Food Bill only. To redeem this offer, all you need to do is show a Photo/Work ID, Blue Light Card or Defence Privilege Card. All Terms and Conditions are listed below.</p>
      <h3>Terms & Conditions</h3>
      <p>15% discount valid Monday to Thursday 12pm to close (excluding special occasions and bank holidays).</p>
      <p>Only valid on the cardholders bill once having presented valid ID.</p>
      <p>Only redeemable against the food bill only.</p>
      <p>Cannot be used in conjunction with any other offer or loyalty scheme.</p>
      <p>Mai-Lin&apos;s Vegan Takeaway Restaurant reserves the right to revoke the promotion at any time.</p>
      <br />
      <br />
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
