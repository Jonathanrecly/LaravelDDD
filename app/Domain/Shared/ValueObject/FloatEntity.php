<?php

declare(strict_types=1);

namespace App\Domain\Shared\ValueObject;

class FloatEntity
{
    protected float $value;

    const PRECISION = 10;

    private function __construct(float $value)
    {
        $this->value = $value;
    }

    public function __toString()
    {
        return (string) $this->value();
    }

    public static function fromFloat(float $value): self
    {
        return new self($value);
    }

    public function value(): float
    {
        return $this->value;
    }

    public function equals(float $value): bool
    {
        $epsilon = 1 / self::PRECISION;

        return abs($this->value - $value) < $epsilon;
    }
}
