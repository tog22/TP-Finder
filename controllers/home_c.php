<?php
	
use Cake\Database\Connection;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

function view_data_for_home($app) {
	
	$view_data = array ();
	
	// Get all the product types
	$query = $app->get(Connection::class)->newQuery();
	$query = $query->select('*')->from('product_types');
    $product_types = $query->execute()->fetchAll('assoc') ?: [];
    $view_data['product_types'] = $product_types;
    
	return $view_data;
	
}
