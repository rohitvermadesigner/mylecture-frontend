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
                <li>Question Bank</li>
            </ul>

            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper wrapper-content">
                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <ul class="filter-list">
                                            <li>
                                                <select class="form-control phase-filter">
                                                    <option value="">-- Select Phase --</option>
                                                </select>
                                            </li>
                                            <li>
                                                <select class="form-control subject-filter">
                                                    <option value="">-- Select Subject --</option>
                                                </select>
                                            </li>
                                            <li>
                                                <select class="form-control topic-filter">
                                                    <option value="">-- Select Topic --</option>
                                                </select>
                                            </li>
                                            <li>
                                                <input type="search" class="form-control" id="question-filter" placeholder="Keywords">
                                            </li>
                                            <li>
                                                <button class="btn btn-primary" id="search-btn">Search</button>
                                                <button class="btn btn-danger display-none" id="reset-btn">Reset</button>
                                            </li>
                                        </ul>
                                        <div>
                                            <ul class="top-right-btn-list">
                                                <li>
                                                    <button class="btn btn-primary display-none" id="moveBtn">Move</button>
                                                </li>
                                                <li>
                                                    <a href="create-question.php" class="btn btn-primary"><i class="fa fa-plus"></i> Add </a>
                                                </li>
                                                <!-- <li>
                                                    <button class="btn btn-primary" disabled><i class="fa fa-trash"></i> Delete</button>
                                                </li> -->
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="table-responsive mt-3">
                                            <table class="table question-listing-data" id="questionData">
                                                <thead>
                                                    <tr>
                                                        <th><input type="checkbox" id="checkAll"></th>
                                                        <th width="5%">S.No.</th>
                                                        <th width="55%">Questions Details</th>
                                                        <th width="15%">Subject</th>
                                                        <th width="20%">Topic</th>
                                                        <th width="5%">Level</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                            <div class="table-loading-wrap">
                                                <div class="loading-img">
                                                    <img src="./assets/img/loader.gif" alt="loader">
                                                </div>
                                                <div class="loading-text">
                                                    Loading...
                                                </div>
                                            </div>
                                            <div class="table-bottom" style="position: relative;">
                                                <div class="text-center">
                                                    <button class="btn btn-primary prevPage" disabled>Prev</button>
                                                    <button class="btn btn-primary nextPage" disabled>Next</button>
                                                </div>
                                                <select class="form-control float-right" id="rowSorting" style="width: 75px; position: absolute; right: 0; top: 0;">
                                                    <option value="10">10</option>
                                                    <option value="20">20</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>
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

    <!-- Modal -->
    <div id="moveModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Move Questions</h4>
                </div>
                <div class="modal-body">
                    <form id="moveForm">
                        <ul class="filter-list">
                            <li>
                                <select class="form-control phase-filter">
                                    <option value="">-- Select Phase --</option>
                                </select>
                            </li>
                            <li>
                                <select class="form-control subject-filter" name="subject_name">
                                    <option value="">-- Select Subject --</option>
                                </select>
                            </li>
                            <li>
                                <select class="form-control topic-filter" name="topic_name">
                                    <option value="">-- Select Topic --</option>
                                </select>
                            </li>
                            <li>
                                <button type="submit" class="btn btn-primary" id="">Move</button>
                            </li>
                        </ul>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <?php include 'include/footer_script.php' ?>
    <script>
        $(function() {
            const token = localStorage.getItem("admin_token");
            if (token) {
                let page_no = 1;
                let page_count = 10;
                let totalResults = 0;
                let subject = '';
                let topic = '';
                let question = '';
                let allSubjects = [];
                let loadQuestions = function(page_no, page_count) {
                    let paramsData = {
                        token: token,
                        page_count: page_count,
                        page_no: page_no
                    }
                    if (subject) {
                        paramsData.subject = subject
                    }
                    if (topic) {
                        paramsData.topic = topic
                    }
                    if (question) {
                        paramsData.question = question
                    }

                    let url = `${base_url}/admin/question/list.php`;
                    $('#questionData tbody').html('');
                    $(".table-loading-wrap").removeClass('display-none');
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'JSON',
                        data: paramsData,
                        success: function(result) {
                            let countStartAt = ((page_no - 1) * page_count) + 1;
                            totalResults = result.total_results;
                            $(".total-results-count").text(totalResults);
                            insertQuestionsIntoTable(result, countStartAt);
                            checkNextPreviousButton();
                        }
                    });
                }

                $('#rowSorting').on('change', function() {
                    page_count = $(this).val();
                    loadQuestions(1, page_count);
                });

                let insertQuestionsIntoTable = function(result, countStartAt) {
                    var tr = '';
                    $.each(result.result, function(key, value) {
                        tr += `<tr>
                            <td> <input type="checkbox" value="${value.id}" name="subject_id" /> </td>
                            <td> ${countStartAt} ${value.is_modified ? '<span class="isModified"></span>': '<span class="isNotModified"></span>'} </td>
                            <td> ${value.question} </td>
                            <td> ${value.subject} </td>
                            <td> ${value.topic} </td>
                            <td> ${value.difficulty_level} </td>
                            <td class="text-center">
                            <a href="questions-edit.php?id=${value.id}" class="update-question"><i class="fa fa-pencil"></i></a> &nbsp; 
                            <span class="remove-question"><i class="fa fa-trash"></i></span>
                            <span class="question-id d-none">${value.id}</span>
                            </td></tr>`;
                        countStartAt++;
                    });
                    $(".table-loading-wrap").addClass('display-none');
                    $('#questionData tbody').append(tr);
                }

                $('body').on('click', '#questionData input', function() {
                    if ($("#questionData input:checkbox:checked").length > 0) {
                        $('#moveBtn').show();
                    } else {
                        $('#moveBtn').hide();
                    }
                });

                $('#moveBtn').click(function() {
                    $('#moveModal').modal('show');
                });

                $('#moveForm').validate({
                    rules: {
                        subject_name: "required",
                        topic_name: "required",
                    },
                    submitHandler: function(form) {
                        move_submit();
                    }
                });

                function move_submit() {
                    var question_ids = [];
                    $('input[name=subject_id]:checked').each(function() {
                        question_ids.push(parseInt($(this).val()));
                    });
                    let post_data = {
                        token: token,
                        "question_ids": question_ids,
                        "subject_id": $('#moveForm').find('[name=subject_name]').val(),
                        "topic_id": $('#moveForm').find('[name=topic_name]').val()
                    }
                    $.ajax({
                        url: base_url + '/admin/question/move.php',
                        type: 'POST',
                        data: JSON.stringify(post_data),
                        dataType: 'JSON',
                        success: function(result) {
                            toastr.success(result.message);
                            $('#moveModal').modal('hide');
                            loadQuestions(page_no, page_count);
                        },
                        error: function(error) {
                            toastr.error(error.responseJSON.message);
                        }
                    });
                }

                $('.nextPage').click(function() {
                    page_no = page_no + 1;
                    loadQuestions(page_no, page_count);
                    checkNextPreviousButton();
                    $('.prevPage').attr('disabled', true);
                    $('.nextPage').attr('disabled', true);
                });

                $('.prevPage').click(function() {
                    page_no = page_no - 1;
                    loadQuestions(page_no, page_count);
                    checkNextPreviousButton();
                    $('.prevPage').attr('disabled', true);
                    $('.nextPage').attr('disabled', true);
                });

                var checkNextPreviousButton = function() {
                    if (page_no == 1) {
                        $('.prevPage').attr('disabled', true);
                    } else {
                        $('.prevPage').removeAttr('disabled');
                    }
                    if (page_no * page_count >= totalResults) {
                        $('.nextPage').attr('disabled', true);
                    } else {
                        $('.nextPage').removeAttr('disabled');
                    }
                }

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
                            phaseList = result;
                            allPhase = result;
                            var index = 1;
                            var trHTML = '';
                            if (allPhase && allPhase.length > 0) {
                                allPhase.forEach(val => {
                                    $('.phase-filter').append(`<option value="${val.id}">${val.name}</option>`)
                                })
                            }
                        }
                    });
                }

                var subjectArray = [];
                $('.phase-filter').change(function(val) {
                    $this = $(this);
                    phase = $(this).val();
                    if (phase) {
                        allPhase.forEach(val => {
                            if (val.id == phase) {
                                subjectArray = val.subject;
                                $this.parents('ul').find('.topic-filter').html('');
                                $this.parents('ul').find('.topic-filter').append(`<option value="">-- Select Topic --</option>`);
                                $this.parents('ul').find('.subject-filter').html('');
                                $this.parents('ul').find('.subject-filter').append(`<option value="">-- Select Subject --</option>`);
                                val.subject.forEach(subject => {
                                    $this.parents('ul').find('.subject-filter').append(`<option value="${subject.id}">${subject.name}</option>`)
                                })
                            }
                        });
                    } else {
                        $this.parents('ul').find('.subject-filter').html('');
                        $this.parents('ul').find('.subject-filter').append(`<option value="">-- Select Subject --</option>`);
                        $this.parents('ul').find('.topic-filter').html('');
                        $this.parents('ul').find('.topic-filter').append(`<option value="">-- Select Topic --</option>`);
                    }
                });

                $('body').on('change', '.subject-filter', function(val) {
                    $this = $(this);
                    subject_id = $(this).val();
                    if (subject_id) {
                        subjectArray.forEach(val => {
                            if (val.id == subject_id) {
                                $this.parents('ul').find('.topic-filter').html('');
                                $this.parents('ul').find('.topic-filter').append(`<option value="">-- Select Topic --</option>`);
                                val.topic.forEach(topic => {
                                    $this.parents('ul').find('.topic-filter').append(`<option value="${topic.id}">${topic.name}</option>`)
                                });

                            }
                        })
                    } else {
                        $this.parents('ul').find('.topic-filter').html('');
                        $this.parents('ul').find('.topic-filter').append(`<option value="">-- Select Topic --</option>`);
                    }
                });

                $("#search-btn").click(function() {
                    subject = $('.subject-filter').val();
                    topic = $('.topic-filter').val();
                    question = $('#question-filter').val();
                    page_no = 1;
                    loadQuestions(page_no, page_count);
                    if (subject || topic || question) {
                        $("#reset-btn").removeClass('display-none');
                    }
                });

                $("#reset-btn").click(function() {
                    $('.topic-filter').html('');
                    $('.topic-filter').append(`<option value="">-- Select Topic --</option>`);
                    $('.subject-filter').val("");
                    $('.topic-filter').val("");
                    $('#question-filter').val("");
                    subject = "";
                    topic = ""
                    question = ""
                    page_no = 1;
                    loadQuestions(page_no, page_count);
                    $("#reset-btn").addClass('display-none');
                })

                loadQuestions(page_no, page_count);
                getAllSubjects();


                $('body').on('click', '.remove-question', function() {
                    var status = confirm("Are you sure you want to delete ?");
                    if (status == true) {
                        var questionId = $(this).parents('tr').find('td span.question-id').text();
                        let removeUser = {
                            'token': token,
                            'question_id': questionId,
                        }
                        $.ajax({
                            url: base_url + '/admin/question/delete.php',
                            type: 'POST',
                            dataType: 'JSON',
                            data: JSON.stringify(removeUser),
                            success: function(response) {
                                message = response.message;
                                toastr.success(message);
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            },
                            error: function(error) {
                                toastr.error(error.responseJSON.message);
                            }
                        });
                    }
                });

                $('#checkAll').click(function() {
                    $('#questionData').find('input:checkbox').prop('checked', this.checked);
                });

            } else {
                window.location.replace('index.php');
            }
        });
    </script>
</body>

</html>