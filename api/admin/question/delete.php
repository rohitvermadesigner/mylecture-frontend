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
    $token_details = validate_admin_faculty_token($post_data->token, $db);
    if ($token_details['status'] == 'success') {
        $admin_id = $token_details['data']['id'];
        if (!empty($post_data->question_id)) {
            $question_id = $post_data->question_id;
            $query = "SELECT * FROM question WHERE id = '$question_id'";
            $result = mysqli_query($db, $query);
            if (mysqli_num_rows($result) > 0) {
                $current_date = date('Y-m-d H:i:s');
                $query = "SELECT * FROM test_question WHERE question_id = '$question_id'";
                $result = mysqli_query($db, $query);
                if (mysqli_num_rows($result) > 0) {
                    $test_count = mysqli_num_rows($result);
                    http_response_code(400);
                    echo json_encode(array(
                        "message" => "You can not delete this question because this question is already used in $test_count tests",
                    ));
                    exit;
                }

                $query = "SELECT * FROM self_assessor_test_question WHERE question_id = '$question_id'";
                $result = mysqli_query($db, $query);
                if (mysqli_num_rows($result) > 0) {
                    $test_count = mysqli_num_rows($result);
                    http_response_code(400);
                    echo json_encode(array(
                        "message" => "You can not delete this question because this question is already used in $test_count self assessor tests",
                    ));
                    exit;
                }

                $query = "SELECT * FROM topic_simulator_test_question WHERE question_id = '$question_id'";
                $result = mysqli_query($db, $query);
                if (mysqli_num_rows($result) > 0) {
                    $test_count = mysqli_num_rows($result);
                    http_response_code(400);
                    echo json_encode(array(
                        "message" => "You can not delete this question because this question is already used in $test_count topic simulator tests",
                    ));
                    die();
                }

                $query = "UPDATE question SET status = '0', updated_at = '$current_date', deleted_at = '$current_date', deleted_by = '$admin_id' WHERE id = $question_id";
                $result = mysqli_query($db, $query);
                http_response_code(200);
                echo json_encode(array(
                    "message" =>  "Question successfully deleted",
                ));
            } else {
                array_push($error_msgs, "Question id is not valid");
            }
        } else {
            array_push($error_msgs, "Question id should not be empty.");
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
