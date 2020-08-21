<?php

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

// Instantiate PHP-DI ContainerBuilder
$containerBuilder = new ContainerBuilder();

if (false) { // Should be set to true in production
	$containerBuilder->enableCompilation(CONTAINER_CACHE_PATH);
}

// Set up settings
$settings = require __DIR__ . '/settings.php';
$settings($containerBuilder);

// Set up dependencies
$dependencies = require __DIR__ . '/dependencies.php';
$dependencies($containerBuilder);

// Build PHP-DI Container instance
$container = $containerBuilder->build();

// Instantiate the app
AppFactory::setContainer($container);
$app = AppFactory::create();

if (false) { // Should be set to true in production
	$routeCollector = $app->getRouteCollector();
	$routeCollector->setCacheFile(ROUTER_CACHE_PATH);
}

// Register middleware
$middleware = require __DIR__ . '/middleware.php';
$middleware($app);

// Register routes
$routes = require __DIR__ . '/routes.php';
$routes($app);

$app->run();
