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
        $search_name = isset($_GET['name']) && !empty($_GET['name']) ? $_GET['name'] : '';
        $search_unique_code = isset($_GET['unique_code']) && !empty($_GET['unique_code']) ? $_GET['unique_code'] : '';
        $search_email_id = isset($_GET['email_id']) && !empty($_GET['email_id']) ? $_GET['email_id'] : '';
        $search_mobile_number = isset($_GET['mobile_number']) && !empty($_GET['mobile_number']) ? $_GET['mobile_number'] : '';
        $search_subject_id = isset($_GET['subject_id']) && !empty($_GET['subject_id']) ? $_GET['subject_id'] : '';
        $page_no = isset($_GET['page_no']) && !empty($_GET['page_no']) ? $_GET['page_no'] : 1;
        $page_count = isset($_GET['page_count']) && !empty($_GET['page_count']) ? $_GET['page_count'] : 10;
        $where_condition = "";
        $where_condition_for_final = "";
        if (!empty($search_name)) {
            $where_condition .= " AND name LIKE '%$search_name%'";
        }
        if (!empty($search_unique_code)) {
            $where_condition .= " AND unique_code LIKE '%$search_unique_code%'";
        }
        if (!empty($search_email_id)) {
            $where_condition .= " AND email_id LIKE '%$search_email_id%'";
        }
        if (!empty($search_mobile_number)) {
            $where_condition .= " AND mobile_no LIKE '%$search_mobile_number%'";
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

        $query_total_faculty = "SELECT * FROM admin_info WHERE status = 1 AND role = 'faculty' $where_condition";
        $result_total_faculty = mysqli_query($db, $query_total_faculty);
        $total_faculty_count = mysqli_num_rows($result_total_faculty);



        $query_subjects = "SELECT * FROM subject";
        $result_subjects = mysqli_query($db, $query_subjects);
        $subjects = array();
        if (mysqli_num_rows($result_subjects) > 0) {
            while ($subject_data = mysqli_fetch_assoc($result_subjects)) {
                $subject_id = $subject_data['id'];
                $subjects[$subject_id] = $subject_data['name'];
            }
        }


        $query = "SELECT * FROM admin_info WHERE status = 1 AND role = 'faculty' $where_condition_for_final";
        $result = mysqli_query($db, $query);
        $faculty_array = array();
        if (mysqli_num_rows($result) > 0) {
            while ($faculty_data = mysqli_fetch_assoc($result)) {
                $subject_id = $faculty_data['subject_id'];
                $faculty_obj = array(
                    "id" => (int)$faculty_data['id'],
                    "unique_code" => $faculty_data['unique_code'],
                    "name" => $faculty_data['name'],
                    "email_id" => $faculty_data['email_id'],
                    "subject" => !empty($subject_id) ? $subjects[$subject_id] : '',
                    "mobile_no" => !empty($faculty_data['mobile_no']) ? $faculty_data['mobile_no'] : '',
                    "created_at" => $faculty_data['created_at'],
                    "last_login_at" => !empty($faculty_data['last_login_at']) ? $faculty_data['last_login_at'] : '',
                );
                array_push($faculty_array, $faculty_obj);
            }
        }
        http_response_code(200);
        echo json_encode(array(
            "total_results" => $total_faculty_count,
            "result" => $faculty_array
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
