<?php
declare(strict_types=1);

namespace App\Models\User;

use App\Models\DomainException\DomainRecordNotFoundException;

class UserNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The user you requested does not exist.';
}
