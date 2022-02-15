<!DOCTYPE html>
<html>
<?php include 'include/head.php' ?>

<body>
    <div id="wrapper">
        <?php include 'include/left_menu.php' ?>
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <?php include 'include/header.php' ?>
            <h1 class="title-primary">Create Subject </h1>
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper wrapper-content">
                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-content">
                                        <div class="create-subject-box">
                                            <div class="form-group">
                                                <label>Enter Subject Name</label>
                                                <input type="text" name="subject_name" class="form-control" />
                                            </div>
                                            <button id="createSubject" class="btn btn-primary float-right">Submit</button>
                                        </div>

                                        <div class="clearfix"></div>
                                        <div class="subject-box display-none">
                                            <div class="row m-0">
                                                <div class="pull-left"><span id="subject_name"></span></div>
                                                <div class="pull-right">
                                                    <ul class="subject-right-btn-list">
                                                        <li class="add-chapter-btn"><i class="fa fa-plus"></i> Add Chapter</li>
                                                        <li class="edit-chapter-btn"><i class="fa fa-pencil"></i></li>
                                                    </ul>
                                                </div>
                                                <div class="clearfix"></div>
                                                <!-- <div class="chapter-box">
                                                    <div class="pull-left"><span id="chapter_name"></span></div>
                                                    <div class="pull-right">
                                                        <ul class="subject-right-btn-list">
                                                            <li class="add-chapter-btn"><i class="fa fa-plus"></i> Add Chapter</li>
                                                            <li class="edit-chapter-btn"><i class="fa fa-pencil"></i></li>
                                                        </ul>
                                                    </div>
                                                </div> -->
                                            </div>
                                            <div class="create-chapter-box mt-3 display-none">
                                                <div class="form-group">
                                                    <input type="text" name="chapter_name" class="form-control" placeholder="Enter Chapter Name" />
                                                </div>
                                                <button id="createChapter" class="btn btn-primary float-right">Submit</button>
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
                let subjectID = '';
                $('body').on('click', '#createSubject', function() {
                    let update_data = {
                        "token": token,
                        "name": $('[name=subject_name]').val(),
                    }
                    console.log(update_data);
                    $.ajax({
                        url: base_url + '/admin/subject/add.php',
                        type: 'POST',
                        data: JSON.stringify(update_data),
                        dataType: 'JSON',
                        success: function(result) {
                            toastr.success(result.message);
                            subjectID = result.id;
                            $('#subject_name').text($('[name=subject_name]').val());
                            $('.create-subject-box').hide();
                            $('.subject-box').show();
                        },
                        error: function(error) {
                            toastr.error(error.responseJSON.message);
                        }
                    });
                });

                $('.add-chapter-btn').click(function() {
                    $('.create-chapter-box').show();
                });

                $('body').on('click', '#createChapter', function() {
                    let update_data = {
                        "token": token,
                        "name": $('[name=chapter_name]').val(),
                        "subject_id": subjectID,
                        "is_chapter": 1,
                        "is_topic": 0,
                        "is_subtopic": 0,
                        // "parent_id": 15
                    }
                    console.log(update_data);
                    $.ajax({
                        url: base_url + '/admin/chapter/add.php',
                        type: 'POST',
                        data: JSON.stringify(update_data),
                        dataType: 'JSON',
                        success: function(result) {
                            toastr.success(result.message);
                            $('#chapter_name').text($('[name=chapter_name]').val());
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