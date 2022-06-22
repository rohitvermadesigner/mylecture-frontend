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

        $query = "SELECT * FROM test_config WHERE status = 1 AND student_group_id = '$student_group_id' AND is_publish = '1' ORDER BY id DESC";
        $result = mysqli_query($db, $query);
        $admin_assign_test_count = mysqli_num_rows($result);

        $topic_simulator_query = "SELECT * FROM self_assessor_test_config WHERE status = 1 AND created_by = '$student_id'";
        $topic_simulator_result = mysqli_query($db, $topic_simulator_query);
        $self_assessor_test_count = mysqli_num_rows($topic_simulator_result);

        $self_assessor_query = "SELECT * FROM topic_simulator_test_config WHERE status = 1 AND created_by = '$student_id'";
        $self_assessor_result = mysqli_query($db, $self_assessor_query);
        $topic_simulator_test_count = mysqli_num_rows($self_assessor_result);

        http_response_code(200);
        echo json_encode(array(
            "admin_assign_test_count" => (int)$admin_assign_test_count,
            "self_assessor_test_count" => (int)$self_assessor_test_count,
            "topic_simulator_test_count" => (int)$topic_simulator_test_count,
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
