$( document ).ready(function() {
    $("#addSuccess").hide();
    $("#addError").hide();

    $("#distForm").validate({
        rules: {
            distName: {
                required: true
            },
            distEmail: {
                required: true,
                email: true
            },
            distAddress: {
                required: true
            },
            distCity: {
                required: true
            },
            distState: {
                required: true
            },
            distPostcode: {
                required: true
            },
            distDrophours: {
                required: true
            },
            distPickuphours: {
                required: true
            }
        },
        
        messages: {
            distName: {
                required: "Distributor name required"
            },
            distEmail: {
                required: "Please provide an email address",
                email: "Please enter a valid email address"
            },
            distAddress: {
                required: "Please provide a street address"
            },
            distCity: {
                required: "Please provide a city"
            },
            distState: {
                required: "Please provide a state"
            },
            distPostcode: {
                required: "Please provide a postcode"
            },
            distDrophours: {
                required: "Please provide drop hours for this location"
            },
            distPickuphours: {
                required: "Please provide pickup hours for this location"
            }
        },

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
            $.ajax({
                type: 'post',
                url: 'addDistributor.php',
                data: $('form').serialize(),
                success: function (data) {
                    console.log(data);
                    if (data == "success")
                        showSuccess();
                    else
                        showError();
                },
                error: function() {
                    showError();
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

function showError(){
    $("#addDistributor").hide();
    $("#addSuccess").hide();
    $("#addError").show();
}