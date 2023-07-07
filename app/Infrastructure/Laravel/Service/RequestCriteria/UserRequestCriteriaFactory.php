<?php

namespace App\Infrastructure\Laravel\Service\RequestCriteria;

use App\Domain\User\Bags\UserFilterBag;
use App\Infrastructure\Laravel\Service\RequestCriteria\Criteria\UserSearchCriteria;
use Symfony\Component\HttpFoundation\InputBag;

class UserRequestCriteriaFactory extends Factory
{
    protected const DEFAULT_LIMIT = 10;

    protected const DEFAULT_OFFSET = 0;

    public function fromInputBag(InputBag $inputBag): UserSearchCriteria
    {
        $userFilterBag = new UserFilterBag($inputBag->filter('filter', [], FILTER_DEFAULT, FILTER_FORCE_ARRAY));

        return new UserSearchCriteria(
            $userFilterBag,
            $this->makePaginationFromInputBag($inputBag),
            $this->makeSortFromInputBag($inputBag)
        );
    }
}
