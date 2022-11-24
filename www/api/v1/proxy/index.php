<?php

ob_start();

$apiKey = 'tt0mQroqDbHU';

$input = file_get_contents('php://input');
$requestData = $input ? json_decode($input, true) : $_REQUEST;


if ($requestData['action'] === 'get' && $requestData['apiKey'] === $apiKey && !empty($requestData['url'])) {
    $result = file_get_contents($requestData['url']);
}

echo $result;
