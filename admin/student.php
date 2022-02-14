<!DOCTYPE html>
<html>

<?php include 'include/head.php' ?>

<body>
    <div id="wrapper">

        <?php include 'include/left_menu.php' ?>

        <div id="page-wrapper" class="gray-bg dashbard-1">

            <?php include 'include/header.php' ?>
            <h1 class="title-primary">Student </h1>
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper wrapper-content">

                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Student List</h5>
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
                                                        <th>Candidate Name</th>
                                                        <th>E-mail</th>
                                                        <th>Mobile No.</th>
                                                        <th>Group</th>
                                                        <th>Reg. Date</th>
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
                let loadQuestions = function(page_no, page_count) {
                    let paramsData = {
                        token: token,
                        page_count: page_count,
                        page_no: page_no
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
                        }
                    });
                }

                let insertQuestionsIntoTable = function(result, countStartAt) {

                    var tr = '';
                    $.each(result.result, function(key, value) {
                        tr += `<tr>
                          <td> ${countStartAt} </td>
                          <td> ${value.name} <span class="student-id d-none">  ${value.id} </td>
                          <td> ${value.email_id} </td>
                          <td> ${value.mobile_no} </td>
                          <td> ${value.group} </td>
                          <td> ${value.date_of_registration} </td>
                          <td class="text-center"><span class="remove-student"><i class="fa fa-trash"></i></span></td></tr>`;
                        countStartAt++;
                    });
                    $(".table-loading-wrap").addClass('display-none');
                    $('#questionData').append(tr);
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

                loadQuestions(page_no, page_count);
                // $.ajax({
                //     url: base_url + '/admin/student/student-list.php?token',
                //     type: 'GET',
                //     dataType: 'JSON',
                //     data: paramsData,
                //     success: function(result) {
                //         console.log(result.result);
                //         var index = 1;
                //         var trHTML = '';
                //         $.each(result.result, function(key, value) {
                //             trHTML +=
                //                 '<tr><td>' + index++ +
                //                 '</td><td>' + value.name + '<span class="question-id d-none">' + value.id +
                //                 '</td><td>' + value.email_id +
                //                 '</td><td>' + value.mobile_no +
                //                 '</td><td>' + value.group +
                //                 '</td><td>' + value.date_of_registration + '</td></tr>';
                //             // '</td><td><span class="remove-questi on" title="Remove Question"><i class="fa fa-trash-alt"></i></span><span><i class="far fa-edit"></i></span></td></tr>';
                //         });
                //         $('#questionData').append(trHTML);
                //         $('.total-students').text(result.total_results);
                //     }
                // });

                $('body').on('click', '.remove-student', function() {
                    var status = confirm("Are you sure you want to delete ?");
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