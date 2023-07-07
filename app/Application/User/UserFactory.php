<?php

namespace App\Application\User;

use App\Domain\User\Aggregate\User;
use App\Domain\User\StoreUserRequest;
use App\Domain\User\UpdateUserRequest;
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

    public function makeFromUserAndRequest(User $user, UpdateUserRequest $request): User
    {
        $name = $request->getName();
        $email = $request->getEmail();

        if (! empty($name)) {
            $user->updateName($name);
        }

        if (! empty($email)) {
            $user->updateEmail($email);
        }

        return $user;
    }
}
