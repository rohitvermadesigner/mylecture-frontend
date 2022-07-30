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
        $name = !empty($post_data->name) ? $post_data->name : '';
        $group_id = !empty($post_data->group_id) ? $post_data->group_id : '1';
        $email_id = !empty($post_data->email_id) ? $post_data->email_id : '';
        $mobile_no = !empty($post_data->mobile_no) ? $post_data->mobile_no : '';
        $password = rand(100000, 999999);
        $gender = !empty($post_data->gender) ? $post_data->gender : '';
        $date_of_birth = !empty($post_data->date_of_birth) ? $post_data->date_of_birth : '';
        $date_of_registration = date('Y-m-d');
        $address = !empty($post_data->address) ? $post_data->address : '';
        $state = !empty($post_data->state) ? $post_data->state : '';
        $city = !empty($post_data->city) ? $post_data->city : '';
        $country = !empty($post_data->country) ? $post_data->country : '';
        $pincode = !empty($post_data->pincode) ? $post_data->pincode : '';
        if (!empty($name) && !empty($email_id) && !empty($mobile_no)) {
            if (validate_email($email_id)) {
                if (validate_mobile($mobile_no)) {
                    $query = "SELECT * FROM student_info WHERE email_id = '$email_id' AND is_otp_verified = 1 and status = 1";
                    $result = mysqli_query($db, $query);
                    if (mysqli_num_rows($result) > 0) {
                        http_response_code(400);
                        echo json_encode(array(
                            "message" => "Student email id already exist",
                        ));
                        exit;
                    } else {
                        $current_date = date('Y-m-d H:i:s');

                        $student_unique_code = "STU_00001";
                        $query = "SELECT * FROM student_info ORDER BY id DESC LIMIT 1";
                        $result = mysqli_query($db, $query);
                        if (mysqli_num_rows($result) == 1) {
                            $student_data = mysqli_fetch_assoc($result);
                            $student_id = (int)$student_data['id'] + 1;
                            $student_code = str_pad("$student_id", 5, '0', STR_PAD_LEFT);
                            $student_unique_code = "STU_$student_code";
                        }

                        msg91_otp_email_send("studentReg", $email_id, $name, array(
                            "student_name" => $name,
                            "student_unique_code" => $student_unique_code,
                            "email_id" => $email_id,
                            "password" => $password,
                        ));

                        msg91_otp_email_send("studentReg", $admin_email, "Admin", array(
                            "student_name" => $name,
                            "student_unique_code" => $student_unique_code,
                            "email_id" => $email_id,
                            "password" => $password,
                        ));

                        $encrpted_password = md5($password);
                        $query = "INSERT INTO student_info 
                                    (group_id, student_unique_code, name, email_id, mobile_no, password, gender, date_of_birth, date_of_registration, address, state, city, country, pincode, is_otp_verified, created_by, created_at) 
                                    VALUES 
                                    ('$group_id', '$student_unique_code', '$name', '$email_id', '$mobile_no', '$encrpted_password', '$gender', '$date_of_birth', '$date_of_registration', '$address', '$state', '$city', '$country', '$pincode', '1', '$admin_id', '$current_date' )";
                        $result = mysqli_query($db, $query);
                        if (mysqli_affected_rows($db) > 0) {
                            $inserted_id = mysqli_insert_id($db);
                            http_response_code(200);
                            echo json_encode(array(
                                "message" =>  "Student successfully added",
                                "id" => (int)$inserted_id
                            ));
                        } else {
                            array_push($error_msgs, "something went wrong with insert query.");
                        }
                    }
                } else {
                    array_push($error_msgs, "Please enter valid Mobile Number");
                }
            } else {
                array_push($error_msgs, "Please enter valid Email Id");
            }
        } else {
            array_push($error_msgs, "student name, email id and mobile number should not be empty.");
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
