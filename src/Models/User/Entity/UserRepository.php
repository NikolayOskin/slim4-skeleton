<?php

namespace App\Models\User\Entity;

interface UserRepository
{
    public function hasByEmail(string $email): bool;

    public function getByEmail(string $email): User;

    public function add(User $user): void;
}