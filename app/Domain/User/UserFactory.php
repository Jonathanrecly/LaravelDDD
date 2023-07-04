<?php

namespace App\Domain\User;

use App\Domain\User\Aggregate\User;

interface UserFactory
{
    public function newFromRequest(StoreUserRequest $request): User;
}
