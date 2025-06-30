<?php
require '../helpers/cors.php';
require '../helpers/helpers.php';
require '../models/Film.php';


if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    return http_response_code(404);
}

$films = Film::getAll();
$filmsArr = array_map(fn(Film $film) => $film->toArray(), $films);

echo json_encode($filmsArr);
