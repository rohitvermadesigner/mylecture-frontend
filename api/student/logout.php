<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
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
$post_data = json_decode(file_get_contents("php://input"));
$error_msgs = array();
$error_code = 400;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // make sure post data is not empty
    if (empty($post_data->token)) {
        array_push($error_msgs, "token should not be blank.");
    }
} else {
    $error_code = 405;
    array_push($error_msgs, "Method Not Allowed");
}

if (count($error_msgs) == 0) {
    $token = $post_data->token;
    $token_info = explode("/", encrypt_decrypt('decrypt', $token));
    if (count($token_info) == 2) {
        $category = $token_info[0];
        $id = $token_info[1];
        if ($category == 'student') {
            $query = "SELECT * FROM student_info WHERE id = $id AND is_otp_verified = 1 AND status = 1";
            $result = mysqli_query($db, $query);
            if (mysqli_num_rows($result) == 1) {
                $data = mysqli_fetch_assoc($result);
                $current_date = date('Y-m-d H:i:s');
                $query = "UPDATE student_info SET is_online = '0', updated_at = '$current_date' WHERE id = $id";
                $result = mysqli_query($db, $query);
                http_response_code(200);
                echo json_encode(array(
                    "message" => "logout successfully",
                ));
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
