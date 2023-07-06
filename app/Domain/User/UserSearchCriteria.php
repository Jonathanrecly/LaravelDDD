<?php

namespace App\Domain\User;

use App\Domain\Shared\Model\Criteria;
use App\Domain\Shared\Model\CriteriaPagination;
use App\Domain\User\Bags\UserFilterBag;

class UserSearchCriteria extends Criteria
{
    public function __construct(
        private readonly UserFilterBag $userFilterBag,
        protected readonly CriteriaPagination $criteriaPagination,
    ) {
        parent::__construct($criteriaPagination);
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
