<?php

namespace App\Domain\User;

use App\Domain\User\Aggregate\User;
use App\Domain\User\Aggregate\UserCollection;
use App\Domain\User\ValueObject\Uuid;

interface UserService
{
    public function createFromUserRequest(StoreUserRequest $userRequest): User;

    public function findAll(UserSearchCriteria $userSearchCriteria): UserCollection;

    public function updateFromUserRequest(Uuid $uuid, UpdateUserRequest $userRequest): User;

    public function findByUuid(Uuid $uuid): User;
}
