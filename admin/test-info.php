<!DOCTYPE html>
<html>

<?php include 'include/head.php' ?>

<body>
    <div id="wrapper">

        <?php include 'include/left_menu.php' ?>

        <div id="page-wrapper" class="gray-bg dashbard-1">

            <?php include 'include/header.php' ?>
            <h1 class="title-primary">Test Info</h1>
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper wrapper-content">
                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5><b>Test Name</b> : <span class="test_name"></span></h5>
                                    </div>
                                    <div class="ibox-content">
                                        <section class="result-page-section">
                                            <div class="result-status-box">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <td>Student Group</td>
                                                        <td><span class="student_group"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Category</td>
                                                        <td><span class="category"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Duration</td>
                                                        <td><span class="duration"></span></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Difficulty Level</td>
                                                        <td><span class="difficulty_level"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Questions</td>
                                                        <td><span class="total_questions"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Test Start At</td>
                                                        <td><span class="test_start_at"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Test End At</td>
                                                        <td><span class="test_end_at"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Created At</td>
                                                        <td><span class="created_at"></span></td>
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
            let test_id = window.location.search.substr(9);
            $.ajax({
                url: base_url + '/admin/test/get-info.php',
                type: 'GET',
                data: {
                    token: token,
                    test_id: test_id
                },
                dataType: 'JSON',
                success: function(result) {
                    let incorrect_question = result.total_questions - result.correct_questions;
                    $('#sessionTimeOutModal').modal('hide');
                    $('.test-page-section').hide();
                    $('.result-page-section').show();
                    $('.test_name').text(result.name);
                    $('.result-page-section .student_group').text(result.student_group.name);
                    $('.result-page-section .category').text(result.category.name);
                    $('.result-page-section .duration').text(result.duration);
                    $('.result-page-section .difficulty_level').text(result.difficulty_level);
                    $('.result-page-section .total_questions').text(result.total_questions);
                    $('.result-page-section .is_question_random_order').text(result.is_question_random_order);
                    $('.result-page-section .is_report_show').text(result.is_report_show);
                    $('.result-page-section .is_mandatory_all_question').text(result.is_mandatory_all_question);
                    $('.result-page-section .is_publish').text(result.is_publish);
                    $('.result-page-section .test_start_at').text(result.test_start_at);
                    $('.result-page-section .test_end_at').text(result.test_end_at);
                    $('.result-page-section .created_at').text(result.created_at);

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
    </script>
</body>

</html>