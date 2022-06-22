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
        array_push($error_msgs, "Token should not be blank");
    }
    if (empty($post_data->student_id)) {
        array_push($error_msgs, "Student id should not be blank");
    }
} else {
    $error_code = 405;
    array_push($error_msgs, "Method Not Allowed");
}
if (count($error_msgs) == 0) {
    $token_details = validate_admin_faculty_token($post_data->token, $db);
    if ($token_details['status'] == 'success') {
        $admin_id = $token_details['data']['id'];
        $student_id = $post_data->student_id;
        $name = !empty($post_data->name) ? $post_data->name : '';
        $group_id = !empty($post_data->group_id) ? $post_data->group_id : '1';
        $gender = !empty($post_data->gender) ? $post_data->gender : '';
        $date_of_birth = !empty($post_data->date_of_birth) ? $post_data->date_of_birth : '';
        $address = !empty($post_data->address) ? $post_data->address : '';
        $state = !empty($post_data->state) ? $post_data->state : '';
        $city = !empty($post_data->city) ? $post_data->city : '';
        $country = !empty($post_data->country) ? $post_data->country : '';
        $pincode = !empty($post_data->pincode) ? $post_data->pincode : '';

        if (!empty($name)) {
            $query = "SELECT * FROM student_info WHERE id = '$student_id' AND status = 1";
            $result = mysqli_query($db, $query);
            if (mysqli_num_rows($result) == 0) {
                http_response_code(400);
                echo json_encode(array(
                    "message" => "Student id is not valid",
                ));
                exit;
            } else {
                $current_date = date('Y-m-d H:i:s');
                $query = "UPDATE student_info SET name = '$name', group_id = '$group_id', gender = '$gender', 
                date_of_birth = '$date_of_birth', address = '$address', state = '$state', 
                city = '$city', country = '$country', pincode = '$pincode', 
                updated_at = '$current_date' WHERE id = '$student_id'";

                $result = mysqli_query($db, $query);
                http_response_code(200);
                echo json_encode(array(
                    "message" =>  "Student successfully updated"
                ));
            }
        } else {
            array_push($error_msgs, "student name, email id and mobile number should not be empty.");
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
