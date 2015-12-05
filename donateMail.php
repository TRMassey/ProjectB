<?php
    include_once 'donations.php';
    if(isset($_POST['distOrg'])) {
    
		// set email/message variables from POST variables
		$vendorEmail = strip_tags($_POST['dEmail']);
		$vendorName = strip_tags($_POST['dDistr']);
		$vendorPhone = strip_tags($_POST['dPhone']);
		$donorName = strip_tags($_POST['distOrg']);
		$donorEmail = strip_tags($_POST['distEmail']);
		$donorContact = strip_tags($_POST['distContact']);
		$donorPhone = strip_tags($_POST['distPhone']);
		$donorDesc = strip_tags($_POST['distDesc']);
		$donorType = "";
		$donorValue = 0;
		
		
		
		// set donation type
		if(isset($_POST['produce'])){
			$donorType .= "Produce ";
			$donorValue = 1;
		}
		
		if(isset($_POST['perishables'])){
			$donorType .= "Perishables ";
			$donorValue = 2;
		}
		
		if(isset($_POST['shelf-stable'])){
			$donorType .= "Shelf-Stable ";
			$donorValue = 3;
		}
		
		if(isset($_POST['produce']) && isset($_POST['perishables'])){
			$donorValue = 4;
		}
		
		if(isset($_POST['produce']) && isset($_POST['shelf-stable'])){
			$donorValue = 5;
		}
		
		if(isset($_POST['shelf-stable']) && isset($_POST['perishables'])){
			$donorValue = 6;
		}
		
		if(isset($_POST['produce']) && isset($_POST['shelf-stable']) && isset($_POST['perishables'])){
			$donorValue = 6;
		}
		
		// enter data into database
		$dbEntry = new donations();
		$dbEntry->sqlInsert($donorName, $donorContact, $donorEmail, $donorPhone, $donorDesc, $donorValue, $vendorName, 1);
		
		// set email subject
		$subject = "Scheduled Pickup Requested";
		
		// set donation detais    
		$donationDetails = "Donation Details:\n".$donorDesc."\n\n";
		$donationDetails .= "Donation Type:\n".$donorType."\n\n";
		
		// set donor and vendor messages
		$vendorMessage = "\nTo: ".$vendorEmail."\nForm: ".$donorEmail."\n\n";
		$vendorMessage .= $donorContact." from ".$donorName." has requested to schedule a pickup.\n\n";
		$vendorMessage .= "Contact Information:\nDonorEmail: ".$donorEmail."\n";
		$vendorMessage .= "Donor Phone Number: ".$donorPhone."\n\n".$donationDetails;
		
		$donorMessage = "\nTo: ".$donorEmail."\nFrom: ".$vendorEmail."\n\n";
		$donorMessage .= "You have requested to schedule a pickup from ".$vendorName.".\n\n";
		$donorMessage .= "Contact Information:\nDistributor Email: ".$vendorEmail."\n";
		$donorMessage .= "Phone Number: ".$vendorPhone."\n\n".$donationDetails;
		
		//set headers
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		
		$vendorheaders = "From: " . strip_tags($vendorEmail) . "\r\n";
		$vendorheaders = "Reply-To: " . strip_tags($vendorEmail) . "\r\n".$headers;
		
		$donorheaders = "From: " . strip_tags($donorEmail) . "\r\n";
		$donorheaders .= "Reply-To: ". strip_tags($donorEmail) . "\r\n".$headers;
		
		// email donor and vendor
		@mail($vendorEmail, $subject, $vendorMessage, $donorHeaders);
		@mail($donorEmail, $subject, $donorMessage, $vendorHeaders);
		
		unset($_POST['frmSubmit']);
	}
?>