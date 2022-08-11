<!DOCTYPE html>
<html lang="en">

<?php include 'include/head.php' ?>

<body>


    <header class="test-header" style="justify-content: space-between;">
        <div class="left-wrap">
            <a href="dashboard.php">
                <img src="assets/images/gems-next-logo.jpg" alt="" style="width: 78px;" />
            </a>
        </div>
        <div class="right-wrap back-btn-list">
            <a href="dashboard.php" class="btn btn-primary btn-xs">Dashboard </a>
            <a href="self-assessor.php" class="btn btn-primary">Self Assessor </a>
            <a href="topic-simulator.php" class="btn btn-primary">Topic Simulator </a>
        </div>
    </header>

    <section class="test-page-section">
        <div class="container">
            <div class="condidate-info">
                <div class="row">
                    <div class="col-md-9">
                        <div class="table-responsive">
                            <table>
                                <tbody>
                                    <tr>
                                        <td style="padding: 0px 5px;">Candidate Name</td>
                                        <td style="width: 54%;"> : <span style="color: #f7931e; font-weight: bold; " id="student_name"></span></td>
                                        <td style="padding: 0px 5px;">Total marks</td>
                                        <td> : <span style="color: #f7931e; font-weight: bold" id="total_marks"></span></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0px 5px;">Exam Name</td>
                                        <td> : <span style="color: #f7931e; font-weight: bold" id="test_name"></span>
                                        </td>
                                        <td style="padding: 0px 5px;">Total Questions</td>
                                        <td>
                                            : <span class="timer-title time-started" id="total_questions"></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="remaining-time" id="test_duration" style="font-size: 28px;text-align: right;"></div>
                    </div>
                </div>
            </div>
            <div class="test-process test-process-1 d-custom-block">
                <div class="row">
                    <div class="col-md-8">
                        <div class="question-wrapper">
                            <div class="question-wrapper-inner">
                            </div>

                            <div class="clearfix"></div>
                            <button class="prev-btn btn btn-primary" disabled="disabled">Prev</button>
                            <button class="skip-btn btn btn-warning">Skip</button>
                            <button class="save-next-btn btn btn-success">Save & Next</button>
                            <button class="btn btn-secondary clear-btn" id="clear">Clear</button>
                            <hr />
                            <div style="display: flex;justify-content: flex-end;">
                                <button class="btn btn-success submitTest">Submit</button>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="pt-3">

                            <div class="panel panel-default mt-3">
                                <div class="panel-body" style="height:300px;overflow-y:scroll;">
                                    <ul class="test-questions-btns-wrapper">

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="test-process test-process-2">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <h3 class="text-center">Exam Summary</h3>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No of Questions</th>
                                        <th>Answered</th>
                                        <th>Not Answered</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="align_centre">
                                        <td class="lblTotalQuestion">20</td>
                                        <td class="lblTotalSaved">12</td>
                                        <td class="lblNotVisited">8</td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <div class="col-md-12 text-center">
                                <h4 class="mb-4"> Are you sure you want to submit for final marking?<br>No changes will be allowed after submission. <br> </h4>
                                <a class="btn btn-primary" id="submit-exam2">Yes</a> <a class="btn btn-secondary" id="btnNoSubmitConfirm">No</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="test-process test-process-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12 exam-thankyou">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="col-md-12 text-center">
                                        <h4> Thank you, Submitted Successfully.</h4>
                                        <a class="btn btn-primary" id="submit-exam3">View Result</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="test-process test-process-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="tbl">
                                <thead>

                                    <tr>
                                        <th colspan="4" class="text-center">Scrore Card</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Total Question</td>
                                        <th id="lblRTotalQuestion">20</th>
                                        <td>Total Attempted</td>
                                        <th id="lblRTotalAttempted">12</th>
                                    </tr>
                                    <tr>
                                        <td>Correct Answers</td>
                                        <th id="lblRTotalCorrect">10</th>
                                        <td>Incorrect Answers</td>
                                        <th id="lblRTotalWrong">2</th>
                                    </tr>
                                    <tr>
                                        <td>Score</td>
                                        <td id="lblRScore">10</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="result-page-section">
        <div class="container">
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
                <!-- <div class="table-responsive"> -->
                <table class="table table-bordered">
                    <tbody></tbody>
                </table>
                <!-- </div> -->
            </div>
        </div>
    </section>


    <!-- Modal -->
    <div id="sessionTimeOutModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Session Timeout</h4>
                </div>
                <div class="modal-body">
                    <p class="text-center">Your session has been expired!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary submitTest">Submit</button>
                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                </div>
            </div>

        </div>
    </div>

    <?php include 'include/footer_script.php' ?>
    <script>
        let token = localStorage.getItem("studentToken");

        function getParameterByName(name, url = window.location.href) {
            name = name.replace(/[\[\]]/g, '\\$&');
            var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, ' '));
        }
        var testID = getParameterByName('test_id');
        var testType = getParameterByName('type');
        if (token) {
            let totalQuestionCount = 0;
            let intervalCounter;
            let getTestQuestionUrl = `${base_url}/student/test/get-test-questions.php`
            let getTestQuestionParams = {
                token: token,
                test_id: testID,
                type: testType
            }
            if (testType == 'admin-assign-test') {
                getTestQuestionUrl = `${base_url}/student/test/get-admin-assign-test-questions.php`
                delete getTestQuestionParams.type;
            }
            $.ajax({
                url: getTestQuestionUrl,
                type: 'GET',
                dataType: 'JSON',
                data: getTestQuestionParams,
                success: function(result) {
                    $("#student_name").text(result.student_name);
                    $("#test_name").text(result.test_name);
                    $("#total_marks").text(result.total_marks);
                    $("#total_questions").text(result.total_questions);
                    let indexCount = 1;
                    totalQuestionCount = result.questions.length;
                    $.each(result.questions, function(key, value) {
                        let question = `
                        <div class="question-item ${key == 0 ? 'active' : ''}" data-id="${value.id}" question-count="${key}">
                            <div class="que">
                                <p><b>${indexCount++}.</b>
                                    <span>${value.question}</span>
                                </p>
                            </div>
                            <div class="ans-options">
                                <ul>
                                    <li><label style="display: flex;margin-bottom: 0;"><input style="margin-right:10px;" type="radio" name="select-option-${value.id}" value="1"><span style="margin-right:5px;">a)</span> <span>${value.option_1}</span></label></li>
                                    <li><label style="display: flex;margin-bottom: 0;"><input style="margin-right:10px;" type="radio" name="select-option-${value.id}" value="2"><span style="margin-right:5px;">b)</span> <span>${value.option_2}</span></label></li>
                                    <li><label style="display: flex;margin-bottom: 0;"><input style="margin-right:10px;" type="radio" name="select-option-${value.id}" value="3"><span style="margin-right:5px;">c)</span> <span>${value.option_3}</span></label></li>
                                    <li><label style="display: flex;margin-bottom: 0;"><input style="margin-right:10px;" type="radio" name="select-option-${value.id}" value="4"><span style="margin-right:5px;">d)</span> <span>${value.option_4}</span></label></li>
                                </ul>
                            </div>
                        </div>
                        `
                        $('.question-wrapper-inner').append(question);

                        // ** right btn begin here ** //
                        let stepBtn = `
                            <li class="btn step-btn ${key == 0 ? 'selected' : ''}" data-id="${value.id}" step-count="${key}">
                                ${key + 1}
                            </li>
                        `;
                        $('.test-questions-btns-wrapper').append(stepBtn);
                    });

                    startCoundown(result.test_duration);
                }
            });

            $(".test-page-section").on('click', '.step-btn', function() {
                var $this = $(this);
                var question_id = $this.attr('data-id');
                $(".question-item").removeClass("active");
                $(".question-item[data-id=" + question_id + "]").addClass('active');
                $(".step-btn").removeClass("selected");
                $(".step-btn[data-id=" + question_id + "]").addClass('selected');
                markStepColor();
                checkNextPrevButton();
            });

            $(".clear-btn").click(function() {
                $(".question-item.active .ans-options li input").each(function() {
                    $(this).prop('checked', false);
                })
            });

            $(".prev-btn").click(function() {
                var sequenceCount = $(".question-item.active").attr('question-count');
                $(".question-item").removeClass("active");
                let newSequenceCount = parseInt(sequenceCount) - 1;
                $(".question-item[question-count=" + newSequenceCount + "]").addClass('active');
                $(".step-btn").removeClass("selected");
                $(".step-btn[step-count=" + newSequenceCount + "]").addClass('selected');
                $(".save-next-btn").prop('disabled', false);
                $(".skip-btn").prop('disabled', false);
                if (newSequenceCount == 0) {
                    $(".prev-btn").prop('disabled', true);
                }
                markStepColor();
            })

            $(".save-next-btn").click(function() {
                var sequenceCount = $(".question-item.active").attr('question-count');
                $(".question-item").removeClass("active");
                let newSequenceCount = parseInt(sequenceCount) + 1;
                $(".question-item[question-count=" + newSequenceCount + "]").addClass('active');
                $(".step-btn").removeClass("selected");
                $(".step-btn[step-count=" + newSequenceCount + "]").addClass('selected');
                $(".prev-btn").prop('disabled', false);
                if (totalQuestionCount - 1 == newSequenceCount) {
                    $(".save-next-btn").prop('disabled', true);
                    $(".skip-btn").prop('disabled', true);
                }
                markStepColor();
            })

            $(".skip-btn").click(function() {
                $(".question-item.active .ans-options li input").each(function() {
                    $(this).prop('checked', false);
                })

                var sequenceCount = $(".question-item.active").attr('question-count');
                $(".question-item").removeClass("active");
                let newSequenceCount = parseInt(sequenceCount) + 1;
                $(".question-item[question-count=" + newSequenceCount + "]").addClass('active');
                $(".step-btn").removeClass("selected");
                $(".step-btn[step-count=" + newSequenceCount + "]").addClass('selected');
                $(".prev-btn").prop('disabled', false);
                if (totalQuestionCount - 1 == newSequenceCount) {
                    $(".save-next-btn").prop('disabled', true);
                    $(".skip-btn").prop('disabled', true);
                }
                markStepColor();
            });

            function markStepColor() {
                let markQuestionArray = [];
                $(".question-item").each(function() {
                    var $this = $(this)
                    selectedValue = $this.find('input:checked').val();
                    if (selectedValue) {
                        markQuestionArray.push($this.attr('data-id'));
                    }
                });

                $('.test-questions-btns-wrapper .step-btn').each(function() {
                    $(this).removeClass('answer-filled')
                    if (markQuestionArray.indexOf($(this).attr('data-id')) > -1) {
                        $(this).addClass('answer-filled')
                    }
                })
            }

            function checkNextPrevButton() {
                var sequenceCount = $(".question-item.active").attr('question-count');
                if (totalQuestionCount - 1 == sequenceCount) {
                    $(".save-next-btn").prop('disabled', true);
                    $(".skip-btn").prop('disabled', true);
                } else {
                    $(".save-next-btn").prop('disabled', false);
                    $(".skip-btn").prop('disabled', false)
                }
                if (sequenceCount == 0) {
                    $(".prev-btn").prop('disabled', true);
                } else {
                    $(".prev-btn").prop('disabled', false);
                }
            }

            function startCoundown(test_duration) {
                let count = test_duration.split(":")[1]
                let countDownDate = addMinutes(new Date(), count)
                intervalCounter = setInterval(function() {

                    // Get today's date and time
                    var now = new Date().getTime();

                    // Find the distance between now and the count down date
                    var time = countDownDate - now;

                    // Time calculations for days, hours, minutes and seconds
                    var hours = Math.floor((time % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((time % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((time % (1000 * 60)) / 1000);

                    // Display the result in the element with id="demo"
                    $("#test_duration").text(`${twoDigit(hours)}:${twoDigit(minutes)}:${twoDigit(seconds)}`)

                    if ($('#test_duration').text() == '00:01:50') {
                        $('#sessionTimeOutModal').modal('show');
                    }

                    // If the count down is finished, write some text
                    if (time <= 0) {
                        clearInterval(intervalCounter);
                        submitTest();
                        $("#test_duration").text();
                    }
                }, 1000);
            }

            function twoDigit(num) {
                return num >= 9 ? num : `0${num}`;
            }

            function addMinutes(date, minutes) {
                return new Date(date.getTime() + minutes * 60000);
            }


            const submitTest = function() {
                let questionsList = [];
                $(".question-wrapper-inner .question-item").each(function(v) {
                    var questionObj = {
                        id: $(this).attr('data-id'),
                        answer: $(this).find('li input[type=radio]:checked').val() || ''
                    }
                    questionsList.push(questionObj);
                });
                let post_questions = {
                    token: token,
                    test_id: testID,
                    type: testType,
                    questions: questionsList
                }
                debugger;
                let submitTestUrl = base_url + '/student/submit-test/self-declared-test.php';
                if (testType == 'admin-assign-test') {
                    submitTestUrl = base_url + '/student/submit-test/admin-declared-test.php';
                }
                $.ajax({
                    url: submitTestUrl,
                    type: 'POST',
                    data: JSON.stringify(post_questions),
                    dataType: 'JSON',
                    success: function(result) {
                        clearInterval(intervalCounter);
                        toastr.success("Test Successfully submitted");
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
            }
            $('.submitTest').click(function() {
                submitTest();
            });

            $('body').on('click', '.pagination.test-questions-btns-wrapper li a', function() {
                $('.prev').prop("disabled", false);
                stepIndex = $(this).attr('data-href');
                $('.question-wrapper-inner').find('.step').removeClass('active');
                $('.step.step' + $(this).attr('data-href')).addClass('active');
            });

        } else {
            window.location.replace('/');
        }

        document.addEventListener('contextmenu', event => event.preventDefault());

        $('body').bind('copy paste', function(e) {
            e.preventDefault();
            return false;
        });
    </script>

</body>

</html>