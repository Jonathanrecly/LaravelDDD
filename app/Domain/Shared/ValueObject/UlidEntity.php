<?php

declare(strict_types=1);

namespace App\Domain\Shared\ValueObject;

use App\Domain\Shared\Exception\InvalidArgumentException;
use Illuminate\Support\Str;
use Stringable;

class UlidEntity implements Stringable, UlidInterface
{
    private string $value;

    final public function __construct(string $value)
    {
        $this->guard($value);

        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private function guard(string $value): void
    {
        if (false === Str::isUuid($value)) {
            throw new InvalidArgumentException(sprintf('Value <%s> is not a valid UUID', $value));
        }
    }

    public static function random(): static
    {
        return new static(Str::uuid()->toString());
    }

    public static function fromPrimitives(string $value): static
    {
        return new static($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(UlidInterface $other): bool
    {
        return $this->value() === $other->value();
    }
}
