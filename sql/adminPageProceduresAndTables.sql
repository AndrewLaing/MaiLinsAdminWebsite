--
-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
-- @@ NEW TABLES AND PROCEDURES FOR THE ADMIN PAGES @@
-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
--
-- Filename:     adminPageProceduresAndTables.sql
-- Author:       Andrew Laing
-- Email:        parisianconnections@gmail.com
-- Last updated: 17/06/2019.
--
-- TABLES:
--   staffDetailsTBL
-- 
-- PROCEDURES:
--    insertStaffDetails
--    updateStaffDetails
--    getStaffDetails
--    updateStaffPassword
--    deleteStaffDetails
--    checkStaffPasswordIsValid
--    checkStaffPasswordIDCombo
--    staffUsernameExists
--    getAllStaffDetails
--    getStaffDetailsByIDNumber
--    getStaffDetailsByUsername
--    getStaffDetailsBySurname
--    getStaffDetailsByJobPosition
--    getAllCustomerDetails
--    getCustomerDetailsByIDNumber
--    getCustomerDetailsByUsername
--    getCustomerDetailsBySurname
--    getCustomerDetailsByEmailAddress
--    getAllProductDetails
--    getProductDetailsByIDNumber
--    getProductDetailsByItemName
--    getProductDetailsByCategory
--    getAllCustomerFeedbackRecords
--    getCustomerFeedbackRecordsBySurname
--    getCustomerFeedbackRecordsByEmailAddress
--    getCustomerFeedbackRecordsByDateOfMessage
--
-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@


use foodDB;

-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
--                     Create the tables
-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

-- Create the staffDetailsTBL TABLE
DROP TABLE IF EXISTS staffDetailsTBL;

CREATE TABLE staffDetailsTBL (
    staffID INT AUTO_INCREMENT PRIMARY KEY,
    accessLevel TINYINT NOT NULL,
    jobPosition VARCHAR(35) NOT NULL,
    username VARCHAR(35) UNIQUE,
    password VARCHAR(255) NOT NULL,
    surname VARCHAR(35) NOT NULL,
    firstname VARCHAR(35) NOT NULL,
    addressLine1 VARCHAR(35),
    addressLine2 VARCHAR(35),
    postcode VARCHAR(8),
    phoneNumber VARCHAR(35),
    emailAddress VARCHAR(50)
);


-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
--              Procedures for the staffDetailsTBL
-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

-- Create the insertStaffDetails procedure
DROP PROCEDURE IF EXISTS insertStaffDetails;
DELIMITER $$
CREATE PROCEDURE insertStaffDetails ( IN in_accessLevel TINYINT,
                                      IN in_jobPosition VARCHAR(35),
                                      IN in_username VARCHAR(35),
                                      IN in_password VARCHAR(255), 
                                      IN in_surname VARCHAR(35),
                                      IN in_firstname VARCHAR(35),
                                      IN in_addressLine1 VARCHAR(35),
                                      IN in_addressLine2 VARCHAR(35),
                                      IN in_postcode VARCHAR(8),
                                      IN in_phoneNumber VARCHAR(35),
                                      IN in_emailAddress VARCHAR(50) )
BEGIN
INSERT INTO staffDetailsTBL ( accessLevel,
                              jobPosition,
                              username,
                              password,
                              surname,
                              firstname,
                              addressLine1,
                              addressLine2,
                              postcode,
                              phoneNumber,
                              emailAddress )
VALUES            			( in_accessLevel,
                              in_jobPosition,
                              in_username,
                              sha1(in_password),
                              in_surname,
                              in_firstname,
                              in_addressLine1,
                              in_addressLine2,
                              in_postcode,
                              in_phoneNumber,
                              in_emailAddress ); 	
END $$
DELIMITER ;


-- Create the updateStaffDetails procedure
DROP PROCEDURE IF EXISTS updateStaffDetails;
DELIMITER $$
CREATE PROCEDURE updateStaffDetails ( IN in_staffID INT,
                                      IN in_accessLevel TINYINT,
                                      IN in_jobPosition VARCHAR(35),
                                      IN in_surname VARCHAR(35),
                                      IN in_firstname VARCHAR(35),
                                      IN in_addressLine1 VARCHAR(35),
                                      IN in_addressLine2 VARCHAR(35),
                                      IN in_postcode VARCHAR(8),
                                      IN in_phoneNumber VARCHAR(35),
                                      IN in_emailAddress VARCHAR(50) )
