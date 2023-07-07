<?php

namespace App\Infrastructure\Laravel\Service\RequestCriteria;

use App\Domain\Shared\ValueObject\IntegerEntity;
use App\Infrastructure\Laravel\Service\RequestCriteria\Criteria\CriteriaField;
use App\Infrastructure\Laravel\Service\RequestCriteria\Criteria\CriteriaPagination;
use App\Infrastructure\Laravel\Service\RequestCriteria\Criteria\CriteriaSort;
use App\Infrastructure\Laravel\Service\RequestCriteria\Criteria\CriteriaSortDirection;
use App\Infrastructure\Laravel\Service\RequestCriteria\Criteria\Pagination\Limit;
use App\Infrastructure\Laravel\Service\RequestCriteria\Criteria\Pagination\Offset;
use Symfony\Component\HttpFoundation\InputBag;

abstract class Factory
{
    protected const DEFAULT_LIMIT = 10;

    protected const DEFAULT_OFFSET = 0;

    public function makePaginationFromInputBag(InputBag $inputBag): CriteriaPagination
    {
        $offset = IntegerEntity::fromInteger((int) $inputBag->filter('offset'));
        $limit = IntegerEntity::fromInteger((int) $inputBag->filter('limit'));

        return new CriteriaPagination(
            Limit::fromInteger(max($limit->value(), self::DEFAULT_LIMIT)),
            Offset::fromInteger(max($offset->value(), self::DEFAULT_OFFSET))
        );
    }

    public function makeSortFromInputBag(InputBag $inputBag): ?CriteriaSort
    {
        $sortField = $inputBag->filter('sort');

        if (empty($sortField)) {
            return null;
        }

        return new CriteriaSort(
            CriteriaField::fromString($sortField),
            CriteriaSortDirection::fromString($inputBag->filter('direction'))
        );
    }
}
