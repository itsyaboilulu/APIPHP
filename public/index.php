<?php
require "../vendor/autoload.php";
use \Slim\App;

require __DIR__ . '/../app/conf/constants.php';
require __DIR__ . '/../app/conf/settings.php';
$app = new App($settings);

$container = $app->getContainer();

// require __DIR__ . '/../app/conf/cors.php';
require __DIR__ . '/../app/conf/dependencies.php';
require __DIR__ . '/../app/conf/router.php';

$app->run();