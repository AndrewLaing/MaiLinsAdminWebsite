-- ---------------------------------------------------------------------------------------
-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
-- @@ NEW TABLES AND PROCEDURES FOR THE ADMIN PAGES @@
-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
--
-- Filename:     adminProceduresTestData.sql
-- Author:       Andrew Laing
-- Email:        parisianconnections@gmail.com
-- Last updated: 17/06/2019.


-- Note: that the following error for record not found can be fixed by changing
--       the phpmyadmin configurations in XAMPP (google the error message)

-- Error
-- Static analysis:
-- 1 errors were found during analysis.

-- Missing expression. (near "ON" at position 25)

-- SQL query:  Edit 
-- SET FOREIGN_KEY_CHECKS = ON; 
-- MySQL said:  
-- #2014 - Commands out of sync; you can't run this command now
--
-- ---------------------------------------------------------------------------------------

-- ---------------------------------------------------------------------------------------
-- INSERT STAFF RECORDS
-- ---------------------------------------------------------------------------------------

CALL insertStaffDetails ( 1, 'Senior Programmer', 
                          'scotty','password123','Scott', 'Randolph','13 Pleasant Street', 
                          'Liverpool', 'L19 0NE', '0151345987','randyscott@gmail.com');
CALL insertStaffDetails ( 0, 'Counter staff',
                          'dorothy','dottyisme','Garland', 'Judy', '22 Harlington Cresent', 
                          'Liverpool', 'L24 2ED', '01514448383', 'jgarland@gmail.com');
CALL insertStaffDetails ( 2, 'Delivery Manager',
                          'sallywins','letmein','Biggins', 'Sally', '22 Plikington Place', 
                          'Liverpool', 'L22 4ES', '08982241161','sbiggins@gmail.com');
CALL insertStaffDetails ( 1, 'Database Admin',
                          'rockford','iwantapassword','Garner', 'James', '94 Bold Street',
                          'Liverpool', 'L14 3DD', '01517775656', 'jgarner123@gmail.com');
CALL insertStaffDetails ( 2, 'Delivery Staff',
                          'scottydog','crisscross','Scott', 'Christopher', '6 Alexandra Mews', 
                          'Liverpool', 'L9 0ND', '015109987784', 'chrissyscott@gmail.com');


-- ---------------------------------------------------------------------------------------
-- CHECK STAFF USERNAME/PASSWORD COMBO IS VALID
-- ---------------------------------------------------------------------------------------

CALL checkStaffPasswordIsValid('scotty', 'password123');
CALL checkStaffPasswordIsValid('scotty', 'I am a Hacker'); 
CALL checkStaffPasswordIsValid('scottydog', 'crisscross');
CALL checkStaffPasswordIsValid('scottydog', '');
CALL checkStaffPasswordIsValid('', ''); 


-- ---------------------------------------------------------------------------------------
-- OTHER STAFF DETAILS PROCEDURES
-- ---------------------------------------------------------------------------------------

--    updateStaffDetails
CALL getStaffDetailsByUsername('scotty');
CALL updateStaffDetails ( 1, 1, 'Senior Programmer', 'Scott', 'Randolph','13 Mount Pleasant Street', 
                          'Liverpool', 'L19 0NE', '0151345987','randyscott@gmail.com');
CALL getStaffDetailsByUsername('scotty');

--    getStaffDetails
CALL getStaffDetails(1);

--    updateStaffPassword
SELECT * FROM `staffdetailstbl` WHERE username='scotty';
updateStaffPassword(1, 'reset');
SELECT * FROM `staffdetailstbl` WHERE username='scotty';
updateStaffPassword(1, 'password123');

--    deleteStaffDetails
CALL insertStaffDetails ( 2, 'Delivery Staff',
                          'lolilol','jejejejej','Nolan', 'Christopher', '8 partridge close', 
                          'Liverpool', 'L15 9GD', '015155362784', 'chrisnolan@gmail.com');
SELECT * FROM `staffdetailstbl` WHERE username='lolilol';               
CALL deleteStaffDetails(6);  
SELECT * FROM `staffdetailstbl`;
                 
--    checkStaffPasswordIDCombo
CALL checkStaffPasswordIDCombo(1, 'password123');

--    staffUsernameExists
SELECT staffUsernameExists('scotty') as 'COUNT';


-- ---------------------------------------------------------------------------------------
-- GET STAFF DETAILS
-- ---------------------------------------------------------------------------------------

CALL getAllStaffDetails();
CALL getStaffDetailsByIDNumber(1); 
CALL getStaffDetailsByUsername('scotty');
CALL getStaffDetailsBySurname('Garland');
CALL getStaffDetailsByJobPosition('Delivery Staff');


-- ---------------------------------------------------------------------------------------
-- GET CUSTOMER DETAILS
-- ---------------------------------------------------------------------------------------

CALL getAllCustomerDetails();
CALL getCustomerDetailsByIDNumber(2);
CALL getCustomerDetailsByUsername('loliwin');
CALL getCustomerDetailsBySurname('Biggins');
CALL getCustomerDetailsByEmailAddress('gggirlie@gmail.com');


-- ---------------------------------------------------------------------------------------
-- GET PRODUCT DETAILS
-- ---------------------------------------------------------------------------------------

CALL getAllProductDetails();
CALL getProductDetailsByIDNumber(26);
CALL getProductDetailsByItemName('Wonton Soup');
CALL getProductDetailsByCategory('Noodles');


-- ---------------------------------------------------------------------------------------
-- GET FEEDBACK RECORDS
-- ---------------------------------------------------------------------------------------

CALL getAllCustomerFeedbackRecords();
CALL getCustomerFeedbackRecordsBySurname('qwe');
CALL getCustomerFeedbackRecordsByEmailAddress('Loli@ago.com');
CALL getCustomerFeedbackRecordsByDateOfMessage('2019-06-03');

