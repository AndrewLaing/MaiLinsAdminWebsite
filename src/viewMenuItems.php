<!--
 * Filename:     viewMenuItems.php
 * Author:       Andrew Laing
 * Email:        parisianconnections@gmail.com
 * Last updated: 02/07/2019.
 * Description:  The page allows the user to search for and view
 *               food menu items.
-->

<?php
   include 'includes/loginScripts.inc.php'
?>

<?php
   include 'includes/level_2_user.inc.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Mai-Lin's Vegan Takeaway Restaurant</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Stylesheets and JS for Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script> 
    <script src="../js/bootstrap-hover-dropdown.js"></script>  
    
    <!-- My JavaScript-->
    <script type="text/javascript" src="../js/script.js"></script>

    <!-- My stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/feedback-form.css" rel="stylesheet">
    

    <script type = "text/javascript" language = "javascript">
    /*  Declare variables used for records here. */
    var dataArray = new array();  
    var currentRecord=1;  
    var numberOfRecords=0;

    // See: CMS--> https://stackoverflow.com/questions/1912501/unescape-html-entities-in-javascript
    // This introduces an XSS vulnerability BUT the only people with access to
    // the add/edit record functionality have access Level 2 or above clearance.
    function htmlDecode(input){
        var e = document.createElement('textarea');
        e.innerHTML = input;
        // handle case of empty input
        return e.childNodes.length === 0 ? "" : e.childNodes[0].nodeValue;
    }

    function updateDetailsFields($dataArray, $currentRecord) {  
        /* Update the fields */ 
        $("input[name=d_itemId].inputField").val($dataArray[$currentRecord]["itemID"]); 
        $("input[name=d_itemname].inputField").val(htmlDecode($dataArray[$currentRecord]["itemName"]));
        $("input[name=d_category].inputField").val($dataArray[$currentRecord]["category"]);
        $("input[name=d_quantity].inputField").val($dataArray[$currentRecord]["quantity"]);
        $("textarea[name=d_description].inputField").val(htmlDecode($dataArray[$currentRecord]["description"]));
        $("input[name=d_price].inputField").val($dataArray[$currentRecord]["price"]);
        $("input[name=d_filename].inputField").val($dataArray[$currentRecord]["imageFileName"]);
    }

    function clearDetailsFields() {         
            /* Update the fields */ 
            $("input[name=d_itemId].inputField").val(""); 
            $("input[name=d_itemname].inputField").val("");
            $("input[name=d_category].inputField").val("");
            $("input[name=d_quantity].inputField").val("");
            $("input[name=d_description].inputField").val("");
            $("input[name=d_price].inputField").val("");
            $("input[name=d_filename].inputField").val("");
    }
    </script>

    <!-- JQuery functions -->
    <script type="text/javascript" src="../js/JQFoodItemSearchFunctions.js"></script>
    
    <script type="text/javascript">
    $(document).ready(function(){
        $('#imageFile').change(function(e){
            var filename = e.target.files[0].name;
            
            alert('Remember that this file must be uploaded to the imgs folder. (If it is not there already.)');
            $("input[name=d_filename].fileChooser").val(filename);
        })
    });
    </script>



</head> <!-- END OF HEAD SECTION -->

<body>

<!-- Header -->
<header class="header">
    <!-- Page title -->
    <div id="title" class="jumbotron">
    <h1>Mai-Lin&apos;s Vegan Takeaway Restaurant</h1>      
    <h1>View Food Item Records</h1>
    </div>
    
    <!-- Navigation bar -->
    <nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Create the Left NavBar -->
        <?php
            include 'includes/adminNavBarLeft.inc.php';
        ?>
        <!-- Create the Right NavBar -->
        <ul class="nav navbar-nav navbar-right">
        <!-- Generated with PHP to take login status into account -->
        <?php
            include 'includes/adminNavBarRight.inc.php'
        ?>   
        </ul>
    </div>
    </nav>    
</header> <!-- END OF HEADER SECTION -->

