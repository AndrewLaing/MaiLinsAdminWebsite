<!--
 * Filename:     sendMessage.php
 * Author:       Andrew Laing
 * Email:        parisianconnections@gmail.com
 * Last updated: 31/05/2019.
 * Description:  The Send Message page will be used to confirm to 
 *               the user that the information entered into the 
 *               form on the feedback page has been sent. 
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
    $firstname = 'Deleted';
    $surname = 'Customer';
    $email = 'Not applicable';
    $message = '';

    foreach ($_POST as $key => $value) {
      if ($key == 'msg') {
        $message = $value;             
      } 
    }
     
    
    /* Connect to the DB and insert the feedback message */
    $mysqli = new mysqli("localhost","webuser","webuser","fooddb");

    if ($mysqli->connect_errno) {
      echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
      /* Redirect to error page here */
      header('Location: errorPage.php');
      exit;
    }
    
    /* Prepare the insert statement and add feedback to database */
    if ($stmt = $mysqli->prepare("CALL insertFeedback(?,?,?,?)")) {
      $stmt->bind_param("ssss",$firstname, $surname, $email, $message);
      
      $stmt->execute();   
    }    
    else {
      echo '<br /><br />';
      echo '<h1 class="indentedText">ERROR</h1><p class="indentedText">Unable to delete your account.</p>';
      echo '<br />';
      echo '<p class="indentedText">You will be redirected back to the home page in 5 seconds</p>';

      /* Redirect back to the home page */
      $headerText = 'Refresh:5; url="index.php"';
      header($headerText);
      echo '<br /><br /><br /><br /><br />';
    }
       
    /* close statement and connection */
    $stmt->close();
    
    /* Prepare the delete statement and remove the customer's account */
    if ($stmt = $mysqli->prepare("CALL deleteCustomerDetails(?)")) {
	  $customerID = $_SESSION['customerID'];
      $stmt->bind_param("i",$customerID);
      
      $stmt->execute();   
    }    
    else {
      echo '<br /><br />';
      echo '<h1 class="indentedText">ERROR</h1><p class="indentedText">Unable to delete your account.</p>';
      echo '<br />';
      echo '<p class="indentedText">You will be redirected back to the home page in 5 seconds</p>';

      /* Redirect back to the home page */
      $headerText = 'Refresh:5; url="index.php"';
      header($headerText);
      echo '<br /><br /><br /><br /><br />';
    }
       
    /* close statement and connection */
    $stmt->close();
	

    $mysqli->close();
	
	/* Destroy the current session */
    session_unset(); 

    /* Redirect back to the home page */
    $headerText = 'Refresh:0; url="index.php"';
    header($headerText);

    exit;	
	
	
  ?>
  