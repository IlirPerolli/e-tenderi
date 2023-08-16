<?php

namespace App\Http\Controllers\API\V1\Tenders;

use App\Http\Controllers\API\APIController;
use App\Http\Requests\API\V1\Tenders\ShowTenderRequest;
use App\Models\Tender;

class TendersShowController extends APIController
{
    public function __invoke(ShowTenderRequest $request)
    {
        $data = $request->validated();

        $tender = Tender::query()->where(function ($query) use ($data) {
            foreach ($data as $key => $value) {
                $query->where($key, 'LIKE', '%' . $value . '%');
            }
        })->first();

        return $this->respondWithSuccess($tender);
    }
}
