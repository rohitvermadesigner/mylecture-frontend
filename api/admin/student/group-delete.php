<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // make sure token is not empty
    if (empty($post_data->token)) {
        array_push($error_msgs, "token should not be blank");
    }
    if (empty($post_data->id)) {
        array_push($error_msgs, "group id should not be blank");
    }
} else {
    $error_code = 405;
    array_push($error_msgs, "Method Not Allowed");
}
if (count($error_msgs) == 0) {
    $token_details = validate_admin_token($post_data->token, $db);
    if ($token_details['status'] == 'success') {
        $admin_id = $token_details['data']['id'];
        $group_id = $post_data->id;
        if ($group_id != 1) {
            $query = "SELECT * FROM student_group WHERE id = '$group_id' AND status = 1";
            $result = mysqli_query($db, $query);
            if (mysqli_num_rows($result) > 0) {
                $query = "SELECT * FROM student_info WHERE group_id = '$group_id' AND status = 1";
                $result = mysqli_query($db, $query);
                $totalStudentsCount = mysqli_num_rows($result);
                if ($totalStudentsCount == 0) {

                    // $query = "SELECT * FROM test_config WHERE student_group_id = '$group_id' AND status = 1";
                    // $result = mysqli_query($db, $query);
                    // $totalStudentsCount = mysqli_num_rows($result);


                    $current_date = date('Y-m-d H:i:s');
                    $query = "UPDATE student_group SET status = '0', deleted_at = '$current_date', deleted_by = '$admin_id' WHERE id = $group_id";
                    $result = mysqli_query($db, $query);
                    http_response_code(200);
                    echo json_encode(array(
                        "message" =>  "Successfully deleted",
                    ));
                } else {
                    $error_message = "You can not delete this group because $totalStudentsCount students are associated with this group.";
                    if ($totalStudentsCount == 1) {
                        $error_message = "You can not delete this group because $totalStudentsCount student is associated with this group.";
                    }
                    array_push($error_msgs, $error_message);
                }
            } else {
                array_push($error_msgs, "Group id is not valid");
            }
        } else {
            array_push($error_msgs, "You can not delete default group");
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
