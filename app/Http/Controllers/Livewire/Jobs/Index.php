<?php

namespace App\Http\Controllers\Livewire\Jobs;

use App\Filters\JobFilter;
use App\Models\Company;
use App\Models\Job;
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
        $jobs = Job::query()->filter(new JobFilter($this))->with('company')->paginate(12);
        $companies = Company::query()->get();

        return view('jobs.index', compact('jobs', 'companies'));
    }

    public function deleteItem(Job $job)
    {
        $job->delete();

        notify_success("The job has been deleted.", $this);
    }
}
