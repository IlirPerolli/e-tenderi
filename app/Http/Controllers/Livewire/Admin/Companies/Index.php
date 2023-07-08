<?php

namespace App\Http\Controllers\Livewire\Admin\Companies;

use App\Filters\CompanyFilter;
use App\Models\Company;
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
        $objects = Company::query()->filter(new CompanyFilter($this))->paginate(10);
        return view('admin.companies.index', compact('objects'));
    }

    public function deleteItem(Company $company)
    {
        $company->delete();

        notify_success("The company has been deleted.", $this);
    }
}
