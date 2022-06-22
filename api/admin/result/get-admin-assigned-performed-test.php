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
    $token_details = validate_admin_faculty_token($_GET['token'], $db);
    if ($token_details['status'] == 'success') {
        $admin_id = $token_details['data']['id'];
        $role = $token_details['data']['role'];
        $current_date = date('Y-m-d H:i:s');

        $query_test_category = "SELECT * FROM test_category WHERE status = 1";
        $result_test_category = mysqli_query($db, $query_test_category);
        $test_categories = array();
        if (mysqli_num_rows($result_test_category) > 0) {
            while ($test_category_data = mysqli_fetch_assoc($result_test_category)) {
                $test_category_id = $test_category_data['id'];
                $test_categories[$test_category_id] = $test_category_data['name'];
            }
        }

        $query_student_group = "SELECT * FROM student_group WHERE status = 1";
        $result_student_group = mysqli_query($db, $query_student_group);
        $student_groups = array();
        if (mysqli_num_rows($result_student_group) > 0) {
            while ($student_group_data = mysqli_fetch_assoc($result_student_group)) {
                $student_group_id = $student_group_data['id'];
                $student_groups[$student_group_id] = $student_group_data['name'];
            }
        }

        $test_array = array();
        $query = "SELECT * FROM test_config WHERE status = 1  ORDER BY created_at DESC";
        if ($role == 'faculty') {
            $query = "SELECT * FROM test_config WHERE status = 1 AND created_by = $admin_id ORDER BY created_at DESC";
        }
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($question_data = mysqli_fetch_assoc($result)) {
                $student_group_ids = explode(",", $question_data['student_group_id']);
                $test_config_student_groups = array();
                foreach ($student_group_ids as $student_group_id) {
                    if (isset($student_groups[$student_group_id])) {
                        array_push($test_config_student_groups, $student_groups[$student_group_id]);
                    }
                }

                $category_id = $question_data['category_id'];
                $question_id = $question_data['id'];
                $test_array[$question_id] = array(
                    "id" => (int)$question_data['id'],
                    "name" => $question_data['name'],
                    "duration" => $question_data['duration'],
                    "category" => !empty($category_id) ? $test_categories[$category_id] : '',
                    "student_group" => !empty($student_group_id) ? implode(", ", $test_config_student_groups) : '',
                    "total_questions" => (int)$question_data['total_question'],
                    "created_at" => $question_data['created_at']
                );
            }
        }

        $test_result_array = array();
        $query_test_result = "SELECT DISTINCT(test_id) FROM test_result ORDER BY id DESC";
        $result_test_result = mysqli_query($db, $query_test_result);
        $total_test_count = mysqli_num_rows($result_test_result);
        $test_results = array();
        if (mysqli_num_rows($result_test_result) > 0) {
            while ($test_result_data = mysqli_fetch_assoc($result_test_result)) {
                $test_id = $test_result_data['test_id'];
                if (isset($test_array[$test_id])) {
                    array_push($test_result_array, $test_array[$test_id]);
                }
            }
        }

        http_response_code(200);
        echo json_encode(array(
            "total_results" => $total_test_count,
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
