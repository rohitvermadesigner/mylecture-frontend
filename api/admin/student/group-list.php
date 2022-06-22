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
    $token_details = validate_admin_token($_GET['token'], $db);
    if ($token_details['status'] == 'success') {
        $admin_id = $token_details['data']['id'];

        $student_query = "SELECT id, group_id FROM student_info WHERE status = 1 AND is_otp_verified = 1";
        $student_result = mysqli_query($db, $student_query);
        $students = array();
        if (mysqli_num_rows($student_result) > 0) {
            while ($student_data = mysqli_fetch_assoc($student_result)) {
                $group_id = $student_data['group_id'];
                if (array_key_exists($group_id, $students)) {
                    $students[$group_id]  = $students[$group_id] + 1;
                } else {
                    $students[$group_id]  = 1;
                }
            }
        }

        $query = "SELECT * FROM student_group WHERE status = 1";
        $result = mysqli_query($db, $query);
        $groups = array();
        if (mysqli_num_rows($result) > 0) {
            while ($group_data = mysqli_fetch_assoc($result)) {
                $group_id = $group_data['id'];
                $group_obj = array(
                    "id" => (int)$group_id,
                    "name" => htmlspecialchars($group_data['name']),
                    "description" => htmlspecialchars($group_data['description']),
                    "no_of_students" => !empty($group_id) && isset($students[$group_id]) ? $students[$group_id] : 0
                );
                array_push($groups, $group_obj);
            }
        }
        http_response_code(200);
        echo json_encode(array(
            "result" => $groups,
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
