<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>
<script src="assets/js/config.js"></script>
<script src="assets/js/awesome.min.js"></script>
<script src="assets/js/toastr.min.js"></script>
<script src="assets/js/custom.js?nocache=<?php echo rand(0, 99999); ?>"></script>

<script>
    const token = localStorage.getItem("studentToken");
    if (token) {
        $.ajax({
            url: `${base_url}/student/get-info.php`,
            type: 'GET',
            dataType: 'JSON',
            data: {
                token: token
            },
            success: function(result) {
                $('#loginUserName').text(result.name);
            }
        });

    } else {
        window.location.replace('/');
    }
</script>