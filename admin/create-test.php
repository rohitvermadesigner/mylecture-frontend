<!DOCTYPE html>
<html>

<?php include 'include/head.php' ?>

<body>
    <div id="wrapper">

        <?php include 'include/left_menu.php' ?>

        <div id="page-wrapper" class="gray-bg dashbard-1">

            <?php include 'include/header.php' ?>
            <h1 class="title-primary">Create Test</h1>
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
                                                    </a></li>
                                                <li><a data-toggle="tab" href="#step2">
                                                        <span class="main-span">
                                                            <span><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                            <span>
                                                                Step 2 <span>Test Setting</span>
                                                            </span>
                                                        </span>
                                                    </a></li>
                                                <li><a data-toggle="tab" href="#step3">
                                                        <span class="main-span">
                                                            <span><i class="fa fa-question-circle" aria-hidden="true"></i></span>
                                                            <span>
                                                                Step 3 <span>Add Questions</span>
                                                            </span>
                                                        </span>
                                                    </a></li>
                                                <li><a data-toggle="tab" href="#step4">
                                                        <span class="main-span">
                                                            <span><i class="fa fa-check-circle" aria-hidden="true"></i></span>
                                                            <span>
                                                                Step 4 <span>Publish Test</span>
                                                            </span>
                                                        </span>
                                                    </a></li>
                                                <li><a data-toggle="tab" href="#step5">
                                                        <span class="main-span">
                                                            <span><i class="fa fa-users" aria-hidden="true"></i></span>
                                                            <span>
                                                                Step 5 <span>Assign Test</span>
                                                            </span>
                                                        </span>
                                                    </a></li>
                                            </ul>

                                            <div class="tab-content">
                                                <div id="step1" class="tab-pane fade">
                                                    <form action="" id="step1Form">
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
                                                                    <select id="selectList" name="category_id" class="form-control valid">
                                                                        <option value="">Select a Category</option>
                                                                    </select>
                                                                    <!-- <select id="addCategory" name="category_id" class="form-control">
                                                                        <option value="">Select a Category</option>
                                                                        <option value="all_test">All Test</option>
                                                                        <option value="category2">Category 2</option>
                                                                        <option value="addCategory" class="boldItalic">Add Category</option>
                                                                    </select> -->
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
                                                                    <input type="text" class="form-control" name="duration" />
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
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>*Total Question </label>
                                                                    <input type="text" class="form-control" name="total_questions" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row m-0">
                                                            <div class="float-right">
                                                                <button type="submit" class="btn btn-primary stepNext">Next</button>
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
                                                        <!-- <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Allow user to move back and forward </label><br>
                                                                <label><input type="radio" /> Yes</label> &nbsp;
                                                                <label><input type="radio" checked /> No</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Allow user to mark review to any question </label><br>
                                                                <label><input type="radio" /> Yes</label> &nbsp;
                                                                <label><input type="radio" checked /> No</label>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                    <div class="row m-0">
                                                        <div class="float-right">
                                                            <button type="button" class="btn btn-primary stepPrev">Prev</button>
                                                            <button type="button" class="btn btn-primary stepNext" id="step2Form">Next</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="step3" class="tab-pane fade in active">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="add-question-box-in-test">
                                                                <i class="fa fa-check-square-o fa-5x" aria-hidden="true"></i>
                                                                <p>Directly add questions from the question bank.</p>
                                                                <p>The selected set of questions will be associated to the test</p>
                                                                <button class="btn btn-primary" data-toggle="modal" data-target="#addQuestionsModal">Select Question</button>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <hr>
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th width="20px">S.No</th>
                                                                            <th>Questions</th>
                                                                            <th width="20">Marks</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>1</td>
                                                                            <td>"New Systematics" introduced by Sir Julian Huxley in 1940 is also known as</td>
                                                                            <td><input type="text" class="form-control" /></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>2</td>
                                                                            <td>"New Systematics" introduced by Sir Julian Huxley in 1940 is also known as</td>
                                                                            <td><input type="text" class="form-control" /></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row m-0">
                                                        <div class="float-right">
                                                            <button type="button" class="btn btn-primary stepPrev">Prev</button>
                                                            <button type="button" class="btn btn-primary stepNext">Next</button>
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
                                                                <div class="row">
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
                                                                    <th width="30px">&nbsp;</th>
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

    <!-- Modal -->
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

    <!-- Modal -->
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
                                        <!-- <tr>
                                            <td class="text-center">1 </td>
                                            <td>All Test</td>
                                            <td class="action-td"><span class="remove-test" title="Remove Test"><i class="fa fa-trash-o" aria-hidden="true"></i></span> &nbsp; <span><i class="fa fa-pencil" aria-hidden="true"></i></span></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">1 </td>
                                            <td>All Test</td>
                                            <td class="action-td"><span class="remove-test" title="Remove Test"><i class="fa fa-trash-o" aria-hidden="true"></i></span> &nbsp; <span><i class="fa fa-pencil" aria-hidden="true"></i></span></td>
                                        </tr> -->
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


    <!-- Modal -->
    <div id="addQuestionsModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

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
                                    <!-- <th><input type="checkbox"></th> -->
                                    <th></th>
                                    <th width="5%">S.No.</th>
                                    <th width="55%">Questions Details</th>
                                    <th width="15%">Subject</th>
                                    <th width="20%">Chapter</th>
                                    <th width="5%">Level</th>
                                    <!-- <th>Action</th> -->
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
                    <button type="button" class="btn btn-primary" id="step3Form">Add Questions to Test</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <script>
        $(function() {
            const token = localStorage.getItem("admin_token");
            const testId = localStorage.getItem("testId");
            if (token) {

                // category begin here
                $.ajax({
                    url: `${base_url}/admin/test/category/list.php`,
                    type: 'GET',
                    dataType: 'JSON',
                    data: {
                        token: token
                    },
                    success: function(result) {
                        var index = 1;
                        var trHTML = '';
                        $.each(result.result, function(key, value) {
                            trHTML +=
                                `<tr>
                            <td> ${index++} </td>
                            <td> <span class="category-name">${value.name}</span> <span class="category-id hidden-id">${value.id}</span> </td>
                            <td class="text-center">
                            <ul class="action-list">
                            <li class="update-category-icon"><i class="fa fa-pencil"></i></li>
                            <li class="remove-category"><i class="fa fa-trash-o"></i></li>
                            </ul>
                            </td>
                            </tr>`;
                        });
                        $('#categoryData tbody').append(trHTML);

                        $.each(result.result, function(key, value) {
                            selectList +=
                                `   <option value="${value.name}">${value.name}</option>`
                        });
                        $('#selectList').append(selectList + '<option value="addCategory" class="boldItalic">Add Category</option>');
                    }
                });

                $('body').on('click', '.remove-category', function() {
                    var status = confirm("Are you sure you want to delete ?");
                    if (status == true) {
                        let categoryId = $(this).parents('tr').find('td span.category-id').text();
                        let categoryTr = $(this).parents('tr');
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
                                $(categoryTr).remove();
                            },
                            error: function(error) {
                                toastr.error(error.message);
                            }
                        });
                    }
                });

                $('body').on('click', '.update-category-icon', function() {
                    $('[name=category_name]').val($(this).parents('tr').find('.category-name').text());
                    $('[name=category_name]').attr('data-id', $(this).parents('tr').find('.category-id').text());
                    $('button.add-category').hide();
                    $('button.update-category').show();
                });

                $('body').on('click', '.update-category', function() {
                    if (!$('[name=category_name]').val() == '') {
                        let update_data = {
                            "token": token,
                            "name": $('[name="category_name"]').val(),
                            "category_id": $('[name="category_name"]').attr('data-id')
                        }
                        $.ajax({
                            url: base_url + '/admin/test/category/update.php',
                            type: 'POST',
                            data: JSON.stringify(update_data),
                            dataType: 'JSON',
                            success: function(result) {
                                toastr.success(result.message);
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
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
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
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

                // instruction begin here
                $.ajax({
                    url: `${base_url}/admin/test/instruction/list.php`,
                    type: 'GET',
                    dataType: 'JSON',
                    data: {
                        token: token
                    },
                    success: function(result) {
                        var index = 1;
                        var trHTML = '';
                        $.each(result.result, function(key, value) {
                            trHTML +=
                                `<tr>
                            <td> ${index++} </td>
                            <td> <span class="instruction-name">${value.name}</span> <span class="instruction-id hidden-id">${value.id}</span> <span class="instruction-detail hidden-id">${value.detail}</span> </td>
                            <td class="text-center">
                            <ul class="action-list">
                            <li class="update-instruction-icon"><i class="fa fa-pencil"></i></li>
                            <li class="remove-instruction"><i class="fa fa-trash-o"></i></li>
                            </ul>
                            </td>
                            </tr>`;
                        });
                        $('#instructionData tbody').append(trHTML);

                        $.each(result.result, function(key, value) {
                            selectInstructionList +=
                                `   <option value="${value.name}">${value.name}</option>`
                        });
                        $('#selectInstructionList').append(selectInstructionList + '<option value="addInstruction" class="boldItalic"> Add Instruction </option>');
                    }
                });

                $('body').on('click', '.remove-instruction', function() {
                    var status = confirm("Are you sure you want to delete ?");
                    if (status == true) {
                        let instructionId = $(this).parents('tr').find('td span.instruction-id').text();
                        let instructionTr = $(this).parents('tr');
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
                                $(instructionTr).remove();
                            },
                            error: function(error) {
                                toastr.error(error.message);
                            }
                        });
                    }
                });

                $('body').on('click', '.update-instruction-icon ', function() {
                    $('[name=instruction_name]').val($(this).parents('tr').find('.instruction-name').text());
                    $('[name=instruction_name]').attr('data-id', $(this).parents('tr').find('.instruction-id').text());
                    $('[name=instruction_detail]').val($(this).parents('tr').find('.instruction-detail').text());
                    $('button.add-instruction').hide();
                    $('button.update-instruction').show();
                });

                $('body').on('click', '.update-instruction', function() {
                    if (!$('[name=instruction_name]').val() == '') {
                        let update_data = {
                            "token": token,
                            "name": $('[name="instruction_name"]').val(),
                            "detail": $('[name="instruction_detail"]').val(),
                            "instruction_id": $('[name="instruction_name"]').attr('data-id')
                        }
                        $.ajax({
                            url: base_url + '/admin/test/instruction/update.php',
                            type: 'POST',
                            data: JSON.stringify(update_data),
                            dataType: 'JSON',
                            success: function(result) {
                                toastr.success(result.message);
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
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

                $('body').on('click', '.add-instruction', function() {
                    if (!$('[name=instruction_name]').val() == '') {
                        let post_data = {
                            "token": token,
                            "name": $('[name=instruction_name]').val(),
                            "detail": $('[name=instruction_detail]').val()
                        }
                        $.ajax({
                            url: base_url + '/admin/test/instruction/add.php',
                            type: 'POST',
                            data: JSON.stringify(post_data),
                            dataType: 'JSON',
                            success: function(result) {
                                toastr.success(result.message);
                                $('#addInstructionModal').modal('hide');
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
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

                //  test step1 begin here
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
                        submitForm1();
                    }
                });

                function submitForm1() {
                    let post_data = {
                        "token": token,
                        "test_name": $('[name=test_name]').val(),
                        "category_id": $('[name=category_id] option:selected').val(),
                        "instruction_id": $('[name=instruction_id] option:selected').val(),
                        "duration": $('[name=duration]').val(),
                        "diffifulty_level": $('[name=diffifulty_level] option:selected').val(),
                        "total_questions": $('[name=total_questions]').val()
                    }
                    $.ajax({
                        url: base_url + '/admin/test/step-1/add.php',
                        type: 'POST',
                        data: JSON.stringify(post_data),
                        dataType: 'JSON',
                        success: function(result) {
                            toastr.success(result.message);
                            localStorage.setItem("testId", result.id);
                            $('.nav-tabs a[href="#step2"]').tab('show');
                        },
                        error: function(error) {
                            toastr.error(error.responseJSON.message);
                        }
                    });
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
                    let checkboxes = $('#questionData input');
                    let questionsData = [];

                    // $('#questionData input[name="checkQuestion"]:checked').each(function() {
                    //   "id" + this.value;
                    // });
                    

                    for (var i = 0; i < checkboxes.length; i++) {
                        if (checkboxes[i].checked) {
                            questionsData.push(parseInt(checkboxes[i].value));
                        }
                    }
                    let post_data = {
                        "token": token,
                        "test_id": testId,
                        "questions": questionsData,
                        // "questions": [{
                        //         "id": "1",
                        //         "marks": "20"
                        //     },
                        //     {
                        //         "id": "2",
                        //         "marks": "30"
                        //     },
                        //     {
                        //         "id": "4",
                        //         "marks": "50"
                        //     }, {
                        //         "id": "7",
                        //         "marks": "20"
                        //     },
                        //     {
                        //         "id": "6",
                        //         "marks": "30"
                        //     }
                        // ]
                    }
                    console.log(post_data);
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
                    let post_data5 = {
                        "token": token,
                        "test_id": testId,
                        "group_id": $('[name=group_id]:checked').val(),
                    }
                    if ($('[name=group_id]:checked').val()) {
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
                                '<tr><td><input type="radio" name="group_id" value="' + value.id + '" />' +
                                '</td><td>' + index++ +
                                '</td><td>' + value.name +
                                '</td><td>' + value.no_of_students + '</td></tr>';
                        });
                        $('#groupData').append(trHTML);
                    }
                });


                // question modal begin here
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
                            totalResults = 24761;
                            $(".total-results-count").text(totalResults);
                            insertQuestionsIntoTable(result, countStartAt);
                            checkNextPreviousButton();
                        }
                    });
                }

                let insertQuestionsIntoTable = function(result, countStartAt) {

                    var tr = '';
                    $.each(result.result, function(key, value) {
                        tr += `<tr>
                            <td> <input type="checkbox" name="checkQuestion" value="${value.id}" /> </td>
                            <td> ${countStartAt} </td>
                            <td> ${value.question} </td>
                            <td> ${value.subject} </td>
                            <td> ${value.chapter} </td>
                            <td> ${value.difficulty_level} </td></tr>`;
                        countStartAt++;
                        // '</td><td><span class="remove-question" title="Remove Question"><i class="fa fa-trash-alt"></i></span><span><i class="far fa-edit"></i></span></td></tr>';
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

            } else {
                window.location.replace('index.php');
            }
        });
    </script>

</body>

</html>