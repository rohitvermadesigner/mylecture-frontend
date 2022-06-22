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

        $topic_query = "SELECT * FROM topic WHERE status = 1";
        $topic_result = mysqli_query($db, $topic_query);
        $topic_data = array();
        if (mysqli_num_rows($topic_result) > 0) {
            while ($data = mysqli_fetch_assoc($topic_result)) {
                if (!array_key_exists($data['subject_id'], $topic_data)) {
                    $topic_data[$data['subject_id']] = array();
                }
                $topic_obj = array(
                    "id" => (int)$data['id'],
                    "name" => trim($data['name'])
                );
                if (isset($subtopic_data[$data['id']]) && !empty($subtopic_data[$data['id']])) {
                    $topic_obj['subtopic'] = $subtopic_data[$data['id']];
                }
                array_push($topic_data[$data['subject_id']], $topic_obj);
            }
        }

        $subject_query = "SELECT * FROM subject WHERE status = 1";
        $subject_result = mysqli_query($db, $subject_query);
        $subject_data = array();
        if (mysqli_num_rows($subject_result) > 0) {
            while ($data = mysqli_fetch_assoc($subject_result)) {
                if (!array_key_exists($data['phase_id'], $subject_data)) {
                    $subject_data[$data['phase_id']] = array();
                }
                $subject_obj = array(
                    "id" => (int)$data['id'],
                    "name" => trim($data['name']),
                    "topic" => array()
                );
                if (isset($topic_data[$data['id']]) && !empty($topic_data[$data['id']])) {
                    $subject_obj['topic'] = $topic_data[$data['id']];
                }
                array_push($subject_data[$data['phase_id']], $subject_obj);
            }
        }

        $phase_query = "SELECT * FROM phase";
        $phase_result = mysqli_query($db, $phase_query);
        $phase_data = array();
        if (mysqli_num_rows($phase_result) > 0) {
            while ($data = mysqli_fetch_assoc($phase_result)) {
                $phase_id = $data['id'];
                $phase_obj = array(
                    "id" => (int)$phase_id,
                    "name" => trim($data['name']),
                    "subject" => array()
                );
                if (isset($subject_data[$phase_id]) && !empty($subject_data[$phase_id])) {
                    $phase_obj['subject'] = $subject_data[$phase_id];
                }
                array_push($phase_data, $phase_obj);
            }
        }

        http_response_code(200);
        echo json_encode($phase_data);
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
