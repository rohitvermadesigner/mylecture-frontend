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
        array_push($error_msgs, "student id should not be blank");
    }
} else {
    $error_code = 405;
    array_push($error_msgs, "Method Not Allowed");
}
if (count($error_msgs) == 0) {
    $token_details = validate_admin_faculty_token($post_data->token, $db);
    if ($token_details['status'] == 'success') {
        $admin_id = $token_details['data']['id'];
        $student_id = $post_data->id;
        $query = "SELECT * FROM student_info WHERE id = '$student_id' AND status = 1";
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) > 0) {
            $current_date = date('Y-m-d H:i:s');
            $query = "UPDATE student_info SET status = '0', deleted_at = '$current_date' WHERE id = $student_id";
            $result = mysqli_query($db, $query);

            // self assessor delete all data ..
            $query = "DELETE FROM self_assessor_test_config WHERE created_by = $student_id";
            $result = mysqli_query($db, $query);

            $query = "DELETE FROM self_assessor_test_question WHERE created_by = $student_id";
            $result = mysqli_query($db, $query);

            $query = "DELETE self_assessor_test_result, self_assessor_test_result_detail 
            FROM self_assessor_test_result 
            INNER JOIN self_assessor_test_result_detail 
            ON self_assessor_test_result.id = self_assessor_test_result_detail.test_result_id
            WHERE self_assessor_test_result.student_id = $student_id;";
            $result = mysqli_query($db, $query);
            // self assessor delete all data ..


            // topic simulator delete all data..
            $query = "DELETE FROM topic_simulator_test_config WHERE created_by = $student_id";
            $result = mysqli_query($db, $query);

            $query = "DELETE FROM topic_simulator_test_question WHERE created_by = $student_id";
            $result = mysqli_query($db, $query);


            $query = "DELETE topic_simulator_test_result, topic_simulator_test_result_detail 
            FROM topic_simulator_test_result 
            INNER JOIN topic_simulator_test_result_detail 
            ON topic_simulator_test_result.id = topic_simulator_test_result_detail.test_result_id
            WHERE topic_simulator_test_result.student_id = $student_id;";
            $result = mysqli_query($db, $query);
            // topic simulator delete all data..

            http_response_code(200);
            echo json_encode(array(
                "message" =>  "Successfully deleted",
            ));
        } else {
            array_push($error_msgs, "Student id is not valid");
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
