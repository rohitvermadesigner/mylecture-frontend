<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// include database and object files
include_once '../../../config/core.php';
include_once '../../../config/database.php';
include_once '../../../shared/utilities.php';

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

        $query = "SELECT * FROM test_instruction WHERE status = 1 ORDER BY id DESC";
        $result = mysqli_query($db, $query);
        $instructions = array();
        if (mysqli_num_rows($result) > 0) {
            while ($instruction_data = mysqli_fetch_assoc($result)) {
                $instruction_obj = array(
                    "id" => (int)$instruction_data['id'],
                    "name" => $instruction_data['name'],
                    "detail" => $instruction_data['detail']
                );
                array_push($instructions, $instruction_obj);
            }
        }
        http_response_code(200);
        echo json_encode(array(
            "result" => $instructions,
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
