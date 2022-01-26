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
                                                    <!-- <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>*Select Category </label>
                                                                    <select id="testCategoryList" name="category_id" class="form-control valid">

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>*Test Instructions</label>
                                                                    <select id="selectInstructionList" name="instruction_id" class="form-control">
                                                                        <option selected="selected" value="">Select Instruction</option>
                                                                    </select>
                                                                </div>
                                                            </div> -->
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
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>*Difficulty Level </label>
                                                            <select name="diffifulty_level" id="AddDifficultyLeval" class="form-control">
                                                                <option value="">Select Level</option>
                                                                <option value="easy">Easy</option>
                                                                <option value="normal">Normal</option>
                                                                <option value="difficult">Difficult</option>
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
                                                <div class="col-md-12">
                                                    <div class="add-question-box-in-test mb-4">
                                                        <i class="fa fa-check-circle fa-5x" aria-hidden="true"></i>
                                                        <p>Directly add questions from the question bank.</p>
                                                        <p>The selected set of questions will be associated to the test</p>
                                                        <button class="btn btn-primary select-question-btn">Select Question</button>
                                                    </div>
                                                    <div class="question-table-in-test display-none">
                                                        <div style="display: flex; justify-content: end;">
                                                            <button class="btn btn-primary select-question-btn">Select Question</button>
                                                        </div>
                                                        <div class="table-responsive">
                                                            <table class="table" id="testQuestionDataTable">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="20px">S.No</th>
                                                                        <th>Questions</th>
                                                                        <th>Subject</th>
                                                                        <th>Chapter</th>
                                                                        <th>Difficulty Level</th>
                                                                        <th width="8%">Marks</th>
                                                                        <th width="3%"></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                            </table>
                                                        </div>
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


      <!-- Add questions Modal Start -->
      <div id="addQuestionsModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" style="width:90vw;">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Questions</h4>
                </div>
                <div class="modal-body">
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

                    <div class="table-responsive mt-3">
                        <table class="table" id="questionData">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th width="5%">S.No.</th>
                                    <th width="55%">Questions Details</th>
                                    <th width="15%">Subject</th>
                                    <th width="20%">Chapter</th>
                                    <th width="5%">Level</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <div class="table-loading-wrap">
                            <div class="loading-img">
                                <img src="./assets/images/loader.gif" alt="loader">
                            </div>
                            <div class="loading-text">
                                Loading...
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary prevPage" disabled>Prev</button>
                            <button class="btn btn-primary nextPage" disabled>Next</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span class="mr-3 question-selected-text"></span>
                    <button type="button" class="btn btn-primary" id="addQuestionForTest">Add Questions for Test</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Add questions Modal End -->

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

                // ***************************
                //  Test Form Submit Section
                // ***************************
                $('#step1Form').validate({
                    rules: {
                        test_name: "required",
                        duration: "required",
                        diffifulty_level: "required",
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
                        diffifulty_level: $('#step1Form [name=diffifulty_level]').val(),
                    }
                    if (testId) {
                        post_data.test_id = testId;
                        $.ajax({
                            url: base_url + '/student/self-assessor/step-1/add.php',
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
                            url: base_url + '/student/self-assessor/step-1/add.php',
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
                        url: base_url + '/student/self-assessor/step-2/add.php',
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
                    var questionsArr = [];
                    var isMarkFilled = true;
                    $("#testQuestionDataTable tbody tr").each(function(v) {
                        var questionObj = {
                            id: $(this).attr('data-id'),
                            marks: $(this).children('td.marks-input-wrap').children('input').val()
                        }
                        if (questionObj.marks == 0 || questionObj.marks == '') {
                            isMarkFilled = false;
                        }
                        questionsArr.push(questionObj);
                    });

                    if (isMarkFilled) {
                        let post_data = {
                            token: token,
                            test_id: testId,
                            questions: questionsArr,
                        }
                        $.ajax({
                            url: base_url + '/student/self-assessor/step-3/add.php',
                            type: 'POST',
                            data: JSON.stringify(post_data),
                            dataType: 'JSON',
                            success: function(result) {
                                toastr.success(result.message); 
                                setTimeout(function() {
                                    window.location.replace('self-assessor.php');
                                }, 1000);
                            },
                            error: function(error) {
                                toastr.error(error.responseJSON.message);
                            }
                        });
                    } else {
                        toastr.error("Please fill marks for all questions.");
                    }
                });
                

                // ********************************
                // Question Modal
                // ********************************
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

                    let url = `${base_url}/student/common/question-list.php`;
                    $('#questionData tbody').html('');
                    $(".table-loading-wrap").removeClass('display-none');
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'JSON',
                        data: paramsData,
                        success: function(result) {
                            questionList = result.result;
                            let countStartAt = ((page_no - 1) * page_count) + 1;
                            totalResults = 24761;
                            $(".total-results-count").text(totalResults);
                            insertQuestionsIntoTable(result, countStartAt);
                            checkNextPreviousButton();
                        }
                    });
                }

                let insertQuestionsIntoTable = function(result, countStartAt) {
                    var tr = '';
                    $('#questionData tbody').html('');
                    $.each(result.result, function(key, value) {
                        tr += `<tr>
                            <td> <input type="checkbox" class="question-checkbox" name="checkQuestion[]" ${selectedQuestions.indexOf(value.id) > -1 ? 'checked' : ''} value="${value.id}" /> </td>
                            <td> ${countStartAt} </td>
                            <td> ${value.question} </td>
                            <td> ${value.subject} </td>
                            <td> ${value.chapter} </td>
                            <td> ${value.difficulty_level} </td></tr>`;
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
                });

                $("#addQuestionsModal").on('click', '.question-checkbox', function() {
                    const selectedQuestionId = parseInt($(this).val());
                    if (selectedQuestions.indexOf(selectedQuestionId) > -1) {
                        const indexNo = selectedQuestions.indexOf(selectedQuestionId);
                        selectedQuestions.splice(indexNo, 1);
                        selectedQuestionsData.splice(indexNo, 1);
                    } else {
                        selectedQuestions.push(parseInt(selectedQuestionId));
                        let selectQuestionObj = questionList.filter(val => val.id == selectedQuestionId)[0];
                        selectQuestionObj.marks = 0;
                        selectedQuestionsData.push(selectQuestionObj);
                    }
                    var questionSelectText = `${selectedQuestions.length} Question${selectedQuestions.length > 1 ? 's' : ''} Selected`
                    $(".question-selected-text").text(questionSelectText);
                });

                $("#addQuestionsModal #addQuestionForTest").click(function() {
                    if (selectedQuestions.length == 0) {
                        toastr.error("Please Select questions for test.");
                    } else {
                        let tr = "";
                        let count = 1;
                        $("#testQuestionDataTable tbody").html("");
                        selectedQuestionsData.forEach(val => {
                            tr += `<tr data-id="${val.id}">
                            <td>${count++}</td>
                            <td>${val.question}</td>
                            <td>${val.subject}</td>
                            <td>${val.chapter}</td>
                            <td>${val.difficulty_level}</td>
                            <td class="marks-input-wrap"><input type="number" min="0" class="form-control"/></td>
                            <td style="vertical-align: middle; cursor:pointer;"><i class="fa fa-times remove-question-item"></i></td>
                            </tr>`;
                        })
                        $("#testQuestionDataTable tbody").append(tr);
                        $("#addQuestionsModal").modal('hide');
                        $(".add-question-box-in-test").hide();
                        $(".question-table-in-test").show();
                    }
                });

                $('#testQuestionDataTable').on('click', '.remove-question-item', function() {
                    var question_id = parseInt($(this).parents('tr').attr('data-id'));
                    if (selectedQuestions.indexOf(question_id) > -1) {
                        const indexNo = selectedQuestions.indexOf(question_id);
                        selectedQuestions.splice(indexNo, 1);
                        selectedQuestionsData.splice(indexNo, 1);
                    }
                    $(this).parents('tr').remove();
                    if (selectedQuestions.length == 0) {
                        $(".add-question-box-in-test").show();
                        $(".question-table-in-test").hide();
                    }
                    $('#testQuestionDataTable tr').each(function(index, el) {
                        $(this).children('td').first().text(index++);
                    });
                });

                $(".select-question-btn").click(function() {
                    $("#addQuestionsModal").modal('show');
                    loadQuestions(page_no, page_count);
                    var questionSelectText = `${selectedQuestions.length} Question${selectedQuestions.length > 1 ? 's' : ''} Selected`
                    $(".question-selected-text").text(questionSelectText);
                })

                loadQuestions(page_no, page_count);
                getAllSubjects();
                // ********************************
                // Question Modal
                // ********************************

            } else {
                window.location.replace('/');
            }
        });
    </script>

</body>

</html>