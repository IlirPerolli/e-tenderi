<?php

namespace App\Http\Controllers\Livewire\Tenders;

use App\Enums\ListingTypeEnum;
use App\Filters\TenderFilter;
use App\Models\Category;
use App\Models\City;
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
        $this->cities = City::query()->whereHas('country', fn($query) => $query->where('name', 'LIKE', '%kosovo%'))->get();
        $this->categories = Category::query()->where('type', ListingTypeEnum::TENDER->value)->get();
    }

    public function render()
    {
        $tenders = Tender::query()->filter(new TenderFilter($this))->with('provider')->latest()->paginate(50);

        return view('tenders.index', compact('tenders'));
    }

    public function deleteItem(Tender $tender)
    {
        $tender->delete();

        notify_success("The tender has been deleted.", $this);
    }
}
