<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// include database and object files
include_once '../../../config/core.php';
include_once '../../../config/database.php';
include_once '../../../shared/utilities.php';

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
} else {
    $error_code = 405;
    array_push($error_msgs, "Method Not Allowed");
}
if (count($error_msgs) == 0) {
    $token_details = validate_admin_faculty_token($post_data->token, $db);
    if ($token_details['status'] == 'success') {
        $admin_id = $token_details['data']['id'];
        if (!empty($post_data->test_id)) {
            $test_id = $post_data->test_id;
            $is_publish = !empty($post_data->is_publish) ? 1 : 0;
            if (!empty($is_publish)) {
                if (
                    !empty($post_data->test_start_date) && !empty($post_data->test_end_date) &&
                    !empty($post_data->test_start_time) &&  !empty($post_data->test_end_time)
                ) {
                    $test_start_date = $post_data->test_start_date;
                    $test_end_date = $post_data->test_end_date;
                    $test_start_time = $post_data->test_start_time;
                    $test_end_time = $post_data->test_end_time;
                    if (date_format(date_create($test_start_date . ' ' . $test_start_time), 'Y-m-d H:i:s') <=  date('Y-m-d H:i:s')) {
                        http_response_code(400);
                        echo json_encode(array(
                            "message" => "Test Start date time should be greater than today's date time",
                        ));
                        exit;
                    }
                    if (date_format(date_create($test_start_date . ' ' . $test_start_time), 'Y-m-d H:i:s') >  date_format(date_create($test_end_date . ' ' . $test_end_time), 'Y-m-d H:i:s')) {
                        http_response_code(400);
                        echo json_encode(array(
                            "message" => "Test Start date time should be less than test end date time",
                        ));
                        exit;
                    }
                    $test_start_date_time = date_format(date_create($test_start_date . ' ' . $test_start_time), "Y-m-d H:i:s");
                    $test_end_date_time = date_format(date_create($test_end_date . ' ' . $test_end_time), "Y-m-d H:i:s");
                    $current_date = date('Y-m-d H:i:s');
                    $query = "UPDATE test_config SET is_publish = '1', 
                        test_start_at = '$test_start_date_time', test_end_at = '$test_end_date_time', 
                        updated_at = '$current_date', updated_by = '$admin_id' WHERE id = '$test_id' 
                                    ";
                    $result = mysqli_query($db, $query);

                    http_response_code(200);
                    echo json_encode(array(
                        "message" =>  "Test configuration has been successfully saved",
                    ));
                } else {
                    array_push($error_msgs, "Test start date time and test end date time required");
                }
            } else {
                $current_date = date('Y-m-d H:i:s');
                $query = "UPDATE test_config SET is_publish = '0', test_start_at = NULL, test_end_at = NULL, 
                        updated_at = '$current_date', updated_by = '$admin_id' WHERE id = '$test_id'";
                $result = mysqli_query($db, $query);
                http_response_code(200);
                echo json_encode(array(
                    "message" =>  "Test configuration has been successfully saved",
                ));
            }
        } else {
            array_push($error_msgs, "Please enter test id");
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
