<?php

namespace App\Infrastructure\Laravel;

use App\Domain\Shared\Aggregate;
use Illuminate\Database\Eloquent\Model;

abstract class Transformer
{
    abstract public function fromDomain(Aggregate $aggregate): Model;

    abstract public function toDomain(Model $model): Aggregate;
}
