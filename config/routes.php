<?php

use Slim\Http\Request;
use Slim\Http\Response;

use Slim\Views\Twig;

/****************
*               *
*  HOME PAGE    *
*               *
****************/

$app->get('/', function (Request $request, Response $response) {
    
    require '../controllers/home.php';
    
    $view_data = view_data_for_home($this);
    
    return $this->get(Twig::class)->render($response, 'home.twig', $view_data);
});


/******************
*                 *
*  /hello/name    *
*                 *
******************/

$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});


/**********
*         *
*  /time  *
*         *
**********/

$app->get('/time', function (Request $request, Response $response) {
    $viewData = [
        'now' => date('Y-m-d H:i:s')
    ];

    return $this->get(Twig::class)->render($response, 'time.twig', $viewData);
});


/*****************
*                *
*  /logger-test  *
*                *
*****************/

use Psr\Log\LoggerInterface;
use Slim\Container;

$app->get('/logger-test', function (Request $request, Response $response) {
    /** @var Container $this */
    /** @var LoggerInterface $logger */

    $logger = $this->get(LoggerInterface::class);
    $logger->error('My error message!');

    $response->getBody()->write("Success");

    return $response;
});