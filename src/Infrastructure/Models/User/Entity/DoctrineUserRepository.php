<?php

namespace App\Infrastructure\Models\User\Entity;

use App\Models\User\Entity\User;
use App\Models\User\Entity\UserRepository;
use Doctrine\ORM\EntityManager;

class DoctrineUserRepository implements UserRepository
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function getByEmail(string $email): User
    {

    }

    public function hasByEmail(string $email): bool
    {

    }

    public function add(User $user): void
    {

    }
}