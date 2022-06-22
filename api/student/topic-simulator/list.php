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
        $search_test_name = isset($_GET['test_name']) && !empty($_GET['test_name']) ? $_GET['test_name'] : '';
        $search_subject_id = isset($_GET['subject_id']) && !empty($_GET['subject_id']) ? $_GET['subject_id'] : '';
        $page_no = isset($_GET['page_no']) && !empty($_GET['page_no']) ? $_GET['page_no'] : 1;
        $page_count = isset($_GET['page_count']) && !empty($_GET['page_count']) ? $_GET['page_count'] : 10;
        $test_result_array = array();
        $where_condition = "";
        $where_condition_for_final = "";
        if (!empty($search_test_name)) {
            $where_condition .= " AND name LIKE '%$search_test_name%'";
        }
        if (!empty($search_subject_id)) {
            $where_condition .= " AND subject_id = '$search_subject_id'";
        }
        $where_condition_for_final = $where_condition;
        $limit_start_from = 0;
        if ($page_no > 1) {
            $limit_start_from = ($page_no - 1) * $page_count;
        }
        $where_condition_for_final .= " ORDER BY id DESC LIMIT $limit_start_from, $page_count";

        $query_total_tests = "SELECT id FROM topic_simulator_test_config WHERE status = 1 AND created_by = '$student_id' $where_condition";
        $result_total_tests = mysqli_query($db, $query_total_tests);
        $total_tests = mysqli_num_rows($result_total_tests);

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

        $query = "SELECT * FROM topic_simulator_test_config WHERE status = 1 AND created_by = '$student_id' $where_condition_for_final";
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($question_data = mysqli_fetch_assoc($result)) {
                $ques_sub_id = $question_data['subject_id'];
                $ques_topic_id = $question_data['topic_id'];
                $test_obj = array(
                    "id" => (int)$question_data['id'],
                    "name" => $question_data['name'],
                    "duration" => $question_data['duration'],
                    "total_questions" => (int)$question_data['total_questions'],
                    "subject" => $ques_sub_id && isset($subjects[$ques_sub_id]) ? $subjects[$ques_sub_id] : '',
                    "topic" => $ques_topic_id && isset($topics[$ques_topic_id]) ? $topics[$ques_topic_id] : '',
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
            "total_results" => $total_tests,
            "result" => $test_result_array
        ));
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
