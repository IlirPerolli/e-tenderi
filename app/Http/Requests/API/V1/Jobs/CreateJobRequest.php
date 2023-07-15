<?php

namespace App\Http\Requests\API\V1\Jobs;

use Illuminate\Foundation\Http\FormRequest;

class CreateJobRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'min:2', 'max:5000'],
            'description' => ['nullable', 'min:2', 'max:5000'],
            'image_path' => ['nullable', 'min:2', 'max:5000'],
            'deadline' => ['nullable', 'date'],
            'url' => ['required', 'url', 'min:2', 'max:1000'],
            'price' => ['nullable', 'float', 'min:2', 'max:255'],
            'props' => ['nullable'],
            'company' => ['nullable'],
            'country' => ['required'],
            'city' => ['nullable']
        ];
    }
}