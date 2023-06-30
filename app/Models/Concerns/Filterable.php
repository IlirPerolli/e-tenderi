<?php

namespace App\Models\Concerns;

use App\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    public function scopeFilter(Builder $builder, Filter $filter): void
    {
        $filter->apply($builder);
    }
}
