<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// include database and object files
include_once '../../config/core.php';
include_once '../../config/database.php';
include_once '../../shared/utilities.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

$error_msgs = array();
$error_code = 400;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // make sure token is not empty
    if (isset($_GET['token'])) {
        if (empty($_GET['token'])) {
            array_push($error_msgs, "token should not be blank");
        }
    } else {
        array_push($error_msgs, "token should not be blank");
    }
} else {
    $error_code = 405;
    array_push($error_msgs, "Method Not Allowed");
}

if (count($error_msgs) == 0) {
    $token_details = validate_student_token($_GET['token'], $db);
    if ($token_details['status'] == 'success') {
        $student_id = $token_details['data']['id'];
        $student_name = $token_details['data']['name'];
        $group_id = $token_details['data']['group_id'];

        if (isset($_GET['test_id']) && !empty($_GET['test_id'])) {
            $test_id = $_GET['test_id'];
            $current_date = date('Y-m-d H:i:s');

            $select_query = "SELECT * FROM test_config WHERE id = $test_id AND student_group_id = '$group_id'";
            $select_result = mysqli_query($db, $select_query);
            if (mysqli_num_rows($select_result) == 0) {
                http_response_code(400);
                echo json_encode(array(
                    "message" => "Test id is not valid for this user.",
                ));
                exit;
            }
            $test_config = mysqli_fetch_assoc($select_result);
            $test_name = $test_config['name'];
            $test_duration = $test_config['duration'];
            $is_question_random_order = $test_config['is_question_random_order'];
            $is_mandatory_all_question = $test_config['is_mandatory_all_question'];
            $test_timing_pattern = $test_config['test_timing_pattern'];
            $is_publish = $test_config['is_publish'];
            $test_start_at = $test_config['test_start_at'];
            $test_end_at = $test_config['test_end_at'];

            if ($is_publish == 0) {
                http_response_code(400);
                echo json_encode(array(
                    "message" => "Test is not published yet",
                ));
                exit;
            } else if (date_format(date_create($test_end_at), 'Y-m-d H:i:s') < date('Y-m-d H:i:s')) {
                http_response_code(400);
                echo json_encode(array(
                    "message" => "Test has been published but expired",
                ));
                exit;
            } else if (date_format(date_create($test_start_at), 'Y-m-d H:i:s') >  date('Y-m-d H:i:s')) {
                http_response_code(400);
                echo json_encode(array(
                    "message" => "Test has been published but not yet started, it'll start at $test_start_at",
                ));
                exit;
            }

            $select_question_id_query = "SELECT * FROM test_question WHERE test_id = $test_id";
            $select_question_id_result = mysqli_query($db, $select_question_id_query);
            if (mysqli_num_rows($select_question_id_result) > 0) {
                $marks = array();
                $question_ids = array();
                while ($ques_mark_data = mysqli_fetch_assoc($select_question_id_result)) {
                    $question_id = $ques_mark_data['question_id'];
                    array_push($question_ids, $question_id);
                    $marks[$question_id] = (int)$ques_mark_data['marks'];
                }
                $question_ids_str =  implode(', ', $question_ids);

                $questions_array = array();
                $total_marks = 0;
                $query = "SELECT * FROM question WHERE id IN ($question_ids_str)";
                $result = mysqli_query($db, $query);
                $total_questions = mysqli_num_rows($result);
                if ($total_questions > 0) {
                    while ($question_data = mysqli_fetch_assoc($result)) {
                        $question_id = $question_data['id'];
                        $question_marks = $marks[$question_id];
                        $total_marks += $question_marks;
                        $question_obj = array(
                            "id" => (int)$question_data['id'],
                            "question" => $question_data['question'],
                            "option_1" => $question_data['option_1'],
                            "option_2" => $question_data['option_2'],
                            "option_3" => $question_data['option_3'],
                            "option_4" => $question_data['option_4'],
                            "option_5" => $question_data['option_5'],
                            "marks" => $question_marks,
                            "description" => $question_data['description'],
                        );
                        array_push($questions_array, $question_obj);
                    }
                }

                if ($is_question_random_order) {
                    shuffle($questions_array);
                }

                http_response_code(200);
                echo json_encode(array(
                    "student_name" => $student_name,
                    "test_name" => $test_name,
                    "test_duration" => $test_duration,
                    "total_questions" => $total_questions,
                    "total_marks" => $total_marks,
                    "is_mandatory_all_question" => $is_mandatory_all_question == 1 ? true : false,
                    "questions" => $questions_array
                ));
            } else {
                http_response_code(400);
                echo json_encode(array(
                    "message" => "we got 0 question configured in this test.",
                ));
                exit;
            }
        } else {
            http_response_code(400);
            echo json_encode(array(
                "message" => "Test id required for test questions",
            ));
            exit;
        }
        // http_response_code(200);
        // echo json_encode(array(
        //     "total_results" => $total_tests,
        //     "result" => $test_result_array
        // ));
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
