<?php

namespace App\Models\User\UseCase\SignIn;

use App\Infrastructure\Models\Auth\Entity\AccessTokenRepository;
use App\Infrastructure\Models\Auth\Entity\RefreshTokenRepository;
use App\Models\Flusher;
use App\Models\User\Entity\UserRepository;
use App\Models\User\Service\PasswordHasher;

class SignInHandler
{
    private $userRepo;
    private $flusher;
    private $hasher;
    private $accessRepo;
    private $refreshRepo;

    public function __construct(
        UserRepository $userRepo,
        Flusher $flusher,
        PasswordHasher $hasher,
        AccessTokenRepository $accessRepo,
        RefreshTokenRepository $refreshRepo
    ) {
        $this->userRepo = $userRepo;
        $this->flusher = $flusher;
        $this->hasher = $hasher;
        $this->accessRepo = $accessRepo;
        $this->refreshRepo = $refreshRepo;
    }

    public function handle(SignInCommand $request): array
    {
        if (!$this->userRepo->hasByEmail($request->email)) {
            throw new \DomainException("Credentials did not match");
        }

        $user = $this->userRepo->getByEmail($request->email);

        if (!$this->hasher->validate($request->password, $user->getHash())) {
            throw new \DomainException('Credentials did not match.');
        }

        $accessToken = $this->accessRepo->generateByUserId($user->getId());
        $refreshToken = $this->refreshRepo->getNewRefreshToken($user->getId());
        $this->refreshRepo->persistNewRefreshToken($refreshToken);

        return [
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken->getToken()
        ];
    }
}