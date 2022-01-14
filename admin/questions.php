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

                                        <ul class="filter-list">
                                            <li>
                                                <h5>Total Results : <span class="total-results-count">0</span></h5>
                                            </li>
                                            <li>
                                                <select class="form-control">
                                                    <option value="">Subject</option>
                                                    <option value="">One</option>
                                                    <option value="">Two</option>
                                                </select>
                                            </li>
                                            <li>
                                                <select class="form-control">
                                                    <option value="">Chapter</option>
                                                    <option value="">One</option>
                                                    <option value="">Two</option>
                                                </select>
                                            </li>
                                            <li>
                                                <select class="form-control">
                                                    <option value="">Topic</option>
                                                    <option value="">One</option>
                                                    <option value="">Two</option>
                                                </select>
                                            </li>
                                            <li>
                                                <select class="form-control">
                                                    <option value="">Sub Topic</option>
                                                    <option value="">One</option>
                                                    <option value="">Two</option>
                                                </select>
                                            </li>
                                            <li>
                                                <button class="btn btn-primary">Search</button>
                                            </li>
                                        </ul>

                                        <div>
                                            <ul class="top-right-btn-list">
                                                <li>
                                                    <a href="create-test.php" class="btn btn-primary"><i class="fa fa-plus"></i> Add </a>
                                                </li>
                                                <li>
                                                    <button class="btn btn-primary"><i class="fa fa-trash"></i> Delete</button>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>

                                    <div class="ibox-content">

                                        <div class="table-responsive mt-3">

                                            <table class="table" id="questionData">

                                                <thead>

                                                    <tr>

                                                        <!-- <th><input type="checkbox"></th> -->

                                                        <th width="5%">S.No.</th>

                                                        <th width="55%">Questions Details</th>

                                                        <th width="15%">Subject</th>

                                                        <th width="20%">Chapter</th>

                                                        <th width="5%">Level</th>

                                                        <!-- <th>Action</th> -->

                                                    </tr>

                                                </thead>

                                                <tbody>

                                                    <!-- <tr>

                                                        <td><input type="checkbox"></td>

                                                        <td>2</td>

                                                        <td>English</td>

                                                        <td>English</td>

                                                        <td>English</td>

                                                        <td>

                                                            <ul class="table-action">

                                                                <li><i class="fa fa-edit"></i></li>

                                                                <li><i class="fa fa-trash-o" aria-hidden="true"></i></li>

                                                            </ul>

                                                        </td>

                                                    </tr> -->

                                                </tbody>

                                            </table>



                                            <div class="table-loading-wrap">

                                                <div class="loading-img">

                                                    <img src="./assets/img/loader.gif" alt="loader">

                                                </div>

                                                <div class="loading-text">

                                                    Loading...

                                                </div>

                                            </div>



                                            <div class="text-center">

                                                <button class="btn btn-primary prevPage" disabled>Prev</button>

                                                <button class="btn btn-primary nextPage" disabled>Next</button>

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

            const token = localStorage.getItem("token");

            if (token) {

                let page_no = 1;

                let page_count = 10;

                let totalResults = 0;

                let subject = '';

                let chapter = '';

                let question = '';

                let loadQuestions = function(page_no, page_count) {

                    let paramsData = {

                        token: token,

                        page_count: page_count,

                        page_no: page_no

                    }

                    if (subject) {

                        paramsData.subject = subject

                    }

                    if (chapter) {

                        paramsData.chapter = chapter

                    }

                    if (question) {

                        paramsData.question = question

                    }



                    let url = `${base_url}/admin/question/list.php`;

                    $('#questionData tbody').html('');

                    $(".table-loading-wrap").removeClass('display-none');

                    $.ajax({

                        url: url,

                        type: 'GET',

                        dataType: 'JSON',

                        data: paramsData,

                        success: function(result) {

                            let countStartAt = ((page_no - 1) * page_count) + 1;

                            totalResults = 24761;

                            $(".total-results-count").text(totalResults);

                            insertQuestionsIntoTable(result, countStartAt);

                            checkNextPreviousButton();

                        }

                    });

                }



                let insertQuestionsIntoTable = function(result, countStartAt) {



                    var tr = '';

                    $.each(result.result, function(key, value) {

                        tr += `<tr>

                            <td> ${countStartAt} </td>

                            <td> ${value.question} </td>

                            <td> ${value.subject} </td>

                            <td> ${value.chapter} </td>

                            <td> ${value.difficulty_level} </td></tr>`;

                        countStartAt++;

                        // '</td><td><span class="remove-question" title="Remove Question"><i class="fa fa-trash-alt"></i></span><span><i class="far fa-edit"></i></span></td></tr>';

                    });

                    $(".table-loading-wrap").addClass('display-none');

                    $('#questionData tbody').append(tr);

                }



                loadQuestions(page_no, page_count);



                $('.nextPage').click(function() {

                    page_no = page_no + 1;

                    loadQuestions(page_no, page_count);

                    checkNextPreviousButton();

                });



                $('.prevPage').click(function() {

                    page_no = page_no - 1;

                    loadQuestions(page_no, page_count);

                    checkNextPreviousButton();

                });



                var checkNextPreviousButton = function() {

                    if (page_no == 1) {

                        $('.prevPage').attr('disabled', true);

                    } else {

                        $('.prevPage').removeAttr('disabled');

                    }

                    if (page_no * page_count >= totalResults) {

                        $('.nextPage').attr('disabled', true);

                    } else {

                        $('.nextPage').removeAttr('disabled');

                    }

                }

            } else {

                window.location.replace('index.php');

            }

        });
    </script>



</body>



</html>