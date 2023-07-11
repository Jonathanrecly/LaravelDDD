<?php

namespace App\Infrastructure\Laravel\Service\RequestCriteria;

use App\Infrastructure\Laravel\Service\RequestCriteria\Criteria\CriteriaPagination;
use App\Infrastructure\Laravel\Service\RequestCriteria\Criteria\CriteriaSort;

interface Criteria
{
    public function sortBy(CriteriaSort $sort): static;

    public function pagination(): ?CriteriaPagination;

    public function sort(): ?CriteriaSort;
}
