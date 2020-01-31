<?php

namespace App\Models\Auth\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="refresh_tokens")
 */
class RefreshToken
{
    /**
     * @ORM\Column(type="string", length=80, name="refresh_token")
     * @ORM\Id
     */
    private $refreshToken;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="expiry_date_time")
     */
    private $expiryDateTime;

    /**
     * @ORM\Column(type="bigint", name="user_id", options={"unsigned":true})
     */
    private $userId;

    public function __construct(string $refreshToken, \DateTimeImmutable $expiryDateTime, int $userId)
    {
        $this->refreshToken = $refreshToken;
        $this->expiryDateTime = $expiryDateTime;
        $this->userId = $userId;
    }

    public function isExpired() : bool
    {
        return $this->expiryDateTime <= (new \DateTimeImmutable());
    }

    public function getToken() : string
    {
        return $this->refreshToken;
    }
}