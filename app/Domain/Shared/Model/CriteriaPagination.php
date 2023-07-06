<?php

declare(strict_types=1);

namespace App\Domain\Shared\Model;

use App\Domain\Shared\Model\Pagination\Limit;
use App\Domain\Shared\Model\Pagination\Offset;
use App\Domain\Shared\ValueObject\IntegerValueObject;

final class CriteriaPagination
{
    private Limit $limit;

    private Offset $offset;

    public function __construct(Limit $limit, Offset $offset)
    {
        $this->limit = $limit;
        $this->offset = $offset;
    }

    public function totalPagesFromResult(int $totalItems): IntegerValueObject
    {
        if (0 === $totalItems) {
            return IntegerValueObject::fromInteger(1);
        }

        return IntegerValueObject::fromInteger((int) ceil($totalItems / $this->limit->value()));
    }

    public function page(): IntegerValueObject
    {
        if (0 === $this->offset->value()) {
            return IntegerValueObject::fromInteger(1);
        }

        return IntegerValueObject::fromInteger((int) ceil($this->offset->value() / $this->limit->value()));
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
