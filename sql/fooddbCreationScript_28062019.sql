-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2019 at 11:31 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fooddb`
--
CREATE DATABASE IF NOT EXISTS `fooddb` DEFAULT CHARACTER SET latin1 COLLATE latin1_bin;
USE `fooddb`;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `checkPasswordIDCombo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `checkPasswordIDCombo` (IN `in_customerID` INT, IN `in_password` VARCHAR(255))  BEGIN
SET @password_hash = sha1(in_password);
SELECT customerID FROM customerDetailsTBL 
WHERE customerID=in_customerID
AND password=@password_hash;                          
END$$

DROP PROCEDURE IF EXISTS `checkPasswordIsValid`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `checkPasswordIsValid` (IN `in_username` VARCHAR(35), IN `in_password` VARCHAR(255))  BEGIN
SET @password_hash = sha1(in_password);
SELECT customerID FROM customerDetailsTBL 
WHERE username=in_username
AND password=@password_hash;
                                  
END$$

DROP PROCEDURE IF EXISTS `checkStaffPasswordIDCombo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `checkStaffPasswordIDCombo` (IN `in_staffID` INT, IN `in_password` VARCHAR(255))  BEGIN
SET @password_hash = sha1(in_password);
SELECT staffID FROM staffDetailsTBL 
WHERE staffID=in_staffID
AND password=@password_hash;                          
END$$

DROP PROCEDURE IF EXISTS `checkStaffPasswordIsValid`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `checkStaffPasswordIsValid` (IN `in_username` VARCHAR(35), IN `in_password` VARCHAR(255))  BEGIN
SET @password_hash = sha1(in_password);
SELECT staffID, accessLevel FROM staffDetailsTBL 
WHERE username=in_username
AND password=@password_hash;                   
END$$

DROP PROCEDURE IF EXISTS `deleteCustomerDetails`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteCustomerDetails` (IN `in_customerID` INT)  BEGIN
DELETE FROM customerDetailsTBL 
WHERE customerID=in_customerID;
END$$

DROP PROCEDURE IF EXISTS `deleteFeedback`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteFeedback` (IN `in_messageID` INT)  BEGIN
DELETE FROM customerFeedbackTBL
WHERE messageID=in_messageID;
END$$

DROP PROCEDURE IF EXISTS `deleteOrder`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteOrder` (IN `in_orderID` INT)  BEGIN
DELETE FROM ordersTBL
WHERE orderID=in_orderID;
END$$

DROP PROCEDURE IF EXISTS `deleteOrderItem`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteOrderItem` (IN `in_orderItemID` INT)  BEGIN
DELETE FROM orderItemsTBL
WHERE orderItemID=in_orderItemID;
END$$

DROP PROCEDURE IF EXISTS `deleteProduct`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteProduct` (IN `in_itemID` INT)  BEGIN
DELETE FROM productTBL 
WHERE itemID=in_itemID;
END$$

DROP PROCEDURE IF EXISTS `deleteStaffDetails`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteStaffDetails` (IN `in_staffID` INT)  BEGIN
DELETE FROM staffDetailsTBL 
WHERE staffID=in_staffID;
END$$

DROP PROCEDURE IF EXISTS `getAllCustomerDetails`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllCustomerDetails` ()  BEGIN
SELECT customerID, username, surname, firstname, addressLine1, 
       addressLine2, postcode, phoneNumber, emailAddress
FROM customerDetailsTBL;
END$$

DROP PROCEDURE IF EXISTS `getAllCustomerFeedbackRecords`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllCustomerFeedbackRecords` ()  BEGIN
SELECT messageID, dateOfMessage, firstname, 
       surname, emailAddress, message
FROM customerFeedbackTBL;
END$$

DROP PROCEDURE IF EXISTS `getAllProductDetails`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllProductDetails` ()  BEGIN
SELECT itemID, itemName, category, quantity, description, 
       FORMAT(price,2) AS "price",imageFileName
FROM productTBL;
END$$

DROP PROCEDURE IF EXISTS `getAllStaffDetails`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllStaffDetails` ()  BEGIN
SELECT staffID, jobPosition, username, surname, firstname, 
       addressLine1, addressLine2, postcode, phoneNumber, emailAddress
FROM staffDetailsTBL;
END$$

DROP PROCEDURE IF EXISTS `getCustomerDetails`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getCustomerDetails` (IN `in_customerID` INT)  BEGIN
SELECT username, surname, firstname, addressLine1, addressLine2, postcode, phoneNumber, emailAddress
FROM customerDetailsTBL
WHERE customerID=in_customerID;
END$$

DROP PROCEDURE IF EXISTS `getCustomerDetailsByEmailAddress`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getCustomerDetailsByEmailAddress` (IN `in_emailAddress` VARCHAR(50))  BEGIN
SELECT customerID, username, surname, firstname, addressLine1, 
       addressLine2, postcode, phoneNumber, emailAddress
FROM customerDetailsTBL
WHERE emailAddress LIKE in_emailAddress;
END$$

DROP PROCEDURE IF EXISTS `getCustomerDetailsByIDNumber`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getCustomerDetailsByIDNumber` (IN `in_customerID` INT)  BEGIN
SELECT customerID, username, surname, firstname, addressLine1, 
       addressLine2, postcode, phoneNumber, emailAddress
FROM customerDetailsTBL
WHERE customerID=in_customerID;
END$$

DROP PROCEDURE IF EXISTS `getCustomerDetailsBySurname`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getCustomerDetailsBySurname` (IN `in_surname` VARCHAR(35))  BEGIN
SELECT customerID, username, surname, firstname, addressLine1, 
       addressLine2, postcode, phoneNumber, emailAddress
FROM customerDetailsTBL
WHERE surname LIKE in_surname;
END$$

DROP PROCEDURE IF EXISTS `getCustomerDetailsByUsername`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getCustomerDetailsByUsername` (IN `in_username` VARCHAR(35))  BEGIN
SELECT customerID, username, surname, firstname, addressLine1, 
       addressLine2, postcode, phoneNumber, emailAddress
