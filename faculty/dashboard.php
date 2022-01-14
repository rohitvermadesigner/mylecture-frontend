<!DOCTYPE html>
<html lang="en">

<?php include 'include/head.php' ?>

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
                            <span>Manage Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="question-main.html">
                            <img src="assets/images/leftnav-icon2.png" alt="">
                            <span>Create Question Bank </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="assets/images/leftnav-icon3.png" alt="">
                            <span>Create Course</span>
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
                    <li><span class="name-cricle">JS</span>  <a href="#" onclick="logout();">Logout</a></li>
                </ul>
            </div>
            <div class="dashboard-title">
                <h1>Faculty Dashboard</h1>
            </div>

            <div class="row m-0 mt-3">
                <div class="col-md-6">
                    <div class="white-box">
                        <div class="four-list">
                            <ul>
                                <li>
                                    <a href="#">
                                        <img src="assets/images/leftnav-icon5.png" alt="">
                                        <span>Live lectures</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="assets/images/leftnav-icon6.png" alt="">
                                        <span>Recorded lectures</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="assets/images/leftnav-icon3.png" alt="">
                                        <span>Syllabus</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="assets/images/leftnav-icon7.png" alt="">
                                        <span>Mock Test</span>
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
                                    <h5>Faculty Details</h5>
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

                        <div>
                            <h5>Student Enrolled</h5>
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

                    </div>
                </div>
            </div>
        </div>
    </section>

  <?php include 'include/footer_script.php' ?>

  <script>
    function logout() {
        localStorage.removeItem('facultyToken');
        toastr.success('Logout Successfully');
        setTimeout(function() {
            window.location.replace('index.php');
        }, 1000);
    }
</script>

</body>

</html>