<?php
require('donations.php');

//create the new object
$testDonation = new donations();

echo "1. Donation Object Creation: ";

if($testDonation != null){
   echo "Passed.<br>\n";
}
else{
   echo "Failed.<br>\n";
}

//make sure the database is clear 
$testDonation->clearIt();

//add a new entry to the database
$testDonation->sqlInsert("AAA", "AAA", "AAA", "AAA", "AAA", 3, 0);

//test to find entries with ISNEW value 1, should return null
echo "2. Database contains 0 entries ISNEW=1, query for rows ISNEW=1 should return no entries: ";
$returnedRows = $testDonation->rowInfo(1);
if(count($returnedRows) == 0){
   echo "Passed.<br>\n";
}
else{
   echo "Failed.<br>\n";
}

//test to find entries with ISNEW value 0, should return 1 entry
echo "3. Database contains 1 entries ISNEW=1, query for rows ISNEW=1 should return 1 entry: ";
$returnedRows = $testDonation->rowInfo(0);
if(count($returnedRows) == 1){
   echo "Passed.<br>\n";
}
else{
   echo "Failed.<br>\n";
}

//test to make sure that the other fields match correctly 
echo "4. Single row returned from test 3 must have matching parameters to the SQL entry: ";
if($returnedRows[0][1] == 'AAA' && $returnedRows[0][6] == 3 && $returnedRows[0][8] == 0){
   echo "Passed.<br>\n";
}
else{
   echo "Failed.<br>\n";
}

//add a second entry to the database
$testDonation->sqlInsert("BBB", "BBB", "BBB", "BBB", "BBB", 2, 1);

//test to find entries with ISNEW value 1, should return 1 row
echo "5. Database contains 2 entries, 1 has ISNEW=1, query for rows ISNEW=1 should return 0 matching row: ";
$returnedRows = $testDonation->rowInfo(1);
if(count($returnedRows) == 0){
   echo "Passed.<br>";
}
else{
   echo "Failed.<br>";
}

//update BBB to no now have ISNEW=0 test to find any entries with value 1
$testDonation->makeOld();
echo "6. The only row containing ISNEW=1 was changed to ISNEW=0, query for rows where ISNEW=1 should return 0 rows: ";
$returnedRows = $testDonation->rowInfo(1);
if(count($returnedRows) == 0){
   echo "Passed.<br>\n";
}
else{
   echo "Failed.<br>\n";
}


echo "7. Both entries should have ISNEW=0, query should return two rows with matching variables: ";
$returnedRows = $testDonation->rowInfo(0);
if(count($returnedRows) == 2){
   if($returnedRows[0][1] == 'AAA' && $returnedRows[0][6] == 3 && $returnedRows[0][8] == 0 && $returnedRows[1][1] == 'BBB' && $returnedRows[1][6] == 2 && $returnedRows[1][8] == 0){
      echo "Passed<br>";
   }
   else{
      echo "Failed<br>";
   }
}
else{
   echo "Failed<br>";
}

//delete all rows from the table
$testDonation->clearIt();
echo "8. Delete entire table, test to ensure table was deleted, no rows should appear: ";
$returnedRows = $testDonation->rowInfo(0);
if(count($returnedRows) == 0){
   echo "Passed.<br>\n";
}
else{
   echo "Failed.<br>\n";
}

echo "9. Attempt to insert entry with extra field in to database, database should remain empty: ";
$testDonation->sqlInsert("CCC", "CCC", "CCC", "CCC", "CCC", "CCC", "CCC", 2, 0);
if(count($returnedRows) == 0){
   echo "Passed.<br>\n";
}
else{
   echo "Failed.<br>\n";
}


?>
