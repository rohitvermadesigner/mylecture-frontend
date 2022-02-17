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
                                                        <option value="35">-- Select Subject --</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Select Chapter</label>
                                                    <select class="form-control" id="chapter-filter" name="chapter_id">
                                                        <option value="">-- Select Chapter --</option>
                                                        <option value="248">-- Select Chapter --</option>
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

            } else {
                window.location.replace('/');
            }
        });
    </script>

</body>

</html>