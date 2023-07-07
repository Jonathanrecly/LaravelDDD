<?php

namespace App\Domain\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

interface UserController
{
    public function index(Request $request): AnonymousResourceCollection;

    public function show(string $uuid): JsonResource;

    public function store(StoreUserRequest $request): JsonResource;

    public function update(UpdateUserRequest $request, string $uuid): JsonResource;
}
