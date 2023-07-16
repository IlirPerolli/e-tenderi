<?php

namespace App\Http\Controllers\Livewire\Tenders;

use App\Filters\TenderFilter;
use App\Models\City;
use App\Models\Provider;
use App\Models\Tender;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public ?string $query = '';
    public ?string $provider = null;
    public ?string $city = null;


    protected $queryString = [
        'page' => ['except' => 1, 'as' => 'p'],
        'query' => ['except' => '', 'as' => 'q'],
        'provider' => ['except' => ''],
        'city' => ['except' => ''],
    ];

    public function updating()
    {
        $this->resetPage();
    }

    public function render()
    {
        $tenders = Tender::query()->filter(new TenderFilter($this))->with('provider')->paginate(12);
        $providers = Provider::query()->get();
        $cities = City::query()->get();

        return view('tenders.index', compact('tenders', 'providers', 'cities'));
    }

    public function deleteItem(Tender $tender)
    {
        $tender->delete();

        notify_success("The tender has been deleted.", $this);
    }
}
