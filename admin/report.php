<!DOCTYPE html>
<html>

<?php include 'include/head.php' ?>

<body>
    <div id="wrapper">

        <?php include 'include/left_menu.php' ?>

        <div id="page-wrapper" class="gray-bg dashbard-1">

            <?php include 'include/header.php' ?>
            <h1 class="title-primary">Report</h1>
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper wrapper-content">
                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5><b>Total</b> : <span class="total-students"></span></h5>
                                    </div>
                                    <div class="ibox-content">
                                        <table class="table mt-4" id="reportData">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Test Name</th>
                                                    <th>Duration</th>
                                                    <th>Category</th>
                                                    <th>Student Group</th>
                                                    <th>Total Questions</th>
                                                    <th>Created at</th>
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
                url: base_url + '/admin/result/get-admin-assigned-performed-test.php',
                type: 'GET',
                data: {
                    token: token
                },
                dataType: 'JSON',
                success: function(result) {
                    var index = 1;
                    var trHTML = '';
                    $.each(result.result, function(key, value) {
                        subject = value.subject ? value.subject : '-'
                        trHTML +=
                            '<tr><td>' + index++ +
                            '</td><td><a class="font-weight-bold" href="report-result.php?test_id='+ value.id +'">' + value.name + 
                            '</a></td><td>' + value.duration +
                            '</td><td>' + value.category +
                            '</td><td>' + value.student_group +
                            '</td><td>' + value.total_questions +
                            '</td><td>' + value.created_at + '</td></tr>'
                    });
                    $('#reportData').append(trHTML);
                    $('.total-students').text(result.total_results);
                }
            });
        });
    </script>
</body>

</html>