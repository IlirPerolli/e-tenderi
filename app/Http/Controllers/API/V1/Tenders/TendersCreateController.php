<?php

namespace App\Http\Controllers\API\V1\Tenders;

use App\Http\Controllers\API\APIController;
use App\Http\Requests\API\V1\Tenders\CreateTenderRequest;
use App\Http\Resources\API\V1\TenderResource;
use App\Models\Tender;
use Illuminate\Http\JsonResponse;

class TendersCreateController extends APIController
{
    public function __invoke(CreateTenderRequest $request): JsonResponse
    {
        $existingTender = Tender::where('name', $request->name)->exists();

        if ($existingTender) {
            return $this->respondWithError('Tender already exists');
        }

        $tender = Tender::create($request->validated());

        return $this->respondWithSuccess(new TenderResource($tender), __('app.success'), 201);
    }
}
