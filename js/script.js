/*
 * Filename:     script.js
 * Author:       Andrew Laing
 * Email:        parisianconnections@gmail.com
 * Last updated: 30/06/2019.
 * Description:  The main javascript functions used by the Mai-Lin's 
 *               Vegan Takeaway restaurant website.
 * Contents:     confirm_delete_account()
 *               confirm_logout()
 *               onClickAdd(element)
 *               onClickRemove(element)
 *               onClickSubtract(element)
 *               updateOrderTotal()
 *               updateSubtotal()
 *               validate_change_pwd()
 *               validate_details_change()
 *               validate_login()
 *               validate_registration()
 */

 /* @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
 *                        VARIABLES
 * @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ */
 
// used to store number of each item added to the basket.
var order = [];  

// Used to store item names and price per unit.
var items = [];
var prices = [];


/* @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
 *                        FUNCTIONS
 * @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ */

/* The function confirm_logout asks the user to confirm before logging out */
function confirm_delete_account()
{
    /* Confirm from the user that they want to delete their account out */
    var r = confirm("Are you sure you want to delete your account?");
    if (r == true)
    {
        alert("Your account has been deleted.");
    }
    
	return r;
}
	
/* The function confirm_logout asks the user to confirm before logging out */
function confirm_logout()
{
    /* Confirm from the user that they want to log out */
    var r = confirm("Are you sure you want to log out of your account?");
    if (r == true)
    {
        alert("You are now logged out.");
        window.location = "/src/logout.php";
    }
    /* Else just return to the current page without logging off */
    else
    {
        return false;
    } 
}

	
/* The function confirm_logout asks the user to confirm before logging out */
function confirm_update_record()
{
    /* Confirm from the user that they want to log out */
    var r = confirm("Are you sure you want to change this record?");
    if (r == true)
    {
        return true;
    }
    /* Else just return to the current page without logging off */
    else
    {
        return false;
    } 
}

	
/* The function confirm_logout asks the user to confirm before logging out */
function confirm_delete_record()
{
    /* Confirm from the user that they want to log out */
    var r = confirm("Are you sure you want to delete this record?");
    if (r == true)
    {
        return true;
    }
    /* Else just return to the current page without logging off */
    else
    {
        return false;
    } 
}

	

/* The function onClickAdd adds 1 to the total number of the item clicked,
 * updates its quantity on the page, then updates the subtotal on the page
 * and total on the page. */
function onClickAdd(element) 
{
    // If the item has not yet been added create an entry.
    
    if(order[parseInt(element.value)] == null) {
        order[parseInt(element.value)] = 1;
    }
    else {
        order[parseInt(element.value)] += 1;        
    }

    // Create the number of items text
    var numberOfItemsField = element.value + "numberOfItems"
    var numberOfItemsHiddenField = element.value + "hidden"
    var numberOfItems = order[parseInt(element.value)];
    
    // Update the number of items element on the page
    document.getElementById(numberOfItemsField).innerHTML = numberOfItems;   
    document.getElementById(numberOfItemsHiddenField).value = numberOfItems;   
    
    // update the subtotal and total on the page
    updateSubtotal();
    updateOrderTotal();
};


/* The function onClickRemove removes the item from the order list
 * updates its quantity on the page, then updates the subtotal and total
 * on the page. */
function onClickRemove(element) 
{
    // If the item has not yet been added nothing to do here.
    if(order[parseInt(element.value)] == null) {
        return;
    }
    
    // Remove this item from the order list
    order[parseInt(element.value)] = null;
      
    // Create the number of items text
    var numberOfItemsField = element.value + "numberOfItems"
    var numberOfItemsHiddenField = element.value + "hidden"
    var numberOfItems = 0;
    
    // Update the number of items element on the page
    document.getElementById(numberOfItemsField).innerHTML = numberOfItems;   
    document.getElementById(numberOfItemsHiddenField).value = numberOfItems;   

    
    // update the subtotal and total on the page
    updateSubtotal();
    updateOrderTotal();
};


/* The function onClickSubtract subtracts 1 from the total number of the item clicked
 * updates its quantity on the page, then updates the subtotal and total on the page. */
function onClickSubtract(element) 
{
    // If the item has not yet been added nothing to do here.
    if(order[parseInt(element.value)] == null) {
        return;
    }
    
    // If the item is no longer selected remove it from the subtotal
    if(order[parseInt(element.value)] == 1) {
        order[parseInt(element.value)] = null;
      
        // Update the number of items element on the page
        var numberOfItemsField = element.value + "numberOfItems"
        document.getElementById(numberOfItemsField).innerHTML = "0";
    }
    // Otherwise update the item details
    else {
        order[parseInt(element.value)] -= 1;    
        
        // Create the number of items text
        var numberOfItemsField = element.value + "numberOfItems"
        var numberOfItemsHiddenField = element.value + "hidden"
        var numberOfItems = order[parseInt(element.value)];
        
        // Update the number of items element on the page
        document.getElementById(numberOfItemsField).innerHTML = numberOfItems;   
        document.getElementById(numberOfItemsHiddenField).value = numberOfItems;       
    }
    
    // update the subtotal and total on the page
    updateSubtotal();
    updateOrderTotal();
};


