<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\API\APIController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class LogoutController extends APIController
{
    public function __invoke(Request $request): JsonResponse
    {
        PersonalAccessToken::findToken($request->bearerToken())->delete();

        return $this->respondWithSuccess();
    }
}
