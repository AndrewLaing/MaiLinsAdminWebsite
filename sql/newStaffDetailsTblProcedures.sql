-- ---------------------------------------------------------------------------------------
--
-- Filename:     newStaffDetailsTblProcedures.sql
-- Author:       Andrew Laing
-- Email:        parisianconnections@gmail.com
-- Last updated: 25/06/2019.
-- Details:      The procedures needed to be updated to take into
--               account the use of the accessLevel variable.
--               New accounts will be set accessLevel 0 by default.
--               Only an administrator (level 3) will have the
--               ability to update a staff member's access level.
--
-- Contains the following procedures;
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
--    getStaffAccessLevel
--    setStaffAccessLevel
-- ---------------------------------------------------------------------------------------



-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
--              Procedures for the staffDetailsTBL
-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

-- Create the insertStaffDetails procedure
DROP PROCEDURE IF EXISTS insertStaffDetails;
DELIMITER $$
CREATE PROCEDURE insertStaffDetails ( IN in_jobPosition VARCHAR(35),
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
VALUES            			(     0, -- default access level is 0
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
SET jobPosition=in_jobPosition,
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
SELECT jobPosition, username, surname, firstname, 
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
SELECT staffID, jobPosition, username, surname, firstname, 
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
SELECT staffID, jobPosition, username, surname, firstname, 
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
SELECT staffID, jobPosition, username, surname, firstname, 
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
SELECT staffID, jobPosition, username, surname, firstname, 
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
SELECT staffID, jobPosition, username, surname, firstname, 
       addressLine1, addressLine2, postcode, phoneNumber, emailAddress
FROM staffDetailsTBL
WHERE jobPosition LIKE in_jobPosition;
END $$
DELIMITER ;


-- Create the getStaffAccessLevel procedure.
-- Returns the staff member's website access Level.
DROP PROCEDURE IF EXISTS getStaffAccessLevel;
DELIMITER $$
CREATE PROCEDURE getStaffAccessLevel ( IN in_staffID INT )
BEGIN
SELECT accessLevel
FROM staffDetailsTBL
WHERE staffID=in_staffID;
END $$
DELIMITER ;


-- Create the setStaffAccessLevel procedure
-- Used by administrators to update the staff member's
--  website access level.
DROP PROCEDURE IF EXISTS setStaffAccessLevel;
DELIMITER $$
CREATE PROCEDURE setStaffAccessLevel ( IN in_staffID INT,
                                      IN in_accessLevel TINYINT )
BEGIN
UPDATE staffDetailsTBL
SET accessLevel=in_accessLevel
WHERE staffID=in_staffID;
END $$
DELIMITER ;