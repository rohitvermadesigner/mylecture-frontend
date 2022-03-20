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
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <span id="admin-faculty-name"></span>
                        <i class="fa fa-chevron-down"></i> </a>
                    <ul class="dropdown-menu">
                        <li><a href="#" data-toggle="modal" data-target="#changePasswordModal">Change Password</a></li>
                        <li><a href="#" onclick="logout();">Log out</a></li>
                    </ul>
                </li>
            </ul>
        </div>

    </nav>
</div>

<!-- Modal -->
<div id="changePasswordModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
            <form id="changePassword">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Change Password</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Current Password</label>
                        <input type="text" class="form-control" name="old_password" />
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="text" class="form-control" name="new_password" id="new_password" />
                    </div>
                    <div class="form-group mb-0">
                        <label>Confirm Password</label>
                        <input type="text" class="form-control" name="confirm_password" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function logout() {
        localStorage.removeItem('admin_token');
        localStorage.removeItem('account_type');
        toastr.success('Logout Successfully');
        setTimeout(function() {
            window.location.replace('index.php');
        }, 1000);
    }
</script>