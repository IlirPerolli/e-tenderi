<?php

namespace App\Http\Controllers\API\V1\Tenders;

use App\Http\Controllers\API\APIController;
use App\Models\Tender;

class TendersShowController extends APIController
{
    public function __invoke($tender)
    {
        $tender = Tender::query()->where('name', 'LIKE', '%'.$tender.'%')->first();
        return $this->respondWithSuccess($tender);
    }
}
