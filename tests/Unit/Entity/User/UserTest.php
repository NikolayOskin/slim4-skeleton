<?php

namespace Tests\Unit\Entity\User;

use App\Models\User\Entity\User;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function test_user_entity_with_empty_email()
    {
        self::expectException(InvalidArgumentException::class);
        new User(
            '',
            'password'
        );
    }

    public function test_user_entity_with_empty_password()
    {
        self::expectException(InvalidArgumentException::class);
        new User(
            'some@gmail.com',
            ''
        );
    }

}