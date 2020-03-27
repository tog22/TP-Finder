<?php

require '../vendor/autoload.php';

/** @var Slim\App $app */
$app = require __DIR__ . '/../config/bootstrap.php';

// Start
$app->run();

?>

Hello World