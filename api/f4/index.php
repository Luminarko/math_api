<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faze 4</title>
</head>
<body>
    <form method="POST">
        <textarea name="data" placeholder="Uživatel/Heslo/Čísla/Datum/Podpis" required></textarea>
        <br>
        <input type="submit" action="math()">
    </form>
    <br>
</body>
</html>
<?php
include "../math_functions.php";

error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED & ~E_WARNING);

date_default_timezone_set('Europe/Prague');

$url = explode("/", filter_input(INPUT_SERVER, 'QUERY_STRING', FILTER_SANITIZE_URL));
$operation = $url[0];

$json_input = json_decode(filter_input(INPUT_POST, 'data'),true);
$id = $json_input["id"];
$passw = hash("sha256",$json_input["passw"]);
$numbers = explode(",", $json_input["numbers"]);
$dttm = $json_input["dttm"];

$sign_dats = implode("",array($id, $passw, $dttm, implode("", $numbers)));

function math($type, $nums){
    $result = $type($nums);
    return $result;
}
function signature($signature){
    $signature = hash("sha256", $signature);
    return $signature;
}

$result = math($operation, $numbers);
$signature = signature($sign_dats);


$json_data = array( "user" => $id, "password" => $passw ,"numbers" => implode(",", $numbers), "date" => $dttm ,"result" => $result, "signature" => $signature);
file_put_contents("result.json", json_encode($json_data));
echo json_encode($json_data);