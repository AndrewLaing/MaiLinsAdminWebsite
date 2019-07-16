<!--
 * Filename:     privacy.php
 * Author:       Andrew Laing
 * Email:        parisianconnections@gmail.com
 * Last updated: 31/05/2019.
 * Description:  The Privacy page contains details about the company’s data privacy policy. 
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
    <h1>Privacy Policy</h1>
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
        <li class="active"><a href="privacy.php">Privacy Policy</a></li>
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
      <h1>Privacy Policy</h1> 
      <br />
      <h2>About this policy</h2>
      <p>Mai-Lin&apos;s Vegan Takeaway Restaurant is committed to protecting your privacy and ensuring that your personal information is handled in a safe and responsible way. This policy outlines how we aim to achieve this and includes the information collected when:</p>
      <p class="indentedText">you use our website www.mailinsrestaurant.com.</p>      
      <p class="indentedText">you make a booking on our website.</p>        
      <p class="indentedText">you make enquiries on our website.</p>        
      <p class="indentedText">someone is interested in working with us.</p>      
      <br />
      
      <h2>Definition of Personal Data</h2>
      <p>Personal Data means any data that relates to an identifiable person who can be directly/indirectly identified from that data. In this case, it means personal data that you give to us via our site.</p>
      <p>By providing your personal data, you agree that we can use your personal data in accordance with this policy.</p>
      <p>Ensure you understand this policy in its entirety and take your time to read it.</p>
      <br /> 
      
      <h2>Who are we?</h2>
      <p>Mai-Lin&apos;s Vegan Takeaway Restaurant is a restaurant/venue based in Liverpool.</p>
      <p>Our registered address is: 78, Seel Street, Liverpool L1 4BH, Merseyside, United Kingdom.</p>
      <br />
      
      <h2>How do we collect information from you?</h2>
      <p>We collect information from you:</p>
      <p class="indentedText">when you make a booking.</p>
      <p class="indentedText">when you visit a restaurant (preferences, allergies etc.).</p>
      <p class="indentedText">make an enquiry.</p>
      <br />
      
      <h2>What type of information is collected from you?</h2>
      <p>You may be asked to submit personal information about yourself when you make a booking. We will collect this information so that we can fulfil your booking request and you may dine at our venue.</p>
      <br />
      <h3>When you make a booking Mai-Lin&apos;s Vegan Takeaway Restaurant collects information such as:</h3>
      <p class="indentedText">Title</p>
      <p class="indentedText">Name</p>
      <p class="indentedText">E-mail address (used for booking confirmation and post-dining feedback emails)</p>
      <p class="indentedText">Home or work address</p>
      <p class="indentedText">Billing information taken for deposits, ticketing, or holding credit card information for use in the case of no-shows (where applicable)</p>
      <p class="indentedText">Telephone number</p>
      <br />
      
      <h3>When you dine at Mai-Lin&apos;s Vegan Takeaway Restaurant:</h3>
      <p class="indentedText">Survey responses</p>
      <p class="indentedText">Current and past restaurant reservation details</p>
      <br />
      
      <h3>When you access our sites there is &quot;Device Information&quot; about your computer hardware and software that is automatically collected by Mai-Lin&apos;s Vegan Takeaway Restaurant. This information can include:</h3>
      <p class="indentedText">Device type (e.g. mobile, computer, laptop, tablet)</p>
      <p class="indentedText">Cookies</p>
      <p class="indentedText">Operating System</p>
      <p class="indentedText">IP address</p>
      <p class="indentedText">Browser type</p>
      <p class="indentedText">Browser information (e.g., type, language, and history)</p>
      <p class="indentedText">Domain names</p>
      <p class="indentedText">Access times</p>
      <p class="indentedText">Settings</p>
      <p class="indentedText">Referring website addresses</p>
      <p class="indentedText">Other data about your device to provide the services as otherwise described in this policy.</p>
      <br />
      
      <h3>Location information:</h3>
      <p class="indentedText">If you use our website, we may receive your generic location (such as city or neighbourhood).</p>
      <br />
      
      <h3>Careers:</h3>
      <p>You may submit your CV if you&apos;re interested in working for us to info@mailinsrestaurant.com. This information may include:</p>
      <p class="indentedText">Personal details</p>
      <p class="indentedText">Employment details</p>
      <p class="indentedText">Education</p>
      <p class="indentedText">Salary details</p>
      <p class="indentedText">Other relevant details</p>
      <br />
      <p>We will use this information to assess your application. We may also keep it in our records for future reference. Please get in contact if you would no longer like us to hold your records at:</p>
      <p class="indentedText">admin@mailinsrestaurant.com</p>
      <br />
      
      <h2>How is your information used?</h2>
      <p>Our use of your personal data will always have a lawful basis, either because it is necessary to complete a booking, because you have consented to our use of your personal data (e.g. by subscribing to emails), or because it is in our legitimate interests.</p>
      <p>We require the information outlined in the previous section to understand your needs and provide you with a better service, and in particular for the following reasons:</p>
      <p class="indentedText">Internal record keeping.</p>
      <p class="indentedText">Send you service emails (booking confirmation and post-dining feedback).</p>
      <p class="indentedText">Improving our products and services.</p>
      <p class="indentedText">We may use the information to customise the website according to your interests.</p>      
      <br />
      
      <h2>Who has access to your information?</h2>
      <p>We will not sell, distribute, or lease your personal information to third parties. Any personal information we request from you will be safeguarded under current legislation.</p>
      <p>We will only share your information with companies if necessary to deliver services on our behalf.</p>
      <p>You may choose to restrict the collection or use of your personal information at any point.  Please refer to the Your Choices section of this Privacy Policy for details.</p>
      <br />
      
      <h2>How and where do we store data? </h2>
      <p>We only keep your personal data for as long as we need to in order to use it as described in this privacy policy, and/or for as long as we have your permission to keep it.</p>
      <p>For reservations taken, your data will only be stored in the UK. </p>
      <p>Data is stored securely in data centres managed by Rackspace.</p>
      <br />
      
      <h2>Profiling</h2>
      <p>We may analyse your personal information to create a profile of your interests and preferences so that we can contact you with information relevant to you. We may make use of additional information about you when it is available from external sources to help us do this effectively.</p>
      <br />
 
      <h2>Your choices</h2>
      <p>We will not contact you for marketing purposes by email, phone or text message unless you have given your prior consent. We will not pass your details to any third parties for marketing purposes unless you have expressly permitted us to. Furthermore, you can change your marketing preferences at any time by contacting us by email at info@mailinsrestaurant.com.</p>
      <p>You have a right to request a copy of the personal information that Mai-Lin&apos;s Vegan Takeaway Restaurant holds about you and have any inaccuracies corrected. Any such requests should be made to this email address: admin@mailinsrestaurant.com.</p>
      <p>You have the right to withdraw your consent to us using your personal data at any time, and to request that we delete it. We do not keep your personal data for any longer than is necessary in light of the reason(s) for which it was first collected.</p>
      <br />
 
      <h2>Security</h2>
      <p>Data security is very important to us, and to protect your data we have taken suitable measures to safeguard and secure data collected through our Site.</p>
      <br />
 
      <h2>Use of &apos;cookies&apos;</h2>
      <p>Like many other websites, we use cookies. We use them to help you personalise your online experience.</p>
      <p>A cookie is a text file that is placed on your hard disk by a web page server which allows the website to recognise you when you visit. Cookies only collect data about browsing actions and patterns, and do not identify you as an individual.</p>
      <p>We use cookies for the following purposes </p>
      <p class="indentedText">Authentication, personalisation and security: cookies help us verify your account and device and determine when you log in, so we can make it easier for you to access the services and provide the appropriate experiences and features. We also use cookies to help prevent fraudulent use of login credentials.</p>
      <p class="indentedText">Performance and analytics: cookies help us analyse how the services are being accessed and used, and enable us to track the performance of the services. For example, we use cookies to determine if you viewed a page or opened an email. This helps us provide you with information that you find interesting. We also use cookies to provide insights regarding your End Users and your sites&apos; performance, such as page views, conversion rates, device information, visitor IP addresses, and referral sites.</p>
      <p>Opting Out: You can set your browser to not accept cookies, but this may limit your ability to use the services.</p>
      <p>Our Site may contain links to other websites. Please note that we have no control over how your data is collected, stored, or used by other websites and we advise you to check the privacy policies of any such websites before providing any data to them.</p>
      <br />
 
      <h2>What happens if our business changes hands?</h2>
      <p>We may, from time to time, expand or reduce our business and this may involve the sale and/or the transfer of control of all or part of our business. Any personal data that you have provided will, where it is relevant to any part of our business that is being transferred, be transferred along with that part. The new owner or newly controlling party will, under the terms of this Privacy Policy, be permitted to use that data only for the same purposes for which it was originally collected by us.</p>
      <p>In the event that any of your data is to be transferred in such a manner, you will be contacted in advance and informed of the changes.</p>
      <p>In addition to providing you with more customised service, we may, as permitted by applicable law, share your information with our restaurant affiliates to support operations, such as to perform analytics, tailor marketing to you, support a loyalty program that you have chosen to participate in, and improve services.</p>
      <p>For more information, please feel free to contact us at: info@mailinsrestaurant.com</p>
      <br />

      <h2>Changes to this statement</h2>
      <p>Mai-Lin&apos;s Vegan Takeaway Restaurant will occasionally update this Privacy Policy to reflect company and customer feedback. Mai-Lin&apos;s Vegan Takeaway Restaurant encourages you to periodically review this statement to be informed of how Mai-Lin&apos;s Vegan Takeaway Restaurant is protecting your information. This policy was last updated in November 2018.</p>
      <br />     

      <h2>Contact Information</h2>
      <p>Mai-Lin&apos;s Vegan Takeaway Restaurant welcomes your comments regarding this Privacy Policy. If you believe that Mai-Lin&apos;s Vegan Takeaway Restaurant has not adhered to this Privacy Policy, please contact Mai-Lin&apos;s Vegan Takeaway Restaurant at info@mailinsrestaurant.com. We will aim to use commercially reasonable efforts to promptly determine and remedy the problem.</p>
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
