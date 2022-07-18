<!DOCTYPE html>
<html lang="en">

<?php include 'include/head.php' ?>

<body>

    <?php include 'include/header.php' ?>

    <!-- <section class="common-section">
        <div class="container">
            <h2 class="title-primary">Why <span>GEMS</span> </h2>
        </div>
    </section> -->


    <!-- product-section begin here -->
    <section class="product-section">
        <div class="container">
            <h2 class="title-primary text-center">Our <span>Courses</span></h2>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="products-slider owl-carousel">
                        <div class="item">
                            <div class="product-box">
                                <img src="assets/images/test1.jpg" class="img-fluid" alt="">
                                <div class="product-body">
                                    <h4>GEMS - Half Yearly</h4>
                                    <p>
                                        6 months validity
                                    </p>
                                    <ul>
                                        <li>Self Assessor</li>
                                        <li>Topic Wise Analysis</li>
                                        <li>Exam Simulation</li>
                                        <li>Live Classes</li>
                                        <li>My Exam</li>
                                        <li>Topic Wise Exams</li>
                                        <li>Self Assessment</li>
                                        <li>Pattern based Mock Tests</li>
                                        <li>Subject wise Tests</li>
                                    </ul>
                                    <div class="price"><i class="fa fa-rupee-sign"></i> 12,500 + GST</div>

                                    <button type="button" data-toggle="modal" data-target="#halfYearCourseModal" class="btn btn-primary btn-block">Buy Now</button>

                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-box">
                                <img src="assets/images/test2.jpg" class="img-fluid" alt="">
                                <div class="product-body">
                                    <h4>GEMS - Yearly</h4>
                                    <p>
                                        12 months validity
                                    </p>
                                    <ul>
                                        <li>Self Assessor</li>
                                        <li>Topic Wise Analysis</li>
                                        <li>Exam Simulation</li>
                                        <li>Live Classes</li>
                                        <li>My Exam</li>
                                        <li>Topic Wise Exams</li>
                                        <li>Self Assessment</li>
                                        <li>Pattern based Mock Tests</li>
                                        <li>Subject wise Tests</li>
                                    </ul>
                                    <div class="price"><i class="fa fa-rupee-sign"></i> 25,000 + GST</div>

                                    <button type="button" data-toggle="modal" data-target="#fullYearCourseModal" class="btn btn-primary btn-block">Buy Now</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </section>
    <!-- product-section ends here -->


    <!-- The halfYearCourseModal -->
    <div class="modal" id="halfYearCourseModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">GEMS - Half Yearly</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body p-4">
                    <form method="post" action="courses-checkout.php">
                        <input type="text" name="CUST_CODE" required class="form-control mb-2" placeholder="Enter Student ID">
                        <input type="tel" maxlength="10" name="CUST_MOBILE" required class="form-control mb-2" placeholder="Enter Mobile No">
                        <input type="email" name="CUST_EMAIL" required class="form-control mb-2" placeholder="Enter Email Id">
                        <input type="hidden" name="TXN_AMOUNT" value="12500">
                        <button type="submit" class="btn btn-primary btn-block">Buy Now</button>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <!-- The fullYearCourseModal -->
    <div class="modal" id="fullYearCourseModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">GEMS - Yearly</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body p-4">
                    <form method="post" action="courses-checkout.php">
                        <input type="text" name="CUST_CODE" required class="form-control mb-2" placeholder="Enter Student ID">
                        <input type="tel" maxlength="10" name="CUST_MOBILE" required class="form-control mb-2" placeholder="Enter Mobile No">
                        <input type="email" name="CUST_EMAIL" required class="form-control mb-2" placeholder="Enter Email Id">
                        <input type="hidden" name="TXN_AMOUNT" value="25000">
                        <button type="submit" class="btn btn-primary btn-block">Buy Now</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <?php include 'include/footer.php' ?>

    <?php include 'include/footer_script.php' ?>

</body>

</html>