<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
    <title>Fixed questions</title>
</head>

<body>
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Previous Question</th>
                <th scope="col">Updated Question</th>
            </tr>
        </thead>
        <tbody>
            <?php

            // include database and object files
            include_once '../config/core.php';
            include_once '../config/database.php';
            include_once '../shared/utilities.php';

            // instantiate database and product object
            $database = new Database();
            $db = $database->getConnection();
            if (isset($_GET['subject_id']) && $_GET['subject_id'] != '') {
                $subject_id = $_GET['subject_id'];
                $query = "SELECT * FROM question WHERE status = 1 AND subject_id = '$subject_id'";
                $result = mysqli_query($db, $query);
                $question_array = array();
                if (mysqli_num_rows($result) > 0) {
                    echo '<tr><th colspan="3">Total Results : ' . mysqli_num_rows($result) . '</th></tr>';
                    while ($question_data = mysqli_fetch_assoc($result)) {
                        $question = trim($question_data['question']);
                        $question_id = (int)$question_data['id'];
                        $fix_question = trim(substr($question, 0, strrpos($question, '(')));
                        $fix_question = substr($fix_question, -1) == '-' ? trim(substr($question, 0, strrpos($question, '-'))) : $fix_question;
                        if (strpos($question, '(') !== false) {
                            if (substr($question, -1) == ')') {
                                echo '<tr>
                                        <th scope="row">' . $question_id . '</th>
                                        <td>' . $question . '</td>
                                        <td>' . $fix_question . '</td>
                                    </tr>';
                            }
                        }
                    }
                }
            }
            ?>
        </tbody>
    </table>
</body>

</html>
</body>

</html>