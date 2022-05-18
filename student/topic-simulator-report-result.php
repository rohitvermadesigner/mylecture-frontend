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
                    <h1 class="float-left">Topic Simulator Report Result</h1>
                </div>
            </div>

            <div class="row m-0 main-row">
                <div class="col-md-12">
                    <div class="white-box">
                        <div class="ibox-title">
                            <h5><b>Test Name</b> : <span class="test-name"></span></h5>
                            <h5><b>Total</b> : <span class="total-students"></span></h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table mt-4" id="reportData">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Total Questions</th>
                                        <th>Attempt Questions</th>
                                        <th>Correct Questions</th>
                                        <th>Total Marks</th>
                                        <th>Obtain Marks</th>
                                        <th>Obtain Percentage</th>
                                        <th>Created at</th>
                                        <th>View Detail</th>
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
    </section>


    <!-- The Modal -->
    <div class="modal" id="resultDetailModal">
        <div class="modal-dialog" style="width:80vw">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Result Detail</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <section class="result-page-section">
                        <div class="result-status-box">
                            <h2>Your scored : <strong class="obtain_percentage"></strong><strong>%</strong></h2>
                            <table class="table table-bordered">
                                <tr>
                                    <td>Attempt Questions</td>
                                    <td><span class="attempt_questions"></span></td>
                                </tr>
                                <tr>
                                    <td>Correct Questions</td>
                                    <td><span class="correct_questions"></span></td>
                                </tr>
                                <tr>
                                    <td>Incorrect Questions</td>
                                    <td><span class="incorrect_questions"></span></td>
                                </tr>
                                <tr>
                                    <td>Obtain Marks</td>
                                    <td><span class="obtain_marks"></span></td>
                                </tr>
                                <tr>
                                    <td>Total Marks</td>
                                    <td><span class="total_marks"></span></td>
                                </tr>
                                <tr>
                                    <td>Total Questions</td>
                                    <td><span class="total_questions"></span></td>
                                </tr>
                            </table>
                        </div>

                        <div class="result-question-box">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <?php include 'include/footer_script.php' ?>

    <script>
        const token = localStorage.getItem("studentToken");
        if (token) {
            var queries = {};
            $.each(document.location.search.substr(1).split('&'), function(c, q) {
                var i = q.split('=');
                queries[i[0].toString()] = i[1].toString();
            });
            var test_id = queries.test_id;
            var testType = queries.type;
            $.ajax({
                url: base_url + '/student/result/get-result-list.php',
                type: 'GET',
                data: {
                    token: token,
                    test_id: test_id,
                    type: testType
                },
                dataType: 'JSON',
                success: function(result) {
                    var index = 1;
                    var trHTML = '';
                    $.each(result.result, function(key, value) {
                        subject = value.subject ? value.subject : '-'
                        trHTML +=
                            '<tr><td>' + index++ +
                            '</a></td><td>' + value.total_questions +
                            '</td><td>' + value.attempt_questions +
                            '</td><td>' + value.correct_questions +
                            '</td><td>' + value.total_marks +
                            '</td><td>' + value.obtain_marks +
                            '</td><td>' + value.obtain_percentage +
                            '</td><td>' + value.created_at +
                            '</td><td><a id="resultDetail" class="btn btn-primary" data-id="' + value.id + '">View</a></td></tr>'
                    });
                    $('#reportData').append(trHTML);
                    $('.total-students').text(result.total_results);
                    $('.test-name').text(result.test_name);
                }
            });

            $('body').on('click', '#resultDetail', function() {
                let result_id = $(this).attr('data-id');
                $.ajax({
                    url: base_url + '/student/result/get-result.php',
                    type: 'GET',
                    data: {
                        token: token,
                        result_id: result_id,
                        type: testType
                    },
                    dataType: 'JSON',
                    success: function(result) {
                        console.log(result);
                        $('#resultDetailModal').modal('show');
                        let incorrect_question = result.total_questions - result.correct_questions;
                        $('#sessionTimeOutModal').modal('hide');
                        $('.test-page-section').hide();
                        $('.result-page-section').show();
                        $('.result-page-section .obtain_percentage').text(result.obtain_percentage);
                        $('.result-page-section .attempt_questions').text(result.attempt_questions);
                        $('.result-page-section .correct_questions').text(result.correct_questions);
                        $('.result-page-section .incorrect_questions').text(incorrect_question);
                        $('.result-page-section .obtain_marks').text(result.obtain_marks);
                        $('.result-page-section .total_marks').text(result.total_marks);
                        $('.result-page-section .total_questions').text(result.total_questions);

                        let questionListTrCount = 1;
                        let questionListTr = '';
                        $('.result-question-box table tbody').html('');
                        $.each(result.questions, function(key, value) {
                            const answerMap = {
                                "1": "a",
                                "2": "b",
                                "3": "c",
                                "4": "d",
                                "5": "e",
                            }
                            questionListTr += `
                            <tr>
                            <td>
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="que">
                                            <p><b>${questionListTrCount++}.</b>
                                                <span>${value.question}</span>
                                            </p>
                                        </div>
                                        <div class="ans-options-result">
                                            <ul>
                                                <li><span>a)</span> <span>${value.option_1}</span></li>
                                                <li><span>b)</span> <span>${value.option_2}</span></li>
                                                <li><span>c)</span> <span>${value.option_3}</span></li>
                                                <li><span>d)</span> <span>${value.option_4}</span></li>

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Attempt Answer : <b class="attempt_answer">${value.attempt_answer ? answerMap[value.attempt_answer] : ''}</b> </p>
                                        <p class="text-success">Correct Answer : <b class="correct_answer">${answerMap[value.correct_answer]}  </b></p>
                                    </div>
                                </div>
                                ${value.description ? 
                                `<fieldset style="background: #bbe4b3;border: 1px solid #78b96c;min-width: inherit;padding: .35em .625em .75em;margin: 0 2px;">
                                    <legend style="background: #a5ce9e;padding: 3px 11px;display: initial;width: initial;margin-bottom: initial;font-size: initial;line-height: initial;border: initial;font-weight: bold;">Description:</legend>
                                    <div>
                                    ${value.description}
                                    </div>
                                </fieldset>` : ''}
                            </td>
                        </tr>
                        `
                        });
                        $('.result-question-box table tbody').append(questionListTr);
                    },
                    error: function(error) {
                        toastr.error(error.responseJSON.message);
                    }
                });
            });


        } else {
            window.location.replace('/');
        }
    </script>

</body>

</html>