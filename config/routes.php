<?php
declare(strict_types=1);

use App\Http\Middleware\BodyParamsMiddleware;
use App\Http\Middleware\DomainExceptionMiddleware;
use App\Http\Middleware\ValidationExceptionMiddleware;
use App\Infrastructure\Framework\MiddlewareCallableAdapter;
use App\Http\Action\Auth\SignIn\SignInController;
use App\Http\Action\Auth\SignUp\SignUpController;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app, ContainerInterface $container) {

    $app->add(new MiddlewareCallableAdapter(BodyParamsMiddleware::class, $container));
    $app->add(new MiddlewareCallableAdapter(DomainExceptionMiddleware::class, $container));
    $app->add(new MiddlewareCallableAdapter(ValidationExceptionMiddleware::class, $container));


    $app->post('/sign-up', [SignUpController::class, 'index']);
    $app->post('/sign-in', [SignInController::class, 'index']);
};
