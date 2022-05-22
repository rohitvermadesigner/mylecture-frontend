<!DOCTYPE html>
<html>
<?php include 'include/head.php' ?>

<body>
    <div id="wrapper">
        <?php include 'include/left_menu.php' ?>
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <?php include 'include/header.php' ?>
            <h1 class="title-primary">Create Question </h1>
            <ul class="breadcrumb">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="questions.php">Question Bank</a></li>
                <li>Create Question</li>
            </ul>
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper wrapper-content">
                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-content">
                                        <form id="createQuestion">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Select Phase <span style="color:red">*</span></label>
                                                        <select class="form-control" id="phase-filter">
                                                            <option value="">-- Select Phase --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Select Subject <span style="color:red">*</span></label>
                                                        <select class="form-control" id="subject-filter">
                                                            <option value="">-- Select Subject --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Select Topic <span style="color:red">*</span></label>
                                                        <select class="form-control" id="topic-filter">
                                                            <option value="">-- Select Topic --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Enter your Question <span style="color:red">*</span></label>
                                                        <textarea name="question" id="enter_question" class="form-control" placeholder="Type your question"></textarea>
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
                                                                <label>Option One <span style="color:red">*</span></label>
                                                                <textarea name="option1" id="option_one" class="form-control" placeholder=""></textarea>
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
                                                                <label>Option Two <span style="color:red">*</span></label>
                                                                <textarea name="option1" id="option_two" class="form-control" placeholder=""></textarea>
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
                                                                <textarea name="option1" id="option_three" class="form-control" placeholder=""></textarea>
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
                                                                <textarea name="option1" id="option_four" class="form-control" placeholder=""></textarea>
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
                                                                <textarea name="option1" id="option_five" class="form-control" placeholder=""></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Enter Description</label>
                                                        <textarea name="description" id="description" class="form-control" placeholder="Enter description"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Select Level <span style="color:red">*</span></label>
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
                                                        <label>Tags</label>
                                                        <input class="tagsinput form-control" type="text" name="tags" value="" />
                                                    </div>
                                                </div> -->
                                                <div class="col-md-12">
                                                    <button type="button" id="add-new-question-submit" class="btn btn-primary float-right add-new-question-btn" data-add-more="0">Submit</button>
                                                    <button type="button" id="add-more-question-submit" class="btn btn-primary float-right add-new-question-btn mr-4" data-add-more="1">Add More +</button>
                                                </div>
                                            </div>
                                        </form>
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
                var phaseList;
                var selectedSubject;

                function tinyMceConfig(selector, height = 200) {
                    return {
                        selector,
                        plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
                        editimage_cors_hosts: ['picsum.photos'],
                        menubar: '',
                        toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
                        height
                    }
                }

                // ------------------------------RTE STARTS-------------------------------------
                tinymce.init(tinyMceConfig('#enter_question', 300));
                tinymce.init(tinyMceConfig('#option_one'));
                tinymce.init(tinyMceConfig('#option_two'));
                tinymce.init(tinyMceConfig('#option_three'));
                tinymce.init(tinyMceConfig('#option_four'));
                tinymce.init(tinyMceConfig('#option_five'));
                tinymce.init(tinyMceConfig('#description', 300));
                // ----------------------------RTE ENDS---------------------------------------

                $(".add-new-question-btn").click(function(event) {
                    event.preventDefault();
                    tinyMCE.triggerSave();
                    let is_add_more = $(this).attr('data-add-more');
                    let formData = {
                        token: token,
                        question: $('#enter_question').val(),
                        option_1: $('#option_one').val(),
                        option_2: $('#option_two').val(),
                        option_3: $('#option_three').val(),
                        option_4: $('#option_four').val(),
                        option_5: $('#option_five').val(),
                        answer: $('[name=answer]:checked').val(),
                        subject_id: $('#subject-filter').val(),
                        topic_id: $('#topic-filter').val(),
                        description: $('#description').val(),
                        difficulty_level: $('[name=difficulty_level]').val(),
                    }
                    if (formData.question && formData.option_1 && formData.option_2 && formData.subject_id && formData.topic_id && formData.difficulty_level) {
                        if (formData.answer) {
                            $(".add-new-question-btn").attr('disabled', true);
                            $.ajax({
                                url: base_url + '/admin/question/add.php',
                                type: 'POST',
                                data: JSON.stringify(formData),
                                dataType: 'JSON',
                                success: function(result) {
                                    toastr.success(result.message);
                                    if (is_add_more == '1') {
                                        tinymce.get("enter_question").setContent("");
                                        tinymce.get("option_one").setContent("");
                                        tinymce.get("option_two").setContent("");
                                        tinymce.get("option_three").setContent("");
                                        tinymce.get("option_four").setContent("");
                                        tinymce.get("option_five").setContent("");
                                        tinymce.get("description").setContent("");
                                        $("[name=answer]").prop('checked', false);
                                        $(".add-new-question-btn").attr('disabled', false);
                                    } else {
                                        $(".add-new-question-btn").attr('disabled', false);
                                        window.location.replace('questions.php');
                                    }
                                },
                                error: function(error) {
                                    toastr.error(error.responseJSON.message);
                                    $(".add-new-question-btn").attr('disabled', false);
                                }
                            });
                        } else {
                            toastr.error("Please select correct answer.");
                        }
                    } else {
                        toastr.error("Please enter all mandatory fields.");
                    }

                });

                const subjectResult = [];
                const getAllSubjects = function() {
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

                            // for(var i = 0; i < result.length; i++){
                            //     subjectResult.push(...result[i].subject);                             
                            // }
                            // subjectResult.sort((a, b) => a.name < b.name ? -1 : 1);

                            phaseList = result;
                            allPhase = result;
                            var index = 1;
                            var trHTML = '';
                            if (allPhase && allPhase.length > 0) {
                                allPhase.forEach(val => {
                                    $('#phase-filter').append(`<option value="${val.id}">${val.name}</option>`)
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

                getAllSubjects();

            } else {
                window.location.replace('index.php');
            }
        });
    </script>
</body>

</html>