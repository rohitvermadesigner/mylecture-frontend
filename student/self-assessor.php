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
                    <h1 class="float-left">Self Assessor</h1>
                </div>
            </div>

            <div class="row m-0 mt-3">
                <div class="col-md-12">
                    <div class="white-box">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <ul class="filter-list">
                                    <li>
                                        <input type="text" class="form-control" placeholder="Type Test Name" id="test-filter">
                                    </li>
                                    <!-- <li>
                                        <select class="form-control" id="difficulty-filter">
                                            <option value="">Select Difficulty Level</option>
                                            <option value="easy">Easy</option>
                                            <option value="normal">Normal</option>
                                            <option value="difficult">Difficult</option>
                                        </select>
                                    </li> -->
                                    <!-- <li>
                                        <select class="form-control" id="test-category-filter">
                                            <option value="">Select Test Category</option>
                                        </select>
                                    </li>
                                    <li>
                                        <select class="form-control" id="student-group-filter">
                                            <option value="">Select Student Group</option>
                                        </select>
                                    </li> -->
                                    <li>
                                        <button class="btn btn-primary" id="search-btn">Search</button>
                                        <button class="btn btn-danger display-none" id="reset-btn">Reset</button>
                                    </li>
                                </ul>
                                <div>
                                    <ul class="top-right-btn-list">
                                        <li>
                                            <a href="create-test.php" class="btn btn-primary"><i class="fa fa-plus"></i> Add </a>
                                        </li>
                                        <!-- <li>
                                            <button class="btn btn-primary remove-all-test" disabled><i class="fa fa-trash"></i> Delete</button>
                                        </li> -->
                                    </ul>
                                </div>
                            </div>
                            <div class="ibox-content">

                                <div class="table-responsive">
                                    <table class="table" id="testData">
                                        <thead>
                                            <tr>
                                                <th class="text-center">S.No.</th>
                                                <th>Name</th>
                                                <th>Duration<br />Total Questions</th>
                                                <th>Subject<br />Chapter</th>
                                                <th width="100">No of Attemps</th>
                                                <th>Successfully Submitted</th>
                                                <th>Created at<br />Last attempt at</th>
                                                <th class="text-center"></span> Action</th>
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
                let page_no = 1;
                let page_count = 10;
                let totalResults = 0;
                let test_name = '';
                let difficulty_level = '';
                let allSubjects = [];
                let loadTests = function(page_no, page_count) {
                    let paramsData = {
                        token: token,
                        page_count: page_count,
                        page_no: page_no
                    }
                    if (test_name) {
                        paramsData.test_name = test_name
                    }
                    if (difficulty_level) {
                        paramsData.difficulty_level = difficulty_level
                    }
                    let url = `${base_url}/student/self-assessor/list.php`;
                    $('#testData tbody').html('');
                    $(".table-loading-wrap").removeClass('display-none');
                    page_no = 1;
                    page_count = 10;
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'JSON',
                        data: paramsData,
                        success: function(result) {
                            let countStartAt = ((page_no - 1) * page_count) + 1;
                            totalResults = result.total_results;
                            $(".total-results-count").text(totalResults);
                            insertTestIntoTable(result, countStartAt);
                            checkNextPreviousButton();
                        }
                    });
                }

                let insertTestIntoTable = function(result, countStartAt) {
                    var tr = '';
                    $.each(result.result, function(key, value) {
                        tr +=
                            `<tr>
                            <td class="text-center"> ${countStartAt} </td>
                            <td> ${value.name} </td>
                            <td> ${value.duration}<br/>${value.total_questions}</td>
                            <td> ${value.subject}<br/>${value.chapter} </td>
                            <td> ${value.no_of_attemps} </td>
                            <td> ${value.successfully_submitted} </td>
                            <td> ${value.created_at}<br/>${value.last_attempt_at || '-'} </td>
                            <td class="text-center"> <span class="test-id d-none">${value.id}</span> <span class="remove-test"><i class="fa fa-trash-alt"></i></span> </td>
                            </tr>`;
                        countStartAt++;
                    });
                    $(".table-loading-wrap").addClass('display-none');
                    $('#testData tbody').append(tr);
                }


                $('.nextPage').click(function() {
                    page_no = page_no + 1;
                    loadTests(page_no, page_count);
                    checkNextPreviousButton();
                    $('.prevPage').attr('disabled', true);
                    $('.nextPage').attr('disabled', true);
                });

                $('.prevPage').click(function() {
                    page_no = page_no - 1;
                    loadTests(page_no, page_count);
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


                $("#search-btn").click(function() {
                    test_name = $('#test-filter').val();
                    difficulty_level = $('#difficulty-filter').val();
                    test_category = $('#test-category-filter').val();
                    student_group_id = $('#student-group-filter').val();
                    page_no = 1;
                    loadTests(page_no, page_count);
                    if (test_name || difficulty_level || test_category || student_group_id) {
                        $("#reset-btn").removeClass('display-none');
                    }
                });

                $("#reset-btn").click(function() {
                    $('#test-filter').val("");
                    $('#difficulty-filter').val("");
                    $('#test-category-filter').val("");
                    $('#student-group-filter').val("");
                    test_name = "";
                    difficulty_level = ""
                    test_category = ""
                    student_group_id = ""
                    page_no = 1;
                    loadTests(page_no, page_count);
                    $("#reset-btn").addClass('display-none');
                })

                loadTests();
                // getTestCatrgory();
                // getStudentGroups();


                $('body').on('click', '.remove-test', function() {
                    var status = confirm("Are you sure you want to delete ?");
                    if (status == true) {
                        var testId = $(this).parents('tr').find('.test-id').text();
                        let removeTest = {
                            'token': token,
                            'test_id': testId,
                        }
                        $.ajax({
                            url: base_url + '/student/self-assessor/delete.php',
                            type: 'POST',
                            dataType: 'JSON',
                            data: JSON.stringify(removeTest),
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

                $(".parent-check").click(function() {
                    $(".child-check").prop("checked", this.checked);
                    if ($('.parent-check:checked').length) {
                        $('.remove-all-test').prop('disabled', false);
                    } else {
                        $('.remove-all-test').prop('disabled', true);
                    }
                });

                $('body').on('click', '.child-check', function() {
                    if ($('.child-check:checked').length) {
                        $('.remove-all-test').prop('disabled', false);
                    } else {
                        $('.remove-all-test').prop('disabled', true);
                    }
                    if ($('.child-check:checked').length == $('.child-check').length) {
                        $('.parent-check').prop('checked', true);
                    } else {
                        $('.parent-check').prop('checked', false);
                    }
                });

                $('body').on('click', '.remove-all-test', function() {
                    var status = confirm("Are you sure you want to delete ?");
                    if (status == true) {
                        var test_ids = [];
                        $.each($("input[name=child-check]:checked"), function() {
                            test_ids.push(parseInt($(this).val()));
                        });
                        let removeTest = {
                            'token': token,
                            'test_ids': test_ids,
                        }
                        $.ajax({
                            url: base_url + '/student/self-assessor/delete-multiple.php',
                            type: 'POST',
                            dataType: 'JSON',
                            data: JSON.stringify(removeTest),
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

            } else {
                window.location.replace('/');
            }
        });
    </script>

</body>

</html>