BEGIN
UPDATE staffDetailsTBL
SET accessLevel=in_accessLevel,
    jobPosition=in_jobPosition,
    surname=in_surname,
    firstname=in_firstname,
    addressLine1=in_addressLine1,
    addressLine2=in_addressLine2,
    postcode=in_postcode,
    phoneNumber=in_phoneNumber,
    emailAddress=in_emailAddress
WHERE staffID=in_staffID;
END $$
DELIMITER ;


-- Create the getStaffDetails procedure
-- Returns all user details except password and staffID
DROP PROCEDURE IF EXISTS getStaffDetails;
DELIMITER $$
CREATE PROCEDURE getStaffDetails ( IN in_staffID INT )
BEGIN
SELECT accessLevel, jobPosition, username, surname, firstname, 
       addressLine1, addressLine2, postcode, phoneNumber, emailAddress
FROM staffDetailsTBL
WHERE staffID=in_staffID;
END $$
DELIMITER ;


-- Create the updateStaffPassword procedure
DROP PROCEDURE IF EXISTS updateStaffPassword;
DELIMITER $$
CREATE PROCEDURE updateStaffPassword ( IN in_staffID INT,
                                       IN in_password VARCHAR(255) )
BEGIN
UPDATE staffDetailsTBL
SET password=sha1(in_password)
WHERE staffID=in_staffID;
END $$
DELIMITER ;


-- Create the deleteStaffDetails procedure
DROP PROCEDURE IF EXISTS deleteStaffDetails;
DELIMITER $$
CREATE PROCEDURE deleteStaffDetails (IN in_staffID INT)
BEGIN
DELETE FROM staffDetailsTBL 
WHERE staffID=in_staffID;
END $$
DELIMITER ;


-- Create the checkStaffPasswordIsValid procedure
DROP PROCEDURE IF EXISTS checkStaffPasswordIsValid;
DELIMITER $$
CREATE PROCEDURE checkStaffPasswordIsValid ( IN in_username VARCHAR(35),
                                             IN in_password VARCHAR(255) )
BEGIN
SET @password_hash = sha1(in_password);
SELECT staffID, accessLevel FROM staffDetailsTBL 
WHERE username=in_username
AND password=@password_hash;                   
END $$
DELIMITER ;


-- Create the checkStaffPasswordIDCombo procedure
DROP PROCEDURE IF EXISTS checkStaffPasswordIDCombo;
DELIMITER $$
CREATE PROCEDURE checkStaffPasswordIDCombo ( IN in_staffID INT,
                                             IN in_password VARCHAR(255) )
BEGIN
SET @password_hash = sha1(in_password);
SELECT staffID FROM staffDetailsTBL 
WHERE staffID=in_staffID
AND password=@password_hash;                          
END $$
DELIMITER ;


-- Create the staffUsernameExists function
-- If the username sent doesnt exist this will return 0.
DROP FUNCTION IF EXISTS staffUsernameExists;
DELIMITER $$
CREATE FUNCTION staffUsernameExists( in_username VARCHAR(35) )
RETURNS INT
BEGIN
DECLARE out_var INT;
SELECT COUNT(*) 
INTO out_var 
FROM staffDetailsTBL 
WHERE username=in_username;
RETURN out_var;
END $$
DELIMITER ;


-- ----------------------------------------------
-- - Stored procedures for Search Staff records -
-- ----------------------------------------------

-- Create the getAllStaffDetails procedure.
-- Returns all staff details except password.
DROP PROCEDURE IF EXISTS getAllStaffDetails;
DELIMITER $$
CREATE PROCEDURE getAllStaffDetails ()
BEGIN
SELECT staffID, accessLevel, jobPosition, username, surname, firstname, 
       addressLine1, addressLine2, postcode, phoneNumber, emailAddress
FROM staffDetailsTBL;
END $$
DELIMITER ;

-- Create the getStaffDetailsByIDNumber procedure.
-- Returns all staff details except password.
DROP PROCEDURE IF EXISTS getStaffDetailsByIDNumber;
DELIMITER $$
CREATE PROCEDURE getStaffDetailsByIDNumber ( IN in_staffID INT )
BEGIN
SELECT staffID, accessLevel, jobPosition, username, surname, firstname, 
       addressLine1, addressLine2, postcode, phoneNumber, emailAddress
FROM staffDetailsTBL
WHERE staffID=in_staffID;
END $$
DELIMITER ;


