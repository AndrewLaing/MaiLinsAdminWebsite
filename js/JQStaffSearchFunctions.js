/*
 * Filename:     JQStaffSearchFunctions.js
 * Author:       Andrew Laing
 * Email:        parisianconnections@gmail.com
 * Last updated: 26/06/2019.
 * Description:  This file contains JQuery functions used to call the
 *               login modal, search for records, and navigate through
 *               loaded search results for staff details.
 * Contents:     
 */

$(document).ready(function(){
    /** Callback for Login Modal */ 
    $("#loginBtn").click(function(){
        $("#loginModal").modal();
    });

    /** Callback for Load Records button press */ 
    $("#searchBtn").click(function(event){
        var p_staffId = $("input[name=s_idnum].inputField").val();
        var p_username = $("input[name=s_uname].inputField").val();
        var p_surname = $("input[name=s_surname].inputField").val();
        var p_position = $("input[name=s_jobpos].inputField").val();

        $.post( "ajaxhandlers/searchStaffRecordsHandler.php",
        {
        staffID: p_staffId,
        username: p_username,
        surname: p_surname,
        position: p_position
        },
        function(data, status){
        //alert("Data: " + data + "\nStatus: " + status);
        dataArray = JSON.parse(data);

        /* Note dataArray is an object */
        numberOfRecords = Object.keys(dataArray).length;
        currentRecord=0;

        // Check first that records have been found
        if(numberOfRecords==null || numberOfRecords==0) {
            /* Clear the fields */ 
            clearDetailsFields();
            alert("No records found!");
            return;
        }
        else if(numberOfRecords==1) {
            alert("1 record found.");   
        }
        else{
            alert(numberOfRecords + " records found.");           
        }

        /* Update the fields */ 
        updateDetailsFields(dataArray, currentRecord);
        });
    });


    /** Callback for Previous button press */ 
    $("#btnPrev").click(function(event) {
        /* JS arrays are zero-based */
        if(currentRecord > 0) {
        currentRecord=currentRecord-1;                  
        }

        /* Update the fields */ 
        updateDetailsFields(dataArray, currentRecord);
    });


    /** Callback for Next button press */ 
    $("#btnNext").click(function(event) {
        /* JS arrays are zero-based */
        if(currentRecord < numberOfRecords-1) {
        currentRecord=currentRecord+1;               
        }

        /* Update the fields */ 
        updateDetailsFields(dataArray, currentRecord);
    });
});