FROM customerDetailsTBL
WHERE username LIKE in_username;
END$$

DROP PROCEDURE IF EXISTS `getCustomerFeedbackRecordsByDateOfMessage`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getCustomerFeedbackRecordsByDateOfMessage` (IN `in_dateOfMessage` DATE)  BEGIN
SELECT messageID, dateOfMessage, firstname, 
       surname, emailAddress, message
FROM customerFeedbackTBL
WHERE CAST(dateOfMessage as date)=in_dateOfMessage;
END$$

DROP PROCEDURE IF EXISTS `getCustomerFeedbackRecordsByEmailAddress`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getCustomerFeedbackRecordsByEmailAddress` (IN `in_emailAddress` VARCHAR(50))  BEGIN
SELECT messageID, dateOfMessage, firstname, 
       surname, emailAddress, message
FROM customerFeedbackTBL
WHERE emailAddress LIKE in_emailAddress;
END$$

DROP PROCEDURE IF EXISTS `getCustomerFeedbackRecordsBySurname`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getCustomerFeedbackRecordsBySurname` (IN `in_surname` VARCHAR(35))  BEGIN
SELECT messageID, dateOfMessage, firstname, 
       surname, emailAddress, message
FROM customerFeedbackTBL
WHERE surname LIKE in_surname;
END$$

DROP PROCEDURE IF EXISTS `getOrderDeliveryDetails`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getOrderDeliveryDetails` (IN `in_orderID` INT)  BEGIN
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
END$$

DROP PROCEDURE IF EXISTS `getOrderItemDetails`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getOrderItemDetails` (IN `in_orderID` INT)  BEGIN
SELECT producttbl.itemName,
producttbl.category,
producttbl.description,
orderitemstbl.quantity,
FORMAT(producttbl.price * orderitemstbl.quantity,2) "ordercost"
FROM orderitemstbl 
INNER JOIN producttbl ON (orderitemstbl.itemID=producttbl.itemID)
WHERE
orderitemstbl.orderID=in_orderID;
END$$

DROP PROCEDURE IF EXISTS `getProductDetailsByCategory`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getProductDetailsByCategory` (IN `in_category` VARCHAR(50))  BEGIN
SELECT itemID, itemName, category, quantity, description, 
       FORMAT(price,2) AS "price",imageFileName
FROM productTBL
WHERE category LIKE in_category;
END$$

DROP PROCEDURE IF EXISTS `getProductDetailsByIDNumber`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getProductDetailsByIDNumber` (IN `in_itemID` INT)  BEGIN
SELECT itemID, itemName, category, quantity, description, 
       FORMAT(price,2) AS "price",imageFileName
FROM productTBL
WHERE itemID=in_itemID;
END$$

DROP PROCEDURE IF EXISTS `getProductDetailsByItemName`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getProductDetailsByItemName` (IN `in_itemName` VARCHAR(50))  BEGIN
SELECT itemID, itemName, category, quantity, description, 
       FORMAT(price,2) AS "price",imageFileName
FROM productTBL
WHERE itemName LIKE in_itemName;
END$$

DROP PROCEDURE IF EXISTS `getStaffAccessLevel`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getStaffAccessLevel` (IN `in_staffID` INT)  BEGIN
SELECT accessLevel
FROM staffDetailsTBL
WHERE staffID=in_staffID;
END$$

DROP PROCEDURE IF EXISTS `getStaffDetails`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getStaffDetails` (IN `in_staffID` INT)  BEGIN
SELECT jobPosition, username, surname, firstname, 
       addressLine1, addressLine2, postcode, phoneNumber, emailAddress
FROM staffDetailsTBL
WHERE staffID=in_staffID;
END$$

DROP PROCEDURE IF EXISTS `getStaffDetailsByIDNumber`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getStaffDetailsByIDNumber` (IN `in_staffID` INT)  BEGIN
SELECT staffID, jobPosition, username, surname, firstname, 
       addressLine1, addressLine2, postcode, phoneNumber, emailAddress
FROM staffDetailsTBL
WHERE staffID=in_staffID;
END$$

DROP PROCEDURE IF EXISTS `getStaffDetailsByJobPosition`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getStaffDetailsByJobPosition` (IN `in_jobPosition` VARCHAR(35))  BEGIN
SELECT staffID, jobPosition, username, surname, firstname, 
       addressLine1, addressLine2, postcode, phoneNumber, emailAddress
FROM staffDetailsTBL
WHERE jobPosition LIKE in_jobPosition;
END$$

DROP PROCEDURE IF EXISTS `getStaffDetailsBySurname`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getStaffDetailsBySurname` (IN `in_surname` VARCHAR(35))  BEGIN
SELECT staffID, jobPosition, username, surname, firstname, 
       addressLine1, addressLine2, postcode, phoneNumber, emailAddress
FROM staffDetailsTBL
WHERE surname LIKE in_surname;
END$$

DROP PROCEDURE IF EXISTS `getStaffDetailsByUsername`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getStaffDetailsByUsername` (IN `in_username` VARCHAR(35))  BEGIN
SELECT staffID, jobPosition, username, surname, firstname, 
       addressLine1, addressLine2, postcode, phoneNumber, emailAddress
FROM staffDetailsTBL
WHERE username LIKE in_username;
END$$

DROP PROCEDURE IF EXISTS `insertCustomerDetails`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertCustomerDetails` (IN `in_username` VARCHAR(35), IN `in_password` VARCHAR(255), IN `in_surname` VARCHAR(35), IN `in_firstname` VARCHAR(35), IN `in_addressLine1` VARCHAR(35), IN `in_addressLine2` VARCHAR(35), IN `in_postcode` VARCHAR(8), IN `in_phoneNumber` VARCHAR(35), IN `in_emailAddress` VARCHAR(50))  BEGIN
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
END$$

DROP PROCEDURE IF EXISTS `insertFeedback`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertFeedback` (IN `in_firstname` VARCHAR(35), IN `in_surname` VARCHAR(35), IN `in_emailAddress` VARCHAR(50), IN `in_message` VARCHAR(500))  BEGIN
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
END$$

