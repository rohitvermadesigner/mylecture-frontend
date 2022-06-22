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
    if (empty($_GET['otp'])) {
        array_push($error_msgs, "otp should not be blank.");
    }
} else {
    $error_code = 405;
    array_push($error_msgs, "Method Not Allowed");
}

if (count($error_msgs) == 0) {
    $token = $_GET['token'];
    $otp = $_GET['otp'];
    $token_info = explode("/", encrypt_decrypt('decrypt', $token));
    if (count($token_info) == 2) {
        $category = $token_info[0];
        $id = $token_info[1];
        if ($category == 'student_temp') {
            $query = "SELECT * FROM student_info WHERE id = $id AND status = '1'";
            $result = mysqli_query($db, $query);
            if (mysqli_num_rows($result) == 1) {
                $data = mysqli_fetch_assoc($result);
                if ($data['otp'] == $otp) {
                    $current_date = date('Y-m-d H:i:s');
                    $real_token_info = "student/$id";
                    $realToken = encrypt_decrypt('encrypt', $real_token_info);
                    $query = "UPDATE student_info SET is_otp_verified = '1', updated_at = '$current_date' WHERE id = $id";
                    $result = mysqli_query($db, $query);
                    $email_id = $data['email_id'];
                    $query = "DELETE FROM student_info WHERE email_id = '$email_id'  AND id != $id";
                    mysqli_query($db, $query);
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
                                font-family: serif;
                            }
                        </style>
                    </head>

                    <body>
                        <div class="center">
                            <h1 style="color: #118f11;">You email id has been succesfully verified.</h1>
                            <!-- TODO: change domain name -->
                            <div style="font-size: 20px;">we are redirecting you to home page, please wait. or <a href="https://gemsnext.com">click here</a> to manual redirect.</div>
                        </div>
                    </body>
                    <script>
                        localStorage.setItem('studentToken', '<?php echo $realToken ?>')
                        window.setTimeout(function() {
                            // TODO: change domain name
                            window.location.href = 'https://gemsnext.com/student/dashboard.php';
                        }, 5000);
                    </script>

                    </html>
<?php
                } else {
                    array_push($error_msgs, "otp is not correct.");
                }
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
