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
    $token_details = validate_admin_token($_GET['token'], $db);
    if ($token_details['status'] == 'success') {
        $admin_id = $token_details['data']['id'];

        if (isset($_GET['result_id']) && !empty($_GET['result_id'])) {
            $result_id = $_GET['result_id'];
            $current_date = date('Y-m-d H:i:s');
            $return_questions_array = array();
            $test_result_table = "test_result";
            $test_question_table = "test_question";
            $test_result_detail = "test_result_detail";

            $query_result_data = "SELECT * FROM $test_result_table WHERE id = '$result_id'";
            $select_result_data = mysqli_query($db, $query_result_data);
            if (mysqli_num_rows($select_result_data) == 0) {
                http_response_code(400);
                echo json_encode(array(
                    "message" => "Result id is not valid for this user.",
                ));
                exit;
            }
            $select_result_row = mysqli_fetch_assoc($select_result_data);
            $test_id = $select_result_row['test_id'];
            $total_questions = $select_result_row['total_questions'];
            $attempt_questions = $select_result_row['attempt_questions'];
            $correct_questions = $select_result_row['correct_questions'];
            $total_marks = $select_result_row['total_marks'];
            $obtain_marks = $select_result_row['obtain_marks'];
            $obtain_percentage = $select_result_row['obtain_percentage'];

            $select_question_id_query = "SELECT * FROM $test_question_table WHERE test_id = $test_id";
            $select_question_id_result = mysqli_query($db, $select_question_id_query);
            if (mysqli_num_rows($select_question_id_result) > 0) {
                $question_ids = array();
                while ($ques_mark_data = mysqli_fetch_assoc($select_question_id_result)) {
                    $question_id = $ques_mark_data['question_id'];
                    array_push($question_ids, $question_id);
                }
                $question_ids_str =  implode(', ', $question_ids);

                $questions_array = array();
                $return_questions_array = array();
                $query = "SELECT * FROM question WHERE id IN ($question_ids_str)";
                $result = mysqli_query($db, $query);
                $total_questions = mysqli_num_rows($result);
                if ($total_questions > 0) {
                    while ($question_data = mysqli_fetch_assoc($result)) {
                        $question_id = $question_data['id'];
                        $questions_array[$question_id] = array(
                            "answer" => (int)$question_data['answer']
                        );

                        $question_obj = array(
                            "id" => (int)$question_data['id'],
                            "question" => $question_data['question'],
                            "option_1" => $question_data['option_1'],
                            "option_2" => $question_data['option_2'],
                            "option_3" => $question_data['option_3'],
                            "option_4" => $question_data['option_4'],
                            "option_5" => $question_data['option_5'],
                            "correct_answer" => (int)$question_data['answer'],
                            "is_correct" => false,
                            "is_skip" => true,
                            "attempt_answer" => ""
                        );
                        $return_questions_array[$question_id] = $question_obj;
                    }

                    $query = "SELECT * FROM $test_result_detail WHERE test_result_id = '$result_id'";
                    $result = mysqli_query($db, $query);
                    if (mysqli_num_rows($result) > 0) {
                        while ($ques = mysqli_fetch_assoc($result)) {
                            $ques_id = $ques['question_id'];
                            $attempt_ans = (int)$ques['attempt_answer'];
                            $is_correct = $ques['is_correct'] == 1 ? true : false;
                            $return_questions_array[$ques_id]['attempt_answer'] = $attempt_ans;
                            $return_questions_array[$ques_id]['is_skip'] = false;
                            $return_questions_array[$ques_id]['is_correct'] = $is_correct;
                        }
                    }

                    http_response_code(200);
                    echo json_encode(array(
                        "total_questions" => $total_questions,
                        "attempt_questions" => $attempt_questions,
                        "correct_questions" => $correct_questions,
                        "total_marks" => $total_marks,
                        "obtain_marks" => $obtain_marks,
                        "obtain_percentage" => $obtain_percentage,
                        "questions" => array_values($return_questions_array)
                    ));
                } else {
                    array_push($error_msgs, "unable to fetch data from questions, please try again later");
                }
            } else {
                array_push($error_msgs, "questions count is 0 for selected test. please retry.");
            }
        } else {
            array_push($error_msgs, "Result id required");
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
