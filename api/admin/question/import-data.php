<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
ini_set("post_max_size", "100M");
ini_set("upload_max_filesize", "100M");
ini_set("memory_limit", "20000M");

// include database and object files
include_once '../../config/core.php';
include_once '../../config/database.php';
include_once '../../shared/utilities.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// get posted data
$error_msgs = array();
$error_code = 400;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // make sure token is not empty
    if (isset($_POST['token'])) {
        if (empty($_POST['token'])) {
            array_push($error_msgs, "token should not be blank");
        }
    } else {
        array_push($error_msgs, "token required");
    }
} else {
    $error_code = 405;
    array_push($error_msgs, "Method Not Allowed");
}

if (count($error_msgs) == 0) {
    $token_details = validate_admin_token($_POST['token'], $db);
    if ($token_details['status'] == 'success') {
        $admin_id = $token_details['data']['id'];
        if (isset($_FILES["file"]) && !empty($_FILES['file']['tmp_name'])) {
            $ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
            if ($ext == 'csv') {
                $tempname = $_FILES["file"]["tmp_name"];
                $filename = $_FILES["file"]["name"];
                $file = fopen($tempname, "r");
                $row = 1;
                $question_no = 1;
                $subject_name = "";
                $inserted_rows_count = 0;
                $failed_rows_count = 0;
                $total_rows = 0;
                $error_rows = array();
                while (($fileData = fgetcsv($file, 100000, ",")) !== FALSE) {
                    if ($row == 1) {
                        $subject_name = $fileData[0];
                    }
                    if ($row > 3) {
                        $chapter_name = str_replace('\n', '', mysqli_real_escape_string($db, trim($fileData[2])));
                        $topic = str_replace('\n', '', mysqli_real_escape_string($db, trim($fileData[3])));
                        $subTopic = str_replace('\n', '', mysqli_real_escape_string($db, trim($fileData[4])));
                        $question = str_replace('\n', '', mysqli_real_escape_string($db, trim($fileData[6])));
                        $option_1 = str_replace('\n', '', mysqli_real_escape_string($db, trim($fileData[7])));
                        $option_2 = str_replace('\n', '', mysqli_real_escape_string($db, trim($fileData[8])));
                        $option_3 = str_replace('\n', '', mysqli_real_escape_string($db, trim($fileData[9])));
                        $option_4 = str_replace('\n', '', mysqli_real_escape_string($db, trim($fileData[10])));
                        $option_5 = str_replace('\n', '', mysqli_real_escape_string($db, trim($fileData[11])));
                        $answer = str_replace('\n', '', mysqli_real_escape_string($db, trim($fileData[12])));
                        $description = str_replace('\n', '', mysqli_real_escape_string($db, trim($fileData[13])));
                        $difficulty_level = "normal";
                        if ($question) {
                            if (!empty($subject_name)) {
                                $subject_insert = check_subject_and_insert($subject_name, $admin_id, $db);
                                if ($subject_insert["status"] == "success") {
                                    $subject_id = $subject_insert["id"];
                                    // check if answer should be exist in options.
                                    $correct_answer = 1;
                                    $answer = substr(trim($answer), 0, 1);
                                    if (str_contains(strtolower($answer), strtolower('a'))) {
                                        $correct_answer = 1;
                                    } else if (str_contains(strtolower($answer), strtolower('b'))) {
                                        $correct_answer = 2;
                                    } else if (str_contains(strtolower($answer), strtolower('c'))) {
                                        $correct_answer = 3;
                                    } else if (str_contains(strtolower($answer), strtolower('d'))) {
                                        $correct_answer = 4;
                                    } else if (str_contains(strtolower($answer), strtolower('e'))) {
                                        $correct_answer = 5;
                                    }

                                    // if (str_contains(strtolower($answer), strtolower($option_1))) {
                                    //     $correct_answer = 1;
                                    // } else if (str_contains(strtolower($answer), strtolower($option_2))) {
                                    //     $correct_answer = 2;
                                    // } else if (str_contains(strtolower($answer), strtolower($option_3))) {
                                    //     $correct_answer = 3;
                                    // } else if (str_contains(strtolower($answer), strtolower($option_4))) {
                                    //     $correct_answer = 4;
                                    // } else if (str_contains(strtolower($answer), strtolower($option_5))) {
                                    //     $correct_answer = 5;
                                    // }
                                    $current_date = date('Y-m-d H:i:s');
                                    $query = "INSERT INTO question (question, option_1, option_2, option_3, option_4, option_5, answer, subject_id, description, difficulty_level, created_by, created_at) 
                                            VALUES 
                                            ('$question', '$option_1', '$option_2', '$option_3', '$option_4', '$option_5', '$correct_answer', '$subject_id', '$description', '$difficulty_level', '$admin_id', '$current_date')";
                                    $result = mysqli_query($db, $query);
                                    if (mysqli_affected_rows($db) > 0) {
                                        $question_inserted_id = mysqli_insert_id($db);
                                        $inserted_rows_count++;
                                    } else {
                                        $failed_rows_count++;
                                        array_push($error_rows, "Question No. $question_no fail to insert because something went wrong with question insert query. [" . $query . "]");
                                    }
                                } else {
                                    $failed_rows_count++;
                                    $error_msg = $subject_insert['message'];
                                    array_push($error_rows, "Question No. $question_no fail to insert because " . $error_msg);
                                }
                            } else {
                                $failed_rows_count++;
                                $error_msg = "Subject Name empty";
                                array_push($error_rows, "Question No. $question_no fail to insert because " . $error_msg);
                            }
                            $question_no++;
                            $total_rows++;
                        }
                    }
                    $row++;
                }
                fclose($file);
                http_response_code(200);
                echo json_encode(array(
                    "total_rows" => $total_rows,
                    "inserted_rows" =>  $inserted_rows_count,
                    "failed_rows" => $failed_rows_count,
                    "fail_errors" => $error_rows
                ));
            } else {
                array_push($error_msgs, "uploaded file should be csv");
            }
        } else {
            array_push($error_msgs, "please select csv file");
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


function check_subject_and_insert($subject_name, $admin_id, $db)
{
    $query = "SELECT * FROM subject WHERE name = '$subject_name' AND status = 1";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        return array(
            "status" => 'success',
            "id" => (int)$data['id']
        );
        exit;
    } else {
        $current_date = date('Y-m-d H:i:s');
        $query = "INSERT INTO subject (name, phase_id, created_by, created_at) VALUES ('$subject_name', '3', '$admin_id', '$current_date')";
        $result = mysqli_query($db, $query);
        if (mysqli_affected_rows($db) > 0) {
            $inserted_id = mysqli_insert_id($db);
            return array(
                "status" => 'success',
                "id" => (int)$inserted_id
            );
        } else {
            return array("status" => "failed", "message" => "something went wrong with subject insert query.");
        }
    }
}

function check_chapter_and_insert($chapter_name, $subject_id, $admin_id, $db)
{
    $query = "SELECT * FROM chapter WHERE name = '$chapter_name' AND subject_id = '$subject_id' AND status = 1";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        return array(
            "status" => 'success',
            "id" => (int)$data['id']
        );
        exit;
    } else {
        $current_date = date('Y-m-d H:i:s');
        $query = "INSERT INTO chapter (name, subject_id, created_by, created_at) 
                            VALUES 
                            ('$chapter_name', '$subject_id', '$admin_id','$current_date')";
        $result = mysqli_query($db, $query);
        if (mysqli_affected_rows($db) > 0) {
            $inserted_id = mysqli_insert_id($db);
            return array(
                "status" => 'success',
                "id" => (int)$inserted_id
            );
        } else {
            return array("status" => "failed", "message" => "something went wrong with chapter insert query.");
        }
    }
}
