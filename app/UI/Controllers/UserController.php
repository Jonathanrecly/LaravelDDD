<?php

namespace App\UI\Controllers;

use App\Domain\User\StoreUserRequest;
use App\Domain\User\UserController as UserControllerContract;
use App\Domain\User\UserService;
use App\Infrastructure\Laravel\Controller;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller implements UserControllerContract
{
    public function __construct(public readonly UserService $userService)
    {
    }

    public function store(StoreUserRequest $request): JsonResource
    {
        return new JsonResource($this->userService->createFromUserRequest($request));
    }
}
