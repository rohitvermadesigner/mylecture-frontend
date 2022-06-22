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

// get posted data
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
    $token_details = validate_admin_faculty_token($_GET['token'], $db);
    if ($token_details['status'] == 'success') {
        $admin_id = $token_details['data']['id'];

        $search_subject = isset($_GET['subject']) && !empty($_GET['subject']) ? $_GET['subject'] : '';
        $search_topic = isset($_GET['topic']) && !empty($_GET['topic']) ? $_GET['topic'] : '';
        $search_question = isset($_GET['question']) && !empty($_GET['question']) ? $_GET['question'] : '';
        $page_no = isset($_GET['page_no']) && !empty($_GET['page_no']) ? $_GET['page_no'] : 1;
        $page_count = isset($_GET['page_count']) && !empty($_GET['page_count']) ? $_GET['page_count'] : 10;
        $question_array = array();
        $where_condition = "";
        $where_condition_for_final = "";
        if (!empty($search_subject)) {
            $where_condition .= " AND subject_id = $search_subject";
        }
        if (!empty($search_topic)) {
            $where_condition .= " AND topic_id = $search_topic";
        }
        if (!empty($search_question)) {
            $where_condition .= " AND question LIKE '%$search_question%'";
        }
        $where_condition_for_final = $where_condition;
        $limit_start_from = 0;
        if ($page_no > 1) {
            $limit_start_from = ($page_no - 1) * $page_count;
        }
        $where_condition_for_final .= " ORDER BY id DESC LIMIT $limit_start_from, $page_count";

        $query_total_questions = "SELECT * FROM question WHERE status = 1 $where_condition";
        $result_total_questions = mysqli_query($db, $query_total_questions);
        $total_questions = mysqli_num_rows($result_total_questions);

        $topic_query = "SELECT * FROM topic";
        $topic_result = mysqli_query($db, $topic_query);
        $topic_data = array();
        if (mysqli_num_rows($topic_result) > 0) {
            while ($data = mysqli_fetch_assoc($topic_result)) {
                $topic_id = $data['id'];
                $topic_data[$topic_id] = trim($data['name']);
            }
        }

        $subject_query = "SELECT * FROM subject";
        $subject_result = mysqli_query($db, $subject_query);
        $subject_data = array();
        if (mysqli_num_rows($subject_result) > 0) {
            while ($data = mysqli_fetch_assoc($subject_result)) {
                $subject_id = $data['id'];
                $subject_data[$subject_id] = trim($data['name']);
            }
        }

        $query = "SELECT * FROM question WHERE status = 1 $where_condition_for_final";
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($question_data = mysqli_fetch_assoc($result)) {
                $ques_sub_id = $question_data['subject_id'];
                $ques_topic_id = $question_data['topic_id'];
                $question_obj = array(
                    "id" => (int)$question_data['id'],
                    "question" => trim($question_data['question']),
                    "subject" => $ques_sub_id && isset($subject_data[$ques_sub_id]) ? $subject_data[$ques_sub_id] : '',
                    "topic" => $ques_topic_id && isset($topic_data[$ques_topic_id]) ? $topic_data[$ques_topic_id] : '',
                    "difficulty_level" => trim($question_data['difficulty_level']),
                    "is_modified" => ($question_data['is_modified']) ? true : false,
                );
                array_push($question_array, $question_obj);
            }
        }
        http_response_code(200);
        echo json_encode(array(
            "total_results" => $total_questions,
            "result" => $question_array
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
