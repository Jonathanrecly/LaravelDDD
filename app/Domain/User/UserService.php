<?php

namespace App\Domain\User;

use App\Domain\User\Aggregate\User;
use Illuminate\Support\Collection;

interface UserService
{
    public function createFromUserRequest(StoreUserRequest $userRequest): User;

    public function findAll(UserSearchCriteria $userSearchCriteria): Collection;
}
