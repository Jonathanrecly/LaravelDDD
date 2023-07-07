<?php

namespace App\Infrastructure\User;

use App\Domain\User\Aggregate\User;
use App\Domain\User\UserRepository as UserRepositoryContract;
use App\Domain\User\ValueObject\Uuid;
use App\Infrastructure\Laravel\Model\UserModel;
use App\Infrastructure\Laravel\Service\RequestCriteria\Criteria\UserSearchCriteria;
use App\Infrastructure\Laravel\Service\RequestCriteria\QueryApplicator;
use Illuminate\Database\Eloquent\Model;

class UserRepository implements UserRepositoryContract
{
    public function __construct(
        private readonly UserModel $userModel,
        private readonly UserTransformer $userTransformer,
        private readonly QueryApplicator $queryApplicator,
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

    public function findByUuid(Uuid $uuid): User
    {
        /** @var UserModel $userModel */
        $userModel = $this->firstOrFailByUUid($uuid);

        /** @var User $user */
        $user = $this->userTransformer->toDomain($userModel);

        return $user;
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

        $query = $this->queryApplicator->apply($query, $userSearchCriteria);

        return new UserCollection(
            $query->get()
                ->map(fn ($userModel) => $this->userTransformer->toDomain($userModel))
        );
    }

    public function update(User $user): void
    {
        /** @var UserModel $userModel */
        $userModel = $this->firstOrFailByUUid($user->getUuid());

        $userModel->name = $user->getName();
        $userModel->email = $user->getEmail();

        $userModel->save();
    }

    private function firstOrFailByUUid(Uuid $uuid): Model
    {
        return $this->userModel->newQuery()->where('uuid', $uuid->value())->firstOrFail();
    }
}
