<?php

namespace App\Http\Controllers\API\V1\Tenders;

use App\Http\Controllers\API\APIController;
use App\Http\Requests\API\V1\Tenders\CreateTenderRequest;
use App\Http\Resources\API\V1\TenderResource;
use App\Models\Provider;
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

        $provider = Provider::query()->where('name', 'LIKE', '%'.$data['provider'].'%')->first();

        unset($data['provider']);

        if ($provider){
            $data['provider_id'] = $provider->id;
        }

        $tender = Tender::query()->create($data);

        return $this->respondWithSuccess(new TenderResource($tender), __('app.success'), 201);
    }
}
