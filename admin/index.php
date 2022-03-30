<!DOCTYPE html>
<html>

<?php include 'include/head.php' ?>

<body class="gray-bg">
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div class="ibox-content">
                <h3>Admin Login</h3>
                <img src="assets/img/gems-next-logo.jpg" alt="" style="width: 140px;" class="logo-login" />
                <form class="m-t" action="post" id="loginForm">
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Username" required name="username">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" required name="password">
                    </div>
                    <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                </form>
            </div>
        </div>
    </div>

    <?php include 'include/footer_script.php' ?>
    <script>
        $(function() {
            const token = localStorage.getItem("admin_token");
            if (!token) {
                $("#loginForm").submit(function(e) {
                    e.preventDefault();
                    let post_data = {
                        email_id: $('#loginForm input[name=username]').val(),
                        password: $('#loginForm input[name=password]').val(),
                    }
                    loginAjaxCall(post_data);
                });

                let loginAjaxCall = function(post_data) {
                    $.ajax({
                        url: base_url + '/admin/login.php',
                        type: 'POST',
                        dataType: 'JSON',
                        data: JSON.stringify(post_data),
                        success: function(result) {
                            localStorage.setItem("admin_token", result.token);
                            localStorage.setItem("account_type", result.account_type);
                            toastr.success(result.message);
                            setTimeout(function() {
                                window.location.replace('dashboard.php');
                            }, 1000);
                        },
                        error: function(error) {
                            toastr.error(error.responseJSON.message);
                        }
                    });
                }
            } else {
                window.location.replace('dashboard.php');
            }
        });
    </script>

</body>

</html>