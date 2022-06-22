<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// include database and object files
include_once '../../config/core.php';
include_once '../../config/database.php';
include_once '../../shared/utilities.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

$error_msgs = array();
$error_code = 400;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // make sure token is not empty
    if (isset($_GET['token'])) {
        if (empty($_GET['token'])) {
            array_push($error_msgs, "token should not be blank");
        }
    } else {
        array_push($error_msgs, "token should not be blank");
    }

    if (isset($_GET['test_id'])) {
        if (empty($_GET['test_id'])) {
            array_push($error_msgs, "test_id should not be blank");
        }
    } else {
        array_push($error_msgs, "test_id should not be blank");
    }
} else {
    $error_code = 405;
    array_push($error_msgs, "Method Not Allowed");
}

if (count($error_msgs) == 0) {
    $token_details = validate_admin_faculty_token($_GET['token'], $db);
    if ($token_details['status'] == 'success') {
        $admin_id = $token_details['data']['id'];
        $role = $token_details['data']['role'];
        $test_id = $_GET['test_id'];

        $test_config_info = array();
        $query_test_category = "SELECT * FROM test_category";
        $result_test_category = mysqli_query($db, $query_test_category);
        $test_categories = array();
        if (mysqli_num_rows($result_test_category) > 0) {
            while ($test_category_data = mysqli_fetch_assoc($result_test_category)) {
                $test_category_id = $test_category_data['id'];
                $test_categories[$test_category_id] = $test_category_data['name'];
            }
        }

        $query_test_instruction = "SELECT * FROM test_instruction";
        $result_test_instruction = mysqli_query($db, $query_test_instruction);
        $test_instructions = array();
        if (mysqli_num_rows($result_test_instruction) > 0) {
            while ($test_instruction_data = mysqli_fetch_assoc($result_test_instruction)) {
                $test_instruction_id = $test_instruction_data['id'];
                $test_instructions[$test_instruction_id] = $test_instruction_data['name'];
            }
        }

        $query_subject = "SELECT * FROM subject";
        $result_subject = mysqli_query($db, $query_subject);
        $subjects = array();
        if (mysqli_num_rows($result_subject) > 0) {
            while ($subject_data = mysqli_fetch_assoc($result_subject)) {
                $subject_id = $subject_data['id'];
                $subjects[$subject_id] = $subject_data['name'];
            }
        }

        $query_student_group = "SELECT * FROM student_group";
        $result_student_group = mysqli_query($db, $query_student_group);
        $student_groups = array();
        if (mysqli_num_rows($result_student_group) > 0) {
            while ($student_group_data = mysqli_fetch_assoc($result_student_group)) {
                $student_group_id = $student_group_data['id'];
                $student_groups[$student_group_id] = $student_group_data['name'];
            }
        }

        $query = "SELECT * FROM test_config WHERE status = 1 AND id = '$test_id'";
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) > 0) {
            $question_data = mysqli_fetch_assoc($result);
            $category_id = $question_data['category_id'];
            $instruction_id = $question_data['instruction_id'];

            $student_group_ids = explode(",", $question_data['student_group_id']);
            $test_config_student_groups = array();
            foreach ($student_group_ids as $student_group_id) {
                if (isset($student_groups[$student_group_id])) {
                    array_push($test_config_student_groups, array("id" => $student_group_id, "name" => $student_groups[$student_group_id]));
                }
            }

            $test_config_info = array(
                "id" => (int)$question_data['id'],
                "name" => $question_data['name'],
                "student_group" => $test_config_student_groups,
                "category" => array(
                    "id" => !empty($category_id) ? (int)$category_id : '',
                    "name" => !empty($category_id) ? $test_categories[$category_id] : '',
                ),
                "instruction" => array(
                    "id" => !empty($instruction_id) ? (int)$instruction_id : '',
                    "name" => !empty($instruction_id) ? $test_instructions[$instruction_id] : '',
                ),
                "duration" => $question_data['duration'],
                "difficulty_level" => $question_data['difficulty_level'],
                "total_questions" => $question_data['total_question'],
                "is_question_random_order" => $question_data['is_question_random_order'],
                "is_report_show" => $question_data['is_report_show'],
                "is_mandatory_all_question" => $question_data['is_mandatory_all_question'],
                "is_publish" => !empty($question_data['is_publish']) ? true : false,
                "test_start_at" => !empty($question_data['test_start_at']) ? $question_data['test_start_at'] : "",
                "test_end_at" => !empty($question_data['test_end_at']) ? $question_data['test_end_at'] : "",
                "created_at" => $question_data['created_at'],
                "questions" => array()
            );
        }

        $questions_id_array = array();
        $questions_id_with_marks = array();
        $test_question_query = "SELECT * FROM test_question WHERE test_id = '$test_id'";
        $test_question_result = mysqli_query($db, $test_question_query);
        if (mysqli_num_rows($test_question_result) > 0) {
            while ($question_row =  mysqli_fetch_assoc($test_question_result)) {
                $question_id = $question_row['question_id'];
                $marks = $question_row['marks'];
                array_push($questions_id_array, $question_id);
                $questions_id_with_marks[$question_id] = $marks;
            }
        }

        $questions_ids = implode(", ", $questions_id_array);
        if (count($questions_id_array) > 0) {
            $question_query = "SELECT * FROM question WHERE id IN ($questions_ids)";
            $question_result = mysqli_query($db, $question_query);
            if (mysqli_num_rows($question_result) > 0) {
                while ($question_data =  mysqli_fetch_assoc($question_result)) {
                    $subject_id = $question_data['subject_id'];
                    $question_obj = array(
                        "id" => (int)$question_data['id'],
                        "question" => $question_data['question'],
                        "option_1" => $question_data['option_1'],
                        "option_2" => $question_data['option_2'],
                        "option_3" => $question_data['option_3'],
                        "option_4" => $question_data['option_4'],
                        "option_5" => $question_data['option_5'],
                        "answer" => $question_data['answer'],
                        "subject" => $subject_id && isset($subjects[$subject_id]) ? $subjects[$subject_id] : '',
                        "difficulty_level" => $question_data['difficulty_level'],
                        "marks" => isset($questions_id_with_marks[$question_data['id']]) ? $questions_id_with_marks[$question_data['id']] : ''
                    );
                    array_push($test_config_info['questions'], $question_obj);
                }
            }
        }

        http_response_code(200);
        echo json_encode($test_config_info);
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
