
<?php 
/*
 * Filename:     searchMenuItemRecordsHandler.php
 * Author:       Andrew Laing
 * Email:        parisianconnections@gmail.com
 * Last updated: 01/07/2019.
 * Description:  The page handles the requests for menu item records from the 
 *               view/update/delete/insert Menu Item records pages. 
 * Notes:        This page can only be accessed by staff members with access
 *               level 2 or above.
 *               Requires four parameters;
 *                  staffID, username, surname, position
 */
   include '../includes/level_2_user.inc.php'
?>

<?php
/* Turn off error reporting to stop info leaks */
//error_reporting(0);

$itemID = $_REQUEST['itemID']; 
$itemname = "%" . $_REQUEST['itemname'] . "%"; 
$category = "%" . $_REQUEST['category'] . "%"; 


/* Connect to the DB, get the product details and add them to an array */
$mysqli = new mysqli("localhost","webuser","webuser","fooddb");

if ($mysqli->connect_errno) {
  /* Redirect to error page here */
  header('Location: ../errorPage.php');
  exit;
}

if(strlen($itemID)>0) {
  $stmt = $mysqli->prepare("CALL getProductDetailsByIDNumber(?)");
  $stmt->bind_param("s", $itemID);
} 
else if(strlen($itemname)>2) {
  $stmt = $mysqli->prepare("CALL getProductDetailsByItemName(?)");
  $stmt->bind_param("s", $itemname); 
} 
else if(strlen($category)>2) {
  $stmt = $mysqli->prepare("CALL getProductDetailsByCategory(?)");
  $stmt->bind_param("s", $category); 
} 
else {
  $stmt = $mysqli->prepare("CALL getALLProductDetails()");  
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
