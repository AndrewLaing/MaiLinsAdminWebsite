
<?php 
/*
 * Filename:     searchStaffRecordsHandler.php
 * Author:       Andrew Laing
 * Email:        parisianconnections@gmail.com
 * Last updated: 26/06/2019.
 * Description:  The page handles the requests for staff records from the 
 *               view/update/delete/insert Staff records pages. 
 * Notes:        This page can only be accessed by staff members with access
 *               level 2 or above.
 *               Requires four parameters;
 *                  staffID, username, surname, position
 */
   include '../includes/level_2_user.inc.php'
?>

<?php
/* Turn off error reporting to stop info leaks */
error_reporting(0);

$staffID = $_REQUEST['staffID']; 
$username = "%" . $_REQUEST['username'] . "%"; 
$surname = "%" . $_REQUEST['surname'] . "%"; 
$position = "%" . $_REQUEST['position'] . "%"; 

/* Connect to the DB, get the product details and add them to an array */
$mysqli = new mysqli("localhost","webuser","webuser","fooddb");

if ($mysqli->connect_errno) {
  /* Redirect to error page here */
  header('Location: ../errorPage.php');
  exit;
}

if(strlen($staffID)>0) {
  $stmt = $mysqli->prepare("CALL getStaffDetailsByIDNumber(?)");
  $stmt->bind_param("s", $staffID);
} 
else if(strlen($username)>2) {
  $stmt = $mysqli->prepare("CALL getStaffDetailsByUsername(?)");
  $stmt->bind_param("s", $username);
} 
else if(strlen($surname)>2) {
  $stmt = $mysqli->prepare("CALL getStaffDetailsBySurname(?)");
  $stmt->bind_param("s", $surname);
} 
else if(strlen($position)>2) {
  $stmt = $mysqli->prepare("CALL getStaffDetailsByJobPosition(?)");
  $stmt->bind_param("s", $position);
} 
else {
  $stmt = $mysqli->prepare("CALL getALLStaffDetails()");  
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
