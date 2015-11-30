  <?php
  	include "dbinfo.php";

  // must have my info.php file to get password. Contact me if you don't have it. I emailed it.
  $mysqli = new mysqli("oniddb.cws.oregonstate.edu", $username, $password, $dbname);
  	if($mysqli->connect_errno){
    	echo "ERROR : Connection failed: (".$mysqli->connect_errno.")".$mysqli->connect_error;
  }
  ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device=width, initial-scale=1">
		<link rel="icon" href="../../favicon.ico">

		<title>Food Distribution Centers</title>
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/custom.css" rel="stylesheet">
		<link rel="stylesheet" href="//maxcdn.boostrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link href='https://fonts.googleapis.com/css?family=Fira+Sans:400,700' rel='stylesheet' type='text/css'>
	</head>

	<body>
		<?php include("storeNav.php"); ?>

		<div class="row">

			<!-- left side of screen -->
			<div class="col-md-4 col-xs-4">
				<div class="inside inside-full-height">
      			  <div class="content">
      			  	<img src="img/holder.png">
      			  </div>
     			</div>
			</div>

			<!-- right side of screen -->
			<div class="col-md-8 col-xs-8">
				<div class="inside inside-full-height">
      				  <div class="content">
      				  	<div class="mainText">
      				  		<h2>Food Distribution Locations</h2>
      				  		<form action ='receive.php' method ='GET'>
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
									</br>
									<input class="buttonOther" type ="submit" align="center" id="submit" name="submit" value="Find Locations">
        							</form>
							</div>

							<?php   
								if(isset($_GET['submit']) && $_GET['submit'] != "" ){
    								$state = $_GET['pickupState'];
    
									echo '<div id="table-div">';
										echo '<table class="table table-striped">';
											echo "<tr>";
												echo "<th>Donation Center</th>";
												echo "<th>Address</th>";
												echo "<th>Hours for Pick up</th>";
												echo "<th>Days for Pick up</th>";
												echo "<th>Food Description</th>";
											echo "</tr>";
									/* fill in the table from the db */
									$result = mysqli_query($mysqli, 'SELECT * FROM distribution WHERE STATE = "'.$state.'"');
									while($row = mysqli_fetch_array($result)){
										echo '<tr>';
											echo '<td>'.$row['NAME'].'</td>';
											echo '<td>'.$row['ADDRESS'].'</td>';
											echo '<td>'.$row['HOURS'].'</td>';
											echo '<td>'.$row['DAYS'].'</td>';
											$result2 = mysqli_query($mysqli, 'SELECT DESCRIPTION FROM donations WHERE DISTID = "'.$row['NAME'].'"');
											while($row2 = mysqli_fetch_array($result2)){
												echo '<td>'.$row2['DESCRIPTION'].'</td>';
    										    echo '<tr><td><td><td><td>';
    									    }
        								echo '</tr>';   
									}
								}
								?>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					  </div>
				</div>
			</div>

		</div> <!-- end row -->

		<!-- Bootstraps javascript -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="ie10-viewport-bug-workaround.js"></script>
	</body>
</html>