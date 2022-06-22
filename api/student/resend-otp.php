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
    if (empty($post_data->token)) {
        array_push($error_msgs, "token should not be blank.");
    }
} else {
    $error_code = 405;
    array_push($error_msgs, "Method Not Allowed");
}

if (count($error_msgs) == 0) {
    $token = $post_data->token;
    $token_info = explode("/", encrypt_decrypt('decrypt', $token));
    if (count($token_info) == 2) {
        $category = $token_info[0];
        $student_id = $token_info[1];
        $table_name = "student_info";
        $query = "SELECT * FROM $table_name WHERE id = $student_id AND status = 1";
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) == 1) {
            $data = mysqli_fetch_assoc($result);
            //send otp
            $otp = rand(100000, 999999);
            $email_id = $data['email_id'];
            $name = $data['name'];
            $current_date = date('Y-m-d H:i:s');
            $query = "UPDATE $table_name SET OTP = '$otp', updated_at = '$current_date' WHERE id = $student_id";
            $result = mysqli_query($db, $query);
            // check if affected rows is greater than 0
            if (mysqli_affected_rows($db) > 0) {
                // send otp via third party service.
                $url = "https://gemsnext.com/api/student/verify-email.php?token=$token&otp=$otp";
                $email_body = "Hello $name,<br><br>
                Your One Time Password(OTP) is : <span style='font-size:20px'><b>$otp</b></span>
                <br><br>
                You can click below button to verify your email id.
                <br><br>
                <a href='$url'>
                    <button style='font-size: 16px;background-color: #007bff;padding: 10px 30px;color: #fff;border: 0;border-radius: 25px;cursor: pointer;'>Verify Email Id</button>
                </a>
                <br><br>
                Do not share your OTP with anyone including your Depository Participant (DP).
                <br>
                For any OTP related query please email us at info@gemsnext.com
                <br><br>
                Warm Regards,
                <br>
                The GEMS Next Team";

                $email_subject = "GEMS Next OTP for Student Registraion";
                $email_send = email_send($email_id, $email_body, $email_subject);

                $admin_email_subject = "GEMS Next OTP for Student Registraion | $name";
                email_send($admin_email, $email_body, $admin_email_subject);

                http_response_code(200);
                echo json_encode(array(
                    "message" => "otp successfully sent"
                ));
            } else {
                array_push($error_msgs, "something went wrong with update query.");
            }
        } else {
            $error_code = 401;
            array_push($error_msgs, "student is not valid.");
        }
        // $category = $token_info[0];
        // $student_id = $token_info[1];
        // if ($category == 'student_temp') {
        //     $query = "SELECT * FROM student_info WHERE id = $student_id AND status = 1";
        //     $result = mysqli_query($db, $query);
        //     if (mysqli_num_rows($result) == 1) {
        //         $data = mysqli_fetch_assoc($result);
        //         if ($data['otp'] == $otp) {
        //             $current_date = date('Y-m-d H:i:s');
        //             $query = "UPDATE student_info SET is_otp_verified = '1', updated_at = '$current_date' WHERE id = $student_id";
        //             $result = mysqli_query($db, $query);
        //             $token_info = "student/$student_id";
        //             $token = encrypt_decrypt('encrypt', $token_info);
        //             http_response_code(200);
        //             echo json_encode(array(
        //                 "message" => "otp verified",
        //                 "token" => $token
        //             ));
        //             $email_id = $data['email_id'];
        //             $query = "DELETE FROM student_info WHERE email_id = '$email_id' AND id != $student_id";
        //             mysqli_query($db, $query);
        //         } else {
        //             array_push($error_msgs, "otp is not correct.");
        //         }
        //     } else {
        //         $error_code = 401;
        //         array_push($error_msgs, "user is not valid.");
        //     }
        // } else {
        //     $is_error = true;
        //     array_push($error_msgs, "token is not valid.");
        // }
    } else {
        array_push($error_msgs, "token is not valid.");
    }
}


if (count($error_msgs) > 0) {
    // set response code - 400 bad request
    http_response_code($error_code);
    // tell the user
    echo json_encode(array("message" => implode(", ", $error_msgs)));
}
