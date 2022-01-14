<!DOCTYPE html>
<html>

<?php include 'include/head.php' ?>

<body class="bg-gray">
   <div class="container">
       <div class="col-md-4 offset-md-4">
            <div class="login-box">
                <h3>Faculty Login</h3>
                <img src="assets/images/logo-login.png" alt="" class="logo-login" />
                <form class="m-t" role="form" action="" id="loginForm">
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Username" required name="username">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" required name="password">
                    </div>
                    <button type="button" class="btn btn-primary btn-block">Login</button>
                </form>
            </div>
        </div>
    </div>

    <?php include 'include/footer_script.php' ?>
  
  <script>
        $(function(){
            $('#loginForm').click(function(){
                let token = '';
                let post_data ={
                    'email_id' : $('[name=username]').val(),
                    'password' : $('[name=password]').val(),
                }
                $.ajax({
                    url: base_url + '/faculty/login.php',
                    type: 'POST',
                    dataType: 'JSON',
                    data: JSON.stringify(post_data),
                    success: function(result) {
                        console.log(result);
                        token = result.token;
                        message = result.message;
                        localStorage.setItem("facultyToken", token);
                        toastr.success(message);
                        setTimeout(function(){
                            window.location.replace('dashboard.php');
                        },1000);
                    },
                    error: function(error){
                        toastr.error(error.responseJSON.message);
                    }
                });
            });
        });
    </script>

</body>

</html>