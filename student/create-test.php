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
                                    <form id="selfAssessorForm">
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

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Select Subject</label>
                                                    <select class="form-control" id="subject-filter" name="subject_id">
                                                        <option value="">-- Select Subject --</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Select Chapter</label>
                                                    <select class="form-control" id="chapter-filter" name="chapter_id">
                                                        <option value="">-- Select Chapter --</option>
                                                    </select>
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
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>*Marks for incorrect question </label>
                                                    <input type="number" class="form-control" name="marks_for_incorrect_question" value="-1" />
                                                </div>
                                            </div>

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
                $('#selfAssessorForm').validate({
                    rules: {
                        test_name: 'required',
                        duration: 'required',
                        is_question_random_order: 'required',
                        is_mandatory_all_question: 'required',
                        subject_id: 'required',
                        chapter_id: 'required',
                        total_questions: 'required',
                        marks_for_correct_question: 'required',
                        marks_for_incorrect_question: 'required'
                    },
                    submitHandler: function() {
                        createSelfAssessorSubmit();
                    }
                });

                createSelfAssessorSubmit = function() {
                    let update_data = {
                        "token": token,
                        "test_name": $('[name=test_name]').val(),
                        "duration": $('[name=duration]').val(),
                        "is_question_random_order": $('[name=is_question_random_order]').val(),
                        "is_mandatory_all_question": $('[name=is_mandatory_all_question]').val(),
                        "subject_id": $('[name=subject_id]').val(),
                        "chapter_id": $('[name=chapter_id]').val(),
                        "total_questions": $('[name=total_questions]').val(),
                        "marks_for_correct_question": $('[name=marks_for_correct_question]').val(),
                        "marks_for_incorrect_question": $('[name=marks_for_incorrect_question]').val()
                    }
                    console.log(update_data);
                    $.ajax({
                        url: base_url + '/student/self-assessor/add.php',
                        type: 'POST',
                        data: JSON.stringify(update_data),
                        dataType: 'JSON',
                        success: function(result) {
                            toastr.success(result.message);
                            window.location.replace('self-assessor.php');
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
                            console.log(result);
                            subjectList = result;
                            allSubjects = result;
                            var index = 1;
                            var trHTML = '';
                            if (allSubjects && allSubjects.length > 0) {
                                allSubjects.forEach(val => {
                                    $('#subject-filter').append(`<option value="${val.id}">${val.name}</option>`)
                                })
                            }
                            // $('#subject-filter').append('<option value="addSubject" class="boldItalic">Add Subject</option>');
                        },
                        error: function(error) {
                            debugger;
                            // toastr.error(error.responseJSON.message);
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
                        // $('#chapter-filter').append('<option value="addChapter" class="boldItalic">Add Chapter</option>');
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
                    chapter = $('#chapter-filter').val();
                    if (chapter) {
                        allChapters.forEach(val => {
                            if (val.id == chapter) {
                                $('#topic-filter').html('');
                                $('#topic-filter').append(`<option value="">-- Select Topic --</option>`);
                                val.topic.forEach(topic => {
                                    $('#topic-filter').append(`<option value="${topic.id}">${topic.name}</option>`)
                                })
                            }

                        })
                        // $('#topic-filter').append('<option value="addTopic" class="boldItalic">Add Topic</option>');
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


            } else {
                window.location.replace('/');
            }
        });
    </script>

</body>

</html>