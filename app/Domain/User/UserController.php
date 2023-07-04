<?php

namespace App\Domain\User;

use Illuminate\Http\Resources\Json\JsonResource;

interface UserController
{
    public function store(StoreUserRequest $request): JsonResource;
}
