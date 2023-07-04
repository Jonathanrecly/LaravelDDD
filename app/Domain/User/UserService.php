<?php

namespace App\Domain\User;

use App\Domain\User\Aggregate\User;

interface UserService
{
    public function createFromUserRequest(StoreUserRequest $userRequest): User;
}
