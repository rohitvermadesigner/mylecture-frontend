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
        $student_group_id = $token_details['data']['group_id'];
        $test_result_array = array();

        $performTestArray = array();
        $testResultQuery = "SELECT * FROM test_result WHERE student_id = '$student_id'";
        $testResult = mysqli_query($db, $testResultQuery);
        if (mysqli_num_rows($testResult) > 0) {
            while ($testData = mysqli_fetch_assoc($testResult)) {
                $test_id = (int)$testData['test_id'];
                $performTestArray[$test_id] = $testData['created_at'];
            }
        }

        $query = "SELECT * FROM test_config WHERE status = 1 AND  CONCAT(',', student_group_id, ',') like '%,$student_group_id,%' AND is_publish = '1' ORDER BY id DESC";
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($question_data = mysqli_fetch_assoc($result)) {
                $test_id = (int)$question_data['id'];
                $is_expired = is_expired($question_data['test_end_at']);
                $is_started = is_started($question_data['test_start_at']);
                $is_test_already_perfomed = isset($performTestArray[$test_id]) ? true : false;
                $is_start_test_button_active = !$is_expired && $is_started && !$is_test_already_perfomed ? true : false;
                $last_attempt_at = $is_test_already_perfomed ? $performTestArray[$test_id] : '';
                $test_obj = array(
                    "id" => (int)$question_data['id'],
                    "name" => $question_data['name'],
                    "duration" => $question_data['duration'],
                    "difficulty_level" => $question_data['difficulty_level'],
                    "total_questions" => (int)$question_data['total_question'],
                    "test_start_at" => $question_data['test_start_at'],
                    "test_end_at" => $question_data['test_end_at'],
                    "is_started" => $is_started,
                    "is_expired" => $is_expired,
                    "is_start_test_button_active" => $is_start_test_button_active,
                    "is_test_already_perfomed" => $is_test_already_perfomed,
                    "last_attempt_at" => $last_attempt_at
                );
                array_push($test_result_array, $test_obj);
            }
        }
        http_response_code(200);
        echo json_encode(array(
            "result" => $test_result_array
        ));
    } else {
        array_push($error_msgs, $token_details['message']);
    }
}

function is_expired($end_date)
{
    if (date_format(date_create($end_date), 'Y-m-d H:i:s') < date('Y-m-d H:i:s')) {
        return true;
    }
    return false;
}

function is_started($start_date)
{
    if (date_format(date_create($start_date), 'Y-m-d H:i:s') <  date('Y-m-d H:i:s')) {
        return true;
    }
    return false;
}


if (count($error_msgs) > 0) {
    // set response code - 400 bad request
    http_response_code($error_code);
    // tell the user
    echo json_encode(array("message" => implode(", ", $error_msgs)));
}
