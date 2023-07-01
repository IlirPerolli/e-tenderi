<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request as Request;
use Livewire\Component;

abstract class Filter
{
    protected $parameters = [];

    protected Builder $builder;

    public function __construct($request)
    {
        if ($request instanceof Component) {
            $this->parameters = $this->extractFromComponent($request);
        }

        if ($request instanceof Request) {
            $this->parameters = $request->all();
        }
    }

    private function extractFromComponent(Component $component): array
    {
        $keys = $component->getQueryString() ?? [];

        $parameters = [];

        foreach ($keys as $key => $value) {
            if (property_exists($component, $key)) {
                $parameters[$key] = $component->$key;
            }
        }

        return $parameters;
    }

    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->filters() as $name => $value) {
            if (method_exists($this, $name) && !empty($value)) {
                call_user_func_array([$this, $name], array_filter([$value]));
            }
        }
        return $this->builder;
    }

    public function filters()
    {
        return $this->parameters;
    }
}
