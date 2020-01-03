<?php


namespace App\Models\User\UseCase\SignUp;

use Symfony\Component\Validator\Constraints as Assert;

class RegistrationRequest
{
    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    public $email;
    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=6)
     */
    public $password;
}