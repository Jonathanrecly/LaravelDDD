<?php

namespace App\Infrastructure\User;

use App\Infrastructure\Laravel\Model\UserModel;
use Illuminate\Support\Collection;

/**
 * @extends Collection<int, UserModel>
 */
class UserCollection extends Collection
{
}
