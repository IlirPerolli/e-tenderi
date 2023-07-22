<?php

namespace App\Http\Controllers\API\V1\Tenders;

use App\Http\Controllers\API\APIController;
use App\Http\Requests\API\V1\Tenders\CreateTenderRequest;
use App\Http\Resources\API\V1\JobResource;
use App\Http\Resources\API\V1\TenderResource;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Provider;
use App\Models\Tender;
use Illuminate\Http\JsonResponse;

class TendersCreateController extends APIController
{
    public function __invoke(CreateTenderRequest $request): JsonResponse
    {
        $data = $request->validated();

        $existingTender = Tender::query()
            ->where('name', 'LIKE', '%' . $data['name'] . '%')
            ->when(isset($data['deadline']), function ($query) use ($data) {
                $query->where('deadline', $data['deadline']);
            })
            ->exists();

        if ($existingTender) {
            return $this->respondWithError('Tender already exists');
        }

        $provider = $this->findProviderByName($data['provider'] ?? null);

        $country = $this->findCountryByName($data['country'] ?? null);

        $city = $this->findOrCreateCity($data['city'] ?? null, $data['country']);

        $category = $this->findOrCreateCategory($data['category'] ?? null);

        $data['provider_id'] = $provider?->id;
        $data['country_id'] = $country?->id;
        $data['city_id'] = $city->id ?? null;

        unset($data['provider']);
        unset($data['country']);
        unset($data['city']);
        unset($data['category']);

        $tender = Tender::create($data);

        if ($category) {
            $tender->category()->attach($category);
        }

        return $this->respondWithSuccess(new TenderResource($tender), __('app.success'), 201);
    }

    private function findProviderByName(?string $providerName): ?Provider
    {
        if (!$providerName) {
            return null;
        }

        return Provider::where('name', 'LIKE', '%' . $providerName . '%')->first();
    }

    private function findCountryByName(?string $countryName): ?Country
    {
        if (!$countryName) {
            return null;
        }

        return Country::where('name', 'LIKE', '%' . $countryName . '%')->first();
    }

    private function findOrCreateCity(?string $cityName, ?string $countryName)
    {
        if (!$cityName) {
            return null;
        }

        $city = City::where('name', 'LIKE', '%' . $cityName . '%')->first();

        if (!$city) {
            $country = Country::where('name', 'LIKE', '%' . $countryName . '%')->first();
            $city = City::create([
                'name' => $cityName,
                'country_id' => $country->id,
            ]);
        }

        return $city;
    }

    private function findOrCreateCategory(?string $categoryName)
    {
        if (!$categoryName) {
            return null;
        }

        $category = Category::where('name', 'LIKE', '%' . $categoryName . '%')->first();

        if (!$category) {
            $category = Category::create([
                'name' => $categoryName,
            ]);
        }

        return $category;
    }
}
