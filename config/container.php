<?php

use Slim\Container;

/** @var \Slim\App $app */
$container = $app->getContainer();

// Activating routes in a subfolder
$container['environment'] = function () {
    $scriptName = $_SERVER['SCRIPT_NAME'];
    $_SERVER['SCRIPT_NAME'] = dirname(dirname($scriptName)) . '/' . basename($scriptName);
    return new Slim\Http\Environment($_SERVER);
};


/**********************
* DATABASE CONNECTION *
**********************/

// - Add a container entry for the PDO connection

$container['pdo'] = function (Container $container) {
    $settings = $container->get('settings');
    
    $host = $settings['db']['host'];
    $dbname = $settings['db']['database'];
    $username = $settings['db']['username'];
    $password = $settings['db']['password'];
    $charset = $settings['db']['charset'];
    $collate = $settings['db']['collation'];
    
    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
    
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_PERSISTENT => false,
        PDO::ATTR_EMULATE_PREPARES => true,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $charset COLLATE $collate"
    ];

    return new PDO($dsn, $username, $password, $options);
};

/*
* Alternative setup from official Slim tutorial:

$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};
*/



/*************************************
* ADD CAKEPHP'S DATABASE ABSTRACTION *
*************************************/

/*
use Cake\Database\Connection;
use Cake\Database\Driver\Mysql;

$container[Connection::class] = function (Container $container) {
    $settings = $container->get('settings');
    $driver = new Mysql($settings['db']);

    return new Connection(['driver' => $driver]);
};

$container[PDO::class] = function (Container $container) {
    // @var Connection $connection
    $connection = $container->get(Connection::class);
    $connection->getDriver()->connect();

    return $connection->getDriver()->getConnection();
};
*/



/****************
* ADD TWIG-VIEW *
****************/

/*
use Slim\Views\Twig;

// Register Twig View helper
$container[Twig::class] = function (Container $container) {
    $settings = $container->get('settings');
    $viewPath = $settings['twig']['path'];

    $twig = new Twig($viewPath, [
        'cache' => $settings['twig']['cache_enabled'] ? $settings['twig']['cache_path'] : false
    ]);

    // @var Twig_Loader_Filesystem $loader
    $loader = $twig->getLoader();
    $loader->addPath($settings['public'], 'public');

    // Instantiate and add Slim specific extension
    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment($container->get('environment'));
    $twig->addExtension(new \Slim\Views\TwigExtension($router, $uri));

    return $twig;
};
*/



/*********************
* ADD A LOGGER ENTRY *
**********************/

use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

$container[LoggerInterface::class] = function (Container $container) {
    $settings = $container->get('settings')['logger'];
    $level = isset($settings['level']) ?: Logger::ERROR;
    $logFile = $settings['file'];

    $logger = new Logger($settings['name']);
    $handler = new RotatingFileHandler($logFile, 0, $level, true, 0775);
    $formatter = new Monolog\Formatter\LineFormatter(
	    null, // Format of message in log, default [%datetime%] %channel%.%level_name%: %message% %context% %extra%\n
	    null, // Datetime format
	    true, // allowInlineLineBreaks option, default false
	    true  // ignoreEmptyContextAndExtra option, default false
	);
	$handler->setFormatter($formatter);
    $logger->pushHandler($handler);

    return $logger;
};


/* Example of logging which works in the app:

use Psr\Log\LoggerInterface;
    
$logger = $app->get(LoggerInterface::class);
$logger->error(print_r($rows, true));

*/