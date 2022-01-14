<!DOCTYPE html>
<html>

<?php include 'include/head.php' ?>

<body>
    <div id="wrapper">

        <?php include 'include/left_menu.php' ?>

        <div id="page-wrapper" class="gray-bg dashbard-1">

            <?php include 'include/header.php' ?>
            <h1 class="title-primary">Test Management</h1>
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
                                                    <option value="">Select Test Name</option>
                                                    <option value="">Test One</option>
                                                    <option value="">Test Two</option>
                                                </select>
                                            </li>
                                            <li>
                                                <select class="form-control">
                                                    <option value="">Select Test Category</option>
                                                    <option value="">Test Category One</option>
                                                    <option value="">Test Category Two</option>
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

                                        <div class="table-responsive">
                                            <table class="table" id="testData">
                                                <thead>
                                                    <tr>
                                                        <th><input type="checkbox"></th>
                                                        <th>S.No.</th>
                                                        <th>Test Name</th>
                                                        <th>Total Questions</th>
                                                        <th>Difficulty Level</th>
                                                        <th>Test Category</th>
                                                        <th>Student Group</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
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
                $.ajax({
                    // url: base_url + '/admin/student/student-list.php?token='+ token + '&page_no=1&page_count=10',                
                    url: base_url + '/admin/test/list.php',
                    type: 'GET',
                    data: {
                        token: token
                    },
                    dataType: 'JSON',
                    success: function(result) {
                        var index = 1;
                        var trHTML = '';
                        var totalResults = '';
                        totalResults = result.total_results;
                        $(".total-results-count").text(totalResults);
                        $.each(result.result, function(key, value) {
                            trHTML +=
                                '<tr><td class="text-center">' +
                                '</td><td>' + index++ +
                                '</td><td>' + value.name + '<span class="question-id d-none">' + value.id +
                                '</td><td>' + value.total_questions +
                                '</td><td>' + value.difficulty_level +
                                '</td><td>' + value.category +
                                '</td><td>' + value.student_group +
                                '</td><td class="action-td"><span class="remove-test" title="Remove Test"><i class="fa fa-trash-o" aria-hidden="true"></i></span> &nbsp; <span><i class="fa fa-pencil" aria-hidden="true"></i></span></td></tr>';
                        });
                        $('#testData').append(trHTML);
                    }
                });

            } else {
                window.location.replace('index.php');
            }
        });
    </script>

</body>

</html>