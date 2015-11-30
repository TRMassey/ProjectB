  <?php
    // MUST REPLACE WITH dbinfo.php file.
  	include "dbinfo.php";

  // must have my info.php file to get password. Contact me if you don't have it. I emailed it.
  $mysqli = new mysqli("oniddb.cws.oregonstate.edu", $username, $password, $dbname);
  	if($mysqli->connect_errno){
    	echo "ERROR : Connection failed: (".$mysqli->connect_errno.")".$mysqli->connect_error;
  }
  ?> 

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"> 
  <title>QUnit Trash Hunger in America Ïteration 1 Unit Tests</title>
  <link rel="stylesheet" href="//code.jquery.com/qunit/qunit-1.20.0.css">

  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/custom.css" rel="stylesheet">
  <link rel="stylesheet" href="//maxcdn.boostrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link href='https://fonts.googleapis.com/css?family=Fira+Sans:400,700' rel='stylesheet' type='text/css'>
</head>

<body>
	<p>Test One: Testing select, class name pickupState</p>
	<p>Purpose: Validate selection from dropdown is sent via GET</p>
	<p>Manual Test: Select Alabama</p>
	<p>Expect: Alabama </p>
	<form action ='41test.php' method ='GET'>
							<div class="form-group">
								<label>State:</label>
								<!-- http://www.freeformatter.com/usa-state-list-html-select.html -->
									<select class="form-control" name = "pickupState" id="frmState">
										<option value="">Please Choose State</option>
										<option value="AL">Alabama</option>
										<option value="AK">Alaska</option>
										<option value="AZ">Arizona</option>
										<option value="AR">Arkansas</option>
										<option value="CA">California</option>
										<option value="CO">Colorado</option>
										<option value="CT">Connecticut</option>
										<option value="DE">Delaware</option>
										<option value="DC">District Of Columbia</option>
										<option value="FL">Florida</option>
										<option value="GA">Georgia</option>
										<option value="HI">Hawaii</option>
										<option value="ID">Idaho</option>
										<option value="IL">Illinois</option>
										<option value="IN">Indiana</option>
										<option value="IA">Iowa</option>
										<option value="KS">Kansas</option>
										<option value="KY">Kentucky</option>
										<option value="LA">Louisiana</option>
										<option value="ME">Maine</option>
										<option value="MD">Maryland</option>
										<option value="MA">Massachusetts</option>
										<option value="MI">Michigan</option>
										<option value="MN">Minnesota</option>
										<option value="MS">Mississippi</option>
										<option value="MO">Missouri</option>
										<option value="MT">Montana</option>
										<option value="NE">Nebraska</option>
										<option value="NV">Nevada</option>
										<option value="NH">New Hampshire</option>
										<option value="NJ">New Jersey</option>
										<option value="NM">New Mexico</option>
										<option value="NY">New York</option>
										<option value="NC">North Carolina</option>
										<option value="ND">North Dakota</option>
										<option value="OH">Ohio</option>
										<option value="OK">Oklahoma</option>
										<option value="OR">Oregon</option>
										<option value="PA">Pennsylvania</option>
										<option value="RI">Rhode Island</option>
										<option value="SC">South Carolina</option>
										<option value="SD">South Dakota</option>
										<option value="TN">Tennessee</option>
										<option value="TX">Texas</option>
										<option value="UT">Utah</option>
										<option value="VT">Vermont</option>
										<option value="VA">Virginia</option>
										<option value="WA">Washington</option>
										<option value="WV">West Virginia</option>
										<option value="WI">Wisconsin</option>
										<option value="WY">Wyoming</option>
									</select>
									<br></br>
									<input type ="submit" align="center" id="submit" name="submit" value="Find Locations">
									</form>
							</div>
							
<?php   
	if(isset($_GET['submit']) && $_GET['submit'] != "" ){
		echo "Actual: ";
		echo $_GET['pickupState'];

		if($_GET['pickupState'] != "AL") {
	    	echo "\n TEST FAILED";
	    }
	    else {
	    	echo "\n TEST PASSED";
	    }
	}
?>
	<br></br>
	<p>Test Two: Testing class name pickupState and $state variable.</p>
	<p>Purpose: Validate that selected name pickupState is saved correctly in variable $state</p>
	<p>Manual Test: Select Alabama</p>
	<p>Expect: Alabama </p>
	    <?php   
			if(isset($_GET['submit']) && $_GET['submit'] != "" ) {
					echo "Actual: ";
					echo $_GET['state'];
					$state = $_GET['pickupState'];
					echo $state;
					if($state != "AL") {
						echo "\n TEST FAILED";
					}
					else {
	    				echo "\n TEST PASSED";
	    			}
				}
		?>

	<br></br>
	<p>Test Three: Testing isset(GET_['submit'])</p>
	<p>Purpose:  Ensure that page does not populate if GET_['submit'] is not set</p>
	<p>Manual Test: <a href="41test.php">Reload page</a> without submiting location.</p>
	<p>Expect: No Result </p>
	    <?php   
			if(isset($_GET['submit'])) {
				echo "\n TEST FAILED";
			}
			if(!isset($_GET['submit'])) {
				echo "\n TEST PASSED";
			}
		?>
	<br></br>
	<p>Test Four: Testing isset(GET_['submit'])</p>
	<p>Purpose:  Ensure that page does populate if GET_['submit'] is set</p>
	<p>Manual Test: Select California and click "Find Location" button.</p>
	<p>Expect: Donation Center: Janes Distribution, Address: 123 My Road, Food Description: Description here</p>
	<p>Food Type: Food Type here, Hours for Pick up: 3-5, Days for Pick up: Mon-Fri</p>
	    <?php   
			if(isset($_GET['submit']) && $_GET['submit'] != "" ){
				$state = $_GET['pickupState'];
				echo "Actual: ";

				echo '<div id="table-div">';
					echo '<table class="table table-striped">';
						echo "<tr>";
							echo "<th>Donation Center</th>";
							echo "<th>Address</th>";
							echo "<th>Food Description</th>";
							echo "<th>Food Type</th>";
							echo "<th>Hours for Pick up</th>";
							echo "<th>Days for Pick up</th>";
						echo "</tr>";

				/* fill in the table from the db */
				$result = mysqli_query($mysqli, 'SELECT * FROM distribution WHERE STATE = "'.$state.'"');
				while($row = mysqli_fetch_array($result)){
					echo '<tr>';
						echo '<td>'.$row['NAME'].'</td>';
						echo '<td>'.$row['ADDRESS'].'</td>';
						echo '<td> Description here </td>';
						echo '<td> Food Type here </td>';
						echo '<td>'.$row['HOURS'].'</td>';
						echo '<td>'.$row['DAYS'].'</td>';
					echo '</tr>';
					break;   
				}
			}
		?>
<?php
	if(isset($_GET['submit']) && $_GET['submit'] != "" ){
			if($row['NAME'] = "Janes Distribution"
			 && $row['ADDRESS'] = "123 My Road"
			 && $row['HOURS'] = "3-5"
			 && $row['DAYS']  = "Mon-Fri") {
				echo "\n TEST PASSED";
		}
	}
?>

<?php
echo '</body>
</html>';
?>
