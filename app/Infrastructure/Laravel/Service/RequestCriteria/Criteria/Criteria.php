<?php

namespace App\Infrastructure\Laravel\Service\RequestCriteria\Criteria;

abstract class Criteria
{
    private CriteriaPagination $pagination;

    private ?CriteriaSort $sort;

    protected function __construct(CriteriaPagination $pagination, ?CriteriaSort $sort = null)
    {
        $this->pagination = $pagination;
        $this->sort = $sort;
    }

    public function sortBy(CriteriaSort $sort): static
    {
        $this->sort = $sort;

        return $this;
    }

    public function pagination(): ?CriteriaPagination
    {
        return $this->pagination;
    }

    public function sort(): ?CriteriaSort
    {
        return $this->sort;
    }
}
