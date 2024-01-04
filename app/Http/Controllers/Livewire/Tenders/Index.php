<?php

namespace App\Http\Controllers\Livewire\Tenders;

use App\Filters\TenderFilter;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Provider;
use App\Models\Tender;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public ?string $query = '';
    public ?string $provider = null;
    public ?string $city = null;
    public ?string $category = null;

    public Collection $providers;
    public $cities;
    public Collection $countries;
    public Collection $categories;


    protected $queryString = [
        'page' => ['except' => 1, 'as' => 'p'],
        'query' => ['except' => '', 'as' => 'q'],
        'provider' => ['except' => ''],
        'city' => ['except' => ''],
        'category' => ['except' => ''],
    ];

    public function updating()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->providers = Provider::query()->get();
        $this->cities = City::query()->get();
        $this->categories = Category::query()->get();
    }

    public function render()
    {
        $tenders = Tender::query()->filter(new TenderFilter($this))->with('provider')->latest()->paginate(50);
        $providers = Provider::query()->get();
        $cities = City::query()->get();
        $categories = Category::query()->get();

        return view('tenders.index', compact('tenders', 'providers', 'cities', 'categories'));
    }

    public function deleteItem(Tender $tender)
    {
        $tender->delete();

        notify_success("The tender has been deleted.", $this);
    }
}
