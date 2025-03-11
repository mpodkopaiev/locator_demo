<?php

	spl_autoload_register(function ($class) {
		$route = explode("\\", $class)[1];
		$route = './src/'. $route. '.php';
		include_once $route;
	});

	$destination = filter_input(INPUT_GET, 'destination');
	$radius = filter_input(INPUT_GET, 'radius', FILTER_VALIDATE_FLOAT);

	if (empty($destination) || empty($radius)) {
		throw Error ('Ivalid parameters provided. Please double-check destination and radius parameters.');
	}

	try {
		$result = Demo\Locator::locate($destination, $radius);
	} catch (Exception $e) {
		/*
		 * Processing for the original exception here, we`ll hide the exception message from our final user
		 */
		throw Error ('Something went wrong.');
	}

	header('Content-Type: application/json');
	echo $result;
