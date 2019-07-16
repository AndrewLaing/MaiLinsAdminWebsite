--
-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
-- @@  TABLES, FUNCTIONS AND PROCEDURES FOR THE WEBSITE PAGES  @@
-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
--
-- Filename:     websiteTablesAndProcedures_08072019.sql
-- Author:       Andrew Laing
-- Email:        parisianconnections@gmail.com
-- Last updated: 08/07/2019.
--
-- TABLES:
--   customerDetailsTBL
--   customerFeedbackTBL
--   ordersTBL
--   orderItemsTBL
--   productTBL
--   staffDetailsTBL
-- 
-- PROCEDURES:
-- Procedures for the customerDetailsTBL -------------
--   checkPasswordIsValid
--   checkPasswordIDCombo
--   deleteCustomerDetails
--   getAllCustomerDetails
--   getCustomerDetails
--   getCustomerDetailsByEmailAddress
--   getCustomerDetailsByIDNumber
--   getCustomerDetailsBySurname
--   getCustomerDetailsByUsername
--   insertCustomerDetails
--   updateCustomerDetails
--   updatePassword
--   usernameExists
--
-- Procedures for the customerFeedbackTBL ------------
--   deleteFeedback
--   getAllCustomerFeedbackRecords
--   getCustomerFeedbackRecordsByDateOfMessage
--   getCustomerFeedbackRecordsByEmailAddress
--   getCustomerFeedbackRecordsBySurname
--   insertFeedback
--
--  Procedures for the ordersTBL ---------------------
--   addNewOrder
--   deleteOrder
--   getAllOrders
--   getAllThisAfternoonsOrders
--   getAllThisMorningsOrders
--   getAllTodaysOrders
--   getAllTomorrowsOrders
--   getAllTonightsOrders
--   getOrderDeliveryDetails
--   getOrderItemDetails
--   insertOrder
--   updateOrder
--   updateOrderSetPaymentReceived
--
-- Procedures for the orderItemsTBL ------------------
--   deleteOrderItem
--   insertOrderItem
--   updateOrderItem
--
-- Procedures for the productTBL ---------------------
--   deleteProduct
--   getAllProductDetails
--   getAllProductDetails
--   getProductDetailsByCategory
--   getProductDetailsByIDNumber
--   getProductDetailsByItemName
--   insertProduct
--   updateProduct
--
-- Procedures for the staffDetailsTBL ----------------
--   checkStaffPasswordIDCombo
--   checkStaffPasswordIsValid
--   deleteStaffDetails
--   getAllStaffDetails
--   getStaffAccessLevel
--   getStaffDetails
--   getStaffDetailsByIDNumber
--   getStaffDetailsByJobPosition
--   getStaffDetailsBySurname
--   getStaffDetailsByUsername
--   insertStaffDetails
--   setStaffAccessLevel
--   staffUsernameExists
--   updateStaffDetails
--   updateStaffPassword
--
-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

use foodDB;

-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
--                     Create the tables
-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

-- Create the customerDetailsTBL TABLE 
DROP TABLE IF EXISTS customerDetailsTBL;

