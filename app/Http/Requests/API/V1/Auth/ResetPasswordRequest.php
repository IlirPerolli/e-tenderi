<?php

namespace App\Http\Requests\API\V1\Auth;

use App\Http\Requests\API\APIRequest;
use Illuminate\Validation\Rules;

class ResetPasswordRequest extends APIRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
}
