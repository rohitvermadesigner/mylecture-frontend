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
                if ($_GET['type'] == 'topic-simulator' || $_GET['type'] == 'self-assessor' || $_GET['type'] == 'admin-assigned') {
                    $test_result_table = "";
                    $test_result_array = array();
                    if ($_GET['type'] == 'topic-simulator') {
                        $test_config_table = "topic_simulator_test_config";
                        $test_result_table = "topic_simulator_test_result";
                    } else if ($_GET['type'] == 'self-assessor') {
                        $test_result_table = "self_assessor_test_result";
                        $test_config_table = "self_assessor_test_config";
                    } else if ($_GET['type'] == 'admin-assigned') {
                        $test_result_table = "test_result";
                        $test_config_table = "test_config";
                    }

                    $query = "SELECT * FROM $test_config_table WHERE id = $test_id";
                    $result = mysqli_query($db, $query);
                    $test_config_data = mysqli_fetch_assoc($result);
                    $test_name = $test_config_data['name'];

                    $query = "SELECT * FROM $test_result_table 
                                WHERE test_id = '$test_id' AND 
                                student_id = '$student_id' 
                                ORDER BY created_at DESC";

                    $result = mysqli_query($db, $query);
                    $total_result_count = mysqli_num_rows($result);
                    if (mysqli_num_rows($result) > 0) {
                        while ($result_data = mysqli_fetch_assoc($result)) {
                            $test_obj = array(
                                "id" => (int)$result_data['id'],
                                "total_questions" => (int)$result_data['total_questions'],
                                "attempt_questions" => (int)$result_data['attempt_questions'],
                                "correct_questions" => (int)$result_data['correct_questions'],
                                "total_marks" => (int)$result_data['total_marks'],
                                "obtain_marks" => (int)$result_data['obtain_marks'],
                                "obtain_percentage" => (int)$result_data['obtain_percentage'],
                                "created_at" => $result_data['created_at'],
                            );
                            array_push($test_result_array, $test_obj);
                        }
                    }
                    http_response_code(200);
                    echo json_encode(array(
                        "total_results" => $total_result_count,
                        "test_name" => $test_name,
                        "result" => $test_result_array
                    ));
                } else {
                    array_push($error_msgs, "Test should be 'topic-simulator' of 'self-assessor'");
                }
            } else {
                array_push($error_msgs, "Test type required");
            }
        } else {
            array_push($error_msgs, "Test id required");
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
