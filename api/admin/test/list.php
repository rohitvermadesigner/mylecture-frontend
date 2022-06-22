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
        $search_test_name = isset($_GET['test_name']) && !empty($_GET['test_name']) ? $_GET['test_name'] : '';
        $search_difficulty_level = isset($_GET['difficulty_level']) && !empty($_GET['difficulty_level']) ? $_GET['difficulty_level'] : '';
        $search_test_category = isset($_GET['test_category']) && !empty($_GET['test_category']) ? $_GET['test_category'] : '';
        $search_student_group_id = isset($_GET['student_group_id']) && !empty($_GET['student_group_id']) ? $_GET['student_group_id'] : '';
        $page_no = isset($_GET['page_no']) && !empty($_GET['page_no']) ? $_GET['page_no'] : 1;
        $page_count = isset($_GET['page_count']) && !empty($_GET['page_count']) ? $_GET['page_count'] : 10;
        $test_result_array = array();
        $where_condition = "";
        $where_condition_for_final = "";
        if (!empty($search_test_name)) {
            $where_condition .= " AND name LIKE '%$search_test_name%'";
        }
        if (!empty($search_difficulty_level)) {
            $where_condition .= " AND difficulty_level = '$search_difficulty_level'";
        }
        if (!empty($search_test_category)) {
            $where_condition .= " AND category_id = '$search_test_category'";
        }
        if (!empty($search_student_group_id)) {
            $where_condition .= " AND student_group_id = '$search_student_group_id'";
        }
        $where_condition_for_final = $where_condition;
        $limit_start_from = 0;
        if ($page_no > 1) {
            $limit_start_from = ($page_no - 1) * $page_count;
        }
        $where_condition_for_final .= " ORDER BY id DESC LIMIT $limit_start_from, $page_count";

        $query_total_questions = "SELECT id FROM test_config WHERE status = 1 $where_condition";
        if ($role == 'faculty') {
            $query_total_questions = "SELECT id FROM test_config WHERE status = 1 AND created_by = $admin_id $where_condition";
        }
        $result_total_questions = mysqli_query($db, $query_total_questions);
        $total_questions = mysqli_num_rows($result_total_questions);

        $query_test_category = "SELECT * FROM test_category WHERE status = 1";
        $result_test_category = mysqli_query($db, $query_test_category);
        $test_categories = array();
        if (mysqli_num_rows($result_test_category) > 0) {
            while ($test_category_data = mysqli_fetch_assoc($result_test_category)) {
                $test_category_id = $test_category_data['id'];
                $test_categories[$test_category_id] = $test_category_data['name'];
            }
        }

        $query_student_group = "SELECT * FROM student_group";
        $result_student_group = mysqli_query($db, $query_student_group);
        $student_groups = array();
        if (mysqli_num_rows($result_student_group) > 0) {
            while ($student_group_data = mysqli_fetch_assoc($result_student_group)) {
                $student_group_id = $student_group_data['id'];
                $student_groups[$student_group_id] = $student_group_data['name'];
            }
        }

        $query = "SELECT * FROM test_config WHERE status = 1 $where_condition_for_final";
        if ($role == 'faculty') {
            $query = "SELECT * FROM test_config WHERE status = 1 AND created_by = $admin_id $where_condition_for_final";
        }
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($question_data = mysqli_fetch_assoc($result)) {
                $category_id = $question_data['category_id'];
                $student_group_ids = explode(",", $question_data['student_group_id']);
                $test_config_student_groups = array();
                foreach ($student_group_ids as $student_group_id) {
                    if (isset($student_groups[$student_group_id])) {
                        array_push($test_config_student_groups, $student_groups[$student_group_id]);
                    }
                }
                $test_obj = array(
                    "id" => (int)$question_data['id'],
                    "name" => $question_data['name'],
                    "total_questions" => $question_data['total_question'],
                    "difficulty_level" => $question_data['difficulty_level'],
                    "category" => !empty($category_id) ? $test_categories[$category_id] : '',
                    "student_group" => !empty($student_group_id) ? implode(", ", $test_config_student_groups) : '',
                    "is_publish" => !empty($question_data['is_publish']) ? true : false,
                    "created_at" => $question_data['created_at'],
                );
                array_push($test_result_array, $test_obj);
            }
        }
        http_response_code(200);
        echo json_encode(array(
            "total_results" => $total_questions,
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
