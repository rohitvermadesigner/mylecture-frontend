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
                                        <h5>Group Management</h5>
                                    </div>
                                    <div class="ibox-content">
                                    <table class="table" id="groupData">
                                                <thead>
                                                    <tr>
                                                        <th><input type="checkbox"></th>
                                                        <th>S.No.</th>
                                                        <th>Group Name</th>
                                                        <th>Group Details</th>
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
                url: base_url + '/admin/student/group-list.php?token',                
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
                            '</td><td>' + value.name + '<span class="group-id d-none">' + value.id +
                            '</td><td>' + value.description + '</td></tr>';
                            // '</td><td><span class="remove-question" title="Remove Question"><i class="fa fa-trash-alt"></i></span><span><i class="far fa-edit"></i></span></td></tr>';
                    });
                    $('#groupData').append(trHTML);                                             
                }
            });
        });
    </script>

</body>

</html>