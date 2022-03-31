<!DOCTYPE html>
<html>

<?php include 'include/head.php' ?>

<body>
    <div id="wrapper">
        <?php include 'include/left_menu.php' ?>
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <?php include 'include/header.php' ?>
            <h1 class="title-primary">Create Test</h1>
            <ul class="breadcrumb">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="test-management-module.php">Test Management</a></li>
                <li>Create Test</li>
            </ul>
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper wrapper-content">
                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-content">
                                        <div class="create-text-page">
                                            <ul class="nav nav-tabs nav-justified">
                                                <li class="active"><a data-toggle="tab" href="#step1">
                                                        <span class="main-span">
                                                            <span><i class="fa fa-file-text-o" aria-hidden="true"></i></span>
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
                                                <li><a data-toggle="tab" href="#step4">
                                                        <span class="main-span">
                                                            <span><i class="fa fa-check-circle" aria-hidden="true"></i></span>
                                                            <span>
                                                                Step 4 <span>Publish Test</span>
                                                            </span>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li><a data-toggle="tab" href="#step5">
                                                        <span class="main-span">
                                                            <span><i class="fa fa-users" aria-hidden="true"></i></span>
                                                            <span>
                                                                Step 5 <span>Assign Test</span>
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
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>*Difficulty Level </label>
                                                                    <select name="diffifulty_level" id="AddDifficultyLeval" class="form-control">
                                                                        <option value="">Select Level</option>
                                                                        <option value="level1">Level 1</option>
                                                                        <option value="level2">Level 2</option>
                                                                        <option value="level3">Level 3</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>*Total Question </label>
                                                                    <input type="text" class="form-control" name="total_questions" />
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
                                                                <label>On Test End Report should be show to student </label><br>
                                                                <label><input type="radio" name="is_report_show" value="1" /> Yes</label> &nbsp;
                                                                <label><input type="radio" name="is_report_show" value="0" checked /> No</label>
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
                                                                <i class="fa fa-check-square-o fa-5x" aria-hidden="true"></i>
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
                                                                                <th>Topic</th>
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
                                                            <button type="button" class="btn btn-primary stepNext" id="step3Form">Save and Next</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="step4" class="tab-pane fade">
                                                    <form action="" id="step4Form">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Publish Test</label><br>
                                                                    <label><input type="radio" name="is_publish" value="1" /> Yes</label> &nbsp;
                                                                    <label><input type="radio" name="is_publish" value="0" checked /> No</label>
                                                                </div>
                                                                <div class="row publish-group display-none">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Start Date</label><br>
                                                                            <input type="date" class="form-control" name="test_start_date" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>End Date</label><br>
                                                                            <input type="date" class="form-control" name="test_end_date" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Start Time</label><br>
                                                                            <input type="time" class="form-control" name="test_start_time" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>End Time</label><br>
                                                                            <input type="time" class="form-control" name="test_end_time" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row m-0">
                                                            <div class="float-right">
                                                                <button type="button" class="btn btn-primary stepPrev">Prev</button>
                                                                <button type="submit" class="btn btn-primary stepNext">Next</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div id="step5" class="tab-pane fade">
                                                    <div class="table-responsive">
                                                        <table class="table" id="groupData">
                                                            <thead>
                                                                <tr>
                                                                    <th width="30px"> <input type="checkbox" id="checkAll" /></th>
                                                                    <th width="50px">S.No.</th>
                                                                    <th>Group Name</th>
                                                                    <th>Candidates</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="row m-0">
                                                        <div class="float-right">
                                                            <button type="button" class="btn btn-primary stepPrev">Prev</button>
                                                            <button type="button" class="btn btn-primary" id="step5Form">Finish</button>
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
                    <?php include 'include/footer.php' ?>
                </div>
            </div>
        </div>
    </div>
    <?php include 'include/footer_script.php' ?>

    <!-- Test Category Modal Start-->
    <div id="addCategoryModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Category</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" class="form-control" name="category_name" data-id="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="categoryData">
                                    <thead>
                                        <tr>
                                            <th width="4%">S.No.</th>
                                            <th width="40%" class="hdng_ctegry">Category Name</th>
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
                    <button type="button" class="btn btn-primary add-category">Save</button>
                    <button type="button" class="btn btn-primary update-category d-custom-none">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Test Category Modal End-->

    <!-- Test Instruction Modal Start -->
    <div id="addInstructionModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Instruction</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Instruction Name </label>
                                <input type="text" class="form-control" name="instruction_name" />
                            </div>
                            <div class="form-group">
                                <label>Description </label>
                                <textarea class="richText" name="instruction_detail"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="instructionData">
                                    <thead>
                                        <tr>
                                            <th width="4%">S.No.</th>
                                            <th width="40%" class="hdng_ctegry">Instruction Name</th>
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
                    <button type="button" class="btn btn-primary add-instruction">Save</button>
                    <button type="button" class="btn btn-primary update-instruction d-custom-none">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Test Instruction Modal End -->


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
                            <select class="form-control" id="phase-filter">
                                <option value="">-- Select Phase --</option>
                            </select>
                        </li>
                        <li>
                            <select class="form-control" id="subject-filter">
                                <option value="">-- Select Subject --</option>
                            </select>
                        </li>
                        <li>
                            <select class="form-control" id="topic-filter">
                                <option value="">-- Select Topic --</option>
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
                                    <th width="20%">Topic</th>
                                    <th width="5%">Level</th>
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

    <script>
        $(function() {
            const token = localStorage.getItem("admin_token");
            if (token) {

                var testId;
                var categoryList;
                var selectedCategory;
                var instructionList;
                var selectedInstruction;
                var selectedQuestions = [];
                var questionList = [];
                var selectedQuestionsData = [];

                // ***********************
                // category section
                // ***********************
                var getCategoryList = function() {
                    const url = `${base_url}/admin/test/category/list.php`;
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'JSON',
                        data: {
                            token: token
                        },
                        success: function(result) {
                            categoryList = result.result;
                            var index = 1;
                            var trHTML = '';
                            let categoryOptions = '';
                            categoryOptions = '';
                            $('#categoryData tbody').html('');
                            $('#testCategoryList').html('<option value="">Select Category</option>');
                            $.each(result.result, function(key, value) {
                                trHTML +=
                                    `<tr id="${value.id}">
                                <td>${index++}</td>
                                <td>${value.name}</td>
                                <td class="text-center">
                                    <ul class="action-list">
                                    <li class="update-category-icon"><i class="fa fa-pencil"></i></li>
                                    <li class="remove-category"><i class="fa fa-trash-o"></i></li>
                                    </ul>
                                </td>
                                </tr>`;
                                categoryOptions += `<option value="${value.id}">${value.name}</option>`
                            });
                            $('#categoryData tbody').append(trHTML);
                            $('#testCategoryList').append(categoryOptions + '<option value="addCategory" class="boldItalic">Add Category</option>');

                        }
                    });
                }

                getCategoryList();

                $('body').on('click', '.remove-category', function() {
                    var status = confirm("Are you sure to delete this test category ?");
                    if (status == true) {
                        let categoryId = $(this).parents('tr').attr('id');
                        let deleteFile = {
                            'token': token,
                            'id': categoryId,
                        }
                        $.ajax({
                            url: base_url + '/admin/test/category/delete.php',
                            type: 'POST',
                            dataType: 'JSON',
                            data: JSON.stringify(deleteFile),
                            success: function(response) {
                                toastr.success(response.message);
                                getCategoryList();
                            },
                            error: function(error) {
                                toastr.error(error.responseJSON.message);
                            }
                        });
                    }
                });

                $('body').on('click', '.update-category-icon', function() {
                    selectedCategory = $(this).parents('tr').attr('id');
                    const selectedCateogryData = categoryList.filter(v => v.id == selectedCategory)[0];
                    $('#addCategoryModal [name=category_name]').val(selectedCateogryData.name);
                    $('#addCategoryModal button.add-category').hide();
                    $('#addCategoryModal button.update-category').show();
                });

                $('body').on('click', '.update-category', function() {
                    if (!$('[name=category_name]').val() == '') {
                        let update_data = {
                            "token": token,
                            "name": $('#addCategoryModal [name="category_name"]').val(),
                            "category_id": selectedCategory
                        }
                        $.ajax({
                            url: base_url + '/admin/test/category/update.php',
                            type: 'POST',
                            data: JSON.stringify(update_data),
                            dataType: 'JSON',
                            success: function(result) {
                                toastr.success(result.message);
                                $('#addCategoryModal [name=category_name]').val("");
                                $('#addCategoryModal button.add-category').show();
                                $('#addCategoryModal button.update-category').hide();
                                getCategoryList();
                            },
                            error: function(error) {
                                toastr.error(error.responseJSON.message);
                            }
                        });
                    } else {
                        toastr.error('Please Enter Category Name');
                        $('[name=category_name]').focus();
                    }
                });

                $('body').on('click', '.add-category', function() {
                    if (!$('[name=category_name]').val() == '') {
                        let post_data = {
                            "token": token,
                            "name": $('[name=category_name]').val()
                        }
                        $.ajax({
                            url: base_url + '/admin/test/category/add.php',
                            type: 'POST',
                            data: JSON.stringify(post_data),
                            dataType: 'JSON',
                            success: function(result) {
                                toastr.success(result.message);
                                $('#addCategoryModal').modal('hide');
                                getCategoryList();
                            },
                            error: function(error) {
                                toastr.error(error.responseJSON.message);
                            }
                        });

                    } else {
                        toastr.error('Please Enter Category Name');
                        $('#addCategoryModal [name=category_name]').focus();
                    }
                });

                $("#testCategoryList").change(function() {
                    if ($(this).val() == 'addCategory') {
                        $('#addCategoryModal').modal('show');
                        $(this).val('');
                        selectedCategory = undefined;
                        $('#addCategoryModal [name=category_name]').val("");
                        $('#addCategoryModal button.add-category').show();
                        $('#addCategoryModal button.update-category').hide();
                    }
                });

                // ***********************
                // category section
                // ***********************

                // ***********************
                // Test Instruction section
                // ***********************
                var getInstruction = function() {
                    const url = `${base_url}/admin/test/instruction/list.php`;
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'JSON',
                        data: {
                            token: token
                        },
                        success: function(result) {
                            instructionList = result.result;
                            var index = 1;
                            var trHTML = '';
                            var testInstructionList = '';
                            $('#selectInstructionList').html('<option value="">Select Instruction</option>');
                            $('#instructionData tbody').html('');
                            $.each(instructionList, function(key, value) {
                                trHTML +=
                                    `<tr id="${value.id}">
                                <td> ${index++} </td>
                                <td>${value.name}</td>
                                <td class="text-center">
                                    <ul class="action-list">
                                    <li class="update-instruction-icon"><i class="fa fa-pencil"></i></li>
                                    <li class="remove-instruction"><i class="fa fa-trash-o"></i></li>
                                    </ul>
                                </td>
                                </tr>`;
                                testInstructionList += `<option value="${value.id}">${value.name}</option>`
                            });
                            $('#instructionData tbody').append(trHTML);
                            $('#selectInstructionList').append(testInstructionList + '<option value="addInstruction" class="boldItalic">Add Instruction</option>');
                        }
                    });
                }

                getInstruction()

                $('body').on('click', '.remove-instruction', function() {
                    var status = confirm("Are you sure to delete this test instruction?");
                    if (status == true) {
                        let instructionId = $(this).parents('tr').attr('id');
                        let deleteFile = {
                            'token': token,
                            'id': instructionId,
                        }
                        $.ajax({
                            url: base_url + '/admin/test/instruction/delete.php',
                            type: 'POST',
                            dataType: 'JSON',
                            data: JSON.stringify(deleteFile),
                            success: function(response) {
                                toastr.success(response.message);
                                getInstruction();
                            },
                            error: function(error) {
                                toastr.error(error.responseJSON.message);
                            }
                        });
                    }
                });

                $('body').on('click', '.update-instruction-icon ', function() {
                    selectedInstruction = $(this).parents('tr').attr('id');
                    const selectedInstructionData = instructionList.filter(v => v.id == selectedInstruction)[0];
                    $('#addInstructionModal [name=instruction_name]').val(selectedInstructionData.name);
                    $('#addInstructionModal [name=instruction_detail]').val(selectedInstructionData.detail);
                    $('#addInstructionModal button.add-instruction').hide();
                    $('#addInstructionModal button.update-instruction').show();
                });

                $('body').on('click', '#addInstructionModal .update-instruction', function() {
                    if (!$('#addInstructionModal [name=instruction_name]').val() == '') {
                        let update_data = {
                            "token": token,
                            "name": $('#addInstructionModal [name="instruction_name"]').val(),
                            "detail": $('#addInstructionModal [name="instruction_detail"]').val(),
                            "instruction_id": selectedInstruction
                        }
                        $.ajax({
                            url: base_url + '/admin/test/instruction/update.php',
                            type: 'POST',
                            data: JSON.stringify(update_data),
                            dataType: 'JSON',
                            success: function(result) {
                                toastr.success(result.message);
                                $('#addInstructionModal [name="instruction_name"]').val("");
                                $('#addInstructionModal [name="instruction_detail"]').val("");
                                $('#addInstructionModal button.add-instruction').show();
                                $('#addInstructionModal button.update-instruction').hide();
                                getInstruction();
                            },
                            error: function(error) {
                                toastr.error(error.responseJSON.message);
                            }
                        });
                    } else {
                        toastr.error('Please Enter Instruction Name');
                        $('#addInstructionModal [name=instruction_name]').focus();
                    }
                });

                $('body').on('click', '.add-instruction', function() {
                    if (!$('#addInstructionModal [name=instruction_name]').val() == '') {
                        let post_data = {
                            "token": token,
                            "name": $('#addInstructionModal [name=instruction_name]').val(),
                            "detail": $('#addInstructionModal [name=instruction_detail]').val()
                        }
                        $.ajax({
                            url: base_url + '/admin/test/instruction/add.php',
                            type: 'POST',
                            data: JSON.stringify(post_data),
                            dataType: 'JSON',
                            success: function(result) {
                                toastr.success(result.message);
                                $('#addInstructionModal').modal('hide');
                                getInstruction();
                            },
                            error: function(error) {
                                toastr.error(error.responseJSON.message);
                            }
                        });

                    } else {
                        toastr.error('Please Enter Instruction Name');
                        $('[name=instruction_name]').focus();
                    }
                });

                $("#selectInstructionList").change(function() {
                    if ($(this).val() == 'addInstruction') {
                        $('#addInstructionModal').modal('show');
                        $(this).val('');
                        selectedInstruction = undefined;
                        $('#addInstructionModal [name=instruction_name]').val('')
                        $('#addInstructionModal [name=instruction_detail]').val('')
                        $('#addInstructionModal button.add-instruction').show();
                        $('#addInstructionModal button.update-instruction').hide();
                    }
                });

                // ***********************
                // Test Instruction section
                // ***********************


                // ***************************
                //  Test Form Submit Section
                // ***************************
                $('#step1Form').validate({
                    rules: {
                        test_name: "required",
                        category_id: "required",
                        instruction_id: "required",
                        duration: "required",
                        diffifulty_level: "required",
                        total_questions: "required"
                    },
                    submitHandler: function(form) {
                        setp_1_form_submit();
                    }
                });

                function setp_1_form_submit() {
                    let post_data = {
                        token: token,
                        test_name: $('#step1Form [name=test_name]').val(),
                        category_id: $('#step1Form [name=category_id]').val(),
                        instruction_id: $('#step1Form [name=instruction_id]').val(),
                        duration: $('#step1Form [name=duration]').val(),
                        diffifulty_level: $('#step1Form [name=diffifulty_level]').val(),
                        total_questions: $('#step1Form [name=total_questions]').val()
                    }
                    if (testId) {
                        post_data.test_id = testId;
                        $.ajax({
                            url: base_url + '/admin/test/step-1/update.php',
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
                            url: base_url + '/admin/test/step-1/add.php',
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
                        "is_report_show": $('[name=is_report_show]:checked').val(),
                        "is_mandatory_all_question": $('[name=is_mandatory_all_question]:checked').val(),
                        "test_timing_pattern": $('[name=test_timing_pattern]:checked').val(),
                    }
                    $.ajax({
                        url: base_url + '/admin/test/step-2/add.php',
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
                            url: base_url + '/admin/test/step-3/add.php',
                            type: 'POST',
                            data: JSON.stringify(post_data),
                            dataType: 'JSON',
                            success: function(result) {
                                toastr.success(result.message);
                                $('.nav-tabs a[href="#step4"]').tab('show');
                            },
                            error: function(error) {
                                toastr.error(error.responseJSON.message);
                            }
                        });
                    } else {
                        toastr.error("Please fill marks for all questions.");
                    }
                });


                //  test step4 begin here
                $('#step4Form').validate({
                    rules: {
                        test_start_date: "required",
                        test_end_date: "required",
                        test_start_time: "required",
                        test_end_time: "required"
                    },
                    submitHandler: function(form) {
                        submitForm4();
                    }
                });

                function submitForm4() {
                    let post_data = {
                        "token": token,
                        "test_id": testId,
                        "is_publish": $('[name=is_publish]:checked').val(),
                        "test_start_date": $('[name=test_start_date]').val(),
                        "test_end_date": $('[name=test_end_date]').val(),
                        "test_start_time": $('[name=test_start_time]').val(),
                        "test_end_time": $('[name=test_end_time]').val(),
                    }
                    $.ajax({
                        url: base_url + '/admin/test/step-4/add.php',
                        type: 'POST',
                        data: JSON.stringify(post_data),
                        dataType: 'JSON',
                        success: function(result) {
                            toastr.success(result.message);
                            $('.nav-tabs a[href="#step5"]').tab('show');
                        },
                        error: function(error) {
                            toastr.error(error.responseJSON.message);
                        }
                    });

                };

                //  test step5 begin here
                $('#step5Form').click(function() {
                    var group_id_checked = [];
                    $('input[name=group_id]:checked').each(function() {
                        group_id_checked.push(parseInt($(this).val()));
                    });
                    let post_data5 = {
                        "token": token,
                        "test_id": testId,
                        "group_id": group_id_checked,
                    }
                    if ($('[name=group_id]:checked').val()) {
                        // console.log(post_data5);
                        $.ajax({
                            url: base_url + '/admin/test/step-5/add.php',
                            type: 'POST',
                            data: JSON.stringify(post_data5),
                            dataType: 'JSON',
                            success: function(result) {
                                toastr.success(result.message);
                                setTimeout(function() {
                                    window.location.replace('test-management-module.php');
                                }, 1000);
                            },
                            error: function(error) {
                                // toastr.error(error.responseJSON.message);
                            }
                        });
                    } else {
                        toastr.error('Please select Group');
                    }

                });

                $.ajax({
                    url: base_url + '/admin/student/group-list.php?token',
                    type: 'GET',
                    data: {
                        token: token
                    },
                    dataType: 'JSON',
                    success: function(result) {
                        var index = 1;
                        var trHTML = '';
                        $.each(result.result, function(key, value) {
                            trHTML +=
                                '<tr><td><input type="checkbox" name="group_id" value="' + value.id + '" />' +
                                '</td><td>' + index++ +
                                '</td><td>' + value.name +
                                '</td><td>' + value.no_of_students + '</td></tr>';
                        });
                        $('#groupData').append(trHTML);
                    }
                });

                $('#checkAll').click(function() {
                    $('#groupData').find('input:checkbox').prop('checked', this.checked);
                });

                // ********************************
                // Question Modal
                // ********************************
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
                            <td> ${value.topic} </td>
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
                                    $('#phase-filter').append(`<option value="${val.id}">${val.name}</option>`)
                                })
                            }

                        }
                    });
                }

                var subjectArray = [];
                $('#phase-filter').change(function(val) {
                    $this = $(this);
                    phase = $(this).val();
                    if (phase) {
                        allPhase.forEach(val => {
                            if (val.id == phase) {
                                subjectArray = val.subject;
                                $this.parents('ul').find('#topic-filter').html('');
                                $this.parents('ul').find('#topic-filter').append(`<option value="">-- Select Topic --</option>`);
                                $this.parents('ul').find('#subject-filter').html('');
                                $this.parents('ul').find('#subject-filter').append(`<option value="">-- Select Subject --</option>`);
                                val.subject.forEach(subject => {
                                    $this.parents('ul').find('#subject-filter').append(`<option value="${subject.id}">${subject.name}</option>`)
                                })
                            }
                        });
                    }
                });

                $('body').on('change', '#subject-filter', function(val) {
                    $this = $(this);
                    subject = $(this).val();
                    if (subject) {
                        subjectArray.forEach(val => {
                            if (val.id == subject) {
                                $this.parents('ul').find('#topic-filter').html('');
                                $this.parents('ul').find('#topic-filter').append(`<option value="">-- Select Topic --</option>`);
                                val.topic.forEach(topic => {
                                    $this.parents('ul').find('#topic-filter').append(`<option value="${topic.id}">${topic.name}</option>`)
                                });

                            }
                        })
                    }
                });

                $("#search-btn").click(function() {
                    subject = $('#subject-filter').val();
                    topic = $('#topic-filter').val();
                    question = $('#question-filter').val();
                    page_no = 1;
                    loadQuestions(page_no, page_count);
                    if (subject || topic || question) {
                        $("#reset-btn").removeClass('display-none');
                    }
                });

                $("#reset-btn").click(function() {
                    $('#topic-filter').html('');
                    $('#topic-filter').append(`<option value="">-- Select Topic --</option>`);
                    $('#subject-filter').val("");
                    $('#topic-filter').val("");
                    $('#question-filter').val("");
                    subject = "";
                    topic = ""
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
                            <td>${val.topic}</td>
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

                $('[name=is_publish]').click(function() {
                    if ($(this).val() == '1') {
                        $('.publish-group').show();
                    } else {
                        $('.publish-group').hide();
                    }
                });

            } else {
                window.location.replace('index.php');
            }
        });
    </script>

</body>

</html>