<?php

namespace App\Domain\User;

interface StoreUserRequest
{
    public function getName(): string;

    public function getEmail(): string;
}
