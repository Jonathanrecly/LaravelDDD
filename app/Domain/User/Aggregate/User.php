<?php

namespace App\Domain\User\Aggregate;

use App\Domain\Shared\Aggregate;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Name;
use App\Domain\User\ValueObject\Uuid;

final class User implements Aggregate
{
    private function __construct(
        private readonly Uuid $uuid,
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

    public function updateName(string $name): void
    {
        $this->name = Name::fromString($name);
    }

    public function updateEmail(string $email): void
    {
        $this->email = Email::fromString($email);
    }

    /**
     * @return  array<string, string>
     */
    public function toArray(): array
    {
        return [
            'uuid' => $this->getUuid()->value(),
            'name' => $this->getName()->value(),
            'email' => $this->getEmail()->value(),
        ];
    }
}
