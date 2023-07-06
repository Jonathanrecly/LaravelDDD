<?php

namespace App\Application\User;

use App\Domain\Shared\Model\CriteriaPagination;
use App\Domain\Shared\Model\Pagination\Limit;
use App\Domain\Shared\Model\Pagination\Offset;
use App\Domain\User\Bags\UserFilterBag;
use App\Domain\User\UserSearchCriteria;
use Symfony\Component\HttpFoundation\InputBag;

class UserRequestCriteriaFactory
{
    const PAGINATION_SIZE = 10;

    public function fromInputBag(InputBag $inputBag): UserSearchCriteria
    {
        $userFilterBag = new UserFilterBag($inputBag->filter('filter', [], FILTER_DEFAULT, FILTER_FORCE_ARRAY));
        $offset = $inputBag->filter('offset');

        $criteriaPagination = new CriteriaPagination(
            Limit::fromInteger(max(self::PAGINATION_SIZE, 0)),
            Offset::fromInteger(max(($offset ?? 0), 0))
        );

        return new UserSearchCriteria($userFilterBag, $criteriaPagination);
    }
}
