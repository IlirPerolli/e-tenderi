<?php

namespace App\Http\Controllers\API\V1\Jobs;

use App\Http\Controllers\API\APIController;
use App\Http\Requests\API\V1\Jobs\CreateJobRequest;
use App\Http\Resources\API\V1\JobResource;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Job;
use App\Models\Provider;
use Illuminate\Http\JsonResponse;

class JobsCreateController extends APIController
{
    public function __invoke(CreateJobRequest $request): JsonResponse
    {
        $data = $request->validated();

        $existingJob = Job::query()
            ->where('name', 'LIKE',  '%'.$data['name'].'%')
            ->when(isset($data['deadline']), function ($query) use ($data) {
                $query->where('deadline', $data['deadline']);
            })
            ->exists();

        if ($existingJob) {
            return $this->respondWithError('Job already exists');
        }

        $provider = $this->findProviderByName($data['provider'] ?? null);

        $country = $this->findOrCreateCountry($data['country']);

        $city = $this->findOrCreateCity($data['city'] ?? null, $country);

        $category = $this->findOrCreateCategory($data['category'] ?? null);

        $data['provider_id'] = $provider?->id;
        $data['country_id'] = $country?->id;
        $data['city_id'] = $city->id ?? null;

        unset($data['provider']);
        unset($data['country']);
        unset($data['city']);
        unset($data['category']);

        $job = Job::create($data);

        if ($category){
            $job->category()->attach($category);
        }

        return $this->respondWithSuccess(new JobResource($job), __('app.success'), 201);
    }

    private function findProviderByName(?string $providerName): ?Provider
    {
        if (!$providerName) {
            return null;
        }

        return Provider::where('name', 'LIKE', '%' . $providerName . '%')->first();
    }

    private function findOrCreateCountry(string $countryName): ?Country
    {
        if (!$countryName) {
            return null;
        }

        $country = Country::where('name', 'LIKE', '%' . $countryName . '%')->first();

        if (!$country){
            $country = Country::query()->create(['name' => $countryName]);
        }

        return $country;
    }

    private function findOrCreateCity(?string $cityName, Country $country)
    {
        if (!$cityName) {
            return null;
        }

        $city = City::where('name', 'LIKE', '%' . $cityName . '%')->first();

        if (!$city) {
            $city = City::create([
                'name' => $cityName,
                'country_id' => $country->id,
            ]);
        }

        return $city;
    }

    private function findOrCreateCategory(?string $categoryName)
    {
        if (!$categoryName){
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
