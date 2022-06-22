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
$post_data = json_decode(file_get_contents("php://input"));
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
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $question_id = $_GET['id'];

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

            $query = "SELECT * FROM question WHERE id = $question_id AND status = 1";
            $result = mysqli_query($db, $query);
            if (mysqli_num_rows($result) > 0) {
                $data = mysqli_fetch_assoc($result);
                $subject_info = null;
                $subject_id = $data['subject_id'];
                if (!empty($subject_id) && $subject_id != 0) {
                    $subject_info = array(
                        "id" => (int)$subject_id,
                        "name" => isset($subject_data[$subject_id]) ? $subject_data[$subject_id] : ''
                    );
                }

                $topic_info = null;
                $topic_id = $data['topic_id'];
                if (!empty($topic_id) && $topic_id != 0) {
                    $topic_info = array(
                        "id" => (int)$topic_id,
                        "name" => isset($topic_data[$topic_id]) ? $topic_data[$topic_id] : ''
                    );
                }
                $result_data = array(
                    "id" => (int)$data['id'],
                    "question" => $data['question'],
                    "option_1" => $data['option_1'],
                    "option_2" => $data['option_2'],
                    "option_3" => $data['option_3'],
                    "option_4" => $data['option_4'],
                    "option_5" => $data['option_5'],
                    "answer" => (int)$data['answer'],
                    "subject" => $subject_info,
                    "topic" => $topic_info,
                    "difficulty_level" => $data['difficulty_level'],
                    "description" => $data['description'],
                );
                http_response_code(200);
                echo json_encode($result_data);
            } else {
                array_push($error_msgs, 'question id is not valid');
            }
        } else {
            array_push($error_msgs, 'question id should be required to get question details');
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
