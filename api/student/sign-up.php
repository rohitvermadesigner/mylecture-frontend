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
    // make sure data is not empty
    if (
        !empty($post_data->name) && !empty($post_data->email_id) && !empty($post_data->mobile_no) && !empty($post_data->password)
        && !empty($post_data->gender)
    ) {
        if (!validate_mobile($post_data->mobile_no)) {
            array_push($error_msgs, "mobile no is not valid");
        }
        if (!validate_email($post_data->email_id)) {
            array_push($error_msgs, "email id is not valid");
        }
    } else {
        array_push($error_msgs, "name, email_id, mobile_no, password, gender is required");
    }
} else {
    $error_code = 405;
    array_push($error_msgs, "Method Not Allowed");
}

if (count($error_msgs) == 0) {
    // declare variables
    $name = $post_data->name;
    $email_id = $post_data->email_id;
    $mobile_no = $post_data->mobile_no;
    $password = md5($post_data->password);
    $gender = $post_data->gender;
    // query for check if mobile number already exist.
    $query_check_email_id = "SELECT * FROM student_info WHERE email_id = '$email_id' AND is_otp_verified = '1' AND status = 1";
    $result_check_email_id = mysqli_query($db, $query_check_email_id);

    $query_check_mobile_no = "SELECT * FROM student_info WHERE mobile_no = '$mobile_no' AND is_mobile_verified = '1' AND status = 1";
    $result_check_mobile_no = mysqli_query($db, $query_check_mobile_no);

    // check if number of rows is greater than 0
    if (mysqli_num_rows($result_check_email_id) > 0) {
        array_push($error_msgs, "Email id already registered");
    } else if (mysqli_num_rows($result_check_mobile_no) > 0) {
        array_push($error_msgs, "Mobile no already registered");
    } else {
        // 4 digit OTP
        $otp = rand(100000, 999999);
        $current_date = date('Y-m-d H:i:s');
        $date_of_registration = date('Y-m-d');

        $student_unique_code = "STU_00001";
        $query = "SELECT * FROM student_info ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) == 1) {
            $student_data = mysqli_fetch_assoc($result);
            $student_id = (int)$student_data['id'] + 1;
            $student_code = str_pad("$student_id", 5, '0', STR_PAD_LEFT);
            $student_unique_code = "STU_$student_code";
        }

        $query = "INSERT INTO student_info 
        (name, student_unique_code, email_id, mobile_no, password, gender, date_of_registration, otp, created_at, updated_at) 
        VALUES 
        ('$name', '$student_unique_code' ,'$email_id', '$mobile_no','$password', '$gender', '$date_of_registration', '$otp', '$current_date', '$current_date')";
        $result = mysqli_query($db, $query);
        // check if affected rows is greater than 0
        if (mysqli_affected_rows($db) > 0) {
            $inserted_id =  mysqli_insert_id($db);
            $token_info = "student_temp/$inserted_id";
            $token = encrypt_decrypt('encrypt', $token_info);

            //  TODO: change domain name 
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
                "message" => "signup successfully",
                "token" => $token
            ));
        } else {
            array_push($error_msgs, "something went wrong with insert query.");
        }
    }
}

if (count($error_msgs) > 0) {
    // set response code - 400 bad request
    http_response_code($error_code);
    // tell the user
    echo json_encode(array("message" => implode(", ", $error_msgs)));
}
