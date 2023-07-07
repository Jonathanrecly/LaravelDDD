<?php

namespace App\Infrastructure\User;

use App\Domain\User\Aggregate\User;
use App\Domain\User\Exceptions\UserNotFoundException;
use App\Domain\User\Exceptions\UserNotSavedException;
use App\Domain\User\UserRepository as UserRepositoryContract;
use App\Domain\User\ValueObject\Uuid;
use App\Infrastructure\Laravel\Model\UserModel;
use App\Infrastructure\Laravel\Service\RequestCriteria\Criteria\UserSearchCriteria;
use App\Infrastructure\Laravel\Service\RequestCriteria\QueryApplicator;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository implements UserRepositoryContract
{
    public function __construct(
        private readonly UserModel $userModel,
        private readonly UserTransformer $userTransformer,
        private readonly QueryApplicator $queryApplicator,
    ) {
    }

    /**
     * @throws UserNotSavedException
     */
    public function create(User $user): void
    {
        $userModel = $this->userModel->newInstance();

        $userModel->uuid = $user->getUuid();
        $userModel->name = $user->getName();
        $userModel->email = $user->getEmail();

        $this->saveUserModel($userModel);
    }

    /**
     * @throws UserNotFoundException
     */
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

    /**
     * @throws UserNotSavedException
     * @throws UserNotFoundException
     */
    public function update(User $user): void
    {
        /** @var UserModel $userModel */
        $userModel = $this->firstOrFailByUUid($user->getUuid());

        $userModel->name = $user->getName();
        $userModel->email = $user->getEmail();

        $this->saveUserModel($userModel);
    }

    /**
     * @throws UserNotFoundException
     */
    private function firstOrFailByUUid(Uuid $uuid): Model
    {
        try {
            return $this->userModel->newQuery()->where('uuid', $uuid->value())->firstOrFail();
        } catch (ModelNotFoundException) {
            throw new UserNotFoundException();
        }
    }

    /**
     * @throws UserNotSavedException
     */
    private function saveUserModel(UserModel $userModel): void
    {
        try {
            $userModel->save();
        } catch (Exception $e) {
            throw new UserNotSavedException($e->getMessage());
        }
    }
}
