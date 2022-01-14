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
                            <div class="col-lg-3">
                                <div class="ibox">
                                    <div class="ibox-title">
                                        <h5>Total Candidates</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <i class="fa fa-users" aria-hidden="true"></i>
                                        <h1 class="no-margins" id="totalStudent"></h1>
                                        <small>Candidate Online : <b class="text-success" id="totalOnlineStudent"></b></small>
                                    </div>
                                    <button type="button" class="btn btn-primary btn-block">+ Add New Candidate</button>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="ibox ">
                                    <div class="ibox-title">
                                        <h5>Total Questions</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <i class="fa fa-book" aria-hidden="true"></i>
                                        <h1 class="no-margins" id="totalQuestions"></h1>
                                        <small>&nbsp;</small>
                                    </div>
                                    <button type="button" class="btn btn-primary btn-block">+ Add New Question</button>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="ibox ">
                                    <div class="ibox-title">
                                        <h5>Total Test</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <i class="fa fa-list-alt" aria-hidden="true"></i>
                                        <h1 class="no-margins" id="totalTests"></h1>
                                        <small>&nbsp;</small>
                                    </div>
                                    <a href="create-test.php" class="btn btn-primary btn-block">+ Add New Test</a>
                                </div>
                            </div>
                            <div class="col-lg-3">
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
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Candidate List</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="table-responsive">
                                        <table class="table" id="questionData">
                                                <thead>
                                                    <tr>
                                                        <th><input type="checkbox"></th>
                                                        <th>S.No.</th>
                                                        <th>Candidate Name</th>
                                                        <th>E-mail</th>
                                                        <th>Mobile No.</th>
                                                        <th>Group</th>
                                                        <th>Reg. Date</th>
                                                        <!-- <th>Action</th> -->
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
                    </div>
                    <?php include 'include/footer.php' ?>
                </div>
            </div>

        </div>


    </div>

    <?php include 'include/footer_script.php' ?>

    <script>
        $(function() {
            const tokanInfoConst = localStorage.getItem("admin_token");
            $.ajax({
                url: base_url + '/admin/dashboard/stats.php?token= ' + tokanInfoConst,
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
                url: base_url + '/admin/student/student-list.php?token='+ tokanInfoConst + '&page_no=1&page_count=10',                
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    // console.log(result.result);
                    var index =1;
                    var trHTML = '';
                    $.each(result.result, function(key, value) {
                        trHTML +=
                            '<tr><td class="text-center">' +
                            '</td><td>' + index++ +
                            '</td><td>' + value.name + '<span class="question-id d-none">' + value.id +
                            '</td><td>' + value.email_id +
                            '</td><td>' + value.mobile_no +
                            '</td><td>' + value.group +
                            '</td><td>' + value.date_of_registration + '</td></tr>';
                            // '</td><td><span class="remove-question" title="Remove Question"><i class="fa fa-trash-alt"></i></span><span><i class="far fa-edit"></i></span></td></tr>';
                    });
                    $('#questionData').append(trHTML);
                }
            });
        });
    </script>

</body>
</html>