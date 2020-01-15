<?php

namespace App\Http\Action\Auth\SignUp;

use App\Http\ValidationException;
use App\Http\Validator\Validator;
use App\Models\User\UseCase\SignUp\SignUpHandler;
use App\Models\User\UseCase\SignUp\SignUpCommand;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class SignUpController
{
    /**
     * @var SignUpHandler
     */
    private $handler;
    /**
     * @var Validator
     */
    private $validator;

    public function __construct(SignUpHandler $handler, Validator $validator)
    {
        $this->handler = $handler;
        $this->validator = $validator;
    }

    public function index(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $registrationCommand = $this->deserialize($request);

        if ($errors = $this->validator->validate($registrationCommand)) {
            throw new ValidationException($errors);
        }

        $this->handler->handle($registrationCommand);

        $response->getBody()->write('Registered');
    }

    private function deserialize(RequestInterface $request): SignUpCommand
    {
        $body = $request->getParsedBody();

        $registrationCommand = new SignUpCommand();

        $registrationCommand->email = $body['email'] ?? '';
        $registrationCommand->password = $body['password'] ?? '';

        return $registrationCommand;
    }
}