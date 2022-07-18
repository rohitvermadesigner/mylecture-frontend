<!DOCTYPE html>
<html lang="en">

<?php include 'include/head.php' ?>

<body>

    <?php include 'include/header.php' ?>

    <?php
    header("Pragma: no-cache");
    header("Cache-Control: no-cache");
    header("Expires: 0");

    // following files need to be included
    require_once("./lib/config_paytm.php");
    require_once("./lib/encdec_paytm.php");

    $paytmChecksum = "";
    $paramList = array();
    $isValidChecksum = "FALSE";

    $paramList = $_POST;
    $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

    //Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application�s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
    $isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


    if ($isValidChecksum == "TRUE") {
        // echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
        if ($_POST["STATUS"] == "TXN_SUCCESS") {
    ?>
            <!-- // html display section -->
            <section class="h4 p-5 text-center">
                <div class="h3  text-success">Congratulation you transaction has been successfully completed.</div>
                <div class="h4 mt-4">Your transction Id is <?php echo $_POST['TXNID'] ?></div>
                <div class="h4 mt-4">Transction Amount is <?php echo $_POST['TXNAMOUNT'] ?></div>
                <div class="h4 mt-4">Order Id : <?php echo $_POST['ORDERID'] ?></div>
            </section>
            <!-- // html display section -->
        <?php
            //Process your transaction here as success transaction.
            //Verify amount & order id received from Payment gateway with your application's order id and amount.
        } else {
        ?>
            <!-- // html display section -->
            <section class="h3 m-5 text-center text-danger">
                Your transaction has been failed.
            </section>
            <!-- // html display section -->
        <?php
            echo "<b>Transaction status is failure</b>" . "<br/>";
        }

        ?>



    <?php
    } else {
        echo "<b>Checksum mismatched.</b>";
        //Process transaction as suspicious.
    }
    include 'include/footer.php'
    ?>

</body>

</html>