<!DOCTYPE html>
<html>
<?php include 'include/head.php' ?>

<body>
    <div id="wrapper">
        <?php include 'include/left_menu.php' ?>
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <?php include 'include/header.php' ?>
            <h1 class="title-primary">Questions </h1>
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper wrapper-content">
                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h4>Edit Question</h4>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea name="question" id="" class="form-control"></textarea>
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
                                                            <input type="text" class="form-control" name="option_1" />
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
                                                            <input type="text" class="form-control" name="option_2" />
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
                                                            <input type="text" class="form-control" name="option_3" />
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
                                                            <input type="text" class="form-control" name="option_4" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
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
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div>Description</div>
                                                    <textarea type="text" class="form-control" name="description"></textarea>
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
                                                <button id="updateQuestion" class="btn btn-primary float-right">Update</button>
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
                const questionID = document.location.search.substr(4);

                let subjectID = '';
                let chapterId = '';
                var getQuestion = function() {
                    const url = `${base_url}/admin/question/get-detail.php`;
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'JSON',
                        data: {
                            token: token,
                            id: questionID
                        },
                        success: function(result) {
                            console.log(result);
                            $('[name=question]').attr('id', result.id);
                            $('[name=question]').val(result.question);
                            $('[name=option_1]').val(result.option_1);
                            $('[name=option_2]').val(result.option_2);
                            $('[name=option_3]').val(result.option_3);
                            $('[name=option_4]').val(result.option_4);
                            $('[name=option_5]').val(result.option_5);
                            $('[name=answer]').each(function() {
                                if ($(this).val() == result.answer) {
                                    $(this).prop('checked', true);
                                }
                            });
                            subjectID = result.subject_id;
                            chapterId = result.chapter_id;
                            $('[name=description]').val(result.description);
                            $('[name=difficulty_level] option:selected').val(result.difficulty_level);
                            $('[name=tags]').val(result.tags);
                        }
                    });
                }

                getQuestion();

                $('body').on('click', '#updateQuestion', function() {
                    let update_data = {
                        "token": token,
                        "question_id": questionID,
                        "question": $('[name=question]').val(),
                        "option_1": $('[name=option_1]').val(),
                        "option_2": $('[name=option_2]').val(),
                        "option_3": $('[name=option_3]').val(),
                        "option_4": $('[name=option_4]').val(),
                        "option_5": $('[name=option_5]').val(),
                        "answer": $('[name=answer]:checked').val(),
                        "subject_id": subjectID,
                        "chapter_id": chapterId,
                        "description": "This is description for question 4",
                        "difficulty_level": "normal",
                        "tags": ["AIEEE", "IIT"]
                    }
                    $.ajax({
                        url: base_url + '/admin/question/update.php',
                        type: 'POST',
                        data: JSON.stringify(update_data),
                        dataType: 'JSON',
                        success: function(result) {
                            toastr.success(result.message);
                            getQuestion();
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