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

    public function provider($value)
    {
        $this->builder->whereHas('provider', function ($query) use ($value){
           $query->where('slug', $value);
        });
    }

    public function city($value)
    {
        $this->builder->whereHas('city', function ($query) use ($value){
            $query->where('slug', $value);
        });
    }

    public function country($value)
    {
        $this->builder->whereHas('country', function ($query) use ($value){
            $query->where('slug', $value);
        });
    }

    public function category($value)
    {
        $this->builder->whereHas('category', function ($query) use ($value){
            $query->where('slug', $value);
        });
    }
}
