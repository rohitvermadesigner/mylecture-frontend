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
} else {
    $error_code = 405;
    array_push($error_msgs, "Method Not Allowed");
}

if (count($error_msgs) == 0) {
    $token_details = validate_admin_token($post_data->token, $db);
    if ($token_details['status'] == 'success') {
        $admin_id = $token_details['data']['id'];
        if (!empty($post_data->name) && !empty($post_data->id)) {
            $topic_id = $post_data->id;
            $topic_name = $post_data->name;
            $query = "SELECT * FROM topic WHERE id = $topic_id AND status = 1";
            $result = mysqli_query($db, $query);
            if (mysqli_num_rows($result) == 0) {
                array_push($error_msgs, "Topic id not valid");
            } else {
                $topic_data = mysqli_fetch_assoc($result);
                $subject_id = $topic_data['subject_id'];
                $query = "SELECT * FROM topic WHERE name = '$topic_name' AND subject_id = '$subject_id' AND id != '$topic_id' AND status = 1";
                $result = mysqli_query($db, $query);
                if (mysqli_num_rows($result) > 0) {
                    array_push($error_msgs, "Topic name already exist");
                } else {
                    $current_date = date('Y-m-d H:i:s');
                    $query = "UPDATE topic SET name = '$topic_name', updated_at = '$current_date', updated_by = '$admin_id' WHERE id = $topic_id";
                    $result = mysqli_query($db, $query);
                    http_response_code(200);
                    echo json_encode(array(
                        "message" =>  "Topic name successfully updated",
                    ));
                }
            }
        } else {
            array_push($error_msgs, "Topic name and Topic id should not be empty.");
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
