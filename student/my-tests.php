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
                    <h1 class="float-left">My Tests</h1>
                </div>
            </div>
            <div class="row m-0 mt-3">
                <div class="col-md-12">
                    <div class="white-box box-boom">
                        <div class="my-tests-page">
                            <div class="tab-content">
                                <div id="adminAssign" class="tab-pane active">
                                    <div class="row">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'include/footer_script.php' ?>

    <script>
        $(function() {
            const token = localStorage.getItem("studentToken");
            if (token) {
                $.ajax({
                    url: `${base_url}/student/test/admin-assign-test-list.php`,
                    type: 'GET',
                    dataType: 'JSON',
                    data: {
                        token: token
                    },
                    success: function(result) {
                        console.log(result);
                        var col4 = '';
                        var testStartBtn = `<a class="btn btn-primary text-right" disabled>Start Test</a>`;
                        $.each(result.result, function(key, value) {
                            if (value.is_start_test_button_active) {
                                testStartBtn = `<a href="test.php?test_id=${value.id}&type=admin-assign-test" class="btn btn-primary text-right">Start Test</a>`;
                            }
                            col4 +=
                                `<div class="col-md-6">
                                            <div class="test-list-box">
                                                <h5>${value.name}</h5>
                                                <table class="table table-bordered" id="testData">
                                                        <tr>
                                                            <td>Duration</td>
                                                            <td>${value.duration}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Difficulty Level</td>
                                                            <td>${value.difficulty_level}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Total Questions</td>
                                                            <td>${value.total_questions}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Test Start</td>
                                                            <td>${value.test_start_at}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Test End</td>
                                                            <td>${value.test_end_at}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Last Attempt at</td>
                                                            <td>${value.last_attempt_at}</td>
                                                        </tr>
                                                </table>
                                                <div>${testStartBtn}</div>        
                                            </div>
                                     </div>`;
                        });
                        $('#adminAssign .row').append(col4);
                    }
                });

            } else {
                window.location.replace('/');
            }
        });
    </script>

</body>

</html>