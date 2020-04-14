<?php
	
use Slim\Http\Request;
use Slim\Http\Response;
use Psr\Log\LoggerInterface;

function data_for_product_id($app, $pid) {
	
	$view_data = array ();
	$pdo = $app->pdo;
	
	
	/*************************
	** Get the product info **
	*************************/
	
	$stmt = null;
	$results = null;
	
	$stmt = $pdo->prepare("SELECT * FROM products WHERE pid LIKE :pid");
	$stmt->execute(['pid' => $pid]);
	$results = $stmt->fetch();
	
	$view_data['product_info'] = $results;
	
	// Get the brand name
	
	$stmt = null;
	$results = null;
	
	$stmt = $pdo->prepare("SELECT * FROM brands WHERE brand_id = :brand_id");
	$stmt->execute(['brand_id' => $view_data['product_info']['brand_id']]);
	$brand_info = $stmt->fetch();
	$view_data['product_info']['brand_info'] = $brand_info;
	
	/*******************
	** Get the prices **
	*******************/
	
	$stmt = null;
	$prices = null;
	
	$stmt = $pdo->prepare("SELECT * FROM available_prices WHERE pid = :pid");
	$stmt->execute(['pid' => $pid]);
	$prices = $stmt->fetchAll();
	
	for ($x = 0; $x < count($prices); ++$x) {
		
		// Load up data from the main prices table
		
		$view_data['prices'][$x] = $prices[$x];
		
		// Get the store
		$stmt_inner = null;
		$stmt_inner = $pdo->prepare("SELECT * FROM stores WHERE store_id = :store_id");
		$stmt_inner->execute(['store_id' => $prices[$x]['store_id']]);
		$store_info = $stmt_inner->fetch();
		$view_data['prices'][$x]['store_info'] = $store_info;
		
		// Get the store address
		$stmt_inner = null;
		$stmt_inner = $pdo->prepare("SELECT * FROM addresses WHERE address_id = :address_id");
		$stmt_inner->execute(['address_id' => $view_data['prices'][$x]['store_info']['address_id']]);
		$address = $stmt_inner->fetch();
		$view_data['prices'][$x]['store_info']['address'] = $address;
		
		
	}
	
	
	return $view_data;
	
}
