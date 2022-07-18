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

    <section class="inner-header">
    <img src="assets/images/pay-now-header.jpg" alt="" />
    </section>

    <!-- product-section begin here -->
    <section class="product-section">
        <div class="container">
            <h2 class="title-primary text-center">Pay <span>Now</span></h2>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="products-slider owl-carousel">
                        <div class="item">
                            <div class="product-box">
                                <div class="product-body">
                                    <h4>GEMS - Half Yearly</h4>
                                    <p>
                                        6 months validity
                                    </p>
                                    
                                    <div class="price"><i class="fa fa-rupee-sign"></i> 12,500 + GST</div>

                                    <form method="post" action="courses-checkout.php" class="mt-3">
                                        <input type="text" name="CUST_CODE" required class="form-control mb-2" placeholder="Enter Student ID">
                                        <input type="tel" maxlength="10" name="CUST_MOBILE" required class="form-control mb-2" placeholder="Enter Mobile No">
                                        <input type="email" name="CUST_EMAIL" required class="form-control mb-2" placeholder="Enter Email Id">
                                        <input type="hidden" name="TXN_AMOUNT" value="12500">
                                        <button type="submit" class="btn btn-primary btn-block">Buy Now</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-box">
                                <div class="product-body">
                                    <h4>GEMS - Yearly</h4>
                                    <p>
                                        12 months validity
                                    </p>
                                    
                                    <div class="price"><i class="fa fa-rupee-sign"></i> 25,000 + GST</div>
                                    <form method="post" action="courses-checkout.php" class="mt-3">
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
                </div>
            </div>



        </div>
    </section>
    <!-- product-section ends here -->

    <?php include 'include/footer.php' ?>

    <?php include 'include/footer_script.php' ?>

</body>

</html>