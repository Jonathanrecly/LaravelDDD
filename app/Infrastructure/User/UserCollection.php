<?php

namespace App\Infrastructure\User;

use App\Domain\User\Aggregate\User;
use App\Domain\User\Aggregate\UserCollection as UserCollectionContract;
use Illuminate\Support\Collection;

/**
 * @extends Collection<int, User>
 */
class UserCollection extends Collection implements UserCollectionContract
{
}
