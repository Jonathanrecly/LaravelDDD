<?php

namespace App\Infrastructure\User;

use App\Domain\User\Aggregate\User;
use App\Domain\User\UserRepository as UserRepositoryContract;
use App\Infrastructure\Laravel\Model\UserModel;

class UserRepository implements UserRepositoryContract
{
    public function __construct(private readonly UserModel $userModel)
    {
    }

    public function create(User $user): void
    {
        $userModel = $this->userModel->newInstance();

        $userModel->uuid = $user->getUuid();
        $userModel->name = $user->getName();
        $userModel->email = $user->getEmail();

        $userModel->save();
    }
}
