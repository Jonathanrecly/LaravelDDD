<?php

namespace App\Infrastructure\Laravel\Service\RequestCriteria;

use App\Infrastructure\Laravel\Service\RequestCriteria\Criteria\Criteria;
use App\Infrastructure\Laravel\Service\RequestCriteria\Criteria\CriteriaPagination;
use App\Infrastructure\Laravel\Service\RequestCriteria\Criteria\CriteriaSort;
use Illuminate\Database\Eloquent\Builder;

class QueryApplicator
{
    public function apply(Builder $query, Criteria $criteria): Builder
    {

        if ($criteria->pagination() !== null) {
            $query = $this->applyPagination($query, $criteria->pagination());
        }

        if ($criteria->sort() !== null) {
            $query = $this->applySort($query, $criteria->sort());
        }

        return $query;
    }

    private function applyPagination(Builder $query, CriteriaPagination $criteriaPagination): Builder
    {
        return $query->take($criteriaPagination->limit()->value())
            ->skip($criteriaPagination->offset()->value());
    }

    private function applySort(Builder $query, CriteriaSort $criteriaPagination): Builder
    {
        return $query->orderBy($criteriaPagination->field()->value(), $criteriaPagination->direction()->value());
    }
}
