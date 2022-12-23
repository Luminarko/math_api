<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faze 3</title>
</head>
<body>
    <form method="POST">
        <textarea name="numbers" placeholder="Čísla" required></textarea>
        <br>
        <input type="submit" action="math()">
    </form>
    <br>
</body>
</html>
<?php
include "../math_functions.php";


error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED & ~E_WARNING);

$url = explode("/", filter_input(INPUT_SERVER, 'QUERY_STRING', FILTER_SANITIZE_URL));
$operation = $url[0];

$json_numbers = $_POST['numbers'];
$numbers = explode(",", filter_var($json_numbers, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION|FILTER_FLAG_ALLOW_THOUSAND));

function math($type, $nums){
    date_default_timezone_set('Europe/Prague');
    $result = $type($nums);
    $date = date("Y-M-D h:i:s");
    $data = array("Result" => $result, "Current time" => $date);
    file_put_contents("results.json", json_encode($data));
    echo json_encode($data);
}

math($operation, $numbers);