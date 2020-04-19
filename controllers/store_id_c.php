<?php
	
use Slim\Http\Request;
use Slim\Http\Response;
use Psr\Log\LoggerInterface;

function data_for_store_id($app, $id) {
	
	$view_data = array ();
	$pdo = $app->pdo;
	
	/*************************
	** Get the store info **
	*************************/
	
	$stmt = null;
	$results = null;
	
	$stmt = $pdo->prepare("SELECT * FROM stores WHERE store_id = :id");
	$stmt->execute(['id' => $id]);
	$results = $stmt->fetch();
	$view_data['store_info'] = $results;
	
	
	// Get the store address
	$stmt = null;
	$stmt = $pdo->prepare("SELECT * FROM addresses WHERE address_id = :address_id");
	$stmt->execute(['address_id' => $view_data['store_info']['address_id']]);
	$address = $stmt->fetch();
	$view_data['store_info']['address'] = $address;
	
	return $view_data;
	
}
