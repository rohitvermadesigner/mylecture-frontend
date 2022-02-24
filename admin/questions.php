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
                                        <ul class="filter-list">
                                            <li>
                                                <select class="form-control" id="subject-filter">
                                                    <option value="">-- Select Subject --</option>
                                                </select>
                                            </li>
                                            <li>
                                                <select class="form-control" id="chapter-filter">
                                                    <option value="">-- Select Chapter --</option>
                                                </select>
                                            </li>
                                            <li>
                                                <input type="search" class="form-control" id="question-filter" placeholder="Type Question..">
                                            </li>
                                            <li>
                                                <button class="btn btn-primary" id="search-btn">Search</button>
                                                <button class="btn btn-danger display-none" id="reset-btn">Reset</button>
                                            </li>
                                        </ul>
                                        <div>
                                            <ul class="top-right-btn-list">
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
                                            <table class="table" id="questionData">
                                                <thead>
                                                    <tr>
                                                        <!-- <th><input type="checkbox"></th> -->
                                                        <th width="5%">S.No.</th>
                                                        <th width="55%">Questions Details</th>
                                                        <th width="15%">Subject</th>
                                                        <th width="20%">Chapter</th>
                                                        <th width="5%">Level</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                            <!-- <div class="table-loading-wrap">
                                                <div class="loading-img">
                                                    <img src="./assets/img/loader.gif" alt="loader">
                                                </div>
                                                <div class="loading-text">
                                                    Loading...
                                                </div>
                                            </div> -->
                                            <div class="text-center">
                                                <button class="btn btn-primary prevPage" disabled>Prev</button>
                                                <button class="btn btn-primary nextPage" disabled>Next</button>
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
    <script>
        $(function() {
            const token = localStorage.getItem("admin_token");
            if (token) {
                let page_no = 1;
                let page_count = 10;
                let totalResults = 0;
                let subject = '';
                let chapter = '';
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
                    if (chapter) {
                        paramsData.chapter = chapter
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
                            insertQuestionsIntoTable(result, countStartAt);
                            checkNextPreviousButton();
                        }
                    });
                }

                let insertQuestionsIntoTable = function(result, countStartAt) {

                    var tr = '';
                    $.each(result.result, function(key, value) {
                        tr += `<tr>
                            <td> ${countStartAt} </td>
                            <td> ${value.question} </td>
                            <td> ${value.subject} </td>
                            <td> ${value.chapter} </td>
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
                            allSubjects = result;
                            if (allSubjects && allSubjects.length > 0) {
                                allSubjects.forEach(val => {
                                    $('#subject-filter').append(`<option value="${val.id}">${val.name}</option>`)
                                })
                            }
                        }
                    });
                }

                $('#subject-filter').change(function(val) {
                    subject = $('#subject-filter').val();
                    if (subject) {
                        allSubjects.forEach(val => {
                            if (val.id == subject) {
                                $('#chapter-filter').html('');
                                $('#chapter-filter').append(`<option value="">-- Select Chapter --</option>`);
                                val.chapter.forEach(chapter => {
                                    $('#chapter-filter').append(`<option value="${chapter.id}">${chapter.name}</option>`)
                                })
                            }

                        })
                    }

                });

                $("#search-btn").click(function() {
                    subject = $('#subject-filter').val();
                    chapter = $('#chapter-filter').val();
                    question = $('#question-filter').val();
                    page_no = 1;
                    loadQuestions(page_no, page_count);
                    if (subject || chapter || question) {
                        $("#reset-btn").removeClass('display-none');
                    }
                });

                $("#reset-btn").click(function() {
                    $('#chapter-filter').html('');
                    $('#chapter-filter').append(`<option value="">-- Select Chapter --</option>`);
                    $('#subject-filter').val("");
                    $('#chapter-filter').val("");
                    $('#question-filter').val("");
                    subject = "";
                    chapter = ""
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
                                toastr.error(message);
                            }
                        });
                    }
                });
            } else {
                window.location.replace('index.php');
            }
        });
    </script>
</body>

</html>