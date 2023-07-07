<?php

declare(strict_types=1);

namespace App\Domain\Shared\ValueObject;

use DateTimeImmutable;
use DateTimeZone;

final class DateTimeEntity extends DateTimeImmutable implements DateTimeInterface
{
    public function value(): string
    {
        return $this->setTimezone(new DateTimeZone(self::DATETIME_ZONE))->format(self::DATETIME_FORMAT);
    }

    public static function fromPrimitives(string $datetime): static
    {
        return new self($datetime);
    }

    public static function now(): static
    {
        return new static('now');
    }
}
