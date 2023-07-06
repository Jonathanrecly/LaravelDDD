<?php

namespace App\Domain\User\Bags;

class UserFilterBag
{
    /**
     * @param  array<string, mixed>  $filter
     */
    public function __construct(private readonly array $filter)
    {
    }

    public function email(): ?string
    {
        return $this->filter['email'] ?? null;
    }

    public function name(): ?string
    {
        return $this->filter['name'] ?? null;
    }
}
