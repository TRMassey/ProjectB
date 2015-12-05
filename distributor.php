<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device=width, initial-scale=1">
		<link rel="icon" href="../../favicon.ico">
		<title>Become a Distribution Location</title>
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/custom.css" rel="stylesheet">
		<link rel="stylesheet" href="//maxcdn.boostrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link href='https://fonts.googleapis.com/css?family=Fira+Sans:400,700' rel='stylesheet' type='text/css'>
	</head>
	<body>
	<?php include("storeNav.php"); ?>
	
	<div class="row col-wrap">
		<!-- left side of screen -->
		<div class="col-md-4 col-xs-4 col">
			<div class="inside inside-full-height ofMargin">
  			  <div class="content">
  			  	<img src="img/holder.png">
  			  </div>
 			</div>
		</div>

		<!-- right side of screen -->
		<div class="col-md-8 col-xs-8 col">
			<div class="inside inside-full-height ofMargin">
				  <div class="content ofMargin">
				  	<div class="mainText">			
					<div class="content-fluid">
						<div class="row">
							<h2>Add Distribution Location</h2>
							</br>						
						</div>
					</div>
					<div class="row" id="addDistributor">
						<form name="distForm" id="distForm" role="form" method="post" action="">
							<div class="form-group">
								<label>Distribution Location Name:&nbsp;</label>
									<input type="text" name="distName" id="distName" class="form-control required text">
							</div>
							<div class="form-group">
								<label>Distributor Email:&nbsp;</label>
									<input type="text" name="distEmail" id="distEmail" class="form-control">
							</div>
							<div class="form-group">
								<label>Address:&nbsp;</label>
									<input type="text" name="distAddress" id="distAddress" class="form-control">
							</div>
							<div class="form-group">
								<label>City:&nbsp;</label>
									<input type="text" name="distCity" id="distCity" class="form-control">
							</div>
							<div class="form-group">
									<label>State:&nbsp;</label>
										<select class="form-control" name="distState" id="distState">
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
							
							</div>
							<div class="form-group">
								<label>Zip code:&nbsp;</label>
									<input type="text" name="distPostcode" id="distPostcode" class="form-control">
							</div>
							<div class="form-group">
								<label>Phone:&nbsp;</label>
									<input type="text" name="distPhone" id="distPhone" class="form-control">
							</div>
							<div class="form-group">
								<label>Drop Hours:&nbsp;</label>
									<input type="text" name="distDrophours" id="distDrophours" class="form-control">
							</div>
							<div class="form-group">
								<label>Pickup Hours:&nbsp;</label>
									<input type="text" name="distPickuphours" id="distPickuphours" class="form-control">
							</div>
							<div class="row dcentered">
								<input type="submit" class="buttonOther dcentered" name="frmSubmit" id="frmSubmit" value="Submit"/></input>			
							</div>
							
						</form>
					</div>
					<div class="row" id="addSuccess">
						<h3 class="valid">Distribution location successfully added!</h3>
					</div>
					<div class="row" id="addError">
					<!-- error message from php that handles submit will be inserted here if needed -->
					</div>

					
				</div>
			  </div>
			</div>
		</div>

	</div> <!-- end row -->

	<!-- Bootstraps javascript -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/additional-methods.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/distributorForm.js"></script>
	<script src="ie10-viewport-bug-workaround.js"></script>

	</body>
</html>