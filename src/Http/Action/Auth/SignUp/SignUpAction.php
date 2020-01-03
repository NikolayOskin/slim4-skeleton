<?php

namespace App\Http\Action\Auth\SignUp;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class SignUpAction
{
    public function handle(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        var_dump($request->getParsedBody());
        $response->getBody()->write('Hello world!');
        return $response;
    }

    public function action(): ResponseInterface
    {
        var_dump($this->request);
    }
}