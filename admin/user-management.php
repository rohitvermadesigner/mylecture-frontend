<!DOCTYPE html>
<html>

<?php include 'include/head.php' ?>

<body>
    <div id="wrapper">

        <?php include 'include/left_menu.php' ?>

        <div id="page-wrapper" class="gray-bg dashbard-1">

            <?php include 'include/header.php' ?>
            <h1 class="title-primary">User Management (Admin / Faculty)</h1>
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper wrapper-content">

                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-content">
                                    <form id="addFacultyForm">
                                        <div class="row mt-4">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control" name="name">
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
                                                    <input type="text" class="form-control" name="mobile_no">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="text" class="form-control" name="password">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary float-right">Add Faculty</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <hr>
                                    <table class="table mt-4" id="facultyData">
                                                <thead>
                                                    <tr>
                                                        <th><input type="checkbox"></th>
                                                        <th>S.No.</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Mobile Number</th>
                                                        <th>Gender</th>
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

    <?php include 'include/footer_script.php' ?>

    <script>
         $(function() {
            const token = localStorage.getItem("token");
            $.ajax({
                url: base_url + '/admin/faculty/list.php?token',                
                type: 'GET',
                data: {
                    token: token
                },
                dataType: 'JSON',
                success: function(result) {
                    var index =1;
                    var trHTML = '';
                    $.each(result.result, function(key, value) {
                        trHTML +=
                            '<tr><td class="text-center">' +
                            '</td><td>' + index++ +
                            '</td><td>' + value.name + '<span class="user-id d-none">' + value.id +
                            '</td><td>' + value.email_id +
                            '</td><td>' + value.mobile_no +
                            '</td><td>' + value.gender +
                            '</td><td><span class="remove-faculty" title="Remove Faculty"><i class="fa fa-trash" aria-hidden="true"></i></span></td></tr>';
                    });
                    $('#facultyData').append(trHTML);                                   
                }
            });

            $('body').on('click', '.remove-faculty', function() {
                var status = confirm("Are you sure you want to delete ?");
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

            $('#addFacultyForm').validate({
                rules: {
                    name: 'required',
                    email_id: 'required',
                    mobile_no: 'required',
                    password: 'required',
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
                    "password": $('[name=password]').val(),
                }
                FacultyAjex(post_data);
            }

            const FacultyAjex = function(post_data) {
                $.ajax({
                    url: base_url + '/admin/faculty/add.php',
                    type: 'POST',
                    dataType: 'JSON',
                    data: JSON.stringify(post_data),
                    success: function(result) {
                        console.log(result);
                        message = result.message;                                        
                        toastr.success(message);
                        setTimeout(function() {
                            location.reload();
                        }, 1000)
                    },
                    error: function(error) {
                        toastr.error(error.responseJSON.message);
                    }
                });
            }

        });
    </script>

</body>

</html>