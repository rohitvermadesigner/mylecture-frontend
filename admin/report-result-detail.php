<!DOCTYPE html>
<html>

<?php include 'include/head.php' ?>

<body>
    <div id="wrapper">

        <?php include 'include/left_menu.php' ?>

        <div id="page-wrapper" class="gray-bg dashbard-1">

            <?php include 'include/header.php' ?>
            <h1 class="title-primary">Result Detail</h1>
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper wrapper-content">
                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5><b>Test Name</b> : <span class="test-name"></span></h5>
                                    </div>
                                    <div class="ibox-content">
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
            let result_id = window.location.search.substr(11);
            $.ajax({
                url: base_url + '/admin/result/get-result.php',
                type: 'GET',
                data: {
                    token: token,
                    result_id: result_id
                },
                dataType: 'JSON',
                success: function(result) {
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
    </script>
</body>

</html>