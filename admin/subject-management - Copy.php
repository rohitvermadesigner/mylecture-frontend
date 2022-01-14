<!DOCTYPE html>
<html>

<?php include 'include/head.php' ?>

<body>
    <div id="wrapper">

        <?php include 'include/left_menu.php' ?>

        <div id="page-wrapper" class="gray-bg dashbard-1">

            <?php include 'include/header.php' ?>

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
                                    </div>
                                    <div class="ibox-content">
                                        <div class="table-responsive mt-3">
                                            <table class="table" id="subjectData">
                                                <thead>
                                                    <tr>
                                                        <th width="20px"><input type="checkbox"></th>
                                                        <th width="20px">S.No.</th>
                                                        <th width="75%">Subject Name</th>
                                                        <!-- <th>Action</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- <tr>
                                                        <td><input type="checkbox"></td>
                                                        <td>1</td>

                                                        <td>
                                                            <div class="sbjectnametabl">
                                                                <span class="treeplus subjecticn"></span>
                                                                Science
                                                            </div>
                                                            <div class="topiclist">
                                                                <ul>
                                                                    <li>
                                                                        <span>
                                                                            <span class="inner-subjection treeplus treeminus"></span>
                                                                            chapter 1
                                                                        </span>
                                                                        <ul>
                                                                            <li>
                                                                                <span>
                                                                                    <span class="inner-subjection treeplus treeminus"></span>
                                                                                    topic 1
                                                                                    <ul>
                                                                                        <li>
                                                                                            sub topoic 1
                                                                                        </li>
                                                                                        <li>
                                                                                            sub topoic 2
                                                                                        </li>
                                                                                    </ul>
                                                                                </span>
                                                                            </li>
                                                                            <li>
                                                                                <span>
                                                                                    <span class="inner-subjection treeplus treeminus"></span>
                                                                                    topic 2
                                                                                    <ul>
                                                                                        <li>
                                                                                            sub topoic 1
                                                                                        </li>
                                                                                    </ul>
                                                                                </span>
                                                                            </li>
                                                                        </ul>
                                                                    </li>

                                                                    <li>
                                                                        <span>
                                                                            <span class="inner-subjection treeplus treeminus"></span>
                                                                            chapter 2
                                                                            <ul>
                                                                                <li>test</li>
                                                                                <li>test 2</li>
                                                                            </ul>
                                                                        </span>
                                                                    </li>
                                                                  
                                                                </ul>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <ul class="table-action">
                                                                <li><i class="fa fa-edit"></i></li>
                                                                <li><i class="fa fa-trash-o" aria-hidden="true"></i></li>
                                                            </ul>
                                                        </td>
                                                    </tr> -->

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
            const tokanInfoConst = localStorage.getItem("token");
            $.ajax({
                url: base_url + '/admin/subject/list.php?token= ' + tokanInfoConst,
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    console.log(result);
                    var index =1;
                    // console.log(result[0].name);
                    for (i = 0; i < result.length; i++) {
                        for (key in result[i]) {
                            $('#subjectData tbody').append(`<tr><td><input type="checkbox"></td><td>${index++}</td><td><div class="sbjectnametabl"><span class="treeplus subjecticn"></span>${result[i][key]}<div class="topic-wrapper1"></div></div></td></tr>`);

                            // for (let chapter in result[key]) {
                            //     $("#subjectData .topic-wrapper1").append(`
                            //     <div class="topiclist">
                            //                                         <ul>
                            //                                             <li>
                            //                                                 <span>
                            //                                                     <span class="inner-subjection treeplus treeminus"></span>
                            //                                                    ${chapter}  rohit chapter 1
                            //                                                 </span>
                            //                                               <ul class="topic-wrapper2"></ul>
                            //                                             </li>

                            //                                             <li>
                            //                                                 <span>
                            //                                                     <span class="inner-subjection treeplus treeminus"></span>
                            //                                                     chapter 2
                            //                                                     <ul>
                            //                                                         <li>test</li>
                            //                                                         <li>test 2</li>
                            //                                                     </ul>
                            //                                                 </span>
                            //                                             </li>

                            //                                         </ul>
                            //                                     </div>

                            //     `)

                            //     // result[key][chapter].forEach(val => {
                            //     //     $("#subjectData .topic-wrapper2").append(`<div>${val.name}</div>`);
                            //     // });
                            // }
                        };

                    };

                }
            });
        });
    </script>
</body>

</html>