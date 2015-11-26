<?php
//this is the table creation query used.
/*
CREATE TABLE donations (
ID INT AUTO_INCREMENT,
DONOR VARCHAR(255) NOT NULL,
CONTACT VARCHAR(255) NOT NULL,
EMAIL VARCHAR(255) NOT NULL,
PHONE VARCHAR(255) NOT NULL,
DESCRIPTION VARCHAR(255) NOT NULL,
FOODTYPE INT NOT NULL,
DISTID VARCHAR(255),
ISNEW TINYINT NOT NULL,
PRIMARY KEY(ID)
)ENGINE=InnoDB


CREATE TABLE distribution (
DID INT AUTO_INCREMENT,
NAME VARCHAR(255) NOT NULL,
STATE VARCHAR(255) NOT NULL,
EMAIL VARCHAR(255) NOT NULL,
ADDRESS VARCHAR(255) NOT NULL,
CITY VARCHAR(255) NOT NULL,
POSTCODE VARCHAR(255) NOT NULL,
PHONE VARCHAR(255) NOT NULL,
HOURS VARCHAR(255) NOT NULL,
DAYS VARCHAR(255) NOT NULL,
PRIMARY KEY(DID)
)ENGINE=InnoDB

Inserting sample data into database.
INSERT INTO distribution (NAME, STATE, EMAIL, ADDRESS, CITY, POSTCODE, PHONE, HOURS, DAYS) 
VALUES ('Janes distribution','AL','ammj@oregonstate.edu','123 My Road','Montgomery','36104',
'818-555-5555','3-5','Mon-Fri');

INSERT INTO distribution (NAME, STATE, EMAIL, ADDRESS, CITY, POSTCODE, PHONE, HOURS, DAYS) 
VALUES ('Pauls distribution','CA','ammj@oregonstate.edu','120 Glendale Blvd', 'Los Angeles', '90210','555-555-5555', '9-5', 'M-F');

INSERT INTO distribution (NAME, STATE, EMAIL, ADDRESS, CITY, POSTCODE, PHONE, HOURS, DAYS) 
VALUES ('Someones Grocers','AL','ammj@oregonstate.edu','120 Anywhere Blvd', 'Mobile', '36602','555-555-5555', '9-5', 'M-Sat');

 */

//this is just a sample file to store ONID db login info if you want to test using your own db
$servername = "oniddb.cws.oregonstate.edu";
$username = "ONIDUSERNAME-db";
$password = "ONIDPASSWORD";
$dbname = "ONIDUSERNAME-db";
?>