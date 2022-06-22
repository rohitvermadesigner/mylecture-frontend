<?php

function validate_mobile($mobile)
{
    return preg_match('/^[0-9]{10}+$/', $mobile);
}

function validate_email($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function encrypt_decrypt($action, $string)
{
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'myLecture#8010';
    $secret_iv = 'myLecture#9311';
    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if ($action == 'decrypt') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}

function validate_admin_faculty_token($token, $db)
{
    $token_info = explode("/", encrypt_decrypt('decrypt', $token));
    if (count($token_info) == 2) {
        $category = $token_info[0];
        $id = $token_info[1];
        if ($category == 'admin') {
            $query = "SELECT * FROM admin_info WHERE id = $id AND status = 1";
            $result = mysqli_query($db, $query);
            $user_data = mysqli_fetch_assoc($result);
            if (mysqli_num_rows($result) == 1) {
                return array(
                    "status" => "success",
                    "data" => array(
                        "id" => $id,
                        "role" => $user_data['role'],
                    )
                );
            } else {
                return array("status" => "error", "message" => "user is not valid");
            }
        } else {
            return array("status" => "error", "message" => "user is not valid");
        }
    } else {
        return array("status" => "error", "message" => "token is not valid");
    }
}


function validate_admin_token($token, $db)
{
    $token_info = explode("/", encrypt_decrypt('decrypt', $token));
    if (count($token_info) == 2) {
        $category = $token_info[0];
        $id = $token_info[1];
        if ($category == 'admin') {
            $query = "SELECT * FROM admin_info WHERE id = $id AND role = 'admin' AND status = 1";
            $result = mysqli_query($db, $query);
            if (mysqli_num_rows($result) == 1) {
                return array("status" => "success", "data" => array("id" => $id));
            } else {
                return array("status" => "error", "message" => "user is not valid");
            }
        } else {
            return array("status" => "error", "message" => "user is not valid");
        }
    } else {
        return array("status" => "error", "message" => "token is not valid");
    }
}

function validate_student_token($token, $db)
{
    $token_info = explode("/", encrypt_decrypt('decrypt', $token));
    if (count($token_info) == 2) {
        $category = $token_info[0];
        $id = $token_info[1];
        if ($category == 'student') {
            $query = "SELECT * FROM student_info WHERE id = $id AND status = 1";
            $result = mysqli_query($db, $query);
            if (mysqli_num_rows($result) == 1) {
                $student_data = mysqli_fetch_assoc($result);
                return array("status" => "success", "data" => array(
                    "id" => $id,
                    "group_id" => $student_data['group_id'],
                    "name" => $student_data['name']
                ));
            } else {
                return array("status" => "error", "message" => "user is not valid");
            }
        } else {
            return array("status" => "error", "message" => "user is not valid");
        }
    } else {
        return array("status" => "error", "message" => "token is not valid");
    }
}

function email_send($to_email, $body, $subject)
{
    $from = 'gemsnext2022@gmail.com';
    $fromName = 'GEMS Next';
    // Set content-type for sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // Additional headers
    $headers .= "From: $fromName<$from>" . "\r\n";

    // Send email
    if (mail($to_email, $subject, $body, $headers)) {
        return true;
    }
    return false;
}

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function convertAnswer($db)
{
    $query = "SELECT * FROM question";
    $result = mysqli_query($db, $query);
    $total_questions = mysqli_num_rows($result);
    $question_arr = array();
    if ($total_questions > 0) {
        $affected_rows = 0;
        while ($question_data = mysqli_fetch_assoc($result)) {
            $question_id = $question_data['id'];
            $answer = $question_data['answer'];
            $option_1 = $question_data['option_1'];
            $option_2 = $question_data['option_2'];
            $option_3 = $question_data['option_3'];
            $option_4 = $question_data['option_4'];
            $option_5 = $question_data['option_5'];
            $correct_answer = 0;
            if ($question_id != 1) {
                if (trim($option_1) == trim($answer)) {
                    $correct_answer = 1;
                } else if (trim($option_2) == trim($answer)) {
                    $correct_answer = 2;
                } else if (trim($option_3) == trim($answer)) {
                    $correct_answer = 3;
                } else if (trim($option_4) == trim($answer)) {
                    $correct_answer = 4;
                } else if (trim($option_5) == trim($answer)) {
                    $correct_answer = 5;
                }
                if ($correct_answer > 0) {
                    $update_query = "UPDATE question SET answer = '$correct_answer' WHERE id = '$question_id'";
                    mysqli_query($db, $update_query);
                    $affected_rows +=  mysqli_affected_rows($db);
                } else {
                    array_push($question_arr, $question_id);
                }
            }
        }
        echo $affected_rows;
        echo "\n\n";
        print_r($question_arr);
    }
}
