<?php

namespace Tests\Feature\Infrastructure;

use App\Domain\Shared\ValueObject\IntegerEntity;
use App\Infrastructure\Laravel\Service\RequestCriteria\Criteria\Criteria;
use App\Infrastructure\Laravel\Service\RequestCriteria\Criteria\CriteriaPagination;
use App\Infrastructure\Laravel\Service\RequestCriteria\Criteria\CriteriaSort;
use App\Infrastructure\Laravel\Service\RequestCriteria\Factory;
use App\Infrastructure\Laravel\Service\RequestCriteria\QueryApplicator;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\InputBag;
use Tests\TestCase;

class PaginatorSorterTest extends TestCase
{
    /** @test */
    public function it_should_paginate_query_builder(): void
    {
        /** @var QueryApplicator $queryApplicator */
        $queryApplicator = $this->app->make(QueryApplicator::class);
        $offset = IntegerEntity::fromInteger(1);
        $limit = IntegerEntity::fromInteger(10);

        $factory = $this->getRequestCriteriaFactory();

        $criteriaPagination = $factory->makePaginationFromInputBag(new InputBag([
            'offset' => $offset->value(),
            'limit' => $limit->value(),
        ]));

        $mockedCriteria = $this->getMockCriteria($criteriaPagination, null);

        $builder = new Builder(resolve(\Illuminate\Database\Query\Builder::class));

        $builder = $queryApplicator->apply($builder, $mockedCriteria);

        $this->assertEquals($builder->getQuery()->limit, $limit->value());
        $this->assertEquals($builder->getQuery()->offset, $offset->value());
    }

    /** @test */
    public function it_should_sort_query_builder(): void
    {
        /** @var QueryApplicator $queryApplicator */
        $queryApplicator = $this->app->make(QueryApplicator::class);

        $factory = $this->getRequestCriteriaFactory();

        $criteriaPagination = $factory->makePaginationFromInputBag(new InputBag([
            'offset' => 0,
            'limit' => 10,
        ]));

        $criteriaSort = $factory->makeSortFromInputBag(new InputBag([
            'sort' => 'name',
            'direction' => 'DESC',
        ]));

        $mockedCriteria = $this->getMockCriteria($criteriaPagination, $criteriaSort);

        $builder = new Builder(resolve(\Illuminate\Database\Query\Builder::class));

        $builder = $queryApplicator->apply($builder, $mockedCriteria);

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

    private function getRequestCriteriaFactory(): Factory
    {
        return new class extends Factory
        {
        };
    }
}
