<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// include database and object files
include_once '../../config/core.php';
include_once '../../config/database.php';
include_once '../../shared/utilities.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// get posted data
$post_data = json_decode(file_get_contents("php://input"));
$error_msgs = array();
$error_code = 400;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // make sure token is not empty
    if (empty($post_data->token)) {
        array_push($error_msgs, "token should not be blank");
    }
    if (!empty($post_data->name) && !empty($post_data->email_id)) {
        if (!validate_email($post_data->email_id)) {
            array_push($error_msgs, "Please enter valid email id");
        }
    } else {
        array_push($error_msgs, "name and email id should not be empty.");
    }
    if (!empty($post_data->mobile_no)) {
        if (!validate_mobile($post_data->mobile_no)) {
            array_push($error_msgs, "Please enter valid mobile no");
        }
    }
} else {
    $error_code = 405;
    array_push($error_msgs, "Method Not Allowed");
}
if (count($error_msgs) == 0) {
    $token_details = validate_admin_token($post_data->token, $db);
    if ($token_details['status'] == 'success') {
        $admin_id = $token_details['data']['id'];
        $faculty_name = $post_data->name;
        $email_id = $post_data->email_id;
        $subject_id = !empty($post_data->subject_id) ? $post_data->subject_id : '1';
        $mobile_no = !empty($post_data->mobile_no) ? $post_data->mobile_no : '';
        $password = generateRandomString(10);

        $query = "SELECT * FROM admin_info WHERE email_id = '$email_id' AND role = 'faculty' AND status = 1";
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) > 0) {
            http_response_code(400);
            echo json_encode(array(
                "message" => "Faculty email id already exist",
            ));
            exit;
        } else {
            $current_date = date('Y-m-d H:i:s');
            $faculty_unique_code = "FAC_00001";
            $query = "SELECT * FROM admin_info WHERE role = 'faculty' ORDER BY id DESC LIMIT 1";
            $result = mysqli_query($db, $query);
            if (mysqli_num_rows($result) == 1) {
                $faculty_data = mysqli_fetch_assoc($result);
                $faculty_code = $faculty_data['unique_code'];
                $faculty_code_id = substr($faculty_code, 4) + 1;
                $faculty_code = str_pad("$faculty_code_id", 5, '0', STR_PAD_LEFT);
                $faculty_unique_code = "FAC_$faculty_code";
            }

            msg91_otp_email_send("facultyRegistration", $email_id, $faculty_name, array(
                "faculty_name" => $faculty_name,
                "faculty_user_id" => $faculty_unique_code,
                "email_id" => $email_id,
                "password" => $password,
            ));

            msg91_otp_email_send("facultyRegistration", $admin_email, "Admin", array(
                "faculty_name" => $faculty_name,
                "faculty_user_id" => $faculty_unique_code,
                "email_id" => $email_id,
                "password" => $password,
            ));

            $encrypted_password = md5($password);
            $query = "INSERT INTO admin_info (role, unique_code, name, email_id, mobile_no, password, subject_id, created_at) 
                        VALUES ('faculty', '$faculty_unique_code', '$faculty_name', '$email_id', '$mobile_no', '$encrypted_password', '$subject_id', '$current_date')";

            $result = mysqli_query($db, $query);
            if (mysqli_affected_rows($db) > 0) {
                $inserted_id = mysqli_insert_id($db);
                http_response_code(200);
                echo json_encode(array(
                    "message" =>  "Faculty successfully added",
                    "id" => (int)$inserted_id
                ));
            } else {
                array_push($error_msgs, "something went wrong with insert query.");
            }
        }
    } else {
        array_push($error_msgs, $token_details['message']);
    }
}


if (count($error_msgs) > 0) {
    // set response code - 400 bad request
    http_response_code($error_code);
    // tell the user
    echo json_encode(array("message" => implode(", ", $error_msgs)));
}
