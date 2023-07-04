<?php

namespace App\Infrastructure\Laravel\Providers;

use App\Application\User\UserFactory;
use App\Application\User\UserService;
use App\Domain\User\StoreUserRequest as StoreUserRequestContract;
use App\Domain\User\UserController as UserControllerContract;
use App\Domain\User\UserFactory as UserFactoryContract;
use App\Domain\User\UserRepository as UserRepositoryContract;
use App\Domain\User\UserService as UserServiceContract;
use App\Infrastructure\User\UserRepository;
use App\UI\Controllers\UserController;
use App\UI\Requests\User\StoreUserRequest;
use Illuminate\Support\ServiceProvider;

class BindServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(
            UserRepositoryContract::class,
            UserRepository::class);

        $this->app->singleton(
            UserControllerContract::class,
            UserController::class);

        $this->app->singleton(
            StoreUserRequestContract::class,
            StoreUserRequest::class);

        $this->app->singleton(
            UserServiceContract::class,
            UserService::class
        );

        $this->app->singleton(
            UserFactoryContract::class,
            UserFactory::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
