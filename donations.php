<?php
include("dbinfo.php");
class donations {

   
   //call with only first 6 parameters, isNew is defaulted to true
   public function sqlInsert($donor, $contact, $email, $phone, $description, $foodType, $isNew = 1){

                $connection = new mysqli($servername, $username, $password, $dbname);      
   		if($connection === null){
   			echo "Error connecting to database";
   		}

   		$theInsert = $connection->prepare("INSERT INTO donations SET DONOR=?, CONTACT=?, EMAIL=?, PHONE=?, DESCRIPTION=?, FOODTYPE=?, ISNEW=?");
   		$theInsert->bind_param("sssssii", $donor, $contact, $email, $phone, $description, $foodType, $isNew);
   		$theInsert->execute();
   }

   public function makeOld(){
                
                $connection = new mysqli($servername, $username, $password, $dbname);      
   		if($connection === null){
   			echo "Error connecting to database";
   		}

   		$theUpdate = "UPDATE donations SET ISNEW=0 WHERE 1 > 0";
   		$connection->query($theUpdate);
   }

   public function rowInfo($newOrOld){
   
                $connection = new mysqli($servername, $username, $password, $dbname);      
   		if($connection === null){
   			echo "Error connecting to database";
   		}

   		$theUpdate = "SELECT * FROM donations WHERE ISNEW=$newOrOld";
		
		
	        $allRows = array();

	        if($row = $connection->query($theUpdate)){
		   while($distinctRow = $row->fetch_array(MYSQL_NUM)){
                      $allRows[] = $distinctRow;  
		   }
		}

		return $allRows;   	
   }

   public function clearIt(){
                
                $connection = new mysqli($servername, $username, $password, $dbname);      
   		if($connection === null){
   			echo "Error connecting to database";
   		}

   		$theUpdate = "DELETE FROM donations WHERE 1";
   		$connection->query($theUpdate);
   }
}
 
?>
