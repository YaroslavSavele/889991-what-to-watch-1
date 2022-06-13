<?php

use WTW\services\MovieInfoGetter;
use WTW\services\OmdRepository;

require_once '../../vendor/autoload.php';

$movieRepository = new OmdRepository('tt0106062');
$movieInfoGetter = new MovieInfoGetter();
$info = $movieInfoGetter->getArrayInfo($movieRepository);

echo '<pre>' . print_r($info, true) . '</pre>';
