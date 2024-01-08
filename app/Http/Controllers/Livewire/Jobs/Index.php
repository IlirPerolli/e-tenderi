<?php

namespace App\Http\Controllers\Livewire\Jobs;

use App\Enums\ListingTypeEnum;
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
    public ?string $country = 'kosovo';
    public ?string $category = null;
    public ?string $type = null;

    public Collection $providers;

    public $cities;
    public $allCities;

    public $categories;
    public $allCategories;

    public Collection $countries;


    protected $queryString = [
        'page' => ['except' => 1, 'as' => 'p'],
        'query' => ['except' => '', 'as' => 'q'],
        'provider' => ['except' => ''],
        'city' => ['except' => ''],
        'country' => ['except' => ''],
        'category' => ['except' => ''],
        'type' => ['except' => ''],
    ];

    public function updating()
    {
        $this->resetPage();
    }

    public function updatedCountry(): void
    {
        $this->city = null;
    }

    public function mount()
    {
        $this->providers = Provider::query()->get();
        $this->allCities = City::query()->get();
        $this->countries = Country::query()->get();
        $this->allCategories = Category::query()->where('type', ListingTypeEnum::JOB->value)->get();
    }

    public function render()
    {
        $jobs = Job::query()->filter(new JobFilter($this))->with('provider', 'categories', 'country', 'city', 'provider')
            ->when($this->country == 'kosovo', function ($query) {
                $query->whereDate('deadline', '>', Carbon::now());
            })
            ->latest()->paginate(50);

        $countryId = Country::query()->where('slug', $this->country)->first()->id ?? null;

        if ($countryId) {
            $this->cities = City::query()->where('country_id', $countryId)->get();
            $this->categories = Category::query()
                ->where('country_id', $countryId)
                ->where('type', ListingTypeEnum::JOB->value)
                ->get();
        } else {
            $this->cities = $this->allCities;
            $this->categories = $this->allCategories;
        }

        return view('jobs.index', compact('jobs'));
    }

    public function deleteItem(Job $job): void
    {
        $job->delete();

        notify_success("The job has been deleted.", $this);
    }
}
