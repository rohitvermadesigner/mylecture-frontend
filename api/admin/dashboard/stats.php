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
        $role = $token_details['data']['role'];

        $query_total_questions = "SELECT * FROM question WHERE status = 1";
        $result_total_questions = mysqli_query($db, $query_total_questions);
        $total_questions = mysqli_num_rows($result_total_questions);

        $query_total_students = "SELECT * FROM student_info WHERE status = 1 AND is_otp_verified = 1";
        $result_total_students = mysqli_query($db, $query_total_students);
        $total_students = mysqli_num_rows($result_total_students);

        $query_total_online_students = "SELECT * FROM student_info WHERE status = 1 AND is_online = 1 AND is_otp_verified = 1";
        $result_total_online_students = mysqli_query($db, $query_total_online_students);
        $total_online_students = mysqli_num_rows($result_total_online_students);

        $query_total_test = "SELECT * FROM test_config WHERE status = 1";
        $result_total_test = mysqli_query($db, $query_total_test);
        $total_test = mysqli_num_rows($result_total_test);

        http_response_code(200);

        echo json_encode(array(
            "total_questions" => '29233', // TODO: 
            "total_students" => $total_students,
            "total_online_students" => $total_online_students,
            "total_products" => 0,
            "total_tests" => $total_test,
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
