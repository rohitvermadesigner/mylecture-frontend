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
    if (empty($post_data->email_id)) {
        array_push($error_msgs, "email_id should not be blank");
    } else {
        if (!validate_email($post_data->email_id)) {
            array_push($error_msgs, "please enter valid email_id");
        }
    }
    if (empty($post_data->password)) {
        array_push($error_msgs, "password should not be blank.");
    }
} else {
    $error_code = 405;
    array_push($error_msgs, "Method Not Allowed");
}

if (count($error_msgs) == 0) {
    $email_id = $post_data->email_id;
    $password = $post_data->password;
    $current_date = date('Y-m-d H:i:s');
    $query = "SELECT * FROM admin_info WHERE email_id = '$email_id'  AND status = 1";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        if ($data['password'] == md5($password)) {
            $id = $data['id'];
            $account_type = $data['role'];
            $login_count = $data['login_count'] + 1;
            $token_info = "admin/$id";
            $token = encrypt_decrypt('encrypt', $token_info);
            http_response_code(200);
            echo json_encode(array(
                "message" => "login successfully",
                "token" => $token,
                "account_type" => encrypt_decrypt('encrypt', $account_type)
            ));
            $query = "UPDATE admin_info SET login_count = '$login_count', last_login_at = '$current_date' WHERE id = '$id'";
            mysqli_query($db, $query);
        } else {
            array_push($error_msgs, 'Password is not valid.');
        }
    } else {
        array_push($error_msgs, "Your Email id is not registered");
    }
}


if (count($error_msgs) > 0) {
    // set response code - 400 bad request
    http_response_code($error_code);
    // tell the user
    echo json_encode(array("message" => implode(", ", $error_msgs)));
}
