<?php

$dts = new DateTime();
$now = $dts->format("s");

$subject = "New Donation(s) from TrashHunger";
$headers = "From: webmaster@trashhunger.com\r\nReply-To: webmaster@trashhunger.com";

//a new mysqli is set up to connect to my database and error message if this fails
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "herrinas-db", "3JCPnCFTmsZs8ASZ", "herrinas-db");
if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error ".$mysqli->connect_errno . "".$mysqli->connect_error;
}

//a new mysqli is set up to connect to my database and error message if this fails
$mysqli2 = new mysqli("oniddb.cws.oregonstate.edu", "herrinas-db", "3JCPnCFTmsZs8ASZ", "herrinas-db");
if(!$mysqli2 || $mysqli2->connect_errno){
	echo "Connection error ".$mysqli2->connect_errno . "".$mysqli2->connect_error;
}

//the information about the user's army is gathered from the armies database
$donations = "SELECT DESCRIPTION, ISNEW FROM donations";
$clearIt = "UPDATE donations SET ISNEW = 0 WHERE 1";

//information to acquire emails 
$emails = "SELECT email FROM emaillist";

$number = 0;

while(1){
   
   	$current = new DateTime();
   	$curMin = $current->format("s");

   	///ADD LOGIC TO FACILITATE 60 SECOND ROLLOVER
   	if(($curMin >= $now + 5) || ($curMin >= 0 && $curMin <= 5)){   
	        $now = $curMin + 0;
	        echo "$now seconds <br>";
	        /*
	        //the query is run and the results are stuffed in the variable row
	   
		$emailArray = array();
          
		
		if($row = $mysqli->query($emails)){
		//the query results are parsed out as an array that contains the contents of each row 
			while($distinctCatagory = $row->fetch_array(MYSQL_NUM)){
			//only army 1 is relavant to combat (Army 2 used for defense)
				$emailArray[] = $distinctCatagory[0];
			}
		}
	        $mysqli->close();

		foreach($emailArray as $email){
			echo "$email <br>";		
		}
		
		if($row2 = $mysqli2->query($donations)){
		//the query results are parsed out as an array that contains the contents of each row 
			while($distinctCatagory = $row2->fetch_array(MYSQL_NUM)){
			//only army 1 is relavant to combat (Army 2 used for defense)
				if($distinctCatagory[1] == 1){
				   	
					$message = "A new \"$distinctCatagory[0]\" was added for donation";
				   	foreach($emailArray as $email){
				        	$to = $email;
	 					$mail_sent = @mail($to, $subject, $message, $headers);
						echo $mail_sent ? "Mail sent" : "Mail failed";
					}						
				}	
			}
			$mysqli2->query($clearIt);
		}
	        else{
		   echo "YOU HAVE FAILED MISERABLY!!!";
		}	*/
	} 
}
  
echo "I should never make it here.";

?>
