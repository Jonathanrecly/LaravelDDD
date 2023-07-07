<?php

namespace App\Domain\User;

use App\Domain\User\Aggregate\User;
use App\Domain\User\ValueObject\Uuid;
use App\Infrastructure\Laravel\Service\RequestCriteria\Criteria\UserSearchCriteria;
use Illuminate\Support\Collection;

interface UserService
{
    public function createFromUserRequest(StoreUserRequest $userRequest): User;

    public function findAll(UserSearchCriteria $userSearchCriteria): Collection;

    public function UpdateFromUserRequest(Uuid $uuid, UpdateUserRequest $userRequest): User;

    public function findByUuid(Uuid $uuid): User;
}
