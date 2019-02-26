<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require '../vendor/autoload.php';
require '../Settings/route/route.php';
require '../Settings/config/config.php';

$app->run();