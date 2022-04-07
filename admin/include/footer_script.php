    <!-- Mainly scripts -->
    <script src="assets/js/jquery-2.1.1.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/config.js"></script>
    <script src="assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="assets/js/inspinia.js"></script>
    <script src="assets/js/plugins/pace/pace.min.js"></script>
    <script src="assets/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>

    <!-- jQuery UI -->
    <script src="assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>
    <script src="assets/js/toastr.min.js"></script>
    <!-- <script src="assets/js/jquery.richtext.js"></script> -->
    <!-- Tags Input -->

    <script src="assets/js/custom.js?nocache=<?php echo rand(0, 99999); ?>"></script>

    <script>
        $(function() {
            const token = localStorage.getItem("admin_token");
            if (token) {
                const account_type = localStorage.getItem("account_type");
                if (account_type) {
                    if (account_type == 'WU1tRlpSdGs3RGd4RHhJWVF5VXlXQT09') {
                        $("#admin-faculty-name").text("Faculty")
                        $(".subject-management").remove();
                        $(".group-management").remove();
                        $(".user-management").remove();
                    } else {
                        $("#admin-faculty-name").text("Admin")
                    }
                }

                $('#changePassword').validate({
            rules: {
                old_password: "required",
                new_password: "required",
                confirm_password: {
                    equalTo: "#new_password"
                },
            },
            submitHandler: function(form) {
                changePasswordSubmit();
            }
        });

        const changePasswordSubmit = function() {
            let post_data = {
                token: token,
                old_password: $('[name=old_password]').val(),
                new_password: $('[name=new_password]').val(),
            }
            $.ajax({
                url: base_url + '/admin/change-password.php',
                type: 'POST',
                data: JSON.stringify(post_data),
                dataType: 'JSON',
                success: function(result) {
                    toastr.success(result.message);
                    $('[name=old_password]').val('');
                    $('[name=new_password]').val('');
                    $('[name=confirm_password]').val('');
                    $('#changePasswordModal').modal('hide');
                },
                error: function(error) {
                    toastr.error(error.responseJSON.message);
                }
            });
        }

            }
        });
    </script>