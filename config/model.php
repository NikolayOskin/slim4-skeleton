<?php
declare(strict_types=1);

use App\Domain\User\UserRepository;
use App\Infrastructure\Models\User\BcryptPasswordHasher;
use App\Infrastructure\Models\User\Entity\DoctrineUserRepository;
use App\Infrastructure\Service\DoctrineFlusher;
use App\Models\Flusher;
use App\Models\User\Service\PasswordHasher;

return [
    UserRepository::class => \DI\autowire(DoctrineUserRepository::class),
    PasswordHasher::class => \DI\autowire(BcryptPasswordHasher::class),
    Flusher::class => \DI\autowire(DoctrineFlusher::class),
];

