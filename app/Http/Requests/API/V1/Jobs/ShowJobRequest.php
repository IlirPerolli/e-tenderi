<?php

namespace App\Http\Requests\API\V1\Jobs;

use Illuminate\Foundation\Http\FormRequest;

class ShowJobRequest extends FormRequest
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
            'deadline' => ['nullable', 'date'],
        ];
    }
}
