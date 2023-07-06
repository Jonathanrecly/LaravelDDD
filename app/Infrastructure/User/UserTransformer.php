<?php

namespace App\Infrastructure\User;

use App\Domain\Shared\Aggregate;
use App\Domain\User\Aggregate\User;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Name;
use App\Domain\User\ValueObject\Uuid;
use App\Infrastructure\Laravel\Model\UserModel;
use App\Infrastructure\Laravel\Transformer;
use Illuminate\Database\Eloquent\Model;

class UserTransformer extends Transformer
{
    /**
     * @param  User  $aggregate
     */
    public function fromDomain(Aggregate $aggregate): Model
    {
        return new UserModel([
            'uuid' => $aggregate->getUuid(),
            'name' => $aggregate->getName(),
            'email' => $aggregate->getEmail(),
        ]);
    }

    /**
     * @param  UserModel  $model
     */
    public function toDomain(Model $model): Aggregate
    {
        return User::make(
            Uuid::fromPrimitives($model->uuid),
            Name::fromString($model->name),
            Email::fromString($model->email)
        );
    }
}
