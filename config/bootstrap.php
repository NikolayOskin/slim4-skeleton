<?php

use App\Application\ResponseEmitter\ResponseEmitter;
use Slim\Factory\ServerRequestCreatorFactory;

(function() {
    $container = require 'config/container.php';
    $app = \DI\Bridge\Slim\Bridge::create($container);

    $callableResolver = $app->getCallableResolver();

    (require 'config/middleware.php')($app);
    (require 'config/routes.php')($app);

    // Add Routing Middleware
    $app->addRoutingMiddleware();

    // Create Request object from globals
    $serverRequestCreator = ServerRequestCreatorFactory::create();
    $request = $serverRequestCreator->createServerRequestFromGlobals();

    // Run App & Emit Response
    $response = $app->handle($request);
    $responseEmitter = new ResponseEmitter();
    $responseEmitter->emit($response);
})();
