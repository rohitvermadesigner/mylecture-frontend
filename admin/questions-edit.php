<!DOCTYPE html>
<html>
<?php include 'include/head.php' ?>

<body>
    <div id="wrapper">
        <?php include 'include/left_menu.php' ?>
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <?php include 'include/header.php' ?>
            <h1 class="title-primary">Questions </h1>
            <ul class="breadcrumb">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="questions.php">Question Bank</a></li>
                <li>Edit Question</li>
            </ul>
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper wrapper-content">
                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h4>Edit Question</h4>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Select Phase</label>
                                                    <select class="form-control" id="phase-filter">
                                                        <option value="">-- Select Phase --</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Select Subject</label>
                                                    <select class="form-control" id="subject-filter">
                                                        <option value="">-- Select Subject --</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Select Topic</label>
                                                    <select class="form-control" id="topic-filter">
                                                        <option value="">-- Select Topic --</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Enter your Question</label>
                                                    <textarea name="question" id="" class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="option-flex">
                                                        <div>A</div>
                                                        <div class="">
                                                            <input type="radio" name="answer" value="1" />
                                                        </div>
                                                        <div class="option-group">
                                                            <label>Option One</label>
                                                            <input type="text" class="form-control" name="option_1" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="option-flex">
                                                        <div>B</div>
                                                        <div class="">
                                                            <input type="radio" name="answer" value="2" />
                                                        </div>
                                                        <div class="option-group">
                                                            <label>Option Two</label>
                                                            <input type="text" class="form-control" name="option_2" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="option-flex">
                                                        <div>C</div>
                                                        <div class="">
                                                            <input type="radio" name="answer" value="3" />
                                                        </div>
                                                        <div class="option-group">
                                                            <label>Option Three</label>
                                                            <input type="text" class="form-control" name="option_3" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="option-flex">
                                                        <div>D</div>
                                                        <div class="">
                                                            <input type="radio" name="answer" value="4" />
                                                        </div>
                                                        <div class="option-group">
                                                            <label>Option Four</label>
                                                            <input type="text" class="form-control" name="option_4" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="option-flex">
                                                        <div>E</div>
                                                        <div class="">
                                                            <input type="radio" name="answer" value="5" />
                                                        </div>
                                                        <div class="option-group">
                                                            <label>Option Five</label>
                                                            <input type="text" class="form-control" name="option_5" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Enter Description</label>
                                                    <textarea type="text" class="form-control" name="description"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Select Level</label>
                                                    <select name="difficulty_level" class="form-control">
                                                        <option value="">Select Level</option>
                                                        <option value="easy">Easy</option>
                                                        <option value="normal">Normal</option>
                                                        <option value="difficult">Difficult</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-6">
                                                <div class="form-group">
                                                    <input class="tagsinput form-control" type="text" name="tags" value="" />
                                                </div>
                                            </div> -->
                                            <div class="col-md-12">
                                                <button id="updateQuestion" class="btn btn-primary float-right">Update</button>
                                            </div>
                                        </div>
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

    <!-- Subject Modal Start-->
    <div id="addSubjectModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Subject</h4>
                </div>
                <div class="modal-body modal-body-scrollable">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Subject Name</label>
                                <input type="text" class="form-control" name="subject_name" data-id="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0" id="subjectData">
                                    <thead>
                                        <tr>
                                            <th width="4%">S.No.</th>
                                            <th width="40%" class="">Subject Name</th>
                                            <th width="4%" colspan="3">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary add-subject">Save</button>
                    <button type="button" class="btn btn-primary update-subject d-custom-none">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Subject Modal End-->

    <!-- Topic Modal Start-->
    <div id="addTopicModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Topic</h4>
                </div>
                <div class="modal-body modal-body-scrollable">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Topic Name</label>
                                <input type="text" class="form-control" name="topic_name" data-id="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0" id="topicData">
                                    <thead>
                                        <tr>
                                            <th width="4%">S.No.</th>
                                            <th width="40%" class="">Topic Name</th>
                                            <th width="4%" colspan="3">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary add-topic">Save</button>
                    <button type="button" class="btn btn-primary update-topic d-custom-none">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Topic Modal End-->

    <script>
        $(function() {
            const token = localStorage.getItem("admin_token");
            if (token) {
                const questionID = document.location.search.substr(4);

                let subjectID = '';
                let topicId = '';
                var phaseList;
                var selectedSubject;
                var questionData;

                var getQuestion = function() {
                    const url = `${base_url}/admin/question/get-detail.php`;
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'JSON',
                        data: {
                            token: token,
                            id: questionID
                        },
                        success: function(result) {
                            questionData = result;
                            $('[name=question]').attr('id', result.id);
                            $('[name=question]').val(result.question);
                            $('[name=option_1]').val(result.option_1);
                            $('[name=option_2]').val(result.option_2);
                            $('[name=option_3]').val(result.option_3);
                            $('[name=option_4]').val(result.option_4);
                            $('[name=option_5]').val(result.option_5);
                            // $('#phase-filter').val(result.phase.id);
                            // $('#subject-filter').val(result.subject.id);
                            // $('#topic-filter').val(result.topic.id);
                            $('[name=description]').val(result.description);
                            $('[name=difficulty_level]').val(result.difficulty_level);
                            $('[name=answer]').each(function() {
                                if ($(this).val() == result.answer) {
                                    $(this).prop('checked', true);
                                }
                            });
                            getAllSubjects();
                        }
                    });
                }
                getQuestion();

                $('body').on('click', '#updateQuestion', function() {
                    let update_data = {
                        "token": token,
                        "question_id": questionID,
                        "question": $('[name=question]').val(),
                        "option_1": $('[name=option_1]').val(),
                        "option_2": $('[name=option_2]').val(),
                        "option_3": $('[name=option_3]').val(),
                        "option_4": $('[name=option_4]').val(),
                        "option_5": $('[name=option_5]').val(),
                        "answer": $('[name=answer]:checked').val(),
                        "subject_id": $('#subject-filter').val(),
                        "topic_id": $('#topic-filter').val(),
                        "description": $('[name=description]').val(),
                        "difficulty_level": $('[name=difficulty_level]').val(),
                        // "tags": ["AIEEE", "IIT"]
                    }
                    $.ajax({
                        url: base_url + '/admin/question/update.php',
                        type: 'POST',
                        data: JSON.stringify(update_data),
                        dataType: 'JSON',
                        success: function(result) {
                            toastr.success(result.message);
                            window.location.replace('questions.php');
                        },
                        error: function(error) {
                            toastr.error(error.responseJSON.message);
                        }
                    });
                });

                const subjectResult = [];
                var getAllSubjects = function() {
                    const url = `${base_url}/admin/subject/list.php`;
                    const paramsData = {
                        token: token
                    }
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'JSON',
                        data: paramsData,
                        success: function(result) {
                            allPhase = result;
                            if (allPhase && allPhase.length > 0) {
                                let selectedPhaseId;
                                allPhase.forEach(phase => {
                                    if (phase.subject && phase.subject.length > 0) {
                                        phase.subject.forEach(subject => {
                                            if (questionData.subject.id == subject.id) {
                                                selectedPhaseId = phase.id;
                                            }
                                        })
                                    }
                                })
                                $('#phase-filter').html('<option value="">-- Select Phase --</option>');
                                $('#subject-filter').html('<option value="">-- Select Subject --</option>');
                                $('#topic-filter').html('<option value="">-- Select Topic --</option>');
                                allPhase.forEach(phase => {
                                    $('#phase-filter').append(`<option value="${phase.id}">${phase.name}</option>`);
                                    if (phase.id == selectedPhaseId) {
                                        if (phase.subject && phase.subject.length > 0) {
                                            phase.subject.forEach(subject => {
                                                $('#subject-filter').append(`<option value="${subject.id}">${subject.name}</option>`);
                                                $("#phase-filter").val(phase.id);
                                                $("#subject-filter").val(questionData.subject?.id);
                                                if (questionData.subject?.id && subject.id == questionData.subject?.id) {
                                                    subject.topic.forEach(topic => {
                                                        $('#topic-filter').append(`<option value="${topic.id}">${topic.name}</option>`);
                                                    });
                                                    $('#topic-filter').append(`<option value="addTopic" class="boldItalic">Add Topic</option>`);
                                                    $("#topic-filter").val(questionData.topic?.id);
                                                }
                                            })
                                        }
                                        $('#subject-filter').append(`<option value="addSubject" class="boldItalic">Add Subject</option>`);
                                    }
                                })
                            }
                        }
                    });
                }

                var subjectArray = [];
                $('#phase-filter').change(function(val) {
                    phase = $('#phase-filter').val();
                    var index = 1;
                    var trHTML = '';
                    if (phase) {
                        allPhase.forEach(val => {
                            if (val.id == phase) {
                                subjectArray = val.subject;
                                $('#topic-filter').html('');
                                $('#topic-filter').append(`<option value="">-- Select Topic --</option>`);
                                $('#subject-filter').html('');
                                $('#subject-filter').append(`<option value="">-- Select Subject --</option>`);
                                val.subject.forEach(subject => {
                                    $('#subject-filter').append(`<option value="${subject.id}">${subject.name}</option>`)
                                })

                                $('#subject-filter').append('<option value="addSubject" class="boldItalic">Add Subject</option>');
                                $('#subjectData tbody').html('');
                                val.subject.forEach(subject => {
                                    trHTML +=
                                        `<tr id="${subject.id}">
                                <td>${index++}</td>
                                <td><span subjectName="${subject.name}">${subject.name}</span></td>
                                <td class="text-center">
                                    <ul class="action-list">
                                    <li class="update-subject-icon"><i class="fa fa-pencil"></i></li>
                                    <li class="remove-subject"><i class="fa fa-trash-o"></i></li>
                                    </ul>
                                </td>
                                </tr>`;
                                });
                                $('#subjectData tbody').append(trHTML);
                            }
                        });
                    } else {
                        $('#subject-filter').html('');
                        $('#subject-filter').append(`<option value="">-- Select Subject --</option>`);
                        $('#topic-filter').html('');
                        $('#topic-filter').append(`<option value="">-- Select Topic --</option>`);
                    }
                });

                $('body').on('change', '#subject-filter', function(val) {
                    // let selectedChapter = $('#subject-filter').val();
                    var index = 1;
                    var trHTML = '';
                    subject = $('#subject-filter').val();
                    if (subject) {
                        subjectArray.forEach(val => {
                            if (val.id == subject) {
                                $('#topic-filter').html('');
                                $('#topic-filter').append(`<option value="">-- Select Topic --</option>`);
                                val.topic.forEach(topic => {
                                    $('#topic-filter').append(`<option value="${topic.id}">${topic.name}</option>`)
                                });
                                $('#topicData tbody').html('');
                                val.topic.forEach(topic => {
                                    trHTML +=
                                        `<tr id="${topic.id}">
                                <td>${index++}</td>
                                <td><span topicName="${topic.name}">${topic.name}</span></td>
                                <td class="text-center">
                                    <ul class="action-list">
                                    <li class="update-topic-icon"><i class="fa fa-pencil"></i></li>
                                    <li class="remove-topic"><i class="fa fa-trash-o"></i></li>
                                    </ul>
                                </td>
                                </tr>`;
                                });
                                $('#topicData tbody').append(trHTML);
                            }

                        })
                        $('#topic-filter').append('<option value="addTopic" class="boldItalic">Add Topic</option>');
                    } else {
                        $('#topic-filter').html('');
                        $('#topic-filter').append(`<option value="">-- Select Topic --</option>`);
                    }
                    if ($(this).val() == 'addSubject') {
                        $('#addSubjectModal').modal('show');
                        $(this).val('');
                        // selectedChapter = undefined;
                        $('#addSubjectModal [name=topic_name]').val("");
                        $('#addSubjectModal button.add-topic').show();
                        $('#addSubjectModal button.update-topic').hide();
                    }
                });

                $('body').on('change', '#topic-filter', function(val) {
                    if ($(this).val() == 'addTopic') {
                        $('#addTopicModal').modal('show');
                        $(this).val('');
                        // selectedChapter = undefined;
                        $('#addTopicModal [name=topic_name]').val("");
                        $('#addTopicModal button.add-topic').show();
                        $('#addTopicModal button.update-topic').hide();
                    }
                });



                const allUpdateSubjects = function() {
                    const url = `${base_url}/admin/subject/list.php`;
                    const paramsData = {
                        token: token
                    }
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'JSON',
                        data: paramsData,
                        success: function(result) {
                            allPhase = result;
                            phase = $('#phase-filter').val();
                            var index = 1;
                            var trHTML = '';
                            if (phase) {
                                allPhase.forEach(val => {
                                    if (val.id == phase) {
                                        subjectArray = val.subject;
                                        $('#topic-filter').html('');
                                        $('#topic-filter').append(`<option value="">-- Select Topic --</option>`);
                                        $('#subject-filter').html('');
                                        $('#subject-filter').append(`<option value="">-- Select Subject --</option>`);
                                        val.subject.forEach(subject => {
                                            $('#subject-filter').append(`<option value="${subject.id}">${subject.name}</option>`)
                                        })
                                        $('#subject-filter').append('<option value="addSubject" class="boldItalic">Add Subject</option>');
                                        $('#subjectData tbody').html('');
                                        val.subject.forEach(subject => {
                                            trHTML +=
                                                `<tr id="${subject.id}">
                                <td>${index++}</td>
                                <td><span subjectName="${subject.name}">${subject.name}</span></td>
                                <td class="text-center">
                                    <ul class="action-list">
                                    <li class="update-subject-icon"><i class="fa fa-pencil"></i></li>
                                    <li class="remove-subject"><i class="fa fa-trash-o"></i></li>
                                    </ul>
                                </td>
                                </tr>`;
                                        });
                                        $('#subjectData tbody').append(trHTML);
                                    }
                                });
                            } else {
                                $('#subject-filter').html('');
                                $('#subject-filter').append(`<option value="">-- Select Subject --</option>`);
                                $('#topic-filter').html('');
                                $('#topic-filter').append(`<option value="">-- Select Topic --</option>`);
                            }

                        }
                    });
                }

                const allUpdateTopics = function() {
                    const url = `${base_url}/admin/subject/list.php`;
                    const paramsData = {
                        token: token
                    }
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'JSON',
                        data: paramsData,
                        success: function(result) {
                            allPhase = result;
                            phase = $('#phase-filter').val();
                            var index = 1;
                            var trHTML = '';
                            subject = $('#subject-filter').val();

                            allPhase.forEach(val => {
                                if (val.id == phase) {
                                    subjectArray = val.subject;
                                    if (subject) {
                                        subjectArray.forEach(val => {
                                            if (val.id == subject) {
                                                $('#topic-filter').html('');
                                                $('#topic-filter').append(`<option value="">-- Select Topic --</option>`);
                                                val.topic.forEach(topic => {
                                                    $('#topic-filter').append(`<option value="${topic.id}">${topic.name}</option>`)
                                                });
                                                $('#topicData tbody').html('');
                                                val.topic.forEach(topic => {
                                                    trHTML +=
                                                        `<tr id="${topic.id}">
                                <td>${index++}</td>
                                <td><span topicName="${topic.name}">${topic.name}</span></td>
                                <td class="text-center">
                                    <ul class="action-list">
                                    <li class="update-topic-icon"><i class="fa fa-pencil"></i></li>
                                    <li class="remove-topic"><i class="fa fa-trash-o"></i></li>
                                    </ul>
                                </td>
                                </tr>`;
                                                });
                                                $('#topicData tbody').append(trHTML);
                                            }

                                        });
                                        $('#topic-filter').append('<option value="addTopic" class="boldItalic">Add Topic</option>');
                                    } else {
                                        $('#topic-filter').html('');
                                        $('#topic-filter').append(`<option value="">-- Select Topic --</option>`);
                                    }
                                }
                            });

                        }
                    });
                }

                // ***********************
                // subject section
                // ***********************
                $('body').on('click', '.remove-subject', function() {
                    var status = confirm("Are you sure to delete this subject ?");
                    if (status == true) {
                        let subjectId = $(this).parents('tr').attr('id');
                        let deleteFile = {
                            'token': token,
                            'subject_id': subjectId,
                        }
                        $.ajax({
                            url: base_url + '/admin/subject/delete.php',
                            type: 'POST',
                            dataType: 'JSON',
                            data: JSON.stringify(deleteFile),
                            success: function(response) {
                                toastr.success(response.message);
                                allUpdateSubjects();
                            },
                            error: function(error) {
                                toastr.error(error.responseJSON.message);
                            }
                        });
                    }
                });

                $('body').on('click', '.update-subject-icon', function() {
                    selectedSubject = $(this).parents('tr').attr('id');
                    $('#addSubjectModal [name=subject_name]').val($(this).parents('tr').find('span').attr('subjectName')).focus();
                    $('#addSubjectModal button.add-subject').hide();
                    $('#addSubjectModal button.update-subject').show();
                });

                $('body').on('click', '.update-subject', function() {
                    if (!$('[name=subject_name]').val() == '') {
                        let update_data = {
                            "token": token,
                            "id": selectedSubject,
                            "name": $('#addSubjectModal [name="subject_name"]').val(),
                            "phase_id": $('#phase-filter').val()
                        }
                        $.ajax({
                            url: base_url + '/admin/subject/update.php',
                            type: 'POST',
                            data: JSON.stringify(update_data),
                            dataType: 'JSON',
                            success: function(result) {
                                toastr.success(result.message);
                                $('#addSubjectModal [name=subject_name]').val("");
                                $('#addSubjectModal button.add-subject').show();
                                $('#addSubjectModal button.update-subject').hide();
                                allUpdateSubjects();
                                $('#addSubjectModal').modal('hide');
                            },
                            error: function(error) {
                                toastr.error(error.responseJSON.message);
                            }
                        });
                    } else {
                        toastr.error('Please Enter Subject Name');
                        $('[name=subject_name]').focus();
                    }
                });

                $('body').on('click', '.add-subject', function() {
                    if (!$('[name=subject_name]').val() == '') {
                        let post_data = {
                            "token": token,
                            "name": $('[name=subject_name]').val(),
                            "phase_id": $('#phase-filter').val()
                        }
                        $.ajax({
                            url: base_url + '/admin/subject/add.php',
                            type: 'POST',
                            data: JSON.stringify(post_data),
                            dataType: 'JSON',
                            success: function(result) {
                                toastr.success(result.message);
                                allUpdateSubjects();
                                $('#addSubjectModal').modal('hide');
                            },
                            error: function(error) {
                                toastr.error(error.responseJSON.message);
                            }
                        });

                    } else {
                        toastr.error('Please Enter Subject Name');
                        $('#addSubjectModal [name=subject_name]').focus();
                    }
                });
                // ***********************
                // subject section
                // ***********************

                // ***********************
                // topic section
                // ***********************
                $('body').on('click', '.remove-topic', function() {
                    var status = confirm("Are you sure to delete this Topic ?");
                    if (status == true) {
                        let topicId = $(this).parents('tr').attr('id');
                        let deleteFile = {
                            'token': token,
                            'topic_id': topicId,
                        }
                        $.ajax({
                            url: base_url + '/admin/topic/delete.php',
                            type: 'POST',
                            dataType: 'JSON',
                            data: JSON.stringify(deleteFile),
                            success: function(response) {
                                toastr.success(response.message);
                                allUpdateTopics();
                            },
                            error: function(error) {
                                toastr.error(error.responseJSON.message);
                            }
                        });
                    }
                });

                $('body').on('click', '.update-topic-icon', function() {
                    selectedTopic = $(this).parents('tr').attr('id');
                    $('#addTopicModal [name=topic_name]').val($(this).parents('tr').find('span').attr('topicName')).focus();
                    $('#addTopicModal button.add-topic').hide();
                    $('#addTopicModal button.update-topic').show();
                });

                $('body').on('click', '.update-topic', function() {
                    if (!$('[name=topic_name]').val() == '') {
                        let update_data = {
                            "token": token,
                            "id": selectedTopic,
                            "name": $('#addTopicModal [name="topic_name"]').val(),
                        }
                        $.ajax({
                            url: base_url + '/admin/topic/update.php',
                            type: 'POST',
                            data: JSON.stringify(update_data),
                            dataType: 'JSON',
                            success: function(result) {
                                toastr.success(result.message);
                                $('#addTopicModal [name=topic_name]').val("");
                                $('#addTopicModal button.add-topic').show();
                                $('#addTopicModal button.update-topic').hide();
                                allUpdateTopics();
                                $('#addTopicModal').modal('hide');
                            },
                            error: function(error) {
                                toastr.error(error.responseJSON.message);
                            }
                        });
                    } else {
                        toastr.error('Please Enter Topic Name');
                        $('[name=topic_name]').focus();
                    }
                });

                $('body').on('click', '.add-topic', function() {
                    if (!$('[name=topic_name]').val() == '') {
                        let post_data = {
                            "token": token,
                            "subject_id": $('#subject-filter').find('option:selected').val(),
                            "name": $('[name=topic_name]').val(),
                        }
                        $.ajax({
                            url: base_url + '/admin/topic/add.php',
                            type: 'POST',
                            data: JSON.stringify(post_data),
                            dataType: 'JSON',
                            success: function(result) {
                                toastr.success(result.message);
                                allUpdateTopics();
                                $('#addTopicModal').modal('hide');
                            },
                            error: function(error) {
                                toastr.error(error.responseJSON.message);
                            }
                        });

                    } else {
                        toastr.error('Please Enter Topic Name');
                        $('#addTopicModal [name=topic_name]').focus();
                    }
                });
                // ***********************
                // topic section
                // ***********************


            } else {
                window.location.replace('index.php');
            }
        });
    </script>
</body>

</html>