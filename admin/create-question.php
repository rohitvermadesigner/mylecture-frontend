<!DOCTYPE html>
<html>
<?php include 'include/head.php' ?>

<body>
    <div id="wrapper">
        <?php include 'include/left_menu.php' ?>
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <?php include 'include/header.php' ?>
            <h1 class="title-primary">Create Question </h1>
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
                                                        <textarea name="question" id="" class="form-control" placeholder="Enter your Question"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="option-flex">
                                                            <div>A</div>
                                                            <div class="">
                                                                <input type="radio" name="answer" value="1" />
                                                            </div>
                                                            <div class="option-group">
                                                                <input type="text" class="form-control" name="option_1" placeholder="Option One" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="option-flex">
                                                            <div>B</div>
                                                            <div class="">
                                                                <input type="radio" name="answer" value="2" />
                                                            </div>
                                                            <div class="option-group">
                                                                <input type="text" class="form-control" name="option_2" placeholder="Option two" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="option-flex">
                                                            <div>C</div>
                                                            <div class="">
                                                                <input type="radio" name="answer" value="3" />
                                                            </div>
                                                            <div class="option-group">
                                                                <input type="text" class="form-control" name="option_3" placeholder="Option three" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="option-flex">
                                                            <div>D</div>
                                                            <div class="">
                                                                <input type="radio" name="answer" value="4" />
                                                            </div>
                                                            <div class="option-group">
                                                                <input type="text" class="form-control" name="option_4" placeholder="Option four" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="option-flex">
                                                        <div>E</div>
                                                        <div class="">
                                                            <input type="radio" name="answer" value="5" />
                                                        </div>
                                                        <div class="option-group">
                                                            <input type="text" class="form-control" name="option_5" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <textarea name="description" id="" class="form-control" placeholder="Enter description"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <select name="subject_id" class="form-control">
                                                            <option value="">Select Sebject</option>
                                                            <option value="subject1">Subject 1</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <select name="chapter_id" class="form-control">
                                                            <option value="">Select Chapter</option>
                                                            <option value="chapter1">Chapter 1</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <select name="difficulty_level" class="form-control">
                                                            <option value="">Select Level</option>
                                                            <option value="easy">Easy</option>
                                                            <option value="normal">Normal</option>
                                                            <option value="difficult">Difficult</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="tagsinput form-control" type="text" name="tags" value="" />
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <button id="createQuestion" class="btn btn-primary float-right">Submit</button>
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

                $('body').on('click', '#createQuestion', function() {
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