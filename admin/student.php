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
                                    </div>
                                    <div class="ibox-content">
                                        <div class="table-responsive mt-3">
                                            <table class="table" id="questionData">
                                                <thead>
                                                    <tr>
                                                        <th><input type="checkbox"></th>
                                                        <th>S.No.</th>
                                                        <th>Candidate Name</th>
                                                        <th>E-mail</th>
                                                        <th>Mobile No.</th>
                                                        <th>Group</th>
                                                        <th>Reg. Date</th>
                                                        <!-- <th>Action</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
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
            const tokanInfoConst = localStorage.getItem("admin_token");

            $.ajax({
                url: base_url + '/admin/student/student-list.php?token='+ tokanInfoConst + '&page_no=1&page_count=10',                
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    console.log(result.result);
                    var index =1;
                    var trHTML = '';
                    $.each(result.result, function(key, value) {
                        trHTML +=
                            '<tr><td class="text-center">' +
                            '</td><td>' + index++ +
                            '</td><td>' + value.name + '<span class="question-id d-none">' + value.id +
                            '</td><td>' + value.email_id +
                            '</td><td>' + value.mobile_no +
                            '</td><td>' + value.group +
                            '</td><td>' + value.date_of_registration + '</td></tr>';
                            // '</td><td><span class="remove-question" title="Remove Question"><i class="fa fa-trash-alt"></i></span><span><i class="far fa-edit"></i></span></td></tr>';
                    });
                    $('#questionData').append(trHTML);
                }
            });
        });
    </script>

</body>

</html>