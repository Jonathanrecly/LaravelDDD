<?php

namespace App\Infrastructure\Laravel\Service\RequestCriteria\Criteria;

use App\Domain\User\Bags\UserFilterBag;
use App\Domain\User\UserSearchCriteria as UserSearchCriteriaContract;

class UserSearchCriteria extends Criteria implements UserSearchCriteriaContract
{
    public function __construct(
        private readonly UserFilterBag $userFilterBag,
        protected readonly CriteriaPagination $criteriaPagination,
        protected readonly ?CriteriaSort $criteriaSort = null,
    ) {
        parent::__construct($criteriaPagination, $criteriaSort);
    }

    public function email(): ?string
    {
        return $this->userFilterBag->email();
    }

    public function name(): ?string
    {
        return $this->userFilterBag->name();
    }
}
