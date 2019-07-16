<?php
/*
 * Filename:     staffRecordExists.php
 * Author:       Andrew Laing
 * Email:        parisianconnections@gmail.com
 * Last updated: 27/06/2019.
 * Description:  The staffRecordExists script is an AJAX handler used
 *               to ensure that a unique staff username is chosen.
 * Note:         Only staff members with access level 2 or above can access
 *               this page.
 */
   include '../includes/level_2_user.inc.php'
?>

<?php
  /* Turn off error reporting to stop info leaks */
  error_reporting(0);

  /* Used for the AJAX call to determine whether a username already exists in the db or not */
  $username = $_GET['q'];
  $username = htmlspecialchars($username); // Sanitise user input

  /* Connect to the DB, check if the username exists*/
  $mysqli = new mysqli("localhost","webuser","webuser","fooddb");

  if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    /* Redirect to error page here */
    header('Location: ../errorPage.php');
    exit;
  }

  $staffIdExists = -1;

  /* create a prepared statement 
   * Note: staffUsernameExists returns 0 if a username is not already in the database */
  if ($stmt = $mysqli->prepare("SELECT staffUsernameExists(?)")) {

    /* add parameters to the statement */
    $stmt->bind_param("s", $username); 

    /* execute query */
    $stmt->execute();

    /* bind result from function call to orderID */
    $stmt->bind_result($staffIdExists);

    /* fetch value */
    $stmt->fetch();

    /* close statement and connection */
    $stmt->close();
    $mysqli->close();
  }

  /* This text will be added to the username input field */
  if(!$staffIdExists==0) {   
	  echo 'USERNAME ALREADY EXISTS!';	  
  }
  else {
	  echo htmlspecialchars_decode($username);	  
  }
?>
