<?php

use App\Infrastructure\Framework\Handlers\HttpErrorHandler;
use App\Infrastructure\Framework\ResponseEmitter\ResponseEmitter;
use Slim\Factory\ServerRequestCreatorFactory;

(function() {
    $container = require 'config/container.php';
    $app = \DI\Bridge\Slim\Bridge::create($container);

    //$callableResolver = $app->getCallableResolver();
    $displayErrorDetails = $container->get('settings')['displayErrorDetails'];

    (require 'config/routes.php')($app, $container);

    // Add Routing Middleware
    $app->addRoutingMiddleware();

    // Create Request object from globals
//    $serverRequestCreator = ServerRequestCreatorFactory::create();
//    $request = $serverRequestCreator->createServerRequestFromGlobals();

//    // Create Error Handler
//    $responseFactory = $app->getResponseFactory();
//    $errorHandler = new HttpErrorHandler($callableResolver, $responseFactory);
//
//    // Add Error Middleware
//    $errorMiddleware = $app->addErrorMiddleware($displayErrorDetails, false, false);
//    $errorMiddleware->setDefaultErrorHandler($errorHandler);


    $app->run();
    // Run App & Emit Response
//    $response = $app->handle($request);
//    $responseEmitter = new ResponseEmitter();
//    $responseEmitter->emit($response);
})();
