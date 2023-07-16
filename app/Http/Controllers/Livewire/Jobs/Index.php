<?php

namespace App\Http\Controllers\Livewire\Jobs;

use App\Filters\JobFilter;
use App\Models\Category;
use App\Models\City;
use App\Models\Job;
use App\Models\Provider;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public ?string $query = '';
    public ?string $provider = null;
    public ?string $city = null;
    public ?string $category = null;


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

    public function render()
    {
        $jobs = Job::query()->filter(new JobFilter($this))->with('provider')->whereDate('deadline', '>', Carbon::now())->latest()->paginate(24);
        $providers = Provider::query()->get();
        $cities = City::query()->get();
        $categories = Category::query()->get();

        return view('jobs.index', compact('jobs', 'providers', 'cities', 'categories'));
    }

    public function deleteItem(Job $job): void
    {
        $job->delete();

        notify_success("The job has been deleted.", $this);
    }
}
