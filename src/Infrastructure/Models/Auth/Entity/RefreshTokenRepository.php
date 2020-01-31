<?php

namespace App\Infrastructure\Models\Auth\Entity;

use App\Models\Auth\Entity\RefreshToken;
use Doctrine\ORM\EntityManager;
use Ramsey\Uuid\Uuid;

class RefreshTokenRepository
{
    /**
     * @var EntityManager
     */
    private $em;
    private $repo;
    /**
     * @var string
     */
    private $refreshTokenTTL;

    public function __construct(EntityManager $entityManager, string $refreshTokenTTL)
    {
        $this->em = $entityManager;
        $this->repo = $entityManager->getRepository(RefreshToken::class);
        $this->refreshTokenTTL = $refreshTokenTTL;
    }

    public function getNewRefreshToken(int $user_id) : RefreshToken
    {
        return new RefreshToken(
            Uuid::uuid4(),
            (new \DateTimeImmutable("now"))->add(new \DateInterval($this->refreshTokenTTL)),
            $user_id
        );
    }

    public function persistNewRefreshToken(RefreshToken $refreshToken) : void
    {
        if ($this->exists($refreshToken->getToken())) {
            throw new \DomainException("Refresh Token already exists");
        }
        $this->em->persist($refreshToken);
        $this->em->flush();
    }

    public function exists($token) : bool
    {
        return (boolean)$this->repo->createQueryBuilder('t')
            ->andWhere('t.refreshToken = :refresh_token')
            ->setParameter('refresh_token', $token)
            ->getQuery()
            ->getOneOrNullResult();
    }
}