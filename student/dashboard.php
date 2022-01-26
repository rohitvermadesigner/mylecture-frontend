<!DOCTYPE html>
<html lang="en">

<?php include 'include/head.php' ?>

<body>

    <section class="user-dashboard">
        <?php include 'include/left_menu.php' ?>
        <div class="dashboard-container">
            <?php include 'include/header.php' ?>
            <div class="dashboard-title">
                <div class="overflow-hidden">
                    <h1 class="float-left">Student Dashboard</h1>
                </div>
            </div>

            <div class="row m-0 main-row">
                <!-- <div class="col-md-6">
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
                </div> -->
                <div class="col-md-8">
                    <div class="white-box">
                        <div class="student-detail-box">
                            <h4>Manage Profile</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <img src="assets/images/user-icon.png" alt="" style="width: 80px;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="text" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>DOB</label>
                                        <input type="text" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>College</label>
                                        <input type="text" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Course</label>
                                        <input type="text" class="form-control" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn btn-primary float-right">Update</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="white-box">
                        <div class="student-detail-box">
                            <h4>Change Password</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Current Password</label>
                                        <input type="text" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input type="text" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="text" class="form-control" />
                                    </div>
                                </div>
                              
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn btn-primary float-right">Update</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-5">
                    <div class="white-box">
                        <h4>My Performance</h4>
                        <hr>
                        <img src="assets/images/graph.jpg" class="img-fluid" alt="">

                        <div class="text-analysis-box">
                            <h4>Test Analysis</h4>
                            <hr>
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
                            <h4>Report Card</h4>
                            <hr>
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


    <?php include 'include/footer_script.php' ?>

    <script>
        const token = localStorage.getItem("studentToken");
        if (token) {} else {
            window.location.replace('/');
        }
    </script>

</body>

</html>