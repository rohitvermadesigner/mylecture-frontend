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
            if (!empty($post_data->questions) && is_array($post_data->questions)) {
                $test_id = $post_data->test_id;
                $questions = $post_data->questions;

                $query = "SELECT total_question FROM test_config WHERE id = '$test_id' AND status = 1";
                $result = mysqli_query($db, $query);
                if (mysqli_num_rows($result) > 0) {
                    $total_question_expected_row_data = mysqli_fetch_assoc($result);
                    $total_question_expected_count = $total_question_expected_row_data['total_question'];
                    if (count($questions) ==  $total_question_expected_count) {

                        $insertQuery = "";
                        //create a variable to check if question id should not be repeative.
                        $uniqueQuestion = array();
                        $current_date = date('Y-m-d H:i:s');
                        foreach ($questions as $key => $question) {
                            $question_id = $question->id;
                            $marks = $question->marks;
                            if (!in_array($question_id, $uniqueQuestion)) {
                                array_push($uniqueQuestion, $question_id);
                                $insertQuery .=  "INSERT INTO test_question (test_id, question_id, marks, created_by, created_at) VALUES ('$test_id', '$question_id', '$marks', '$admin_id', '$current_date'); ";
                            }
                        }

                        if (count($uniqueQuestion) == $total_question_expected_count) {
                            $deleteQuery = "DELETE FROM test_question WHERE test_id = $test_id";
                            mysqli_query($db, $deleteQuery);
                            mysqli_multi_query($db, $insertQuery);
                            http_response_code(200);
                            echo json_encode(array(
                                "message" =>  "Test configuration has been successfully saved",
                            ));
                        } else {
                            array_push($error_msgs, "question id should be unique.");
                        }
                    } else {
                        array_push($error_msgs, "Please select total $total_question_expected_count questions");
                    }
                } else {
                    array_push($error_msgs, "test id is not valid.");
                }
            } else {
                array_push($error_msgs, "Questions should be pass in array.");
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
