<?php

namespace App\Http\Controllers\Livewire\Jobs;

use App\Filters\JobFilter;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Job;
use App\Models\Provider;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public ?string $query = '';
    public ?string $provider = null;
    public ?string $city = null;
    public ?string $country = null;
    public ?string $category = null;

    public Collection $providers;
    public $cities;
    public $allCities;
    public Collection $countries;
    public Collection $categories;


    protected $queryString = [
        'page' => ['except' => 1, 'as' => 'p'],
        'query' => ['except' => '', 'as' => 'q'],
        'provider' => ['except' => ''],
        'city' => ['except' => ''],
        'country' => ['except' => ''],
        'category' => ['except' => ''],
    ];

    public function updating()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->providers = Provider::query()->get();
        $this->allCities = City::query()->get();
        $this->countries = Country::query()->get();
        $this->categories = Category::query()->get();
    }

    public function render()
    {
        $jobs = Job::query()->filter(new JobFilter($this))->with('provider')->whereDate('deadline', '>', Carbon::now())->latest()->paginate(24);

        if ($this->country == 'remote'){
            $this->cities = [];
        }
        else{
            $this->cities = $this->allCities;
        }

        return view('jobs.index', compact('jobs'));
    }

    public function deleteItem(Job $job): void
    {
        $job->delete();

        notify_success("The job has been deleted.", $this);
    }
}
