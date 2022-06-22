<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
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
    // make sure token is not empty
    if (empty($post_data->token)) {
        array_push($error_msgs, "Token should not be blank");
    }
    if (empty($post_data->old_password)) {
        array_push($error_msgs, "Old Password shoule not be empty");
    }
    if (empty($post_data->new_password)) {
        array_push($error_msgs, "New Password shoule not be empty");
    }
} else {
    $error_code = 405;
    array_push($error_msgs, "Method Not Allowed");
}

if (count($error_msgs) == 0) {
    $token_details = validate_admin_faculty_token($post_data->token, $db);
    if ($token_details['status'] == 'success') {
        $admin_id = $token_details['data']['id'];
        $old_password = $post_data->old_password;
        $new_password = $post_data->new_password;

        $query = "SELECT * FROM admin_info WHERE id = '$admin_id' AND status = 1";
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) > 0) {
            $admin_info = mysqli_fetch_assoc($result);
            if (md5($old_password) == $admin_info['password']) {
                $password = md5($new_password);
                $query = "UPDATE admin_info SET password = '$password' WHERE id = '$admin_id'";
                mysqli_query($db, $query);
                http_response_code(200);
                echo json_encode(array(
                    "message" => "Your password has been successfully updated",
                ));
            } else {
                array_push($error_msgs, "Your old password is not valid");
            }
        } else {
            array_push($error_msgs, "User info is not valid");
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



function update_student_info($student_id, $basic_info, $db)
{
    if (is_object($basic_info)) {
        $update_string = [];
        isset($basic_info->name) ? array_push($update_string, "name = '$basic_info->name'") : null;
        isset($basic_info->gender) ? array_push($update_string, "gender = '$basic_info->gender'") : null;
        isset($basic_info->date_of_birth) && !empty($basic_info->date_of_birth) ? array_push($update_string, "date_of_birth = '$basic_info->date_of_birth'") : null;
        isset($basic_info->address) ? array_push($update_string, "address = '$basic_info->address'") : null;
        isset($basic_info->state) ? array_push($update_string, "state = '$basic_info->state'") : null;
        isset($basic_info->city) ? array_push($update_string, "city = '$basic_info->city'") : null;
        isset($basic_info->country) ? array_push($update_string, "country = '$basic_info->country'") : null;
        isset($basic_info->pincode) ? array_push($update_string, "pincode = '$basic_info->pincode'") : null;
        if (count($update_string) > 0) {
            $set_str = implode(", ", $update_string);
            $query = "UPDATE student_info SET $set_str WHERE id = '$student_id'";
            mysqli_query($db, $query);
        }
    }
}
