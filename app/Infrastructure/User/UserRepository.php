<?php

namespace App\Infrastructure\User;

use App\Domain\User\Aggregate\User;
use App\Domain\User\UserRepository as UserRepositoryContract;
use App\Domain\User\UserSearchCriteria;
use App\Infrastructure\Laravel\Model\UserModel;
use App\Infrastructure\Laravel\Service\PaginatorSorter;

class UserRepository implements UserRepositoryContract
{
    public function __construct(
        private readonly UserModel $userModel,
        private readonly UserTransformer $userTransformer,
        private readonly PaginatorSorter $paginatorSorter,
    ) {
    }

    public function create(User $user): void
    {
        $userModel = $this->userModel->newInstance();

        $userModel->uuid = $user->getUuid();
        $userModel->name = $user->getName();
        $userModel->email = $user->getEmail();

        $userModel->save();
    }

    public function findAll(UserSearchCriteria $userSearchCriteria): UserCollection
    {
        $query = $this->userModel->newQuery();

        if (! empty($userSearchCriteria->email())) {
            $query = $query->where('email', 'like', '%'.$userSearchCriteria->email().'%');
        }

        if (! empty($userSearchCriteria->name())) {
            $query = $query->where('name', 'like', '%'.$userSearchCriteria->name().'%');
        }

        $query = $this->paginatorSorter->apply($query, $userSearchCriteria);

        return new UserCollection(
            $query->get()
                ->map(fn ($userModel) => $this->userTransformer->toDomain($userModel))
        );
    }
}