-- Create the getStaffDetailsByUsername procedure.
-- Returns all staff details except password.
DROP PROCEDURE IF EXISTS getStaffDetailsByUsername;
DELIMITER $$
CREATE PROCEDURE getStaffDetailsByUsername ( IN in_username VARCHAR(35) )
BEGIN
SELECT staffID, accessLevel, jobPosition, username, surname, firstname, 
       addressLine1, addressLine2, postcode, phoneNumber, emailAddress
FROM staffDetailsTBL
WHERE username LIKE in_username;
END $$
DELIMITER ;


-- Create the getStaffDetailsBySurname procedure.
-- Returns all staff details except password.
DROP PROCEDURE IF EXISTS getStaffDetailsBySurname;
DELIMITER $$
CREATE PROCEDURE getStaffDetailsBySurname ( IN in_surname VARCHAR(35) )
BEGIN
SELECT staffID, accessLevel, jobPosition, username, surname, firstname, 
       addressLine1, addressLine2, postcode, phoneNumber, emailAddress
FROM staffDetailsTBL
WHERE surname LIKE in_surname;
END $$
DELIMITER ;


-- Create the getStaffDetailsByJobPosition procedure.
-- Returns all staff details except password.
DROP PROCEDURE IF EXISTS getStaffDetailsByJobPosition;
DELIMITER $$
CREATE PROCEDURE getStaffDetailsByJobPosition ( IN in_jobPosition VARCHAR(35) )
BEGIN
SELECT staffID, accessLevel, jobPosition, username, surname, firstname, 
       addressLine1, addressLine2, postcode, phoneNumber, emailAddress
FROM staffDetailsTBL
WHERE jobPosition LIKE in_jobPosition;
END $$
DELIMITER ;


-- -------------------------------------------------
-- - Stored procedures for Search Customer records -
-- -------------------------------------------------

-- Create the getAllCustomerDetails procedure.
-- Returns all customer details except password.
DROP PROCEDURE IF EXISTS getAllCustomerDetails;
DELIMITER $$
CREATE PROCEDURE getAllCustomerDetails ( )
BEGIN
SELECT customerID, username, surname, firstname, addressLine1, 
       addressLine2, postcode, phoneNumber, emailAddress
FROM customerDetailsTBL;
END $$
DELIMITER ;


-- Create the getCustomerDetailsByIDNumber procedure.
-- Returns all customer details except password.
DROP PROCEDURE IF EXISTS getCustomerDetailsByIDNumber;
DELIMITER $$
CREATE PROCEDURE getCustomerDetailsByIDNumber ( IN in_customerID INT )
BEGIN
SELECT customerID, username, surname, firstname, addressLine1, 
       addressLine2, postcode, phoneNumber, emailAddress
FROM customerDetailsTBL
WHERE customerID=in_customerID;
END $$
DELIMITER ;


-- Create the getCustomerDetailsByUsername procedure.
-- Returns all customer details except password.
DROP PROCEDURE IF EXISTS getCustomerDetailsByUsername;
DELIMITER $$
CREATE PROCEDURE getCustomerDetailsByUsername ( IN in_username VARCHAR(35) )
BEGIN
SELECT customerID, username, surname, firstname, addressLine1, 
       addressLine2, postcode, phoneNumber, emailAddress
FROM customerDetailsTBL
WHERE username LIKE in_username;
END $$
DELIMITER ;


-- Create the getCustomerDetailsBySurname procedure.
-- Returns all customer details except password.
DROP PROCEDURE IF EXISTS getCustomerDetailsBySurname;
DELIMITER $$
CREATE PROCEDURE getCustomerDetailsBySurname ( IN in_surname VARCHAR(35) )
BEGIN
SELECT customerID, username, surname, firstname, addressLine1, 
       addressLine2, postcode, phoneNumber, emailAddress
FROM customerDetailsTBL
WHERE surname LIKE in_surname;
END $$
DELIMITER ;


-- Create the getCustomerDetailsByEmailAddress procedure.
-- Returns all customer details except password.
DROP PROCEDURE IF EXISTS getCustomerDetailsByEmailAddress;
DELIMITER $$
CREATE PROCEDURE getCustomerDetailsByEmailAddress ( IN in_emailAddress VARCHAR(50) )
BEGIN
SELECT customerID, username, surname, firstname, addressLine1, 
       addressLine2, postcode, phoneNumber, emailAddress
FROM customerDetailsTBL
WHERE emailAddress LIKE in_emailAddress;
END $$
DELIMITER ;


-- ------------------------------------------------
-- - Stored procedures for Search Product records -
-- ------------------------------------------------

