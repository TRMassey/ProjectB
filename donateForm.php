	<div class="row" id="donateSubmit">
		<form name="donationForm" role="form" id="donationForm">
			<div class="form-group">
				<label>Distrbution Center:</label>
			</div>
			<div class="row" id="subDistributor">
			</div>
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-xs-8 regBack">
						<div id="donationErrors" role="alert">
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label>Donor/Organization Name:</label>
					<input type="text" name="distOrg" id="distOrg" class="form-control required text">
			</div>
			<div class="form-group">
				<label>Contact Name:</label>
					<input type="text" name="distContact" id="distContact" class="form-control">
			</div>
			<div class="form-group">
				<label>Email:</label>
					<input type="text" name="distEmail" id="distEmail" class="form-control">
			</div>
			<div class="form-group">
				<label>Phone:</label>
					<input type="text" name="distPhone" id="distPhone" class="form-control">
			</div>
			<div class="form-group">
				<label>Description of Donation:</label>
					<input type="text" name="distDesc" id="distDesc" class="form-control">
			</div>
			<div class="form-group">
				<label>Food Type:</label>
					<input type="checkbox" name="foodType" value="produce">Produce
					<input type="checkbox" name="foodType" value="perishables">Perishables
					<input type="checkbox" name="foodType" value="shelf-stable">Shelf-Stable
			</div>
			<div class="row dcentered">
					<button type="submit" class="buttonOther dcentered" onclick="checkform();">Submit</button>			
			</div>
			<input type="hidden" id="dEmail" name="dEmail" value="">
			<input type="hidden" id="dDistr" name="dDistr" value="">
			<input type="hidden" id="dPhone" name="dPhone" value="">
		</form>

</div>