DROP PROCEDURE IF EXISTS `insertOrder`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertOrder` (IN `in_customerID` INT, IN `in_dateOfOrder` DATE, IN `in_deliveryTimeDate` DATETIME, IN `in_paymentReceived` BIT)  BEGIN
INSERT INTO ordersTBL ( customerID,
                        dateOfOrder,
                        deliveryTimeDate,
                        paymentReceived )
VALUES    			      ( in_customerID,
                        in_dateOfOrder,
                        in_deliveryTimeDate,
                        in_paymentReceived ); 	
END$$

DROP PROCEDURE IF EXISTS `insertOrderItem`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertOrderItem` (IN `in_orderID` INT, IN `in_itemID` INT, IN `in_quantity` TINYINT)  BEGIN
INSERT INTO orderItemsTBL ( orderID,
                            itemID,
                            quantity)
VALUES    			          ( in_orderID,
                            in_itemID,
                            in_quantity ); 	
END$$

DROP PROCEDURE IF EXISTS `insertProduct`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertProduct` (IN `in_itemName` VARCHAR(50), IN `in_category` VARCHAR(20), IN `in_quantity` TINYINT, IN `in_description` VARCHAR(300), IN `in_price` DECIMAL(13,4), IN `in_imagefilename` VARCHAR(50))  BEGIN
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
END$$

DROP PROCEDURE IF EXISTS `insertStaffDetails`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertStaffDetails` (IN `in_jobPosition` VARCHAR(35), IN `in_username` VARCHAR(35), IN `in_password` VARCHAR(255), IN `in_surname` VARCHAR(35), IN `in_firstname` VARCHAR(35), IN `in_addressLine1` VARCHAR(35), IN `in_addressLine2` VARCHAR(35), IN `in_postcode` VARCHAR(8), IN `in_phoneNumber` VARCHAR(35), IN `in_emailAddress` VARCHAR(50))  BEGIN
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
END$$

DROP PROCEDURE IF EXISTS `setStaffAccessLevel`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `setStaffAccessLevel` (IN `in_staffID` INT, IN `in_accessLevel` TINYINT)  BEGIN
UPDATE staffDetailsTBL
SET accessLevel=in_accessLevel
WHERE staffID=in_staffID;
END$$

DROP PROCEDURE IF EXISTS `updateCustomerDetails`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateCustomerDetails` (IN `in_customerID` INT, IN `in_surname` VARCHAR(35), IN `in_firstname` VARCHAR(35), IN `in_addressLine1` VARCHAR(35), IN `in_addressLine2` VARCHAR(35), IN `in_postcode` VARCHAR(8), IN `in_phoneNumber` VARCHAR(35), IN `in_emailAddress` VARCHAR(50))  BEGIN
UPDATE customerDetailsTBL
SET surname=in_surname,
    firstname=in_firstname,
    addressLine1=in_addressLine1,
    addressLine2=in_addressLine2,
    postcode=in_postcode,
    phoneNumber=in_phoneNumber,
    emailAddress=in_emailAddress
WHERE customerID=in_customerID;
END$$

DROP PROCEDURE IF EXISTS `updateOrder`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateOrder` (IN `in_orderID` INT, IN `in_customerID` INT, IN `in_dateOfOrder` DATE, IN `in_deliveryTimeDate` DATETIME, IN `in_paymentReceived` BIT)  BEGIN
UPDATE ordersTBL
SET customerID=in_customerID,
    dateOfOrder=in_dateOfOrder,
    deliveryTimeDate=in_deliveryTimeDate,
    paymentReceived=in_paymentReceived 
WHERE orderID=in_orderID;
END$$

DROP PROCEDURE IF EXISTS `updateOrderItem`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateOrderItem` (IN `in_orderItemID` INT, IN `in_orderID` INT, IN `in_itemID` INT, IN `in_quantity` TINYINT)  BEGIN
UPDATE orderItemsTBL
SET orderID=in_orderID,
    itemID=in_itemID,
    quantity=in_quantity
WHERE orderItemID=in_orderItemID;
END$$

DROP PROCEDURE IF EXISTS `updateOrderSetPaymentReceived`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateOrderSetPaymentReceived` (IN `in_orderID` INT)  BEGIN
UPDATE ordersTBL
SET paymentReceived=1
WHERE orderID=in_orderID;
END$$

DROP PROCEDURE IF EXISTS `updatePassword`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updatePassword` (IN `in_customerID` INT, IN `in_password` VARCHAR(255))  BEGIN
UPDATE customerDetailsTBL
SET password=sha1(in_password)
WHERE customerID=in_customerID;
END$$

DROP PROCEDURE IF EXISTS `updateProduct`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateProduct` (IN `in_itemID` INT, IN `in_itemName` VARCHAR(50), IN `in_category` VARCHAR(20), IN `in_quantity` TINYINT, IN `in_description` VARCHAR(300), IN `in_price` DECIMAL(13,4), IN `in_imagefilename` VARCHAR(50))  BEGIN
UPDATE productTBL 
SET itemName=in_itemName,
    category=in_category,
    quantity=in_quantity,
    description=in_description,
    price=in_price,
    imagefilename=in_imagefilename
WHERE itemID=in_itemID;
END$$

DROP PROCEDURE IF EXISTS `updateStaffDetails`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateStaffDetails` (IN `in_staffID` INT, IN `in_jobPosition` VARCHAR(35), IN `in_surname` VARCHAR(35), IN `in_firstname` VARCHAR(35), IN `in_addressLine1` VARCHAR(35), IN `in_addressLine2` VARCHAR(35), IN `in_postcode` VARCHAR(8), IN `in_phoneNumber` VARCHAR(35), IN `in_emailAddress` VARCHAR(50))  BEGIN
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
END$$

DROP PROCEDURE IF EXISTS `updateStaffPassword`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateStaffPassword` (IN `in_staffID` INT, IN `in_password` VARCHAR(255))  BEGIN
UPDATE staffDetailsTBL
SET password=sha1(in_password)
WHERE staffID=in_staffID;
END$$

