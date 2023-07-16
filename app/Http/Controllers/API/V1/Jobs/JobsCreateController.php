<?php

namespace App\Http\Controllers\API\V1\Jobs;

use App\Http\Controllers\API\APIController;
use App\Http\Requests\API\V1\Jobs\CreateJobRequest;
use App\Http\Resources\API\V1\JobResource;
use App\Models\Category;
use App\Models\City;
use App\Models\Company;
use App\Models\Country;
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

        $company = $this->findCompanyByName($data['company'] ?? null);

        $country = $this->findCountryByName($data['country'] ?? null);

        $city = $this->findOrCreateCity($data['city'] ?? null, $data['country']);

        $category = $this->findOrCreateCategory($data['category'] ?? null);

        $data['company_id'] = $company?->id;
        $data['country_id'] = $country?->id;
        $data['city_id'] = $city->id ?? null;

        unset($data['company']);
        unset($data['country']);
        unset($data['city']);
        unset($data['category']);

        $job = Job::create($data);

        if ($category){
            $job->category()->attach($category);
        }

        return $this->respondWithSuccess(new JobResource($job), __('app.success'), 201);
    }

    private function findCompanyByName(?string $companyName): ?Company
    {
        if (!$companyName) {
            return null;
        }

        return Company::where('name', 'LIKE', '%' . $companyName . '%')->first();
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
        if (!$categoryName){
            return null;
        }

        $category = Category::where('name', 'LIKE', '%' . $categoryName . '%')->exists();

        if (!$category) {
            $category = Category::create([
                'name' => $categoryName,
            ]);
        }

        return $category;
    }
}
