<?php

namespace App\Models\User\UseCase\SignIn;

use Symfony\Component\Validator\Constraints as Assert;

class SignInCommand
{
    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    public $email;
    /**
     * @Assert\NotBlank()
     */
    public $password;
}