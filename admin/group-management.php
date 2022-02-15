<!DOCTYPE html>
<html>

<?php include 'include/head.php' ?>

<body>
    <div id="wrapper">

        <?php include 'include/left_menu.php' ?>

        <div id="page-wrapper" class="gray-bg dashbard-1">

            <?php include 'include/header.php' ?>
            <h1 class="title-primary">Group Management </h1>
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper wrapper-content">

                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Group Management </h5>
                                        <ul class="top-right-btn-list">
                                            <li>
                                                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addGroupModal">Add Group</button>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="ibox-content">
                                        <table class="table" id="groupData">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Group Name</th>
                                                    <th>Group Details</th>
                                                    <th>No of Students</th>
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
    <div id="addGroupModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <form id="addGroupForm">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Group</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" cols="10" rows="4"></textarea>
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


    <!-- Modal -->
    <div id="editGroupModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <form id="editGroupForm">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Group</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" cols="10" rows="4"></textarea>
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
            let groupID = '';
            $.ajax({
                url: base_url + '/admin/student/group-list.php?token',
                type: 'GET',
                data: {
                    token: token
                },
                dataType: 'JSON',
                success: function(result) {
                    var index = 1;
                    var trHTML = '';
                    $.each(result.result, function(key, value) {
                        trHTML +=
                            `<tr>
                            <td>${index++}</td>
                            <td><span class="groupName">${value.name}</span><span class="group-id d-none">${value.id}</span></td>
                            <td><span class="groupDes">${value.description}</span></td>
                            <td>${value.no_of_students}</td>
                            <td><span class="remove-group" title="Remove Group"><i class="fa fa-trash"></i></span><span class="edit-group ml-3"><i class="fa fa-pencil"></i></span></td></tr>`
                    });
                    $('#groupData').append(trHTML);
                    $('#groupData').find('tr').eq(1).find('td').eq(4).html('');
                }
            });

            $('#addGroupForm').validate({
                rules: {
                    name: 'required',
                    description: 'required',
                },
                submitHandler: function(form) {
                    groupInfoSubmit();
                }
            });

            const groupInfoSubmit = function() {
                let post_data = {
                    "token": token,
                    "name": $('#addGroupModal [name=name]').val(),
                    "description": $('#addGroupModal [name=description]').val(),
                }
                GroupAjex(post_data);
            }

            const GroupAjex = function(post_data) {
                $.ajax({
                    url: base_url + '/admin/student/group-add.php',
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

            $('body').on('click', '.remove-group', function() {
                var status = confirm("Are you sure you want to delete ?");
                if (status == true) {
                    var userId = $(this).parents('tr').find('td span.group-id').text();
                    let removeUser = {
                        'token': token,
                        'id': userId,
                    }
                    $.ajax({
                        url: base_url + '/admin/student/group-delete.php',
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

            $('body').on('click', '.edit-group', function() {
                $('#editGroupModal').modal('show');
                groupId = $(this).parents('tr').find('td span.group-id').text();
                $('#editGroupModal [name=name]').val($(this).parents('tr').find('.groupName').text());
                $('#editGroupModal [name=description]').val($(this).parents('tr').find('.groupDes').text());
            });

            $('#editGroupForm').validate({
                rules: {
                    name: 'required',
                    description: 'required',
                },
                submitHandler: function(form) {
                    editGroupInfoSubmit();
                }
            });

            const editGroupInfoSubmit = function() {
                let post_data = {
                    "token": token,
                    "group_id": groupId,
                    "name": $('#editGroupModal [name=name]').val(),
                    "description": $('#editGroupModal [name=description]').val(),
                }
                editGroupAjex(post_data);
            }

            const editGroupAjex = function(post_data) {
                $.ajax({
                    url: base_url + '/admin/student/group-update.php',
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