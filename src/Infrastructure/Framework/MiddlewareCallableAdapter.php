<?php

namespace App\Infrastructure\Framework;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MiddlewareCallableAdapter
{
    /**
     * @var string
     */
    private $middleware;
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(string $middleware, ContainerInterface $container)
    {
        $this->middleware = $middleware;
        $this->container = $container;
    }

    public function __invoke(RequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        $middleware = $this->container->get($this->middleware);
        return $middleware->process($request, $handler);
        //return new Response();
    }
}