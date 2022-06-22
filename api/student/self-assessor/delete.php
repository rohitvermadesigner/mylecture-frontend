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
} else {
    $error_code = 405;
    array_push($error_msgs, "Method Not Allowed");
}
if (count($error_msgs) == 0) {
    $token_details = validate_student_token($post_data->token, $db);
    if ($token_details['status'] == 'success') {
        $student_id = $token_details['data']['id'];
        if (!empty($post_data->test_id)) {
            $test_id = $post_data->test_id;
            $query = "SELECT * FROM self_assessor_test_config WHERE id = '$test_id' AND created_by = '$student_id'";
            $result = mysqli_query($db, $query);
            if (mysqli_num_rows($result) > 0) {
                $current_date = date('Y-m-d H:i:s');
                $query = "UPDATE self_assessor_test_config SET status = '0', deleted_at = '$current_date' WHERE id = $test_id";
                $result = mysqli_query($db, $query);
                http_response_code(200);
                echo json_encode(array(
                    "message" =>  "Test successfully deleted",
                ));
            } else {
                http_response_code(400);
                echo json_encode(array(
                    "message" => "test id is not valid",
                ));
            }
        } else {
            array_push($error_msgs, "test id should not be empty.");
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
