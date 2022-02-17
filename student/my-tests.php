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
                            <!-- <ul class="nav nav-tabs nav-justified">
                                <li class="active"><a data-toggle="tab" href="#selfAssessor">Self Assessor</a>
                                </li>
                                <li><a data-toggle="tab" href="#topicSimulator">Topic Simulator</a>
                                </li>
                                <li><a data-toggle="tab" href="#adminAssign">Admin Assign</a>
                                </li>
                            </ul> -->
                            <div class="tab-content">
                                <!-- <div id="selfAssessor" class="tab-pane">
                                    <div class="row">
                                    </div>
                                </div>
                                <div id="topicSimulator" class="tab-pane">
                                    <div class="row">
                                    </div>
                                </div> -->
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
                let page_no = 1;
                let page_count = 10;
                let selfAssessorData = {
                    token: token,
                    page_count: page_count,
                    page_no: page_no
                }
                $.ajax({
                    url: `${base_url}/student/self-assessor/list.php`,
                    type: 'GET',
                    dataType: 'JSON',
                    data: selfAssessorData,
                    success: function(result) {
                        var col4 = '';
                        $.each(result.result, function(key, value) {
                            col4 +=
                                `<div class="col-md-4">
                                            <div class="test-list-box">
                                                <h5>${value.name}</h5>
                                                <table class="table table-bordered" id="testData">
                                                        <tr>
                                                            <td>Total Questions</td>
                                                            <td>${value.total_questions}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Difficulty Level</td>
                                                            <td>${value.difficulty_level}</td>
                                                        </tr>
                                                        <tr>
                                                        <td>Attempt</td>
                                                        <td>${value.no_of_attemps}</td>
                                                        </tr>
                                                </table>
                                                <a href="test.php?test_id=${value.id}&type=self-assessor" class="btn btn-primary text-right">Start Test</a>
                                            </div>
                                     </div>`;
                        });
                        $('#selfAssessor .row').append(col4);
                    }
                });

                let topicSimulatorData = {
                    token: token,
                    page_count: page_count,
                    page_no: page_no
                }
                $.ajax({
                    url: `${base_url}/student/topic-simulator/list.php`,
                    type: 'GET',
                    dataType: 'JSON',
                    data: topicSimulatorData,
                    success: function(result) {
                        var col4 = '';
                        $.each(result.result, function(key, value) {
                            col4 +=
                                `<div class="col-md-6">
                                            <div class="test-list-box">
                                                <h5>${value.name}</h5>
                                                <table class="table table-bordered" id="testData">
                                                        <tr>
                                                            <td>Total Questions</td>
                                                            <td>${value.total_questions}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Subject</td>
                                                            <td>${value.subject}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Attempt</td>
                                                            <td>${value.no_of_attemps}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Successfully Submitted	</td>
                                                            <td>${value.successfully_submitted}</td>
                                                        </tr>
                                                </table>
                                                <a href="test.php?test_id=${value.id}&type=topic-simulator" class="btn btn-primary text-right">Start Test</a>
                                            </div>
                                     </div>`;
                        });
                        $('#topicSimulator .row').append(col4);
                    }
                });

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
                                testStartBtn = `<a href="test.php?test_id=${value.id}" class="btn btn-primary text-right">Start Test</a>`;
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