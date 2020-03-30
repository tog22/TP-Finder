<?php
	
use Cake\Database\Connection;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

use Psr\Log\LoggerInterface;

function view_data_for_home($app) {
	
	/*
	$view_data = array (
    	'product_types' => array(
	    	'Loo roll',
	    	'Tissues'
    	)	
	);
	*/
	
	$query = $app->get(Connection::class)->newQuery();
	$query = $query->select('*')->from('product_types');
    $rows = $query->execute()->fetchAll('assoc') ?: [];
    
    /*
	// Example of logging
	    
    $logger = $app->get(LoggerInterface::class);
    $logger->error(print_r($rows, true));
    */
    
	return $rows;
	
}
