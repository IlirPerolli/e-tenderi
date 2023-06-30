<?php

namespace App\Http\Requests\API\V1\Auth;

use App\Enums\CategoryTypeEnum;
use App\Enums\UserTypeEnum;
use App\Http\Requests\API\APIRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class RegisterRequest extends APIRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => [
                'required', 'email',
                Rule::unique('users', 'email')->where(function ($query) {
                    return $query->whereNull('deleted_at')
                        ->orWhereNotNull('deleted_at');
                }),
            ],
            'password' => ['required', 'string', 'confirmed', 'min:8', 'max:255'],
            'phone_code' => ['required_with:phone_number', 'max:255'],
            'phone_number' => ['required_with:phone_code, max:255'],
            'name' => ['required', 'min:2', 'max:255'],
            'website' => ['nullable', 'min:2', 'max:255'],
            'image' => ['nullable', 'mimetypes:image/*'],
            'type' => ['required', new Enum(UserTypeEnum::class)],
            'tax_status' => ['nullable', 'mimetypes:application/pdf'],
            'tax_proof' => ['nullable', 'mimetypes:application/pdf'],
            'user_services' => [
                'array', 'nullable',
                Rule::exists('categories', 'id')->where(function ($query) {
                    $query->where('type', CategoryTypeEnum::USER_SERVICE->value);
                }),
            ],
            'user_services.*' => ['nullable'],

            'address.street' => ['nullable', 'max:255', 'min:2'],
            'address.city' => ['nullable', 'max:255', 'min:2'],
            'address.state' => ['nullable', 'max:255', 'min:2'],
            'address.zip_code' => ['nullable', 'max:255', 'min:2'],
            'address.country_id' => ['required', 'integer', 'exists:countries,id'],

            'contact_person.first_name' => ['required', 'string', 'max:255', 'min:2'],
            'contact_person.last_name' => ['required', 'string', 'max:255', 'min:2'],
            'contact_person.email' => ['nullable', 'email'],
            'contact_person.phone_code' => ['nullable'],
            'contact_person.phone_number' => ['nullable'],
            'contact_person.work_title' => ['required', 'max:255'],
        ];
    }
}
