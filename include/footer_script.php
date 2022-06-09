<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/awesome.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js//jquery.validate.min.js"></script>
<script src="assets/js/toastr.min.js"></script>
<script src="assets/js/wow.min.js"></script>
<script src="assets/js/typeit.min.js"></script>

<script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/4.0/1/MicrosoftAjax.js"></script>

<script src="assets/js/custom.js?nocache=<?php echo rand(0, 99999); ?>"></script>
<script src="assets/js/config.js"></script>
<script>
    new WOW().init();
    new TypeIt('#typeItContianer', {
        strings: "Improve your chances to Crack NEXT & Become a Doctor",
    });
    new TypeIt('#typeItContianer').go();

</script>
<script>
    $(function() {

        $("#registerForm").validate({
            rules: {
                register_name: "required",
                register_email_id: "required",
                register_mobile_no: "required",
                register_password: "required",
                gender: "required",
                termCondition: "required",
            },
            messages: {
                register_name: "Full Name",
                register_email_id: "Email ID",
                register_mobile_no: "Mobile Number",
                register_password: "Create Password",
                gender: "required",
                termCondition: "required",
            },

            submitHandler: function(form) {
                registerSubmit();
            }
        });

        const otpTimer = function() {
            var counter = 60;
            var interval = setInterval(function() {
                counter--;
                if (counter <= 0) {
                    clearInterval(interval);
                    $('#timer').html('<button type="button" id="btn-resend-otp">Resend OTP</button>');
                    return;
                } else {
                    $('#timer').html(counter);
                }
            }, 1000);
        }

        const registerSubmit = function() {
            let post_data = {
                name: $('[name=register_name]').val(),
                email_id: $('[name=register_email_id]').val(),
                mobile_no: $('[name=register_mobile_no]').val(),
                password: $('[name=register_password]').val(),
                gender: $('[name=gender]:checked').val(),
            }
            $.ajax({
                url: base_url + '/student/sign-up.php',
                type: 'POST',
                dataType: 'JSON',
                data: JSON.stringify(post_data),
                success: function(response) {
                    token = response.token;
                    localStorage.setItem("tempToken", token);
                    toastr.success('Register Successfully');
                    $('.register-form').hide();
                    $('.otp-form').show();
                    otpTimer();
                },
                error: function(error) {
                    toastr.error(error.responseJSON.message);
                }
            });
        }

        $('body').on('click', '#btn-resend-otp', function() {
            let tempToken = localStorage.getItem("tempToken", token);
            let post_data = {
                token: tempToken,
            }
            $.ajax({
                url: base_url + '/student/resend-otp.php',
                type: 'POST',
                dataType: 'JSON',
                data: JSON.stringify(post_data),
                success: function(result) {
                    toastr.success(result.message);
                    otpTimer();
                },
                error: function(error) {
                    toastr.error(error.responseJSON.message);
                }
            });
        })

        $("#otpForm").validate({
            rules: {
                otp: "required",
            },
            messages: {
                otp: "OTP",
            },

            submitHandler: function(form) {
                otpFormSubmit();
            }
        });

        var otpFormSubmit = function() {
            let tempToken = localStorage.getItem("tempToken", token);
            let post_data = {
                token: tempToken,
                otp: $('[name=otp]').val(),
            }
            $.ajax({
                url: base_url + '/student/verify-otp.php',
                type: 'POST',
                dataType: 'JSON',
                data: JSON.stringify(post_data),
                success: function(result) {
                    localStorage.removeItem("tempToken");
                    localStorage.setItem("studentToken", result.token);
                    toastr.success(result.message);
                    window.location.replace('student/dashboard.php');
                },
                error: function(error) {
                    toastr.error(error.responseJSON.message);
                }
            });
        }

        $("#loginForm").validate({
            rules: {
                email_id: "required",
                password: "required",
            },
            messages: {
                email_id: "Email ID",
                password: "Password",
            },

            submitHandler: function(form) {
                loginSubmit();
            }
        });

        var loginSubmit = function() {
            let token = '';
            var message = '';
            let post_data = {
                email_id: $('[name=email_id]').val(),
                password: $('[name=password]').val(),
            }
            loginAjaxCall(post_data);
        }

        var loginAjaxCall = function(post_data) {
            $.ajax({
                url: base_url + '/student/login.php',
                type: 'POST',
                dataType: 'JSON',
                data: JSON.stringify(post_data),
                success: function(result) {
                    console.log(result);
                    token = result.token;
                    localStorage.setItem("studentToken", token);
                    message = result.message;
                    toastr.success(message);
                    window.location.replace('student/dashboard.php');
                },
                error: function(error) {
                    toastr.error(error.responseJSON.message);
                    // toastr.error(error.message);
                }
            });
        }

        $("#resetForm").validate({
            rules: {
                forget_email_id: "required",
            },
            messages: {
                forget_email_id: "Email ID",
            },

            submitHandler: function(form) {
                forgotSubmit();
            }
        });

        var forgotSubmit = function() {
            let token = '';
            var message = '';
            let post_data = {
                email_id: $('[name=forget_email_id]').val(),
            }
            forgotAjaxCall(post_data);
        }

        var forgotAjaxCall = function(post_data) {
            $.ajax({
                url: base_url + '/student/forgot-password.php',
                type: 'POST',
                dataType: 'JSON',
                data: JSON.stringify(post_data),
                success: function(result) {
                    console.log(result);
                    token = result.token;
                    localStorage.setItem("studentToken", token);
                    message = result.message;
                    toastr.success(message);
                    $('.reset-form').hide();
                    $('.login-form').show();
                },
                error: function(error) {
                    toastr.error(error.responseJSON.message);
                }
            });
        }

    });
</script>