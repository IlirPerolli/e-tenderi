<?php

namespace App\Http\Requests\API\V1\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class EmailVerificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        if (!$user = User::query()->find($this->route('id'))) {
            return false;
        }

        if (!hash_equals((string)$this->route('id'),
            (string)$user->getKey())) {
            return false;
        }

        if (!hash_equals((string)$this->route('hash'),
            sha1($user->getEmailForVerification()))) {
            return false;
        }

        return true;
    }

    public function rules(): array
    {
        return [];
    }
}
