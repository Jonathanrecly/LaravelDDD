<?php

namespace App\Infrastructure\UI\Controllers;

use App\Application\User\UserRequestCriteriaFactory;
use App\Domain\User\StoreUserRequest;
use App\Domain\User\UpdateUserRequest;
use App\Domain\User\UserController as UserControllerContract;
use App\Domain\User\UserService;
use App\Domain\User\ValueObject\Uuid;
use App\Infrastructure\Laravel\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller implements UserControllerContract
{
    public function __construct(
        public readonly UserService $userService,
        public readonly UserRequestCriteriaFactory $userRequestCriteriaFactory
    ) {
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        return JsonResource::collection(
            $this->userService->findAll(
                $this->userRequestCriteriaFactory->fromInputBag($request->query)
            )
        );
    }

    public function show(string $uuid): JsonResource
    {
        return new JsonResource($this->userService->findByUuid(Uuid::fromPrimitives($uuid)));
    }

    public function store(StoreUserRequest $request): JsonResource
    {
        return new JsonResource($this->userService->createFromUserRequest($request));
    }

    public function update(UpdateUserRequest $request, string $uuid): JsonResource
    {
        return new JsonResource(
            $this->userService->UpdateFromUserRequest(
                Uuid::fromPrimitives($uuid),
                $request
            )
        );
    }
}
