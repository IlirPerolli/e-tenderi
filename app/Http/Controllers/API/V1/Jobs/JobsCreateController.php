<?php

namespace App\Http\Controllers\API\V1\Jobs;

use App\Http\Controllers\API\APIController;
use App\Http\Requests\API\V1\Jobs\CreateJobRequest;
use App\Http\Resources\API\V1\JobResource;
use App\Models\Company;
use App\Models\Job;
use Illuminate\Http\JsonResponse;

class JobsCreateController extends APIController
{
    public function __invoke(CreateJobRequest $request): JsonResponse
    {
        $data = $request->validated();

        $existingJob = Job::where('name', $data['name'])->exists();

        if ($existingJob) {
            return $this->respondWithError('Job already exists');
        }

        $company = Company::query()->where('name', 'LIKE', '%'.$data['company'].'%')->first();

        unset($data['company']);

        if ($company){
            $data['company_id'] = $company->id;
        }

        $job = Job::query()->create($data);

        return $this->respondWithSuccess(new JobResource($job), __('app.success'), 201);
    }
}
