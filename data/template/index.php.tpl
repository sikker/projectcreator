<?php

require __DIR__.'/vendor/autoload.php';

use Sikker\Phinatra\Request;
use Sikker\Phinatra\Response;
use Sikker\Phinatra\Router\Router;
use Sikker\Phinatra\Router\RouterException;
use Sikker\Phinatra\Router\Route;
use Sikker\Phinatra\Router\Path;

$path = new Path();
$router = new Router($path);

$router->attach(new Route('/', function(Request $request, Response $response){
	$response->setOutput('Hello, world! Welcome to the %PACKAGE% application!');
	return $response;
}));

try {
	$response = $router->route(new Request($path), new Response());
} catch (RouterException $e) {
	$response = new Response();
	$response->setStatusCode(404);
	$response->setOutput( $e->getMessage() );
}

$response->handle();