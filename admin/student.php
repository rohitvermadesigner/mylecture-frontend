<!DOCTYPE html>
<html>

<?php include 'include/head.php' ?>

<body>
    <div id="wrapper">

        <?php include 'include/left_menu.php' ?>

        <div id="page-wrapper" class="gray-bg dashbard-1">

            <?php include 'include/header.php' ?>
            <h1 class="title-primary">Student </h1>

            <ul class="breadcrumb">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li>Students Management</li>
            </ul>

            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper wrapper-content">

                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <!-- <h5><b>Total</b> : <span class="total-students"></span></h5> -->
                                        <ul class="filter-list">
                                            <li>
                                                <input type="search" class="form-control" id="student-filter" placeholder="Type Student Name..">
                                            </li>
                                            <li>
                                                <select class="form-control" id="group-filter">
                                                    <option value="">-- Select Group --</option>
                                                </select>
                                            </li>
                                            <li>
                                                <button class="btn btn-primary" id="search-btn">Search</button>
                                                <button class="btn btn-danger display-none" id="reset-btn">Reset</button>
                                            </li>
                                        </ul>

                                        <ul class="top-right-btn-list">
                                            <li>
                                                <a href="create-student.php" class="btn btn-primary"><i class="fa fa-plus"></i> Add </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="table-responsive mt-3">
                                            <table class="table" id="questionData">
                                                <thead>
                                                    <tr>
                                                        <th>S.No.</th>
                                                        <th>Unique Code</th>
                                                        <th>Student Name</th>
                                                        <th>E-mail</th>
                                                        <th>Mobile No.</th>
                                                        <th>Group</th>
                                                        <th>Reg. Date</th>
                                                        <th>Last Login At</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
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
                let student_name = "";
                let group_id = "";
                let loadQuestions = function(page_no, page_count) {
                    // group_id = $("#group-filter").val();
                    let paramsData = {
                        token: token,
                        page_count: page_count,
                        page_no: page_no,
                        name: student_name,
                        group: group_id
                    }
                    let url = `${base_url}/admin/student/student-list.php`;
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

                let insertQuestionsIntoTable = function(result, countStartAt) {

                    var tr = '';
                    $.each(result.result, function(key, value) {
                        tr += `<tr>
                          <td> ${countStartAt} ${value.is_online ? '<span class="isOnline"></span>' : ''} </td>
                          <td> ${value.student_unique_code}</td>
                          <td> ${value.name} <span class="student-id d-none">  ${value.id} </span> </td>
                          <td> ${value.email_id} </td>
                          <td> ${value.mobile_no} </td>
                          <td> ${value.group} </td>
                          <td> ${value.date_of_registration} </td>
                          <td> ${value.last_login_at} </td>
                          <td class="text-center">
                          <ul class="action-list">
                          <li style=" font-size: 20px;"><a href="edit-student.php?id=${value.id}" class="edit-student"><i class="fa fa-pencil"></i></a></li>
                          <li class="remove-student" style=" font-size: 20px; margin-left: 10px;"><i class="fa fa-trash"></i></li>
                          </ul>
                         
                          </td></tr>`;
                        countStartAt++;
                    });
                    $(".table-loading-wrap").addClass('display-none');
                    $('#questionData').append(tr);
                    $('.total-students').text(result.total_results);
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

                $("#search-btn").click(function() {
                    student_name = $('#student-filter').val();
                    group_id = $('#group-filter').val();
                    page_no = 1;
                    loadQuestions(page_no, page_count);
                    if (group_id || student_name) {
                        $("#reset-btn").removeClass('display-none');
                    }
                });

                $('#student-filter').keypress(function(e) {
                    if (e.which == 13) {
                        if (e.target.value) {
                            $("#search-btn").click();
                        }
                    }
                })

                $("#reset-btn").click(function() {
                    $('#group-filter').val('');
                    $('#student-filter').val("");
                    group_id = "";
                    student_name = ""
                    page_no = 1;
                    loadQuestions(page_no, page_count);
                    $("#reset-btn").addClass('display-none');
                    window.history.pushState('', '', 'student.php');
                })


                var getAllGroups = function() {
                    $.ajax({
                        url: base_url + '/admin/student/group-list.php',
                        type: 'GET',
                        data: {
                            token: token
                        },
                        dataType: 'JSON',
                        success: function(result) {
                            allGroup = result.result;
                            const urlParams = new URLSearchParams(window.location.search);
                            const group_id = urlParams.get('group_id');
                            if (allGroup && allGroup.length > 0) {
                                allGroup.forEach(val => {
                                    $('#group-filter').append(`<option value="${val.id}" ${val.id == group_id ? 'selected' : ''}>${val.name}</option>`)
                                })
                            }
                            $("#search-btn").click();
                        }
                    });
                }
                getAllGroups();

                $('body').on('click', '.remove-student', function() {
                    var status = confirm("Are you sure to delete it?");
                    if (status == true) {
                        var userId = $(this).parents('tr').find('td span.student-id').text();
                        let removeUser = {
                            'token': token,
                            'id': userId,
                        }
                        $.ajax({
                            url: base_url + '/admin/student/student-delete.php',
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