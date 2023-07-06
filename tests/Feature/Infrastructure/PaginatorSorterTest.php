<?php

namespace Tests\Feature\Infrastructure;

use App\Domain\Shared\Model\Criteria;
use App\Domain\Shared\Model\CriteriaField;
use App\Domain\Shared\Model\CriteriaPagination;
use App\Domain\Shared\Model\CriteriaSort;
use App\Domain\Shared\Model\CriteriaSortDirection;
use App\Domain\Shared\Model\Pagination\Limit;
use App\Domain\Shared\Model\Pagination\Offset;
use App\Domain\Shared\ValueObject\Integer;
use App\Infrastructure\Laravel\Service\PaginatorSorter;
use Illuminate\Database\Eloquent\Builder;
use Tests\TestCase;

class PaginatorSorterTest extends TestCase
{
    /** @test */
    public function it_should_paginate_query_builder(): void
    {
        /** @var PaginatorSorter $paginatorSorter */
        $paginatorSorter = $this->app->make(PaginatorSorter::class);
        $offset = Integer::fromInteger(1);
        $limit = Integer::fromInteger(10);

        $criteriaPagination = new CriteriaPagination(
            Limit::fromInteger($limit->value()),
            Offset::fromInteger($offset->value())
        );

        $mockedCriteria = $this->getMockCriteria($criteriaPagination, null);

        $builder = new Builder(resolve(\Illuminate\Database\Query\Builder::class));

        $builder = $paginatorSorter->apply($builder, $mockedCriteria);

        $this->assertEquals($builder->getQuery()->limit, $limit->value());
        $this->assertEquals($builder->getQuery()->offset, $offset->value());
    }

    /** @test */
    public function it_should_sort_query_builder(): void
    {
        /** @var PaginatorSorter $paginatorSorter */
        $paginatorSorter = $this->app->make(PaginatorSorter::class);

        $criteriaSort = new CriteriaSort(
            CriteriaField::fromString('name'),
            CriteriaSortDirection::DESC
        );

        $mockedCriteria = $this->getMockCriteria(null, $criteriaSort);

        $builder = new Builder(resolve(\Illuminate\Database\Query\Builder::class));

        $builder = $paginatorSorter->apply($builder, $mockedCriteria);

        $this->assertEquals($builder->getQuery()->orders[0]['column'], $criteriaSort->field()->value());
        $this->assertEquals($builder->getQuery()->orders[0]['direction'], strtolower($criteriaSort->direction()->value()));
    }

    private function getMockCriteria(?CriteriaPagination $pagination, ?CriteriaSort $sort): Criteria
    {
        return new class($pagination, $sort) extends Criteria
        {
            public function __construct(?CriteriaPagination $pagination, ?CriteriaSort $sort)
            {
                parent::__construct($pagination, $sort);
            }
        };
    }
}
