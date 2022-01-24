<div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <h1></h1>
        </div>
        <div class="navbar-right navbar-right-custom">
            <!-- <div class="subscription-box-parents">
                <div class="subscription-box">
                    <p>Subscription: <b>Trial</b></p>
                    <p class="text-danger">Expire 25 Jun 2022</p>
                </div>
                <div>
                    <button type="button" class="btn btn-primary">Upgrade</button>
                </div>
            </div> -->

            <ul class="nav navbar-top-links">
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">Admin <i class="fa fa-chevron-down"></i> </a>
                    <ul class="dropdown-menu">
                        <li><a href="#" onclick="logout();">Log out</a></li>
                    </ul>
                </li>
            </ul>
        </div>

    </nav>
</div>

<script>
    function logout() {
        localStorage.removeItem('admin_token');
        toastr.success('Logout Successfully');
        setTimeout(function() {
            window.location.replace('index.php');
        }, 1000);
    }
</script>