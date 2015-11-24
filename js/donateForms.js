/**
* Function on document ready to attach validation
* Pre-conditions:  Document Ready
* Post-condition validation on form
*/
$( document ).ready(function() {
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
                pattern: /^\(\d{3}\)\s\d{3}-\d{4}$/
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
                pattern:  "Please use the format (555) 555-5555"
            },
            distDesc: {
                required: "Please provide a description",
                minlength: "Description too short.",
                pattern: "Please use only letters, numbers and(.'-,?) in Description"
            }
        },
        /* added color and error placement removed when button class added */
        errorPlacement: function(error, element) {
            if ($(element).hasClass("checkreq")) {
                error.appendTo("#checkError");
            } else {
                error.insertAfter(element);
            }
        },
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