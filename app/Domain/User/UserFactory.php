<?php

namespace App\Domain\User;

use App\Domain\User\Aggregate\User;
use App\Domain\User\ValueObject\Uuid;

interface UserFactory
{
    public function newFromRequest(StoreUserRequest $request): User;

    public function makeFromUuidAndRequest(Uuid $uuid, UpdateUserRequest $request): User;
}
