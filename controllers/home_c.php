<?php
	
use Slim\Http\Request;
use Slim\Http\Response;

function data_for_home($app) {
	
	$view_data = array ();
	
	// Get all the product types
	
	/* 
	* CakePHP DAL version:
	
	$query = $app->get(Connection::class)->newQuery();
	$query = $query->select('*')->from('product_types');
    $product_types = $query->execute()->fetchAll('assoc') ?: [];
    $view_data['product_types'] = $product_types;
    */
    
    // PDO version:
    
    
	$pdo = $app->pdo;
    
    $stmt = $pdo->query('SELECT * FROM product_types');
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $product_types = $results;
    $view_data['product_types'] = $product_types;
    
	return $view_data;
	
}
