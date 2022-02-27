<!DOCTYPE html>
<html lang="en">

<?php include 'include/head.php' ?>

<body>

    <section class="user-dashboard">
        <?php include 'include/left_menu.php' ?>
        <div class="dashboard-container">
            <?php include 'include/header.php' ?>
            <div class="dashboard-title">
                <div class="overflow-hidden">
                    <h1 class="float-left">Report</h1>
                </div>
            </div>

            <div class="row m-0 main-row">
                <div class="col-md-12">
                    <div class="white-box p-5">
                     <div class="row">
                         <div class="col-md-4">
                             <a href="self-assessor-report.php" class="report-tab bg-warning">Self Assessor</a>
                         </div>
                         <div class="col-md-4">
                             <a href="topic-simulator-report.php" class="report-tab bg-danger">Topic Simulator</a>
                         </div>
                         <div class="col-md-4">
                             <a href="admin-assigned-report.php" class="report-tab bg-info">Admin Assigned</a>
                         </div>
                     </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php include 'include/footer_script.php' ?>

    <script>
        const token = localStorage.getItem("studentToken");
        if (token) {
           

        } else {
            window.location.replace('/');
        }
    </script>

</body>

</html>