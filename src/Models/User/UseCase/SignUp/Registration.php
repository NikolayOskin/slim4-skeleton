<?php

namespace App\Models\User\UseCase\SignUp;

use App\Models\Flusher;
use App\Models\User\Entity\UserRepository;

class Registration
{
    /**
     * @var UserRepository
     */
    private $repository;
    /**
     * @var Flusher
     */
    private $flusher;

    public function __construct(UserRepository $repository, Flusher $flusher)
    {
        $this->repository = $repository;
        $this->flusher = $flusher;
    }

    public function register()
    {
        
    }
}