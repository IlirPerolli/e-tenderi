<?php

namespace App\Http\Controllers\Livewire\Admin\Countries;

use App\Filters\CountryFilter;
use App\Models\Country;
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
        $objects = Country::query()->filter(new CountryFilter($this))->paginate(10);
        return view('admin.countries.index', compact('objects'));
    }

    public function deleteItem(Country $country): void
    {
        $country->delete();

        notify_success("The country has been deleted.", $this);
    }
}
