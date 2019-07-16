<!--
 * Filename:     adminNavBarLeft.inc.php
 * Author:       Andrew Laing
 * Email:        parisianconnections@gmail.com
 * Last updated: 16/06/2019.
 * Description:  This is the drop down navbar for the Admin pages.
 *               Included here so that all files can be updated at
 *               the same time if changes are necessary. 
-->


<?php
  $accessLevel = -1;
  if( isset($_SESSION['accessLevel'])  ) {
    $accessLevel = $_SESSION['accessLevel'];
  }


  echo '      <ul class="nav navbar-nav">';
  echo '        <!-- Link to index page -->';
  echo '        <li class="nav-item active">';
  echo '          <a class="nav-link active" href="/index.php">Home</a>';
  echo '        </li>';
  echo '        <!-- Dropdown menu for Orders pages -->';
  echo '        <li class="nav-item dropdown">';
  echo '          <a class="nav-link dropdown-toggle" data-toggle="dropdown"';
  echo '                    data-hover="dropdown" data-delay="0" data-close-others="false"'; 
  echo '                    href="#">Orders</a>';
  echo '          <div class="dropdown-menu">';

  /* Show nav items based upon the staff members access level */
  if($accessLevel > 0) {
    echo '            <a class="dropdown-item" tabindex="-1" href="/src/viewOrders.php">View Orders</a><br />';
    if($accessLevel > 1) {
      echo '            <a class="dropdown-item" tabindex="-1" href="/src/editOrder.php">Edit Order</a><br />';
      echo '            <a class="dropdown-item" tabindex="-1" href="/src/orderDelivered.php">Order Delivered</a><br />';
    }
    if($accessLevel > 2) {
      echo '            <a class="dropdown-item" tabindex="-1" href="/src/deleteOrder.php">Delete Order</a><br />';    
    }
  }


  echo '          </div>';
  echo '        </li>';
  echo '        <!-- Dropdown menu for Food Menu pages -->';
  echo '        <li class="nav-item dropdown">';
  echo '          <a class="nav-link dropdown-toggle" data-toggle="dropdown"'; 
  echo '                    data-hover="dropdown" data-delay="0" data-close-others="false"'; 
  echo '                    href="#">Food Menu</a>';
  echo '          <div class="dropdown-menu">';
  echo '            <a class="dropdown-item" tabindex="-1" href="/src/viewMenu.php">View Menu</a><br />';

  /* Show nav items based upon the staff members access level */
  if($accessLevel > 2) {
    echo '            <a class="dropdown-item" tabindex="-1" href="/src/viewMenuItems.php">View Menu Items</a><br />';
    echo '            <a class="dropdown-item" tabindex="-1" href="/src/editMenuItem.php">Edit Menu Item</a><br />';
    echo '            <a class="dropdown-item" tabindex="-1" href="/src/addMenuItem.php">Add New Menu Item</a><br />';
    echo '            <a class="dropdown-item" tabindex="-1" href="/src/deleteMenuItem.php">Delete Menu Item</a>';
  }


  echo '          </div>';
  echo '        </li>';
  echo '        <!-- Dropdown menu for Customer Details pages -->';
  echo '        <li class="nav-item dropdown">';
  echo '          <a class="nav-link dropdown-toggle" data-toggle="dropdown"'; 
  echo '                    data-hover="dropdown" data-delay="0" data-close-others="false"'; 
  echo '                    href="#">Customer Details</a>';
  echo '          <div class="dropdown-menu">';


  /* Show nav items based upon the staff members access level */
  if($accessLevel > 1) {
    echo '            <a class="dropdown-item" tabindex="-1" href="/src/viewCustomerRecords.php">View Customer Records</a><br />';
    echo '            <a class="dropdown-item" tabindex="-1" href="/src/editCustomerRecord.php">Edit Customer Record</a><br />';
    echo '            <a class="dropdown-item" tabindex="-1" href="/src/addCustomerRecord.php">Add New Customer Record</a><br />';

    if($accessLevel > 2) {
      echo '            <a class="dropdown-item" tabindex="-1" href="/src/deleteCustomerRecord.php">Delete Customer Record</a><br />';
    } 
  }

  echo '          </div>';
  echo '        </li>';
  echo '        <!-- Dropdown menu for Staff Details pages -->';
  echo '        <li class="nav-item dropdown">';
  echo '          <a class="nav-link dropdown-toggle" data-toggle="dropdown"'; 
  echo '                    data-hover="dropdown" data-delay="0" data-close-others="false"'; 
  echo '                    href="#">Staff Details</a>';
  echo '          <div class="dropdown-menu">';

  /* Show nav items based upon the staff members access level */
  if($accessLevel > 1) {  
    echo '            <a class="dropdown-item" tabindex="-1" href="/src/viewStaffRecords.php">View Staff Records</a><br />';
    echo '            <a class="dropdown-item" tabindex="-1" href="/src/editStaffRecord.php">Edit Staff Record</a><br />';
    echo '            <a class="dropdown-item" tabindex="-1" href="/src/addStaffRecord.php">Add New Staff Record</a><br />';

    if($accessLevel > 2) {  
        echo '            <a class="dropdown-item" tabindex="-1" href="/src/deleteStaffRecord.php">Delete Staff Record</a><br />';
        echo '            <a class="dropdown-item" tabindex="-1" href="/src/editStaffMemberAccessLevel.php">Change Staff Access Level</a><br />';
    }
  }

  echo '          </div>';
  echo '        </li>';
  echo '      </ul>';
?>   