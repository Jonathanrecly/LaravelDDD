<?php

namespace App\Infrastructure\User\Events;

use App\Domain\User\Events\UserCreatedEvent;
use App\Domain\User\ValueObject\Uuid;
use Illuminate\Foundation\Events\Dispatchable;

class UserCreated implements UserCreatedEvent
{
    use Dispatchable;

    public function __construct(public readonly Uuid $uuid)
    {
    }
}
