<!DOCTYPE html>
<html>
<?php include 'include/head.php' ?>

<body>
    <div id="wrapper">
        <?php include 'include/left_menu.php' ?>
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <?php include 'include/header.php' ?>
            <h1 class="title-primary">Questions </h1>
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
                                                    <label>Select Subject</label>
                                                    <select class="form-control" id="subject-filter">
                                                        <option value="">-- Select Subject --</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Select Chapter</label>
                                                    <select class="form-control" id="chapter-filter">
                                                        <option value="">-- Select Chapter --</option>
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
                                                    <label>Select Lavel</label>
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

    <!-- Chapter Modal Start-->
    <div id="addChapterModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Chapter</h4>
                </div>
                <div class="modal-body modal-body-scrollable">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Chapter Name</label>
                                <input type="text" class="form-control" name="chapter_name" data-id="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0" id="chapterData">
                                    <thead>
                                        <tr>
                                            <th width="4%">S.No.</th>
                                            <th width="40%" class="">Chapter Name</th>
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
                    <button type="button" class="btn btn-primary add-chapter">Save</button>
                    <button type="button" class="btn btn-primary update-chapter d-custom-none">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Chapter Modal End-->

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
                let chapterId = '';

                let allChapters = [];
                var selectedSubject;
                var subjectList;
                var chapterList;

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
                            console.log(result);
                            $('[name=question]').attr('id', result.id);
                            $('[name=question]').val(result.question);
                            $('[name=option_1]').val(result.option_1);
                            $('[name=option_2]').val(result.option_2);
                            $('[name=option_3]').val(result.option_3);
                            $('[name=option_4]').val(result.option_4);
                            $('[name=option_5]').val(result.option_5);
                            $('#subject-filter').val(result.subject_id);
                            $('#chapter-filter').val(result.chapter_id);
                            $('[name=description]').val(result.description);
                            $('[name=difficulty_level]').val(result.difficulty_level);
                            $('[name=answer]').each(function() {
                                if ($(this).val() == result.answer) {
                                    $(this).prop('checked', true);
                                }
                            });
                            // $('[name=tags]').val(result.tags);
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
                        "chapter_id": $('#chapter-filter').val(),
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
                            subjectList = result;
                            allSubjects = result;
                            var index = 1;
                            var trHTML = '';
                            if (allSubjects && allSubjects.length > 0) {
                                allSubjects.forEach(val => {
                                    $('#subject-filter').append(`<option value="${val.id}">${val.name}</option>`)
                                })
                            }
                            $('#subject-filter').append('<option value="addSubject" class="boldItalic">Add Subject</option>');
                            $.each(result, function(key, value) {
                                trHTML +=
                                    `<tr id="${value.id}">
                                <td>${index++}</td>
                                <td>${value.name}</td>
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
                }
                getAllSubjects();

                $('#subject-filter').change(function(val) {
                    subject = $('#subject-filter').val();
                    var index = 1;
                    var trHTML = '';
                    if (subject) {
                        allSubjects.forEach(val => {
                            chapterList = val.chapter;
                            if (val.id == subject) {
                                chapterArray = val.chapter;
                                $('#chapter-filter').html('');
                                $('#chapter-filter').append(`<option value="">-- Select Chapter --</option>`);
                                val.chapter.forEach(chapter => {
                                    $('#chapter-filter').append(`<option value="${chapter.id}">${chapter.name}</option>`)
                                })
                                $('#chapterData tbody').html('');
                                val.chapter.forEach(chapter => {
                                    trHTML +=
                                        `<tr id="${chapter.id}">
                                <td>${index++}</td>
                                <td>${chapter.name}</td>
                                <td class="text-center">
                                    <ul class="action-list">
                                    <li class="update-chapter-icon"><i class="fa fa-pencil"></i></li>
                                    <li class="remove-chapter"><i class="fa fa-trash-o"></i></li>
                                    </ul>
                                </td>
                                </tr>`;
                                });
                                $('#chapterData tbody').append(trHTML);
                            }
                        })
                        $('#chapter-filter').append('<option value="addChapter" class="boldItalic">Add Chapter</option>');
                    }

                    if ($(this).val() == 'addSubject') {
                        $('#addSubjectModal').modal('show');
                        $(this).val('');
                        selectedSubject = undefined;
                        $('#addSubjectModal [name=subject_name]').val("");
                        $('#addSubjectModal button.add-subject').show();
                        $('#addSubjectModal button.update-subject').hide();
                    }
                });

                $('#chapter-filter').change(function(val) {
                    let selectedChapter = $('#chapter-filter').val();
                    var index = 1;
                    var trHTML = '';
                    chapter = $('#chapter-filter').val();
                    if (chapter) {
                        chapterArray.forEach(val => {
                            if (val.id == chapter) {
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
                                <td>${topic.name}</td>
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
                    }
                    if ($(this).val() == 'addChapter') {
                        $('#addChapterModal').modal('show');
                        $(this).val('');
                        selectedChapter = undefined;
                        $('#addChapterModal [name=chapter_name]').val("");
                        $('#addChapterModal button.add-chapter').show();
                        $('#addChapterModal button.update-chapter').hide();
                    }
                });

                $('#topic-filter').change(function(val) {
                    if ($(this).val() == 'addTopic') {
                        $('#addTopicModal').modal('show');
                        $(this).val('');
                        selectedChapter = undefined;
                        $('#addTopicModal [name=topic_name]').val("");
                        $('#addTopicModal button.add-topic').show();
                        $('#addTopicModal button.update-topic').hide();
                    }
                });

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
                                getAllSubjects();
                            },
                            error: function(error) {
                                toastr.error(error.responseJSON.message);
                            }
                        });
                    }
                });

                $('body').on('click', '.update-subject-icon', function() {
                    selectedSubject = $(this).parents('tr').attr('id');
                    const selectedSubjectData = subjectList.filter(v => v.id == selectedSubject)[0];
                    $('#addSubjectModal [name=subject_name]').val(selectedSubjectData.name).focus();
                    $('#addSubjectModal button.add-subject').hide();
                    $('#addSubjectModal button.update-subject').show();
                });

                $('body').on('click', '.update-subject', function() {
                    if (!$('[name=subject_name]').val() == '') {
                        let update_data = {
                            "token": token,
                            "id": selectedSubject,
                            "name": $('#addSubjectModal [name="subject_name"]').val(),
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
                                getAllSubjects();
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
                            "name": $('[name=subject_name]').val()
                        }
                        $.ajax({
                            url: base_url + '/admin/subject/add.php',
                            type: 'POST',
                            data: JSON.stringify(post_data),
                            dataType: 'JSON',
                            success: function(result) {
                                toastr.success(result.message);
                                $('#addSubjectModal').modal('hide');
                                getAllSubjects();
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
                // chapter section
                // ***********************
                $('body').on('click', '.remove-chapter', function() {
                    var status = confirm("Are you sure to delete this chapter ?");
                    if (status == true) {
                        let chapterId = $(this).parents('tr').attr('id');
                        let deleteFile = {
                            'token': token,
                            'id': chapterId,
                            "is_chapter": 1,
                            "is_topic": 0
                        }
                        $.ajax({
                            url: base_url + '/admin/chapter/delete.php',
                            type: 'POST',
                            dataType: 'JSON',
                            data: JSON.stringify(deleteFile),
                            success: function(response) {
                                toastr.success(response.message);
                                location.reload();
                            },
                            error: function(error) {
                                toastr.error(error.responseJSON.message);
                            }
                        });
                    }
                });

                $('body').on('click', '.update-chapter-icon', function() {
                    selectedChapter = $(this).parents('tr').attr('id');
                    const selectedChapterData = chapterList.filter(v => v.id == selectedChapter)[0];
                    $('#addChapterModal [name=chapter_name]').val($(this).parents('tr').find('td').eq(1).text()).focus();
                    $('#addChapterModal button.add-chapter').hide();
                    $('#addChapterModal button.update-chapter').show();
                });

                $('body').on('click', '.update-chapter', function() {
                    if (!$('[name=chapter_name]').val() == '') {
                        let update_data = {
                            "token": token,
                            "id": selectedChapter,
                            "name": $('#addChapterModal [name="chapter_name"]').val(),
                            "subject_id": $('#subject-filter').find('option:selected').val(),
                            "chapter_id": 0,
                            "is_chapter": 1,
                            "is_topic": 0,
                        }
                        $.ajax({
                            url: base_url + '/admin/chapter/update.php',
                            type: 'POST',
                            data: JSON.stringify(update_data),
                            dataType: 'JSON',
                            success: function(result) {
                                toastr.success(result.message);
                                $('#addChapterModal [name=chapter_name]').val("");
                                $('#addChapterModal button.add-chapter').show();
                                $('#addChapterModal button.update-chapter').hide();
                                location.reload();
                            },
                            error: function(error) {
                                toastr.error(error.responseJSON.message);
                            }
                        });
                    } else {
                        toastr.error('Please Enter Chapter Name');
                        $('[name=chapter_name]').focus();
                    }
                });

                $('body').on('click', '.add-chapter', function() {
                    if (!$('[name=chapter_name]').val() == '') {
                        let post_data = {
                            "token": token,
                            "name": $('[name=chapter_name]').val(),
                            "subject_id": $('#subject-filter').find('option:selected').val(),
                            "chapter_id": 0,
                            "is_chapter": 1,
                            "is_topic": 0
                        }
                        $.ajax({
                            url: base_url + '/admin/chapter/add.php',
                            type: 'POST',
                            data: JSON.stringify(post_data),
                            dataType: 'JSON',
                            success: function(result) {
                                toastr.success(result.message);
                                $('#addChapterModal').modal('hide');
                                getAllSubjects();
                            },
                            error: function(error) {
                                toastr.error(error.responseJSON.message);
                            }
                        });

                    } else {
                        toastr.error('Please Enter Chapter Name');
                        $('#addChapterModal [name=chapter_name]').focus();
                    }
                });
                // ***********************
                // chapter section
                // ***********************

                // ***********************
                // topic section
                // ***********************
                $('body').on('click', '.remove-topic', function() {
                    var status = confirm("Are you sure to delete this Topic ?");
                    if (status == true) {
                        let chapterId = $(this).parents('tr').attr('id');
                        let deleteFile = {
                            'token': token,
                            'id': chapterId,
                            "is_chapter": 0,
                            "is_topic": 1
                        }
                        $.ajax({
                            url: base_url + '/admin/chapter/delete.php',
                            type: 'POST',
                            dataType: 'JSON',
                            data: JSON.stringify(deleteFile),
                            success: function(response) {
                                toastr.success(response.message);
                                location.reload();
                            },
                            error: function(error) {
                                toastr.error(error.responseJSON.message);
                            }
                        });
                    }
                });

                $('body').on('click', '.update-topic-icon', function() {
                    selectedChapter = $(this).parents('tr').attr('id');
                    const selectedChapterData = chapterList.filter(v => v.id == selectedChapter)[0];
                    $('#addTopicModal [name=topic_name]').val($(this).parents('tr').find('td').eq(1).text()).focus();
                    $('#addTopicModal button.add-topic').hide();
                    $('#addTopicModal button.update-topic').show();
                });

                $('body').on('click', '.update-topic', function() {
                    if (!$('[name=topic_name]').val() == '') {
                        let update_data = {
                            "token": token,
                            "id": selectedChapter,
                            "name": $('#addTopicModal [name="topic_name"]').val(),
                            "subject_id": $('#subject-filter').find('option:selected').val(),
                            "chapter_id": $('#chapter-filter').find('option:selected').val(),
                            "is_chapter": 0,
                            "is_topic": 1,
                        }
                        $.ajax({
                            url: base_url + '/admin/chapter/update.php',
                            type: 'POST',
                            data: JSON.stringify(update_data),
                            dataType: 'JSON',
                            success: function(result) {
                                toastr.success(result.message);
                                $('#addTopicModal [name=chapter_name]').val("");
                                $('#addTopicModal button.add-chapter').show();
                                $('#addTopicModal button.update-chapter').hide();
                                location.reload();
                            },
                            error: function(error) {
                                toastr.error(error.responseJSON.message);
                            }
                        });
                    } else {
                        toastr.error('Please Enter Chapter Name');
                        $('[name=chapter_name]').focus();
                    }
                });

                $('body').on('click', '.add-topic', function() {
                    if (!$('[name=topic_name]').val() == '') {
                        let post_data = {
                            "token": token,
                            "name": $('[name=topic_name]').val(),
                            "subject_id": $('#subject-filter').find('option:selected').val(),
                            "chapter_id": $('#chapter-filter').find('option:selected').val(),
                            "is_chapter": 0,
                            "is_topic": 1
                        }
                        $.ajax({
                            url: base_url + '/admin/chapter/add.php',
                            type: 'POST',
                            data: JSON.stringify(post_data),
                            dataType: 'JSON',
                            success: function(result) {
                                toastr.success(result.message);
                                $('#addTopicModal').modal('hide');
                                getAllSubjects();
                                location.reload();
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