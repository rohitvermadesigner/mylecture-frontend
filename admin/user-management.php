<!DOCTYPE html>
<html>

<?php include 'include/head.php' ?>

<body>
    <div id="wrapper">

        <?php include 'include/left_menu.php' ?>

        <div id="page-wrapper" class="gray-bg dashbard-1">

            <?php include 'include/header.php' ?>
            <h1 class="title-primary">User Management (Admin / Faculty)</h1>

            <ul class="breadcrumb">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li>Faculty Management</li>
            </ul>

            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper wrapper-content">

                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5><b>Total</b> : <span class="total-students"></span></h5>
                                        <ul class="top-right-btn-list">
                                            <li>
                                                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addFacultyModal">Add Faculty</button>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="ibox-content">
                                        <table class="table" id="facultyData">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Unique Code</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Mobile Number</th>
                                                    <th>Subject</th>
                                                    <th>Created At</th>
                                                    <th>Last Login At</th>
                                                    <th>Action</th>
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
                    <?php include 'include/footer.php' ?>
                </div>
            </div>

        </div>


    </div>

    <!-- Modal -->
    <div id="addFacultyModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <form id="addFacultyForm">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Faculty</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email Id</label>
                                    <input type="text" class="form-control" name="email_id">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Mobile Number</label>
                                    <input type="text" class="form-control" name="mobile_no" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="10">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Subject</label>
                                    <select class="form-control" id="subject" name="subject">
                                        <option value="">-- Select Subject --</option>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" class="form-control" name="password">
                                </div>
                            </div> -->

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <?php include 'include/footer_script.php' ?>

    <script>
        $(function() {
            const token = localStorage.getItem("admin_token");
            $('[data-target=#addFacultyModal]').click(function() {
                $('[name=name]').val('');
                $('[name=email_id]').val('');
                $('[name=mobile_no]').val('');
                $('#subject').val('');
            });

            const allFaculty = function() {
                $.ajax({
                    url: base_url + '/admin/faculty/list.php?token',
                    type: 'GET',
                    data: {
                        token: token
                    },
                    dataType: 'JSON',
                    success: function(result) {
                        var index = 1;
                        var trHTML = '';
                        $.each(result.result, function(key, value) {
                            subject = value.subject ? value.subject : '-'
                            trHTML +=
                                '<tr><td>' + index++ +
                                '</td><td>' + value.unique_code +
                                '</td><td>' + value.name + '<span class="user-id d-none">' + value.id + '</span>' +
                                '</td><td>' + value.email_id +
                                '</td><td>' + value.mobile_no +
                                '</td><td>' + subject +
                                '</td><td>' + value.created_at +
                                '</td><td>' + value.last_login_at +
                                '</td><td class="text-center"><span class="remove-faculty" title="Remove Faculty"><i class="fa fa-trash" aria-hidden="true"></i></span></td></tr>';
                        });
                        $('#facultyData tbody').html('');
                        $('#facultyData tbody').append(trHTML);
                        $('.total-students').text(result.total_results);
                    }
                });
            }
            allFaculty();

            $('body').on('click', '.remove-faculty', function() {
                var status = confirm("Are you sure to delete it?");
                if (status == true) {
                    var userId = $(this).parents('tr').find('td span.user-id').text();
                    let removeUser = {
                        'token': token,
                        'id': userId,
                    }
                    $.ajax({
                        url: base_url + '/admin/faculty/delete.php',
                        type: 'POST',
                        dataType: 'JSON',
                        data: JSON.stringify(removeUser),
                        success: function(response) {
                            message = response.message;
                            toastr.success(message);
                            allFaculty();
                        },
                        error: function(error) {
                            toastr.error(message);
                        }
                    });
                }
            });

            $('#addFacultyForm').validate({
                rules: {
                    name: 'required',
                    email_id: 'required',
                    mobile_no: 'required',
                    subject: 'required',
                },
                submitHandler: function(form) {
                    bankInfoSubmit();
                }
            });

            const bankInfoSubmit = function() {
                let post_data = {
                    "token": token,
                    "name": $('[name=name]').val(),
                    "email_id": $('[name=email_id]').val(),
                    "mobile_no": $('[name=mobile_no]').val(),
                    "subject_id": $('[name=subject]').val(),
                }
                $.ajax({
                    url: base_url + '/admin/faculty/add.php',
                    type: 'POST',
                    dataType: 'JSON',
                    data: JSON.stringify(post_data),
                    success: function(result) {
                        console.log(result);
                        message = result.message;
                        toastr.success(message);
                        $('#addFacultyModal').modal('hide');
                        $('#facultyData tbody').html('');
                        allFaculty();
                    },
                    error: function(error) {
                        toastr.error(error.responseJSON.message);
                    }
                });
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
                        if (result && result.length > 0) {
                            result.forEach(val => {
                                $('#subject').append(`<option value="${val.id}">${val.name}</option>`)
                            })
                        }
                        $('#subject').append('<option value="addSubject" class="boldItalic">Add Subject</option>');
                    }
                });
            }
            getAllSubjects();

        });
    </script>

</body>

</html>