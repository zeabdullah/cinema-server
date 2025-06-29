<?php
require '../helpers/cors.php';
require '../helpers/helpers.php';
require '../models/User.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    return http_response_code(404);
}

$json = json_decode(file_get_contents('php://input'));

if (!propertiesExist($json, ['email', 'password', 'first_name', 'last_name'])) {
    echo json_encode([
        'message' => 'Fields `email`, `password`, `first_name`, and `last_name` are required'
    ]);
    return http_response_code(400);
}

$user = User::create([
    'email' => sanitize($json->email),
    'first_name' => sanitize($json->first_name),
    'last_name' => sanitize($json->last_name),
    'password' => $json->password,
]);

echo json_encode([
    'message' => 'Created user successfully',
    'data' => $user->toArray(),
]);
http_response_code(201);