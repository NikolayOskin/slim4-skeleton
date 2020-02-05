<?php

namespace App\Models\User\Entity;

use Doctrine\ORM\Mapping as ORM;
use Webmozart\Assert\Assert;

/**
 * @ORM\Entity
// * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="users", uniqueConstraints={
 *     @ORM\UniqueConstraint(columns={"email"})
 * })
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     */
    private $password;

    public function __construct(string $email, string $password)
    {
        Assert::notEmpty($email);
        Assert::notEmpty($password);
        $this->email = $email;
        $this->password = $password;
    }

    public function getHash() : string
    {
        return $this->password;
    }

    public function getId() : int
    {
        return $this->id;
    }
}