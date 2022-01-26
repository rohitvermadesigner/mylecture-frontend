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
                    <h1 class="float-left">Create Test</h1>
                </div>
            </div>

            <div class="row m-0 mt-3">
                <div class="col-md-12">
                    <div class="white-box">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                                <div class="create-text-page">
                                    <ul class="nav nav-tabs nav-justified">
                                        <li class="active"><a data-toggle="tab" href="#step1">
                                                <span class="main-span">
                                                    <span><i class="fa fa-file-alt" aria-hidden="true"></i></span>
                                                    <span>
                                                        Step 1 <span>Create a New Test</span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                        <li><a data-toggle="tab" href="#step2">
                                                <span class="main-span">
                                                    <span><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                    <span>
                                                        Step 2 <span>Test Setting</span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                        <li><a data-toggle="tab" href="#step3">
                                                <span class="main-span">
                                                    <span><i class="fa fa-question-circle" aria-hidden="true"></i></span>
                                                    <span>
                                                        Step 3 <span>Add Questions</span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="step1" class="tab-pane active">
                                            <form action="" method="post" id="step1Form">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>*Test Name </label>
                                                            <input type="text" class="form-control" name="test_name" />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>*Duration (In Min.) </label>
                                                            <select name="duration" class="form-control">
                                                                <option value="">Select Duration</option>
                                                                <option value="00:10">00:10</option>
                                                                <option value="00:15">00:15</option>
                                                                <option value="00:20">00:20</option>
                                                                <option value="00:25">00:25</option>
                                                                <option value="00:30">00:30</option>
                                                                <option value="00:35">00:35</option>
                                                                <option value="00:40">00:40</option>
                                                                <option value="00:45">00:45</option>
                                                                <option value="00:50">00:50</option>
                                                                <option value="00:55">00:55</option>
                                                                <option value="00:60">00:60</option>
                                                                <option value="00:75">00:75</option>
                                                                <option value="00:90">00:90</option>
                                                                <option value="00:105">00:105</option>
                                                                <option value="00:120">00:120</option>
                                                                <option value="00:135">00:135</option>
                                                                <option value="00:150">00:150</option>
                                                                <option value="00:165">00:165</option>
                                                                <option value="00:180">00:180</option>
                                                                <option value="00:195">00:195</option>
                                                                <option value="00:210">00:210</option>
                                                                <option value="00:225">00:225</option>
                                                                <option value="00:240">00:240</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row m-0">
                                                    <div class="float-right">
                                                        <button type="submit" class="btn btn-primary stepNext">Save and Next</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div id="step2" class="tab-pane fade">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Questions should be random order </label><br>
                                                        <label><input type="radio" name="is_question_random_order" value="1" /> Yes</label> &nbsp;
                                                        <label><input type="radio" name="is_question_random_order" value="0" checked /> No</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Mandatory to attempt all question </label><br>
                                                        <label><input type="radio" name="is_mandatory_all_question" value="1" /> Yes</label> &nbsp;
                                                        <label><input type="radio" name="is_mandatory_all_question" value="0" checked /> No</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Test Timing </label><br>
                                                        <label><input type="radio" name="test_timing_pattern" value="1" /> hh:mm:ss</label> &nbsp;
                                                        <label><input type="radio" name="test_timing_pattern" value="0" checked /> mm:ss</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0">
                                                <div class="float-right">
                                                    <button type="button" class="btn btn-primary stepPrev">Back</button>
                                                    <button type="button" class="btn btn-primary stepNext" id="step2Form">Save and Next</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="step3" class="tab-pane fade">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>*Select Subject </label>
                                                        <select class="form-control" id="subject-list" name="subject_id">
                                                            <option value="">-- Select --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Select Chapter </label>
                                                        <select class="form-control" id="chapter-list" name="chapter_id">
                                                            <option value="">-- Select --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Select Topic </label>
                                                        <select class="form-control" id="topic-lst" name="topic_id">
                                                            <option value="">-- Select --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>*Total Questions </label>
                                                        <input type="number" class="form-control" name="total_questions" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>*Marks for each Question </label>
                                                        <input type="number" class="form-control" name="marks_for_each_question" />
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row m-0">
                                                <div class="float-right">
                                                    <button type="button" class="btn btn-primary stepPrev">Back</button>
                                                    <button type="button" class="btn btn-primary stepNext" id="step3Form">Finish</button>
                                                </div>
                                            </div>
                                        </div>
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

                var testId;
                var categoryList;
                var selectedCategory;
                var instructionList;
                var selectedInstruction;
                var selectedQuestions = [];
                var questionList = [];
                var selectedQuestionsData = [];

                var getAllSubjects = function() {
                    const url = `${base_url}/student/common/subject-list.php`;
                    const paramsData = {
                        token: token
                    }
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'JSON',
                        data: paramsData,
                        success: function(result) {
                            allSubjects = result;
                            // allChapters = result.chapter;
                            if (allSubjects && allSubjects.length > 0) {
                                allSubjects.forEach(val => {
                                    $('#subject-list').append(`<option value="${val.id}">${val.name}</option>`)
                                })
                            }
                        }
                    });
                }
                getAllSubjects();

                $('#subject-list').change(function(val) {
                    subject = $('#subject-list').val();
                    if (subject) {
                        allSubjects.forEach(val => {
                            if (val.id == subject) {
                                $('#chapter-list').html('');
                                $('#chapter-list').append(`<option value="">-- Select --</option>`);
                                val.chapter.forEach(chapter => {
                                    $('#chapter-list').append(`<option value="${chapter.id}">${chapter.name}</option>`)
                                })
                            }

                        })
                    }

                });

                // $('#chapter-list').change(function(val) {
                //     chapter = $('#chapter-list').val();
                //     if (chapter) {
                //         allChapters.forEach(val => {
                //             if (val.id == subject) {
                //                 $('#topic-list').html('');
                //                 $('#topic-list').append(`<option value="">-- Select --</option>`);
                //                 val.topic.forEach(topic => {
                //                     $('#topic-list').append(`<option value="${topic.id}">${topic.name}</option>`)
                //                 })
                //             }

                //         })
                //     }

                // });

                // ***************************
                //  Test Form Submit Section
                // ***************************
                $('#step1Form').validate({
                    rules: {
                        test_name: "required",
                        duration: "required",
                    },
                    submitHandler: function(form) {
                        setp_1_form_submit();
                    }
                });

                function setp_1_form_submit() {
                    let post_data = {
                        token: token,
                        test_name: $('#step1Form [name=test_name]').val(),
                        duration: $('#step1Form [name=duration]').val(),
                    }
                    if (testId) {
                        post_data.test_id = testId;
                        $.ajax({
                            url: base_url + '/student/topic-simulator/step-1/add.php',
                            type: 'POST',
                            data: JSON.stringify(post_data),
                            dataType: 'JSON',
                            success: function(result) {
                                toastr.success(result.message);
                                $('.nav-tabs a[href="#step2"]').tab('show');
                            },
                            error: function(error) {
                                toastr.error(error.responseJSON.message);
                            }
                        });
                    } else {
                        $.ajax({
                            url: base_url + '/student/topic-simulator/step-1/add.php',
                            type: 'POST',
                            data: JSON.stringify(post_data),
                            dataType: 'JSON',
                            success: function(result) {
                                toastr.success(result.message);
                                testId = result.id;
                                $('.nav-tabs a[href="#step2"]').tab('show');
                            },
                            error: function(error) {
                                toastr.error(error.responseJSON.message);
                            }
                        });
                    }
                }

                //  test step2 begin here
                $('#step2Form').click(function() {
                    let post_data = {
                        "token": token,
                        "test_id": testId,
                        "is_question_random_order": $('[name=is_question_random_order]:checked').val(),
                        "is_mandatory_all_question": $('[name=is_mandatory_all_question]:checked').val(),
                        "test_timing_pattern": $('[name=test_timing_pattern]:checked').val(),
                    }
                    console.log(post_data);
                    $.ajax({
                        url: base_url + '/student/topic-simulator/step-2/add.php',
                        type: 'POST',
                        data: JSON.stringify(post_data),
                        dataType: 'JSON',
                        success: function(result) {
                            toastr.success(result.message);
                            $('.nav-tabs a[href="#step3"]').tab('show');
                        },
                        error: function(error) {
                            toastr.error(error.responseJSON.message);
                        }
                    });
                });


                //  test step3 begin here
                $('#step3Form').click(function() {


                    let post_data = {
                        token: token,
                        test_id: testId,
                        subject_id: $('#step3 [name=subject_id] option:selected').val(),
                        chapter_id: $('#step3 [name=chapter_id] option:selected').val(),
                        topic_id: $('#step3 [name=topic_id] option:selected').val(),
                        total_questions: $('#step3 [name=total_questions]').val(),
                        marks_for_each_question: $('#step3 [name=marks_for_each_question]').val(),
                    }
                    $.ajax({
                        url: base_url + '/student/topic-simulator/step-3/add.php',
                        type: 'POST',
                        data: JSON.stringify(post_data),
                        dataType: 'JSON',
                        success: function(result) {
                            toastr.success(result.message);
                            setTimeout(function() {
                                window.location.replace('topic-simulator.php');
                            }, 1000);
                        },
                        error: function(error) {
                            toastr.error(error.responseJSON.message);
                        }
                    });

                });

            } else {
                window.location.replace('/');
            }
        });
    </script>

</body>

</html>