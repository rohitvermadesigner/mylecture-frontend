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

            $file = fopen('./csv/Updated questions 1-5000 by Dr keshav.csv', "r");
            $csvData = array();
            while (($fileData = fgetcsv($file, 100000, ",")) !== FALSE) {
                $lineArr = array();
                $question = trim($fileData[3]);
                $comma = "";
                if (strpos($question, '(') !== false) {
                    if (substr($question, -1) == ')') {
                        $fix_question = trim(substr($question, 0, strrpos($question, '(')));
                        $fix_question = substr($fix_question, -1) == '-' ? trim(substr($question, 0, strrpos($question, '-'))) : $fix_question;
                        echo '<tr>
                                <th scope="row">' . $fileData[0] . '</th>
                                <td>' . $question . '</td>
                                <td>' . $fix_question . '</td>
                            </tr>';
                    } else {
                        $fix_question = $question;
                    }
                } else {
                    $fix_question = $question;
                }
                $fix_question = str_replace(",", "", $fix_question);

                array_push($lineArr, str_replace(",", "", $fileData[0]));
                array_push($lineArr, str_replace(",", "", $fileData[1]));
                array_push($lineArr, str_replace(",", "", $fileData[2]));
                array_push($lineArr, $fix_question);
                array_push($lineArr, str_replace(",", "", $fileData[4]));
                array_push($lineArr, str_replace(",", "", $fileData[5]));
                array_push($lineArr, str_replace(",", "", $fileData[6]));
                array_push($lineArr, str_replace(",", "", $fileData[7]));
                array_push($lineArr, str_replace(",", "", $fileData[8]));
                array_push($lineArr, str_replace(",", "", $fileData[9]));
                array_push($lineArr, str_replace(",", "", $fileData[10]));
                $line = implode(',', $lineArr);
                array_push($csvData, $line);
            }
            fclose($file);


            // header('Content-Type: text/csv');
            // header('Content-Disposition: attachment; filename="fix Updated questions 5001-10000 by Dr Keshav.csv"');

            // $fp = fopen('php://output', 'wb');
            // foreach ($csvData as $line) {
            //     $val = explode(",", $line);
            //     fputcsv($fp, $val);
            // }
            // fclose($fp);
            ?>
        </tbody>
    </table>
</body>

</html>
</body>

</html>