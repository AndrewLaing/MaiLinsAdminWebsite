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

<?php
   include 'includes/level_3_user.inc.php'
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
  <script src="../js/bootstrap-hover-dropdown.js"></script>  
  
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
    <h1>Placeholder Delete Order</h1>
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
      <h1>Placeholder</h1> 
      <br />
      <p>
      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit diam, varius ut euismod non, euismod at neque. Donec ultricies sodales justo porta egestas. Cras a mattis elit. Proin ac gravida risus. Integer tempor euismod magna ut semper. Etiam sed mattis augue, id molestie dolor. Sed maximus ex mi, sed lobortis est convallis a. Integer porttitor nisl id lorem mattis ultricies. Nam nec enim vitae quam ultricies blandit non id est. 
      </p>

      <p>
      Vivamus bibendum, quam nec pharetra feugiat, nisi ante pulvinar quam, sed euismod felis erat sed nisl. Nam imperdiet blandit sagittis. Vestibulum nec dolor est. Sed dictum consectetur libero. Donec eu augue elementum, vulputate leo at, consequat tellus. Suspendisse potenti. Sed porttitor dui eu ultricies auctor. Fusce arcu urna, tristique vel elit sed, vehicula efficitur nisl. 
      </p>

      <p>
      Phasellus pellentesque tortor nibh, vel consectetur tortor vehicula sed. Nulla eu orci feugiat, tempus ligula a, varius neque. In eget feugiat massa, vitae consequat diam. Mauris sagittis, erat ut dictum ullamcorper, sapien ante efficitur ex, ut vestibulum justo ligula ut leo. Praesent pharetra finibus dignissim. Aenean eu lacinia dui, eget tristique tellus. Vestibulum vel lectus velit. Ut at ipsum sodales, porttitor lacus non, posuere velit. Donec auctor lectus id pharetra tempus. Fusce id ligula luctus, malesuada augue sit amet, volutpat tortor. Mauris sed tempus libero, eu consequat sem. Sed sed eros velit. Proin consectetur faucibus augue, in tincidunt urna scelerisque a. Proin quis ligula accumsan, varius ex non, convallis dolor. 
      </p>

      <p>
      Integer fermentum sed arcu ultricies porttitor. Vestibulum non augue nulla. Phasellus nisl arcu, mattis quis consectetur sit amet, volutpat ac neque. Cras in lectus molestie quam luctus blandit. Maecenas consectetur iaculis congue. Vivamus vel est sed est bibendum feugiat. Curabitur eget enim eu turpis placerat feugiat sit amet congue magna. Sed interdum nulla eget varius pretium. Donec et malesuada nibh, ut vulputate nisi. In id purus mi. Suspendisse in volutpat lectus. Sed sed enim leo. Phasellus faucibus nisl sit amet efficitur feugiat. Nullam volutpat efficitur ultrices. Sed libero sapien, posuere ut ante a, lobortis pellentesque orci. Proin lectus orci, pretium nec ultrices vel, fermentum eu urna. 
      </p>

      <p>
      Aenean sit amet lectus sollicitudin, faucibus massa nec, imperdiet orci. Duis id purus condimentum, malesuada arcu a, congue sem. Nullam ut enim vitae velit tempor congue ut aliquam dolor. Suspendisse potenti. Nam ac malesuada tellus, tincidunt efficitur lorem. Praesent varius ex at velit viverra, sed consequat quam mollis. Vestibulum lobortis hendrerit turpis, et bibendum nunc ullamcorper a. Sed mi mi, varius hendrerit blandit sit amet, dapibus tincidunt leo. Donec mattis metus id ex interdum, sagittis faucibus mauris pulvinar. Cras id semper diam. Vestibulum ultrices et elit at sollicitudin. 
      </p>

      <p>
      Praesent porttitor mauris ipsum, ultricies ornare massa commodo at. Nunc fermentum arcu et massa auctor, eu euismod purus dignissim. Nullam id orci ac elit suscipit porta vitae a sem. Nullam imperdiet dignissim erat quis porta. Sed placerat, lorem ultricies cursus varius, velit urna aliquet eros, sed bibendum quam justo ac diam. Fusce fringilla id turpis sit amet venenatis. Sed vitae aliquet nisl, nec sodales nibh. 
      </p>

      <p>
      Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed egestas enim ut ipsum tempor commodo. Nullam consectetur purus id turpis eleifend, eu elementum arcu dapibus. Vivamus elementum nulla ut metus faucibus varius. Quisque posuere eros quam, quis mollis libero interdum scelerisque. Aliquam rutrum nisl eget leo porttitor elementum eget vitae diam. Proin tellus ligula, porttitor interdum convallis vel, semper ut massa. Cras sit amet ullamcorper sapien, nec viverra libero. Nunc tellus justo, elementum id lacus sit amet, pharetra accumsan magna. Morbi ultrices sed ex vitae tincidunt. Aliquam pretium eget mi a finibus. Mauris id felis elit. Pellentesque ornare aliquet tellus sed interdum. 
      </p>

      <p>
      Ut faucibus interdum scelerisque. Curabitur sit amet mi risus. Nunc tempor molestie justo vel venenatis. Morbi dolor erat, rhoncus et eleifend eget, placerat non sapien. Suspendisse lorem orci, efficitur tincidunt sem vitae, vestibulum eleifend ante. Mauris nulla risus, fringilla sed mattis eu, iaculis sed mi. In eu justo in purus laoreet auctor et in sapien. 
      </p>

      <p>
      Sed a augue sit amet lacus pretium malesuada id et ligula. Maecenas sagittis mattis dictum. Nam in dolor bibendum nisi mattis dictum ut vel risus. Donec pharetra eros ut enim commodo porta. Sed dolor eros, feugiat blandit mi sed, suscipit commodo diam. Suspendisse vel leo dui. Duis ac urna massa. Maecenas vehicula mi nec arcu convallis, sit amet semper massa pellentesque. Curabitur varius, nisl at vestibulum fermentum, turpis lectus vehicula tellus, ut mollis est nisl nec metus. 
      </p>

      <p>
      Praesent nec tincidunt neque. Mauris at nulla tortor. Maecenas vestibulum orci ut erat egestas, ut fermentum massa lobortis. Vestibulum et porta libero. Aenean lacinia turpis a justo porta, nec suscipit orci tincidunt. Fusce urna odio, egestas quis interdum nec, finibus a dolor. Sed porttitor risus non interdum viverra. Donec congue elementum pharetra. Nulla facilisis congue lacus ac pretium. Nulla tristique dui magna, eu dictum mauris venenatis non. 
      </p>

      <p>
      In vehicula, massa id fermentum eleifend, orci nisl mattis mi, consequat rhoncus mauris ex eget dui. Cras neque tellus, ultricies id erat sit amet, sodales condimentum urna. Duis quis cursus nisi. Duis porta erat sit amet nulla tincidunt sollicitudin. Interdum et malesuada fames ac ante ipsum primis in faucibus. Proin quis arcu hendrerit turpis dictum tincidunt non sit amet magna. In convallis hendrerit tristique. 
      </p>

      <p>
      Donec interdum, velit et feugiat rutrum, metus elit condimentum lorem, eget bibendum lectus velit vitae turpis. In hac habitasse platea dictumst. Etiam auctor turpis a massa pulvinar, ac pharetra tellus pellentesque. Aliquam non vulputate nisi. Morbi ac eros pharetra, finibus ex et, dignissim felis. Cras tempor dolor eget imperdiet pretium. Curabitur ut lacinia libero. Pellentesque ut neque nibh. 
      </p>

      <p>
      Sed sed lacus vitae nunc maximus aliquam eu in justo. Vestibulum aliquet auctor nisi, a blandit dui hendrerit ac. Suspendisse accumsan orci nulla, non auctor turpis pharetra a. Mauris suscipit non eros eu tincidunt. Integer urna nunc, suscipit non vulputate non, sollicitudin nec dui. Sed porta nibh ut ligula venenatis, sit amet tempus eros rhoncus. Mauris nibh augue, accumsan maximus tristique non, fermentum id diam. Morbi et sodales tortor. Cras sagittis odio eget ante tempus, eu sodales nibh vehicula. Praesent elementum enim lectus, ac ultricies arcu efficitur pharetra. Proin imperdiet, mauris vehicula ullamcorper blandit, ipsum dolor tincidunt ligula, at consectetur libero nisi in odio. 
      </p>

      <p>
      Donec quis auctor risus. Praesent eleifend laoreet nisl eget pulvinar. Pellentesque non erat non mauris elementum consectetur. In ut nisi viverra, sollicitudin nibh facilisis, gravida felis. Pellentesque dictum cursus purus, sit amet porttitor leo elementum eget. Suspendisse egestas massa magna. Vivamus quis iaculis purus, ut lobortis justo. Aenean tempor libero at mi luctus congue. Nunc eu pulvinar metus. Nam elementum, tortor in vulputate fermentum, tortor metus tincidunt velit, sit amet sagittis sapien elit quis orci. 
      </p>

      <p>
      Praesent lacus ante, pellentesque eget purus eu, blandit malesuada urna. Aliquam erat volutpat. Maecenas condimentum enim et risus auctor varius. Phasellus mattis pharetra odio, vitae sodales lorem accumsan id. Curabitur odio odio, tristique vel ullamcorper in, sollicitudin in massa. Suspendisse lacinia metus a bibendum fringilla. Vestibulum fermentum ex auctor lorem faucibus aliquet vitae sollicitudin eros. Nulla eleifend fringilla elit. Cras ornare in justo sit amet maximus. Proin a nisl posuere, porttitor tortor ullamcorper, interdum erat. Nunc ut congue lorem. Curabitur vitae ex et mi dictum suscipit. Aliquam turpis lorem, fermentum at porta quis, interdum quis mauris. In sapien elit, tincidunt ac elementum non, tempor et arcu. 
      </p>

      <p>
      Morbi lacinia lobortis nulla nec consectetur. Proin non enim ut mauris euismod auctor a vitae turpis. Phasellus ante ex, dapibus sed elementum a, interdum nec erat. Etiam quis lorem est. Etiam quis egestas justo, a vulputate orci. Cras lobortis lorem ut libero vulputate, ac scelerisque mauris tincidunt. Sed eget fringilla erat, non interdum libero. In id tristique leo, quis venenatis magna. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed nec venenatis ex, vel posuere nisi. Nullam dapibus gravida mi, at gravida dui. Quisque sollicitudin elit quis est mattis, eu auctor odio consectetur. Fusce non finibus purus. Praesent posuere, lacus vitae tempor molestie, lectus massa lacinia purus, ac hendrerit mi mi at quam. Aenean feugiat, urna fringilla gravida pellentesque, orci ex congue risus, ac cursus magna ligula id ex. Aliquam et venenatis ex. 
      </p>

      <p>
      Ut eget venenatis nunc. Vestibulum id turpis et ante sagittis aliquam vitae sed turpis. Nulla ullamcorper at ligula vitae pharetra. Fusce mattis euismod mi, quis posuere massa fermentum viverra. Quisque et tellus pharetra, venenatis arcu a, vehicula enim. Mauris eleifend at ante in dapibus. Mauris posuere arcu ullamcorper urna pretium, in elementum leo suscipit. Donec eu mi nec turpis pulvinar faucibus eu sed ligula. Nullam laoreet placerat leo. Etiam id augue ex. Morbi ultrices elementum enim, vel sodales nulla sagittis at. Morbi sed neque condimentum, vulputate turpis in, faucibus arcu. Ut commodo turpis lorem, eget volutpat eros euismod et. Curabitur ut odio dapibus, varius sem quis, pretium purus. Aliquam lacinia velit in ipsum blandit tristique. Ut fringilla urna sed ante fringilla eleifend. 
      </p>

      <p>
      Phasellus dictum magna malesuada accumsan suscipit. Quisque in nulla vitae justo faucibus varius non et ipsum. Praesent sodales nunc nulla, quis malesuada odio lacinia eu. Integer placerat orci at dui efficitur, vitae cursus tortor rhoncus. Vestibulum venenatis sodales urna, id porta ex volutpat mollis. Nullam congue, felis vel convallis pretium, tortor diam finibus ex, fringilla porta lorem nisi vel nulla. Vivamus nisi lectus, lobortis in mollis vitae, pretium in orci. Mauris purus leo, suscipit id tellus sed, gravida lacinia arcu. Quisque at sem leo. In commodo lorem leo, eu faucibus ante consequat sed. Donec consequat, sem ut ornare placerat, metus libero aliquam tellus, ac aliquam dolor lorem et augue. Nam vulputate leo ut nisi iaculis, eget luctus elit tincidunt. Praesent quis sollicitudin turpis. Curabitur elementum id quam quis placerat. Maecenas fermentum, nisl nec elementum tristique, diam libero tempus nisi, id dignissim ante purus sed erat. Vestibulum nisi neque, elementum id consectetur at, dictum at diam. 
      </p>

      <p>
      Proin lacus ligula, dictum id volutpat a, pellentesque nec felis. Aenean aliquet dolor in lacus consequat, a mollis purus tristique. Morbi eleifend auctor purus, vitae volutpat nunc feugiat luctus. Phasellus a leo non metus fermentum tempor sit amet et magna. Nulla facilisi. Donec eu eros fringilla, faucibus massa sit amet, venenatis sapien. Cras quis dictum nunc. 
      </p>

      <p>
      Sed vel finibus massa. Quisque tellus sem, placerat sit amet sapien vitae, consequat feugiat nisl. Vestibulum rhoncus mollis eros quis finibus. Quisque rutrum malesuada risus. Curabitur et nulla at tellus tristique semper. Morbi et condimentum risus. Duis lobortis quam vel lectus cursus, ac ornare mauris mattis. Nulla vitae mattis turpis, non finibus lacus. Aenean sollicitudin augue quis massa imperdiet, non ultrices lacus rhoncus. Nulla facilisi. Aenean turpis quam, rhoncus quis lectus quis, imperdiet rutrum metus. 
      </p>
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
