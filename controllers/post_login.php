<?php
require '../helpers/cors.php';
require '../helpers/helpers.php';
require '../models/User.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    return http_response_code(404);
}

$json = getRequestBodyAsJson();

if (!propertiesExist($json, ['email', 'password'])) {
    echo json_encode([
        "message" => "`email` and `password` are required"
    ]);
    return http_response_code(400);
}

if (!User::auth($json->email, $json->password)) {
    echo json_encode([
        "message" => "Invalid login credentials"
    ]);
    return http_response_code(400);
}

echo json_encode([
    "message" => "Login success!"
]);
