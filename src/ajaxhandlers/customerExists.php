<?php
/*
 * Filename:     customerExists.php
 * Author:       Andrew Laing
 * Email:        parisianconnections@gmail.com
 * Last updated: 27/06/2019.
 * Description:  The customerExists script is an AJAX handler used
 *               by the registration form to ensure that the user
 *               chooses a unique username.
 */
  /* Turn off error reporting to stop info leaks */
  error_reporting(0);

  /* Used for the AJAX call to determine whether a username already exists in the db or not */
  $usrName = $_GET['q'];
  $usrName = htmlspecialchars($usrName); // Sanitise user input

  /* Connect to the DB, check if the username exists*/
  $mysqli = new mysqli("localhost","webuser","webuser","fooddb");

  if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    /* Redirect to error page here */
    header('Location: ../errorPage.php');
    exit;
  }

  $customerIdExists = -1;

  /* create a prepared statement 
   * Note: usernameExists returns 0 if a username is not already in the database */
  if ($stmt = $mysqli->prepare("SELECT usernameExists(?)")) {

    /* add parameters to the statement */
    $stmt->bind_param("s", $usrName); 

    /* execute query */
    $stmt->execute();

    /* bind result from function call to orderID */
    $stmt->bind_result($customerIdExists);

    /* fetch value */
    $stmt->fetch();

    /* close statement and connection */
    $stmt->close();
    $mysqli->close();
  }

  /* This text will be added to the username input field */
  if(!$customerIdExists==0) {   
	  echo 'USERNAME ALREADY EXISTS!';	  
  }
  else {
	  echo htmlspecialchars_decode($usrName);	  
  }
?>
