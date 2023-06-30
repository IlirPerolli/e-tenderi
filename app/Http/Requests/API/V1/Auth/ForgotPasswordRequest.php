<?php

namespace App\Http\Requests\API\V1\Auth;

use App\Http\Requests\API\APIRequest;

class ForgotPasswordRequest extends APIRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
        ];
    }
}
