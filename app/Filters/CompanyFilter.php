<?php

namespace App\Filters;

class CompanyFilter extends Filter
{
    public function query($value)
    {
        $this->builder->where(function ($query) use ($value) {
            $query->where('name', 'LIKE', "%$value%")
                ->orWhere('description', 'LIKE', "%$value%");
        });
    }
}