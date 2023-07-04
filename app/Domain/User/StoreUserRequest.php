<?php

namespace App\Domain\User;

interface StoreUserRequest
{
    public function get(string $key, mixed $default = null): mixed;

    public function getName(): string;

    public function getEmail(): string;
}
