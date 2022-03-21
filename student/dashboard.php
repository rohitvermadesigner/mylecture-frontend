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
                <div class="col-md-4">
                    <div class="white-box">
                        <a href="self-assessor.php" class="dashboard-stats">
                            <p>Self Assessor Test</p>
                            <span id="self_assessor_test_count">0</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="white-box">
                        <a href="topic-simulator.php" class="dashboard-stats">
                            <p>Topic Simulator Test</p>
                            <span id="topic_simulator_test_count">0</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="white-box">
                        <a href="my-tests.php" class="dashboard-stats">
                            <p>Admin Assign Test</p>
                            <span id="admin_assign_test_count">0</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-8 mt-5">
                    <div class="white-box">
                        <form id="manageProfile">
                            <div class="student-detail-box">
                                <h4>Manage Profile</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <img src="assets/images/user-icon.png" alt="" style="width: 80px;">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Full Name</label>
                                            <input type="text" class="form-control" name="name" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>DOB</label>
                                            <input type="date" class="form-control" name="date_of_birth" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select name="gender" class="form-control">
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" name="email_id" disabled />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mobile</label>
                                            <input type="text" class="form-control" name="mobile_no" disabled />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="address" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>State</label>
                                            <input type="text" class="form-control" name="state" onkeydown="return /[a-z]/i.test(event.key)" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" class="form-control" name="city" onkeydown="return /[a-z]/i.test(event.key)" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <input type="text" class="form-control" name="country" onkeydown="return /[a-z]/i.test(event.key)" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pincode</label>
                                            <input type="text" class="form-control" name="pincode" />
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary float-right">Update</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4 mt-5">
                    <div class="white-box">
                        <form id="changePassword">
                            <div class="student-detail-box">
                                <h4>Change Password</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Current Password</label>
                                            <input type="password" class="form-control" name="old_password" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>New Password</label>
                                            <input type="password" class="form-control" name="new_password" id="new_password" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input type="password" class="form-control" name="confirm_password" />
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary float-right">Update</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- <div class="col-md-12 mt-5">
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
                </div> -->
            </div>
        </div>
    </section>


    <?php include 'include/footer_script.php' ?>

    <script>
        const token = localStorage.getItem("studentToken");
        if (token) {
            $.ajax({
                url: `${base_url}/student/dashboard/dashboard.php`,
                type: 'GET',
                dataType: 'JSON',
                data: {
                    token: token
                },
                success: function(result) {
                    $('#self_assessor_test_count').text(result.self_assessor_test_count);
                    $('#topic_simulator_test_count').text(result.topic_simulator_test_count);
                    $('#admin_assign_test_count').text(result.admin_assign_test_count);
                }
            });

            $.ajax({
                url: `${base_url}/student/get-info.php`,
                type: 'GET',
                dataType: 'JSON',
                data: {
                    token: token
                },
                success: function(result) {
                    $('[name=name]').val(result.name);
                    $('[name=email_id]').val(result.email_id);
                    $('[name=mobile_no]').val(result.mobile_no);
                    $('[name=group_id]').val(result.group_id);
                    $('[name=gender]').val(result.gender);
                    $('[name=date_of_birth]').val(result.date_of_birth);
                    $('[name=address]').val(result.address);
                    $('[name=state]').val(result.state);
                    $('[name=city]').val(result.city);
                    $('[name=country]').val(result.country);
                    $('[name=pincode]').val(result.pincode);
                }
            });

            $('#manageProfile').validate({
                rules: {
                    name: "required",
                    date_of_birth: "required",
                    email_id: "required",
                    mobile_no: "required",
                    address: "required",
                    state: "required",
                    city: "required",
                    country: "required",
                    pincode: "required",
                },
                submitHandler: function(form) {
                    manageProfileSubmit();
                }
            });

            const manageProfileSubmit = function() {
                let post_data = {
                    token: token,
                    info: {
                        name: $('[name=name]').val(),
                        gender: $('[name=gender]').val(),
                        date_of_birth: $('[name=date_of_birth]').val(),
                        address: $('[name=address]').val(),
                        state: $('[name=state]').val(),
                        city: $('[name=city]').val(),
                        country: $('[name=country]').val(),
                        pincode: $('[name=pincode]').val(),
                    }
                }
                $.ajax({
                    url: base_url + '/student/update-info.php',
                    type: 'POST',
                    data: JSON.stringify(post_data),
                    dataType: 'JSON',
                    success: function(result) {
                        console.log(result);
                        toastr.success(result.message);
                    },
                    error: function(error) {
                        toastr.error(error.responseJSON.message);
                    }
                });
            }

            $('#changePassword').validate({
                rules: {
                    old_password: "required",
                    new_password: "required",
                    confirm_password: {
                        equalTo : "#new_password"
                    },
                },
                submitHandler: function(form) {
                    changePasswordSubmit();
                }
            });

            const changePasswordSubmit = function() {
                let post_data = {
                    token: token,
                    old_password: $('[name=old_password]').val(),
                    new_password: $('[name=new_password]').val(),
                }
                $.ajax({
                    url: base_url + '/student/change-password.php',
                    type: 'POST',
                    data: JSON.stringify(post_data),
                    dataType: 'JSON',
                    success: function(result) {
                        toastr.success(result.message);
                        $('[name=old_password]').val('');
                        $('[name=new_password]').val('');
                        $('[name=confirm_password]').val('');
                    },
                    error: function(error) {
                        toastr.error(error.responseJSON.message);
                    }
                });
            }

        } else {
            window.location.replace('/');
        }
    </script>

</body>

</html>