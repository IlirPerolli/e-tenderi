<?php

namespace App\Http\Requests\API\V1\Tenders;

use Illuminate\Foundation\Http\FormRequest;

class CreateTenderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
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
            'company' => ['nullable']
        ];
    }
}
