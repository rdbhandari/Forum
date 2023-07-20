$(document).ready(function () {

    // SECTION :: SIGN IN
    var fSigninEmail = 0; var fSigninPassword = 0;
    $('#signinForm').on('submit', function (e) {
        e.preventDefault();
        if (signinFormValidate() == true) {
            document.getElementById("btnSignin").innerHTML = "Please Wait...";
            document.getElementById("btnSignin").disabled = true;
            jQuery.ajax({
                url: '/partials/actions/_actionSignUpInOut.php',
                type: 'POST',
                data: jQuery('#signinForm').serialize(),
                success: function (response) {
                    if (response == false) {
                        alert("Invalid Login Credentials");
                    } else {
                        location.reload();
                    }
                    document.getElementById("btnSignin").innerHTML = "Signin";
                    document.getElementById("btnSignin").disabled = false;
                    document.getElementById("signupForm").reset();
                }
            })
        }

    })
    //SIGNIN FORM VALIDATION
    document.getElementById('signinPassword').onkeyup = function () {
        var alert = document.getElementById('signinPasswordAlert');
        if (this.value.length < 5) {
            alert.innerHTML = "Minimum Length Of Password Must Be 5 Characters";
            fSigninPassword = 0;
        } else {
            alert.innerHTML = "";
            fSigninPassword = 1;
        }
    }
    document.getElementById('signinEmail').onkeyup = function () {
        var alert = document.getElementById("signinEmailAlert");
        var pattern = /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;

        if (!pattern.test(this.value)) {
            alert.innerHTML = "Invalid Email";
            fSigninEmail = 0;
        } else {
            $.when(emailAvailibilityCheck(this.value)).done(function (response) {
                if (response == true) {
                    alert.innerHTML = "";
                    fSigninEmail = 1;
                } else {
                    alert.innerHTML = "This Email Is Not Registered";
                    fSigninEmail = 0;
                }
            })
        }
    }
    function signinFormValidate() {
        if (fSigninEmail == 0) return false;
        else if (fSigninPassword == 0) return false;
        else return true;
    }

    //SECTION : SIGNOUT
    $('#btnSignout').on('click', function (e) {
        // e.preventDefault();
        $.ajax({
            url: '/partials/actions/_actionSignUpInOut.php',
            method: "POST",
            data: {
                action: "signout"
            },
            success: function () {
                window.location.reload();
            }
        });

    })

    // SECTION :: SIGN UP 
    var fSignupUsername = 0; var fSignupEmail = 0; var fSignupPassword = 0;
    $("#signupForm").on('submit', function (e) {
        e.preventDefault();
        if (signupFormValidate() == true) {
            document.getElementById("btnSignup").innerHTML = "Please Wait...";
            document.getElementById("btnSignup").disabled = true;

            jQuery.ajax({
                url: '/partials/actions/_actionSignUpInOut.php',
                type: 'POST',
                data: jQuery('#signupForm').serialize(),
                success: function (response) {
                    document.getElementById("btnSignup").innerHTML = "Signup";
                    document.getElementById("btnSignup").disabled = false;
                    document.getElementById("signupForm").reset();
                    window.location.reload();
                    alert(response);
                }
            })
        } else alert("Please Make Correction In The Form !!");
    })

    // SIGNUP FORM VALIDATION 
    function signupFormValidate() {
        if (fSignupUsername == 0) return false;
        else if (fSignupEmail == 0) return false;
        else if (fSignupPassword == 0) return false;
        else return true;
    }
    document.getElementById('signupPassword').onkeyup = function () {
        var alert = document.getElementById('signupPasswordAlert');
        if (this.value.length < 5) {
            alert.innerHTML = "Minimum Length Of Password Must Be 5 Characters";
            fSignupPassword = 0;
        } else {
            alert.innerHTML = "";
            fSignupPassword = 1;
        }
    }
    document.getElementById('signupUsername').onkeyup = function () {
        var alert = document.getElementById("signupUsernameAlert");
        var pattern = /[a-zA-Z][a-zA-Z0-9-_]{4,10}$/;

        if (!pattern.test(this.value)) {
            alert.innerHTML = "Invalid Username";
            fSignupUsername = 0;
        } else {
            $.when(usernameAvailibilityCheck(this.value)).done(function (response) {
                if (response == true) {
                    alert.innerHTML = "Username Is Not Availbale";
                    fSignupUsername = 0;
                } else {
                    alert.innerHTML = "";
                    fSignupUsername = 1;
                }
            })
        }
    }
    document.getElementById('signupEmail').onkeyup = function () {
        var alert = document.getElementById('signupEmailAlert');
        var pattern = /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
        if (!pattern.test(this.value)) {
            alert.innerHTML = "Invalid Email";
            fSignupEmail = 0;
        } else {
            $.when(emailAvailibilityCheck(this.value)).done(function (response) {
                if (response == true) {
                    alert.innerHTML = "Email Already Is Registered";
                    fSignupEmail = 0;
                } else {
                    alert.innerHTML = "";
                    fSignupEmail = 1;
                }
            })
        }
    }



    //FUNCTIONS
    function usernameAvailibilityCheck(input_data) {
        return $.ajax({
            url: '/partials/actions/_actionSignUpInOut.php',
            method: "POST",
            data: {
                action: "usernameAvailibilityCheck",
                input_data: input_data
            },
            dataType: "text"
        })
    }
    function emailAvailibilityCheck(input_data) {
        return $.ajax({
            url: '/partials/actions/_actionSignUpInOut.php',
            method: "POST",
            data: {
                action: "emailAvailibilityCheck",
                input_data: input_data
            },
            dataType: "text"
        })
    }


});

function showhidePassword(x) {
    var x = document.getElementById(x);
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}