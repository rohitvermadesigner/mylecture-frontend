<!DOCTYPE html>
<html>
<?php include 'include/head.php' ?>

<body>
    <div id="wrapper">
        <?php include 'include/left_menu.php' ?>
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <?php include 'include/header.php' ?>
            <h1 class="title-primary">Create Student </h1>
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper wrapper-content">
                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-content">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Full Name</label>
                                                    <input type="text" class="form-control" name="name" />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control" name="email_id" />
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Mobile No.</label>
                                                    <input type="text" class="form-control" name="mobile_no" />
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Gender</label>
                                                    <select name="gender" class="form-control">
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Date of Birth</label>
                                                    <input type="date" class="form-control" name="date_of_birth" />
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <textarea name="" id="" cols="10" rows="2" class="form-control"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>State</label>
                                                    <input type="text" class="form-control" name="state" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>City</label>
                                                    <input type="text" class="form-control" name="city" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Country</label>
                                                    <input type="text" class="form-control" name="country" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Pincode</label>
                                                    <input type="text" class="form-control" name="pincode" />
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <button id="createstudent" class="btn btn-primary float-right">Submit</button>
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
                $('body').on('click', '#createstudent', function() {
                    let update_data = {
                        "token": token,
                        "name": $('[name=name]').val(),
                        "group_id": "1",
                        "email_id": $('[name=email_id]').val(),
                        "mobile_no": $('[name=mobile_no]').val(),
                        "gender": $('[name=mobile_no] :selected').val(),
                        "date_of_birth": $('[name=date_of_birth]').val(),
                        "address": $('[name=address]').val(),
                        "state": $('[name=state]').val(),
                        "city": $('[name=city]').val(),
                        "country": $('[name=country]').val(),
                        "pincode": $('[name=pincode]').val(),
                    }
                    console.log(update_data);
                    $.ajax({
                        url: base_url + '/admin/student/student-add.php',
                        type: 'POST',
                        data: JSON.stringify(update_data),
                        dataType: 'JSON',
                        success: function(result) {
                            toastr.success(result.message);
                            setTimeout(function(){
                                window.location.replace('student.php');
                            },1000)
                        },
                        error: function(error) {
                            toastr.error(error.responseJSON.message);
                        }
                    });
                });
            } else {
                window.location.replace('index.php');
            }
        });
    </script>
</body>

</html>