<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// include database and object files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../shared/utilities.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// get posted data
$post_data = json_decode(file_get_contents("php://input"));
$error_msgs = array();
$error_code = 400;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // make sure post data is not empty
    if (empty($post_data->email_id)) {
        array_push($error_msgs, "Email id should not be blank");
    } else {
        if (!validate_email($post_data->email_id)) {
            array_push($error_msgs, "Please enter valid email id");
        }
    }
} else {
    $error_code = 405;
    array_push($error_msgs, "Method Not Allowed");
}

if (count($error_msgs) == 0) {
    $email_id = trim($post_data->email_id);
    $current_date = date('Y-m-d H:i:s');
    $query = "SELECT * FROM student_info WHERE email_id = '$email_id' AND status = 1";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        $student_id = $data['id'];
        $name = $data['name'];
        $token_info = "student-generate-password/$student_id";
        $token = encrypt_decrypt('encrypt', $token_info);


        //  TODO: change domain name 
        $url = "https://www.gemsnext.com/api/student/generate-password.php?token=$token";
        $email_body = "Hello $name,<br><br>
        
        Click below button to generate your password.
        <br><br>
        <a href='$url'>
            <button style='font-size: 16px;background-color: #007bff;padding: 10px 30px;color: #fff;border: 0;border-radius: 25px;cursor: pointer;'>Generate Password</button>
        </a>
        <br><br>
        If you are facing any type of issue, please email us at info@gemsnext.com
        <br><br>
        Warm Regards,
        <br>
        The GEMS Next Team";

        $email_subject = "GEMS Next Forgot Password";
        $email_send = email_send($email_id, $email_body, $email_subject);

        $admin_email_subject = "GEMS Next Student Forgot Password | $name";
        email_send($admin_email, $email_body, $admin_email_subject);

        http_response_code(200);
        echo json_encode(array(
            "message" => "Email sent to you email id.",
        ));
    } else {
        array_push($error_msgs, "Entered email id is not registered");
    }
}


if (count($error_msgs) > 0) {
    // set response code - 400 bad request
    http_response_code($error_code);
    // tell the user
    echo json_encode(array("message" => implode(", ", $error_msgs)));
}