/* The function updateSubtotal creates the text for the subtotal 
 * and adds it to the webpage.
 */
function updateOrderTotal() 
{
    var orderTotal = 0.0;
    var subtotalText="";
    
    // Calculate and display the order total
    for(var key in order) {
        orderTotal += prices[parseInt(key)] * order[parseInt(key)]; 
    }
    
    document.getElementById("ordertotal").innerHTML = "&pound;" + orderTotal.toFixed(2);
}


/* The function updateSubtotal creates the text for the subtotal 
 * and adds it to the webpage.
 */
function updateSubtotal() 
{
    var itemTotal = 0.0;
    var subtotalText="";
    
    // Add each item ordered to the subtotal element
    for(var key in order) {
      var totalText=key + "total";
      
      // If the item has been ordered add it to the subtotal
      if(order[key]!=null) {
        itemTotal = prices[parseInt(key)] * order[parseInt(key)]; 
        subtotalText += items[key]
        subtotalText += " x" + order[parseInt(key)]; 
        subtotalText += " - &pound;";
        subtotalText += itemTotal.toFixed(2);
        subtotalText += "<br />";            
      }
    }
    
    document.getElementById("subtotal").innerHTML = subtotalText;
}

function validate_addCustomerRecord_fields() 
{
    if(validate_password_length() == false) {
        return false;
    } else if(validate_confirm_password() == false) {
        return false;
    }

	var userName = document.forms.frmAddRecord.d_username.value;  
	var fname = document.forms.frmAddRecord.d_fname.value; 
	var surname = document.forms.frmAddRecord.d_surname.value; 
    var userNameLen = userName.length;  
    var fnameLen = fname.length;  
    var surnameLen = surname.length;  

    if(userNameLen==0 || fnameLen==0 || surnameLen==0 ) {
        alert("Please complete ALL required fields!");
        return false;
    }
    if(userName === "USERNAME ALREADY EXISTS!") {
        alert("Please choose a valid username!!!");
        $("input[name=d_username].inputField").val("");
        return false;
    }
    return true;
}


function validate_addStaffRecord_fields() 
{
    if(validate_password_length() == false) {
        return false;
    } else if(validate_confirm_password() == false) {
        return false;
    }

	var userName = document.forms.frmAddRecord.d_username.value;  
	var fname = document.forms.frmAddRecord.d_fname.value; 
	var surname = document.forms.frmAddRecord.d_surname.value; 
	var jobpos = document.forms.frmAddRecord.d_jobpos.value; 
    var userNameLen = userName.length;  
    var fnameLen = fname.length;  
    var surnameLen = surname.length;  
    var jobposLen = jobpos.length;  

    if(userNameLen==0 || fnameLen==0 || surnameLen==0 || jobposLen==0) {
        alert("Please complete ALL required fields!");
        return false;
    }
    if(userName === "USERNAME ALREADY EXISTS!") {
        alert("Please choose a valid username!!!");
        $("input[name=d_username].inputField").val("");
        return false;
    }
    return true;
}


/* The function validate_pwd_length checks that the password chosen
 * is greater than the minimum length. */
function validate_password_length()
{
	var newPassword = document.forms.frmAddRecord.d_password.value;    
    var newPasswordLen = newPassword.length;  

    if( newPasswordLen < 7 )
    {
        alert("Invalid current password - minimum length is 7 characters ");
        $("input[name=d_password].inputField").val("");
        return false;
    }
    
    return true;
}


/* The function validate_confirm_password is used to check that
 * the user has confirmed the password entered correctly. */
function validate_confirm_password()
{
	var newPassword = document.forms.frmAddRecord.d_password.value;    
	var confirmPass = document.forms.frmAddRecord.d_confirmpass.value;  
    var newPasswordLen = newPassword.length;  

    if( newPassword == confirmPass )
    {
        return true;
    }

    alert("Passwords entered do not match!! ");
    $("input[name=d_confirmpass].inputField").val("");
    
    return true;
}


/* The function validate_change_pwd validates the input on the change password form
 * before it is posted */
