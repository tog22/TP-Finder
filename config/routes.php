<?php

/********************
*                   *
*   PACKAGES USED   *
*                   *
********************/

// Core Slim request & response packages

use Slim\Http\Request;
use Slim\Http\Response;

// is this needed????
use Slim\Container;

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



/******************
*                 *
*   /product/id   *
*                 *
******************/

$app->get('/product/{pid}', function (Request $request, Response $response) {
    
    include '../controllers/product_id_c.php';
    $view_data = data_for_product_id($this, $request->getAttribute('pid'));
    
    $renderer = new PhpRenderer('../templates/');
    return $renderer->render($response, "product_id_v.php", $view_data);

    return $response;
});



/****************
*               *
*   /store/id   *
*               *
****************/

$app->get('/store/{id}', function (Request $request, Response $response) {
    
    include '../controllers/store_id_c.php';
    $view_data = data_for_store_id($this, $request->getAttribute('id'));
    
    $renderer = new PhpRenderer('../templates/');
    return $renderer->render($response, "store_id_v.php", $view_data);

    return $response;
});



/*******************
*                  *
*   /logger-test   *
*                  *
*******************/

$app->get('/logger-test', function (Request $request, Response $response) {
    /** @var Container $this */
    /** @var LoggerInterface $logger */

    $logger = $this->get(LoggerInterface::class);
    $logger->error('My error message!');

    $response->getBody()->write("Success");

    return $response;
});