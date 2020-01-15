<?php

namespace App\Models\User\UseCase\SignUp;

use App\Models\Flusher;
use App\Models\User\Entity\User;
use App\Models\User\Entity\UserRepository;
use App\Models\User\Service\PasswordHasher;

class SignUpHandler
{
    private $repository;
    private $flusher;
    private $hasher;

    public function __construct(UserRepository $repository, Flusher $flusher, PasswordHasher $hasher)
    {
        $this->repository = $repository;
        $this->flusher = $flusher;
        $this->hasher = $hasher;
    }

    public function handle(SignUpCommand $request): void
    {
        if ($this->repository->hasByEmail($request->email)) {
            throw new \DomainException('User with this email already exists.');
        }
        $user = new User($request->email, $this->hasher->hash($request->password));

        $this->repository->add($user);
        $this->flusher->flush();
    }
}