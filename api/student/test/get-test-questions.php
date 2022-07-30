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
        if (isset($_GET['test_id']) && !empty($_GET['test_id'])) {
            $test_id = $_GET['test_id'];
            $current_date = date('Y-m-d H:i:s');
            if (isset($_GET['type']) && !empty($_GET['type'])) {
                if ($_GET['type'] == 'topic-simulator' || $_GET['type'] == 'self-assessor') {

                    if ($_GET['type'] == 'topic-simulator') {
                        $test_config_table = "topic_simulator_test_config";
                        $test_question_table = "topic_simulator_test_question";
                    } else if ($_GET['type'] == 'self-assessor') {
                        $test_config_table = "self_assessor_test_config";
                        $test_question_table = "self_assessor_test_question";
                    }

                    $select_query = "SELECT * FROM $test_config_table WHERE id = $test_id AND created_by = '$student_id'";
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
                    $total_questions = $test_config['total_questions'];
                    $is_question_random_order = $test_config['is_question_random_order'];
                    $is_mandatory_all_question = $test_config['is_mandatory_all_question'];
                    $no_of_attempt = (int)$test_config['no_of_attempt'];
                    $marks_for_correct_question = $test_config['marks_for_correct_question'];
                    $marks_for_incorrect_question = $test_config['marks_for_incorrect_question'];

                    $select_question_id_query = "SELECT * FROM $test_question_table WHERE test_id = $test_id AND created_by = '$student_id'";
                    $select_question_id_result = mysqli_query($db, $select_question_id_query);
                    if (mysqli_num_rows($select_question_id_result) > 0) {
                        // $marks = array();
                        $question_ids = array();
                        while ($ques_mark_data = mysqli_fetch_assoc($select_question_id_result)) {
                            $question_id = $ques_mark_data['question_id'];
                            array_push($question_ids, $question_id);
                            // $marks[$question_id] = $marks_for_correct_question;
                        }
                        $question_ids_str =  implode(', ', $question_ids);
                        $questions_array = array();
                        $total_marks = $total_questions * $marks_for_correct_question;
                        $query = "SELECT * FROM question WHERE id IN ($question_ids_str)";
                        $result = mysqli_query($db, $query);
                        $total_questions = mysqli_num_rows($result);
                        if ($total_questions > 0) {
                            while ($question_data = mysqli_fetch_assoc($result)) {
                                $question_obj = array(
                                    "id" => (int)$question_data['id'],
                                    "question" => $question_data['question'],
                                    "option_1" => $question_data['option_1'],
                                    "option_2" => $question_data['option_2'],
                                    "option_3" => $question_data['option_3'],
                                    "option_4" => $question_data['option_4'],
                                    "option_5" => $question_data['option_5'],
                                    "marks" => $marks_for_correct_question,
                                    "description" => $question_data['description'],
                                    "difficulty_level" => $question_data['difficulty_level'],
                                );
                                array_push($questions_array, $question_obj);
                            }
                        }

                        if ($is_question_random_order == '1') {
                            shuffle($questions_array);
                        }

                        $no_of_attempt = $no_of_attempt + 1;
                        $updateQuery = "UPDATE $test_config_table SET no_of_attempt = $no_of_attempt, 
                        last_attempt_at = '$current_date' WHERE id = $test_id";
                        mysqli_query($db, $updateQuery);

                        http_response_code(200);
                        echo json_encode(array(
                            "student_name" => $student_name,
                            "test_name" => $test_name,
                            "test_duration" => $test_duration,
                            "total_questions" => $total_questions,
                            "total_marks" => $total_marks,
                            "is_question_random_order" => $is_question_random_order,
                            "marks_for_correct_question" => $marks_for_correct_question,
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
                        "message" => "Test should be 'topic-simulator' of 'self-assessor'",
                    ));
                    exit;
                }
            } else {
                http_response_code(400);
                echo json_encode(array(
                    "message" => "Test type required for test questions",
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
