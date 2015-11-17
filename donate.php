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
      				  		<h2>Donate</h2>
							<br>
      				  		<p>Enter donation information:</p>
							<br>
      				  		<form name="donationForm" role="form">
      				  			<div class="form-group">
	      				  			<label>Donor/Organization Name:</label>
	      				  				<input type="text" class="form-control">
	      				  		</div>
	      				  		<div class="form-group">
	      				  			<label>Amount of Food:</label>
	      				  				<input type="text" class="form-control">
	      				  		</div>
	      				  		<div class="form-group">
	      				  			<label>Food Type:</label>
	      				  				<input type="radio" name="foodType" value="produce">Produce
	      				  				<input type="radio" name="foodType" value="perishables">Perishables
	      				  				<input type="radio" name="foodType" value="shelf-stable">Shelf-Stable
	      				  		</div>
	      				  		<div class="form-group">
	      				  			<label>Distribution Center:</label>
	      				  				<select class="form-control" name="centers" form="form1">
										    <option value="center1">center1</option>
										    <option value="foodDistributor">food distributor</option>
										    <option value="aChurch">a church</option>
										    <option value="communityCenter">community center</option>
										</select> 
								</div>
								<br>
								<p>
									<button type="submit" class="buttonOther" id="centered">DONATE</button>
								</p>
      				  		</form>
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