<!DOCTYPE html>
<html>

<?php include 'include/head.php' ?>

<body>
    <div id="wrapper">

        <?php include 'include/left_menu.php' ?>

        <div id="page-wrapper" class="gray-bg dashbard-1">

            <?php include 'include/header.php' ?>

            <h1 class="title-primary">Dashboard</h1>

            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper wrapper-content">

                        <div class="row dashboard-4-boxes">
                            <div class="col-lg-4">
                                <div class="ibox">
                                    <div class="ibox-title">
                                        <h5>Total Students</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <i class="fa fa-users" aria-hidden="true"></i>
                                        <a href="student.php">
                                            <h1 class="no-margins" id="totalStudent"></h1>
                                        </a>
                                        <small>Student Online : <b class="text-success" id="totalOnlineStudent"></b></small>
                                    </div>
                                    <a href="create-student.php" class="btn btn-primary btn-block">+ Add New Student</a>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="ibox ">
                                    <div class="ibox-title">
                                        <h5>Total Questions</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <i class="fa fa-book" aria-hidden="true"></i>
                                        <a href="questions.php">
                                            <h1 class="no-margins" id="totalQuestions"></h1>
                                        </a>
                                        <small>&nbsp;</small>
                                    </div>
                                    <a href="create-question.php" class="btn btn-primary btn-block">+ Add New Question</a>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="ibox">
                                    <div class="ibox-title">
                                        <h5>Total Test</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <i class="fa fa-list-alt" aria-hidden="true"></i>
                                        <a href="test-management-module.php">
                                            <h1 class="no-margins" id="totalTests"></h1>
                                        </a>
                                        <small>&nbsp;</small>
                                    </div>
                                    <a href="create-test.php" class="btn btn-primary btn-block">+ Add New Test</a>
                                </div>
                            </div>
                            <!-- <div class="col-lg-4">
                                <div class="ibox ">
                                    <div class="ibox-title">
                                        <h5>Total Products</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                                        <h1 class="no-margins" id="totalProducts"></h1>
                                        <small>&nbsp;</small>
                                    </div>
                                    <button type="button" class="btn btn-primary btn-block">+ Add New Product</button>
                                </div>
                            </div> -->
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Student List</h5>
                                        <ul class="top-right-btn-list">
                                            <li> <b>Total</b> : <span class="total-students"></span></li>
                                        </ul>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="table-responsive">
                                            <table class="table" id="questionData">
                                                <thead>
                                                    <tr>
                                                        <th>S.No.</th>
                                                        <th>Unique Code</th>
                                                        <th>Student Name</th>
                                                        <th>E-mail</th>
                                                        <th>Mobile No.</th>
                                                        <th>Group</th>
                                                        <th>Reg. Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Faculty List</h5>
                                        <ul class="top-right-btn-list">
                                            <li> <b>Total</b> : <span class="total-faculty"></span></li>
                                        </ul>
                                    </div>
                                    <div class="ibox-content">
                                        <table class="table mt-4" id="facultyData">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Mobile Number</th>
                                                    <th>Created At</th>
                                                    <th>Last Login At</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <?php include 'include/footer.php' ?>
                </div>
            </div>

        </div>


    </div>

    <?php include 'include/footer_script.php' ?>

    <script>
        $(function() {
            const token = localStorage.getItem("admin_token");
            $.ajax({
                url: base_url + '/admin/dashboard/stats.php?token= ' + token,
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    $('#totalStudent').text(result.total_students);
                    $('#totalOnlineStudent').text(result.total_online_students);
                    $('#totalQuestions').text(result.total_questions);
                    $('#totalTests').text(result.total_tests);
                    $('#totalProducts').text(result.total_products);
                }
            });

            $.ajax({
                url: base_url + '/admin/student/student-list.php?token=' + token + '&page_no=1&page_count=10',
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    console.log(result.result);
                    var index = 1;
                    var trHTML = '';
                    $.each(result.result, function(key, value) {
                        trHTML +=
                            `<tr>
                            <td>${index++} ${value.is_online ? '<span class="isOnline"></span>' : ''}</td>
                            <td> ${value.student_unique_code}</td>
                            <td>${value.name}</td>
                            <td>${value.email_id}</td>
                            <td>${value.mobile_no}</td>
                            <td>${value.group}</td>
                            <td>${value.date_of_registration}</td>
                            </tr>`;
                    });
                    $('#questionData').append(trHTML);
                    $('.total-students').text(result.total_results);
                }
            });

            $.ajax({
                url: base_url + '/admin/faculty/list.php?token',
                type: 'GET',
                data: {
                    token: token
                },
                dataType: 'JSON',
                success: function(result) {
                    var index = 1;
                    var trHTML = '';
                    $.each(result.result, function(key, value) {
                        trHTML +=
                            '<tr><td>' + index++ +
                            '</td><td>' + value.name + '<span class="user-id d-none">' + value.id +
                            '</td><td>' + value.email_id +
                            '</td><td>' + value.mobile_no +
                            '</td><td>' + value.created_at +
                            '</td><td>' + value.last_login_at +
                            '</td></tr>';
                        if (index === 11) {
                            return false
                        }
                    });
                    $('#facultyData').append(trHTML);
                    $('.total-faculty').text(result.total_results);
                }
            });

            $('body').on('click', '.remove-student', function() {
                var status = confirm("Are you sure you want to delete ?");
                if (status == true) {
                    var userId = $(this).parents('tr').find('td span.student-id').text();
                    let removeUser = {
                        'token': token,
                        'id': userId,
                    }
                    $.ajax({
                        url: base_url + '/admin/student/student-delete.php',
                        type: 'POST',
                        dataType: 'JSON',
                        data: JSON.stringify(removeUser),
                        success: function(response) {
                            message = response.message;
                            toastr.success(message);
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        },
                        error: function(error) {
                            toastr.error(message);
                        }
                    });
                }
            });

        });
    </script>

</body>

</html>