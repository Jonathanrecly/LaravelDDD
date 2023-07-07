<?php

declare(strict_types=1);

namespace App\Domain\Shared\ValueObject;

class StringEntity
{
    protected string $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value();
    }

    public static function fromString(string $value): static
    {
        /** @phpstan-ignore-next-line  */
        return new static($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(StringEntity $otherString): bool
    {
        return $this->value === $otherString->value;
    }

    public function empty(): bool
    {
        return empty($this->value());
    }
}
