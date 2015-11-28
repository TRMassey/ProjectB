<?php

//a new mysqli is set up to connect to my database and error message if this fails
class server {
	
	public static function emailClients(){
		
		$mysqli = new mysqli($servername, $username, $password, $dbname);
		if(!$mysqli || $mysqli->connect_errno){
			echo "Connection error ".$mysqli->connect_errno . "".$mysqli->connect_error;
		}

		//a new mysqli is set up to connect to my database and error message if this fails
		$mysqli2 = new mysqli($servername, $username, $password, $dbname);
		if(!$mysqli2 || $mysqli2->connect_errno){
			echo "Connection error ".$mysqli2->connect_errno . "".$mysqli2->connect_error;
		}

		//the information about the user's army is gathered from the armies database
		$donations = "SELECT DESCRIPTION, ISNEW FROM donations";
		$clearIt = "UPDATE donations SET ISNEW = 0 WHERE 1";

		//information to acquire emails 
		$emails = "SELECT email FROM emaillist";

		//array to store user email addresses
		$emailArray = array();		      
			
		if($row = $mysqli->query($emails)){
		//the query results are parsed out as an array that contains the contents of each row 
			while($distinctCatagory = $row->fetch_array(MYSQL_NUM)){
			//only army 1 is relavant to combat (Army 2 used for defense)
				$emailArray[] = $distinctCatagory[0];
			}
		}

		//close connection after done
		$mysqli->close();
			
		if($row2 = $mysqli2->query($donations)){
		//the query results are parsed out as an array that contains the contents of each row 
			while($distinctCatagory = $row2->fetch_array(MYSQL_NUM)){
			//only army 1 is relavant to combat (Army 2 used for defense)
				if($distinctCatagory[1] == 1){

				    $subject = "New Donation(s) from TrashHunger";
					$headers = "From: webmaster@trashhunger.com\r\nReply-To: webmaster@trashhunger.com";
					$message = "A new \"$distinctCatagory[0]\" was added for donation";
				   	foreach($emailArray as $email){
				        	$to = $email;
						$mail_sent = @mail($to, $subject, $message, $headers);
					}						
				}	
			}
			//set all ISNEW values back to 0
			$mysqli2->query($clearIt);
		}
		else{
		    echo "YOU HAVE FAILED MISERABLY!!!";
		}	
	}
}

?>
