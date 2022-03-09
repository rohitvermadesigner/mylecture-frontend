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

    <script src="assets/js/custom.js"></script>

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
            }
        });
    </script>