<?php

namespace App\Domain\User;

use App\Domain\User\Aggregate\User;
use App\Domain\User\Aggregate\UserCollection;
use App\Domain\User\ValueObject\Uuid;

interface UserRepository
{
    public function create(User $user): void;

    public function findByUuid(Uuid $uuid): User;

    public function findAll(UserSearchCriteria $userSearchCriteria): UserCollection;

    public function update(User $user): void;
}
