<!-- navBar fixed to top of page -->
	<nav class="navbar navbar-default navabar-fixed-top">
		<!-- image above the nav bar, fixed-->
		<img src="img/fruits1.png">

		<!-- actual navigation portion-->
		<div class="container-fluid">

			<!-- Make collapse if mobile -->
		<div class="navbar-header">
      		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigationbar">
        		<span class="sr-only">Toggle navigation</span>
        		<span class="icon-bar"></span>
        		<span class="icon-bar"></span>
        		<span class="icon-bar"></span>
      		</button>
    	</div>


			<!-- Right side -->
			<ul class="nav navbar-nav navbar-right">
				<div class="collapse navbar-collapse" id="navigationbar">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="index.php">HOME</a></li>
						<li><a href="receive.php">DISTRIBUTION LOCATIONS</a></li>
						<li><a href="distributor.php">BECOME A DISTRIBUTION LOCATION</a></li>
						<li><a href="donate.php">DONATE FOOD</a></li>
						<li><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">UNIT TESTING - Instructor <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="setup.php">setup databases</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="donateFormUnitTesting.php">donate.php Unit Test</a></li>
							<li><a href="distributorUnitTesting.php">distributor.php Unit Test</a></li>
							<li><a href="41test.php">receive.php Unit Test</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="donationsUnitTest.php">database Unit test</a></li>
						</ul></li>
					</ul>
				</div>
			</ul>

		</div>  <!-- End container -->
	</nav> <!-- End Nav bar -->