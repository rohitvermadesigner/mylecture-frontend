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
                                        <div class="ibox-content">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Enter Subject Name</label>
                                                        <input type="text" name="subject_name" class="form-control" />
                                                    </div>
                                                </div>
                                             
                                                <div class="col-md-12">
                                                    <button id="createSubject" class="btn btn-primary float-right">Submit</button>
                                                </div>
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

                $('body').on('click', '#createSubject', function() {
                    let tags = [];
                    $('[name=tags]').parents('.form-group').find('span.tag').each(function(index,elem){
                        tags.push($(elem).text());
                    });
                    let update_data = {
                        "token": token,
                        "question": $('[name=question]').val(),
                        "option_1": $('[name=option_1]').val(),
                        "option_2": $('[name=option_2]').val(),
                        "option_3": $('[name=option_3]').val(),
                        "option_4": $('[name=option_4]').val(),
                        // "option_5": $('[name=option_5]').val(),
                        "answer": $('[name=answer]:checked').val(),
                        "subject_id": $('[name=subject_id] option:selected').val(),
                        "chapter_id": $('[name=chapter_id] option:selected').val(),
                        "description": $('[name=description]').val(),
                        "difficulty_level": $('[name=difficulty_level] option:selected').val(),
                        "tags": tags
                    }
                    console.log(update_data);
                    $.ajax({
                        url: base_url + '/admin/question/add.php',
                        type: 'POST',
                        data: JSON.stringify(update_data),
                        dataType: 'JSON',
                        success: function(result) {
                            toastr.success(result.message);
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