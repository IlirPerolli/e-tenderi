<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Enums\UserMediaEnum;
use App\Enums\UserRoleEnum;
use App\Enums\UserStatusEnum;
use App\Enums\UserTypeEnum;
use App\Http\Controllers\API\APIController;
use App\Http\Requests\API\V1\Auth\RegisterRequest;
use App\Http\Resources\API\V1\UserResource;
use App\Models\Address;
use App\Models\User;
use App\Services\Notifications\CreateNotificationService;
use Illuminate\Http\JsonResponse;

class RegisterController extends APIController
{
    public function __invoke(RegisterRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => UserRoleEnum::USER->value
        ]);

        $response = [
            'token' => $user->createToken('Personal Token')->plainTextToken,
            'user' => UserResource::make($user),
        ];

        return $this->respondWithSuccess($response, __('app.success'), 201);
    }
}
