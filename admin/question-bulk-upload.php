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
                    var inputFile = $("input[type=file]")[0].files[0];
                    formdata.append("file", inputFile, inputFile.name);
                    formdata.append("token", token);
                    jQuery.ajax({
                        url: `${base_url}/admin/question/import-data.php`,
                        type: "POST",
                        data: formdata,
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            toastr.options.timeOut = 10000;
                            toastr.success(`<b>Total Rows :</b> ${res.total_rows}<br/>
                            <b>Inserted rows Rows :</b> ${res.inserted_rows} <br/>
                            ${res.failed_rows > 0 ? `<b>Failed rows Rows :</b> ${res.failed_rows} <br/>` : ``}
                            ${res.fail_errors.length > 0 ? `<b>Inserted rows Rows :</b> ${res.fail_errors.join(' | ')}` : ``}
                            `);
                            $("input[type=file]").val('');
                        },
                        error: function(res) {
                            toastr.error(res.responseJSON.message);
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