<?php
/*
 * Filename:     searchCustomerRecordsHandler.php
 * Author:       Andrew Laing
 * Email:        parisianconnections@gmail.com
 * Last updated: 26/06/2019.
 * Description:  This page can only be accessed by staff members with access
 *               level 2 or above.
 *               The page handles the requests for customer records from the 
 *               view/update/delete/insert Customer records pages. 
 * Notes:        Requires four parameters;
 *                  customerID, username, surname, position
 */

   include '../includes/level_2_user.inc.php'
?>

<?php 

/* Turn off error reporting to stop info leaks */
error_reporting(0);

$customerID = $_REQUEST['customerID']; 
$username = "%" . $_REQUEST['username'] . "%"; 
$surname = "%" . $_REQUEST['surname'] . "%"; 

/* Connect to the DB, get the product details and add them to an array */
$mysqli = new mysqli("localhost","webuser","webuser","fooddb");

if ($mysqli->connect_errno) {
  /* Redirect to error page here */
  header('Location: ../errorPage.php');
  exit;
}

if(strlen($customerID)>0) {
  $stmt = $mysqli->prepare("CALL getCustomerDetailsByIDNumber(?)");
  $stmt->bind_param("s", $customerID);
} 
else if(strlen($username)>2) {
  $stmt = $mysqli->prepare("CALL getCustomerDetailsByUsername(?)");
  $stmt->bind_param("s", $username);
} 
else if(strlen($surname)>2) {
  $stmt = $mysqli->prepare("CALL getCustomerDetailsBySurname(?)");
  $stmt->bind_param("s", $surname);
} 
else {
  $stmt = $mysqli->prepare("CALL getALLCustomerDetails()");  
}

/* Run the query */
if (! ( @$stmt->execute() )) {
  /* Redirect to error page here */
  header('Location: ../errorPage.php');
  exit;
}
else { 	
  $query = @$stmt->get_result();
  $result = [];
  $counter = 0;

  while($row = $query->fetch_assoc()) {
    $result[$counter] = $row;
    $counter++;
  }
}

  $mysqli->close(); 

  $netJSON = json_encode($result, JSON_FORCE_OBJECT);
  echo $netJSON."\n";
?>
