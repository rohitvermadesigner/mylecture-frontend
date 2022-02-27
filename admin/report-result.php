<!DOCTYPE html>
<html>

<?php include 'include/head.php' ?>

<body>
    <div id="wrapper">

        <?php include 'include/left_menu.php' ?>

        <div id="page-wrapper" class="gray-bg dashbard-1">

            <?php include 'include/header.php' ?>
            <h1 class="title-primary">Result</h1>
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper wrapper-content">
                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5><b>Test Name</b> : <span class="test-name"></span></h5>
                                        <h5><b>Total</b> : <span class="total-students"></span></h5>
                                    </div>
                                    <div class="ibox-content">
                                        <table class="table mt-4" id="reportData">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Student Name</th>
                                                    <th>Total Questions</th>
                                                    <th>Attempt Questions</th>
                                                    <th>Correct Questions</th>
                                                    <th>Total Marks</th>
                                                    <th>Obtain Marks</th>
                                                    <th>Obtain Percentage</th>
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
            let test_id = window.location.search.substr(9);
            $.ajax({
                url: base_url + '/admin/result/get-result-list.php',
                type: 'GET',
                data: {
                    token: token,
                    test_id: test_id
                },
                dataType: 'JSON',
                success: function(result) {
                    console.log(result);
                    var index = 1;
                    var trHTML = '';
                    $.each(result.result, function(key, value) {
                        subject = value.subject ? value.subject : '-'
                        trHTML +=
                            '<tr><td>' + index++ +
                            '</td><td><a class="font-weight-bold" href="report-result-detail.php?result_id='+  value.id +'">' + value.student +
                            '</a></td><td>' + value.total_questions +
                            '</td><td>' + value.attempt_questions +
                            '</td><td>' + value.correct_questions +
                            '</td><td>' + value.total_marks +
                            '</td><td>' + value.obtain_marks +
                            '</td><td>' + value.obtain_percentage +
                            '</td><td>' + value.created_at + '</td></tr>'
                    });
                    $('#reportData').append(trHTML);
                    $('.total-students').text(result.total_results);
                    $('.test-name').text(result.test_name);
                }
            });
        });
    </script>
</body>

</html>