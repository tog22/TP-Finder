<?php

/********************
*                   *
*   PACKAGES USED   *
*                   *
********************/

// Core Slim request & response packages

use Slim\Http\Request;
use Slim\Http\Response;

// PHP-View for templates

use Slim\Views\PhpRenderer;

//  MonoLog for logging

use Psr\Log\LoggerInterface;

/****************
*               *
*   HOME PAGE   *
*               *
****************/

$app->get('/', function (Request $request, Response $response) {
    
    include '../controllers/home_c.php';
    $view_data = data_for_home($this);
    
    /*
	Example of logging:
	
	$logger = $this->get(LoggerInterface::class);
    $logger->error(print_r($view_data, true));
    */
    
    $renderer = new PhpRenderer('../templates/');
    return $renderer->render($response, "home_v.php", $view_data);

    return $response;
});



/***************************
*                          *
*   /prices/product_type   *
*                          *
***************************/

$app->get('/prices/{product_type}', function (Request $request, Response $response) {
    
    include '../controllers/product_type_c.php';
    $view_data = data_for_product_type($this, $request->getAttribute('product_type'));
    
    $renderer = new PhpRenderer('../templates/');
    return $renderer->render($response, "product_type_v.php", $view_data);

    return $response;
});



/*******************
*                  *
*   /logger-test   *
*                  *
*******************/

use Slim\Container;

$app->get('/logger-test', function (Request $request, Response $response) {
    /** @var Container $this */
    /** @var LoggerInterface $logger */

    $logger = $this->get(LoggerInterface::class);
    $logger->error('My error message!');

    $response->getBody()->write("Success");

    return $response;
});