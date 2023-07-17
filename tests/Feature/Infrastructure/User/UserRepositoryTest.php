<?php

namespace Tests\Feature\Infrastructure\User;

use App\Domain\User\Aggregate\User;
use App\Domain\User\UserRepository;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Name;
use App\Domain\User\ValueObject\Uuid;
use App\Infrastructure\User\Events\UserCreated;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    /** @test */
    public function it_should_dispatch_user_created_event(): void
    {
        /** @var UserRepository $userRepository */
        $userRepository = $this->app->make(UserRepository::class);

        Event::fake();

        $userRepository->create(User::make(
            uuid: Uuid::random(),
            name: Name::fromString('John Doe'),
            email: Email::fromString('john@doe.fr')
        ));

        Event::assertDispatched(UserCreated::class);
    }
}
