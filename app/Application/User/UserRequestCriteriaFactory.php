<?php

namespace App\Application\User;

use App\Domain\Shared\Model\CriteriaPagination;
use App\Domain\Shared\Model\Pagination\Limit;
use App\Domain\Shared\Model\Pagination\Offset;
use App\Domain\Shared\ValueObject\Integer;
use App\Domain\User\Bags\UserFilterBag;
use App\Domain\User\UserSearchCriteria;
use Symfony\Component\HttpFoundation\InputBag;

class UserRequestCriteriaFactory
{
    const DEFAULT_LIMIT = 10;

    const DEFAULT_OFFSET = 0;

    public function fromInputBag(InputBag $inputBag): UserSearchCriteria
    {
        $userFilterBag = new UserFilterBag($inputBag->filter('filter', [], FILTER_DEFAULT, FILTER_FORCE_ARRAY));

        $offset = Integer::fromInteger((int) $inputBag->filter('offset'));
        $limit = Integer::fromInteger((int) $inputBag->filter('limit'));

        $criteriaPagination = new CriteriaPagination(
            Limit::fromInteger(max($limit->value(), self::DEFAULT_LIMIT)),
            Offset::fromInteger(max($offset->value(), self::DEFAULT_OFFSET))
        );

        return new UserSearchCriteria($userFilterBag, $criteriaPagination);
    }
}
