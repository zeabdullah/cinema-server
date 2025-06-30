<?php
require '../helpers/cors.php';
require '../helpers/helpers.php';
require '../models/Film.php';


if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    return http_response_code(404);
}

if (!isset($_GET['id'])) {
    echo json_encode([
        'message' => "param 'id' is required"
    ]);

    return http_response_code(400);
}

$id = $_GET['id'];

$film = Film::findById($id);

if ($film) {
    echo json_encode($film->toArray());
} else {
    echo json_encode([
        'message' => "No film found with ID '$id'"
    ]);
}
