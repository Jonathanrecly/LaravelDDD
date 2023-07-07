<?php

declare(strict_types=1);

namespace App\Infrastructure\Laravel\Service\RequestCriteria\Criteria;

enum CriteriaSortDirection: string
{
    case ASC = 'ASC';
    case DESC = 'DESC';

    public function value(): string
    {
        return $this->value;
    }

    public static function fromString(string $value): self
    {
        return match (strtoupper($value)) {
            self::ASC->value() => self::ASC,
            self::DESC->value() => self::DESC,
            default => self::ASC,
        };
    }
}
