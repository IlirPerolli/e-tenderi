<?php

namespace App\Http\Requests\API\V1\Tenders;

use Illuminate\Foundation\Http\FormRequest;

class CreateTenderRequest extends FormRequest
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
            'price' => ['nullable', 'string', 'min:2', 'max:255'],
            'props' => ['nullable'],
            'provider' => ['nullable'],
            'country' => ['required'],
            'city' => ['nullable'],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['nullable', 'max:255', 'min:2'],
        ];
    }
}
