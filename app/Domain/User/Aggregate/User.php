<?php

namespace App\Domain\User\Aggregate;

use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Name;
use App\Domain\User\ValueObject\Uuid;

final readonly class User
{
    private function __construct(
        private Uuid $uuid,
        private Name $name,
        private Email $email,
    ) {
    }

    public static function make(
        Uuid $uuid,
        Name $name,
        Email $email,
    ): self {
        return new self($uuid, $name, $email);
    }

    public function getUuid(): Uuid
    {
        return $this->uuid;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @return  array<string,Email|Name|Uuid>
     */
    public function toArray(): array
    {
        return [
            'uuid' => $this->getUuid(),
            'name' => $this->getName(),
            'email' => $this->getEmail(),
        ];
    }
}
