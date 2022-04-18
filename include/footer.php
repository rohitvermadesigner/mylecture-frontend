<footer>
    <!-- Footer Top Start -->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <!-- Single Footer Start -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="single-footer mb-sm-40">
                        <h3 class="footer-title">About us</h3>
                        <div class="mt-3">
                            <p>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Single Footer Start -->

                <!-- Single Footer Start -->
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="single-footer mb-sm-40">
                        <h3 class="footer-title"> QUICK LINKS</h3>
                        <div class="footer-content ">
                            <ul class="footer-list footer2_list">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="about.php">About</a></li>
                                <li><a href="why-gems.php">Why GEMS</a></li>
                                <!-- <li><a href="next-pg.php">NEXT PG</a></li> -->
                                <li><a href="courses.php">Courses</a></li>
                                <!-- <li><a href="live-lectures.php">Live Lectures</a></li> -->
                                <li><a href="mock-test.php">Mock Test</a></li>
                                <li><a href="book-demo-class.php">Book Demo Class</a></li>
                                <li><a href="contact.php">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Single Footer Start -->
                <!-- Single Footer Start -->
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="single-footer mb-sm-40">
                        <h3 class="footer-title">Follow us on</h3>
                        <div class="social-icons">
                            <ul>
                                <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i> </a></li>
                                <li><a href="#" target="_blank"><i class="fab fa-youtube"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fab fa-telegram-plane"></i> </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Single Footer Start -->
                <!-- Single Footer Start -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-footer mb-sm-40">
                        <h3 class="footer-title">Address</h3>
                        <div class="footer-content">
                            <ul class="footer-list address-content">
                                <li>Delhi, India</li>
                                <li><a href="#">E-mail: info@ </a></li>
                                <li>Tel: +9876543210</li>
                                <li>Fax: +9876543210</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Single Footer Start -->

                <div class="col-md-12">
                    <div class="copyright-text">
                        <p>
                            © Copyright 2021. All rights reserved by GEMS Next.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Footer Top End -->

</footer>


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
                                    <form class="login-form" id="loginForm">
                                        <div class="form-group custom-form-group">
                                            <label>Email ID</label>
                                            <input type="email" class="form-control" name="email_id" />
                                        </div>
                                        <div class="form-group custom-form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="password" />
                                        </div>
                                        <div class="form-group custom-form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                                        </div>
                                        <div class="form-group custom-form-group">
                                            <p>
                                                <span>Forgot Your Password?</span>
                                                <a id="btnReset">Reset
                                                    Now!</a>
                                            </p>
                                        </div>
                                    </form>
                                    <form class="reset-form" id="resetForm">
                                        <div class="form-group custom-form-group">
                                            <label>Email ID</label>
                                            <input type="email" class="form-control" name="forget_email_id">
                                        </div>
                                        <div class="form-group custom-form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="register">
                                    <form class="register-form" action="" id="registerForm">
                                        <div class="form-group custom-form-group">
                                            <label>Full Name</label>
                                            <input type="text" class="form-control" name="register_name" required>
                                        </div>
                                        <div class="form-group">
                                            <label><input type="radio" name="gender" value="male" required checked> Male</label> &nbsp;
                                            <label><input type="radio" name="gender" value="female" required> Female</label>
                                        </div>
                                        <div class="form-group custom-form-group">
                                            <label>Mobile Number</label>
                                            <input type="text" class="form-control" maxlength="10" name="register_mobile_no" required>
                                        </div>
                                        <div class="form-group custom-form-group">
                                            <label>Email ID</label>
                                            <input type="email" class="form-control" name="register_email_id" required>
                                        </div>
                                        <div class="form-group custom-form-group">
                                            <label>Create Password</label>
                                            <input type="password" class="form-control" name="register_password" required>
                                        </div>
                                        <div class="form-group">
                                            <label class=""><input type="radio" name="termCondition" required> I agree to the
                                                GEMS Next <a href="#" target="_blank">Privacy Policy</a> &amp; <a href="#" target="_blank">Terms &amp; Conditions</a>.</label>
                                        </div>
                                        <div class="form-group custom-form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                                        </div>
                                    </form>
                                    <form class="otp-form" id="otpForm">
                                        <div class="form-group custom-form-group">
                                            <label>OTP</label>
                                            <input type="text" class="form-control" name="otp">
                                        </div>
                                        <div class="form-group custom-form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Verify OTP</button>
                                        </div>
                                        <div class="form-group text-center">
                                            <div id="timer"></div>
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