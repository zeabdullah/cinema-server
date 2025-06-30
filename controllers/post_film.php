<?php
require '../helpers/cors.php';
require '../helpers/helpers.php';
require '../models/Film.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    return http_response_code(404);
}

$json = getRequestBodyAsJson();

$requiredProps = [
    'title' => true,
    'genre' => true,
    'release_year' => true,
    'duration' => true,
];
$allowedProps = [
    ...$requiredProps,
    'description' => true,
    'trailer_url' => true,
];

$requiredKeys = array_keys($requiredProps);

if (!propertiesExist($json, $requiredKeys)) {
    echo json_encode([
        'message' => 'Fields [' . implode(', ', $requiredKeys) . '] are required'
    ]);
    return http_response_code(400);
}

$jsonAssoc = get_object_vars($json);
$jsonAssocSanitized = array_map(fn(string $k, $v) => [$k => sanitize($v)], array_keys($jsonAssoc), array_values($jsonAssoc));

$newFilm = Film::create(array_intersect_key($jsonAssoc, $allowedProps));

echo json_encode([
    'message' => 'Film created successfully!',
    'data' => $newFilm->toArray()
]);
