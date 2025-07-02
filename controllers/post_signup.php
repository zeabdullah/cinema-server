<?php
require '../helpers/cors.php';
require '../helpers/helpers.php';
require '../models/User.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    return http_response_code(404);
}

$json = json_decode(file_get_contents('php://input'));

$requiredProps = ['email', 'password', 'first_name', 'last_name'];

if (!propertiesExist($json, $requiredProps)) {
    echo json_encode([
        'message' => 'Fields [' . implode(', ', $requiredProps) . '] are required'
    ]);
    return http_response_code(400);
}

$user = User::create([
    'email' => sanitize($json->email),
    'first_name' => sanitize($json->first_name),
    'last_name' => sanitize($json->last_name),
    'password' => password_hash($json->password, PASSWORD_BCRYPT),
]);

echo json_encode([
    'message' => 'Created user successfully',
    'data' => $user->toArray(),
]);
http_response_code(201);