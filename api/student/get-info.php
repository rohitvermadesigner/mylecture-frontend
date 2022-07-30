<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// include database and object files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../shared/utilities.php';

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

        $query = "SELECT * FROM student_info WHERE id = '$student_id'";
        $result = mysqli_query($db, $query);
        $student_info = mysqli_fetch_assoc($result);

        http_response_code(200);
        echo json_encode(array(
            "name" => $student_info['name'],
            "email_id" => $student_info['email_id'],
            "mobile_no" => $student_info['mobile_no'],
            "student_unique_code" => $student_info['student_unique_code'],
            "group_id" => (int)$student_info['group_id'],
            "gender" => $student_info['gender'],
            "date_of_birth" => !empty($student_info['date_of_birth']) ? $student_info['date_of_birth'] : '',
            "date_of_registration" => $student_info['date_of_registration'],
            "address" => $student_info['address'],
            "state" => $student_info['state'],
            "city" => $student_info['city'],
            "country" => $student_info['country'],
            "pincode" => $student_info['pincode'],
            "profile_picture" => $student_info['profile_picture'],
            "id_proof" => $student_info['id_proof'],
            "is_mobile_verified" => $student_info['is_mobile_verified']
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
