<?php

declare(strict_types=1);

namespace App\Domain\Shared\ValueObject;

class IntegerEntity
{
    protected int $value;

    private function __construct(int $value)
    {
        $this->value = $value;
    }

    public function __toString()
    {
        return (string) $this->value();
    }

    public static function fromInteger(int $value): static
    {
        /** @phpstan-ignore-next-line  */
        return new static($value);
    }

    public function value(): int
    {
        return $this->value;
    }

    public function isLessThan(IntegerEntity $otherInt): bool
    {
        return $this->value() < $otherInt->value();
    }

    public function isZero(): bool
    {
        return 0 === $this->value();
    }

    public function equals(IntegerEntity $otherInt): bool
    {
        return $this->value() === $otherInt->value();
    }
}
