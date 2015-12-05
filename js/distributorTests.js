$( document ).ready(function() {

	// http://stackoverflow.com/questions/9538834/clear-form-fields-onload-and-onunload-on-back-button
	var i;
	for (i = 0; (i < document.forms.length); i++) {
		document.forms[i].reset();
	}
    $("#addSuccess").hide();
    $("#addError").hide();

    $("#distForm").validate({
        rules: {
            distName: {
                required: true,
                minlength: 4,
                pattern: /^[A-Za-z0-9- ']*$/
            },
            distEmail: {
                required: true,
                email: true
            },
            distAddress: {
                required: true,
                minlength: 4,
                pattern: /^[A-Za-z0-9- .'(),#]*$/
            },
            distCity: {
                required: true,
                minlength: 4,
                pattern: /^[A-Za-z- .']*$/
            },
            distState: {
                required: true,
				minlength: 1
            },
            distPostcode: {
                required: true,
                minlength: 5,
				maxlength: 5,
                pattern: /^[0-9- ]*$/
            },
            distPhone: {
                required: true,
                pattern: /^((\(\d{3}\))|(\d{3}))(\s)?\d{3}(-)?\d{4}$/
            },
            distDrophours: {
                required: true,
                minlength: 4,
                pattern: /^[A-Za-z0-9- .(),]*$/
            },
            distPickuphours: {
                required: true,
                minlength: 4,
                pattern: /^[A-Za-z0-9- .(),]*$/

            }
        },
        
        messages: {
            distName: {
                required: "Distribution location name required",
                minlength: "Distribution location name too short",
                pattern: "Please use only letters, numbers, - or ' in distribution location name"
            },
            distEmail: {
                required: "Please provide an email address",
                email: "Please enter a valid email address"
            },
            distAddress: {
                required: "Please provide an address",
                minlength: "Address too short",
                pattern: "Please use only letters, numbers and(.'-,#) in address"
            },
            distCity: {
                required: "Please provide city",
                minlength: "City too short.",
                pattern: "Please use only letters, -, ', or . in in city name"
            },
            distState: {
                required: "Please provide a state",
				minlength:  "Please choose a state"
            },
            distPostcode: {
                required: "Postcode required",
                minlength: "Postcode too short",
				maxlenght: "Postcode too long",
                pattern: "Please use only numbers in postcode"
            },
            distPhone: {
                required:  "Please provide a phone number",
                pattern:  "Please use the format (555) 555-5555, 555 555-5555 or 5555555555"
            },
            distDrophours: {
                required: "Drop hours required",
                minlength: "Drop hours too short",
                pattern: "Please use only letters, numbers and(.-,) in drop hours"
            },
            distPickuphours: {
                required: "Pickup hours required",
                minlength: "Pickup hours too short",
                pattern: "Pickup use only letters, numbers and(.-,) in drop hours"
            }
        },
        errorClass: "invalid",
		errorPlacement: function(error, element) {
			error.insertAfter(element.parent().children("label"));
		},

        /* added color and error placement removed when button class added */
        /*errorPlacement: function(error, element) {
            if ($(element).hasClass("checkreq")) {
                error.appendTo("#checkError");
            } else {
                error.insertAfter(element);
            }
        },*/
        success: function(label) {
            label.addClass("valid").text("Ok!")
        },
        submitHandler: function(form) {
            $.ajax({
                type: 'post',
                url: 'addDistributor.php',
                data: $('form').serialize(),
                success: function (data) {
                    if (data == "success")
                        showSuccess();
                    else
                        showError(data);
                },
                error: function(data) {
                    showError(data);
                },
                async: false
            });

        }
    });
    
});

function showSuccess(){
    $("#addDistributor").hide();
    $("#addSuccess").show();
    $("#addError").hide();
}

function showError(err){
    $("#addDistributor").hide();
    $("#addSuccess").hide();
    $("#addError").html("<h3 class=\"invalid\">" + err + "</h3>")
    $("#addError").show();
}

QUnit.config.urlConfig.pop({
});
QUnit.config.urlConfig.pop({
});
QUnit.test("Page load test", function( assert ) {
    var dropDownLoad = $("#distState option").size();
    assert.ok( dropDownLoad == "52", "Foam loads, page load passed" );
});

QUnit.test("Divs hidden/visible test", function( assert ) {
    assert.ok( $('#addSuccess').is( ":hidden" ), "Main Div Adjustment: addSuccess Hidden" );
    assert.ok( $('#addError').is( ":hidden" ), "Main Div Adjustment: addError Hidden" );
    assert.ok( !$('#addDistributor').is( ":hidden" ), "Main Div Adjustment: addDistributor Visible" );
});

QUnit.test("Form validation testing", function( assert ) {
    var frmPass = true;

    // test form submission
    $("#frmSubmit").click();

    // check error messages
    frmPass = true;
    if($("#distName").valid() || $("#distEmail").valid() || $("#distAddress").valid() || $("#distCity").valid() || $("#distState").valid() || $("#distPostcode").valid() || $("#distDrophours").valid() || $("#distPickuphours").valid())  {
        frmPass = false;
    } 
    assert.ok(frmPass, "No form submission when no fields entered.");

    $("#distName").val('Distribution Location Name');  
    frmPass = true;
     if(!$("#distName").valid() || $("#distEmail").valid() || $("#distAddress").valid() || $("#distCity").valid() || $("#distState").valid() || $("#distPostcode").valid() || $("#distDrophours").valid() || $("#distPickuphours").valid())  {
        frmPass = false;
    } 
    assert.ok(frmPass, "No form submission when only Distributor Name entered.");

    $("#distEmail").val('pmzotz@gmail.com');
    frmPass = true;
     if(!$("#distName").valid() || !$("#distEmail").valid() || $("#distAddress").valid() || $("#distCity").valid() || $("#distState").valid() || $("#distPostcode").valid() || $("#distPhone").valid() || $("#distDrophours").valid() || $("#distPickuphours").valid())  {
        frmPass = false;
    } 
    assert.ok(frmPass, "No form submission when only distributor name and email entered.");  

    $("#distAddress").val('123 Somewhere Ln');
     if(!$("#distName").valid() || !$("#distEmail").valid() || !$("#distAddress").valid() || $("#distCity").valid() || $("#distState").valid() || $("#distPostcode").valid() || $("#distPhone").valid() || $("#distDrophours").valid() || $("#distPickuphours").valid())  {
    } 
    assert.ok(frmPass, "No form submission when only name, email, and address entered.");  

    $("#distCity").val('Seattle');
    frmPass = true;
    if(!$("#distName").valid() || !$("#distEmail").valid() || !$("#distAddress").valid() || !$("#distCity").valid() || $("#distState").valid() || $("#distPostcode").valid() || $("#distPhone").valid() || $("#distDrophours").valid() || $("#distPickuphours").valid())  {
        frmPass = false;
    } 
    assert.ok(frmPass, "No form submission when only name, email, address, and city entered.");  

    $("#distState").val("WA");
    frmPass = true;
    if(!$("#distName").valid() || !$("#distEmail").valid() || !$("#distAddress").valid() || !$("#distCity").valid() || !$("#distState").valid() || $("#distPostcode").valid() || $("#distPhone").valid() || $("#distDrophours").valid() || $("#distPickuphours").valid())  {
        frmPass = false;
    } 
    assert.ok(frmPass, "No form submission when only name, email, address, and city, and state entered.");

    $("#distPostcode").val('12345');
    frmPass = true;
    if(!$("#distName").valid() || !$("#distEmail").valid() || !$("#distAddress").valid() || !$("#distCity").valid() || !$("#distState").valid() || !$("#distPostcode").valid() || $("#distPhone").valid() || $("#distDrophours").valid() || $("#distPickuphours").valid())  {
        frmPass = false;
    } 
    assert.ok(frmPass, "No form submission when only name, email, address, city, state, and postcode entered.");  

    $("#distPhone").val("(555) 555-5555");
    frmPass = true;
    if(!$("#distName").valid() || !$("#distEmail").valid() || !$("#distAddress").valid() || !$("#distCity").valid() || !$("#distState").valid() || !$("#distPostcode").valid() || !$("#distPhone").valid() || $("#distDrophours").valid() || $("#distPickuphours").valid())  {
        frmPass = false;
    } 
    assert.ok(frmPass, "No form submission when only name, email, address, city, state, postcode, and phone entered.");  

    $("#distDrophours").val('10-4 Mon-Sat');
    frmPass = true;
    if(!$("#distName").valid() || !$("#distEmail").valid() || !$("#distAddress").valid() || !$("#distCity").valid() || !$("#distState").valid() || !$("#distPostcode").valid() || !$("#distPhone").valid() || !$("#distDrophours").valid() || $("#distPickuphours").valid())  {
    } 
    assert.ok(frmPass, "No form submission when only name, email, address, city, state, postcode, phone, and drop hours entered."); 

    $("#distPickuphours").val("12-5 Tues-Fri");



    $("#distName").val('Distribution Location Name*');
    frmPass = true;
    if($("#distName").valid() || !$("#distEmail").valid() || !$("#distAddress").valid() || !$("#distCity").valid() || !$("#distState").valid() || !$("#distPostcode").valid() || !$("#distPhone").valid() || !$("#distDrophours").valid() || !$("#distPickuphours").valid())  {
        frmPass = false;
    } 
    assert.ok(frmPass, "No form submit with distributor name containing *. Name only failure for validation"); 

    $("#distName").val("Distribution Location Name");  
    $("#distEmail").val("pmzotz");
    frmPass = true;
    if(!$("#distName").valid() || $("#distEmail").valid() || !$("#distAddress").valid() || !$("#distCity").valid() || !$("#distState").valid() || !$("#distPostcode").valid() || !$("#distPhone").valid() || !$("#distDrophours").valid() || !$("#distPickuphours").valid())  {
        frmPass = false;
    } 
     assert.ok(frmPass, "No form submit with invalid email. Email only failure for validation"); 

    $("#distEmail").val("pmzotz@gmail.com");
    $("#distAddress").val("1!2!3! Somewhere! Ln!@");
    frmPass = true;
    if(!$("#distName").valid() || !$("#distEmail").valid() || $("#distAddress").valid() || !$("#distCity").valid() || !$("#distState").valid() || !$("#distPostcode").valid() || !$("#distPhone").valid() || !$("#distDrophours").valid() || !$("#distPickuphours").valid())  {
        frmPass = false;
    } 
    assert.ok(frmPass, "No form submit incorrect chars in address.  Address only failure for validation.");

    $("#distAddress").val("123 Somewhere Ln");
    
    $("#distCity").val("Seattle*!!!");
    frmPass = true;
    if(!$("#distName").valid() || !$("#distEmail").valid() || !$("#distAddress").valid() || $("#distCity").valid() || !$("#distState").valid() || !$("#distPostcode").valid() || !$("#distPhone").valid() || !$("#distDrophours").valid() || !$("#distPickuphours").valid())  {
        frmPass = false;
    } 
    assert.ok(frmPass, "No form submit incorrect chars in city.  City only failure for validation");  

    $("#distCity").val("Seattle");
    $("#distPhone").val("(aaa) aaa-aaaa");
    frmPass = true;
    if(!$("#distName").valid() || !$("#distEmail").valid() || !$("#distAddress").valid() || !$("#distCity").valid() || !$("#distState").valid() || !$("#distPostcode").valid() || $("#distPhone").valid() || !$("#distDrophours").valid() || !$("#distPickuphours").valid())  {
        frmPass = false;
    } 
    assert.ok(frmPass, "No form submit with invalid phone.  Phone only failure for validation");

    $("#distPhone").val("555 555 555");  
    frmPass = true;
    if(!$("#distName").valid() || !$("#distEmail").valid() || !$("#distAddress").valid() || !$("#distCity").valid() || !$("#distState").valid() || !$("#distPostcode").valid() || $("#distPhone").valid() || !$("#distDrophours").valid() || !$("#distPickuphours").valid())  {
        frmPass = false;
    } 
    assert.ok(frmPass, "No form submit with invalid phone format.  Phone only failure for validation");

    $("#distPhone").val("(555) 555-5555");  
    

    $("#distDrophours").val("Mon-Sat @9-5!!");
    frmPass = true;
    if(!$("#distName").valid() || !$("#distEmail").valid() || !$("#distAddress").valid() || !$("#distCity").valid() || !$("#distState").valid() || !$("#distPostcode").valid() || !$("#distPhone").valid() || $("#distDrophours").valid() || !$("#distPickuphours").valid())  {
        frmPass = false;
    } 
    assert.ok(frmPass, "No form submit with invalid chars in drop hours.  Drop hours only failure for validation");

    $("#distDrophours").val('10-4 Mon-Sat');
    $("#distPickuphours").val("Tues-Fri @12-5!");
    frmPass = true;
    if(!$("#distName").valid() || !$("#distEmail").valid() || !$("#distAddress").valid() || !$("#distCity").valid() || !$("#distState").valid() || !$("#distPostcode").valid() || !$("#distPhone").valid() || !$("#distDrophours").valid() || $("#distPickuphours").valid())  {
        frmPass = false;
    } 
    assert.ok(frmPass, "No form submit with invalid chars in pickup hours.  Pickup hours only failure for validation");

    $("#distPickuphours").val("12-5 Tues-Fri");

    // submit form
    $("#frmSubmit").click();

});

QUnit.test("Form submission success testing", function( assert ) {
    assert.ok( $('#addDistributor').is( ":hidden" ), "Add Distributor Submit Adjustment: addDistributor is hidden" );
    assert.ok( !$('#addSuccess').is( ":hidden" ), "Add Distributor Submit Adjustment: addSuccess visible" );
    assert.ok( $('#addError').is( ":hidden" ), "Add Distributor Submit Adjustment: addError Hidden" );  
});