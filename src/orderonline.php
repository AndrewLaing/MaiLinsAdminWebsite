<!--
 * Filename:     orderonline.php
 * Author:       Andrew Laing
 * Email:        parisianconnections@gmail.com
 * Last updated: 31/05/2019.
 * Description:  The Order Online page is the site’s shopping page where 
 *               customers can place delivery orders for food. It contains
 *               tabs of different food categories and a shopping basket 
 *               showing the customer's currently selected items. 
-->

<?php
   include 'includes/loginScripts.inc.php'
?>

<?php
  /* Connect to the DB, get the product details and add them to an array */
  $mysqli = new mysqli("localhost","webuser","webuser","fooddb");

  if ($mysqli->connect_errno) {
    /* Redirect to error page here */
    header('Location: errorPage.php');
    exit;
  }

  /* Run the query */
  if (! ($query = $mysqli->query("CALL getAllProductDetails()"))) {
    /* Redirect to error page here */
    header('Location: errorPage.php');
    exit;
  }
  else { 	
    $result = [];
    $counter = 1;

    while($row = $query->fetch_assoc()) {
	  $result[$counter] = $row;
	  $counter++;
    }
  }
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
  
  
  <?php	
    /*
     * The function createItemHTML is used to add the menu items to the tabs
	 */
	function createItemHTML($category, $queryresult) {
		if($queryresult==null) {
		  echo "Unable to load menu items";
		  exit;
		}
		
		/* These variables are used to keep the HTML creation code manageable */
		$htmlPart1  = '<div class="col col-sm-4"><img class="img-responsive foodImgs" src="../imgs/';
		$htmlPart2  = '" alt="';	
		$htmlPart3  = '" title="';
		$htmlPart4  = '"><br /><h2>';
		$htmlPart5  = '</h2><p>';	
		$htmlPart6  = '</p><p>Price: &pound;';	
		$htmlPart7  = '<br />Quantity: <a id="'	;
		$htmlPart8  = 'numberOfItems">0</a></p><button type="button" class="btn btn-info btn-add" value="';
		$htmlPart9  = '" onClick="onClickAdd(this)">Add to basket</button><button type="button" class="btn btn-info btn-subtract" value="';
		$htmlPart10 = '" onClick="onClickSubtract(this)">&mdash;</button><button type="button" class="btn btn-info btn-remove" value="';
		$htmlPart11 = '" onClick="onClickRemove(this)">X</button><br />';
		$htmlPart12 = '<input type="hidden" id="';
		$htmlPart13 = 'hidden" name="';
		$htmlPart14 = 'hidden" value="0"></div>';	

		/* Add the items from the query results to the page */
		$count = 1;
		foreach($queryresult as $row) {
		  if($row['category']==$category) {
			  echo $htmlPart1 . $row['imageFileName'] . $htmlPart2 . $row['itemName'];
			  echo $htmlPart3 . $row['itemName'] . $htmlPart4 . $row['itemName'];
			  echo $htmlPart5 . $row['description'] . $htmlPart6 . $row['price'];
			  echo $htmlPart7 . $row['itemID'] . $htmlPart8 . $row['itemID'];
			  echo $htmlPart9 . $row['itemID'] . $htmlPart10 . $row['itemID'] . $htmlPart11;
			  echo $htmlPart12 . $row['itemID'] . $htmlPart13 . $row['itemID'] . $htmlPart14;
			
			  /* Add a 'newline' after every 3 items */
			  if($count%3==0) {
				  echo '<div id="food"  class="col col-sm-12"><br /><br /></div>';
			  }
			
			  $count++;
		  }
		}
	}
 
	/*
     * The function createArrays is used to add the JS arrays used for the menu items
	 */
	function createArrays($queryresult) {
		$arraysToAdd = '<script type="text/javascript">';
		$itemsArray = 'var items = ["';
		$pricesArray = ' var prices = [0';
		
		foreach($queryresult as $row) {
			$itemsArray = $itemsArray . '", "' . $row['itemName'];
			$pricesArray = $pricesArray . ', ' . $row['price'];
		}
		
		$itemsArray = $itemsArray . '"];';
		$pricesArray = $pricesArray . '];';
		$arraysToAdd = $arraysToAdd . $itemsArray  .  $pricesArray . '</script>';
		
		echo $arraysToAdd;
	}

	/* Create the JS arrays (items and prices) needed for the items */
	createArrays($result);
  ?>    
  
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
    <h1>Order Food Online</h1>
  </div>
  
  <!-- Navigation bar -->
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <ul class="nav navbar-nav">
        <li><a href="../index.php">Home</a></li>
        <li class="active"><a href="orderonline.php">Order online</a></li>
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

