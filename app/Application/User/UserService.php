<?php

namespace App\Application\User;

use App\Domain\User\Aggregate\User;
use App\Domain\User\StoreUserRequest;
use App\Domain\User\UserFactory;
use App\Domain\User\UserRepository;
use App\Domain\User\UserSearchCriteria;
use App\Domain\User\UserService as UserServiceContract;
use Illuminate\Support\Collection;

class UserService implements UserServiceContract
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly UserFactory $userFactory,
    ) {
    }

    public function createFromUserRequest(StoreUserRequest $userRequest): User
    {
        $user = $this->userFactory->newFromRequest($userRequest);

        $this->userRepository->create($user);

        return $user;
    }

    public function findAll(UserSearchCriteria $userSearchCriteria): Collection
    {
        return $this
            ->userRepository
            ->findAll($userSearchCriteria);
    }
}
