<?php

namespace App\Http\Action\Auth\SignIn;

use App\Http\ValidationException;
use App\Http\Validator\Validator;
use App\Models\User\UseCase\SignIn\SignInCommand;
use App\Models\User\UseCase\SignIn\SignInHandler;
use App\Models\User\UseCase\SignUp\SignUpCommand;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class SignInController
{
    /**
     * @var SignInHandler
     */
    private $handler;
    /**
     * @var Validator
     */
    private $validator;

    public function __construct(SignInHandler $handler, Validator $validator)
    {
        $this->handler = $handler;
        $this->validator = $validator;
    }

    public function index(RequestInterface $request): ResponseInterface
    {
        $signInCommand = $this->deserialize($request);

        if ($errors = $this->validator->validate($signInCommand)) {
            throw new ValidationException($errors);
        }

        $tokens = $this->handler->handle($signInCommand);

        return new JsonResponse($tokens, 200);
    }

    private function deserialize(RequestInterface $request): SignInCommand
    {
        $body = $request->getParsedBody();

        $signInCommand = new SignInCommand();

        $signInCommand->email = $body['email'] ?? '';
        $signInCommand->password = $body['password'] ?? '';

        return $signInCommand;
    }
}