<?php
/*
 * Filename:     logout.php
 * Author:       Andrew Laing
 * Email:        parisianconnections@gmail.com
 * Last updated: 31/05/2019.
 * Description:  The Logout page is a PHP script used to log visitors out 
 *               of their accounts. Once it has logged out customers, it will 
 *               redirect them to the Home page.
 * Note:         This page must be used because JavaScript cannot directly 
 *               destroy a server's session cookies.
 */
 
/* If there is not an active session start one */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/* Unset Session cookie values */
session_unset(); 

/* Return to the home page */
$headerText = 'Refresh:0; url="../index.php"';
header($headerText);

exit;
?>