<!DOCTYPE html>
<html>

<?php include 'include/head.php' ?>

<body>
    <div id="wrapper">

        <?php include 'include/left_menu.php' ?>

        <div id="page-wrapper" class="gray-bg dashbard-1">

            <?php include 'include/header.php' ?>
            <h1 class="title-primary">Subject Management</h1>

            <ul class="breadcrumb">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li>Subject Management</li>
            </ul>

            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper wrapper-content">

                        <!-- <div class="row mt-2 filter-row">
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Enter Subject/Chapter/Topic Name">
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <ul>
                                    <li>
                                        <button type="button" class="btn btn-white"> <i class="fa fa-plus"></i> Add</button>
                                    </li>
                                    <li>
                                        <button type="button" class="btn btn-white"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                    </li>
                                </ul>
                            </div>
                        </div> -->

                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Subject List</h5>
                                        <!-- <ul class="top-right-btn-list">
                                            <li>
                                                <a href="create-subject.php" class="btn btn-primary"><i class="fa fa-plus"></i> Add </a>
                                            </li>
                                            <li>
                                                <button class="btn btn-primary" disabled=""><i class="fa fa-trash"></i> Delete</button>
                                            </li>
                                        </ul> -->
                                    </div>
                                    <div class="ibox-content">
                                        <div class="table-responsive mt-3">
                                            <table class="table" id="subjectData">
                                                <thead>
                                                    <tr>
                                                        <th width="4%">S.No.</th>
                                                        <th width="92%">Phase / Subject / Topic</th>
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
            $.ajax({
                url: base_url + '/admin/subject/list.php?token',
                type: 'GET',
                data: {
                    token: token
                },
                dataType: 'JSON',
                success: function(result) {
                    console.log(result);
                    if (result && result.length > 0) {
                        result.forEach((phase, sub_key) => {
                            $("#subjectData tbody").append(`<tr>
                                                                <td> ${sub_key + 1}</td>
                                                                <td>
                                                                    <div class="sbjectnametabl">
                                                                        <span class="treeplus subjecticn"></span>
                                                                        ${phase.name}
                                                                    </div>
                                                                    <div class="topiclist" id="topic_list_${sub_key}">
                                                                        
                                                                    </div>
                                                                </td>
                                                            </tr>`);
                            if (phase.subject && phase.subject.length > 0) {
                                $(`#subjectData tbody #topic_list_${sub_key}`).append(`<ul id="ul_${sub_key}"></ul>`);
                                phase.subject.forEach((subject, chap_key) => {
                                    $(`#subjectData tbody #topic_list_${sub_key} ul#ul_${sub_key}`).append(`<li id="chapter_list_${sub_key}_${chap_key}"><span><span class="inner-subjection treeplus"></span>${subject.name}</span></li>`);
                                    if (subject.topic && subject.topic.length > 0) {
                                        $(`#subjectData tbody #topic_list_${sub_key} ul#ul_${sub_key} li#chapter_list_${sub_key}_${chap_key}`).append(`<ul class="topiclist-inner" id="ul_${sub_key}_${chap_key}"></ul>`);
                                        subject.topic.forEach((topic, topic_key) => {
                                            $(`#subjectData tbody #topic_list_${sub_key} ul#ul_${sub_key} li#chapter_list_${sub_key}_${chap_key} ul#ul_${sub_key}_${chap_key}`).append(`<li id="topic_list_${sub_key}_${chap_key}_${topic_key}"><span>
                                            <span class="inner-subjection"></span>
                                            ${topic.name}
                                            </span></li>`);
                                            if (topic.subtopic && topic.subtopic.length > 0) {
                                                $(`#subjectData tbody #topic_list_${sub_key} ul#ul_${sub_key} li#chapter_list_${sub_key}_${chap_key} ul#ul_${sub_key}_${chap_key} li#topic_list_${sub_key}_${chap_key}_${topic_key}`).append(`<ul></ul>`);
                                                topic.subtopic.forEach(subtopic => {
                                                    $(`#subjectData tbody #topic_list_${sub_key} ul#ul_${sub_key} li#chapter_list_${sub_key}_${chap_key} ul#ul_${sub_key}_${chap_key} li#topic_list_${sub_key}_${chap_key}_${topic_key} ul`).append(`<li>${subtopic.name}</li>`)
                                                })
                                            }
                                        });
                                    }
                                });
                            }
                        })
                    }
                }
            });
        });
    </script>
</body>

</html>