<!-- Main content. Food items and basket sections. -->
<div class="container-fluid"> 

  <!-- Order Form  -->
  <form role="form" method="post" action="placeOrder.php">    
  
  <div class="row">
  
    <!-- Food items section. This div spans 8 columns of the grid. -->
    <div class="col col-sm-8 content">
	<br />
      <h1>Menu Items</h1>
		  
		  <!-- Add the nav pills -->
		  <ul class="nav nav-pills">
			<li class="active"><a data-toggle="pill" href="#menu1">Appetisers</a></li>
			<li><a data-toggle="pill" href="#menu2">Salads</a></li>
			<li><a data-toggle="pill" href="#menu3">Noodles</a></li>
			<li><a data-toggle="pill" href="#menu4">Rice Plates</a></li>
			<li><a data-toggle="pill" href="#menu5">Entrees</a></li>
			<li><a data-toggle="pill" href="#menu6">Specialities</a></li>
			<li><a data-toggle="pill" href="#menu7">Claypots</a></li>
			<li><a data-toggle="pill" href="#menu8">Side Orders</a></li>
			<li><a data-toggle="pill" href="#menu9">Desserts</a></li>
			<li><a data-toggle="pill" href="#menu10">Beverages</a></li>
		  </ul>
		  <br />
		  <!-- Add the menu items to the tab content -->
      <div class="tab-content">  
		    <div id="menu1" class="col col-sm-12 tab-pane fade in active">
		  	  <h2>Appetisers</h2>
          <br />        
          <?php createItemHTML("Appetisers", $result); ?>
        </div>

        <div id="menu2" class="col col-sm-12 tab-pane fade">
          <h2>Salads</h2>
          <br />    
          <?php createItemHTML("Salads", $result); ?>
        </div>	
        
        <div id="menu3" class="col col-sm-12 tab-pane fade">
          <h2>Noodles</h2>
          <br />        
          <?php createItemHTML("Noodles", $result); ?>
        </div>   

        <div id="menu4" class="col col-sm-12 tab-pane fade">
          <h2>Rice Plates</h2>
          <br />    
          <?php createItemHTML("RicePlates", $result); ?>
        </div>

        <div id="menu5" class="col col-sm-12 tab-pane fade">
          <h2>Entrees</h2>
          <br />        
          <?php createItemHTML("Entrees", $result); ?>  
        </div>

        <div id="menu6" class="col col-sm-12 tab-pane fade">
          <h2>Specialities</h2>
          <br />       
          <?php createItemHTML("Specialities", $result); ?>
        </div>

        <div id="menu7" class="col col-sm-12 tab-pane fade">
          <h2>Claypots</h2>
          <br />      
          <?php createItemHTML("Claypots", $result); ?>
        </div>

        <div id="menu8" class="col col-sm-12 tab-pane fade">
          <h2>Side Orders</h2>
          <br />      
          <?php createItemHTML("SideOrders", $result); ?> 
        </div>

        <div id="menu9" class="col col-sm-12 tab-pane fade">
          <h2>Desserts</h2>
          <br />      
          <?php createItemHTML("Desserts", $result); ?>
        </div>

        <div id="menu10" class="col col-sm-12 tab-pane fade">
          <h2>Beverages</h2>
          <br />     
          <?php createItemHTML("Beverages", $result); ?>
        </div>
		  
      </div> <!-- End of tab-content -->
    </div>
	
	
    <!-- Basket sidebar. This div spans 4 columns of the grid-->
    <div class="col col-sm-4">
      <aside class="right-sidebar">
	      <br />
        <h1>Basket</h1>
		    <!-- <br /> -->
        
        <!-- Subtotal list -->
        <div>
          <h2>Your order</h2>
          <p id="subtotal"></p>
        </div>
        
        <!-- Total price of the order -->
        <div>
          <h2>Total</h2>
          <p id="ordertotal">&pound;0.00</p>
        </div>

        <br />

        <div class="form-group">
          <label class="deliveryInput" for="deliveryDate">Date of delivery</label>
          <?php
              /* Add todays date as the value and the minimum delivery date */
              $today = date("Y-m-d");
              echo '<input class="deliveryInput" type="date" id="deliveryDate" name="deliveryDate"';
              echo 'value="' . $today . '" min="' . $today . '" max="2019-12-31"/>';
          ?>

          <br /><br />
          
          <label class="deliveryInput" for="deliveryTime" style="width: 150px">Time of delivery</label>
          <input class="deliveryInput" type="time" id="deliveryTime" name="deliveryTime"
                 value="18:00" min="00:00" max="23:59" required />
        </div>
        
        <!-- Submit button -->        
        <div>
          <button type="submit" class="btn btn-info btn-order" name="placeorder" value="placeorder">Place Order</button>	
        </div>
      </aside><!-- .right-sidebar -->
    </div>  <!-- END OF CHECKOUT-SIDEBAR -->
    
    </form> <!-- End of Form for placing order -->
    
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
