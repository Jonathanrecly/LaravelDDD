<?php

namespace App\Domain\User;

use App\Domain\User\Aggregate\User;
use App\Infrastructure\User\UserCollection;

interface UserRepository
{
    public function create(User $user): void;

    public function findAll(UserSearchCriteria $userSearchCriteria): UserCollection;
}
