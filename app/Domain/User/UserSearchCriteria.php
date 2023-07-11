<?php

namespace App\Domain\User;

use App\Infrastructure\Laravel\Service\RequestCriteria\Criteria;

interface UserSearchCriteria extends Criteria
{
    public function email(): ?string;

    public function name(): ?string;
}
