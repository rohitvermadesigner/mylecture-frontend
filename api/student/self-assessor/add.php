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
} else {
    $error_code = 405;
    array_push($error_msgs, "Method Not Allowed");
}
if (count($error_msgs) == 0) {
    $token_details = validate_student_token($post_data->token, $db);
    if ($token_details['status'] == 'success') {
        $student_id = $token_details['data']['id'];
        if (
            !empty($post_data->test_name) &&
            !empty($post_data->duration) &&
            !empty($post_data->subject_id) &&
            !empty($post_data->total_questions) &&
            !empty($post_data->marks_for_correct_question)
        ) {
            $test_name = trim($post_data->test_name);
            $duration = trim($post_data->duration);
            $is_question_random_order = !empty($post_data->is_question_random_order) ? 1 : 0;
            $is_mandatory_all_question = !empty($post_data->is_mandatory_all_question) ? 1 : 0;
            $subject_id =  $post_data->subject_id;
            $keyword = isset($post_data->keyword) && !empty($post_data->keyword) ? $post_data->keyword : '';
            $total_questions = $post_data->total_questions;
            $marks_for_correct_question = $post_data->marks_for_correct_question;

            $query = "SELECT * FROM self_assessor_test_config WHERE name = '$test_name' AND created_by = '$student_id' AND status = 1";
            $result = mysqli_query($db, $query);
            if (mysqli_num_rows($result) > 0) {
                http_response_code(400);
                echo json_encode(array(
                    "message" => "Test name already exist",
                ));
                exit;
            } else {
                $current_date = date('Y-m-d H:i:s');

                $where_condition = "";
                $where_condition .= " AND subject_id = $subject_id";
                if (!empty($keyword)) {
                    $where_condition .= " AND question LIKE '%$keyword%'";
                }

                $questionQuery = "SELECT * FROM question WHERE status = 1 $where_condition ORDER BY RAND() LIMIT $total_questions";
                $questionResult = mysqli_query($db, $questionQuery);
                $total_db_rows = mysqli_num_rows($questionResult);
                $current_date = date('Y-m-d H:i:s');
                if ($total_db_rows ==  $total_questions) {

                    // insert data into config table first
                    $query = "INSERT INTO self_assessor_test_config 
                        (name, duration, is_question_random_order, is_mandatory_all_question, subject_id, topic_id, total_questions, marks_for_correct_question, created_by, created_at) 
                        VALUES 
                        ('$test_name', '$duration', '$is_question_random_order', '$is_mandatory_all_question', '$subject_id', '0', '$total_questions', '$marks_for_correct_question', '$student_id', '$current_date')";
                    $result = mysqli_query($db, $query);
                    $test_id = "0";
                    if (mysqli_affected_rows($db) > 0) {
                        $test_id = mysqli_insert_id($db);
                    } else {
                        http_response_code(400);
                        echo json_encode(array(
                            "message" => "something went wrong with insert query",
                        ));
                        exit;
                    }

                    while ($question_data = mysqli_fetch_assoc($questionResult)) {

                        $question_id = $question_data['id'];
                        $insertQuery =  "INSERT INTO self_assessor_test_question 
                        (test_id, question_id, created_by, created_at) 
                        VALUES 
                        ('$test_id', '$question_id', '$student_id', '$current_date'); ";
                        mysqli_query($db, $insertQuery);
                    }

                    http_response_code(200);
                    echo json_encode(array(
                        "message" =>  "Test configuration has been successfully added",
                        "id" => (int)$test_id
                    ));
                } else {
                    http_response_code(400);
                    echo json_encode(array(
                        "message" => "We found $total_db_rows questions in our database please select different phase, subject or keyword or change number of questions",
                    ));
                    exit;
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
