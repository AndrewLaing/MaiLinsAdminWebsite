<!--
 * Filename:     changeMyPassword.php
 * Author:       Andrew Laing
 * Email:        parisianconnections@gmail.com
 * Last updated: 31/05/2019.
 * Description:  The Change Password page enables staff members
 *               to change their password.
-->


<?php
   include 'includes/loginScripts.inc.php'
?>

<?php
   include 'includes/level_0_user.inc.php'
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
    <h1>Change My Password</h1>
  </div>
  
  <!-- Navigation bar -->
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <!-- Create the Left NavBar -->
        <?php
          include 'includes/adminNavBarLeft.inc.php';
        ?>
      <!-- Create the Right NavBar -->
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
    <div class="col col-sm-12 content">
      <div class="container">
        <form role="form" name="frmChangePwd" method="post" action="myStaffPasswordChanged.php">
          <h1>Change password</h1><br />
          <label for="currentpwd">Current Password</label>
          <input type="password" id="currentpwd" name="currentpwd" placeholder="Your current password ..." maxlength="254" autofocus>

          <label for="newpwd">New Password</label>
          <input type="password" id="newpwd" name="newpwd" placeholder="Choose a new password ..." maxlength="254">

          <label for="confirmnew">Confirm Password</label>
          <input type="password" id="confirmnew" name="confirmnew" placeholder="Confirm new password ..." maxlength="254">

          <button type="submit" class="btn btn-info btn-order" name="submitfeedback" value="submitfeedback"
                    onClick="return validate_change_pwd()">CHANGE PASSWORD</button>
        </form>
        <button class="btn btn-info btn-cancel" name="cancel" 
                  value="cancel"  onClick="alert('Changes cancelled'); window.location = 'myAccount.php'; ">CANCEL</button>
        <br /><br />
      </div>    
    </div>    
  </div>    <!-- END OF ROW -->
</div>      <!-- END OF CONTAINER-FLUID -->


<!-- Footer -->
<footer class="footer footerDivs">
<!-- Create the footer contents -->
  <?php
    include 'includes/footerContents.inc.php';
  ?>
</footer> <!-- END OF FOOTER SECTION -->

<!-- LOGIN modal removed because page can only be viewed if user is logged in. -->

</body>
</html>
