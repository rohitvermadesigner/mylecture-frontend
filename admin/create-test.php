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
                                                <div id="step1" class="tab-pane fade in active">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>*Test Name </label>
                                                                <input type="text" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>*Select Category </label>
                                                                <select id="addCategory" name="" class="form-control">
                                                                    <option value="0">Select a Category</option>
                                                                    <option value="">All Test</option>
                                                                    <option value="">Hello Rishabh</option>
                                                                    <option value="addCategory" class="boldItalic">Add Category</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>*Test Instructions</label>
                                                                <select id="addInstruction" name="" class="form-control">
                                                                    <option selected="selected" value="0">Select Instruction</option>
                                                                    <option value="331357">Common Instructions</option>
                                                                    <option value="331360">Instruction 1</option>
                                                                    <option value="addInstruction" class="boldItalic"> Add Instruction </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>*Duration (In Min.) </label>
                                                                <input type="text" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>*Difficulty Level </label>
                                                                <select name="" id="AddDifficultyLeval" class="form-control">
                                                                    <option value="2">Difficult</option>
                                                                    <option value="1">Easy</option>
                                                                    <option value="3">Normal</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>*Total Question </label>
                                                                <input type="text" class="form-control" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row m-0">
                                                        <div class="float-right">
                                                            <button type="button" class="btn btn-primary stepNext">Next</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="step2" class="tab-pane fade">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Questions should be random order </label><br>
                                                                <label><input type="radio" /> Yes</label> &nbsp;
                                                                <label><input type="radio" checked /> No</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>On Test End Report should be show to student </label><br>
                                                                <label><input type="radio" /> Yes</label> &nbsp;
                                                                <label><input type="radio" checked /> No</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Mandatory to attempt all question </label><br>
                                                                <label><input type="radio" /> Yes</label> &nbsp;
                                                                <label><input type="radio" checked /> No</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Test Timing </label><br>
                                                                <label><input type="radio" /> hh:mm:ss</label> &nbsp;
                                                                <label><input type="radio" checked /> mm:ss</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
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
                                                        </div>
                                                    </div>
                                                    <div class="row m-0">
                                                        <div class="float-right">
                                                            <button type="button" class="btn btn-primary stepPrev">Prev</button>
                                                            <button type="button" class="btn btn-primary stepNext">Next</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="step3" class="tab-pane fade">
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
                                                                            <th width="20px"><input type="checkbox" /></th>
                                                                            <th width="20px">S.No</th>
                                                                            <th>Questions</th>
                                                                            <th width="20">Marks</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td><input type="checkbox" /></td>
                                                                            <td>1</td>
                                                                            <td>"New Systematics" introduced by Sir Julian Huxley in 1940 is also known as</td>
                                                                            <td><input type="text" class="form-control" /></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type="checkbox" /></td>
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
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Publish Test</label><br>
                                                                <label><input type="radio" /> Yes</label> &nbsp;
                                                                <label><input type="radio" checked /> No</label>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Start Date</label><br>
                                                                        <input type="date" class="form-control" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>End Date</label><br>
                                                                        <input type="date" class="form-control" />
                                                                    </div>
                                                                </div>
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
                                                <div id="step5" class="tab-pane fade">

                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th width="20px"><input type="checkbox" /></th>
                                                                    <th width="50px">S.No</th>
                                                                    <th>Group</th>
                                                                    <th>Candidates</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td><input type="checkbox" /></td>
                                                                    <td>1</td>
                                                                    <td>Banking</td>
                                                                    <td>24</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="checkbox" /></td>
                                                                    <td>2</td>
                                                                    <td>Computer</td>
                                                                    <td>34</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <div class="row m-0">
                                                        <div class="float-right">
                                                            <button type="button" class="btn btn-primary stepPrev">Prev</button>
                                                            <button type="button" class="btn btn-primary">Finish</button>
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
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="4%">S.No.</th>
                                            <th width="40%" class="hdng_ctegry">Category Name</th>
                                            <th width="4%" colspan="3">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1 </td>
                                            <td>All Test</td>
                                            <td class="action-td"><span class="remove-test" title="Remove Test"><i class="fa fa-trash-o" aria-hidden="true"></i></span> &nbsp; <span><i class="fa fa-pencil" aria-hidden="true"></i></span></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">1 </td>
                                            <td>All Test</td>
                                            <td class="action-td"><span class="remove-test" title="Remove Test"><i class="fa fa-trash-o" aria-hidden="true"></i></span> &nbsp; <span><i class="fa fa-pencil" aria-hidden="true"></i></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save</button>
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
                                <input type="text" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Description </label>
                                <textarea class="richText" name="example"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="4%">S.No.</th>
                                            <th width="40%" class="hdng_ctegry">Instruction Name</th>
                                            <th width="4%" colspan="3">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1 </td>
                                            <td>All Test</td>
                                            <td class="action-td"><span class="remove-test" title="Remove Test"><i class="fa fa-trash-o" aria-hidden="true"></i></span> &nbsp; <span><i class="fa fa-pencil" aria-hidden="true"></i></span></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">1 </td>
                                            <td>All Test</td>
                                            <td class="action-td"><span class="remove-test" title="Remove Test"><i class="fa fa-trash-o" aria-hidden="true"></i></span> &nbsp; <span><i class="fa fa-pencil" aria-hidden="true"></i></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save</button>
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
                            <select class="form-control">
                                <option value="">Subject</option>
                                <option value="">One</option>
                                <option value="">Two</option>
                            </select>
                        </li>
                        <li>
                            <select class="form-control">
                                <option value="">Chapter</option>
                                <option value="">One</option>
                                <option value="">Two</option>
                            </select>
                        </li>
                        <li>
                            <select class="form-control">
                                <option value="">Topic</option>
                                <option value="">One</option>
                                <option value="">Two</option>
                            </select>
                        </li>
                        <li>
                            <select class="form-control">
                                <option value="">Sub Topic</option>
                                <option value="">One</option>
                                <option value="">Two</option>
                            </select>
                        </li>
                        <li>
                            <button class="btn btn-primary">Search</button>
                        </li>
                    </ul>

                    <div class="table-responsive mt-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="20px"><input type="checkbox" /></th>
                                    <th width="20px">S.No</th>
                                    <th>Questions</th>
                                    <th>Difficulty Level</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="checkbox" /></td>
                                    <td>1</td>
                                    <td>"New Systematics" introduced by Sir Julian Huxley in 1940 is also known as</td>
                                    <td>Normal</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" /></td>
                                    <td>2</td>
                                    <td>"New Systematics" introduced by Sir Julian Huxley in 1940 is also known as</td>
                                    <td>Normal</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Add Questions to Test</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <script>
        $(function() {
            const token = localStorage.getItem("admin_token");
            if (token) {
                $.ajax({
                    // url: base_url + '/admin/student/student-list.php?token='+ token + '&page_no=1&page_count=10',                
                    url: base_url + '/admin/test/list.php',
                    type: 'GET',
                    data: {
                        token: token
                    },
                    dataType: 'JSON',
                    success: function(result) {
                        var index = 1;
                        var trHTML = '';
                        var totalResults = '';
                        totalResults = result.total_results;
                        $(".total-results-count").text(totalResults);
                        $.each(result.result, function(key, value) {
                            trHTML +=
                                '<tr><td class="text-center">' +
                                '</td><td>' + index++ +
                                '</td><td>' + value.name + '<span class="question-id d-none">' + value.id +
                                '</td><td>' + value.total_questions +
                                '</td><td>' + value.difficulty_level +
                                '</td><td>' + value.category +
                                '</td><td>' + value.student_group +
                                '</td><td class="action-td"><span class="remove-test" title="Remove Test"><i class="fa fa-trash-o" aria-hidden="true"></i></span> &nbsp; <span><i class="fa fa-pencil" aria-hidden="true"></i></span></td></tr>';
                        });
                        $('#testData').append(trHTML);
                    }
                });

            } else {
                window.location.replace('index.php');
            }
        });
    </script>

</body>

</html>