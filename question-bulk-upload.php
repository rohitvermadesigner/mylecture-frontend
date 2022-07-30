<!DOCTYPE html>
<html>
<?php include 'include/head.php' ?>

<body>
    <div id="wrapper">
        <?php include 'include/left_menu.php' ?>
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <?php include 'include/header.php' ?>
            <h1 class="title-primary">Questions Bulk Upload</h1>

            <ul class="breadcrumb">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li>Question Bulk Upload</li>
            </ul>
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper wrapper-content">
                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <div>
                                            <ul class="top-right-btn-list">
                                                <li>
                                                    <a href="https://gemsnext.com/assets/sample-question-file.csv" class="btn btn-primary" download><i class="fa fa-download mr-2"></i> Download Sample CSV </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Upload CSV File</label>
                                                    <input type="file" class="form-control" name="file" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" id="bulk-upload-submit" class="btn btn-primary float-right">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'include/footer_script.php' ?>
    <script>
        $(function() {
            const token = localStorage.getItem("admin_token");
            if (token) {
                $("#bulk-upload-submit").click(function() {
                    var formdata = false;
                    if (window.FormData) {
                        formdata = new FormData();
                    }
                    console.log(this_.files);
                    formdata.append("files[]", this_.files[0], this_.files[0].name);
                    formdata.append("token", localStorage.getItem("userToken"));
                    jQuery.ajax({
                        url: `${base_url}user/gallery/upload-images.php`,
                        type: "POST",
                        data: formdata,
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            toastr.success(res.message);
                            user_profile.getUserPics();
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