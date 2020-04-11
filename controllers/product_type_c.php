<?php
	
use Slim\Http\Request;
use Slim\Http\Response;

function data_for_product_type($app, $which_type) {
	
	$view_data = array ();
	$pdo = $app->pdo;
	
	
	/******************************
	** Get the product type info **
    ******************************/
    
    $stmt = $pdo->prepare("SELECT * FROM product_types WHERE url_name LIKE :which_type");
    $stmt->execute(['which_type' => $which_type]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // TO DO: catch case where no such product type
    $product_type = $results[0];
    $view_data['product_type'] = $product_type;
    
    
	/**************************************
	** Get all the products of this type **
    **************************************/
	
    $stmt = null;
    $results = null;
    
    $stmt = $pdo->query("SELECT * FROM products WHERE type_id LIKE '".$product_type['type_id']."'");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // TO DO: work out what to do if there are none - the loop below will just return an empty array, which is not so bad
    
    $view_data['products'] = array();
    for ($x = 0; $x < count($results); ++$x) {
	    
	    // Load up data from the main products table
	    
	    $view_data['products'][$x] = $results[$x];
	    
	    // Get the minimum price
	    
	    $stmt2 = $pdo->query("SELECT MIN(price) FROM available_prices WHERE pid = ".$results[$x]['pid']);
	    $min_price = $stmt2->fetchColumn();
	    $view_data['products'][$x]['min_price'] = '$'.$min_price;
	    
	    // Get the brand name
	    
    }
    
	return $view_data;
	
}
