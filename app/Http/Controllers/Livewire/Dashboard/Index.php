<?php

namespace App\Http\Controllers\Livewire\Dashboard;

use App\Models\Job;
use App\Models\Tender;
use Carbon\Carbon;
use Livewire\Component;

class Index extends Component
{
    public $jobsTotal;
    public $tendersTotal;
    public $jobsLastRecordUpdatedAt;
    public $tendersLastRecordUpdatedAt;

    public function mount()
    {
        $this->mountJobsStats();
        $this->mountTendersStats();
    }

    public function render()
    {
        return view('dashboard.index');
    }

    protected function mountJobsStats()
    {
        $this->jobsTotal = Job::query()->whereDate('deadline', '>', Carbon::now())->count() ?? 0;

        $germanListingJobs = Job::query()->whereHas('provider', function ($query){
            $query->where('name', 'LIKE', '%ArbeitsAgentur%');
        })->count() ?? 0;
        $this->jobsTotal += $germanListingJobs;

        $updatedAt = Job::query()->latest('id')->value('updated_at');

        if ($updatedAt) {
            $this->jobsLastRecordUpdatedAt = $updatedAt->format('d.m.Y H:i');
        }
    }

    protected function mountTendersStats()
    {
        $this->tendersTotal = Tender::query()->count() ?? 0;

        $updatedAt = Tender::query()->latest('id')->value('updated_at');

        if ($updatedAt) {
            $this->tendersLastRecordUpdatedAt = $updatedAt->format('d.m.Y H:i');
        }
    }
}
