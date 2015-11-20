<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device=width, initial-scale=1">
		<link rel="icon" href="../../favicon.ico">

		<title>Donate Food</title>
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
							
							<div class="content-fluid">
								<div class="row">
									<h2>Donation</h2>
									</br>
								</div>
							</div>
							<div class="row" id="errors">
							</div>
							<div class="content-fluid" id="donateMain">
								<div class="row">
									<p>Select your region to search for distribution Centers:</p>
									</br>
								</div>
								<div class="row">
									<form name="donationForm" role="form">
										<div class="form-group">
											<label>State:</label>
											<!-- http://www.freeformatter.com/usa-state-list-html-select.html -->
												<select class="form-control" name="distroState" form="form1" id="frmState" onchange="startAjax(callbackStateFunction)">
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
											<label>City:</label>
												<select class="form-control" name="distroCity" form="form1" id="frmCity">
													<option value=""></option>
												</select> 
										</div>
										<div class="row dcentered">

												<button type="button" class="buttonOther dcentered" id="distSearch" onclick="startAjax(callbackFunction);">SEARCH</button>
											
										</div>
									</form>
									<div "container-fluid">
										<div class="row">
											<table id="distTable" class="table table-striped">
												<thead>
													<th class="col-md-6 col-xs-6">Distributor</th>
													<th class="col-md-3 col-xs-3">Drop Hours</th>
													<th class="col-md-3 col-xs-3">Schedule Pickup</th>
												</thead>
												<tbody id="distTableBody">
													<tr>
														<td></td>	
														<td></td>
														<td></td>
													</tr>														
												</tbody>
											</table>
										</div>
										<div class="row">
											<div id="results" class="col-md-12 col-xs-12">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					  </div>
				</div>
			</div>

		</div> <!-- end row -->

		<!-- Bootstraps javascript -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/donateForms.js"></script>
		<script src="ie10-viewport-bug-workaround.js"></script>
	</body>
</html>