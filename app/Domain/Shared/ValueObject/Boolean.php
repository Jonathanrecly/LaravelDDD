<?php

declare(strict_types=1);

namespace App\Domain\Shared\ValueObject;

class Boolean
{
    protected bool $value;

    private function __construct(bool $value)
    {
        $this->value = $value;
    }

    public function __toString(): StringVO
    {
        return $this->value() ? 'true' : 'false';
    }

    public static function fromBoolean(bool $value): self
    {
        return new self($value);
    }

    public function value(): bool
    {
        return $this->value;
    }

    public function equals(Boolean $booleanValueObject): bool
    {
        return $this->value === $booleanValueObject->value;
    }

    public function isTrue(): bool
    {
        return true === $this->value;
    }

    public function isFalse(): bool
    {
        return false === $this->value;
    }
}
