<?php

namespace App\Http\Controllers\Livewire\Admin\Providers;

use App\Filters\CompanyFilter;
use App\Filters\ProviderFilter;
use App\Models\Company;
use App\Models\Provider;
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
        $objects = Provider::query()->filter(new ProviderFilter($this))->paginate(10);
        return view('admin.providers.index', compact('objects'));
    }

    public function deleteItem(Provider $provider)
    {
        $provider->delete();

        notify_success("The provider has been deleted.", $this);
    }
}
