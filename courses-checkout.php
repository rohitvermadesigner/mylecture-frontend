<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$checkSum = "";
$paramList = array();

$ORDER_ID = "ORDER_" . rand(10000000, 99999999);
$CUST_NAME = $_POST["CUST_NAME"];
$CUST_CODE = $_POST["CUST_CODE"];
$CUST_MOBILE = $_POST["CUST_MOBILE"];
$CUST_EMAIL = $_POST["CUST_EMAIL"];
$INDUSTRY_TYPE_ID = "Retail";
$CHANNEL_ID = "WEB";
$TXN_AMOUNT = $_POST["TXN_AMOUNT"];
$FINAL_TXN_AMOUNT = $TXN_AMOUNT + (($TXN_AMOUNT * 18) / 100);
$FINAL_TXN_AMOUNT = number_format((float)$FINAL_TXN_AMOUNT, 2, '.', '');
// $MOBILE_NO = $_POST["MOBILE_NO"];
// $EMAIL_ID = $_POST["EMAIL_ID"];

// Create an array having all required parameters for creating checksum.
$paramList["MID"] = PAYTM_MERCHANT_MID;
$paramList["ORDER_ID"] = $ORDER_ID;
$paramList["CUST_ID"] = $CUST_CODE;
// $paramList["CUST_NAME"] = $CUST_NAME;
$paramList["MSISDN"] = $CUST_MOBILE;
$paramList["EMAIL"] = $CUST_EMAIL;
$paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
$paramList["CHANNEL_ID"] = $CHANNEL_ID;
$paramList["TXN_AMOUNT"] = $FINAL_TXN_AMOUNT;
$paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
$paramList["CALLBACK_URL"] = "https://www.gemsnext.com/courses-checkout-response.php";
// $paramList["MSISDN"] = $MOBILE_NO; //Mobile number of customer
// $paramList["EMAIL"] = $EMAIL_ID; //Email ID of customer

/*
$paramList["VERIFIED_BY"] = "EMAIL"; //
$paramList["IS_USER_VERIFIED"] = "YES"; //

*/

//Here checksum string will return by getChecksumFromArray() function.
$checkSum = getChecksumFromArray($paramList, PAYTM_MERCHANT_KEY);

?>
<html>

<head>
    <title>Merchant Check Out Page</title>
</head>

<body>
    <center>
        <h1>Please do not refresh this page...</h1>
    </center>
    <form method="post" action="<?php echo PAYTM_TXN_URL ?>" name="f1">
        <table border="1">
            <tbody>
                <?php
                foreach ($paramList as $name => $value) {
                    echo '<input type="hidden" name="' . $name . '" value="' . $value . '">';
                }
                ?>
                <input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">
            </tbody>
        </table>
        <script type="text/javascript">
            document.f1.submit();
        </script>
    </form>
</body>

</html>