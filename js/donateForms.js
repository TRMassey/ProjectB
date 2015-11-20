function startAjax(passedFunction) {
	
	$.ajax({url:"distributors.xml",
		success:passedFunction,error:errorFunction,
		dataType: 'text'} 
	);
}

function callbackFunction(data,info) {
	var distro = "";
	var distroaddr = "";
	var distrocity = "";
	var distrostate = "";
	var distropost = "";
	var distrophone = "";
	var distrotime = "";
	var distributor = "";
	var distributors = "";
	var table = $("#distTable tbody");
	var newRow = "";
	table.find("tr").remove();
	
	$(data).find("state:contains('" + $("#frmState").val() +"')").each(function(){
		if($(this).siblings("city").text() == $("#frmCity").val()){
			distro = $(this).siblings("name").text();
			distroID = $(this).siblings("id").text();
			distroemail = $(this).siblings("email").text();
			distroaddr = $(this).siblings("address").text();
			distrocity = $(this).siblings("city").text();
			distrostate = $(this).text();
			distropost = $(this).siblings("postcode").text();
			distrophone = $(this).siblings("phone").text();
			distrotime = $(this).siblings("drophours").text();
			
			distributor = "<p>" + distro + "</p>";
			distributor += "<p>" + distroaddr + "</p>";
			distributor += "<p>" + distrocity + ", " + distrostate + "</p>";
			distributor += "<p>" + distropost + "</p>";
			distributor += "<p>" + distrophone + "</p><p>&nbsp;</p>";
			
			newRow = "<tr><td>" + distributor + "</td><td>" + distrotime + "</td><td><button type=\"button\" class=\"buttonOther dcentered\" onclick=\"startSchedule('" + distroID + "');\">Schedule</button></td></tr>";
			table.append(newRow);
		}
	});
	
	var rowCount = table.find("tr").length;
	if(rowCount < 1)
		$("#results").html("No distributors found");
	else
		$("#results").html(rowCount + " distributors found");
}

function callbackStateFunction(data,info) {

	var test = $(data).find("state");
	var newRow = "";
	
	// http://stackoverflow.com/questions/2232458/how-to-use-jquery-to-select-xml-nodes-with-unique-text-content
	var distrocities = [];
	var table = $("#frmCity");
	table.find("option").remove();
	var frmStateVal = $("#frmState").val();
	var stateData = $(data).find("state:contains('" + frmStateVal +"')");
	
	if(!frmStateVal){
		newRow = "<option value=\"\"></option>";
		table.append(newRow);	
	}
	else if(stateData && stateData.length) {
		stateData.each(function() {
			var text = $(this).siblings("city").text();
			
			if ($.inArray(text, distrocities)===-1){
				distrocities.push(text);
				newRow = "<option value=\"" + text + "\">" + text + "</option>";
				table.append(newRow);
			}	
		});
	} else {
		newRow = "<option value=\"\">No Cities with Distibutors found in that state</option>";
		table.append(newRow);
	}
	
}

function errorFunction(data,info) {
	$("#results").text("error occurred:"+info);
}

function startSchedule(distroID){
	//$("#donateMain").html("<p>Thank You.  Your request has been received</p>");
	//http://stackoverflow.com/questions/24376009/ajax-load-php-file-into-div
	var distro = "";
	var distroaddr = "";
	var distrocity = "";
	var distrostate = "";
	var distropost = "";
	var distrophone = "";
	var distrotime = "";
	var distributor = "";
	var distributors = "";
	//alert(distroID);
	
	$.ajax({
	   url:"donateForm.php",
	   type:'GET',
	   success: function(data){
		   $('#donateMain').html(data);
		   $.ajax({url:"distributors.xml",
				success:function(data){
					returnVal = $(data).find("id:contains('" + distroID +"')");
					//alert(returnVal.siblings("name").text());
					distro = returnVal.siblings("name").text();
					distroID = $(this).siblings("id").text();
					distroemail = returnVal.siblings("email").text();
					distroaddr = returnVal.siblings("address").text();
					distrocity = returnVal.siblings("city").text();
					distrostate = returnVal.siblings("state").text();
					distropost = returnVal.siblings("postcode").text();
					distrophone = returnVal.siblings("phone").text();
					distrotime = returnVal.siblings("drophours").text();
					
					distributor = "<p>" + distro + "</p>";
					distributor += "<p>" + distroaddr + "</p>";
					distributor += "<p>" + distrocity + "," + distrostate + "</p>";
					distributor += "<p>" + distropost + "</p>";
					distributor += "<p>" + distrophone + "</p>";

					$('#subDistributor').html(distributor);
					$('#dEmail').val(distroemail);
					$('#dDistr').val(distro);
					$('#dPhone').val(dPhone);
		
				},
				error:errorFunction,
				dataType: 'text'} 
			);
		   
	   },
	   error:errorFunction
	});
}

function checkform(){
	event.preventDefault();
	
	var frmDistro = $('#distOrg').val();
	var frmContact = $('#distContact').val();
	var frmEmail = $('#distEmail').val();
	var frmPhone = $('#distPhone').val();
	var frmDesc = $('#distDesc').val();

	var errorFlag = false;
	var message = "";
	
	var emailPattern = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/;
	var textPattern = /^[A-Za-z- ']*$/;
	var alphanumPattern = /^[A-Za-z0-9- ']*$/;
	var textDescPattern = /^[A-Za-z0-9- .'(),?]*$/;
	
	$('#donationErrors').removeClass( "alert alert-danger" );
	
	if(frmDistro.length < 4){
		errorFlag = true;
		message += "<p>Donor/Org Name too short</p>";
	}
	if(!alphanumPattern.test(frmDistro)) {
		errorFlag = true;
		message += "<p>Please use only letters, numbers, - or ' in Donor/Org Name</p>";
	}
	if(frmContact.length < 4){
		errorFlag = true;
		message += "<p>Contact Name too short</p>";
	}
	if(!textPattern.test(frmContact)) {
		errorFlag = true;
		message += "<p>Please use only letters, numbers or -' in Contact</p>";
	}
	if(frmEmail.length < 4){
		errorFlag = true;
		message += "<p>Email Name too short</p>";
	}
	if(!emailPattern.test(frmEmail)) {
		errorFlag = true;
		message += "<p>Incorrect form for Email</p>";
	}
	if(frmDesc.length < 4){
		errorFlag = true;
		message += "<p>Description too short.</p>";
	}
	if(!textDescPattern.test(frmDesc)) {
		errorFlag = true;
		message += "<p>Please use only letters, numbers and(.'-,?) in Description</p>";
	}	
	if(errorFlag){
		$('#donationErrors').html(message);
		$('#donationErrors').addClass("alert alert-danger");
	} else {
		$('#donationErrors').html("Form Submitted");
		$('#donationErrors').removeClass( "alert alert-danger" );
		$('#donationErrors').addClass("");
		// http://stackoverflow.com/questions/22363838/submit-form-after-calling-e-preventdefault
		//$('#donationForm').unbind().submit();
	}
}