--
-- Functions
--
DROP FUNCTION IF EXISTS `addNewOrder`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `addNewOrder` (`in_customerID` INT, `in_deliveryTimeDate` DATETIME) RETURNS INT(11) BEGIN
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
END$$

DROP FUNCTION IF EXISTS `staffUsernameExists`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `staffUsernameExists` (`in_username` VARCHAR(35)) RETURNS INT(11) BEGIN
DECLARE out_var INT;
SELECT COUNT(*) 
INTO out_var 
FROM staffDetailsTBL 
WHERE username=in_username;
RETURN out_var;
END$$

DROP FUNCTION IF EXISTS `usernameExists`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `usernameExists` (`in_username` VARCHAR(35)) RETURNS INT(11) BEGIN
DECLARE out_var INT;
SELECT COUNT(*) 
INTO out_var 
FROM customerDetailsTBL 
WHERE username=in_username;
RETURN out_var;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `customerdetailstbl`
--

DROP TABLE IF EXISTS `customerdetailstbl`;
CREATE TABLE `customerdetailstbl` (
  `customerID` int(11) NOT NULL,
  `username` varchar(35) COLLATE latin1_bin DEFAULT NULL,
  `password` varchar(255) COLLATE latin1_bin NOT NULL,
  `surname` varchar(35) COLLATE latin1_bin NOT NULL,
  `firstname` varchar(35) COLLATE latin1_bin NOT NULL,
  `addressLine1` varchar(35) COLLATE latin1_bin DEFAULT NULL,
  `addressLine2` varchar(35) COLLATE latin1_bin DEFAULT NULL,
  `postcode` varchar(8) COLLATE latin1_bin DEFAULT NULL,
  `phoneNumber` varchar(35) COLLATE latin1_bin DEFAULT NULL,
  `emailAddress` varchar(50) COLLATE latin1_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dumping data for table `customerdetailstbl`
--

INSERT INTO `customerdetailstbl` (`customerID`, `username`, `password`, `surname`, `firstname`, `addressLine1`, `addressLine2`, `postcode`, `phoneNumber`, `emailAddress`) VALUES
(1, 'scotty', 'cbfdac6008f9cab4083784cbd1874f76618d2a97', 'Scott', 'Randolph', '13 Pleasant Street', 'Liverpool', 'L19 0NE', '0151345987', 'randyscott@gmail.com'),
(2, 'dorothy', '08468e03d92a6b165cf3664df40b54e6d898df6f', 'Garland', 'Judy', '22 Harlington Cresent', 'Liverpool', 'L24 2ED', '01514448383', 'jgarland@gmail.com'),
(3, 'loliwin', 'b0399d2029f64d445bd131ffaa399a42d2f8e7dc', 'Echowhisky', 'Romeo', '16b Tarwood Terrace', 'Liverpool', 'L1 2LF', '089414567854', 'recho@yahoo.com'),
(4, 'sallywins', 'b7a875fc1ea228b9061041b7cec4bd3c52ab3ce3', 'Biggins', 'Sally', '22 Plikington Place', 'Liverpool', 'L22 4ES', '08982241161', 'sbiggins@gmail.com'),
(5, 'rockford', '3bd12765287bf5eea5dcaffd555ee7a0ab11268d', 'Garner', 'James', '94 Bold Street', 'Liverpool', 'L14 3DD', '01517775656', 'jgarner123@gmail.com'),
(6, 'scottydog', 'bb29a6c01dd5432ccd4d7cdcbefd8b3ecf6d5097', 'Scott', 'Christopher', '6 Alexandra Mews', 'Liverpool', 'L9 0ND', '015109987784', 'chrissyscott@gmail.com'),
(7, 'percyfilth', '66c30e0b60687dba43ca43f39a2760bc0bea4de8', 'Morrisson', 'Percival', '21 Everly Close', 'Liverpool', 'L11 4FQ', '08982215663', 'pmoggyio@gmail.com'),
(8, 'gigigigi', 'cff5cf61a0452b8abde1ace3d895b62593b23e0a', 'Delacourt', 'Gigi', '96 Evergreen Terrace', 'Liverpool', 'L22 6TR', '01515556343', 'gggirlie@gmail.com'),
(9, 'silentstart', 'e373fe543211d666f2575ac7301f092e1639f0d8', 'Lloyd', 'Harold', '124 Mainbridge Street', 'Liverpool', 'L2 4FD', '08942278876', 'ferdielar@gmail.com'),
(10, 'crazyshooter', '3c7dd9cc059292339ee91571ed16440f808d1e71', 'Chapman', 'Mark', '12 Leepworth Hill', 'Liverpool', 'L16 2WW', '01518989777', 'chappio@gmail.com'),
(11, 'paulolol', '543815f568ae2b9b9979d2a589eebc87f326b4b1', 'Henderson', 'Paul', '65 Impressa Grove', 'Liverpool', 'L2 4EE', '08983267769', 'hennyla@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `customerfeedbacktbl`
--

DROP TABLE IF EXISTS `customerfeedbacktbl`;
CREATE TABLE `customerfeedbacktbl` (
  `messageID` int(11) NOT NULL,
  `dateOfMessage` datetime NOT NULL,
  `firstname` varchar(35) COLLATE latin1_bin DEFAULT NULL,
  `surname` varchar(35) COLLATE latin1_bin DEFAULT NULL,
  `emailAddress` varchar(50) COLLATE latin1_bin DEFAULT NULL,
  `message` varchar(500) COLLATE latin1_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Table structure for table `orderitemstbl`
--

DROP TABLE IF EXISTS `orderitemstbl`;
CREATE TABLE `orderitemstbl` (
  `orderItemID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `itemID` int(11) NOT NULL,
  `quantity` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dumping data for table `orderitemstbl`
--

INSERT INTO `orderitemstbl` (`orderItemID`, `orderID`, `itemID`, `quantity`) VALUES
(1, 2, 4, 1),
(2, 2, 5, 6),
(3, 2, 6, 1),
(4, 3, 12, 1),
(5, 3, 5, 6),
(6, 3, 22, 1),
(7, 3, 33, 1),
(8, 4, 54, 1),
(9, 4, 15, 6),
(10, 4, 26, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orderstbl`
--

DROP TABLE IF EXISTS `orderstbl`;
CREATE TABLE `orderstbl` (
  `orderID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `dateOfOrder` date NOT NULL,
  `deliveryTimeDate` datetime NOT NULL,
  `paymentReceived` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dumping data for table `orderstbl`
--

INSERT INTO `orderstbl` (`orderID`, `customerID`, `dateOfOrder`, `deliveryTimeDate`, `paymentReceived`) VALUES
(1, 2, '2018-10-26', '2018-10-27 20:30:00', b'0'),
(2, 3, '2018-10-26', '2018-10-27 10:00:00', b'0'),
(3, 4, '2018-10-26', '2018-10-27 22:30:00', b'0'),
(4, 5, '2018-10-26', '2018-10-27 11:30:00', b'0'),
(5, 6, '2018-10-26', '2018-10-27 09:30:00', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `producttbl`
--

DROP TABLE IF EXISTS `producttbl`;
CREATE TABLE `producttbl` (
  `itemID` int(11) NOT NULL,
  `itemName` varchar(50) COLLATE latin1_bin NOT NULL,
  `category` varchar(20) COLLATE latin1_bin NOT NULL,
  `quantity` tinyint(4) NOT NULL,
  `description` varchar(300) COLLATE latin1_bin DEFAULT NULL,
  `price` decimal(13,4) NOT NULL,
  `imageFileName` varchar(50) COLLATE latin1_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dumping data for table `producttbl`
--

INSERT INTO `producttbl` (`itemID`, `itemName`, `category`, `quantity`, `description`, `price`, `imageFileName`) VALUES
(1, 'Golden Rolls', 'Appetisers', 3, 'Traditional fried eggless roll filled with taro, cabbage, carrot and tofu', '3.9500', 'goldenRolls.jpg'),
(2, 'Non-Fried Spring Rolls', 'Appetisers', 6, 'Fresh rolls filled with lettuce, mint leaves, cilantro, jicama, carrot and seasoned tofu. Served with peanut sauce.', '4.9500', 'nonFriedSpringRolls.jpg'),
(3, 'Drumstick', 'Appetisers', 3, 'Battered soy &quot;chicken&quot; served with plum sauce.', '4.5000', 'drumstick.jpg'),
(4, 'Wonton Delight', 'Appetisers', 5, 'Fried wonton stuffed with organic tofu and soy &quot;ham&quot;.', '3.9500', 'wontonDelight.jpg'),
(5, 'Mushu-Mushu', 'Appetisers', 3, 'Raw cabbage, carrot, beansprout, avocado wrap with paratha.', '4.9500', 'mushuMushu.jpg'),
(6, 'Pot Stickers', 'Appetisers', 4, 'Dumplings filled with tofu, soy &quot;ham&quot;, cabbage, jicama, and ginger.', '5.5000', 'potStickers.jpg'),
(7, 'Seaweed Salad', 'Salads', 1, 'Seaweed, tofu, beansprouts, carrot, and sesame seeds.', '5.2500', 'seaweedSalad.jpg'),
(8, 'Rainbow Salad', 'Salads', 1, 'Organic lettuce, cucumber, tomato, red bell pepper, green bell pepper, celery, carrot, mint leaves, cilantro, and sesame seeds.', '5.2500', 'rainbowSalad.jpg'),
(9, 'Kelp Noodle Salad', 'Salads', 1, 'Kelp noodle, cucumber, red bell pepper, green bell pepper, celery, carrot, mint leaves, cilantro, and sesame seeds.', '5.2500', 'kelpNoodleSalad.jpg'),
(10, 'Kale Salad', 'Salads', 1, 'Organic raw kale, organic baby spinach, red cabbage, carrot, tomato, cucumber, sunflower seeds, avacado, and caramelised &quot;soy protein&quot;. Served with vinaigrette sauce.', '8.5000', 'kaleSalad.jpg'),
(11, 'Tropical Papaya Salad', 'Salads', 1, 'Fresh green papaya, soy &quot;jerky&quot;, organic carrot, fresh basil in spicy vinaigrette sauce.', '6.5000', 'tropicalPapayaSalad.jpg'),
(12, 'Quinoa Salad', 'Salads', 1, 'Soy protein with lettuce, organic quinoa, corn, avocado, and sunflower seeds in raw almond sauce.', '6.5000', 'quinoaSalad.jpg'),
(13, 'Vegetable Combo Soup', 'Soups', 1, 'Fresh spinach, broccoli, cauliflower, bokchoy, carrot, organic tofu, mushroom, soy protein in delicious vegetable broth.', '5.5000', 'vegetableComboSoup.jpg'),
(14, 'Wonton Soup', 'Soups', 1, 'Stuffed wonton and fresh broccoli, bokchoy and carrot in a vegetable broth.', '5.9500', 'wontonSoup.jpg'),
(15, 'Spinach Tofu Soup', 'Soups', 1, 'Fresh spinach, soft tofu, mushroom, organic carrot and onion.', '5.9500', 'spinachTofuSoup.jpg'),
(16, 'Pho', 'Noodles', 1, 'A popular Vietnamese rice noodle soup with organic tofu and soy protein. Served with beansprouts and fresh basil.', '5.9500', 'pho.jpg'),
(17, 'Spicy Noodle Soup', 'Noodles', 1, 'Spicy vegetable broth with lemongrass flavour, thick rice noodles, organic tofu, and soy protein. Served with beansprouts and basil leaves.', '5.9500', 'spicyNoodleSoup.jpg'),
(18, 'Vegetable Rice Noodle Soup', 'Noodles', 1, 'Rice noodles, broccoli, bokchoy, carrot, organic tofu and soy protein in a vegetable broth.', '5.9500', 'vegetableRiceNoodleSoup.jpg'),
(19, 'Wonton Noodle Soup', 'Noodles', 1, 'Fried wonton, rice noodles, broccoli, bokchoy, carrot, organic tofu, and soy protein in a vegetable broth.', '6.9500', 'wontonNoodleSoup.jpg'),
(20, 'Curry Vermicelli Soup', 'Noodles', 1, 'Vermicelli, potato, organic tofu, and soy &quot;chicken&quot; in a rich coconut curry soup.', '5.9500', 'curryVermicelliSoup.jpg'),
(21, 'Stir Fried Vegetable Chow Mein', 'Noodles', 1, 'Wheat noodles with mixed vegetables, organic tofu, soy protein and mushroom stir-fried in garlic sauce.', '5.9500', 'stirFryVegetableChowMein.jpg'),
(22, 'Pan Fried Vegetable Chowfun', 'Noodles', 1, 'Flat rice noodles with mixed vegetables, organic tofu, soy protein and mushroom pan-fried in garlic sauce.', '6.9500', 'panFryVegetableChowfun.jpg'),
(23, 'Crispy Chow Mein', 'Noodles', 1, 'Crispy wheat noodles with mixed vegetables, organic tofu, soy protein and mushroom pan-fried in garlic sauce.', '6.9500', 'crispyChowMein.jpg'),
(24, 'Yum Yum Vermicelli', 'Noodles', 1, 'Vermicelli, raw lettuce, beansprouts, cucumber, mint, cilantro, soy protein, shredded tofu, fried eggless rolls, and peanuts.', '5.9500', 'yumYumVermicelli.jpg'),
(25, 'Spicy Fried Rice', 'RicePlates', 1, 'Fried rice with tofu, snow peas, carrot, basil and yum yum spices.', '6.2500', 'spicyFriedRice.jpg'),
(26, 'Five-Spice Tofu over Rice', 'RicePlates', 1, 'Seasoned assorted tofu and soy protein served over rice with a side salad.', '5.9500', 'fiveSpiceTofu.jpg'),
(27, 'Royal Fried Rice', 'RicePlates', 1, 'Fresh brown rice with tofu, snow peas, seaweed, and sunflower seeds.', '6.5000', 'royalFriedRice.jpg'),
(28, 'Gourmet Fried Rice', 'RicePlates', 1, 'Fresh white rice with tofu, snow peas and carrot in curry flavour.', '6.2500', 'gourmetFriedRice.jpg'),
(29, 'Vegetable Deluxe', 'Entrees', 1, 'Combination of fresh vegetables stir-fried with organic tofu, soy protein, and mushroom in a garlic sauce.', '5.9500', 'vegetableDeluxe.jpg'),
(30, 'Sweet Orange', 'Entrees', 1, 'Batter-fried soy protein cooked in a sweet and sour orange sauce.', '5.9500', 'sweetOrange.jpg'),
(31, 'Sweet and Sour Savoury', 'Entrees', 1, 'Batter-fried soy protein with pineapple and bell peppers in a sweet and sour sauce.', '5.9500', 'sweetAndSourSavoury.jpg'),
(32, 'Spicy Mongolian Delight', 'Entrees', 1, 'Onion, bell peppers and soy protein in a Mongolian sauce.', '5.9500', 'spicyMongolianDelight.jpg'),
(33, 'Curried Vegetables', 'Entrees', 1, 'Mixed fresh vegetables stir-fried in a coconut curry sauce.', '5.9500', 'curriedVegetables.jpg'),
(34, 'Lemongrass Tofu', 'Entrees', 1, 'Fried organic tofu in a lemongrass sauce.', '5.9500', 'lemongrassTofu.jpg'),
(35, 'Ginger Kale', 'Entrees', 1, 'Stir-fried kale with ginger and garlic.', '5.9500', 'gingerKale.jpg'),
(36, 'Spicy Potato Curry', 'Entrees', 1, 'Soy &quot;chicken&quot; with organic tofu, potato and onion in a coconut curry sauce.', '6.5000', 'spicyPotatoCurry.jpg'),
(37, 'Sesame Aubergine Tofu', 'Entrees', 1, 'Aubergine and organic tofu in a special house sauce.', '5.9500', 'sesameAubergineTofu.jpg'),
(38, 'Stir Fried Broccoli', 'Entrees', 1, 'Broccoli, soy &quot;beef&quot;, onion and carrot stir-fried with garlic sauce.', '5.9500', 'stirFriedBroccoli.jpg'),
(39, 'Spicy Szechuan', 'Entrees', 1, 'Soy &quot;beef&quot;, onion, bell peppers and pineapple cooked in a spicy Szechuan sauce.', '5.9500', 'spicySzechuan.jpg'),
(40, 'Spicy Green Bean Tofu', 'Entrees', 1, 'Green bean, carrot and organic tofu cooked in a spicy sauce.', '5.9500', 'spicyGreenBeanTofu.jpg'),
(41, 'Saute&#769; Basil Mushroom', 'Entrees', 1, 'Mushroom saute&#769;ed with the chef&apos;s special basil sauce.', '5.9500', 'sauteBasilMushroom.jpg'),
(42, 'House Rice Claypot', 'Specialities', 1, 'Tofu, shitake mushroom, bean thread, onion and ginger cooked with a fragrant rice.', '6.9500', 'houseRiceClaypot.jpg'),
(43, 'The Chef&apos;s Tasty Treats', 'Specialities', 1, 'Soy &quot;beef&quot; saute&#769;ed in the chef&apos;s special BBQ and garlic seasoning, embedded on lettuce and tomato.', '8.5000', 'chefsTastyTreats.jpg'),
(44, 'Soy Protein Perfection', 'Specialities', 1, 'Batter-fried soy &quot;chicken nuggets&quot; served in a spicy onion and ginger sauce.', '8.5000', 'soyProteinPerfection.jpg'),
(45, 'Happy Tamarind', 'Specialities', 1, 'Slices of soy &quot;beef&quot; cooked in a sweet tamarind sauce. Served with vegan chips.', '8.5000', 'happyTamarind.jpg'),
(46, 'Soy Chicken Queen', 'Specialities', 1, 'Soy &quot;chicken&quot; caramelised with a sweet chili sauce.', '8.5000', 'soyChickenQueen.jpg'),
(47, 'Ocean of Love', 'Specialities', 7, 'Seaweed &quot;fish&quot; spring rolls with rice paper, lettuce, mint and cilantro. Served with a spicy sauce.', '8.5000', 'oceanOfLove.jpg'),
(48, 'Lettuce Wraps', 'Specialities', 1, 'Saute&#769;ed tofu, soy &quot;ham&quot;, courgette, fried noodles and peanuts. Served with cool lettuce.', '8.5000', 'lettuceWraps.jpg'),
(49, 'Spicy Chacha', 'Specialities', 1, 'Soy &quot;shrimp&quot; saute&#769;ed with onion and garlic.', '8.5000', 'spicyChacha.jpg'),
(50, 'Saute&#769;ed Jalapeno Tofu', 'Specialities', 1, 'Crispy fried tofu saute&#769;ed with onion and garlic.', '9.9500', 'sauteedJalapenoTofu.jpg'),
(51, 'Pineapple Seaweed Soy Fish', 'Specialities', 1, 'Vegan &quot;fish&quot; cake in spicy pineapple sauce. Served with steamed broccoli.', '8.9500', 'pineappleSeaweedSoyfish.jpg'),
(52, 'Teriyaki Soy Chicken', 'Specialities', 1, 'Vegan &quot;fish&quot; cake in teriyaki sauce. Served with fresh spinach, tomato and cucumber.', '8.9500', 'teriyakiSoyChicken.jpg'),
(53, 'Gourmet Lemongrass Soy Chicken', 'Specialities', 1, 'Vegan &quot;chicken&quot; cooked with lemongrass spices. Served with fresh tomato, courgette and carrot.', '8.9500', 'gourmetLemongrassSoyChicken.jpg'),
(54, 'Spicy Curry Soy Chicken', 'Specialities', 1, 'Vegan &quot;chicken&quot; cooked with curry sauce. Served with courgette, carrot and steamed broccoli.', '8.9500', 'spicyCurrySoyChicken.jpg'),
(55, 'Mama&apos;s Claypot', 'Claypots', 1, 'Slices of soy &quot;fish&quot; cooked in a special house sauce.', '5.9500', 'mamasClaypot.jpg'),
(56, 'Aubergine Curry', 'Claypots', 1, 'Organic tofu, aubergine, onion and bell peppers in a coconut curry sauce.', '5.9500', 'aubergineCurry.jpg'),
(57, 'Tofu Sensation', 'Claypots', 1, 'Fried organic tofu and courgette in a special house sauce.', '5.9500', 'tofuSensation.jpg'),
(58, 'Asian Stew', 'Claypots', 1, 'Soy protein, tofu, sweet potatoes, carrot and daikon in a spicy Asian sauce.', '5.9500', 'asianStew.jpg'),
(59, 'White Rice', 'SideOrders', 1, 'A bowl of white rice.', '1.0000', 'whiteRice.jpg'),
(60, 'Organic Brown Rice', 'SideOrders', 1, 'A bowl of organic brown rice.', '1.0000', 'organicBrownRice.jpg'),
(61, 'Noodles', 'SideOrders', 1, 'A bowl of wheat noodles.', '1.0000', 'noodles.jpg'),
(62, 'Steamed Vegetables', 'SideOrders', 1, 'A bowl of mixed steamed vegetables.', '2.9500', 'steamedVegetables.jpg'),
(63, 'Steamed Broccolli', 'SideOrders', 1, 'A bowl of steamed broccoli.', '1.9500', 'steamedBroccoli.jpg'),
(64, 'Almond Pumpkin Cheese Cake', 'Desserts', 1, 'Almond and pumpkin puree on a walnut and date base. Served with coconut whipped cream.', '2.9500', 'almondPumpkinCheesecake.jpg'),
(65, 'Mocha Cake', 'Desserts', 1, 'A delicious three-tiered vegan chocolate mocha cake.', '2.2500', 'mochaCake.jpg'),
(66, 'Blueberry Cheese Cake', 'Desserts', 1, 'A lush blueberry and almond puree on a walnut and date base. Served with coconut whipped cream.', '2.9500', 'blueberryCheesecake.jpg'),
(67, 'Banana Coconut Ice Cream Cake', 'Desserts', 1, 'The chef&apos;s speciality banana and coconut vegan ice cream cake.', '2.2500', 'bananaCoconutIceCreamCake.jpg'),
(68, 'Caramel Flan', 'Desserts', 1, 'A lush vegan caramel flan made with soy milk and silken tofu.', '2.5000', 'caramelFlan.jpg'),
(69, 'Carrot Cupcake', 'Desserts', 1, 'Tasty carrot cupcake with a vegan cashew cream cheese frosting.', '2.2500', 'carrotCupcake.jpg'),
(70, 'Fried Banana with Vegan Ice Cream', 'Desserts', 1, 'Fried bananas served with freshly made vegan ice cream.', '3.9500', 'friedBananaWithVeganIceCream.jpg'),
(71, 'Vegan Ice Cream', 'Desserts', 1, 'A bowl of fresh homemade vegan ice cream.', '2.9500', 'veganIceCream.jpg'),
(72, 'Organic Vietnamese Iced Coffee', 'Beverages', 1, 'A cup of iced Vietnamese coffee mixed with a blend of spices and coconut milk.', '2.0000', 'organicVietnameseIceCoffee.jpg'),
(73, 'Organic Coffee (French Filter)', 'Beverages', 1, 'A cup of freshly-ground French filter coffee.', '2.0000', 'organicCoffeeFrenchFilter.jpg'),
(74, 'Thai Iced Tea', 'Beverages', 1, 'A cup of iced Ceylon tea mixed with coconut milk and cane sugar.', '2.0000', 'thaiIcedTea.jpg'),
(75, 'Fresh Lemonade', 'Beverages', 1, 'Fresh homemade lemonade.', '2.0000', 'freshLemonade.jpg'),
(76, 'Raw Kale and Strawberry Smoothie', 'Beverages', 1, 'A smoothie made from raw kale, strawberries and coconut milk.', '3.0000', 'rawKaleAndStrawberrySmoothie.jpg'),
(77, 'Freshly Squeezed Orange Juice', 'Beverages', 1, 'Freshly squeezed organic orange juice.', '2.0000', 'freshlySqueezedOrangeJuice.jpg'),
(78, 'Young Coconut Drink', 'Beverages', 1, 'Refreshing drink made from the milk of sweet young coconuts.', '3.0000', 'youngCoconutDrink.jpg'),
(79, 'Green Soymilk Tea', 'Beverages', 1, 'A cup of green tea made with soy milk.', '2.0000', 'greenSoymilkTea.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `staffdetailstbl`
--

DROP TABLE IF EXISTS `staffdetailstbl`;
CREATE TABLE `staffdetailstbl` (
  `staffID` int(11) NOT NULL,
  `accessLevel` tinyint(4) NOT NULL,
  `jobPosition` varchar(35) COLLATE latin1_bin NOT NULL,
  `username` varchar(35) COLLATE latin1_bin DEFAULT NULL,
  `password` varchar(255) COLLATE latin1_bin NOT NULL,
  `surname` varchar(35) COLLATE latin1_bin NOT NULL,
  `firstname` varchar(35) COLLATE latin1_bin NOT NULL,
  `addressLine1` varchar(35) COLLATE latin1_bin DEFAULT NULL,
  `addressLine2` varchar(35) COLLATE latin1_bin DEFAULT NULL,
  `postcode` varchar(8) COLLATE latin1_bin DEFAULT NULL,
  `phoneNumber` varchar(35) COLLATE latin1_bin DEFAULT NULL,
  `emailAddress` varchar(50) COLLATE latin1_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dumping data for table `staffdetailstbl`
--

INSERT INTO `staffdetailstbl` (`staffID`, `accessLevel`, `jobPosition`, `username`, `password`, `surname`, `firstname`, `addressLine1`, `addressLine2`, `postcode`, `phoneNumber`, `emailAddress`) VALUES
(1, 0, 'Senior Programmer', 'scotty', 'cbfdac6008f9cab4083784cbd1874f76618d2a97', 'Scott', 'Randolph', '13 Pleasant Street', 'Liverpool', 'L19 0NE', '0151345987', 'randyscott@gmail.com'),
(2, 0, 'Counter staff', 'dorothy', '08468e03d92a6b165cf3664df40b54e6d898df6f', 'Garland', 'Judy', '22 Harlington Cresent', 'Liverpool', 'L24 2ED', '01514448383', 'jgarland@gmail.com'),
(3, 0, 'Delivery Manager', 'sallywins', 'b7a875fc1ea228b9061041b7cec4bd3c52ab3ce3', 'Biggins', 'Sally', '22 Plikington Place', 'Liverpool', 'L22 4ES', '08982241161', 'sbiggins@gmail.com'),
(4, 0, 'Database Admin', 'rockford', '3bd12765287bf5eea5dcaffd555ee7a0ab11268d', 'Garner', 'James', '94 Bold Street', 'Liverpool', 'L14 3DD', '01517775656', 'jgarner123@gmail.com'),
(5, 0, 'Delivery Staff', 'scottydog', 'bb29a6c01dd5432ccd4d7cdcbefd8b3ecf6d5097', 'Scott', 'Christopher', '6 Alexandra Mews', 'Liverpool', 'L9 0ND', '015109987784', 'chrissyscott@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customerdetailstbl`
--
ALTER TABLE `customerdetailstbl`
  ADD PRIMARY KEY (`customerID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `customerfeedbacktbl`
--
ALTER TABLE `customerfeedbacktbl`
  ADD PRIMARY KEY (`messageID`);

--
-- Indexes for table `orderitemstbl`
--
ALTER TABLE `orderitemstbl`
  ADD PRIMARY KEY (`orderItemID`),
  ADD KEY `fk_item_id` (`itemID`);

--
-- Indexes for table `orderstbl`
--
ALTER TABLE `orderstbl`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `fk_customer_id` (`customerID`);

--
-- Indexes for table `producttbl`
--
ALTER TABLE `producttbl`
  ADD PRIMARY KEY (`itemID`);

--
-- Indexes for table `staffdetailstbl`
--
ALTER TABLE `staffdetailstbl`
  ADD PRIMARY KEY (`staffID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customerdetailstbl`
--
ALTER TABLE `customerdetailstbl`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customerfeedbacktbl`
--
ALTER TABLE `customerfeedbacktbl`
  MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderitemstbl`
--
ALTER TABLE `orderitemstbl`
  MODIFY `orderItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orderstbl`
--
ALTER TABLE `orderstbl`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `producttbl`
--
ALTER TABLE `producttbl`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `staffdetailstbl`
--
ALTER TABLE `staffdetailstbl`
  MODIFY `staffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderitemstbl`
--
ALTER TABLE `orderitemstbl`
  ADD CONSTRAINT `fk_item_id` FOREIGN KEY (`itemID`) REFERENCES `producttbl` (`itemID`) ON DELETE CASCADE;

--
-- Constraints for table `orderstbl`
--
ALTER TABLE `orderstbl`
  ADD CONSTRAINT `fk_customer_id` FOREIGN KEY (`customerID`) REFERENCES `customerdetailstbl` (`customerID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
