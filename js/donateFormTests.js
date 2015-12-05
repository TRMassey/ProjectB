/**
* Function on document ready to attach validation
* Pre-conditions:  Document Ready
* Post-condition validation on form
*/

$( document ).ready(function() {

	// http://stackoverflow.com/questions/9538834/clear-form-fields-onload-and-onunload-on-back-button
	var i;
	for (i = 0; (i < document.forms.length); i++) {
		document.forms[i].reset();
	}

    /* added hide donateMain */
    $("#donateMain").show();
    $("#donateSubmit").hide(); // hide donate submission form until donation center has been selected
    $("#donateSuccess").hide();
    $("#donateError").hide();
    
    /**
    * adds method to validator to check if at least one box checked
    **/
    $.validator.addMethod("food_type", function(value) {
            
        if(document.getElementById("frmProduce").checked || document.getElementById("frmPerishables").checked || document.getElementById("frmShelfStable").checked){
            return true;
        }
        
        return false;

    },"At least one type must be checked");
    
    /* changed to request Form to not clash with other form */
    $("#requestForm").validate({
        rules: {
            distOrg: {
                required: true,
                minlength: 4,
                pattern: /^[A-Za-z0-9- ']*$/
            },
            distContact: {
                required: true,
                minlength: 4,
                pattern: /^[A-Za-z- ']*$/
            },
            distEmail: {
                required: true,
                email: true
            },
            /* added phone pattern */
            distPhone: {
                required: true,
                pattern: /^((\(\d{3}\))|(\d{3}))(\s)?\d{3}(-)?\d{4}$/
            },
            distDesc: {
                required: true,
                minlength: 4,
                pattern: /^[A-Za-z0-9- .'(),?]*$/
            },
            /* added check for produce */
            produce: {
                food_type: true,
            }
        },
        
        // Specify the validation error messages
        messages: {
            distOrg: {
                required: "Donor/Org Name required",
                minlength: "Donor/Org Name too short",
                pattern: "Please use only letters, numbers, - or ' in Donor/Org Name"
            },
            distContact: {
                required: "Please provide a contact name",
                minlength: "Contact Name too short",
                pattern: "Please use only letters, numbers or -' in Contact"
            },
            distEmail: {
                required: "Please provide an email address",
                email: "Please enter a valid email address"
            },
            /* added phone pattern */
            distPhone: {
                required:  "Please provide a phone number",
                pattern:  "Please use the format (555) 555-5555, 555 555-5555 or 5555555555"
            },
            distDesc: {
                required: "Please provide a description",
                minlength: "Description too short.",
                pattern: "Please use only letters, numbers and(.'-,?) in Description"
            }
        },
		errorPlacement: function(error, element) {
			if ($(element).hasClass("checkreq")) {
                error.appendTo("#checkError");
            } else {
				error.insertAfter(element.parent().children("label"));
			}
		},

        /* added color and error placement removed when button class added */
        /*errorPlacement: function(error, element) {
            if ($(element).hasClass("checkreq")) {
                error.appendTo("#checkError");
            } else {
                error.insertAfter(element);
            }
        },*/
        errorClass: "invalid",
        success: function(label) {
            label.addClass("valid").text("Ok!")
        },
        submitHandler: function(form) {
            /* added ajax post handler */
            /**
            * Ajax call to POST validated form data to donateEmail.php to be emailed and submitted to database
            * Pre-conditions:  jquery validator has validated input
            * Post-condition donation form data successfully submitted or error returned
            */
            $.ajax({
                type: 'post',
                url: 'donateMail.php',
                data: $('form').serialize(),
                success: function () {
                    showSuccess();
                },
                error: function() {
                    showError();
                },
				async: false
            });

        }
    });
	
    
});

/**
* Function: startAjax()
* Parameters: function to call on success
* Pre-conditions:  distributors.xml exists
* Post-condition: xml data loaded in data
*/
function startAjax(passedFunction) {
    
    /**
    * Ajax call to list of distributors
    * Pre-conditions:  distributors.html exists
    * Post-conditions: function specified by passedFunction called or errorFunction called
     */
    $.ajax({url:"distributors.xml",
        success:passedFunction,error:errorFunction,
        dataType: 'text',
		async: false} 
    );
}

/**
* Function: callbackFunction()
* Parameters: xml data, error info
* Pre-conditions:  ajax called
* Post-condition: distributors added to table
*/
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
    
    /**
    * Finds each record containing specified state and extracts the siblings
    *    of the children that match the city
    * Pre-conditions:  State selected by user
    * Post-condition only records extracted from xml city and state
    */
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

/**
* Function: callbackStateFunction()
* Parameters: xml data, error info
* Pre-conditions:  ajax called
* Post-condition: city's loaded in dropdown or No cities message displayed
*/
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

/**
* Function: errorFunction()
* Parameters: xml data, error info
* Pre-conditions:  ajax called
* Post-condition: error message displayed
*/
function errorFunction(data,info) {
    $("#results").text("error occurred:"+info);
}

/**
* Function: startSchedule()
* Parameters: distributor ID for when it's required for tables
* Pre-conditions:  
* Post-condition: request form populated with distributor data, email, name, phone 
*/
function startSchedule(distroID){

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
	var returnVal = "";
	var distroID = distroID;
	var distroemail = "";
    
    /* changed to hide donate Main */
    $('#donateMain').hide();
    $('#donateSubmit').show();
    $("#donateSuccess").hide();
    $("#donateError").hide();

    /**
    * Ajax call to get selected distributor data (to be used for submission form)
    * Pre-conditions:  Valid distributor selected by user
    * Post-condition distributor data stored in variables and appended above submission form
    */
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

            /* fixed this part distrophone wasn't attaching as .val was wrong */
            $('#subDistributor').html(distributor);
            $('#dEmail').val(distroemail);
            $('#dDistr').val(distro);
            $('#dPhone').val(distrophone);

        },
        error:errorFunction,
        dataType: 'text',
		async: false} 
    );
           

    
}

