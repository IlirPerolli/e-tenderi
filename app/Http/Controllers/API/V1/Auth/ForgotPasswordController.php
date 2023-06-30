<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\API\APIController;
use App\Http\Requests\API\V1\Auth\ForgotPasswordRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends APIController
{
    public function __invoke(): JsonResponse
    {
        $credentials = request()->validate(['email' => 'required|email']);

        Password::sendResetLink($credentials);

        return $this->respondWithSuccess(null, __('auth.forgot.success'));
    }
}
