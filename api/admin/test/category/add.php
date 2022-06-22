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
    if (empty($post_data->name)) {
        array_push($error_msgs, "Test Category name should not be empty.");
    }
} else {
    $error_code = 405;
    array_push($error_msgs, "Method Not Allowed");
}
if (count($error_msgs) == 0) {
    $token_details = validate_admin_token($post_data->token, $db);
    if ($token_details['status'] == 'success') {
        $admin_id = $token_details['data']['id'];
        $test_category_name = mysqli_real_escape_string($db, trim($post_data->name));
        $query = "SELECT * FROM test_category WHERE name = '$test_category_name' AND status = 1";
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) > 0) {
            http_response_code(400);
            echo json_encode(array(
                "message" => "Test Category name already exist",
            ));
            exit;
        } else {
            $current_date = date('Y-m-d H:i:s');
            $query = "INSERT INTO test_category (name, created_by, created_at) VALUES ('$test_category_name', '$admin_id', '$current_date')";
            $result = mysqli_query($db, $query);
            if (mysqli_affected_rows($db) > 0) {
                $inserted_id = mysqli_insert_id($db);
                http_response_code(200);
                echo json_encode(array(
                    "message" =>  "Test Category successfully added",
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
