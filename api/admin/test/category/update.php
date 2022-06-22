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
        array_push($error_msgs, "token should not be blank");
    }
} else {
    $error_code = 405;
    array_push($error_msgs, "Method Not Allowed");
}
if (count($error_msgs) == 0) {
    $token_details = validate_admin_token($post_data->token, $db);
    if ($token_details['status'] == 'success') {
        $admin_id = $token_details['data']['id'];
        if (!empty($post_data->name) && !empty($post_data->category_id)) {
            $category_id = !empty($post_data->category_id) ? $post_data->category_id : '';
            $category_name = mysqli_real_escape_string($db, trim($post_data->name));

            // check if group exist in student_group table
            $query = "SELECT * FROM test_category WHERE id = '$category_id' AND status = 1";
            $result = mysqli_query($db, $query);
            if (mysqli_num_rows($result) > 0) {
                $query = "SELECT * FROM test_category WHERE name = '$category_name' AND status = 1 AND id != '$category_id'";
                $result = mysqli_query($db, $query);
                if (mysqli_num_rows($result) > 0) {
                    array_push($error_msgs, "Test category name already exist");
                } else {
                    $current_date = date('Y-m-d H:i:s');
                    $query = "UPDATE test_category SET name = '$category_name', updated_at = '$current_date', updated_by = '$admin_id' WHERE id = '$category_id'";
                    $result = mysqli_query($db, $query);
                    http_response_code(200);
                    echo json_encode(array(
                        "message" =>  "Test category successfully updated"
                    ));
                }
            } else {
                array_push($error_msgs, "Test category id is not valid");
            }
        } else {
            array_push($error_msgs, "Test category name and Test category id should not be empty.");
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
