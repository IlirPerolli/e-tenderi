<?php

namespace App\Http\Controllers\API\V1\Jobs;

use App\Http\Controllers\API\APIController;
use App\Http\Requests\API\V1\Jobs\ShowJobRequest;
use App\Models\Job;
use Illuminate\Http\Request;

class JobsShowController extends APIController
{
    public function __invoke(ShowJobRequest $request)
    {
        $data = $request->validated();

        $job = Job::query()->where(function ($query) use ($data) {

            foreach ($data as $key => $value) {
                $query->where($key, 'LIKE', '%' . $value . '%');
            }
        })->first();

        return $this->respondWithSuccess($job);
    }
}
