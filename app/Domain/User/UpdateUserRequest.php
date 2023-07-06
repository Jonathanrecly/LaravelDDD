<?php

namespace App\Domain\User;

interface UpdateUserRequest
{
    public function getName(): ?string;

    public function getEmail(): ?string;
}
