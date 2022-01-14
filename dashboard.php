<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MY LECTURE</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/toastr.min.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>

<body>

    <section class="user-dashboard">
        <div class="dashboard-leftbar">
            <a href="#" class="logo">
                <img src="assets/images/logo.png" alt="">
            </a>
            <div class="left-nav">
                <ul>
                    <li>
                        <a href="#">
                            <img src="assets/images/leftnav-icon1.png" alt="">
                            <span>Self Assessor</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="assets/images/leftnav-icon2.png" alt="">
                            <span>Topic Simulator </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="assets/images/leftnav-icon3.png" alt="">
                            <span>Test Simulator</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="assets/images/leftnav-icon4.png" alt="">
                            <span>Top 5 Scorers</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="dashboard-container">
            <div class="top-stripe">
                <ul>
                    <li>Support : 9876543210</li>
                    <li><a href="#">HELP</a></li>
                    <li>
                        <a href="#">
                            <span class="notification-span">
                                <span>2</span>
                                <i class="fa fa-bell"></i>
                            </span>
                        </a>
                    </li>
                    <li><span class="name-cricle">JS</span> <a href="#" onclick="logout();">Logout</a></li>
                </ul>
            </div>
            <div class="dashboard-title">
                <div class="overflow-hidden">
                    <h1 class="float-left">Student Dashboard</h1>
                    <a href="test-page.php" class="btn btn-white float-right">Start Test</a>
                </div>
            </div>

            <div class="row m-0 mt-3">
                <div class="col-md-6">
                    <div class="white-box">
                        <div class="four-list">
                            <ul>
                                <li>
                                    <a href="#">
                                        <img src="assets/images/leftnav-icon1.png" alt="">
                                        <span>Self Assessor</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="assets/images/leftnav-icon2.png" alt="">
                                        <span>Topic Simulator </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="assets/images/leftnav-icon3.png" alt="">
                                        <span>Test Simulator</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="assets/images/leftnav-icon4.png" alt="">
                                        <span>Top 5 Scorers</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="white-box">
                        <div class="student-detail-box">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Student Detail</h5>
                                    <table class="table">
                                        <tr>
                                            <td>Name</td>
                                            <td>:</td>
                                            <td>Jasmeet Singh</td>
                                        </tr>
                                        <tr>
                                            <td>DOB</td>
                                            <td>:</td>
                                            <td>17-08-1991</td>
                                        </tr>
                                        <tr>
                                            <td>College</td>
                                            <td>:</td>
                                            <td>Trinity, Russia</td>
                                        </tr>
                                        <tr>
                                            <td>Course</td>
                                            <td>:</td>
                                            <td>MBBS</td>
                                        </tr>
                                    </table>
                                    <button class="btn btn-secondary">View More</button>
                                </div>
                                <div class="col-md-6 text-right mt-5">
                                    <img src="assets/images/user-icon.png" alt="">
                                </div>
                            </div>
                            <br><br>
                            <br><br>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <div class="white-box">
                        <h5>My Performance</h5>
                        <img src="assets/images/graph.jpg" class="img-fluid" alt="">

                        <div class="text-analysis-box">
                            <h5>Test Analysis</h5>
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Date</th>
                                        <th>Score/Percentage</th>
                                        <th>Subject</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Mock test 1</td>
                                        <td>16-July-2021</td>
                                        <td>500/320</td>
                                        <td>Physics</td>
                                    </tr>
                                    <tr>
                                        <td>Mock test 2</td>
                                        <td>17-July-2021</td>
                                        <td>500/270</td>
                                        <td>Chemistry</td>
                                    </tr>
                                    <tr>
                                        <td>Mock test 3</td>
                                        <td>18-July-2021</td>
                                        <td>500/380</td>
                                        <td>Biology</td>
                                    </tr>
                                    <tr>
                                        <td>Mock test 4</td>
                                        <td>19-July-2021</td>
                                        <td>500/325</td>
                                        <td>Math</td>
                                    </tr>
                                    <tr>
                                        <td>Mock test 5</td>
                                        <td>20-July-2021</td>
                                        <td>500/285</td>
                                        <td>Physics</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>

                        <div class="report-card-box">
                            <h5>Report Card</h5>
                            <ul>
                                <li>
                                    <a href="#">
                                        <h2>5</h2>
                                        <span>Test attempted</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <h2>3</h2>
                                        <span>Test Cleared</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleloginModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="btn-close-parent">
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
                    </div>
                    <div class="row m-0">
                        <div class="col-md-6 p-0">
                            <img src="assets/images/login-img.jpg" class="img-fluid" alt="">
                        </div>
                        <div class="col-md-6">
                            <div class="login-right-body">
                                <!-- Nav pills -->
                                <ul class="nav nav-pills nav-justified">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="pill" href="#login">Login</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#register">Register</a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="login">
                                        <form class="login-form">
                                            <div class="form-group custom-form-group">
                                                <label>Mobile Number</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="form-group custom-form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control">
                                            </div>
                                            <div class="form-group custom-form-group">
                                                <button class="btn btn-primary btn-block">Login</button>
                                            </div>
                                            <div class="form-group custom-form-group">
                                                <p>
                                                    <span>Forgot Your Password?</span>
                                                    <a id="btnReset">Reset
                                                        Now!</a>
                                                </p>
                                            </div>
                                        </form>
                                        <form class="reset-form">
                                            <div class="form-group custom-form-group">
                                                <label>New Password</label>
                                                <input type="password" class="form-control">
                                            </div>
                                            <div class="form-group custom-form-group">
                                                <label>Confirm Password</label>
                                                <input type="password" class="form-control">
                                            </div>
                                            <div class="form-group custom-form-group">
                                                <label>4 digit OTP</label>
                                                <input type="password" class="form-control">
                                            </div>
                                            <div class="form-group custom-form-group">
                                                <button class="btn btn-primary btn-block">Reset Password</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="register">
                                        <form class="register-form" action="">
                                            <div class="form-group custom-form-group">
                                                <label>Full Name</label>
                                                <input type="text" class="form-control" required>
                                            </div>
                                            <div class="form-group custom-form-group">
                                                <label>Mobile Number</label>
                                                <input type="text" class="form-control" maxlength="10" required>
                                            </div>
                                            <div class="form-group custom-form-group">
                                                <label>Email ID</label>
                                                <input type="email" class="form-control" required>
                                            </div>
                                            <div class="form-group custom-form-group">
                                                <label>Create Password</label>
                                                <input type="password" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label class=""><input type="radio" name="termCondition" required> I agree to the
                                                    My Lecture <a href="#" target="_blank">Privacy Policy</a> &amp; <a href="#" target="_blank">Terms &amp; Conditions</a>.</label>
                                            </div>
                                            <div class="form-group custom-form-group">
                                                <button type="submit" class="btn btn-primary btn-block" id="btnRegister">Register</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/awesome.min.js"></script>
    <script src="assets/js/toastr.min.js"></script>

    <script>
        function logout() {
            localStorage.removeItem('studentToken');
            toastr.success('Logout Successfully');
            setTimeout(function() {
                window.location.replace('index.php');
            }, 1000);
        }
    </script>

</body>

</html>