<?php

namespace App\Http\Controllers\API\V1\Jobs;

use App\Http\Controllers\API\APIController;
use App\Models\Job;

class JobsShowController extends APIController
{
    public function __invoke($tender)
    {
        $tender = Job::query()->where('name', 'LIKE', '%'.$tender.'%')->first();
        return $this->respondWithSuccess($tender);
    }
}
