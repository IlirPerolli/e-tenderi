<?php

namespace App\Filters;

class JobFilter extends Filter
{
    public function query($value)
    {
        $this->builder->where(function ($query) use ($value) {
            $query->where('name', 'LIKE', "%$value%")
                ->orWhere('description', 'LIKE', "%$value%");
        });
    }

    public function company($value)
    {
        $this->builder->whereHas('company', function ($query) use ($value){
           $query->where('slug', $value);
        });
    }

    public function city($value)
    {
        $this->builder->whereHas('city', function ($query) use ($value){
            $query->where('slug', $value);
        });
    }
}