/**
* Function: showSuccess()
* Parameters: 
* Pre-conditions:  Mail has been generated and sent
* Post-condition: Success message shows
*/
function showSuccess(){
    $("#donateMain").hide();
    $("#donateSubmit").hide();
    $("#donateSuccess").show();
    $("#donateError").hide();
}

/**
* Function: showError()
* Parameters: 
* Pre-conditions:  Mail form could not be generated and sent
* Post-condition: Error message shows
*/
function showError(){
    $("#donateMain").hide();
    $("#donateSubmit").hide();
    $("#donateSuccess").hide();
    $("#donateError").show();
}

QUnit.config.urlConfig.pop({
});
QUnit.config.urlConfig.pop({
});
QUnit.test( "Function Testing", function( assert ) {
	var frmPass = true;
	/**
	* Check Page Loads
	**/
    var dropDownLoad = $("#frmState option").size();
	assert.ok( dropDownLoad == "52", "Page Load: Form Loading Passed!" );

	/**
	* Check correct displays showing
	**/
	assert.ok( !$('#donateMain').is( ":hidden" ), "Main Div Adjustment: donateMain Hidden" );
	assert.ok( $('#donateSubmit').is( ":hidden" ), "Main Div Adjustment: donateSubmit hidden" );  
	assert.ok( $('#donateSuccess').is( ":hidden" ), "Main Div Adjustment: donateSubmit Hidden" );
	assert.ok( $('#donateError').is( ":hidden" ), "Main Div Adjustment: donateError Hidden" );
	
	/**
	* Check city dropdown populates
	**/
	$("#frmState").val("AL");  
	var expectedCity = "Montgomery";
	startAjax(callbackStateFunction);
	assert.ok( $('#frmCity').val() == expectedCity, "DropDown: City dropdown populated" );

	/**
	* Check rows added to table
	**/
	var startRows = $('#distTable tr').size();
	$('#frmCity').val("Mobile");
	startAjax(callbackFunction);
	var endRows = $('#distTable tr').size();
	assert.ok( (endRows - startRows) == 1, "Distributor table: loaded and has 2 rows" );
  
	/**
	* Check Schedule Pickup works
	**/
	startSchedule(1);
  
	/**
	* Check correct displays showing
	**/
	assert.ok( $('#donateMain').is( ":hidden" ), "Schedule Div Adjustment: donateMain Hidden" );
	assert.ok( !$('#donateSubmit').is( ":hidden" ), "Schedule Div Adjustment: donateSubmit hidden" );  
	assert.ok( $('#donateSuccess').is( ":hidden" ), "Schedule Div Adjustment: donateSubmit Hidden" );
	assert.ok( $('#donateError').is( ":hidden" ), "Schedule Div Adjustment: donateError Hidden" );
	
	var expectedEmail = "ammj@oregonstate.edu";
	assert.ok( $('#dEmail').val() == expectedEmail, "Email populated in hidden form" );
  
	var expectedPhone = "818-555-5555";
	assert.ok($('#dPhone').val() == expectedPhone, "Phone populated in hidden form");
  
	var expectedDistro = "Janes distribution";
	assert.ok($('#dDistr').val() == expectedDistro, "Distro populated in hidden form");
	
	/**
	* Submit form
	**/
	document.getElementById("frmSubmit").click();
  
	frmPass = true;
	if($("#distOrg").valid() || $("#distContact").valid() || $("#distEmail").valid() || $("#distPhone").valid() || $("#distDesc").valid() ){
		frmPass = false;
	} 
	assert.ok(frmPass, "No form submission when no fields entered.");

	$("#distOrg").val('My Organization');  
	frmPass = true;
	if(!($("#distOrg").valid()) || $("#distContact").valid() || $("#distEmail").valid() || $("#distPhone").valid() || $("#distDesc").valid() ){
		frmPass = false;
	} 
	assert.ok(frmPass, "No form submission when only Distributor Only entered.");

	$("#distContact").val('Jane Doe');
	frmPass = true;
	if(!$("#distOrg").valid() || !$("#distContact").valid() || $("#distEmail").valid() || $("#distPhone").valid() || $("#distDesc").valid() ){
		frmPass = false;
	} 
	assert.ok(frmPass, "No form submission when only Distributor & Contact Only entered.");  

	$("#distEmail").val('jamm8888@gmail.com');
	if(!$("#distOrg").valid() || !$("#distContact").valid() || !$("#distEmail").valid() || $("#distPhone").valid() || $("#distDesc").valid() ){
		frmPass = false;
	} 
	assert.ok(frmPass, "No form submission when only Distributor, Contact, Email Only Entered..");  

	$("#distPhone").val('(555) 555-5555');
	frmPass = true;
	if(!$("#distOrg").valid() || !$("#distContact").valid() || !$("#distEmail").valid() || !$("#distPhone").valid() || $("#distDesc").valid() ){
		frmPass = false;
	} 
	assert.ok(frmPass, "No form submission when only Distributor, Contact, Email, Phone number Only Entered..");  

	$("#distDesc").val('Valid Description');
	frmPass = true;
	if(!$("#distOrg").valid() || !$("#distContact").valid() || !$("#distEmail").valid() || !$("#distPhone").valid() || !$("#distDesc").valid() || $("#frmProduce").valid() ){
		frmPass = false;
	} 
	assert.ok(frmPass, "No form submission when Food Type Missing..");  

	document.getElementById("frmProduce").click();
	$("#distOrg").val("My*Organization");
	frmPass = true;  
	if($("#distOrg").valid() || !$("#distContact").valid() || !$("#distEmail").valid() || !$("#distPhone").valid() || !$("#distDesc").valid() || !$("#frmProduce").valid() ){
		frmPass = false;
	} 
	assert.ok(frmPass, "No form Submission with Donor / Org containing *");

	$("#distOrg").val("My Organization");  
	$("#distContact").val("Jane*Doe");
	frmPass = true;
	if(!$("#distOrg").valid() || $("#distContact").valid() || !$("#distEmail").valid() || !$("#distPhone").valid() || !$("#distDesc").valid() || !$("#frmProduce").valid() ){
		frmPass = false;
	} 
	assert.ok(frmPass, "No form Submission with Contact containing *.  Contact only failure for Validation");

	$("#distContact").val("Jane Doe");  
	$("#distEmail").val("jamm");
	frmPass = true;
	if(!$("#distOrg").valid() || !$("#distContact").valid() || $("#distEmail").valid() || !$("#distPhone").valid() || !$("#distDesc").valid() || !$("#frmProduce").valid() ){
		frmPass = false;
	} 
	assert.ok(frmPass, "No form Submission with invalid email.  Email only failure for Validation");

	$("#distEmail").val("jamm8888@gmail");  
	frmPass = true;
	if(!$("#distOrg").valid() || !$("#distContact").valid() || $("#distEmail").valid() || !$("#distPhone").valid() || !$("#distDesc").valid() || !$("#frmProduce").valid() ){
		frmPass = false;
	} 
	assert.ok(frmPass, "No form Submission with invalid email (no Extension).  Email only failure for Validation");

	$("#distEmail").val("jamM8888@gmail.com");
	$("#distPhone").val("(aaa) aaa-aaaa");
	frmPass = true;
	if(!$("#distOrg").valid() || !$("#distContact").valid() || !$("#distEmail").valid() || $("#distPhone").valid() || !$("#distDesc").valid() || !$("#frmProduce").valid() ){
		frmPass = false;
	} 
	assert.ok(frmPass, "No form Submission with invalid phone.  Phone only failure for Validation");

	$("#distPhone").val("555 555 555");  
	frmPass = true;
	if(!$("#distOrg").valid() || !$("#distContact").valid() || !$("#distEmail").valid() || $("#distPhone").valid() || !$("#distDesc").valid() || !$("#frmProduce").valid() ){
		frmPass = false;
	} 
	assert.ok(frmPass, "No form Submission with invalid phone format.  Phone only failure for Validation");

	$("#distPhone").val("(555) 555-5555");  
	$("#distDesc").val("*Lot's and Lot's of food!*");
	frmPass = true;
	if(!$("#distOrg").valid() || !$("#distContact").valid() || !$("#distEmail").valid() || !$("#distPhone").valid() || $("#distDesc").valid() || !$("#frmProduce").valid()){
		frmPass = false;
	} 
	assert.ok(frmPass, "No form Submission incorrect chars in Description.  Description only failure for Validation");

	$("#distPhone").val("(555) 555-5555");  
	$("#distDesc").val("Lots and Lots of people's food");
	frmPass = true;
	if(!$("#distOrg").valid() || !$("#distContact").valid() || !$("#distEmail").valid() || !$("#distPhone").valid() || !$("#distDesc").valid() || !$("#frmProduce").valid() ){
		frmPass = false;
	} 
	assert.ok(frmPass, "Form Passess Validation when all fields entered correctly");
  
	$("#frmSubmit").click();
  
	/**
	* Check correct displays showing
	**/
	assert.ok( $('#donateMain').is( ":hidden" ), "Schedule Submit Div Adjustment: donateMain Hidden" );
	assert.ok( $('#donateSubmit').is( ":hidden" ), "Schedule Submit Adjustment: donateSubmit hidden" );  
	assert.ok( !$('#donateSuccess').is( ":hidden" ), "Schedule Submit Adjustment: donateSuccess Hidden" );
	assert.ok( $('#donateError').is( ":hidden" ), "Schedule Submit Adjustment: donateError Hidden" );
	
	
});