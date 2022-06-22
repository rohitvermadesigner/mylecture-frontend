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
        $search_group_id = isset($_GET['group']) && !empty($_GET['group']) ? $_GET['group'] : '';
        $search_name = isset($_GET['name']) && !empty($_GET['name']) ? $_GET['name'] : '';
        $page_no = isset($_GET['page_no']) && !empty($_GET['page_no']) ? $_GET['page_no'] : 1;
        $page_count = isset($_GET['page_count']) && !empty($_GET['page_count']) ? $_GET['page_count'] : 10;
        $student_array = array();
        $where_condition = "";
        $where_condition_for_final = "";
        if (!empty($search_name)) {
            $where_condition .= " AND name LIKE '%$search_name%'";
        }
        if (!empty($search_group_id)) {
            $where_condition .= " AND group_id = '$search_group_id'";
        }
        $where_condition_for_final = $where_condition;
        $limit_start_from = 0;
        if ($page_no > 1) {
            $limit_start_from = ($page_no - 1) * $page_count;
        }
        $where_condition_for_final .= " ORDER BY id DESC LIMIT $limit_start_from, $page_count";

        $query_total_students = "SELECT * FROM student_info WHERE status = 1 AND is_otp_verified = 1 $where_condition";
        $result_total_students = mysqli_query($db, $query_total_students);
        $total_students = mysqli_num_rows($result_total_students);

        $query_student_group = "SELECT * FROM student_group";
        $result_student_group = mysqli_query($db, $query_student_group);
        $student_group = array();
        if (mysqli_num_rows($result_student_group) > 0) {
            while ($group_data = mysqli_fetch_assoc($result_student_group)) {
                $group_id = $group_data['id'];
                $student_group[$group_id] = $group_data['name'];
            }
        }

        $query = "SELECT * FROM student_info WHERE status = 1 AND is_otp_verified = 1 $where_condition_for_final";
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($student_data = mysqli_fetch_assoc($result)) {
                $group_id = $student_data['group_id'];
                $student_obj = array(
                    "id" => (int)$student_data['id'],
                    "student_unique_code" => $student_data['student_unique_code'],
                    "name" => htmlspecialchars($student_data['name']),
                    "email_id" => $student_data['email_id'],
                    "mobile_no" => $student_data['mobile_no'],
                    "group" => !empty($group_id) ? $student_group[$group_id] : '',
                    "date_of_registration" => $student_data['date_of_registration'],
                    "last_login_at" => !empty($student_data['last_login_at']) ? $student_data['last_login_at'] : '',
                    "is_online" => $student_data['is_online'] ? true : false,
                );
                array_push($student_array, $student_obj);
            }
        }
        http_response_code(200);
        echo json_encode(array(
            "total_results" => $total_students,
            "result" => $student_array
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
