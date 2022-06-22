<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// include database and object files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../shared/utilities.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// get posted data
$error_msgs = array();
$error_code = 400;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // make sure post data is not empty
    if (empty($_GET['token'])) {
        array_push($error_msgs, "token should not be blank.");
    }
} else {
    $error_code = 405;
    array_push($error_msgs, "Method Not Allowed");
}

if (count($error_msgs) == 0) {
    $token = $_GET['token'];
    $token_info = explode("/", encrypt_decrypt('decrypt', $token));
    if (count($token_info) == 2) {
        $category = $token_info[0];
        $student_id = $token_info[1];
        if ($category == 'student-generate-password') {
            $query = "SELECT * FROM student_info WHERE id = $student_id AND status = '1' ORDER BY id DESC";
            $result = mysqli_query($db, $query);
            if (mysqli_num_rows($result) > 0) {
                $data = mysqli_fetch_assoc($result);
                $current_date = date('Y-m-d H:i:s');
                $password = generateRandomString(10);
                $encrypted_password = md5($password);
                $query = "UPDATE student_info SET is_otp_verified = '1', password = '$encrypted_password', updated_at = '$current_date' WHERE id = $student_id";
                $result = mysqli_query($db, $query);
                $email_id = $data['email_id'];
                $name = $data['name'];
                $query = "DELETE FROM student_info WHERE email_id = '$email_id'  AND id != $student_id";
                mysqli_query($db, $query);

                // TODO: change domain in URL
                $email_body = "Hi $name, <br/><br/>
                Your login credentials are given below : <br/><br/>
                <b>URL :</b>  https://www.gemsnext.com<br/>               
                <b>Email Id :</b> $email_id<br/>               
                <b>Password :</b> $password<br/><br/>
                If you are facing any type of issue  with login, please email us at contact@gemsnext.com
                <br><br>
                Warm Regards,
                <br>
                The My Lecture Team              
                ";
                $email_subject = "GEMS Next Student Login Credentials";
                $email_send = email_send($email_id, $email_body, $email_subject);

                $admin_email_subject = "GEMS Next Student Login Credentials | $name";
                email_send($admin_email, $email_body, $admin_email_subject);
?>
                <!DOCTYPE html>
                <html lang="en">

                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Document</title>
                    <style>
                        .center {
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                            font-family: sans-serif;
                        }
                    </style>
                </head>

                <body>
                    <div class="center">
                        <h1 style="color: #1a2a1a; font-size: 22px;margin-top: 110px;">Your password has been succesfully generated and sent to you email id, please check your email id to get new password.</h1>
                        <h1 style="color: #0c910c; margin-bottom: 30px;">Password : <?php echo $password; ?></h1>
                        <!-- TODO : change domain name -->
                        <!-- <div style="font-size: 20px;">we are redirecting you to home page in 10 seconds, please wait. or <a href="http://mylecture.co.in">click here</a> to manual redirect.</div> -->
                    </div>
                </body>
                <script>
                    // window.setTimeout(function() {
                    // TODO: change domain name
                    // window.location.href = 'http://mylecture.co.in';
                    // }, 11000);
                </script>

                </html>
<?php
            } else {
                $error_code = 401;
                array_push($error_msgs, "user is not valid.");
            }
        } else {
            $is_error = true;
            array_push($error_msgs, "token is not valid.");
        }
    } else {
        array_push($error_msgs, "token is not valid.");
    }
}


if (count($error_msgs) > 0) {
    // set response code - 400 bad request
    http_response_code($error_code);
    // tell the user
    echo json_encode(array("message" => implode(", ", $error_msgs)));
}
