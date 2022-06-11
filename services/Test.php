<?php

namespace services;

use GuzzleHttp\Client;

require_once __DIR__ . '/RemoteRepository.php';
require_once __DIR__ . '/../vendor/autoload.php';

$client = new Client(['base_uri' => 'http://www.omdbapi.com']);
$apikey = '287ffaab';
$imdbId = 'tt3896198';

$repository = new RemoteRepository($client);
$movie = $repository->getMovie($imdbId, $apikey);
$arrayMovie = (array)$movie;

echo '<pre>' . print_r($arrayMovie, true) . '</pre>';
