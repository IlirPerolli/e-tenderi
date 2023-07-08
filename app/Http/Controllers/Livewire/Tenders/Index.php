<?php

namespace App\Http\Controllers\Livewire\Tenders;

use App\Filters\TenderFilter;
use App\Models\Company;
use App\Models\Tender;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $query = '';
    public $company = null;


    protected $queryString = [
        'page' => ['except' => 1, 'as' => 'p'],
        'query' => ['except' => '', 'as' => 'q'],
        'company' => ['except' => ''],
    ];

    public function updating()
    {
        $this->resetPage();
    }

    public function render()
    {
        $tenders = Tender::query()->filter(new TenderFilter($this))->with('company')->paginate(12);
        $companies = Company::query()->get();

        return view('tenders.index', compact('tenders', 'companies'));
    }

    public function deleteItem(Tender $tender)
    {
        $tender->delete();

        notify_success("The tender has been deleted.", $this);
    }
}
