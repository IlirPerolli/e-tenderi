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

        $country = $this->findOrCreateCountry($data['country'] ?? null);

        $city = $this->findOrCreateCity($data['city'] ?? null, $country);

        $data['provider_id'] = $provider?->id;
        $data['country_id'] = $country?->id;
        $data['city_id'] = $city->id ?? null;
        $categories = $data['categories'] ?? null;
        unset($data['provider']);
        unset($data['country']);
        unset($data['city']);
        unset($data['categories']);

        $job = Job::create($data);

        $this->findOrCreateCategory($categories, $job);

        return $this->respondWithSuccess(new JobResource($job), __('app.success'), 201);
    }

    private function findProviderByName(?string $providerName): ?Provider
    {
        if (!$providerName) {
            return null;
        }

        return Provider::where('name', 'LIKE', '%' . $providerName . '%')->first();
    }

    private function findOrCreateCountry(?string $countryName): ?Country
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

    private function findOrCreateCity(?string $cityName, ?Country $country)
    {
        if (!$cityName || !$country) {
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

    private function findOrCreateCategory(?array $categories, $job): void
    {
        if (!$categories){
            return;
        }

        foreach ($categories as $categoryName){

            $category = Category::where('name', 'LIKE', '%' . $categoryName . '%')->first();

            if (!$category) {
                $category = Category::create([
                    'name' => $categoryName,
                ]);
            }

            $job->categories()->attach($category);
        }
    }
}
