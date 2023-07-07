<?php

namespace App\Domain\User;

use App\Domain\User\Aggregate\User;

interface UserFactory
{
    public function newFromRequest(StoreUserRequest $request): User;

    public function makeFromUserAndRequest(User $user, UpdateUserRequest $request): User;
}
