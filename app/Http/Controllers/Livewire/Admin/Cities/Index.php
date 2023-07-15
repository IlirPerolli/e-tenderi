<?php

namespace App\Http\Controllers\Livewire\Admin\Cities;

use App\Filters\CityFilter;
use App\Models\City;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $query = '';

    protected $queryString = [
        'page' => ['except' => 1, 'as' => 'p'],
        'query' => ['except' => '', 'as' => 'q'],
    ];

    public function updating()
    {
        $this->resetPage();
    }


    public function render()
    {
        $objects = City::query()->filter(new CityFilter($this))->with('country')->paginate(10);
        return view('admin.cities.index', compact('objects'));
    }

    public function deleteItem(City $city)
    {
        $city->delete();

        notify_success("The city has been deleted.", $this);
    }
}
