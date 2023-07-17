<?php

namespace App\Infrastructure\User\Listeners;

use App\Domain\User\UserRepository;
use App\Infrastructure\User\Events\UserCreated;

class SendEmailNotification
{
    public function __construct(
        private readonly UserRepository $userRepository,
    ) {
    }

    public function handle(UserCreated $event): void
    {
        $user = $this->userRepository->findByUuid($event->uuid);
        // Send email notification
    }
}
