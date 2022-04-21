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
                    <h1 class="float-left">Create Topic Simulator Test</h1>
                </div>
            </div>

            <ul class="breadcrumb">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="topic-simulator.php">Topic Simulator</a></li>
                <li>Create Topic Simulator Test</li>
            </ul>

            <div class="row m-0 mt-3">
                <div class="col-md-12">
                    <div class="white-box">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                                <div class="create-text-page">

                                    <form id="topicForm">
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
                                                        <option value="00:30">00:30</option>
                                                        <option value="00:60">00:60</option>
                                                        <option value="00:90">00:90</option>
                                                        <option value="00:120">00:120</option>
                                                        <option value="00:150">00:150</option>
                                                        <option value="00:180">00:180</option>
                                                    </select>
                                                </div>
                                            </div>
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

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Select Phase</label>
                                                    <select class="form-control" id="phase-filter" name="phase_id">
                                                        <option value="">-- Select Phase --</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Select Subject</label>
                                                    <select class="form-control" id="subject-filter" name="subject_id">
                                                        <option value="">-- Select Subject --</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Select Topic</label>
                                                    <select class="form-control" id="topic-filter" name="topic_id">
                                                        <option value="">-- Select Topic --</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Keyword </label>
                                                    <input type="text" class="form-control" name="keyword" />
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>*Total Questions </label>
                                                    <input type="number" class="form-control" name="total_questions" value="30" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>*Marks for each correct question </label>
                                                    <input type="number" class="form-control" name="marks_for_correct_question" value="5" />
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>*Marks for incorrect question </label>
                                                    <input type="number" class="form-control" name="marks_for_incorrect_question" value="-1" />
                                                </div>
                                            </div> -->

                                        </div>
                                        <div class="row m-0">
                                            <div class="float-right">
                                                <button type="submit" class="btn btn-primary stepNext">Submit</button>
                                            </div>
                                        </div>
                                    </form>

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
                let phaseArray = [];
                let subjectArray = [];
                $('#topicForm').validate({
                    rules: {
                        test_name: 'required',
                        duration: 'required',
                        is_question_random_order: 'required',
                        is_mandatory_all_question: 'required',
                        phase_id: 'required',
                        subject_id: 'required',
                        chapter_id: 'required',
                        topic_id: 'required',
                        total_questions: 'required',
                        marks_for_correct_question: 'required',
                        // marks_for_incorrect_question: 'required'
                    },
                    submitHandler: function() {
                        createTopicSubmit();
                    }
                });

                createTopicSubmit = function() {
                    let update_data = {
                        "token": token,
                        "test_name": $('[name=test_name]').val(),
                        "duration": $('[name=duration]').val(),
                        "is_question_random_order": $('[name=is_question_random_order]').val(),
                        "is_mandatory_all_question": $('[name=is_mandatory_all_question]').val(),
                        "subject_id": $('[name=subject_id]').val(),
                        "topic_id": $('[name=topic_id]').val(),
                        "keyword": $('[name=keyword]').val(),
                        "total_questions": $('[name=total_questions]').val(),
                        "marks_for_correct_question": $('[name=marks_for_correct_question]').val(),
                    }
                    console.log(update_data);
                    $.ajax({
                        url: base_url + '/student/topic-simulator/add.php',
                        type: 'POST',
                        data: JSON.stringify(update_data),
                        dataType: 'JSON',
                        success: function(result) {
                            toastr.success(result.message);
                            window.location.replace('topic-simulator.php');
                        },
                        error: function(error) {
                            toastr.error(error.responseJSON.message);
                        }
                    });
                }

                var getAllSubjects = function() {
                    $.ajax({
                        url: `${base_url}/student/common/subject-list.php`,
                        type: 'GET',
                        dataType: 'JSON',
                        data: {
                            token: token
                        },
                        success: function(result) {
                            phaseArray = result;
                            mapSubjectDropdown();
                        },
                        error: function(error) {
                            toastr.error(error.responseJSON.message);
                        }
                    });
                }
                getAllSubjects();

                var mapSubjectDropdown = function() {
                    var trHTML = '';
                    if (phaseArray && phaseArray.length > 0) {
                        $('#phase-filter').html(`<option value="">-- Phase Phase --</option>`)
                        phaseArray.forEach(val => {
                            $('#phase-filter').append(`<option value="${val.id}">${val.name}</option>`)
                        })
                    }
                }

                $("#phase-filter").change(function() {
                    let selectedPhase = $('[name=phase_id]').val();
                    $('#subject-filter').html(`<option value="">-- Select Subject --</option>`)
                    $('#topic-filter').html(`<option value="">-- Select Topic --</option>`)
                    phaseArray.forEach(val => {
                        if (val.id == selectedPhase) {
                            subjectArray = val.subject;
                        }
                    });
                    if (selectedPhase) {
                        if (subjectArray && subjectArray.length > 0) {
                            $('#subject-filter').html(`<option value="">-- Select Subject --</option>`)
                            subjectArray.forEach(val => {
                                $('#subject-filter').append(`<option value="${val.id}">${val.name}</option>`)
                            })
                        }
                    } else {
                        $('#subject-filter').html('');
                        $('#subject-filter').append(`<option value="">-- Select Subject --</option>`);
                    }
                });

                $("#subject-filter").change(function() {
                    let selectedSubject = $('[name=subject_id]').val();
                    let topicArray = [];
                    subjectArray.forEach(val => {
                        if (val.id == selectedSubject) {
                            topicArray = val.topic;
                        }
                    });
                    if (selectedSubject) {
                        if (topicArray && topicArray.length > 0) {
                            $('#topic-filter').html(`<option value="">-- Select Topic --</option>`)
                            topicArray.forEach(val => {
                                $('#topic-filter').append(`<option value="${val.id}">${val.name}</option>`)
                            })
                        }
                    } else {
                        $('#topic-filter').html('');
                        $('#topic-filter').append(`<option value="">-- Select Topic --</option>`);
                    }
                });

            } else {
                window.location.replace('/');
            }
        });
    </script>

</body>

</html>