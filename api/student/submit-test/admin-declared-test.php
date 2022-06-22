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
        $student_group_id = $token_details['data']['group_id'];
        $test_result_table = "test_result";
        $test_result_detail_table = "test_result_detail";
        $test_config_table = "test_config";
        $test_question_table = "test_question";
        if (!empty($post_data->test_id)) {
            if (!empty($post_data->questions) && is_array($post_data->questions)) {
                $test_id = $post_data->test_id;
                $submitted_questions = $post_data->questions;
                $current_date = date('Y-m-d H:i:s');

                $select_query = "SELECT * FROM $test_config_table WHERE id = $test_id AND student_group_id = '$student_group_id'";
                $select_result = mysqli_query($db, $select_query);
                if (mysqli_num_rows($select_result) == 0) {
                    http_response_code(400);
                    echo json_encode(array(
                        "message" => "Test id is not valid for this user.",
                    ));
                    exit;
                }
                $test_config = mysqli_fetch_assoc($select_result);
                $is_report_show = $test_config['is_report_show'];

                // check if test is already submitted by student then he can not submit again..
                $selectQuery = "SELECT * FROM $test_result_table WHERE test_id = '$test_id' AND student_id = '$student_id'";
                $selectResult = mysqli_query($db, $selectQuery);
                if (mysqli_num_rows($selectResult) > 0) {
                    http_response_code(400);
                    echo json_encode(array(
                        "message" => "You have already submitted this test so you can not submit again",
                    ));
                    exit;
                }

                $select_question_id_query = "SELECT * FROM $test_question_table WHERE test_id = $test_id";
                $select_question_id_result = mysqli_query($db, $select_question_id_query);
                if (mysqli_num_rows($select_question_id_result) > 0) {
                    $marks = array();
                    $question_ids = array();
                    while ($ques_mark_data = mysqli_fetch_assoc($select_question_id_result)) {
                        $question_id = $ques_mark_data['question_id'];
                        array_push($question_ids, $question_id);
                        $marks[$question_id] = $ques_mark_data['marks'];
                    }
                    $question_ids_str =  implode(', ', $question_ids);

                    $questions_array = array();
                    $return_questions_array = array();
                    $total_marks = 0;
                    $query = "SELECT * FROM question WHERE id IN ($question_ids_str)";
                    $result = mysqli_query($db, $query);
                    $total_questions = mysqli_num_rows($result);
                    if ($total_questions > 0) {
                        while ($question_data = mysqli_fetch_assoc($result)) {
                            $question_id = $question_data['id'];
                            $question_marks = $marks[$question_id];
                            $total_marks += $question_marks;
                            $questions_array[$question_id] = array(
                                "marks" => $question_marks,
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
                                "description" => $question_data['description'],
                                "marks" => $question_marks,
                                "correct_answer" => (int)$question_data['answer'],
                                "is_correct" => false,
                                "is_skip" => true,
                                "attempt_answer" => ""
                            );
                            $return_questions_array[$question_id] = $question_obj;
                        }


                        $result_detail_insert_query = "";
                        $attempt_questions = 0;
                        $obtain_marks = 0;
                        $obtain_percentage = 0;
                        $correct_questions = 0;
                        $result_inserted_id = 0;
                        foreach ($submitted_questions as $ques) {
                            $ques_id = $ques->id;
                            $attempt_ans = (int)$ques->answer;
                            $correct_ans = $questions_array[$ques_id]['answer'];
                            $return_questions_array[$ques_id]['attempt_answer'] = $attempt_ans;
                            $return_questions_array[$ques_id]['is_skip'] = false;
                            $is_correct = 0;
                            //if given answer will be correct;
                            if ($attempt_ans == $correct_ans) {
                                $is_correct = 1;
                                $correct_questions += 1;
                                $obtain_marks += $questions_array[$ques_id]['marks'];
                                $return_questions_array[$ques_id]['is_correct'] = true;
                            }
                            if (!empty($attempt_ans)) {
                                $attempt_questions += 1;
                            }
                            $result_detail_insert_query .= "INSERT INTO $test_result_detail_table (test_result_id, test_id, question_id, correct_answer, attempt_answer, is_correct) 
                                    VALUE ('result_inserted_id', '$test_id', '$ques_id','$correct_ans','$attempt_ans','$is_correct'); \n";
                        }

                        $obtain_percentage = round((($obtain_marks * 100) / $total_marks), 0);

                        $insertQuery = "INSERT INTO $test_result_table 
                                (student_id, test_id, total_questions, correct_questions, attempt_questions, total_marks, obtain_marks, obtain_percentage, created_at) 
                                VALUES 
                                ('$student_id', '$test_id', '$total_questions', '$correct_questions', '$attempt_questions', '$total_marks', '$obtain_marks', '$obtain_percentage', '$current_date')";

                        $result = mysqli_query($db, $insertQuery);
                        if (mysqli_affected_rows($db) > 0) {
                            $result_inserted_id = mysqli_insert_id($db);
                            $result_detail_insert_query = str_replace("result_inserted_id", $result_inserted_id, $result_detail_insert_query);
                            mysqli_multi_query($db, $result_detail_insert_query);
                        }

                        http_response_code(200);
                        if ($is_report_show) {
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
                            echo json_encode(array(
                                "status" => "successfully submitted"
                            ));
                        }
                    } else {
                        array_push($error_msgs, "unable to fetch data from questions, please try again later");
                    }
                } else {
                    array_push($error_msgs, "questions count is 0 for selected test. contact please retry.");
                }
            } else {
                array_push($error_msgs, "questions should not be empty or should be an array");
            }
        } else {
            array_push($error_msgs, "test id required");
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
