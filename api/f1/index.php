<?php
include "../math_functions.php";

error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED & ~E_WARNING);

$operation = filter_input(INPUT_GET, 'operation', FILTER_SANITIZE_SPECIAL_CHARS);
$numbers = explode(",", filter_input(INPUT_GET,'nums', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION|FILTER_FLAG_ALLOW_THOUSAND|FILTER_FLAG_ALLOW_SCIENTIFIC));

foreach ($numbers as $key => $value) {
    if (!strlen($value)) {
       unset($numbers[$key]);
    }
}
$numbers = array_values($numbers);

$result = $operation($numbers);
$json = json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
$data = array(
    "operation" => "$operation",
    "result" => "$json",
);

file_put_contents("results.json", json_encode($data));
echo json_encode($data);