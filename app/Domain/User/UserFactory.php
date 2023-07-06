<?php

namespace App\Domain\User;

use App\Domain\User\Aggregate\User;
use App\Infrastructure\Laravel\Model\UserModel;

interface UserFactory
{
    public function newFromRequest(StoreUserRequest $request): User;

    public function newFromModel(UserModel $userModel): User;
}