CREATE TABLE customerDetailsTBL (
    customerID INT AUTO_INCREMENT PRIMARY KEY,
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


-- create the customerFeedbackTBL TABLE
DROP TABLE IF EXISTS customerFeedbackTBL;

CREATE TABLE customerFeedbackTBL (
    messageID INT AUTO_INCREMENT PRIMARY KEY,
    dateOfMessage DATETIME NOT NULL,
    firstname VARCHAR(35),
    surname VARCHAR(35),
    emailAddress VARCHAR(50),
    message VARCHAR(500)
);


-- Create the ordersTBL TABLE 
DROP TABLE IF EXISTS ordersTBL;

CREATE TABLE ordersTBL (
    orderID INT AUTO_INCREMENT PRIMARY KEY,
    customerID INT NOT NULL,
    dateOfOrder DATE NOT NULL,
    deliveryTimeDate DATETIME NOT NULL,
    paymentReceived BIT DEFAULT 0
);


-- Create the orderItemsTBL TABLE 
DROP TABLE IF EXISTS orderItemsTBL;

CREATE TABLE orderItemsTBL (
    orderItemID INT AUTO_INCREMENT PRIMARY KEY,
    orderID INT NOT NULL,
    itemID INT NOT NULL,
    quantity TINYINT NOT NULL
);


-- Create the productTBL TABLE 
DROP TABLE IF EXISTS productTBL;

CREATE TABLE productTBL (
    itemID INT AUTO_INCREMENT PRIMARY KEY,
    itemName VARCHAR(50) NOT NULL,
    category VARCHAR(20) NOT NULL,
    quantity TINYINT NOT NULL,
    description VARCHAR(300),
    price DECIMAL(13,4) NOT NULL,
    imageFileName VARCHAR(50)
);


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
--               Add foreign key constraints
-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

ALTER TABLE ordersTBL 
ADD CONSTRAINT fk_customer_id 
FOREIGN KEY (customerID) 
REFERENCES customerDetailsTBL (customerID)
ON DELETE CASCADE;

ALTER TABLE orderItemsTBL
ADD CONSTRAINT fk_item_id 
FOREIGN KEY (itemID) 
REFERENCES productTBL (itemID)
ON DELETE CASCADE;


-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
--              Procedures for the customerDetailsTBL
-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

-- Create the checkPasswordIsValid procedure
DROP PROCEDURE IF EXISTS checkPasswordIsValid;
DELIMITER $$
CREATE PROCEDURE checkPasswordIsValid ( IN in_username VARCHAR(35),
                                        IN in_password VARCHAR(255) )
BEGIN
SET @password_hash = sha1(in_password);
SELECT customerID FROM customerDetailsTBL 
WHERE username=in_username
AND password=@password_hash;
                                  
END $$
DELIMITER ;


-- Create the checkPasswordIDCombo procedure
DROP PROCEDURE IF EXISTS checkPasswordIDCombo;
DELIMITER $$
CREATE PROCEDURE checkPasswordIDCombo ( IN in_customerID INT,
                                        IN in_password VARCHAR(255) )
BEGIN
SET @password_hash = sha1(in_password);
SELECT customerID FROM customerDetailsTBL 
WHERE customerID=in_customerID
AND password=@password_hash;                          
END $$
DELIMITER ;


-- Create the deleteCustomerDetails procedure
DROP PROCEDURE IF EXISTS deleteCustomerDetails;
DELIMITER $$
CREATE PROCEDURE deleteCustomerDetails (IN in_customerID INT)
BEGIN
DELETE FROM customerDetailsTBL 
WHERE customerID=in_customerID;
END $$
DELIMITER ;


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


-- Create the getCustomerDetails procedure
-- Returns all user details except password and customerID
DROP PROCEDURE IF EXISTS getCustomerDetails;
DELIMITER $$
CREATE PROCEDURE getCustomerDetails ( IN in_customerID INT )
BEGIN
SELECT username, surname, firstname, addressLine1, addressLine2, postcode, phoneNumber, emailAddress
FROM customerDetailsTBL
WHERE customerID=in_customerID;
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


-- Create the insertCustomerDetails procedure
DROP PROCEDURE IF EXISTS insertCustomerDetails;
DELIMITER $$
CREATE PROCEDURE insertCustomerDetails ( IN in_username VARCHAR(35),
                                         IN in_password VARCHAR(255), 
                                         IN in_surname VARCHAR(35),
                                         IN in_firstname VARCHAR(35),
                                         IN in_addressLine1 VARCHAR(35),
                                         IN in_addressLine2 VARCHAR(35),
                                         IN in_postcode VARCHAR(8),
                                         IN in_phoneNumber VARCHAR(35),
                                         IN in_emailAddress VARCHAR(50) )
BEGIN
INSERT INTO customerDetailsTBL ( username,
                                 password,
                                 surname,
                                 firstname,
                                 addressLine1,
                                 addressLine2,
                                 postcode,
                                 phoneNumber,
                                 emailAddress )
VALUES            			       ( in_username,
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


-- Create the updateCustomerDetails procedure
DROP PROCEDURE IF EXISTS updateCustomerDetails;
DELIMITER $$
CREATE PROCEDURE updateCustomerDetails ( IN in_customerID INT,
                                         IN in_surname VARCHAR(35),
                                         IN in_firstname VARCHAR(35),
                                         IN in_addressLine1 VARCHAR(35),
                                         IN in_addressLine2 VARCHAR(35),
                                         IN in_postcode VARCHAR(8),
                                         IN in_phoneNumber VARCHAR(35),
                                         IN in_emailAddress VARCHAR(50) )
BEGIN
UPDATE customerDetailsTBL
SET surname=in_surname,
    firstname=in_firstname,
    addressLine1=in_addressLine1,
    addressLine2=in_addressLine2,
    postcode=in_postcode,
    phoneNumber=in_phoneNumber,
    emailAddress=in_emailAddress
WHERE customerID=in_customerID;
END $$
DELIMITER ;


-- Create the updatePassword procedure
DROP PROCEDURE IF EXISTS updatePassword;
DELIMITER $$
CREATE PROCEDURE updatePassword ( IN in_customerID INT,
                                  IN in_password VARCHAR(255) )
BEGIN
UPDATE customerDetailsTBL
SET password=sha1(in_password)
WHERE customerID=in_customerID;
END $$
DELIMITER ;


-- Create the usernameExists function
-- If the username sent doesnt exist this will return 0.
DROP FUNCTION IF EXISTS usernameExists;
DELIMITER $$
CREATE FUNCTION usernameExists( in_username VARCHAR(35) )
RETURNS INT
BEGIN
DECLARE out_var INT;
SELECT COUNT(*) 
INTO out_var 
FROM customerDetailsTBL 
WHERE username=in_username;
RETURN out_var;
END $$
DELIMITER ;

-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
--           Procedures for the customerFeedbackTBL
-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

-- Create the deleteFeedback procedure
DROP PROCEDURE IF EXISTS deleteFeedback;
DELIMITER $$
CREATE PROCEDURE deleteFeedback ( IN in_messageID INT )
BEGIN
DELETE FROM customerFeedbackTBL
WHERE messageID=in_messageID;
END $$
DELIMITER ;


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


-- Create the insertFeedback procedure
DROP PROCEDURE IF EXISTS insertFeedback;
DELIMITER $$
CREATE PROCEDURE insertFeedback ( IN in_firstname VARCHAR(35),
                                  IN in_surname VARCHAR(35),
                                  IN in_emailAddress VARCHAR(50),
                                  IN in_message VARCHAR(500))
BEGIN
INSERT INTO customerFeedbackTBL ( dateOfMessage,
                                  firstname,
                                  surname,
                                  emailAddress,
                                  message )
VALUES    			                ( now(),                -- insert current datetime
                                  in_firstname,
                                  in_surname,
                                  in_emailAddress,
                                  in_message ); 	
END $$
DELIMITER ;


-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
--              Procedures for the ordersTBL
-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

-- Create the addNewOrder function
DROP FUNCTION IF EXISTS addNewOrder;
DELIMITER $$
CREATE FUNCTION addNewOrder ( in_customerID INT,
                              in_deliveryTimeDate DATETIME )
RETURNS INT
BEGIN
DECLARE today DATE;
DECLARE todaynow DATETIME;

SET today = curdate();
SET todaynow = now();

-- check first that delivery date is not before today and current time
IF todaynow > in_deliveryTimeDate THEN
RETURN -1;
END IF;

-- insert the new order and return the id of the record created
CALL insertOrder(in_customerID, today, in_deliveryTimeDate, 0);
RETURN LAST_INSERT_ID();
END $$
DELIMITER ;


-- Create the deleteOrder procedure
DROP PROCEDURE IF EXISTS deleteOrder;
DELIMITER $$
CREATE PROCEDURE deleteOrder ( IN in_orderID INT )
BEGIN
DELETE FROM ordersTBL
WHERE orderID=in_orderID;
END $$
DELIMITER ;


-- Create the getAllOrders procedure
DROP PROCEDURE IF EXISTS getAllOrders;
DELIMITER $$
CREATE PROCEDURE getAllOrders ()
BEGIN
SELECT * FROM ordersTBL
ORDER BY deliveryTimeDate ASC; 		
END $$
DELIMITER ;


-- Create the getAllThisAfternoonsOrders procedure
DROP PROCEDURE IF EXISTS getAllThisAfternoonsOrders;
DELIMITER $$
CREATE PROCEDURE getAllThisAfternoonsOrders ()
BEGIN
SET @today = DATE(NOW());
SET @endOfMorning = ADDTIME(CONVERT(@today, DATETIME), '0 12:0:0.0');
SET @startOfTonight = ADDTIME(CONVERT(@today, DATETIME), '0 19:0:0.0');
SELECT * FROM ordersTBL
WHERE CONVERT(deliveryTimeDate, DATE)=@today
AND
deliveryTimeDate>@endOfMorning
AND
deliveryTimeDate<@startOfTonight
ORDER BY deliveryTimeDate ASC; 	 	
END $$
DELIMITER ;


-- Create the getAllThisMorningsOrders procedure
DROP PROCEDURE IF EXISTS getAllThisMorningsOrders;
DELIMITER $$
CREATE PROCEDURE getAllThisMorningsOrders ()
BEGIN
SET @today = DATE(NOW());
SET @endOfMorning = ADDTIME(CONVERT(@today, DATETIME), '0 12:0:0.0');
SELECT * FROM ordersTBL
WHERE CONVERT(deliveryTimeDate, DATE)=@today
AND
deliveryTimeDate<=@endOfMorning
ORDER BY deliveryTimeDate ASC; 		
END $$
DELIMITER ;


-- Create the getAllTodaysOrders procedure
DROP PROCEDURE IF EXISTS getAllTodaysOrders;
DELIMITER $$
CREATE PROCEDURE getAllTodaysOrders ()
BEGIN
SET @today = DATE(NOW());
SELECT * FROM ordersTBL
WHERE CONVERT(deliveryTimeDate, DATE)=@today
ORDER BY deliveryTimeDate ASC; 	
END $$
DELIMITER ;


-- Create the getAllTomorrowsOrders procedure
DROP PROCEDURE IF EXISTS getAllTomorrowsOrders;
DELIMITER $$
CREATE PROCEDURE getAllTomorrowsOrders ()
BEGIN
SET @tomorrow = ADDDATE(DATE(NOW()),1);
SELECT * FROM ordersTBL
WHERE CONVERT(deliveryTimeDate, DATE)=@tomorrow
ORDER BY deliveryTimeDate ASC; 		
END $$
DELIMITER ;


-- Create the getAllTonightsOrders procedure
DROP PROCEDURE IF EXISTS getAllTonightsOrders;
DELIMITER $$
CREATE PROCEDURE getAllTonightsOrders ()
BEGIN
SET @today = DATE(NOW());
SET @startOfTonight = ADDTIME(CONVERT(@today, DATETIME), '0 19:0:0.0');
SELECT * FROM ordersTBL
WHERE CONVERT(deliveryTimeDate, DATE)=@today
AND
deliveryTimeDate>=@startOfTonight
ORDER BY deliveryTimeDate ASC; 	
END $$
DELIMITER ;


-- Create the getOrderDeliveryDetails procedure
DROP PROCEDURE IF EXISTS getOrderDeliveryDetails;
DELIMITER $$
CREATE PROCEDURE getOrderDeliveryDetails ( IN in_orderID INT )
BEGIN
SELECT customerdetailstbl.firstname, 
       customerdetailstbl.surname,
       customerdetailstbl.addressLine1,
       customerdetailstbl.addressLine2,
       customerdetailstbl.postcode,
       customerdetailstbl.phoneNumber
FROM orderstbl 
INNER JOIN customerdetailstbl ON (orderstbl.customerID=customerdetailstbl.customerID)
WHERE
orderstbl.orderID = in_orderID;
END $$
DELIMITER ;


-- Create the getOrderItemDetails procedure
DROP PROCEDURE IF EXISTS getOrderItemDetails;
DELIMITER $$
CREATE PROCEDURE getOrderItemDetails ( IN in_orderID INT )
BEGIN
SELECT producttbl.itemName,
producttbl.category,
producttbl.description,
orderitemstbl.quantity,
FORMAT(producttbl.price * orderitemstbl.quantity,2) "ordercost"
FROM orderitemstbl 
INNER JOIN producttbl ON (orderitemstbl.itemID=producttbl.itemID)
WHERE
orderitemstbl.orderID=in_orderID;
END $$
DELIMITER ;


-- Create the insertOrder procedure
DROP PROCEDURE IF EXISTS insertOrder;
DELIMITER $$
CREATE PROCEDURE insertOrder ( IN in_customerID INT,
                               IN in_dateOfOrder DATE,
                               IN in_deliveryTimeDate DATETIME,
                               IN in_paymentReceived BIT )
BEGIN
INSERT INTO ordersTBL ( customerID,
                        dateOfOrder,
                        deliveryTimeDate,
                        paymentReceived )
VALUES    			      ( in_customerID,
                        in_dateOfOrder,
                        in_deliveryTimeDate,
                        in_paymentReceived ); 	
END $$
DELIMITER ;


-- Create the updateOrder procedure
DROP PROCEDURE IF EXISTS updateOrder;
DELIMITER $$
CREATE PROCEDURE updateOrder ( IN in_orderID INT, 
                               IN in_customerID INT,
                               IN in_dateOfOrder DATE,
                               IN in_deliveryTimeDate DATETIME,
                               IN in_paymentReceived BIT )
BEGIN
UPDATE ordersTBL
SET customerID=in_customerID,
    dateOfOrder=in_dateOfOrder,
    deliveryTimeDate=in_deliveryTimeDate,
    paymentReceived=in_paymentReceived 
WHERE orderID=in_orderID;
END $$
DELIMITER ;


-- Create the updateOrderSetPaymentReceived procedure
DROP PROCEDURE IF EXISTS updateOrderSetPaymentReceived;
DELIMITER $$
CREATE PROCEDURE updateOrderSetPaymentReceived ( IN in_orderID INT )
BEGIN
UPDATE ordersTBL
SET paymentReceived=1
WHERE orderID=in_orderID;
END $$
DELIMITER ;

-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
--              Procedures for the orderItemsTBL
-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

-- Create the deleteOrderItem procedure
DROP PROCEDURE IF EXISTS deleteOrderItem;
DELIMITER $$
CREATE PROCEDURE deleteOrderItem ( IN in_orderItemID INT )
BEGIN
DELETE FROM orderItemsTBL
WHERE orderItemID=in_orderItemID;
END $$
DELIMITER ;


-- Create the insertOrderItem procedure
DROP PROCEDURE IF EXISTS insertOrderItem;
DELIMITER $$
CREATE PROCEDURE insertOrderItem ( IN in_orderID INT,
                                   IN in_itemID INT,
                                   IN in_quantity TINYINT )
BEGIN
INSERT INTO orderItemsTBL ( orderID,
                            itemID,
                            quantity)
VALUES    			          ( in_orderID,
                            in_itemID,
                            in_quantity ); 	
END $$
DELIMITER ;


-- Create the updateItemOrder procedure
DROP PROCEDURE IF EXISTS updateOrderItem;
DELIMITER $$
CREATE PROCEDURE updateOrderItem ( IN in_orderItemID INT,
                                   IN in_orderID INT,
                                   IN in_itemID INT,
                                   IN in_quantity TINYINT )
BEGIN
UPDATE orderItemsTBL
SET orderID=in_orderID,
    itemID=in_itemID,
    quantity=in_quantity
WHERE orderItemID=in_orderItemID;
END $$
DELIMITER ;


-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
--              Procedures for the productTBL
-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

-- Create the deleteProduct procedure
DROP PROCEDURE IF EXISTS deleteProduct;
DELIMITER $$
CREATE PROCEDURE deleteProduct (IN in_itemID INT)
BEGIN
DELETE FROM productTBL 
WHERE itemID=in_itemID;
END $$
DELIMITER ;


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


-- Create the insertProduct procedure
DROP PROCEDURE IF EXISTS insertProduct;
DELIMITER $$
CREATE PROCEDURE insertProduct ( IN in_itemName VARCHAR(50),
                                 IN in_category VARCHAR(20),
                                 IN in_quantity TINYINT,
                                 IN in_description VARCHAR(300),
                                 IN in_price DECIMAL(13,4),
                                 IN in_imagefilename VARCHAR(50) )
BEGIN
INSERT INTO productTBL ( itemName,
                         category,
                         quantity,
                         description,
                         price,
                         imagefilename )
VALUES    			       ( in_itemName,
                         in_category,
                         in_quantity,
                         in_description,
                         in_price,
                         in_imagefilename ); 	
END $$
DELIMITER ;


-- Create the updateProduct procedure
DROP PROCEDURE IF EXISTS updateProduct;
DELIMITER $$
CREATE PROCEDURE updateProduct ( IN in_itemID INT,
                                 IN in_itemName VARCHAR(50),
                                 IN in_category VARCHAR(20),
                                 IN in_quantity TINYINT,
                                 IN in_description VARCHAR(300),
                                 IN in_price DECIMAL(13,4),
                                 IN in_imagefilename VARCHAR(50) )
BEGIN
UPDATE productTBL 
SET itemName=in_itemName,
    category=in_category,
    quantity=in_quantity,
    description=in_description,
    price=in_price,
    imagefilename=in_imagefilename
WHERE itemID=in_itemID;
END $$
DELIMITER ;

-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
--              Procedures for the staffDetailsTBL
-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

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


-- Create the deleteStaffDetails procedure
DROP PROCEDURE IF EXISTS deleteStaffDetails;
DELIMITER $$
CREATE PROCEDURE deleteStaffDetails (IN in_staffID INT)
BEGIN
DELETE FROM staffDetailsTBL 
WHERE staffID=in_staffID;
END $$
DELIMITER ;


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


-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
--                        END OF FILE
-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
