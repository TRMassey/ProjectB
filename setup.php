<?php
include 'dbinfo.php';

$mysqli = mysqli_connect($servername, $username, $password, $dbname);
$errors = false;

// check the connection
if (mysqli_connect_errno()) {
	
    printf("Setup could not be completed.  Connection to database failed: %s<br />", mysqli_connect_error());
	printf("Please check the information entered into dbinfo.php<br />");
    exit();
	
}

// queries for the donations table creation
$dropdonations = "DROP TABLE IF EXISTS donations";
$createdonations = "
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
)ENGINE=InnoDB";

// queries for the distribution table creation
$dropdistribution = "DROP TABLE IF EXISTS distribution";
$createdistribution = "
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
)ENGINE=InnoDB";

// queries for the emaillist table creation
$dropemail = "DROP TABLE IF EXISTS emaillist";
$createemail = "
CREATE TABLE emaillist (
ID INT AUTO_INCREMENT,
email VARCHAR(255) NOT NULL,
PRIMARY KEY(ID)
)ENGINE=InnoDB";

echo "<h2>SETUP Databases for Trash for Hunger</h2>";

/* Create table doesn't return a resultset */
if (mysqli_query($mysqli, $dropdonations) === TRUE) {
   printf("Table donations dropped if exists.<br />");
} else {
	printf("Error dropping table donations.<br />");
	$errors = true;
}

if (mysqli_query($mysqli, $createdonations) === TRUE) {
    printf("Table donations created.<br />");
} else {
	printf("Error creating table donations.<br />");
	$errors = true;
}

if (mysqli_query($mysqli, $dropdistribution) === TRUE) {
    printf("Table distribution dropped if exists.<br />");
} else {
	printf("Error dropping table distribution.<br />");
	$errors = true;
}

if (mysqli_query($mysqli, $createdistribution) === TRUE) {
    printf("Table distributor created.<br />");
} else {
	printf("Error creating table distribution.<br />");
	$errors = true;
}

if (mysqli_query($mysqli, $dropemail) === TRUE) {
    printf("Table emaillist dropped if exists.<br />");
} else {
	printf("Error dropping table emaillist.<br />");
	$errors = true;
}

if (mysqli_query($mysqli, $createemail) === TRUE) {
    printf("Table emaillist created.<br />");
} else {
	printf("Error creating table emaillist.<br />");
	$errors = true;
}

// first row of sample data for distribution table
$sampledistribution = 
"INSERT INTO distribution (NAME, STATE, EMAIL, ADDRESS, CITY, POSTCODE, PHONE, HOURS, DAYS)  
VALUES ('Janes distribution','AL','ammj@oregonstate.edu','123 My Road','Montgomery','36104','818-555-5555','3-5','Mon-Fri')";

if (mysqli_query($mysqli, $sampledistribution) === TRUE) {
    printf("1. Sample distribution data added.<br />");
} else {
	printf("1. Error adding sample data.<br />");
	$errors = true;
}

// second row of sample data for distribution table
$sampledistribution = 
"INSERT INTO distribution (NAME, STATE, EMAIL, ADDRESS, CITY, POSTCODE, PHONE, HOURS, DAYS) 
VALUES ('Pauls distribution','CA','ammj@oregonstate.edu','120 Glendale Blvd', 'Los Angeles', '90210','555-555-5555', '9-5', 'M-F')";

if (mysqli_query($mysqli, $sampledistribution) === TRUE) {
    printf("2. Sample distribution data added.<br />");
} else {
	printf("1. Error adding sample data.<br />");
	$errors = true;
}

// Third row of sample data for distribution table
$sampledistribution = 
"INSERT INTO distribution (NAME, STATE, EMAIL, ADDRESS, CITY, POSTCODE, PHONE, HOURS, DAYS) 
VALUES ('Someones Grocers','AL','ammj@oregonstate.edu','120 Anywhere Blvd', 'Mobile', '36602','555-555-5555', '9-5', 'M-Sat')";

if (mysqli_query($mysqli, $sampledistribution) === TRUE) {
    printf("3. Sample distribution data added.<br />");
} else {
	printf("1. Error adding sample data.<br />");
	$errors = true;
}

// first row of sample data for donation table
$sampledonation = "INSERT INTO donations (DONOR, CONTACT, EMAIL, PHONE, DESCRIPTION, FOODTYPE, DISTID, ISNEW)
VALUES('Donating Grocery', '123 road drive', 'grocery@groceries.com', '360-123-4567', 'Three boxes fresh produce', 3, 'Janes distribution', 0)";

if (mysqli_query($mysqli, $sampledonation) === TRUE) {
    printf("1. Sample donation data added.<br />");
} else {
	printf("1. Error adding sample data.<br />");
	$errors = true;
}

$sampledonation = "INSERT INTO donations (DONOR, CONTACT, EMAIL, PHONE, DESCRIPTION, FOODTYPE, DISTID, ISNEW)
VALUES('Donations R US', '456 road drive', 'grocery@groceries.com', '360-123-4567', 'Canned Goods', 1, 'Janes distribution', 0);";

if (mysqli_query($mysqli, $sampledonation) === TRUE) {
    printf("2. Sample donation data added.<br />");
} else {
	printf("1. Error adding sample data.<br />");
	$errors = true;
}

$sampledonation = "INSERT INTO donations (DONOR, CONTACT, EMAIL, PHONE, DESCRIPTION, FOODTYPE, DISTID, ISNEW)
VALUES('Helping Humanity', '123 road drive', 'grocery@groceries.com', '360-123-4567', 'Canned Goods', 3, 'Pauls distribution', 0)";;

if (mysqli_query($mysqli, $sampledonation) === TRUE) {
    printf("3. Sample donation data added.<br />");
} else {
	printf("1. Error adding sample data.<br />");
	$errors = true;
}

// first row of sample email data for emaillist
$sampleemail = "INSERT INTO emaillist (email) VALUES ('ammj@oregonstate.edu')";

if (mysqli_query($mysqli, $sampleemail) === TRUE) {
    printf("1. Sample email data added.<br />");
} else {
	printf("1. Error adding sample data.<br />");
	$errors = true;
}

// first row of sample data for emaillist
$sampleemail = "INSERT INTO emaillist (email) VALUES ('jamm8888@gmail.com')";

if (mysqli_query($mysqli, $sampleemail) === TRUE) {
    printf("2. Sample email data added.<br />");
} else {
	printf("1. Error adding sample data.<br />");
	$errors = true;
}

if($errors){
	echo "<h2>SETUP HAD ERRORS</h2>";
	echo "<p><a href='index.php'>Return to site</a></p>";

} else {
	echo "<h2>SETUP COMPLETE</h2>";
	echo "<p><a href='index.php'>Return to site</a></p>";
}

mysqli_close($mysqli);
?>
