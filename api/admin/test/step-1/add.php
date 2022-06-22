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
        if (
            !empty($post_data->test_name) && !empty($post_data->category_id)
            && !empty($post_data->instruction_id) && !empty($post_data->duration)
            && !empty($post_data->diffifulty_level) && !empty($post_data->total_questions)
        ) {
            $test_name = trim($post_data->test_name);
            $category_id = trim($post_data->category_id);
            $instruction_id = trim($post_data->instruction_id);
            $duration = trim($post_data->duration);
            $diffifulty_level = trim($post_data->diffifulty_level);
            $total_questions = trim($post_data->total_questions);
            $query = "SELECT * FROM test_config WHERE name = '$test_name' AND status = 1";
            $result = mysqli_query($db, $query);
            if (mysqli_num_rows($result) > 0) {
                http_response_code(400);
                echo json_encode(array(
                    "message" => "Test name already exist",
                ));
                exit;
            } else {
                $current_date = date('Y-m-d H:i:s');
                $query = "INSERT INTO test_config (name, category_id, instruction_id, duration, difficulty_level, total_question, created_by, created_at) 
                        VALUES ('$test_name', '$category_id', '$instruction_id', '$duration', '$diffifulty_level', '$total_questions' ,'$admin_id', '$current_date')";
                $result = mysqli_query($db, $query);
                if (mysqli_affected_rows($db) > 0) {
                    $inserted_id = mysqli_insert_id($db);
                    http_response_code(200);
                    echo json_encode(array(
                        "message" =>  "Test configuration has been successfully added",
                        "id" => (int)$inserted_id
                    ));
                } else {
                    array_push($error_msgs, "something went wrong with insert query");
                }
            }
        } else {
            array_push($error_msgs, "Please fill all mandatory fields");
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
