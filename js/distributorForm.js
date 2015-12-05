$( document ).ready(function() {
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
                pattern: "Please use only numbers in postcode)"
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