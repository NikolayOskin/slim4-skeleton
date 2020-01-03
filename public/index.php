<?php
declare(strict_types=1);

use App\Application\ResponseEmitter\ResponseEmitter;
use Slim\Factory\AppFactory;
use Slim\Factory\ServerRequestCreatorFactory;

$container = require __DIR__ . '/../config/bootstrap.php';

AppFactory::setContainer($container);
$app = AppFactory::create();
//$callableResolver = $app->getCallableResolver();

(require __DIR__ . '/../config/middleware.php')($app);
(require __DIR__ . '/../config/routes.php')($app);

// Add Routing Middleware
$app->addRoutingMiddleware();

// Create Request object from globals
$serverRequestCreator = ServerRequestCreatorFactory::create();
$request = $serverRequestCreator->createServerRequestFromGlobals();

// Run App & Emit Response
$response = $app->handle($request);
$responseEmitter = new ResponseEmitter();
$responseEmitter->emit($response);
