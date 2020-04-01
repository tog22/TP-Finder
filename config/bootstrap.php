<?php

// PHP-level debug settings
//error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load Composer packages, including Slim
require_once __DIR__ . '/../vendor/autoload.php';

// Instantiate the app
$app = new \Slim\App([
	'debug' => true, 
	'settings' => require __DIR__ . '/../config/settings.php'
]);

// Set up dependencies 
require  __DIR__ . '/container.php'; 
 
// Register middleware 
require __DIR__ . '/middleware.php'; 

// Register routes
require __DIR__ . '/routes.php';

return $app;