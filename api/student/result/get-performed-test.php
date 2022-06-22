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
        $current_date = date('Y-m-d H:i:s');
        if (isset($_GET['type']) && !empty($_GET['type'])) {
            if ($_GET['type'] == 'topic-simulator' || $_GET['type'] == 'self-assessor') {
                $test_config_table = "";
                $test_result_array = array();
                if ($_GET['type'] == 'topic-simulator') {
                    $test_config_table = "topic_simulator_test_config";
                } else if ($_GET['type'] == 'self-assessor') {
                    $test_config_table = "self_assessor_test_config";
                }


                $query_subjects = "SELECT * FROM subject";
                $result_subjects = mysqli_query($db, $query_subjects);
                $subjects = array();
                if (mysqli_num_rows($result_subjects) > 0) {
                    while ($subject_data = mysqli_fetch_assoc($result_subjects)) {
                        $subject_id = $subject_data['id'];
                        $subjects[$subject_id] = $subject_data['name'];
                    }
                }

                $query_topics = "SELECT * FROM topic";
                $result_topics = mysqli_query($db, $query_topics);
                $topics = array();
                if (mysqli_num_rows($result_topics) > 0) {
                    while ($topic_data = mysqli_fetch_assoc($result_topics)) {
                        $topic_id = $topic_data['id'];
                        $topics[$topic_id] = $topic_data['name'];
                    }
                }

                $query = "SELECT * FROM $test_config_table 
                            WHERE status = 1 AND successfully_submitted > 0 AND 
                            created_by = '$student_id' 
                            ORDER BY last_attempt_at DESC";

                $result = mysqli_query($db, $query);
                $total_test_count = mysqli_num_rows($result);
                if (mysqli_num_rows($result) > 0) {
                    while ($question_data = mysqli_fetch_assoc($result)) {
                        $ques_sub_id = $question_data['subject_id'];
                        $ques_topic_id = $question_data['topic_id'];
                        $test_obj = array(
                            "id" => (int)$question_data['id'],
                            "name" => $question_data['name'],
                            "duration" => $question_data['duration'],
                            "total_questions" => (int)$question_data['total_questions'],
                            "subject" => $ques_sub_id ? $subjects[$ques_sub_id] : '',
                            "topic" => $ques_topic_id ? $topics[$ques_topic_id] : '',
                            "no_of_attemps" => (int)$question_data['no_of_attempt'],
                            "successfully_submitted" => (int)$question_data['successfully_submitted'],
                            "created_at" => $question_data['created_at'],
                            "last_attempt_at" => !empty($question_data['last_attempt_at']) ? $question_data['last_attempt_at'] : '',
                        );
                        array_push($test_result_array, $test_obj);
                    }
                }
                http_response_code(200);
                echo json_encode(array(
                    "total_results" => $total_test_count,
                    "result" => $test_result_array
                ));
            } else {
                array_push($error_msgs, "Test should be 'topic-simulator' of 'self-assessor'");
            }
        } else {
            array_push($error_msgs, "Test type required");
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
