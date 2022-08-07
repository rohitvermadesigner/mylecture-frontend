<div class="top-stripe">
    <ul>
        <li>Valid Upto : 27-March-2022</li>
        <li>Support : +91 9289633644</li>
        <li><a href="#" data-toggle="modal" data-target="#helpModal">HELP</a></li>
        <!-- <li>
            <a href="#">
                <span class="notification-span">
                    <span>2</span>
                    <i class="fa fa-bell"></i>
                </span>
            </a>
        </li> -->
        <li>
            <!-- <span class="name-cricle">JS</span>  -->
            <a href="#" onclick="logout();">Logout</a>
        </li>
    </ul>
</div>

<div class="mobile-header">
    <div class="row">
        <div class="col-xs-6">
            <a href="#" class="logo">
                <img src="assets/images/logo-m.png" alt="">
            </a>
        </div>
        <div class="col-xs-6">
            <div class="toggle-button mobile-view">
                <i class="fas fa-bars"></i>
            </div>
            <a href="#" data-toggle="modal" data-target="#helpModal" class="help-btn-mobile">HELP</a>
        </div>
    </div>
</div>

<div class="mobile-menu">
    <div class="mobile-menu-container">
        <div class="toggle-close">
            <i class="fas fa-times"></i>
        </div>
        <div class="mobile-menu-login-header">
            <div class="mobile-menu-user-name">
                <i class="fas fa-user"></i>
                <p id="loginUserName"></p>
            </div>
        </div>
        <ul>
            <li class="mobile-submenu-li"><a href="dashboard.php"> <i class="fas fa-th-large"></i> <span>Dashboard</span> </a> </li>
            <li class="mobile-submenu-li"><a href="self-assessor.php"> <i class="fa fa-users"></i> <span>Self Assessor</span> </a> </li>
            <li class="mobile-submenu-li"><a href="topic-simulator.php"> <i class="fas fa-book"></i> <span>Topic Simulator </span> </a> </li>
            <li class="mobile-submenu-li"><a href="my-tests.php"> <i class="fas fa-book-reader"></i> <span>My Tests </span> </a> </li>
            <li class="mobile-submenu-li"><a href="report.php"> <i class="fas fa-poll"></i> <span>Report </span> </a> </li>
            <li class="mobile-submenu-li"><a href="#" onclick="logout();"> <i class="fas fa-sign-out-alt"></i> <span> Logout</span></a></li>
        </ul>
    </div>
</div>

<!-- Modal -->
<div id="helpModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">HELP</h4>
            </div>
            <div class="modal-body">
                <p>
                    For any Billing,Technical issue you can write to us <b>support@gemsnext.com</b> or give us a call <b>+91 9289633644</b>
                </p>
                <p>
                    Our Support team timings are 10:00 a.m. to 7:00 p.m.
                </p>
            </div>
        </div>

    </div>
</div>