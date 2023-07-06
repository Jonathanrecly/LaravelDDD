<?php

namespace App\Application\User;

use App\Domain\User\Aggregate\User;
use App\Domain\User\StoreUserRequest;
use App\Domain\User\UserFactory as UserFactoryContract;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Name;
use App\Domain\User\ValueObject\Uuid;

class UserFactory implements UserFactoryContract
{
    public function newFromRequest(StoreUserRequest $request): User
    {
        return User::make(
            uuid: Uuid::random(),
            name: Name::fromString($request->getName()),
            email: Email::fromString($request->getEmail())
        );
    }
}