function validate_change_pwd()
{
	var currentpwd = document.forms.frmChangePwd.currentpwd.value;
    var newpwd = document.forms.frmChangePwd.newpwd.value;
    var confirmpwd  = document.forms.frmChangePwd.confirmnew.value;
    
    var currentpwdLen = currentpwd.length;    
    var newpwdLen = newpwd.length;    
    var confirmpwdLen = confirmpwd.length;

    if( currentpwdLen==0 || newpwdLen==0 || confirmpwdLen==0 )
    {
        alert("Error all fields must be completed.");
        return false;
    }

    if( currentpwdLen < 7 )
    {
        alert("Invalid current password - minimum length is 7 characters ");
        return false;
    }

    if( newpwdLen < 7 )
    {
        alert("Invalid new password - minimum length is 7 characters ");
        return false;
    }

    if( newpwd != confirmpwd )
    {
        alert("New passwords entered do not match ");
        return false;
    }
    
    return true;
}


/* The function validate_details_change validates the input on the Change Account Details
 * form before it is posted */
function validate_details_change()
{
	var lnameLen = document.forms.frmChangeDetails.lname.value.length;
    var fnameLen = document.forms.frmChangeDetails.fname.value.length;
    var addr1Len = document.forms.frmChangeDetails.addr1.value.length;
	var pcodeLen = document.forms.frmChangeDetails.pcode.value.length;
    var phoneLen = document.forms.frmChangeDetails.phoneno.value.length;
    var emailLen = document.forms.frmChangeDetails.email.value.length;

    if( lnameLen == 0 )
    {
        alert("Error - Surname field cannot be left blank.");
        return false;
    }

    if( fnameLen == 0 )
    {
        alert("Error - First name field cannot be left blank.");
        return false;
    }

    if( addr1Len == 0 )
    {
        alert("Error - Address line 1 field cannot be left blank.");
        return false;
    }

    if( pcodeLen == 0 )
    {
        alert("Error - Postcode field cannot be left blank.");
        return false;
    }

    if( phoneLen == 0 && emailLen == 0 )
    {
        alert("Error - You must complete either the phone number or email field.");
        return false;
    }
    
    /* Confirm from the user that they want to change their account details */
    var r = confirm("Are you sure you want to change your account details.");
    if (r == true)
    {
		return true;
    }
    /* Else do nothing */
    else
    {
        return false;
    }     

}


/* The function validate_feedback validates the feedback form before POSTing */
function validate_feedback()
{
	var msgLen = document.forms.frmFeedback.msg.value.length;

    if(msgLen==0) {
        alert("Error - you have not entered a message!");
        return false;
    }
    
    return true;
}


/* The function confirm_logout asks the user to confirm before logging out */
function validate_login()
{
	var usr = document.forms.frmLogin.username.value;
	var pwd = document.forms.frmLogin.pwd.value;
    var usrLen = usr.length;    
    var pwdLen = pwd.length;    

    if(usrLen===0 || pwdLen===0) {
        alert("Error - both fields must be completed!");
        return false;
    }
    
    return true;
}


/* The function validate_registration validates the input on the registration form
 * before it is POSTed */
function validate_registration()
{
	var usrname = document.forms.frmRegister.usrname.value;
    var userLen = document.forms.frmRegister.usrname.value.length;
    var pass  = document.forms.frmRegister.pwd.value;
    var passLen = pass.length;
    var pass1 = document.forms.frmRegister.pwdconfirm.value; 
    
    var lnameLen = document.forms.frmRegister.lname.value.length;
    var fnameLen = document.forms.frmRegister.fname.value.length;
    var phoneLen = document.forms.frmRegister.phoneno.value.length;
    var emailLen = document.forms.frmRegister.email.value.length;

    if( userLen == 0 )
    {
        alert("Please choose a Username ");
        return false;
    }

    if( userLen < 7 )
    {
        alert("Invalid Username - minimum length is 7 characters ");
        return false;
    }

    if( usrname.includes('USERNAME ALREADY EXISTS!') )
    {
        alert("Error: You must choose a unique username.");
        return false;
    }

    if( pass == "")
    {
        alert("Please choose a Password ");
        return false;
    }

    if( passLen < 7 )
    {
        alert("Invalid Password - minimum length is 7 characters ");
        return false;
    }

    if( pass1 == "" || pass != pass1 )
    {
        alert("Passwords entered do not match ");
        return false;
    }

    if( lnameLen == 0 )
    {
        alert("Please enter your surname.");
        return false;
    }
    
    if( fnameLen == 0 )
    {
        alert("Please enter your first name.");
        return false;
    }
    
    if(document.forms.frmRegister.addr1.value == "")
    {
        alert("Please enter the first line of your address.");
        return false;
    }

    if(phoneLen + emailLen == 0) {
        alert("Please enter either your phone number or email address for us to be able to contact you.");
        return false;
    }
}
