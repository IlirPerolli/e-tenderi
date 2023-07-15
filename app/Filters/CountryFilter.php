<?php

namespace App\Filters;

class CountryFilter extends Filter
{
    public function query($value)
    {
        $this->builder->where(function ($query) use ($value) {
            $query->where('name', 'LIKE', "%$value%");
        });
    }
}