-- Create the getAllProductDetails procedure
DROP PROCEDURE IF EXISTS getAllProductDetails;
DELIMITER $$
CREATE PROCEDURE getAllProductDetails ( )
BEGIN
SELECT itemID, itemName, category, quantity, description, 
       FORMAT(price,2) AS "price",imageFileName
FROM productTBL;
END $$
DELIMITER ;


-- Create the getProductDetailsByIDNumber procedure
DROP PROCEDURE IF EXISTS getProductDetailsByIDNumber;
DELIMITER $$
CREATE PROCEDURE getProductDetailsByIDNumber ( IN in_itemID INT )
BEGIN
SELECT itemID, itemName, category, quantity, description, 
       FORMAT(price,2) AS "price",imageFileName
FROM productTBL
WHERE itemID=in_itemID;
END $$
DELIMITER ;


-- Create the getProductDetailsByItemName procedure
DROP PROCEDURE IF EXISTS getProductDetailsByItemName;
DELIMITER $$
CREATE PROCEDURE getProductDetailsByItemName ( IN in_itemName VARCHAR(50) )
BEGIN
SELECT itemID, itemName, category, quantity, description, 
       FORMAT(price,2) AS "price",imageFileName
FROM productTBL
WHERE itemName LIKE in_itemName;
END $$
DELIMITER ;


-- Create the getProductDetailsByCategory procedure
DROP PROCEDURE IF EXISTS getProductDetailsByCategory;
DELIMITER $$
CREATE PROCEDURE getProductDetailsByCategory ( IN in_category VARCHAR(50) )
BEGIN
SELECT itemID, itemName, category, quantity, description, 
       FORMAT(price,2) AS "price",imageFileName
FROM productTBL
WHERE category LIKE in_category;
END $$
DELIMITER ;

-- ----------------------------------------------------------
-- - Stored procedures for Search Customer Feedback records -
-- ----------------------------------------------------------
--   To Create;                                             -
--         getCustomerFeedbackRecordsForPeriod              -
--         getCustomerFeedbackRecordsForLastWeek            -
--         getCustomerFeedbackRecordsForLastMonth           -
-- ----------------------------------------------------------

-- Create the getAllCustomerFeedbackRecords procedure.
-- Returns all customer feedback records.
DROP PROCEDURE IF EXISTS getAllCustomerFeedbackRecords;
DELIMITER $$
CREATE PROCEDURE getAllCustomerFeedbackRecords ( )
BEGIN
SELECT messageID, dateOfMessage, firstname, 
       surname, emailAddress, message
FROM customerFeedbackTBL;
END $$
DELIMITER ;


-- Create the getCustomerFeedbackRecordsBySurname procedure.
-- Returns customer feedback records for specified surname.
DROP PROCEDURE IF EXISTS getCustomerFeedbackRecordsBySurname;
DELIMITER $$
CREATE PROCEDURE getCustomerFeedbackRecordsBySurname ( IN in_surname VARCHAR(35) )
BEGIN
SELECT messageID, dateOfMessage, firstname, 
       surname, emailAddress, message
FROM customerFeedbackTBL
WHERE surname LIKE in_surname;
END $$
DELIMITER ;


-- Create the getCustomerFeedbackRecordsByEmailAddress procedure.
-- Returns customer feedback records for specified email address.
DROP PROCEDURE IF EXISTS getCustomerFeedbackRecordsByEmailAddress;
DELIMITER $$
CREATE PROCEDURE getCustomerFeedbackRecordsByEmailAddress ( IN in_emailAddress VARCHAR(50) )
BEGIN
SELECT messageID, dateOfMessage, firstname, 
       surname, emailAddress, message
FROM customerFeedbackTBL
WHERE emailAddress LIKE in_emailAddress;
END $$
DELIMITER ;


-- Create the getCustomerFeedbackRecordsByDateOfMessage procedure.
-- Returns customer feedback records for specified date.
-- NOTE: dateOfMessage is stored as a DATETIME.
DROP PROCEDURE IF EXISTS getCustomerFeedbackRecordsByDateOfMessage;
DELIMITER $$
CREATE PROCEDURE getCustomerFeedbackRecordsByDateOfMessage ( IN in_dateOfMessage DATE )
BEGIN
SELECT messageID, dateOfMessage, firstname, 
       surname, emailAddress, message
FROM customerFeedbackTBL
WHERE CAST(dateOfMessage as date)=in_dateOfMessage;
END $$
DELIMITER ;




-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
--                        END OF FILE
-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

