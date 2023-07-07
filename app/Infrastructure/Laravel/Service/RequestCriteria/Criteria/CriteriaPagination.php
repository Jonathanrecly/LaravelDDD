<?php

declare(strict_types=1);

namespace App\Infrastructure\Laravel\Service\RequestCriteria\Criteria;

use App\Domain\Shared\ValueObject\IntegerEntity;
use App\Infrastructure\Laravel\Service\RequestCriteria\Criteria\Pagination\Limit;
use App\Infrastructure\Laravel\Service\RequestCriteria\Criteria\Pagination\Offset;

final class CriteriaPagination
{
    private Limit $limit;

    private Offset $offset;

    public function __construct(Limit $limit, Offset $offset)
    {
        $this->limit = $limit;
        $this->offset = $offset;
    }

    public function totalPagesFromResult(int $totalItems): IntegerEntity
    {
        if (0 === $totalItems) {
            return IntegerEntity::fromInteger(1);
        }

        return IntegerEntity::fromInteger((int) ceil($totalItems / $this->limit->value()));
    }

    public function page(): IntegerEntity
    {
        if (0 === $this->offset->value()) {
            return IntegerEntity::fromInteger(1);
        }

        return IntegerEntity::fromInteger((int) ceil($this->offset->value() / $this->limit->value()));
    }

    public function limit(): Limit
    {
        return $this->limit;
    }

    public function offset(): Offset
    {
        return $this->offset;
    }
}
