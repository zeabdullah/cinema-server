<?php
require '../helpers/cors.php';
require '../helpers/helpers.php';
require '../models/Film.php';


if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    return http_response_code(404);
}

$search = $_GET['search'] ?? '';
$page = (int) $_GET['page'] ?? 1;
$genre = $_GET['genre'] ?? null;

$result = Film::search($search, $page, $genre);

echo json_encode($result);
