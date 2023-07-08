<?php

namespace App\Http\Controllers\API\V1\Tenders;

use App\Http\Controllers\API\APIController;
use App\Http\Requests\API\V1\Tenders\CreateTenderRequest;
use App\Http\Resources\API\V1\TenderResource;
use App\Models\Company;
use App\Models\Tender;
use Illuminate\Http\JsonResponse;

class TendersCreateController extends APIController
{
    public function __invoke(CreateTenderRequest $request): JsonResponse
    {
        $data = $request->validated();

        $existingTender = Tender::where('name', $data['name'])->exists();

        if ($existingTender) {
            return $this->respondWithError('Tender already exists');
        }

        $company = Company::query()->where('name', 'LIKE', '%'.$data['company'].'%')->first();

        unset($data['company']);

        if ($company){
            $data['company_id'] = $company->id;
        }

        $tender = Tender::query()->create($data);

        return $this->respondWithSuccess(new TenderResource($tender), __('app.success'), 201);
    }
}
