<?php

namespace App\Infrastructure\User;

use App\Domain\User\Aggregate\User;
use App\Domain\User\UserFactory;
use App\Domain\User\UserRepository as UserRepositoryContract;
use App\Domain\User\UserSearchCriteria;
use App\Infrastructure\Laravel\Model\UserModel;

class UserRepository implements UserRepositoryContract
{
    public function __construct(
        private readonly UserModel $userModel,
        private readonly UserFactory $userFactory,
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

        if ($userSearchCriteria->pagination() !== null) {
            $query = $query->take($userSearchCriteria->pagination()->limit()->value())
                ->skip($userSearchCriteria->pagination()->offset()->value());
        }

        if ($userSearchCriteria->sort() !== null) {
            $query = $query->orderBy($userSearchCriteria->sort()->field()->value(), $userSearchCriteria->sort()->direction()->value());
        }

        return new UserCollection(
            $query->get()
                ->map(fn (UserModel $userModel) => $this->userFactory->newFromModel($userModel))
        );
    }
}