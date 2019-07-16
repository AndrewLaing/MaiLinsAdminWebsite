<?php
    // * Filename:     level_2_user.inc.php
    // * Author:       Andrew Laing
    // * Email:        parisianconnections@gmail.com
    // * Last updated: 28/06/2019.
    // * Description:  This is used to restrict page access to 
    // *               staffmembers with level access 2 or greater.

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
        $headerText = 'Refresh:5; url="/index.php"';
        header($headerText);

        exit;
    }
    else if( !(isset($_SESSION['accessLevel'])) || $_SESSION['accessLevel'] < 2 ) {
        echo '<h1>ERROR</h1>';
        echo '<p>You do not have the right to view this page, and your IP address (';
        echo $_SERVER['REMOTE_ADDR'];
        echo ') has been logged!<br />';
        echo 'Please contact your administrator as quickly as possible to explain why you attempted to open this page!';
        echo '<p>You will be logged out of your account and redirected back to the home page in 20 seconds</p>';
        echo'<img src="/imgs/breachDetected.jpg" alt="Girl in a jacket" style="width:100%;"> ';

        /* Unset Session cookie values */
        session_unset(); 
        
        /* Redirect back to the home page */
        $headerText = 'Refresh:20; url="/index.php"';
        header($headerText);

        exit;
    }
?>