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
                    <h1 class="float-left">Admin Assigned Report</h1>
                </div>
            </div>

            <div class="row m-0 main-row">
                <div class="col-md-12">
                    <div class="white-box">
                        <div class="ibox-title">
                            <h5><b>Total</b> : <span class="total-students"></span></h5>
                        </div>
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
    </section>


    <?php include 'include/footer_script.php' ?>

    <script>
        const token = localStorage.getItem("studentToken");
        if (token) {
            $.ajax({
                url: base_url + '/student/result/get-admin-assigned-performed-test.php',
                type: 'GET',
                data: {
                    token: token
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
                            '</td><td><a class="font-weight-bold" href="admin-assigned-report-result.php?test_id=' + value.id + '&type=admin-assigned">' + value.name +
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
        } else {
            window.location.replace('/');
        }
    </script>

</body>

</html>