<!-- Main content. -->
<div class="container-fluid"> 
    <div class="container">
    <div class="form-inline"> <!-- START OF SEARCH SECTION -->
        <hr> <!-- Note this has a different meaning in HTML5 so it is styled with CSS -->            
        <h3 class="inputHeaders">SEARCH</h3>
        <hr>

        <div class="form-group col-sm-6">
        <label for="s_idnum" class="control-label inputLabel"  >ID Number </label>
        <input type="text" id="s_idnum" name="s_idnum" placeholder="Item ID number ..." maxlength="34" 
                class="form-control inputField" autofocus>
        <br />

        <label for="s_itemname" class="control-label inputLabel" >Name of Item</label>
        <input type="text" id="s_itemname" name="s_itemname" placeholder="Item name ..." maxlength="34" 
                class="form-control inputField" > 
        <br />

        <label for="s_category" class="control-label inputLabel" >Category</label>
        <input type="text" id="s_category" name="s_category" placeholder="Category ..." maxlength="34" 
                class="form-control inputField"> 
        <br />
        </div>

        <div class="form-group col-sm-6">
        <button class="btn btn-info searchBtn" name="searchBtn" id="searchBtn" 
                value="searchBtn">FIND RECORDS</button>
        </div>

        <!-- This row is used to add a space after the previous row -->
        <!--      because the form is displayed inline. -->
        <div class="row">
        <div class="form-group col-sm-12">
            <br />
        </div>
        </div>
    </div> <!-- END OF SEARCH SECTION -->

<!-- Edit details Form  -->
<form role="form" class="form-inline" method="post" action="staffRecordUpdated.php">    
    <div > <!-- START OF DETAILS SECTION -->
        <hr> <!-- Note this has a different meaning in HTML5 so it is styled with CSS -->
        <h3 class="inputHeaders">DETAILS</h3>
        <hr>

        <!-- Row containing details -->
        <div class="row">
        <!-- Left-hand column -->
        <div class="form-group col-sm-6">

        <label for="d_itemId" class="control-label inputLabel" >ID Number</label>
        <input type="text" id="d_itemId" name="d_itemId" placeholder="Item ID Number ..." maxlength="34" 
                class="form-control inputField" readonly> 
        <br />

        <label for="d_itemname" class="control-label inputLabel" >Name of Item</label>
        <input type="text" id="d_itemname" name="d_itemname" placeholder="Item Name ..." maxlength="34" 
                class="form-control inputField" readonly> 
        <br />

        <label for="d_category" class="control-label inputLabel"  >Category </label>
        <input type="text" id="d_category" name="d_category" placeholder="Category ..." maxlength="34" 
                class="form-control inputField" readonly> 
        <br />

        <label for="d_quantity" class="control-label inputLabel" >Quantity</label>
        <input type="text" id="d_quantity" name="d_quantity" placeholder="Quantity in serving ..." maxlength="34" 
                class="form-control inputField" readonly> 
        <br />
        </div>

        <!-- Right-hand column -->
        <div class="form-group col-sm-6">
            <label for="d_description" class="control-label inputLabel"  >Description </label>
            <textarea id="d_description" name="d_description" placeholder="Description ..." maxlength="299" 
                      style="height:100px" 
                      class="form-control inputField descriptionTextfield" readonly></textarea>
            <br />

            <label for="d_price" class="control-label inputLabel" >Price</label>
            <input type="text" id="d_price" name="d_price" placeholder="Price ..." maxlength="34" 
                    class="form-control inputField"  readonly> 
            <br />

            <label for="d_filename" class="control-label inputLabel" >Img Filename</label>
            <input type="text" id="d_filename" name="d_filename" placeholder="Image filename ..."
                   class="form-control inputField fileChooser" readonly> 
            <br />


            <div class="navigateBtnDiv">
                <button type="button" class="btn btn-info recordNavigateBtn" name="btnPrev" id="btnPrev"
                        value="btnPrev">Previous</button>
                <button type="button" class="btn btn-info recordNavigateBtn" name="btnNext" id="btnNext"
                        value="btnNext">Next</button>
                <br />
            </div>
        </div>
        </div>  <!-- End of row -->


        </div>  <!-- End of row -->  
    </div> <!-- END OF DETAILS SECTION -->
    </form> <!-- END OF EDIT DETAILS FORM  -->
    <br />
    </div>    <!-- END OF CONTAINER -->
</div>      <!-- END OF CONTAINER-FLUID -->


<!-- Footer -->
<footer class="footer footerDivs">
<!-- Create the footer contents -->
    <?php
    include 'includes/footerContents.inc.php';
    ?>
</footer> <!-- END OF FOOTER SECTION -->

<!-- LOGIN modal removed because page can only be viewed if user is logged in. -->

</body>
</html>
