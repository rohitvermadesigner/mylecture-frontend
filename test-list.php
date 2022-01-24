<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MY LECTURE</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/toastr.min.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>

<body>

    <section class="user-dashboard">
        <div class="dashboard-leftbar">
            <a href="#" class="logo">
                <img src="assets/images/logo.png" alt="">
            </a>
            <div class="left-nav">
                <ul>
                    <li>
                        <a href="#">
                            <img src="assets/images/leftnav-icon1.png" alt="">
                            <span>Self Assessor</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="assets/images/leftnav-icon2.png" alt="">
                            <span>Topic Simulator </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="assets/images/leftnav-icon3.png" alt="">
                            <span>Test Simulator</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="assets/images/leftnav-icon4.png" alt="">
                            <span>Top 5 Scorers</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="dashboard-container">
            <div class="top-stripe">
                <ul>
                    <li>Support : 9876543210</li>
                    <li><a href="#">HELP</a></li>
                    <li>
                        <a href="#">
                            <span class="notification-span">
                                <span>2</span>
                                <i class="fa fa-bell"></i>
                            </span>
                        </a>
                    </li>
                    <li><span class="name-cricle">JS</span> <a href="#" onclick="logout();">Logout</a></li>
                </ul>
            </div>
            <div class="dashboard-title">
                <div class="overflow-hidden">
                    <h1 class="float-left">Student Dashboard</h1>
                    <a href="test-list.php" class="btn btn-white float-right">Start Test</a>
                </div>
            </div>

            <div class="row m-0 mt-3">


                <div class="col-md-12 mt-3">
                    <div class="white-box">
                        <h5>Test List</h5>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="test-list-box">
                                    <h5>Test Title</h5>
                                    <ul>
                                        <li><i class="fa fa-calendar-alt"></i> Start Date: 15 Jan 2022 </li>
                                        <li><i class="fa fa-calendar-alt"></i> End Date: 31 Jan 2022 </li>
                                        <li><i class="fa fa-clock"></i> Time: 13:00:00 to 23:00:00 </li>
                                        <li><i class="fa fa-clock"></i> Duration: 20 Min </li>
                                    </ul>
                                    <button class="btn btn-primary text-right">Start Test</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>



    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/awesome.min.js"></script>
    <script src="assets/js/toastr.min.js"></script>

    <script>
        const token = localStorage.getItem("studentToken");
        if (token) {
            var getQuestion = function() {
                const url = `${base_url}`;
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'JSON',
                    data: {
                        token: token,
                        id: questionID
                    },
                    success: function(result) {
                        $('[name=question]').attr('id', result.id);
                        $('[name=question]').val(result.question);
                        $('[name=option_1]').val(result.option_1);
                        $('[name=option_2]').val(result.option_2);
                        $('[name=option_3]').val(result.option_3);
                        $('[name=option_4]').val(result.option_4);
                        $('[name=answer]').each(function() {
                            if ($(this).val() == result.answer) {
                                $(this).prop('checked', true);
                            }
                        });
                    }
                });
            }

        } else {
            window.location.replace('index.php');
        }
    </script>

</body>

</html>