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
    $token_details = validate_admin_faculty_token($post_data->token, $db);
    if ($token_details['status'] == 'success') {
        $admin_id = $token_details['data']['id'];
        $question_id = !empty($post_data->question_id) ? $post_data->question_id : '';

        $question = !empty($post_data->question) ? str_replace('\n', '', mysqli_real_escape_string($db, trim($post_data->question))) : '';
        $option_1 = !empty($post_data->option_1) ? str_replace('\n', '', mysqli_real_escape_string($db, trim($post_data->option_1))) : '';
        $option_2 = !empty($post_data->option_2) ? str_replace('\n', '', mysqli_real_escape_string($db, trim($post_data->option_2))) : '';
        $option_3 = !empty($post_data->option_3) ? str_replace('\n', '', mysqli_real_escape_string($db, trim($post_data->option_3))) : '';
        $option_4 = !empty($post_data->option_4) ? str_replace('\n', '', mysqli_real_escape_string($db, trim($post_data->option_4))) : '';
        $option_5 = !empty($post_data->option_5) ? str_replace('\n', '', mysqli_real_escape_string($db, trim($post_data->option_5))) : '';
        $description = !empty($post_data->description) ? str_replace('\n', '', mysqli_real_escape_string($db, trim($post_data->description))) : '';
        $answer = !empty($post_data->answer) ? $post_data->answer : '';
        $subject_id = !empty($post_data->subject_id) ? $post_data->subject_id : 0;
        $topic_id = !empty($post_data->topic_id) ? $post_data->topic_id : 0;
        $difficulty_level = !empty($post_data->difficulty_level) ? $post_data->difficulty_level : '';
        $current_date = date('Y-m-d H:i:s');

        if (!$question_id || !$question || !$option_1 || !$option_2 || !$answer || !$subject_id) {
            array_push($error_msgs, "Please enter all required fields (question id, question, option 1, option 2, option 3, answer and subject)");
        } else {
            $query = "SELECT * FROM question WHERE id = $question_id AND status = 1";
            $result = mysqli_query($db, $query);
            if (mysqli_num_rows($result) == 0) {
                array_push($error_msgs, "Question id is not valid");
            } else {
                $query = "UPDATE question SET question = '$question', option_1 = '$option_1', 
                option_2 = '$option_2', option_3 = '$option_3', option_4 = '$option_4', 
                option_5 = '$option_5', answer = '$answer', subject_id = '$subject_id', 
                topic_id = '$topic_id', description = '$description', 
                difficulty_level = '$difficulty_level', 
                updated_by = '$admin_id', updated_at = '$current_date' 
                WHERE id = $question_id";
                $result = mysqli_query($db, $query);
                http_response_code(200);
                echo json_encode(array(
                    "message" =>  "question successfully updated",
                ));
            }
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
