$(document).ready(function () {
    $("#loginForm").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
    rules: {
        email: {
            required: true,
            email: true
        },
        password: {
            required: true,
            minlength: 8
        },
            
    },
    messages: {
        email: {
            required: "Enter your email address",
            email: "Enter your email address"
        },
        
        password: {
            required: 'Please enter your password',
            minlength: 'Your password must be at least 8 characters long'
        },
        
    },
    submitHandler: function(form) {
        form.submit();
    }

    });
});
