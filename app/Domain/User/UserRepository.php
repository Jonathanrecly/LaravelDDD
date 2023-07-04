<?php

namespace App\Domain\User;

use App\Domain\User\Aggregate\User;

interface UserRepository
{
    public function create(User $user): void;
}
