<!DOCTYPE html>
<html>

<?php include 'include/head.php' ?>

<body>
    <div id="wrapper">

        <?php include 'include/left_menu.php' ?>

        <div id="page-wrapper" class="gray-bg dashbard-1">

            <?php include 'include/header.php' ?>
            <h1 class="title-primary">Test Management</h1>

            <ul class="breadcrumb">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li>Test Management</li>
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
                                                <input type="text" class="form-control" placeholder="Type Test Name" id="test-filter">
                                            </li>
                                            <li>
                                                <select class="form-control" id="difficulty-filter">
                                                    <option value="">Select Difficulty Level</option>
                                                    <option value="easy">Easy</option>
                                                    <option value="normal">Normal</option>
                                                    <option value="difficult">Difficult</option>
                                                </select>
                                            </li>
                                            <li>
                                                <select class="form-control" id="test-category-filter">
                                                    <option value="">Select Test Category</option>
                                                </select>
                                            </li>
                                            <li>
                                                <select class="form-control" id="student-group-filter">
                                                    <option value="">Select Student Group</option>
                                                </select>
                                            </li>
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
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="ibox-content">

                                        <div class="table-responsive">
                                            <table class="table" id="testData">
                                                <thead>
                                                    <tr>
                                                        <th>S.No.</th>
                                                        <th>Test Name</th>
                                                        <th>Total Questions</th>
                                                        <th>Difficulty Level</th>
                                                        <th>Test Category</th>
                                                        <th>Student Group</th>
                                                        <th class="text-center">Action</th>
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
                let test_name = '';
                let difficulty_level = '';
                let test_category = '';
                let student_group_id = '';
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
                    if (test_category) {
                        paramsData.test_category = test_category
                    }
                    if (student_group_id) {
                        paramsData.student_group_id = student_group_id
                    }

                    let url = `${base_url}/admin/test/list.php`;
                    $('#testData tbody').html('');
                    $(".table-loading-wrap").removeClass('display-none');
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'JSON',
                        data: paramsData,
                        success: function(result) {
                            let countStartAt = ((page_no - 1) * page_count) + 1;
                            console.log(countStartAt)
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
                            <td> ${countStartAt} </td>
                            <td> <a class="font-weight-bold" href="test-info.php?test_id=${value.id}">${value.name}</a></td>
                            <td> ${value.total_questions} </td>
                            <td> ${value.difficulty_level} </td>
                            <td> ${value.category} </td>
                            <td> ${value.student_group} </td>
                            <td class="text-center">
                            <a href="edit-test.php?test_id=${value.id}" class="ml-3"><i class="fa fa-pencil"></i></a>
                            </td>
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

                var getTestCatrgory = function() {
                    const url = `${base_url}/admin/test/category/list.php`;
                    const paramsData = {
                        token: token
                    }
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'JSON',
                        data: paramsData,
                        success: function(result) {
                            if (result.result && result.result.length > 0) {
                                result.result.forEach(val => {
                                    $('#test-category-filter').append(`<option value="${val.id}">${val.name}</option>`)
                                })
                            }
                        }
                    });
                }

                var getStudentGroups = function() {
                    const url = `${base_url}/admin/student/group-list.php`;
                    const paramsData = {
                        token: token
                    }
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'JSON',
                        data: paramsData,
                        success: function(result) {
                            if (result.result && result.result.length > 0) {
                                result.result.forEach(val => {
                                    $('#student-group-filter').append(`<option value="${val.id}">${val.name}</option>`)
                                })
                            }
                        }
                    });
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

                loadTests(page_no, page_count);
                getTestCatrgory();
                getStudentGroups();
            } else {
                window.location.replace('index.php');
            }
        });
    </script>

</body>

</html>